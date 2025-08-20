<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado de Vehículos</title>
    <!-- Usando Bootstrap CDN igual que listado_usuarios.php -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">

</head>
<body class="container">
    <a href="formulario_vehiculo.php" target="_self" class="btn btn-primary mt-2">Nuevo Vehículo</a>
    <table class="container">
        <tr><td>Marca</td><td>Modelo</td><td>Color</td><td>Precio</td><td>Imagen</td><td>Opciones</td></tr>
        <tbody id="contenido">

        </tbody>
    </table>
    
    <!-- Bootstrap JS igual que listado_usuarios.php -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>

    <script>
        // Limpiar localStorage igual que listado_usuarios.php
        localStorage.clear();
        
        function editar(id) {
           //alert (id);
           localStorage.setItem("id", id);
            window.open("formulario_vehiculo.php", "_self");
        }   
        
        function eliminar(id) {
            if(confirm('¿Está seguro de eliminar este vehículo?')) {
                var data = new FormData();
                data.append("opcion", "eliminar");
                data.append("id", id);
                fetch("../controladores/vehiculo.controlador.php", {
                method: 'POST', 
                body:data
            }) .then (response => response.text()).
            then(response => { ObtenerRegistros();})
            }
        }

        function ObtenerRegistros(){
            var data = new FormData();
            data.append("opcion", "obtener_registros");
            fetch("../controladores/vehiculo.controlador.php", {
                method: 'POST', 
                body:data
            }) .then (response => response.json())
            
            .then(response=> {

                var tBody = document.getElementById("contenido");
                var contenido ="";
                tBody.innerHTML = contenido;
                for (var i = 0; i < response.length; i++) {
                        var imagen = "";
                        if (response[i]["imagen"] != "")
                            imagen = `<img width="100px" src="../public/img_vehiculos/${response[i]["imagen"]}">`;
                        contenido += `<tr><td>${response[i]["marca"]}</td>
                        <td>${response[i]["modelo"]}</td>
                        <td>${response[i]["color"]}</td>
                        <td>$${parseFloat(response[i]["precio"]).toFixed(2)}</td>
                        <td>${imagen}</td>
                        <td><button class="btn btn-success mt-2" onclick="editar(${response[i]["id"]})"> Editar</button></td>
                        <td><button class="btn btn-danger mt-2" onclick="eliminar(${response[i]["id"]})"> Eliminar</button></td>
                    </tr>`;

                }
                tBody.innerHTML = contenido;

        });
    }
        // Cargar registros al inicio igual que listado_usuarios.php
        ObtenerRegistros(); 

       // response.json()).then(response=>console.log(response));
    </script>
    

</body>
</html>