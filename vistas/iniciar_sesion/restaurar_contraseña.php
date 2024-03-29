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

<?php 
       include '../../conexion/conexion.php';
       $minima_contraseña = "SELECT * FROM tbl_parametros WHERE PARAMETRO='MIN_CONTRASENA'";
       $resultado_minima = mysqli_query($conn, $minima_contraseña);
            while($mostrar_minima = mysqli_fetch_assoc($resultado_minima)) {
                  $parametro_min = $mostrar_minima["VALOR"];
            }
?>
<?php
       $maxima_contraseña = "SELECT * FROM tbl_parametros WHERE PARAMETRO='MAX_CONTRASENA'";
       $resultado_maxima = mysqli_query($conn, $maxima_contraseña);
       while($mostrar_maxima = mysqli_fetch_assoc($resultado_maxima)) {
                  $parametro_max = $mostrar_maxima["VALOR"];
            }
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
  <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
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

<script type="text/javascript" src="../../js/evita_ver_codigo_utilizando_teclas.js"></script>
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
            <strong>¡Hola!</strong> Para realizar el cambio de contraseña debe, colocar su nueva contraseña.
            </div>            
           
            <div class="container mt-3">

          
          
                <input type="hidden" name="" value="<?php $usuario = $_SESSION; echo $usuario['nombre']; ?>" class="form-control" readonly>
                <div class="mb-3">
                <label for="sel1" class="form-label">Nueva contraseña</label>
                <div class="input-group mb-3">
                <input type="password" name="nueva_contrasena" id="id_password" value="" class="form-control"  minlength="<?php echo $parametro_min;?>" maxlength="<?php echo $parametro_max;?>" onkeypress="return clave1(event);" required onblur="quitarespacios(this);" onkeyup="sinespacio(this);" pattern="(?=.*[\d])(?=.*[a-z])(?=.*[A-Z]).{<?php echo $parametro_min;?>,}">
                <div class="input-group-append ">
                <div class="input-group-text">
                            <span>
                            <i class="far fa-eye" id="togglePassword"  ></i>
                            </span>
                          </div> </div></div>
                <div class="mb-3">
                <label for="sel1" class="form-label">Confirmar contraseña</label>
                <div class="input-group mb-3">
                <input type="password" name="confirmar_contrasena" id="id_password2" value="" class="form-control" minlength="<?php echo $parametro_min;?>" maxlength="<?php echo $parametro_max;?>" onkeypress="return clave1(event);" required onblur="quitarespacios(this);" onkeyup="sinespacio(this);" pattern="(?=.*[\d])(?=.*[a-z])(?=.*[A-Z]).{<?php echo $parametro_min;?>,}">
                <div class="input-group-append ">
                <div class="input-group-text">
                            <span>
                            <i class="far fa-eye" id="togglePassword2"  ></i>
                            </span>
                          </div> </div></div>

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


     <!-- Script para ver contraseña de ver contraseña  -->
     <script>
              const togglePassword = document.querySelector('#togglePassword');
              const password = document.querySelector('#id_password');

                togglePassword.addEventListener('click', function (e) {
              // toggle the type attribute
              const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
              password.setAttribute('type', type);
              // toggle the eye slash icon
              this.classList.toggle('fa-eye-slash');
                });
         </script>

              <!-- Muestra pass del input  nueva contraseña a -->
      <script>
        const togglePassword2 = document.querySelector('#togglePassword2');
        const password2 = document.querySelector('#id_password2');

          togglePassword2.addEventListener('click', function (e) {
        // toggle the type attribute
        const type = password2.getAttribute('type') === 'password' ? 'text' : 'password';
        password2.setAttribute('type', type);
        // toggle the eye slash icon
        this.classList.toggle('fa-eye-slash');
          });
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
