<?php
include 'global/config.php';
include 'carrito.php';
include 'cabecera.php';
?>

<!-- para futaras actualizaciones es necesario este div ya que es el que muestra -->
<div class="content-wrapper">

    <br> 
    <h3>lista del carrito</h3>

    <table class="table table-bordered" >

        <tbody>
            <tr>
                <th width="40%">Descripción</th>
                <th width="15%" class="text-center">Cantidad</th>
                <th width="20%" class="text-center">Precio</th>
                <th width="20%" class="text-center">Total</th>
                <th width="5%">--</th>
            </tr>

            <tr>
                <td width="40%">Libro php</td>
                <td width="15%" class="text-center">1</td>
                <td width="20%" class="text-center">$300</td>
                <td width="20%" class="text-center">$200</td>
                <td width="5%"><button class="btn btn-danger" type="button">Eliminar</button></td>
            </tr>
            <tr>
                <td width="40%">Libro php</td>
                <td width="15%" class="text-center">1</td>
                <td width="20%" class="text-center">$300</td>
                <td width="20%" class="text-center">$200</td>
                <td width="5%"><button class="btn btn-danger" type="button">Eliminar</button></td>
            </tr>
            <tr>
                <td colspan="3" align="right" ><h3>Total</h3></td>
                <td align="right"><h3>$<?php echo number_format(300, 2);?></h3></td>
                <td></td>
            </tr>

           
        </tbody>
    </table>

</div>

</div>


<?php include("footer.php") ?>