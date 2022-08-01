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

    <!-- enlace del scritpt para evitar si preciona F12, si preciona Ctrl+Shift+I, si preciona Ctr+u  -->
    <script type="text/javascript" src="js/evita_ver_codigo_utilizando_teclas.js"></script>

</head>

<!-- oncopy="return false" onpaste="return false"  esto no permite copiar ni pegar -->
<body style="background-color:rgb(241, 243, 243);" oncopy="return false" onpaste="return false">


<!-- Inicio evita el click derecho de la pagina -->
<body oncontextmenu="return false">
<!-- Fin evita el click derecho de la pagina --> 
<br><br>


  <div  class="modal-dialog" >
    <div class="modal-content " >     
 
      <!--Inicio Cuerpo del modal -->
      <div class="modal-body ">
        <form action="" method="POST">
            <div class="mb-3 mt-3">
                <center><img src="imagenes/seacco.jpg" alt="Girl in a jacket" width="150" height="150"><br></center>
              
                <label for="usuario" class="form-label">Usuario:</label>
                <input type="text" style="background-color:rgb(240, 244, 245);" name="usuario" class="form-control" 
                placeholder="Ingrese el Usuaio" autocomplete = "off"  onkeypress="return soloLetras(event);" minlength="3" maxlength="20" 
                onkeyup="mayus(this);" required onblur="quitarespacios(this);" onkeydown="sinespacio(this);">
           </div>

            <div class="mb-3">           
                <label for="Contraseña" class="form-label">Contraseña:</label>
                <div class="input-group mb-3">
                <input type="password"   style="background-color:rgb(240, 244, 245);" name="contrasena" id="id_password" class="form-control"
                placeholder="Ingrese la contraseña"   minlength="8" maxlength="30" required onblur="quitarespacios(this);" onkeyup="sinespacio(this);" 
                pattern="(?=.*[\d])(?=.*[a-z])(?=.*[A-Z]).{8,}">
                <div class="input-group-append ">
                            
                          <div class="input-group-text">
                            <span>
                            <i class="far fa-eye" id="togglePassword"  ></i>
                            </span>
                            
                          </div> 
                    </div></div>
            </div>

            <div class="d-grid">
              <button type="submit" name="accion" value="ingresar" class="btn btn-dark btn-block">Ingresar</button>
            </div>
            

            <div class="row">
                <div class="col"> 
                <a href="http://localhost/SEACCO/vistas/iniciar_sesion/metodo_recuperacion">Olvido la contraseña?</a>
                </div>
                <div class="col">
                  <a href="/SEACCO/_registrar">Registrar un usuario</a>
                </div>
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
</script>
<!-- Fin mostrar y ocultar contraseña -->

<!-- Enlace Script para que solo permita letras -->
<script type="text/javascript" src="js/solo_letras.js"></script>

 <!-- Enlace Script para que convierta a mayusculas las teclas que se van pulsando -->
 <script type="text/javascript" src="js/converir_a_mayusculas.js"></script>

 <!-- Enlace Script para quitar espacios en blanco -->
 <script type="text/javascript" src="js/quitar_espacios.js"></script>

</body>
<!-- Enlace Script para evitar reenvio de forulario -->
<script type="text/javascript" src="js/evitar_reenvio.js"></script>
</html>