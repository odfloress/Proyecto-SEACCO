<?php
session_start();
if(!isset($_SESSION['nombre'])){
 
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
   <!-- enlace del scritpt para evitar si preciona F12, si preciona Ctrl+Shift+I, si preciona Ctr+u  -->
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
              <center><h3>Configuración</h3></center><br>
              <div class="alert alert-success">
                <strong>¡Hola!</strong> ¿Desea cambiar la contraseña?
              </div>            
           
            <div class="container mt-3">
                <label for="sel1" class="form-label">Usuario:</label>
                <input type="text" name="" value="<?php $usuario = $_SESSION; echo $usuario['nombre']; ?>" class="form-control" readonly>
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
                   
                <div class="d-grid">
                  <button type="submit" name="accion" value="actualizar" class="btn btn-dark btn-block">Actualizar</button>
                </div>
          </form><br>
            <form action="" method="POST">
              <div class="d-grid">
                      <button type="submit" name="accion" value="cancelar" class="btn btn-danger btn-block" onclick="return confirm('¿Desea cancelar cambio de contraseña?')">Cancelar</button>
                    </div>
            </form>
            </div>
            </div>

      </div>
       <!--Fin Cuerpo del modal -->
    </div>
  </div>



</body>
<script type="text/javascript" src="../../js/evitar_reenvio.js"></script>
</html>
<!-- Enlace Script para quitar espacios en blanco -->
<script type="text/javascript" src="../../js/quitar_espacios.js"></script>
    
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