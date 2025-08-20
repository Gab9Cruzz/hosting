<?php
// Clase Vehiculo - Sigue el mismo estilo y estructura que usuario_class.php

include_once("../configuraciones/base_datos_vehiculos.php");
include_once("../utilidades/funciones.php");

class Vehiculo{
    private $id;
    private $marca;
    private $modelo;
    private $color;
    private $precio;
    private $imagen;
    private $estado;
    private $conexion;

     public function __construct(){
         global $ip, $puerto, $usuario, $clave, $nombre_bd;

       $this->conexion = new mysqli($ip, $usuario, $clave, $nombre_bd, $puerto);
     }

     function __destruct()
     {
     $this->conexion->close(); //con el parentesis se llama al objeto
     }

    function asignarValores($id, $marca, $modelo, $color, $precio, $imagen, $estado){
        $this->id = $id;
        $this->marca = $marca;
        $this->modelo = $modelo;
        $this->color = $color;
        $this->precio = $precio;
        $this->imagen = $imagen;
        $this->estado = $estado;
   
    }

    function ObtenerRegistros(){

        $this->conexion = new mysqli("localhost", "root", "admin", "ecotec", 3306);
                        // con new se instacia un objeto
        $consulta = "SELECT * FROM vehiculos";
        $resultado = $this->conexion->query($consulta); 
        //var_dump($resultado);
        $arreglo = [];
        if ($resultado->num_rows > 0){ //num_rows devuelve el numero de filas que hay en la consulta es una propedad pq no tiene parentesis
            while($fila = $resultado->fetch_assoc()){ //fetch_object() devuelve un objeto y fetch_assoc() devuelve un array asociativo
                $arreglo[] = $fila;
            }
        } 
        return $arreglo;
    }

         function ObtenerPorId(){

        $this->conexion = new mysqli("localhost", "root", "admin", "ecotec", 3306);
        $consulta = "SELECT * FROM vehiculos WHERE id = '{$this->id}'";
        $resultado = $this->conexion->query($consulta); 
        $arreglo = [];
        if ($resultado->num_rows > 0){ 
            // while($fila = $resultado->fetch_assoc()){
            //     $arreglo[] = $fila;
            // }
            $arreglo = $resultado->fetch_assoc();
        } 
        return $arreglo;
    }

    function insertar(){
        
        try {
            // Nota: Se mantiene concatenación directa de variables por consistencia con usuario_class.php
            // Se recomienda usar prepared statements para mayor seguridad
            $consulta = "INSERT INTO `vehiculos`(`marca`, `modelo`, `color`, `precio`, `imagen`, `estado`) VALUES ('{$this->marca}','{$this->modelo}','{$this->color}','{$this->precio}','{$this->imagen}',1)";
        $resultado = $this->conexion->query($consulta); //si tiene parectesis es una funcion
        var_dump($resultado);

        } catch (Exception $e) {
            genrarBitacora($e->getMessage()); //revisar
            return false;
        }
        
    }

    function actualizar(){
        
        try {
            // Nota: Se mantiene concatenación directa de variables por consistencia con usuario_class.php
            // Se recomienda usar prepared statements para mayor seguridad
            $consulta = "UPDATE `vehiculos` SET `marca`='{$this->marca}', `modelo`='{$this->modelo}', `color`='{$this->color}', `precio`='{$this->precio}', `imagen`='{$this->imagen}' WHERE id = '{$this->id}'";
        $resultado = $this->conexion->query($consulta);
        var_dump($resultado);

        } catch (Exception $e) {
            genrarBitacora($e->getMessage()); // revisar error
            return false;
        }
        
    }

    function eliminarFisicamente(){
        
        try {
            $consulta = "DELETE FROM `vehiculos` WHERE id = '{$this->id}'";
           $resultado = $this->conexion->query($consulta);
        var_dump($resultado);

        } catch (Exception $e) {
            genrarBitacora($e->getMessage()); // revisar error
            return false;
        }
        
    }

    function eliminadoLogico(){
        
        try {
            $consulta = "UPDATE `vehiculos` SET `estado`=0 WHERE id = '{$this->id}'";
        $resultado = $this->conexion->query($consulta);
        var_dump($resultado);

        } catch (Exception $e) {
            genrarBitacora($e->getMessage()); // revisar error
            return false;
        }
        
    }
}

//$objVehiculo = new Vehiculo();
//$objVehiculo->asignarValores("1", "Toyota", "Corolla", "Blanco", "25000", "", 1);
//$objVehiculo->actualizar();
//$objVehiculo->eliminarFisicamente();
//$objVehiculo->eliminadoLogico();
//var_dump($objVehiculo->ObtenerRegistros());
//revisar que no se generan los logs