<?php
            //Controlador para crear las preguntas!!

  require '../../conexion/conexion.php';
  //para mostrar los datos de la tabla mysql y mostrar en el crud
  $sql = "SELECT * FROM tbl_preguntas";
  $result = mysqli_query($conn, $sql);


  // //Variables para recuperar la información de los campos de la vista preguntas
  $id_pregunta=(isset($_POST['id_pregunta']))?$_POST['id_pregunta']:"";
  $pregunta=(isset($_POST['pregunta']))?$_POST['pregunta']:"";
  $anterior=(isset($_POST['anterior']))?$_POST['anterior']:"";

    //variable de sesion
    $usuario1 = $_SESSION;

  //variable para recuperar los botones de la vista preguntas de productos  
  $accion=(isset($_POST['accion']))?$_POST['accion']:"";
  
  
  switch($accion){
      //para insertar en la tabla mysl
      case "agregar": 
        // valida si existe una pregunta con el mismo nombre
        $validar_pregunta = "SELECT * FROM tbl_preguntas WHERE PREGUNTA='$pregunta'";
        $result1 = mysqli_query($conn, $validar_pregunta); 
         if (mysqli_num_rows($result1) > 0) { 
              
         
           echo '<script>
                    alert("Pregunta ya existe");
                 </script>';
                 mysqli_close($conn);
         }else{ 

                //si no existe una pregunta permite insertar
                $sql1 = "INSERT INTO tbl_preguntas (PREGUNTA)
                VALUES ('$pregunta')";
                if (mysqli_query($conn, $sql1)) {

                  // inicio inserta en la tabla bitacora
                  $sql7 = "INSERT INTO tbl_bitacora (USUARIO, ACCION, OBSERVACION)
                  VALUES ('$usuario1[usuario]', 'INSERTO', 'CREO LA PREGUNTA ($pregunta)')";
                  if (mysqli_query($conn, $sql7)) {} else { }
                  // fin inserta en la tabla bitacora
                  echo '<script>
                  alert("Pregunta creada con exito");
                  window.location.href="../../vistas/ajustes/vista_preguntas.php";                   
                </script>';
                 

                } else {
                        echo '<script>
                                alert("Error al tratar de crear pregunta");
                              </script>'; mysqli_error($conn);
                       }
                
                mysqli_close($conn);

              }                    

             
      break;

       //para editar en la tabla mysl      
      case "editar";

        // valida si existe una pregunta con el mismo nombre
        $validar_pregunta = "SELECT * FROM tbl_preguntas WHERE PREGUNTA='$pregunta'";
        $result2 = mysqli_query($conn, $validar_pregunta); 
         if (mysqli_num_rows($result2) > 0) { 
          // inicio inserta en la tabla bitacora
          $sql9 = "INSERT INTO tbl_bitacora (USUARIO, ACCION, OBSERVACION)
          VALUES ('$usuario1[usuario]', 'INTENTO', 'NO LOGRO INSERTAR LA PREGUNTA POR QUE YA EXISTE')";
          if (mysqli_query($conn, $sql9)) {} else { }
          // fin inserta en la tabla bitacora         
           echo '<script>
                    alert("No se puede editar, ya existe una pregunta con ese nombre");
                 </script>';
                 mysqli_close($conn);
         }else{ 

                $sql2 = "UPDATE tbl_preguntas SET PREGUNTA='$pregunta' WHERE ID_PREGUNTA='$id_pregunta'";
                if (mysqli_query($conn, $sql2)) {

                  // inicio inserta en la tabla bitacora
                  $sql9 = "INSERT INTO tbl_bitacora (USUARIO, ACCION, OBSERVACION)
                  VALUES ('$usuario1[usuario]', 'EDITO', 'RENOMBRO LA PREGUNTA ($anterior) A ($pregunta)')";
                  if (mysqli_query($conn, $sql9)) {} else { }
                  // fin inserta en la tabla bitacora

                  echo '<script>
                  alert("Pregunta editada con exito");
                  window.location.href="../../vistas/ajustes/vista_preguntas.php";                   
                </script>';

                }else{
                     echo '<script>
                            alert("Error al tratar de editar pregunta");
                           </script>'; mysqli_error($conn);
                     }

                mysqli_close($conn);
              }
      
      break;
      
      //para eliminar en la tabla mysl  --
      case "eliminar";

              // valida si esta en uso la pregunta en la tabla tbl_respuestas_usuario
        $validar_pregunta = "SELECT * FROM tbl_respuestas_usuario WHERE ID_PREGUNTA='$id_pregunta'";
        $result2 = mysqli_query($conn, $validar_pregunta); 
         if (mysqli_num_rows($result2) > 0)
          { 
             // inicio inserta en la tabla bitacora
             $sql9 = "INSERT INTO tbl_bitacora (USUARIO, ACCION, OBSERVACION)
             VALUES ('$usuario1[usuario]', 'INTENTO', 'NO LOGRO ELIMINAR LA PREGUNTA POR QUE ESTABA EN USO')";
             if (mysqli_query($conn, $sql9)) {} else { }
             // fin inserta en la tabla bitacora
            echo '<script>
                    alert("No se puede eliminar ya que la pregunta  esta en uso");
                  </script>'; 
                  mysqli_error($conn);
          }else{  

                $sql3 = "DELETE FROM tbl_preguntas WHERE ID_PREGUNTA='$id_pregunta'";
                if (mysqli_query($conn, $sql3)) {
                  // inicio inserta en la tabla bitacora
                  $sql9 = "INSERT INTO tbl_bitacora (USUARIO, ACCION, OBSERVACION)
                  VALUES ('$usuario1[usuario]', 'ELIMINO', 'ELIMINO LA PREGUNTA ($anterior)')";
                  
                  if (mysqli_query($conn, $sql9)) {} else { }
                  // fin inserta en la tabla bitacora

                    header('Location: ../../vistas/ajustes/vista_preguntas.php');
                }else{
                        echo '<script>
                                  alert("Error al tratar de eliminar categoria");
                              </script>'; mysqli_error($conn);
                    }
                  mysqli_close($conn);
                }

      break;
      
      default:
          
          $conn->close();   
  }// Fin del switch, para validar el valor del boton accion


?>
