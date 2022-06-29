<?php
session_start();
if(!isset($_SESSION['usuario'])){
 
        header('Location: ../../_login.php');
        session_unset();
        session_destroy();
        die();
        
}
include '../../controladores/co_restablecer_contraseña.php';


?>

               
              

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Cambio de contraseña</title>
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
<!-- oncopy="return false" onpaste="return false"  esto no permite copiar ni pegar -->
<body style="background-color:rgb(241, 243, 243);" oncopy="return false" onpaste="return false">
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
              <center><h3>Configuración</h3></center><br>
            <div class="alert alert-success">
            <strong>¡Hola!</strong> Debe cambiar su contraseña antes de ingresar al sistema
            </div>            
           
            <div class="container mt-3">

            
                <label for="sel1" class="form-label">Usuario:</label>
                <input type="text" name="" value="<?php $usuario = $_SESSION; echo $usuario['usuario']; ?>" class="form-control" readonly>
                
                

                <label for="sel1" class="form-label">Nueva contraseña</label>
                <input type="password" name="nueva_contrasena" value="" class="form-control" required pattern="(?=.*[\d])(?=.*[a-z])(?=.*[A-Z]).{8,}">

                <label for="sel1" class="form-label">Confirmar contraseña</label>
                <input type="password" name="confirmar_contrasena" value="" class="form-control" required pattern="(?=.*[\d])(?=.*[a-z])(?=.*[A-Z]).{8,}">
                

            </div>
            </div>
            
            
           
            <div class="d-grid">
            <button type="submit" name="accion" value="actualizar" class="btn btn-dark btn-block">Actualizar</button>
            </div>
          
            
        </form>
      </div>
       <!--Fin Cuerpo del modal -->
    </div>
  </div>



</body>
<script type="text/javascript" src="../../js/evitar_reenvio.js"></script>
</html>
