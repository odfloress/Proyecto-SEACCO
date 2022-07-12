<?php
session_start();
if(!isset($_SESSION['usuario'])){
 
        header('Location: ../../_login.php');
        session_unset();
        session_destroy();
        die();
        
}
include '../../controladores/con_config_contraseña.php';


?>

               
              

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Cambio de contraseña</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Librerias externas mostrar pass -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
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
                <label for="sel1" class="form-label">Contraseña Actual:</label>
                <div class="input-group mb-3">
                  <input  id="id_password" type="password" name="contrasena_actual" value="" class="form-control" required minlength="8" maxlength="30" required onblur="quitarespacios(this);" onkeyup="sinespacio(this);" pattern="(?=.*[\d])(?=.*[a-z])(?=.*[A-Z]).{8,}">
                    <div class="input-group-append ">
                              
                              <div class="input-group-text">
                                <span>
                                <i class="far fa-eye" id="togglePassword"  ></i>
                                </span>
                                
                              </div> 
                    </div>
                </div>     
                <!-- <input type="password" name="contrasena_actual" value="" class="form-control" required minlength="8" maxlength="30" required onblur="quitarespacios(this);" onkeyup="sinespacio(this);" pattern="(?=.*[\d])(?=.*[a-z])(?=.*[A-Z]).{8,}"> -->
                
                <label for="sel1" class="form-label">Nueva contraseña</label>
                <div class="input-group  mb-3">
                  <input id="id_password2" type="password" name="nueva_contrasena" value="" class="form-control" required minlength="8" maxlength="30" required onblur="quitarespacios(this);" onkeyup="sinespacio(this);" pattern="(?=.*[\d])(?=.*[a-z])(?=.*[A-Z]).{8,}">
                  <div class="input-group-append ">
                              <div class="input-group-text">
                                <span>
                                <i class="far fa-eye" id="togglePassword2"  ></i>
                                </span>
                                
                              </div> 
                    </div>
                </div>
                
                <!-- <input type="password" name="nueva_contrasena" value="" class="form-control" required minlength="8" maxlength="30" required onblur="quitarespacios(this);" onkeyup="sinespacio(this);" pattern="(?=.*[\d])(?=.*[a-z])(?=.*[A-Z]).{8,}"> -->

                <label for="sel1" class="form-label">Confirmar contraseña</label>
                <div class="input-group mb-3">
                  <input id="id_password3" type="password" name="confirmar_contrasena" value="" class="form-control" required minlength="8" maxlength="30" required onblur="quitarespacios(this);" onkeyup="sinespacio(this);" pattern="(?=.*[\d])(?=.*[a-z])(?=.*[A-Z]).{8,}">
                  <div class="input-group-append ">
                                <div class="input-group-text">
                                  <span>
                                  <i class="far fa-eye" id="togglePassword3"  ></i>
                                    </span>
                                </div> 
                  </div>
                </div>
                  

                <!-- <input type="password" name="confirmar_contrasena" value="" class="form-control" required minlength="8" maxlength="30" required onblur="quitarespacios(this);" onkeyup="sinespacio(this);" pattern="(?=.*[\d])(?=.*[a-z])(?=.*[A-Z]).{8,}"> -->
                

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
    
        <!-- Muestra pass del input contraseña actual -->
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
              <!-- Muestra pass del input  confirmar contraseña a -->
      <script>
        const togglePassword3 = document.querySelector('#togglePassword3');
        const password3 = document.querySelector('#id_password3');

          togglePassword3.addEventListener('click', function (e) {
        // toggle the type attribute
        const type = password3.getAttribute('type') === 'password' ? 'text' : 'password';
        password3.setAttribute('type', type);
        // toggle the eye slash icon
        this.classList.toggle('fa-eye-slash');
          });
      </script>