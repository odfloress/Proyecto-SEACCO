<?php

  if(isset($_POST['accion'])){
    session_start();
    require "../../conexion/conexion.php";
    

    $usuario=(isset($_POST['usuario']))?$_POST['usuario']:"";
    $token=(isset($_POST['token']))?$_POST['token']:"";
    $token= hash('sha512', $token);

    date_default_timezone_set('America/Guatemala');
      $fecha_actual = date("Y-m-d H:i:s");
     

    // Valida que exista el usuario
    $validar_usuario = "SELECT * FROM tbl_usuarios WHERE USUARIO='$usuario' and TOKEN='$token'";
    $result = mysqli_query($conn, $validar_usuario); 
     if (mysqli_num_rows($result) > 0) { 
            while($row1 = mysqli_fetch_assoc($result))
            {
              $fecha_evaluar = $row1['VENCIMIENTO_TOKEN'];
            }

            if($fecha_actual<=$fecha_evaluar)
            {
              $_SESSION['recuperacion'] = $usuario;
              $_SESSION['nombre'] = $usuario;
              header('Location: ../../vistas/iniciar_sesion/restaurar_contraseña.php');
            }else{
              echo '<script>
                    alert("Su token a expirado");
              </script>';

            }
            

     }else{
         echo '<script>
                    alert("Información no coincide");
              </script>';
      mysqli_close($conn);      
    }
    
    //
  }

?>

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


<!DOCTYPE html>
<html lang="en">
<head>
  <title>Restablecer</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
   <!-- enlace del scritpt para evitar si preciona F12, si preciona Ctrl+Shift+I, si preciona Ctr+u  -->
   <script type="text/javascript" src="../../js/evita_ver_codigo_utilizando_teclas.js"></script>
  <style> 
body {
  background-image: url('../../imagenes/fondo.jpg');
  background-repeat: no-repeat;
  background-attachment: fixed; 
  background-size: 100% 100%;
}

</style>
 
</head>
<body style="background-color:rgb(241, 243, 243);" >
<!-- Inicio evita el click derecho de la pagina -->
<body oncontextmenu="return false">
<!-- Fin evita el click derecho de la pagina --> 


<br><br>
<!-- El Modal -->

  <div  class="modal-dialog" >
    <div class="modal-content " >     

      <!--Inicio Cuerpo del modal -->
      <div class="modal-body ">
        <form action="" method="post">
            <div class="mb-3 mt-3">
            <center><img src="../../imagenes/seacco.jpg" alt="Girl in a jacket" width="150" height="150"><br></center>
            <div class="alert alert-success">
                <strong>¡Hola!</strong> Ingrese el usuario y el token para cambiar su contraseña.
            </div>
            <label for="email" class="form-label">Usuario:</label>
            <input type="text" style="background-color:rgb(240, 244, 245);" name="usuario" id="ingUsuario" class="form-control" placeholder="Ingrese el usuario" autocomplete = "off"  onkeypress="return soloLetras(event);" minlength="3" maxlength="20" onkeyup="mayus(this);" required onblur="quitarespacios(this);" onkeydown="sinespacio(this);">
            <br>
            <label for="">Token:</label>
            <input type="text" style="background-color:rgb(240, 244, 245);" autocomplete = "off" class="form-control" minlength="7" maxlength="7" title="Colocar 7 caracteres" placeholder="Ingrese el token" name="token" required onblur="quitarespacios(this);" onkeydown="sinespacio(this);">
           
            </div>
            
        
            
            <div class="d-grid">
              <button type="submit" name="accion" value="ingresar" class="btn btn-primary btn-block">Ingresar</button>
            </div>
            
        </form>
      </div>
       <!--Fin Cuerpo del modal -->

    </div>
  </div>

</body>
<script type="text/javascript" src="js/evitar_reenvio.js"></script>
</html>
