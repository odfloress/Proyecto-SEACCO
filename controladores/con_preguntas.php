<?php
  require '../../conexion/conexion.php';
  

  // //Variables para recuperar la información de los campos de la vista preguntas_seguridad
  $id_pregunta=(isset($_POST['preguntas']))?$_POST['preguntas']:"";
  $respuesta=(isset($_POST['respuesta']))?$_POST['respuesta']:"";
  $usuario = $_SESSION; 

  $accion=(isset($_POST['accion']))?$_POST['accion']:"";
  
  
  switch($accion){
      case "guardar": 
        
        

            // Valida la configuración de preguntas de la tabla tbl_parametros
            $validar_conf_preguntas = "SELECT * FROM tbl_parametros WHERE PARAMETRO='PREGUNTAS'";
            $result4 = mysqli_query($conn, $validar_conf_preguntas);
            if (mysqli_num_rows($result4) > 0) {
              
                while($row = mysqli_fetch_assoc($result4)) {
                  $pregunta =  $row["VALOR"];
                  

                  // Valida las preguntas en la tabla tbl_usuarios 
                  $validar_pregunta = "SELECT * FROM tbl_usuarios WHERE usuario='$usuario[usuario]' and CANT_PREGUNTAS<$pregunta";
                  $result5 = mysqli_query($conn, $validar_pregunta);
                }//fin del segundo while
                if (mysqli_num_rows($result5) > 0) {
                  
                   
                        // Inserta la respuesta en la tabla tb_respuestas_usuario
                        $sql = "INSERT INTO tbl_respuestas_usuario (ID_PREGUNTA, USUARIO, RESPUESTA)
                        VALUES ('$id_pregunta', '$usuario[usuario]', '$respuesta')";
                        if (mysqli_query($conn, $sql)) {
                         
                              echo '<script>
                                      alert("Pregunta y respuesta guardada con exito");
                                      window.Location = "/vistas/iniciar_sesion/preguntas_seguridad.php";
                                    </script>';                                  
                                  
                                    // Suma las preguntas en la tabla tbl_usuarios y cierra cualquier conexion a la BD
                                      $conn = new mysqli($servername, $username, $password, $dbname);
                                      $sql1 =  "UPDATE tbl_usuarios SET CANT_PREGUNTAS=CANT_PREGUNTAS+1 WHERE USUARIO='$usuario[usuario]'";
                                      if ($conn->query($sql1) === TRUE) {}
                                      mysqli_error($conn);
                                      mysqli_close($conn);
                         }else {
                                echo "Error al guardar la respuesta: " . $sql . "<br>" . mysqli_error($conn); mysqli_close($conn);
                                }            
                         
             
                      } else {  
                   
                               // una vez completada  la configuracion de preguntas y respuestas redirecciona a cambio de contraseña
                              header('Location: ../iniciar_sesion/cambio_contraseña');
                                      exit() ; 
                             }// fin validar preguntas


            }else{echo "no existe la configuracion";
                   mysqli_close($conn);
                 } // Fin del if que valida si existe el parametro Preguntas e inicia el else




             
      break;
      
        default:
          
          $conn->close();   
  }// Fin del switch, para validar el valor del boton accion


?>
