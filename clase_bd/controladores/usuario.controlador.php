<?php
include_once("../modelos/usuario_class.php");
include_once("../utilidades/funciones.php");

class UsuarioControlador{
    
    private $objUsuario;

    function __construct(){
        $this->objUsuario = new Usuario();
    }

    function obtenerRegistros(){
        header("content-type: application/json");
        echo json_encode($this->objUsuario->obtenerRegistros());

    }

    function insertar($nombre, $correo, $imagen){
                $this->objUsuario -> asignarValores("", $nombre, $correo, $imagen, "");
                $this->objUsuario->insertar();
                header("location: ../vistas/listado_usuarios.php");
    }

    function actualizar($id, $nombre, $correo, $imagen){
                $this->objUsuario -> asignarValores($id, $nombre, $correo, $imagen, "");
                $this->objUsuario->actualizar();
                header("location: ../vistas/listado_usuarios.php");
    }

    function eliminar($id){
                $this->objUsuario -> asignarValores($id, "", "", "", "");
                $this->objUsuario->eliminarFisicamente();
                echo "OK";
    }

    function ObtenerPorId($id){
        $this->objUsuario -> asignarValores($id, "", "", "", "");
        header("content-type: application/json");
        echo json_encode($this->objUsuario->ObtenerPorId());
    }
}

$objUsuarioControlador = new UsuarioControlador();
switch($_POST["opcion"]){
    case "obtener_registros":
        $objUsuarioControlador->obtenerRegistros();
        break;
    case "insertar":
        $imagen = guardarImagen("../public/img/");
        $objUsuarioControlador->insertar($_POST["nombre"], $_POST["correo"], $imagen);
        break;
    case "actualizar":
        $imagen = guardarImagen("../public/img/");
        $objUsuarioControlador->actualizar($_POST["id"], $_POST["nombre"], $_POST["correo"], $imagen);
        break;
    case "eliminar":
        $objUsuarioControlador->eliminar($_POST["id"]);
        break;
    case "obtener_por_id":
        $objUsuarioControlador->ObtenerPorId($_POST["id"]);
        break;
}
// $objUsuarioControlador -> obtenerRegistros();

?>