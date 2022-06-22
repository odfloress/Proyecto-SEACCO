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
<!-- <style type="text/css"> 
  .transformacion2 { text-transform: uppercase;
   width: 100%;
  padding: 10px;
  border: 1px solid #ccc;
  border-radius: 4px;
  resize: vertical;
  }   
   </style> -->

   <!-- inicio script para validar que solo sean mayusculas las letras del usuario -->
<script>
function SoloLetras(e) {
  key = e.keyCode || e.which;
  tecla = String.fromCharCode(key).toString();
  letras = "ABCDEFGHIJKLMNÑOPQRSTUVWXZabcdefghijklmnñopqrstuvwxyz";
  
  especiales = [8,13];
  tecla_especial = false;
  for(var i in especiales) {
    if(key == especiales[i]){
      tecla_especial = true;
      break;
    }
  }
  
  if(letras.indexOf(tecla) == -1 && !tecla_especial){
    alert("Ingresar solo mayusculas");
    return false;
  }
}
</script>
<!-- Fin script para validar que solo sean mayusculas las letras del usuario -->
<!-- inicio script para validar que no ingrese espacios en blanco en contraseña -->
<script>
function clave(e) {
  key = e.keyCode || e.which;
  tecla = String.fromCharCode(key).toString();
  letras = "ABCDEFGHIJKLMNÑOPQRSTUVWXZabcdefghijklmnñopqrstuvwxyz0123456789@_-";
  
  especiales = [8,13];
  tecla_especial = false;
  for(var i in especiales) {
    if(key == especiales[i]){
      tecla_especial = true;
      break;
    }
  }
  
  if(letras.indexOf(tecla) == -1 && !tecla_especial){
    alert("Ingresar sin espacios");
    return false;
  }
}
</script>
 <!-- Fin script para validar que no ingrese espacios en blanco en contraseña -->
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
            <center><img src="../../imagenes/seacco.jpg" alt="Girl in a jacket" width="150" height="150"><br></center>
           
            <label for="email" class="form-label">Usuario:</label>
            <input style="background-color:rgb(240, 244, 245);" type="text"  onkeypress="return SoloLetras(event);"  onKeyUP="this.value=this.value.toUpperCase();" class="form-control" autocomplete="off" placeholder="Ingrese el Usuaio" name="usuario" required  >
            </div>
            <div class="mb-3">
            <label for="pwd" class="form-label">Contraseña:</label>
            <input style="background-color:rgb(240, 244, 245);" type="password" onkeypress="return clave(event);" class="form-control"  placeholder="Ingrese la contraseña" name="contrasena" max="10" required pattern="(?=.*[\d])(?=.*[a-z])(?=.*[A-Z]).{8,}">
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

<script>
  function remplazar(elemento){
  let texto = elemento.value
  texto = texto.split(/[^A-Za-z\#\&]+/g)
  texto = texto.join("")
  elemento.value = texto
}
</script>

</body>
<script type="text/javascript" src="../../js/evitar_reenvio.js"></script>
</html>
