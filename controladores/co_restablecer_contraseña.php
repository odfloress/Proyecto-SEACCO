<?php
  require '../../conexion/conexion.php';
  

  // //Variables para recuperar la información de los campos de la vista preguntas_seguridad
  
  $nueva_contrasena=(isset($_POST['nueva_contrasena']))?$_POST['nueva_contrasena']:"";
  $confirmar_contrasena=(isset($_POST['confirmar_contrasena']))?$_POST['confirmar_contrasena']:"";
  $usuario = $_SESSION; 

  date_default_timezone_set("America/Guatemala");

  $fecha = date("Y-m-d H:i:s");

  $accion=(isset($_POST['accion']))?$_POST['accion']:"";
  switch($accion){
      case "actualizar": 

          if ($nueva_contrasena == $confirmar_contrasena) {

            $confirmar_contrasena= hash('sha512', $confirmar_contrasena);
            $conn = new mysqli($servername, $username, $password, $dbname);
             $sql =  "UPDATE tbl_usuarios SET CONTRASENA='$confirmar_contrasena' WHERE usuario='$usuario[nombre]'";
              if ($conn->query($sql) === TRUE) {
               // inicio inserta en la tabla bitacora
               $sql7 = "INSERT INTO tbl_bitacora (FECHA, USUARIO, OPERACION, PANTALLA, CAMPO, ID_REGISTRO, VALOR_ORIGINAL, VALOR_NUEVO)
                        VALUES ('$fecha', '$usuario[nombre]', 'EDITO', 'CAMBIO DE CLAVE', 'CLAVES', 0,  'ACTUAL', 'NUEVA')";
               if (mysqli_query($conn, $sql7)) {} else {}
               // fin inserta en la tabla bitacora
              
       
                 //Deja en cero los intentos fallidos
                $conn = new mysqli($servername, $username, $password, $dbname);
                $sql =  "UPDATE tbl_usuarios SET intentos=0 WHERE usuario='$usuario[nombre]'";
                if ($conn->query($sql) === TRUE) {

                   // Valida que el usuario este bloqueado
                      $validar_usuario = "SELECT USUARIO, ID_ESTADO_USUARIO FROM tbl_usuarios
                      WHERE USUARIO='$usuario[nombre]' AND ID_ESTADO_USUARIO=3";
                      $result = mysqli_query($conn, $validar_usuario); 
                      if (mysqli_num_rows($result) > 0)
                       {
                        $conn = new mysqli($servername, $username, $password, $dbname);
                        $sql =  "UPDATE tbl_usuarios SET ID_ESTADO_USUARIO=1 WHERE usuario='$usuario[nombre]'";
                        if ($conn->query($sql) === TRUE) {}

                       }

                       echo '<script>
                                alert("Contraseña Actualizada");
                                window.location.href="../../_login";
                            </script>';

                }
                
         
                
session_unset();
           // destroy the session
               session_destroy();
              mysqli_close($conn);
       //  header('Location: ../tablero/vista_tablero.php');
        exit();
               } 
            
          } else {
             
            echo '<script>
                        alert("Las contraseñas no coinciden");
                     </script>';
          }





        
       

        

             
      break;
      
        default:
          
          $conn->close();   
  }// Fin del switch, para validar el valor del boton accion


?>
