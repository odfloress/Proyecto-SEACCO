<?php
require '../../controladores/co_metodo_recuperacion.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Metodo</title>
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

<body oncopy="return false" onpaste="return false">

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
                    <div class="alert alert-success">
                         <strong>¿Olvidó su contraseña?</strong> No hay problema. Simplemente ingrese su usuario y selecciona el metodo por el cual desea recuperar la contraseña.
                    </div>
                    <label for="email" class="form-label">Usuario:</label>
                        <input type="text" style="background-color:rgb(240, 244, 245);" name="usuario" id="ingUsuario" class="form-control" placeholder="Ingrese el Usuaio" autocomplete = "off"  onkeypress="return soloLetras(event);" minlength="3" maxlength="20" onkeyup="mayus(this);" required onblur="quitarespacios(this);" onkeydown="sinespacio(this);"><br>
                        <div class="d-grid">
                            <button type="submit" name="accion" value="correo" class="btn btn-primary btn-block">Vía correo</button><br>
                            <button type="submit" name="accion" value="pregunta" class="btn btn-primary btn-block">Vía preguntas</button>
                        </div> 
                </div>              
            </form>
        </div>
        <!--Fin Cuerpo del modal -->
     </div>
  </div>

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
<script type="text/javascript" src="../../js/evitar_reenvio.js"></script>
</html>
