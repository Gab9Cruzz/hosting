<?php

include_once("../configuraciones/base_datos.php");
include_once("../utilidades/funciones.php");

class Usuario{
    private $id;
    private $nombre;
    private $correo;
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

    function asignarValores($id, $nombre, $correo, $imagen, $estado){
        $this->id = $id;
        $this->nombre = $nombre;
        $this->correo = $correo;
        $this->imagen = $imagen;
        $this->estado = $estado;
   
    }

    function ObtenerRegistros(){

        $this->conexion = new mysqli("localhost", "root", "admin", "prueba", 3306);
                        // con new se instacia un objeto
        $consulta = "SELECT * FROM usuarios";
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

        $this->conexion = new mysqli("localhost", "root", "admin", "prueba", 3306);
        $consulta = "SELECT * FROM usuarios WHERE id = '{$this->id}'";
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
            $consulta = "INSERT INTO `usuarios`(`nombre`, `correo`, `imagen`, `estado`) VALUES ('{$this->nombre}','{$this->correo}','{$this->imagen}',1)";
        $resultado = $this->conexion->query($consulta); //si tiene parectesis es una funcion
        var_dump($resultado);

        } catch (Exception $e) {
            genrarBitacora($e->getMessage()); //revisar
            return false;
        }
        
    }

    function actualizar(){
        
        try {
            $consulta = "UPDATE `usuarios` SET `nombre`='{$this->nombre}', `correo`='{$this->correo}', `imagen`='{$this->imagen}' WHERE id = '{$this->id}'";
        $resultado = $this->conexion->query($consulta);
        var_dump($resultado);

        } catch (Exception $e) {
            genrarBitacora($e->getMessage()); // revisar error
            return false;
        }
        
    }

    function eliminarFisicamente(){
        
        try {
            $consulta = "DELETE FROM `usuarios` WHERE id = '{$this->id}'";
           $resultado = $this->conexion->query($consulta);
        var_dump($resultado);

        } catch (Exception $e) {
            genrarBitacora($e->getMessage()); // revisar error
            return false;
        }
        
    }

    function eliminadoLogico(){
        
        try {
            $consulta = "UPDATE `usuarios` SET `estado`=0 WHERE id = '{$this->id}'";
        $resultado = $this->conexion->query($consulta);
        var_dump($resultado);

        } catch (Exception $e) {
            genrarBitacora($e->getMessage()); // revisar error
            return false;
        }
        
    }
}

//$objUsuario = new Usuario();
//$objUsuario->asignarValores("7", "Melina", "melina@gmail.com", "", 1);
//$objUsuario->actualizar();
//$objUsuario->eliminarFisicamente();
//$objUsuario->eliminadoLogico();
//var_dump($objUsuario->ObtenerRegistros());
//revisar que no se generan los logs
