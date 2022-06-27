<?php
  require '../conexion/conexion.php';

  //Variables para recuperar la información de los campos de la vista preguntas_seguridad
  $pregunta=(isset($_POST['preguntas']))?$_POST['preguntas']:"";
  $respuesta=(isset($_POST['respuesta']))?$_POST['respuesta']:"";
   
  $accion=(isset($_POST['accion']))?$_POST['accion']:"";

  switch($accion){
      case "guardar": 

        // validar que exista la pregunta en la tabla tbl_preguntas
           $validar_pregunta = "SELECT * FROM tbl_preguntas WHERE PREGUNTA='$pregunta'";
           $result = mysqli_query($conn, $validar_pregunta);
           if (mysqli_num_rows($result) > 0) {
                
                // Inserta la respuesta en la tabla tbl_respuestas_usuario
                $sql = "INSERT INTO tbl_respuestas_usuario (ID_PREGUNTA, RESPUESTA)
                        VALUES ('2', '$respuesta')";
                       
                       if (mysqli_query($conn, $sql)) {
                            echo '<script>
                                    alert("Respuesta guardada con exito");
                                    window.Location = "/login.php";
                                  </script>';

                                // Suma las preguntas en la tabla tbl_usuarios 
                                 $conn = new mysqli($servername, $username, $password, $dbname);
                                 $sql =  "UPDATE tbl_usuarios SET CANT_PREGUNTAS=CANT_PREGUNTAS+1";
                                 if ($conn->query($sql) === TRUE) {}   
                       }else{
                                  echo '<script>
                                            alert("Error al intentar guardar la respuesta");
                                            window.Location = "/login.php";
                                        </script>';                                  
                                         mysqli_error($conn);
                            } 
               
    
            } // fin del else principal
             
      break;
      
        default:
          
          $conn->close();   
  }// Fin del switch, para validar el valor del boton accion


?>
