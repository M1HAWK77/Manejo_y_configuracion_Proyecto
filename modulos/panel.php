<?php
include("global/sesiones.php");
include("global/conexionBD.php");

//Total de ventas e ingresos
$sentenciaSQL = $pdo->prepare("SELECT count(*) totalVentas, SUM(Total) as ingresoTotalVentas FROM ventas WHERE paypalDatos <> '' "); //-> sentencia si tuviera datos en ventas
$sentenciaSQL->execute();
$registro=$sentenciaSQL->fetch(PDO::FETCH_ASSOC);
$totalVentas = $registro['totalVentas'];
$ingresoTotalVentas = $registro['ingresoTotalVentas'];

//traer datos de ventas pendientes
$sentenciaSQL = $pdo->prepare("SELECT count(*) totalVentas FROM ventas WHERE paypalDatos='' "); //-> sentencia si tuviera datos en ventas
$sentenciaSQL->execute();
$registro=$sentenciaSQL->fetch(PDO::FETCH_ASSOC);
$totalVentasPendientes = $registro['totalVentas'];


?>