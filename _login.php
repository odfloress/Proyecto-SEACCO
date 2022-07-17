<?php
require 'controladores/co_login.php';
?>


<!DOCTYPE html>
<html lang="en">
<head>
<script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
  <title>Login SEACCO</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
  <style> 
body {
  background-image: url('imagenes/fondo.jpg');
  background-repeat: no-repeat;
  background-attachment: fixed; 
  background-size: 100% 100%;
}

</style>
<?php $ocultar = '';?>
<!-- inicio evitar si preciona F12, si preciona Ctrl+Shift+I, si preciona Ctr+u -->

<script>
document.onkeydown = function(e) {
if(event.keyCode == 123) {
return false;
}
if(e.ctrlKey && e.keyCode == 'E'.charCodeAt(0)){
return false;
}
if(e.ctrlKey && e.shiftKey && e.keyCode == 'I'.charCodeAt(0)){
return false;
}
if(e.ctrlKey && e.shiftKey && e.keyCode == 'J'.charCodeAt(0)){
return false;
}
if(e.ctrlKey && e.keyCode == 'U'.charCodeAt(0)){
return false;
}
if(e.ctrlKey && e.keyCode == 'S'.charCodeAt(0)){
return false;
}
if(e.ctrlKey && e.keyCode == 'H'.charCodeAt(0)){
return false;
}
if(e.ctrlKey && e.keyCode == 'A'.charCodeAt(0)){
return false;
}
if(e.ctrlKey && e.keyCode == 'E'.charCodeAt(0)){
return false;
}
}
</script>
<!-- Fin evitar si preciona F12, si preciona Ctrl+Shift+I, si preciona Ctr+u -->

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
            <center><img src="imagenes/seacco.jpg" alt="Girl in a jacket" width="150" height="150"><br></center>
           
            <label for="email" class="form-label">Usuario:</label>
            <input type="text" style="background-color:rgb(240, 244, 245);" name="usuario" id="ingUsuario" class="form-control" placeholder="Ingrese el Usuaio" autocomplete = "off"  onkeypress="return soloLetras(event);" minlength="3" maxlength="20" onkeyup="mayus(this);" required onblur="quitarespacios(this);" onkeydown="sinespacio(this);">
            
            </div>
            <div class="mb-3">
           
            <label for="pwd" class="form-label">Contraseña:</label>
            <input type="password"   style="background-color:rgb(240, 244, 245);" name="contrasena" id="myInput" class="form-control" placeholder="Ingrese la contraseña" aria-label="Username" aria-describedby="basic-addon1"   minlength="8" maxlength="30" required onblur="quitarespacios(this);" onkeyup="sinespacio(this);" pattern="(?=.*[\d])(?=.*[a-z])(?=.*[A-Z]).{8,}">
            <input type="checkbox" onclick="myFunction()" name="" id=""> Mostrar/Ocultar
          
            </div>
            <div class="d-grid">
            <button type="submit" name="accion" value="ingresar" class="btn btn-dark btn-block">ingresar</button>
            </div>
            

            <div class="row">
                <div class="col"> 
                <a href="http://localhost/Proyecto-SEACCO/vistas/iniciar_sesion/metodo_recuperacion">Olvido la contraseña?</a>
                </div>
                <div class="col">
                <a href="http://localhost/SEACCO/_registrar">Registrar un usuario</a>
                </div>
            </div>

          
            
        </form>
      </div>
       <!--Fin Cuerpo del modal -->

     

    </div>
  </div>
<!-- mostrar y ociltar contraseña -->
  <script>
function myFunction() {
  var x = document.getElementById("myInput");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
}
</script>



  <script>
      function soloLetras(e){
       key = e.keyCode || e.which;
       tecla = String.fromCharCode(key).toLowerCase();
       letras = " áéíóúabcdefghijklmnñopqrstuvwxyz";
       especiales = ["8-37-39-46"];

       tecla_especial = false
       for(var i in especiales){
        if(key == especiales[i]){
          tecla_especial = true;
          break;
        }
      }

      if(letras.indexOf(tecla)==-1 && !tecla_especial){
        return false;
      }
    }
  </script>


    <script type="text/javascript">
  
        function mayus(e) {
          e.value = e.value.toUpperCase();
         }
    </script>


    <script type="text/javascript">

        function sinespacio(e) {

        var cadena =  e.value;
        var limpia = "";
        var parts = cadena.split(" ");
        var length = parts.length;

          for (var i = 0; i < length; i++) {
              nuevacadena = parts[i];
              subcadena = nuevacadena.trim();

          if(subcadena != "") {
             limpia += subcadena + " ";
                }
          }
        limpia = limpia.trim();
        e.value = limpia;

         };
     </script>

 <script type="text/javascript">

    function quitarespacios(e) {

      var cadena =  e.value;
      cadena = cadena.trim();

      e.value = cadena;

    };

  </script>


</body>
<script type="text/javascript" src="js/evitar_reenvio.js"></script>
</html>
