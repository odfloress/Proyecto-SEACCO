<?php
require 'registrar.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Registrar Usuario</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
  <style> 
body {
  background-image: url('../imagenes/fondo.jpg');
  background-repeat: no-repeat;
  background-attachment: fixed; 
  background-size: 100% 100%;
}

</style>
 
</head>
<body style="background-color:rgb(241, 243, 243);" >

<!-- El Modal -->

  <div  class="modal-dialog" >
    <div class="modal-content " >     

      <!--Inicio Cuerpo del modal -->
      <div class="modal-body ">
        <form action="" method="POST">
            <div class="mb-3 mt-3">
                <center><h4>Registrar usuario</h4></center><br>
                

            <center><img src="../imagenes/seacco.jpg" alt="Girl in a jacket" width="150" height="150"><br></center>

            <label for="email" class="form-label">Nombre:</label>
            <input style="background-color:rgb(240, 244, 245);" type="text" class="form-control"  placeholder="Ingrese el nombre" name="nombre">
            </div>
            <div class="mb-3">
            <label for="pwd" class="form-label">Correo:</label>
            <input style="background-color:rgb(240, 244, 245);" type="email" class="form-control"  placeholder="Ingrese su correo" name="correo">
            </div>
            <div class="mb-3">
            <label for="pwd" class="form-label">Usuario:</label>
            <input style="background-color:rgb(240, 244, 245);" type="text" class="form-control" placeholder="nombre usuario" name="usuario">
            </div>
            <div class="mb-3">
            <label for="pwd" class="form-label">Contraseña:</label>
            <input style="background-color:rgb(240, 244, 245);" type="password" class="form-control"  placeholder="Ingrese la contraseña" name="contrasena">
            </div>
            <div class="d-grid">
            <button type="submit" name="accion" value="registrar" class="btn btn-dark btn-block">Registrar</button>
            
            </div>
            
            
        </form>
      </div>
       <!--Fin Cuerpo del modal -->

     

    </div>
  </div>

  
</body>
<script type="text/javascript" src="evitar_reenvio.js"></script>

</html>
