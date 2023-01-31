<?php

$mensaje = "";
if(isset($_POST['btnAccion'])){
switch($_POST['btnAccion']){

    case 'Agregar':
        if(is_numeric( openssl_decrypt($_POST['id'],COD,KEY))){
                $ID = openssl_decrypt($_POST['id'], COD, KEY);
                $mensaje = "Ok ID correcto" . $ID;

        }else{
                $mensaje = "Upsss...ID incorrecto".$ID;
        }
        if(is_string( openssl_decrypt($_POST['nombreP'],COD,KEY))){
            $NOMBRE= openssl_decrypt($_POST['nombreP'], COD, KEY);
            $mensaje = "Ok nombre" .$NOMBRE."<br/>";
            } else {
                $mensaje = "Upsss...Algo paso con el nombre" ."<br/>". $NOMBRE;
                break;}

                if(is_numeric( openssl_decrypt($_POST['cantidadP'],COD,KEY))){
                    $CANTIDAD= openssl_decrypt($_POST['cantidadP'], COD, KEY);
                    $mensaje = "Ok cantidad" .$CANTIDAD."<br/>";
                    } else {
                        $mensaje = "Upsss...Algo paso con la cantidad" ."<br/>". $CANTIDAD;
                        break;}

                        if(is_numeric( openssl_decrypt($_POST['precioP'],COD,KEY))){
                            $PRECIO= openssl_decrypt($_POST['precioP'], COD, KEY);
                            $mensaje = "Ok precio" .$PRECIO."<br/>";
                            } else {
                                $mensaje = "Upsss...Algo paso con el precio" ."<br/>". $PRECIO;
                                break;}
        





            break;
}
}

?>