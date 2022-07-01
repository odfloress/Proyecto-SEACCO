
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Restablecer</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
  <style> 
body {
  background-image: url('fondo.jpg');
  background-repeat: no-repeat;
  background-attachment: fixed; 
  background-size: 100% 100%;
}

</style>
 
</head>
<body style="background-color:rgb(241, 243, 243);" >


<br><br>
<!-- El Modal -->

  <div  class="modal-dialog" >
    <div class="modal-content " >     

      <!--Inicio Cuerpo del modal -->
      <div class="modal-body ">
        <form action="" method="post">
            <div class="mb-3 mt-3">
            <center><img src="seacco.jpg" alt="Girl in a jacket" width="150" height="150"><br></center>
            <div class="alert alert-success">
                <strong>¡Hola!</strong> Ingrese su nueva contraseña para su usuario.
            </div>
            <label for="email" class="form-label">Nueva contraseña:</label>
            <input style="background-color:rgb(240, 244, 245);" type="password" class="form-control" placeholder="Nueva contraseña"  name="nueva_contrasena">
            <label for="email" class="form-label">Confirmar nueva contraseña:</label>
            <input style="background-color:rgb(240, 244, 245);" type="password" class="form-control"  placeholder="Confirmar nueva contraseña" name="confirmar_contrasena">
            </div>
            
        
            <center><button type="submit" name="accion" class="btn btn-primary btn-block">Enviar</button></center>
            
            
        </form>
      </div>
       <!--Fin Cuerpo del modal -->

    </div>
  </div>

</body>
</html>
