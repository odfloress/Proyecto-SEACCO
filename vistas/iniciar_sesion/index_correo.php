
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
  background-image: url('../imagenes/fondo.jpg');
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
        <form action="">
            <div class="mb-3 mt-3">
            <center><img src="../imagenes/seacco.jpg" alt="Girl in a jacket" width="150" height="150"><br></center>
            <div class="alert alert-success">
                <strong>¿Olvidó su contraseña?</strong> No hay problema. Simplemente déjenos saber su dirección de correo electrónico y le enviaremos un enlace para restablecer la contraseña que le permitirá elegir una nueva.
            </div>
            <label for="email" class="form-label">Correo:</label>
            <input style="background-color:rgb(240, 244, 245);" type="email" class="form-control"  placeholder="Ingrese el correo" name="correo">
            </div>
        
            <button type="button" class="btn btn-primary btn-block">Enviar</button>
            
            
            
        </form>
      </div>
       <!--Fin Cuerpo del modal -->

     

    </div>
  </div>



</body>
</html>
