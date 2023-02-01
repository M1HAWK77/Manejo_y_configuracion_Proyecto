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

<script src="https://www.paypalobjects.com/api/checkout.js"></script>
<style>
    
    /* Media query for mobile viewport */
    @media screen and (max-width: 400px) {
        #paypal-button-container {
            width: 100%;
        }
    }
    
    /* Media query for desktop viewport */
    @media screen and (min-width: 400px) {
        #paypal-button-container {
            width: 250px;
            display: inline-block;
        }
    }
    
</style>
<script>
    paypal.Button.render({
        env: 'sandbox', // sandbox | production
        style: {
            label: 'checkout',  // checkout | credit | pay | buynow | generic
            size:  'responsive', // small | medium | large | responsive
            shape: 'pill',   // pill | rect
            color: 'gold'   // gold | blue | silver | black
        },
 
        // PayPal Client IDs - replace with your own
        // Create a PayPal app: https://developer.paypal.com/developer/applications/create
 
        client: {
            sandbox:    'ARWyTbbMIfGr11XMnWXnUb0dMYnQQ6ZhixCPlO_D5fi1IpaeWGDeOCw-xIy_ayrRu2nyPGXROCqiwzbK',
            production: 'YNAVBFWPFMAJG'
        },
 
        // Wait for the PayPal button to be clicked
 
        payment: function(data, actions) {
            return actions.payment.create({
                payment: {
                    transactions: [
                        {
                            amount: { total: '<?php echo $total;?>', currency: 'USD' },
                            description: "Compra de productos:$<?php echo number_format($total, 2);?>", 
                            custom:"<?php echo $SID?>#<?php echo openssl_encrypt($idVenta, COD, KEY)?>"
                        }
                    ]
                }
            });
        },
 
        // Wait for the payment to be authorized by the customer
        onAuthorize: function(data, actions) {
            return actions.payment.execute().then(function() {
                console.log(data);
                window.location="verificador.php?paymentToken="+data.paymentToken
            });
        }
    
    }, '#paypal-button-container');
 
</script>

<div class="jumbotron text-center">

    <h1 class="display-4">PASO FINAL!</h1>
    <hr class="my-4">
    <p class="lead">Estas a punto de pagar con Paypal la cantidad de:
        <h4>$<?php echo number_format($total,2); ?></h4>
        <div id="paypal-button-container"></div>
    </p>

    <p>Los productos podran ser descargados una vez que se procese el pago
        <br>
        <strong>(quejas-> lavidatedasorpresas@gmail.com) </strong>
    </p>
</div>



<?php include('footer.php') ?>