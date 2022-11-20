<?php
  require '../../conexion/conexion.php';
  //para mostrar los datos de la tabla mysql y mostrar en el crud
  $sql = "SELECT * FROM tbl_generos";
  $result = mysqli_query($conn, $sql);

// refresaca cada segundo  header("Refresh:1");
  // //Variables para recuperar la información de los campos de la vista genero
  $id_genero=(isset($_POST['id_genero']))?$_POST['id_genero']:"";
  $genero7=(isset($_POST['genero']))?$_POST['genero']:"";
  $anterior=(isset($_POST['nombre_anterior']))?$_POST['nombre_anterior']:""; 
  
  $usuario1 = $_SESSION;

  //variable para recuperar los botones de la vista roles  
  $accion=(isset($_POST['accion']))?$_POST['accion']:"";
  
  
  switch($accion){
      //para insertar en la tabla mysl
      case "agregar": 
        // valida si existe un genero con el mismo nombre
        $validar_genero = "SELECT * FROM tbl_generos WHERE GENERO='$genero7'";
        $result1 = mysqli_query($conn, $validar_genero); 
         if (mysqli_num_rows($result1) > 0) { 
                
                echo '<script>
                        alert("El nombre de género ya existe, intente con otro");
                      </script>';
                      mysqli_close($conn);
         }else{ 

                    //si no existe el genero permite insertar
                    $sql1 = "INSERT INTO tbl_generos (GENERO)
                    VALUES ('$genero7')";
                    if (mysqli_query($conn, $sql1)) {

                       
                        echo '<script>
                                alert("Género creado exitosamente");
                                window.location.href="../../vistas/mantenimiento/vista_genero.php";                   
                            </script>';
                             mysqli_close($conn);
                    } else {
                            echo '<script>
                                    alert("Error al tratar de crear género");
                                  </script>'; 
                                  mysqli_error($conn);
                           }
                    
                    mysqli_close($conn);

              }                      
      break;

       //para editar en la tabla mysl      
      case "editar";

        // valida si existe el genero con el mismo nombre
        $validar_genero= "SELECT * FROM tbl_generos WHERE GENERO='$genero7'";
        $result2 = mysqli_query($conn, $validar_genero); 
         if (mysqli_num_rows($result2) > 0) { 
              

                    echo '<script>
                            alert("El nombre de género ya existe, intente con otro nombre");                  
                          </script>';
                          mysqli_close($conn);

               // si no existe el genero con el mismo nombre
              }else{
                        $sql2 = "UPDATE tbl_generos SET GENERO='$genero7'  WHERE ID_GENERO='$id_genero'";
                        if (mysqli_query($conn, $sql2)) {

                           
                            echo '<script>
                                    alert("Género actualizado exitosamente");
                                    window.location.href="../../vistas/mantenimiento/vista_genero.php";                     
                                </script>';
                                mysqli_close($conn);
                                
                        }

              }
      
      break;
      
      //para eliminar en la tabla mysl  
      case "eliminar";

    //validar que no este asignado a un usuario
    $validar_genero = "SELECT * FROM tbl_usuarios WHERE GENERO='$genero7'";
    $result4 = mysqli_query($conn, $validar_genero); 
     if (mysqli_num_rows($result4) > 0) { 
        
         echo '<script>
                 alert("No se puede eliminar el género, este se encuentra en uso");
                 window.location.href="../../vistas/mantenimiento/vista_genero.php";                  
               </script>';
               mysqli_close($conn);

     }else{
                        $sql3 = "DELETE FROM tbl_generos WHERE ID_GENERO='$id_genero'";
                        if (mysqli_query($conn, $sql3)) {
                        
                            header('Location: ../../vistas/mantenimiento/vista_genero.php');
                        }else{
                                echo '<script>
                                        alert("Error al tratar de eliminar el género");
                                    </script>'; mysqli_error($conn);
                            }
                        mysqli_close($conn);
                    
          }

      break;
      
      default:
          
          $conn->close();   
  }


?>
