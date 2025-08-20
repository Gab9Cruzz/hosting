<?php

function genrarBitacora($cadena){
    $archivo = fopen("../modelos/logs.txt", "a+");
    fwrite($archivo, date("Y-m-d H:i:s"). " - " .$cadena.PHP_EOL);
    fclose($archivo);
}

function guardarImagen($directorioDestino){
    $archivo = explode(".", $_FILES["imagen"]["name"]);
    $nombreFinal = uniqid() . "." . $archivo[count($archivo)-1];
    move_uploaded_file($_FILES["imagen"]["tmp_name"], $directorioDestino . $nombreFinal);
    return $nombreFinal;
}

?>

 