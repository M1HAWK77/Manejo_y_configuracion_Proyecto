<?php
include('config.php');

//Conexion a base de datos constantes de config
$servidor = "mysql:dbname=".BD.";host=".SERVIDOR;

try{
    //array para cambiar codificacion de la base de datos
    $pdo = new PDO($servidor, PASSWORD, "", array(PDO::MYSQL_ATTR_INIT_COMMAND=>"SET NAMES utf8"));
    echo "<script> alert('Conectado......')</script>";
}catch(PDOException $e){
    echo "<script> alert('Error.....')</script>";
    die();
}
