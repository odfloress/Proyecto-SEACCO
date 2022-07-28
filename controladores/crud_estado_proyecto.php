<?php
  require '../../conexion/conexion.php';
  //para mostrar los datos de la tabla mysql y mostrar en el crud
  $sql = "SELECT * FROM tbl_estados_proyectos";
  $result = mysqli_query($conn, $sql);


  // //Variables para recuperar la información de los campos de la vista estados proyecto
  $id_estados=(isset($_POST['id_estados']))?$_POST['id_estados']:"";
  $nombre=(isset($_POST['nombre']))?$_POST['nombre']:"";

  $usuario1 = $_SESSION;

  //variable para recuperar los botones de la vista estados proyecto  
  $accion=(isset($_POST['accion']))?$_POST['accion']:"";
  
  
  switch($accion){
      //para insertar en la tabla mysl
      case "agregar": 
        // valida si existe un estado con el mismo nombre
        $validar_estados = "SELECT * FROM tbl_estados_proyectos WHERE NOMBRE='$nombre'";
        $result1 = mysqli_query($conn, $validar_estados); 
         if (mysqli_num_rows($result1) > 0) { 
              
         
           echo '<script>
                    alert("Estado ya existe");
                 </script>';
                 mysqli_close($conn);
         }else{ 

                //si no existe un estado permite insertar
                $sql1 = "INSERT INTO tbl_estados_proyectos (NOMBRE)
                VALUES ('$nombre')";
                if (mysqli_query($conn, $sql1)) {
                  // inicio inserta en la tabla bitacora
                  $sql7 = "INSERT INTO tbl_bitacora (USUARIO, ACCION, OBSERVACION)
                  VALUES ('$usuario1[usuario]', 'INSERTO', 'CREO EL ESTADO DE PROYECTO ($nombre)')";
                   if (mysqli_query($conn, $sql7)) {} else { }
              // fin inserta en la tabla bitacora
                  header('Location: ../../vistas/proyectos/vista_estado_proyecto.php');

                } else {
                        echo '<script>
                                alert("Error al tratar de crear el estado");
                              </script>'; mysqli_error($conn);
                       }
                
                mysqli_close($conn);

              }                    

             
      break;

       //para editar en la tabla mysl      
      case "editar";

        // valida si existe un estado con el mismo nombre
        $validar_estados = "SELECT * FROM tbl_estados_proyectos WHERE NOMBRE='$nombre'";
        $result2 = mysqli_query($conn, $validar_estados); 
         if (mysqli_num_rows($result2) > 0) { 
              
         
           echo '<script>
                    alert("No se puede editar, ya existe un estado con ese nombre");
                 </script>';
                 mysqli_close($conn);
         }else{ 

                $sql2 = "UPDATE tbl_estados_proyectos SET NOMBRE='$nombre' WHERE ID_ESTADOS='$id_estados'";
                if (mysqli_query($conn, $sql2)) {
                  $sql8 = "INSERT INTO tbl_bitacora (USUARIO, ACCION, OBSERVACION)
                  VALUES ('$usuario1[usuario]', 'EDITO', 'EDITO EL ESTADO DE PROYECTO ($nombre)')";
                  
                   if (mysqli_query($conn, $sql8)) {} else { }
                 // fin inserta en la tabla bitacora
                   header('Location: ../../vistas/proyectos/vista_estado_proyecto.php');

                }else{
                     echo '<script>
                            alert("Error al tratar de editar estados");
                           </script>'; mysqli_error($conn);
                     }

                mysqli_close($conn);
              }
      
      break;
      
      //para eliminar en la tabla mysl  
      case "eliminar";

      $sql3 = "DELETE FROM tbl_estados_proyectos WHERE ID_ESTADOS='$id_estados'";
      if (mysqli_query($conn, $sql3)) {
            // inicio inserta en la tabla bitacora
        $sql7 = "INSERT INTO tbl_bitacora (USUARIO, ACCION, OBSERVACION)
        VALUES ('$usuario1[usuario]', 'ELIMINO', 'ELIMINO EL ESTADO DE PROYECTO ($nombre)')";
         if (mysqli_query($conn, $sql7)) {} else { }
    // fin inserta en la tabla bitacora
          header('Location: ../../vistas/proyectos/vista_estado_proyecto.php');
      }else{
              echo '<script>
                        alert("Error al tratar de eliminar estado");
                    </script>'; mysqli_error($conn);
           }
        mysqli_close($conn);

      break;
      
      default:
          
          $conn->close();   
  }// Fin del switch, para validar el valor del boton accion


?>
