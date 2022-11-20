<?php
  require '../../conexion/conexion.php';
  //para mostrar los datos de la tabla mysql y mostrar en el crud
  $sql = "SELECT * FROM tbl_areas";
  $result = mysqli_query($conn, $sql);

// refresaca cada segundo  header("Refresh:1");
  // //Variables para recuperar la información de los campos de la vista roles
  $id_area=(isset($_POST['id_area']))?$_POST['id_area']:"";
  $area7=(isset($_POST['area']))?$_POST['area']:"";
  $anterior=(isset($_POST['nombre_anterior']))?$_POST['nombre_anterior']:"";
  $ESTADOS=(isset($_POST['estado_area']))?$_POST['estado_area']:"";

  
  $usuario1 = $_SESSION;

  //variable para recuperar los botones de la vista roles  
  $accion=(isset($_POST['accion']))?$_POST['accion']:"";
  
  
  switch($accion){
      //para insertar en la tabla mysl
      case "agregar": 
        // valida si existe una profesion con el mismo nombre
        $validar_area = "SELECT * FROM tbl_areas WHERE AREA='$area7'";
        $result1 = mysqli_query($conn, $validar_area); 
         if (mysqli_num_rows($result1) > 0) { 
                
                echo '<script>
                        alert("El nombre del área ya existe, intente con otro");
                      </script>';
                      mysqli_close($conn);
         }else{ 

                    //si no existe la profesion permite insertar
                    $sql1 = "INSERT INTO tbl_areas (AREA, ESTADO)
                    VALUES ('$area7', '$ESTADOS')";
                    if (mysqli_query($conn, $sql1)) {

                         
                        echo '<script>
                                alert("Área creada exitosamente");
                                window.location.href="../../vistas/mantenimiento/vista_area";                   
                            </script>';
                             mysqli_close($conn);
                    } else {
                            echo '<script>
                                    alert("Error al tratar de crear la área");
                                  </script>'; 
                                  mysqli_error($conn);
                           }
                    
                    mysqli_close($conn);

              }                      
      break;

       //para editar en la tabla mysl      
      case "editar";

        // valida si existe la area con el mismo nombre
        $validar_area = "SELECT * FROM tbl_areas WHERE AREA='$area7'";
        $result2 = mysqli_query($conn, $validar_area); 
         if (mysqli_num_rows($result2) > 0) { 
              
                $sql2 = "UPDATE tbl_areas SET ESTADO='$ESTADOS'  WHERE ID_AREA='$id_area'";
                if (mysqli_query($conn, $sql2)) {
                    echo '<script>
                                alert("Edición del estado exitasa");  
                                window.location.href="../../vistas/mantenimiento/vista_area";                   
                          </script>';
                          mysqli_close($conn);
                        }

               // si no existe la profesion con el mismo nombre
              }else{
                        $sql2 = "UPDATE tbl_areas SET AREA='$area7', ESTADO='$ESTADOS'  WHERE ID_AREA='$id_area'";
                        if (mysqli_query($conn, $sql2)) {

                      
                            echo '<script>
                                    alert("Edición exitosa");
                                    window.location.href="../../vistas/mantenimiento/vista_area";                     
                                </script>';
                                mysqli_close($conn);
                                
                        }

              }
      
      break;
      
      //para eliminar en la tabla mysl  
      case "eliminar";

    //validar que no este asignado a un usuario
    $validar_area = "SELECT * FROM tbl_usuarios WHERE ID_AREA='$id_area'";
    $result4 = mysqli_query($conn, $validar_area); 
     if (mysqli_num_rows($result4) > 0) { 
         
         echo '<script>
                 alert("No se puede eliminar el área, esta se encuentra en uso");
                 window.location.href="../../vistas/mantenimiento/vista_area.php";                  
               </script>';
               mysqli_close($conn);

     }else{
                        $sql3 = "DELETE FROM tbl_areas WHERE ID_AREA='$id_area'";
                        if (mysqli_query($conn, $sql3)) {
                           
                            header('Location: ../../vistas/mantenimiento/vista_area.php');
                        }else{
                                echo '<script>
                                        alert("Error al tratar de eliminar el área");
                                    </script>'; mysqli_error($conn);
                            }
                        mysqli_close($conn);
                    
          }

      break;
      
      default:
          
          $conn->close();   
  }


?>
