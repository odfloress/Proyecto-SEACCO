<?php

  if(isset($_POST['accion'])){
    require "../../conexion/conexion.php";
    
    //$contrasena1 = $mysqli->real_scape_string($_POST['nueva_contrasena']);
    //$contrasena2 = $mysqli->real_scape_string($_POST['confirmar_contrasena']);
    $usuario=(isset($_POST['usuario']))?$_POST['usuario']:"";
    $contrasena1=(isset($_POST['nueva_contrasena']))?$_POST['nueva_contrasena']:"";
    $contrasena2=(isset($_POST['confirmar_contrasena']))?$_POST['confirmar_contrasena']:"";
    $_SESSION['usuario'] = $usuario;

    // Valida que exista el usuario
    $validar_usuario = "SELECT * FROM tbl_usuarios WHERE USUARIO='$usuario'";
    $result = mysqli_query($conn, $validar_usuario); 

     if (mysqli_num_rows($result) > 0) { 
      if ($contrasena1 == $contrasena2) {

        // encripta la contraseña
        $contrasena1= hash('sha512', $contrasena1);
        $contrasena2= hash('sha512', $contrasena2);
    
          $conn = new mysqli($servername, $username, $password, $dbname);
          $sql =  "UPDATE tbl_usuarios SET CONTRASENA='$contrasena1' WHERE USUARIO='".$_SESSION['usuario']."'";
            if ($conn->query($sql) === TRUE) {
            echo '<script>
             alert("Contraseña actualizada");
             window.Location = "/_login.php";
          </script>';
                  
                   exit();
             } 
          
        } else {
          echo "Las contraseñas no coinciden";
        }

     }else{
      echo "Usuario incorrecto";
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
                <strong>¡Hola!</strong> Ingrese su nueva contraseña para su usuario.
            </div>
            <label for="email" class="form-label">Usuario:</label>
            <input type="text" style="background-color:rgb(240, 244, 245);" name="usuario" id="ingUsuario" class="form-control" placeholder="Ingrese el usuario" autocomplete = "off"  onkeypress="return soloLetras(event);" minlength="3" maxlength="20" onkeyup="mayus(this);" required onblur="quitarespacios(this);" onkeydown="sinespacio(this);">
            <label for="email" class="form-label">Nueva contraseña:</label>
            <input style="background-color:rgb(240, 244, 245);" type="password" class="form-control" placeholder="Nueva contraseña"  name="nueva_contrasena" id="Ncontrasena" aria-label="Username" aria-describedby="basic-addon1"   minlength="8" maxlength="30" required onblur="quitarespacios(this);" onkeyup="sinespacio(this);" pattern="(?=.*[\d])(?=.*[a-z])(?=.*[A-Z]).{8,}">
            <label for="email" class="form-label">Confirmar nueva contraseña:</label>
            <input style="background-color:rgb(240, 244, 245);" type="password" class="form-control"  placeholder="Confirmar nueva contraseña" name="confirmar_contrasena" id="FNcontrasena" aria-label="Username" aria-describedby="basic-addon1"   minlength="8" maxlength="30" required onblur="quitarespacios(this);" onkeyup="sinespacio(this);" pattern="(?=.*[\d])(?=.*[a-z])(?=.*[A-Z]).{8,}">
            </div>
            
        
            <center><button type="submit" name="accion" class="btn btn-primary btn-block">Enviar</button></center>
            
            
        </form>
      </div>
       <!--Fin Cuerpo del modal -->

    </div>
  </div>

</body>
<script type="text/javascript" src="js/evitar_reenvio.js"></script>
</html>
