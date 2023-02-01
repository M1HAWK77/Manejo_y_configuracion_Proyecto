<?php 
include 'global/config.php';
include 'global/conexionBD.php';
include 'carrito.php';
include 'cabecera.php';
?>
<?php

$ClientId="AWygU55eJ2_sVed5lnBevlINtISRN68ar0dF_wsED-vrNixXnblljKP5zvMpjC7Ww66zR90wD7yVk0iB";
$Secret="EGU7bvHGb1mnKrILOZ8WYTbUnM-x9hOt4gW2hJccfdA3Psu2nP1719kKIM3fzFrwHO4F4XUMLaZ9TwiF";

$Login = curl_init("https://api.sandbox.paypal.com/v1/oauth2/token");

?>
<div class="jumbotron text-center">
    <h1 class = "display-4">Listo !</h1>
    <br>
    <p class="lead">Pago Aprobado</p>
    <hr class = "my-4">
    <p>Los items han sido enviados al correo ingresado</p>
</div>
<?php include('footer.php') ?>