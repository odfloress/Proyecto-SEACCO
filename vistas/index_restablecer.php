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
        <form action="/action_page.php">
            <div class="mb-3 mt-3">
            <center><img src="seacco.jpg" alt="Girl in a jacket" width="150" height="150"><br></center>
            <div class="alert alert-success">
                <strong>¡Hola!</strong> Ingrese su nueva contraseña para su usuario.
            </div>
            <label for="email" class="form-label">Correo:</label>
            <input style="background-color:rgb(240, 244, 245);" type="email" class="form-control"   name="correo">
            <label for="email" class="form-label">Contraseña:</label>
            <input style="background-color:rgb(240, 244, 245);" type="password" class="form-control"   name="contraseña">
            <label for="email" class="form-label">Confirmar Contraseña:</label>
            <input style="background-color:rgb(240, 244, 245);" type="password" class="form-control"  placeholder="Ingrese el correo" name="con_contraseña">
            </div>
            
        
            <center><button type="button" class="btn btn-primary btn-block">Enviar</button></center>
            
            
            
        </form>
      </div>
       <!--Fin Cuerpo del modal -->


    </div>
  </div>



</body>
</html>
