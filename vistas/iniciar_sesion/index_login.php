<?php
require '../../controladores/co_login.php';
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <title>Login SEACCO</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
  <style> 
body {
  background-image: url('../../imagenes/fondo.jpg');
  background-repeat: no-repeat;
  background-attachment: fixed; 
  background-size: 100% 100%;
}

</style>
 
</head>
<body style="background-color:rgb(241, 243, 243);" >

<!-- inicio oculta el codigo fuente de la pagina -->
<body oncontextmenu="return false">
<!-- Fin oculta el codigo fuente de la pagina --> 
<br><br>
<!-- El Modal -->

  <div  class="modal-dialog" >
    <div class="modal-content " >     
 
      <!--Inicio Cuerpo del modal -->
      <div class="modal-body ">
        <form action="" method="POST">
            <div class="mb-3 mt-3">
            <center><img src="../../imagenes/seacco.jpg" alt="Girl in a jacket" width="150" height="150"><br></center>
           
            <label for="email" class="form-label">Usuario:</label>
            <input style="background-color:rgb(240, 244, 245);" type="text" class="form-control" placeholder="Ingrese el Usuaio" name="correo" required>
            </div>
            <div class="mb-3">
            <label for="pwd" class="form-label">Contraseña:</label>
            <input style="background-color:rgb(240, 244, 245);" type="password" class="form-control"  placeholder="Ingrese la contraseña" name="contrasena" max="10"required pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}">
            </div>
            <div class="d-grid">
            <button type="submit" name="accion" value="ingresar" class="btn btn-dark btn-block">ingresar</button>
            </div>
            
            <a href="index_correo.php">Olvido la contraseña?</a>
        </form>
      </div>
       <!--Fin Cuerpo del modal -->

     

    </div>
  </div>



</body>
<script type="text/javascript" src="../../js/evitar_reenvio.js"></script>
</html>
