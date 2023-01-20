<?php
include("global/sesiones.php");
include("global/conexionBD.php");

$sentenciaSQL = $pdo->prepare("SELECT count(*) totalVentas FROM ventas");

$sentenciaSQL->execute();

$registro=$sentenciaSQL->fetch(PDO::FETCH_ASSOC);
$totalVentas = $registro['totalVentas'];

?>