<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Vehículo</title>
    <!-- Usando Bootstrap CDN igual que formulario.php -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
</head>
<body>
    <div class="container">
        <!-- Mostrar errores de validación si existen -->
        <?php if (isset($_GET['error'])): ?>
            <div class="alert alert-danger mt-3">
                <?php echo htmlspecialchars($_GET['error']); ?>
            </div>
        <?php endif; ?>
        
        <!-- Formulario siguiendo el mismo patrón que formulario.php -->
        <form action="../controladores/vehiculo.controlador.php" method="POST" enctype="multipart/form-data">
            <input type="hidden" id="opcion" name="opcion" value="insertar">
            <input type="hidden" id="id" name="id" value="">
            
            <div>
                <label for='marca' class="form-label">Marca: </label>
                <input id='marca' placeholder='Ingrese la marca' name="marca" required type="text" class="form-control">
            </div>
            <div>
                <label for='modelo' class="form-label">Modelo: </label>
                <input id='modelo' placeholder="Ingrese el modelo" name="modelo" required type="text" class="form-control">
            </div>
            <div>
                <label for='color' class="form-label">Color: </label>
                <input id='color' placeholder="Ingrese el color" name="color" required type="text" class="form-control">
            </div>
            <div>
                <label for='precio' class="form-label">Precio: </label>
                <input id='precio' placeholder="Ingrese el precio" name="precio" required type="number" min="0" step="0.01" class="form-control">
            </div>
            <div>
                <label class="form-label">Imagen: </label>
                <input name="imagen" type="file" class="form-control">
            </div>
            <div>
                <button type="submit" class="btn btn-primary mt-2">Guardar</button>
                <a href="listado_vehiculos.php" class="btn btn-secondary mt-2">Cancelar</a>
            </div>
        </form>
    </div>
    
    <!-- Bootstrap JS igual que formulario.php -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>

    <script>
        // Validación frontend básica
        document.querySelector('form').addEventListener('submit', function(e) {
            var marca = document.getElementById('marca').value.trim();
            var modelo = document.getElementById('modelo').value.trim();
            var color = document.getElementById('color').value.trim();
            var precio = document.getElementById('precio').value;
            
            // Validar campos no vacíos
            if (!marca || !modelo || !color) {
                alert('Todos los campos son requeridos');
                e.preventDefault();
                return;
            }
            
            // Validar precio numérico >= 0
            if (!precio || isNaN(precio) || parseFloat(precio) < 0) {
                alert('El precio debe ser un número mayor o igual a 0');
                e.preventDefault();
                return;
            }
        });

        // Lógica para distinguir insertar/actualizar usando localStorage igual que formulario.php
        var id = localStorage.getItem("id");
        //alert(id);
        if(id == null){
            document.getElementById("opcion").value = "insertar";
        }else{
            document.getElementById("opcion").value = "actualizar";
            document.getElementById("id").value = id;
            cargarDatos(id);
        }

        function cargarDatos(id){
            var data = new FormData();
            data.append("opcion", "obtener_por_id");
            data.append("id", id);
            fetch("../controladores/vehiculo.controlador.php", {
                method: 'POST', 
                body:data
            }) .then (response => response.json())
            
            .then(response=> {
                if(response) {
                    document.getElementById('marca').value = response.marca || '';
                    document.getElementById('modelo').value = response.modelo || '';
                    document.getElementById('color').value = response.color || '';
                    document.getElementById('precio').value = response.precio || '';
                }
            });
        }
    </script>

</body>
</html>