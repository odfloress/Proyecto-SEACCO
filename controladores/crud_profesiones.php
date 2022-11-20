<?php
  require '../../conexion/conexion.php';
  //para mostrar los datos de la tabla mysql y mostrar en el crud
  $sql = "SELECT * FROM tbl_profesiones";
  $result = mysqli_query($conn, $sql);

// refresaca cada segundo  header("Refresh:1");
  // //Variables para recuperar la información de los campos de la vista roles
  $id_profesion=(isset($_POST['id_profesion']))?$_POST['id_profesion']:"";
  $profesion7=(isset($_POST['profesion']))?$_POST['profesion']:"";
  $anterior=(isset($_POST['nombre_anterior']))?$_POST['nombre_anterior']:"";
  $ESTADOS=(isset($_POST['estado_profesion']))?$_POST['estado_profesion']:"";

  $usuario1 = $_SESSION;

  //variable para recuperar los botones de la vista roles  
  $accion=(isset($_POST['accion']))?$_POST['accion']:"";
  
  
  switch($accion){
      //para insertar en la tabla mysl
      case "agregar": 
        // valida si existe una profesion con el mismo nombre
        $validar_profesion = "SELECT * FROM tbl_profesiones WHERE PROFESION='$profesion7'";
        $result1 = mysqli_query($conn, $validar_profesion); 
         if (mysqli_num_rows($result1) > 0) { 
                
                echo '<script>
                        alert("El nombre de la profesión ya existe, intente con otro");
                      </script>';
                      mysqli_close($conn);
         }else{ 

                    //si no existe la profesion permite insertar
                    $sql1 = "INSERT INTO tbl_profesiones (PROFESION, ESTADO)
                    VALUES ('$profesion7', '$ESTADOS')";
                    if (mysqli_query($conn, $sql1)) {

                        echo '<script>
                                alert("Profesión creada con éxito");
                                window.location.href="../../vistas/mantenimiento/vista_profesiones.php";                   
                            </script>';
                             mysqli_close($conn);
                    } else {
                            echo '<script>
                                    alert("Error al tratar de crear la profesión");
                                  </script>'; 
                                  mysqli_error($conn);
                           }
                    
                    mysqli_close($conn);

              }                      
      break;

       //para editar en la tabla mysl      
      case "editar";

        // valida si existe la profesion con el mismo nombre
        $validar_profesion= "SELECT * FROM tbl_profesiones WHERE PROFESION='$profesion7'";
        $result2 = mysqli_query($conn, $validar_profesion); 
         if (mysqli_num_rows($result2) > 0) { 
              
                $sql2 = "UPDATE tbl_profesiones SET ESTADO='$ESTADOS'  WHERE ID_PROFESION='$id_profesion'";
                if (mysqli_query($conn, $sql2)) {

                    echo '<script>
                                alert("Edición del estado exitasa"); 
                                window.location.href="../../vistas/mantenimiento/vista_profesiones.php";                
                          </script>';
                          mysqli_close($conn);
                }
               // si no existe la profesion con el mismo nombre
              }else{
                        $sql2 = "UPDATE tbl_profesiones SET PROFESION='$profesion7', ESTADO='$ESTADOS'  WHERE ID_PROFESION='$id_profesion'";
                        if (mysqli_query($conn, $sql2)) {

                            echo '<script>
                                    alert("Edición exitosa");
                                    window.location.href="../../vistas/mantenimiento/vista_profesiones.php";                     
                                </script>';
                                mysqli_close($conn);
                                
                        }

              }
      
      break;
      
      //para eliminar en la tabla mysl  
      case "eliminar";

    //validar que no este asignado a un usuario
    $validar_profesion = "SELECT * FROM tbl_usuarios WHERE ID_PROFESION='$id_profesion'";
    $result4 = mysqli_query($conn, $validar_profesion); 
     if (mysqli_num_rows($result4) > 0) { 
        
         echo '<script>
                 alert("No se puede eliminar la profesión, esta se encuentra en uso");
                 window.location.href="../../vistas/mantenimiento/vista_profesiones.php";                  
               </script>';
               mysqli_close($conn);

     }else{
                        $sql3 = "DELETE FROM tbl_profesiones WHERE ID_PROFESION='$id_profesion'";
                        if (mysqli_query($conn, $sql3)) {
                            
                            header('Location: ../../vistas/mantenimiento/vista_profesiones.php');
                        }else{
                                echo '<script>
                                        alert("Error al tratar de eliminar la profesión");
                                    </script>'; mysqli_error($conn);
                            }
                        mysqli_close($conn);
                    
          }

      break;
      
      default:
          
          $conn->close();   
  }


?>
