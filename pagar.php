<?php 
include 'global/config.php';
include 'global/conexionBD.php';
include 'carrito.php';
include 'cabecera.php';
?>
<br>

    <?php
    if ($_POST) {

        $total = 0;
        $SID = session_id();
        $Correo = $_POST['email'];


        foreach ($_SESSION['CARRITO'] as $indice => $producto) {
            $total = $total + ($producto['PRECIO'] * $producto['CANTIDAD']);

        }

        $sentencia = $pdo->prepare("INSERT INTO `ventas` (`id`, `claveTransaccion`, `paypalDatos`, `fecha`, `correo`, `total`, `status`) 
                                    VALUES (NULL, :ClaveTransaccion, '', NOW(), :Correo, :Total, 'pendiente');");

        $sentencia->bindParam(":ClaveTransaccion", $SID);                            
        $sentencia->bindParam(":Correo", $Correo);                            
        $sentencia->bindParam(":Total", $total);                            
        $sentencia->execute();
        $idVenta = $pdo->lastInsertId();

        foreach ($_SESSION['CARRITO'] as $indice => $producto) {

            $sentencia = $pdo->prepare("INSERT INTO `detalleventas` (`id`, `idVenta`, `idProducto`, `precioUnitario`, `cantidad`, `descargado`)
                                        VALUES (NULL, :IDVENTA, :IDPRODUCTO, :PRECIOUNITARIO, :CANTIDAD, '0');");

            $sentencia->bindParam(":IDVENTA", $idVenta);                            
            $sentencia->bindParam(":IDPRODUCTO", $producto['ID']);                            
            $sentencia->bindParam(":PRECIOUNITARIO", $producto['PRECIO']);                            
            $sentencia->bindParam(":CANTIDAD", $producto['CANTIDAD']);                            
            $sentencia->execute();


        }
        //echo "<h3>" . $total . "<h3>";
    
    }
    ?>

     

<div class="jumbotron text-center">

    <h1 class="display-4">PASO FINAL!</h1>
    <hr class="my-4">
    <p class="lead">Estas a punto de pagar con Paypal la cantidad de:
        <h4>$<?php echo number_format($total,2); ?></h4>
    </p>

    <p>Los productos podran ser descargados una vez que se procese el pago
        <br>
        <strong>(quejas-> lavidatedasorpresas@gmail.com) </strong>
    </p>
</div>


<?php include('footer.php') ?>