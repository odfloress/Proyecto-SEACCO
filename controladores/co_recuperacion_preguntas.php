<?php
  require '../../conexion/conexion.php';
  

  // //Variables para recuperar la información de los campos de la vista preguntas_seguridad
  $id_pregunta=(isset($_POST['preguntas']))?$_POST['preguntas']:"";
  $respuesta=(isset($_POST['respuesta']))?$_POST['respuesta']:"";
  $usuario = $_SESSION; 

  $accion=(isset($_POST['accion']))?$_POST['accion']:"";
  
  
  switch($accion){
      case "validar": 
        
        

            // Valida la pregunta y respuesta de la tabla tbl_respuestas_usuario
            $recuperacion = "SELECT * FROM tbl_respuestas_usuario WHERE ID_PREGUNTA='$id_pregunta' and usuario='$usuario[nombre]' and RESPUESTA='$respuesta'";
            $result = mysqli_query($conn, $recuperacion);
            if (mysqli_num_rows($result) > 0) {
                // inicio inserta en la tabla bitacora
                $sql = "INSERT INTO tbl_bitacora (USUARIO, ACCION, OBSERVACION)
                VALUES ('$usuario[nombre]', 'INGRESO', 'EL USUARIO $usuario[nombre] RESPONDIO CORRECTAMENTE LA PREGUNTA')";
                if (mysqli_query($conn, $sql)) {} else {}
                // fin inserta en la tabla bitacora
              // una vez completada  la configuracion de preguntas y respuestas redirecciona a cambio de contraseña
              
              session_destroy($_SESSION['nombre']);
              $_SESSION['recuperacion'] = $usuario;
              header('Location: ../../vistas/iniciar_sesion/restaurar_contraseña.php');
               
             
                      } else {  
                        $sql = "INSERT INTO tbl_bitacora (USUARIO, ACCION, OBSERVACION)
                VALUES ('$usuario[nombre]', 'INTENTO', 'EL USUARIO $usuario[nombre] SE EQUIVOCO EN LA RESPUESTA')";
                if (mysqli_query($conn, $sql)) {} else {} 
                        echo '<script>
                                alert("La informacion no coincide");
                             </script>';
                     mysqli_close($conn);
                              
                              
                             }// fin validar preguntas


            




             
      break;
      case "cancelar": 
        // remove all session variables
        session_unset();

        // destroy the session
        session_destroy();

        header('Location: ../../_login.php');

        break;
        default:
          
          $conn->close();   
  }// Fin del switch, para validar el valor del boton accion


?>
