<?php
// Controlador de Vehículos - Sigue el mismo estilo y estructura que usuario.controlador.php
include_once("../modelos/vehiculo_class.php");
include_once("../utilidades/funciones.php");

class VehiculoControlador{
    
    private $objVehiculo;

    function __construct(){
        $this->objVehiculo = new Vehiculo();
    }

    function obtenerRegistros(){
        header("content-type: application/json");
        echo json_encode($this->objVehiculo->obtenerRegistros());

    }

    function insertar($marca, $modelo, $color, $precio, $imagen){
                $this->objVehiculo -> asignarValores("", $marca, $modelo, $color, $precio, $imagen, "");
                $this->objVehiculo->insertar();
                header("location: ../vistas/listado_vehiculos.php");
    }

    function actualizar($id, $marca, $modelo, $color, $precio, $imagen){
                $this->objVehiculo -> asignarValores($id, $marca, $modelo, $color, $precio, $imagen, "");
                $this->objVehiculo->actualizar();
                header("location: ../vistas/listado_vehiculos.php");
    }

    function eliminar($id){
                $this->objVehiculo -> asignarValores($id, "", "", "", "", "", "");
                $this->objVehiculo->eliminarFisicamente();
                echo "OK";
    }

    function ObtenerPorId($id){
        $this->objVehiculo -> asignarValores($id, "", "", "", "", "", "");
        header("content-type: application/json");
        echo json_encode($this->objVehiculo->ObtenerPorId());
    }
}

$objVehiculoControlador = new VehiculoControlador();
switch($_POST["opcion"]){
    case "obtener_registros":
        $objVehiculoControlador->obtenerRegistros();
        break;
    case "insertar":
        // Validación backend
        $errores = validarDatosVehiculo($_POST["marca"], $_POST["modelo"], $_POST["color"], $_POST["precio"]);
        if (!empty($errores)) {
            // En caso de errores, redirigir de vuelta al formulario
            header("location: ../vistas/formulario_vehiculo.php?error=" . urlencode(implode(", ", $errores)));
            exit;
        }
        $imagen = guardarImagen("../public/img_vehiculos/");
        $objVehiculoControlador->insertar($_POST["marca"], $_POST["modelo"], $_POST["color"], $_POST["precio"], $imagen);
        break;
    case "actualizar":
        // Validación backend
        $errores = validarDatosVehiculo($_POST["marca"], $_POST["modelo"], $_POST["color"], $_POST["precio"]);
        if (!empty($errores)) {
            // En caso de errores, redirigir de vuelta al formulario
            header("location: ../vistas/formulario_vehiculo.php?error=" . urlencode(implode(", ", $errores)));
            exit;
        }
        $imagen = guardarImagen("../public/img_vehiculos/");
        $objVehiculoControlador->actualizar($_POST["id"], $_POST["marca"], $_POST["modelo"], $_POST["color"], $_POST["precio"], $imagen);
        break;
    case "eliminar":
        $objVehiculoControlador->eliminar($_POST["id"]);
        break;
    case "obtener_por_id":
        $objVehiculoControlador->ObtenerPorId($_POST["id"]);
        break;
}
// $objVehiculoControlador -> obtenerRegistros();

?>