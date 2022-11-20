<?php
  require '../../conexion/conexion.php';
  //para mostrar los datos de la tabla mysql y mostrar en el crud
  $sql = "SELECT * FROM tbl_estado_asignacion";
  $result = mysqli_query($conn, $sql);

  // //Variables para recuperar la información de los campos de la vista 
  $id_estado=(isset($_POST['id_estado']))?$_POST['id_estado']:"";
  $estado=(isset($_POST['estado']))?$_POST['estado']:"";
  $anterior=(isset($_POST['nombre_anterior']))?$_POST['nombre_anterior']:"";
  $ESTADOS=(isset($_POST['estados_asignacion']))?$_POST['estados_asignacion']:"";
  
  $usuario1 = $_SESSION;

  //variable para recuperar los botones de la vista roles  
  $accion=(isset($_POST['accion']))?$_POST['accion']:"";
  
  
  switch($accion){
      //para insertar en la tabla mysl
      case "agregar": 
        // valida si existe un estado con el mismo nombre
        $validar_estado = "SELECT * FROM tbl_estado_asignacion WHERE ESTADO_ASIGNACION='$estado'";
        $result1 = mysqli_query($conn, $validar_estado); 
         if (mysqli_num_rows($result1) > 0) { 
                
                echo '<script>
                        alert("El nombre de estado ingresado ya existe, intente con otro");
                      </script>';
                      mysqli_close($conn);
         }else{ 

                    //si no existe el estado permite insertar
                    $sql1 = "INSERT INTO tbl_estado_asignacion (ESTADO_ASIGNACION, ESTADOS)
                    VALUES ('$estado', '$ESTADOS')";
                    if (mysqli_query($conn, $sql1)) {

                        
                        echo '<script>
                                alert("Estado creado con éxito");
                                window.location.href="../../vistas/mantenimiento/vista_estados_asignacion.php";                   
                            </script>';
                             mysqli_close($conn);
                    } else {
                            echo '<script>
                                    alert("Error al tratar de crear el estado");
                                  </script>'; 
                                  mysqli_error($conn);
                           }
                    
                    mysqli_close($conn);

              }                      
      break;

       //para editar en la tabla mysl      
      case "editar";

        // valida si existe el estado con el mismo nombre
        $validar_estado= "SELECT * FROM tbl_estado_asignacion WHERE ESTADO_ASIGNACION='$estado'";
        $result2 = mysqli_query($conn, $validar_estado); 
         if (mysqli_num_rows($result2) > 0) { 
                $sql2 = "UPDATE tbl_estado_asignacion SET  ESTADOS='$ESTADOS'  WHERE ID_ESTADO_ASIGNACION='$id_estado'";
                if (mysqli_query($conn, $sql2)) {

   
                    echo '<script>
                                alert("Edición del estado exitasa"); 
                                window.location.href="../../vistas/mantenimiento/vista_estados_asignacion.php";                   
                          </script>';
                                            
                          mysqli_close($conn);

                        }
               // si no existe el estado con el mismo nombre
              }else{
                        $sql2 = "UPDATE tbl_estado_asignacion SET ESTADO_ASIGNACION='$estado', ESTADOS='$ESTADOS'  WHERE ID_ESTADO_ASIGNACION='$id_estado'";
                        if (mysqli_query($conn, $sql2)) {

                           
                            echo '<script>
                                         alert("Edición exitosa");
                                    window.location.href="../../vistas/mantenimiento/vista_estados_asignacion.php";                     
                                </script>';
                                mysqli_close($conn);
                                
                        }

              }
      
      break;
      
      //para eliminar en la tabla mysl  
      case "eliminar";

    //validar que no este asignado a un usuario
    $validar_estado = "SELECT * FROM tbl_asignaciones WHERE ID_ESTADO_ASIGNACION='$id_estado'";
    $result7 = mysqli_query($conn, $validar_estado); 
     if (mysqli_num_rows($result7) > 0) { 
         
         echo '<script>
                 alert("No se puede eliminar el estado, este se encuentra en uso");
                 window.location.href="../../vistas/mantenimiento/vista_estados_asignacion.php";                   
               </script>';
               mysqli_close($conn);

     }else{
                        $sql3 = "DELETE FROM tbl_estado_asignacion WHERE ID_ESTADO_ASIGNACION='$id_estado'";
                        if (mysqli_query($conn, $sql3)) {
                            
                            header('Location: ../../vistas/mantenimiento/vista_estados_asignacion.php');
                        }else{
                                echo '<script>
                                        alert("Error al tratar de eliminar el estado");
                                    </script>'; mysqli_error($conn);
                            }
                        mysqli_close($conn);
                    
          }

      break;
      
      default:
          
          $conn->close();   
  }


?>
