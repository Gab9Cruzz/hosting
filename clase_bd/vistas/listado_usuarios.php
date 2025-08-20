<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado de Usuarios</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">

</head>
<body class="container">
    <a href="formulario.php" target="_self" class="btn btn-primary mt-2">Nuevo Usuario</a>
    <table  class="container">
        <tr><td>Nombre</td><td>Correo</td><td>Imagen</td><td>Opciones</td></tr>
        <tbody id="contenido">

        </tbody>
    </table>
           <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>

    <script>
        localStorage.clear();
        function editar(id) {
           //alert (id);
           localStorage.setItem("id", id);
            window.open("formulario.php", "_self");
        }   
        function eliminar(id) {
            var data = new FormData();
            data.append("opcion", "eliminar_registro");
            data.append("id", id);
            fetch("../controladores/usuario.controlador.php", {
            method: 'POST', 
            body:data
        }) .then (response => response.text()).
        then(response => { ObtenerRegistros();})
        }

        

        function ObtenerRegistros(){
        var data = new FormData();
        data.append("opcion", "obtener_registros");
        fetch("../controladores/usuario.controlador.php", {
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
                        imagen = `<img width="100px" src="../public/imagenes/${response[i]["imagen"]}">`;
                    contenido += `<tr><td>${response[i]["nombre"]}</td>
                    <td>${response[i]["correo"]}</td>
                    <td>${imagen}</td>
                    <td><button class="btn btn-success mt-2" onclick="editar(${response[i]["id"]})"> Editar</button></td>
                    <td><button class="btn btn-danger mt-2" onclick="eliminar(${response[i]["id"]})"> Eliminar</button></td>
                </tr>`;

            }
            tBody.innerHTML = contenido;

    });
}
        ObtenerRegistros(); 

       // response.json()).then(response=>console.log(response));
    </script>
    


</body>
</html>
