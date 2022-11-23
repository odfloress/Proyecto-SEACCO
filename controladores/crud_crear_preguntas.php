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
      /////////////////////////////////// PARA INSERTAR ////////////////////////////////////
      case "agregar": 
        // valida si existe una pregunta con el mismo nombre
        $validar_pregunta = "SELECT * FROM tbl_preguntas WHERE PREGUNTA='$pregunta'";
        $result1 = mysqli_query($conn, $validar_pregunta); 
         if (mysqli_num_rows($result1) > 0) 
         { 
           echo '<script>
                    alert("La pregunta ingresada ya existe, intente con otra");
                 </script>';
                 mysqli_close($conn);
         }else{ 

                //si no existe una pregunta permite insertar
                $sql1 = "INSERT INTO tbl_preguntas (PREGUNTA)
                VALUES ('$pregunta')";
                if (mysqli_query($conn, $sql1)) 
                {
                  $ultimo_id = mysqli_insert_id($conn);  
                  // ////////////// INICIO FUNCION BITACORA /////////////////////
                        include_once 'funcion_bitacora.php';
                        bitacora('INSERTO', 'PREGUNTAS DE SEGURIDAD', 'PREGUNTA', $ultimo_id, 'NUEVO', 'NUEVO');       
                  // ////////////// FIN FUNCION BITACORA ///////////////////////

                  echo '<script>
                          alert("Pregunta creada con éxito");
                          window.location.href="../../vistas/ajustes/vista_preguntas.php";                   
                        </script>';
                        mysqli_close($conn);
                }else{
                      echo '<script>
                              alert("Error al tratar de crear pregunta");
                            </script>'; mysqli_error($conn);
                       }
            }                    

             
      break;

  /////////////////////////////////// PARA EDITAR //////////////////////////////////// 
   case "editar";

   // valida si existe una pregunta con el mismo nombre
    $validar_pregunta = "SELECT * FROM tbl_preguntas WHERE PREGUNTA='$pregunta'";
    $result2 = mysqli_query($conn, $validar_pregunta); 
    if (mysqli_num_rows($result2) > 0) 
    { 
      echo '<script>
              alert("No se puede editar, ya existe una pregunta con ese nombre");
            </script>';
            mysqli_close($conn);
    }else{ 
          $sql2 = "UPDATE tbl_preguntas SET PREGUNTA='$pregunta' WHERE ID_PREGUNTA='$id_pregunta'";
          if (mysqli_query($conn, $sql2)) 
          {
            echo '<script>
                    alert("Pregunta actualizada exitosamente");
                    window.location.href="../../vistas/ajustes/vista_preguntas.php";                   
                  </script>';
                  mysqli_close($conn);
          }else{
                echo '<script>
                        alert("Error al tratar de editar pregunta");
                      </script>'; 
                      mysqli_error($conn);
                     }
         }
         // ////////////// INICIO FUNCION BITACORA /////////////////////
         if($anterior !== $pregunta) ///////////// PREGUNTA
         {
         include_once 'funcion_bitacora.php';
         bitacora('EDITO', 'PREGUNTAS DE SEGURIDAD', 'PREGUNTA', $id_pregunta, $anterior, $pregunta);
         }
         // ////////////// FIN FUNCION BITACORA ///////////////////////
   break;
      
    /////////////////////////////////// PARA ELIMINAR ////////////////////////////////////
    case "eliminar";

    // valida si esta en uso la pregunta en la tabla tbl_respuestas_usuario
        $validar_pregunta = "SELECT * FROM tbl_respuestas_usuario WHERE ID_PREGUNTA='$id_pregunta'";
        $result2 = mysqli_query($conn, $validar_pregunta); 
         if (mysqli_num_rows($result2) > 0)
          { 
            echo '<script>
                    alert("La pregunta seleccionada no se puede eliminar, esta se encuentra en uso");
                  </script>'; 
                  mysqli_error($conn);
          }else{  
                $sql3 = "DELETE FROM tbl_preguntas WHERE ID_PREGUNTA='$id_pregunta'";
                if (mysqli_query($conn, $sql3)) 
                {
                  // ////////////// INICIO FUNCION BITACORA /////////////////////
                  include_once 'funcion_bitacora.php';
                  bitacora('ELIMINO', 'PREGUNTAS DE SEGURIDAD', 'PREGUNTA', $id_pregunta, $anterior, $anterior);       
            // ////////////// FIN FUNCION BITACORA ///////////////////////
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
  }


?>
