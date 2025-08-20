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

// Función de validación para datos de vehículos - agregada de forma no disruptiva
if (!function_exists('validarDatosVehiculo')) {
    function validarDatosVehiculo($marca, $modelo, $color, $precio) {
        $errores = [];
        
        // Validar campos no vacíos
        if (empty(trim($marca))) {
            $errores[] = "La marca es requerida";
        }
        if (empty(trim($modelo))) {
            $errores[] = "El modelo es requerido";
        }
        if (empty(trim($color))) {
            $errores[] = "El color es requerido";
        }
        
        // Validar precio numérico >= 0
        if (empty(trim($precio))) {
            $errores[] = "El precio es requerido";
        } elseif (!is_numeric($precio) || floatval($precio) < 0) {
            $errores[] = "El precio debe ser un número mayor o igual a 0";
        }
        
        return $errores;
    }
}

?>

 