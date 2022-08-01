<?php
session_start();
if(!isset($_SESSION['recuperacion'])){
 
        header('Location: ../../_login.php');
        session_unset();
        session_destroy();
        die();
        
}
include '../../controladores/co_restablecer_contraseña.php';


?>
<script>
  function clave1(e) {
  key = e.keyCode || e.which;
  tecla = String.fromCharCode(key).toString();
  letras = "ABCDEFGHIJKLMNÑOPQRSTUVWXZabcdefghijklmnñopqrstuvwxyz0123456789,#$%&/=!¡?¿()*{}[]-_'.@<>";
  
  especiales = [8,13];
  tecla_especial = false;
  for(var i in especiales) {
    if(key == especiales[i]){
      tecla_especial = true;
      break;
    }
  }
  
  if(letras.indexOf(tecla) == -1 && !tecla_especial){
    alert("Sin espacios");
    return false;
  }
}
</script>
               
              

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
              <center><h3>Cambio de contraseña</h3></center><br>
            <div class="alert alert-success">
            <strong>¡Hola!</strong> Para realializar el cambio de contraseña debe colocar su nueva contraseña
            </div>            
           
            <div class="container mt-3">

            
                <label for="sel1" class="form-label">Usuario:</label>
                <input type="text" name="" value="<?php $usuario = $_SESSION; echo $usuario['nombre']; ?>" class="form-control" readonly>

                <label for="sel1" class="form-label">Nueva contraseña</label>
                <input type="password" name="nueva_contrasena" id="contrasena" value="" class="form-control"  minlength="8" maxlength="30" onkeypress="return clave1(event);" required onblur="quitarespacios(this);" onkeyup="sinespacio(this);" pattern="(?=.*[\d])(?=.*[a-z])(?=.*[A-Z]).{8,}">
                <input type="checkbox" onclick="mostrarContrasena()" > Mostrar/Ocultar
                <br>
                <label for="sel1" class="form-label">Confirmar contraseña</label>
                <input type="password" name="confirmar_contrasena" id="contrasena2" value="" class="form-control" minlength="8" maxlength="30" onkeypress="return clave1(event);" required onblur="quitarespacios(this);" onkeyup="sinespacio(this);" pattern="(?=.*[\d])(?=.*[a-z])(?=.*[A-Z]).{8,}">
                <input type="checkbox" onclick="mostrarContrasena2()" > Mostrar/Ocultar

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


  <script>
  function mostrarContrasena(){
    var x = document.getElementById("contrasena");
    if (x.type === "password"){
      x.type = "text";
    }else{
      x.type = "password";
    }
  }
  function mostrarContrasena2(){
    var z = document.getElementById("contrasena2");
    if (z.type === "password"){
      z.type = "text";
    }else{
      z.type = "password";
    }
  }
  </script>


</body>
<script type="text/javascript" src="../../js/evitar_reenvio.js"></script>
</html>
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
