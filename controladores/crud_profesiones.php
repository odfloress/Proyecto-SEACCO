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
                        alert("El nombre de profesión ingresado ya existe, intente con otro");
                      </script>';
                      mysqli_close($conn);
         }else{ 

                    //si no existe la profesion permite insertar
                    $sql1 = "INSERT INTO tbl_profesiones (PROFESION)
                    VALUES ('$profesion7')";
                    if (mysqli_query($conn, $sql1)) {

                         // inicio inserta en la tabla bitacora
                            $sql7 = "INSERT INTO tbl_bitacora (USUARIO, ACCION, OBSERVACION)
                            VALUES ('$usuario1[usuario]', 'INSERTO', 'CREO LA PROFESION ($profesion7)')";
                             if (mysqli_query($conn, $sql7)) {} else { }
                        // fin inserta en la tabla bitacora
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
              
   
                     // inicio inserta en la tabla bitacora
                     $sql8 = "INSERT INTO tbl_bitacora (USUARIO, ACCION, OBSERVACION)
                     VALUES ('$usuario1[usuario]', 'INTENTO', 'NO LOGRO EDITAR LA PROFESION ($profesion7) YA QUE EXISTE UNO IGUAL')";
                     
                      if (mysqli_query($conn, $sql8)) {} else { }
                    // fin inserta en la tabla bitacora
                    echo '<script>
                            alert("El nombre de profesión ingresada ya existe, intente con otro");                  
                          </script>';
                          mysqli_close($conn);

               // si no existe la profesion con el mismo nombre
              }else{
                        $sql2 = "UPDATE tbl_profesiones SET PROFESION='$profesion7'  WHERE ID_PROFESION='$id_profesion'";
                        if (mysqli_query($conn, $sql2)) {

                            // inicio inserta en la tabla bitacora
                            $sql9 = "INSERT INTO tbl_bitacora (USUARIO, ACCION, OBSERVACION)
                            VALUES ('$usuario1[usuario]', 'EDITO', 'RENOMBRO LA PROFESION ($anterior) A $profesion7')";
                            if (mysqli_query($conn, $sql9)) {} else { }
                            // fin inserta en la tabla bitacora
                            echo '<script>
                                    alert("Profesión editada con éxito");
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
         // inicio inserta en la tabla bitacora
         $sql9 = "INSERT INTO tbl_bitacora (USUARIO, ACCION, OBSERVACION)
         VALUES ('$usuario1[usuario]', 'INTENTO', 'NO LOGRO ELIMINAR YA QUE ESTA EN USO LA PROFESION ($profesion7)')";
         if (mysqli_query($conn, $sql9)) {} else { }
         // fin inserta en la tabla bitacora
         echo '<script>
                 alert("No se puede eliminar la profesión, esta se encuentra en uso");
                 window.location.href="../../vistas/mantenimiento/vista_profesiones.php";                  
               </script>';
               mysqli_close($conn);

     }else{
                        $sql3 = "DELETE FROM tbl_profesiones WHERE ID_PROFESION='$id_profesion'";
                        if (mysqli_query($conn, $sql3)) {
                            // inicio inserta en la tabla bitacora
                            $sql7 = "INSERT INTO tbl_bitacora (USUARIO, ACCION, OBSERVACION)
                            VALUES ('$usuario1[usuario]', 'ELIMINO', 'ELIMINO LA PROFESION ($anterior)')";
                             if (mysqli_query($conn, $sql7)) {} else { }
                        // fin inserta en la tabla bitacora
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
