<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
</head>
<body>
    <div class="container">
    <form action="../controladores/usuario.controlador.php" method="POST" enctype="multipart/form-data">
    <input type="hidden" id="opcion" name="opcion" value="insertar">
        
    
    <div>
            <label for='nombre' class="form-label">Nombre: </label>
            <input id='nombre' placeholder='no Ingrese su nombre' name="nombre" required type="text" class="form-control">
        </div>
        <div>
            <label for = 'correo' class="form-label">Correo: </label>
            <input require id='correo' placeholder="Ingrese su correo" name="correo" type="text" class="form-control">
        </div>
        <div>
             <label  class="form-label">Imagen: </label>
            <input  name="imagen"  type="file" class="form-control">
        </div>
         <div>
            <button type="submit" class="btn btn-primary mt-2">guardar</button>
        </div>
        

    </form>
    </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>

        <script>
        var id = localStorage.getItem("id");
        //alert(id);
        if(id == null){
            document.getElementById("opcion").value = "insertar";
        }else{
            document.getElementById("opcion").value = "actualizar";
            cargarDatos(id);
        }

        
         function cargarDatos(id){
        var data = new FormData();
        data.append("opcion", "obtener_por_id");
        data.append("id", id);
        fetch("../controladores/usuario.controlador.php", {
            method: 'POST', 
            body:data
        }) .then (response => response.json())
        
        .then(response=> {


    });
}

</script>

    </body>
</html>