<?php
//echo "Hola soy index en modulos";

if (isset($_POST["btnLogin"])) {

    include("global/conexionBD.php");

    $txtEmail = ($_POST['txtEmail']);
    $txtPassword = ($_POST['txtPassword']);
                                                                        //llega
    $sentenciaSQL = $pdo->prepare("SELECT * FROM usuarios WHERE correo=:correo AND password=:password");
    //envio informacion
    $sentenciaSQL->bindParam("correo", $txtEmail, PDO::PARAM_STR);
    $sentenciaSQL->bindParam("password", $txtPassword, PDO::PARAM_STR);
    $sentenciaSQL->execute();

    //da la informacion que corresponde a la seleccion de usuario 
    $registro=$sentenciaSQL->fetch(PDO::FETCH_ASSOC);
    print_r($registro);
    $numeroRegistros = $sentenciaSQL->rowCount();
    
    if ($numeroRegistros >= 1) {
        //variable de sesion, doy valor a la sesion
        session_start();
        $_SESSION['usuario'] = $registro;
        echo "Bienvenido";
        header('location: vistaPanel.php');
    } else {
        echo "Usuario no encontrado";
    }

    echo "<br/> hay que validar el correo y la contraseña ";
}

?>