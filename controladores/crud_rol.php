<?php
  require '../../conexion/conexion.php';
  //para mostrar los datos de la tabla mysql y mostrar en el crud
  $sql = "SELECT * FROM tbl_roles";
  $result = mysqli_query($conn, $sql);


  // //Variables para recuperar la información de los campos de la vista roles
  $id_rol=(isset($_POST['id_rol']))?$_POST['id_rol']:"";
  $rol=(isset($_POST['rol']))?$_POST['rol']:"";
  $descripcion=(isset($_POST['descripcion']))?$_POST['descripcion']:"";
  $anterior=(isset($_POST['nombre_anterior']))?$_POST['nombre_anterior']:"";
  
  $usuario1 = $_SESSION;

  //variable para recuperar los botones de la vista roles  
  $accion=(isset($_POST['accion']))?$_POST['accion']:"";

  
  
  
  
  switch($accion){
      //para insertar en la tabla mysl
      case "agregar": 
        // valida si existe un rol con el mismo nombre
        $validar_rol = "SELECT * FROM tbl_roles WHERE ROL='$rol'";
        $result1 = mysqli_query($conn, $validar_rol); 
         if (mysqli_num_rows($result1) > 0) { 
                echo '<script>
                        alert("Rol ya existe");
                      </script>';
                      mysqli_close($conn);
         }else{ 

                    //si no existe el rol permite insertar
                    $sql1 = "INSERT INTO tbl_roles (ROL, DESCRIPCION)
                    VALUES ('$rol', '$descripcion')";
                    if (mysqli_query($conn, $sql1)) {

                         // inicio inserta en la tabla bitacora
                            $sql7 = "INSERT INTO tbl_bitacora (ID_USUARIO, ID_OBJETO, USUARIO, ACCION, OBSERVACION)
                            VALUES (2, 1, '$usuario1[usuario]', 'INSERTO', 'CREO EL ROL ($rol)')";
                             if (mysqli_query($conn, $sql7)) {} else { }
                        // fin inserta en la tabla bitacora
                        echo '<script>
                                alert("Rol creado con exito");
                                window.location.href="../../vistas/ajustes/vista_roles.php";                   
                            </script>';
                             mysqli_close($conn);
                    } else {
                            echo '<script>
                                    alert("Error al tratar de crear rol");
                                  </script>'; 
                                  mysqli_error($conn);
                           }
                    
                    mysqli_close($conn);

              }                      
      break;

       //para editar en la tabla mysl      
      case "editar";

        // valida si existe el rol con el mismo nombre
        $validar_rol= "SELECT * FROM tbl_roles WHERE Rol='$rol'";
        $result2 = mysqli_query($conn, $validar_rol); 
         if (mysqli_num_rows($result2) > 0) { 
              
            $sql2 = "UPDATE tbl_roles SET ROL='$anterior', DESCRIPCION='$descripcion'  WHERE ID_ROL='$id_rol'";
                if (mysqli_query($conn, $sql2)) {

                   
                           
                     // inicio inserta en la tabla bitacora
                     $sql8 = "INSERT INTO tbl_bitacora (ID_USUARIO, ID_OBJETO, USUARIO, ACCION, OBSERVACION)
                     VALUES (2, 1, '$usuario1[usuario]', 'EDITO', 'EDITO DESCRIPCION DEL ROL ($rol)')";
                     
                      if (mysqli_query($conn, $sql8)) {} else { }
                    // fin inserta en la tabla bitacora
                    echo '<script>
                            alert("Descripción del rol editado con exito");
                            window.location.href="../../vistas/ajustes/vista_roles.php";                   
                          </script>';
                          mysqli_close($conn);
                        

                }else{
                         echo '<script>
                                  alert("Error al tratar de editar rol");
                               </script>'; mysqli_error($conn);
                     }

                     mysqli_close($conn);

               // si no existe el rol con el mismo nombre
              }else{
                        $sql2 = "UPDATE tbl_roles SET ROL='$rol', DESCRIPCION='$descripcion'  WHERE ID_ROL='$id_rol'";
                        if (mysqli_query($conn, $sql2)) {

                            
                                
                            // inicio inserta en la tabla bitacora
                            $sql9 = "INSERT INTO tbl_bitacora (ID_USUARIO, ID_OBJETO, USUARIO, ACCION, OBSERVACION)
                            VALUES (2, 1, '$usuario1[usuario]', 'EDITO', 'RENOMBRO EL ROL ($anterior) A $rol')";
                            
                            if (mysqli_query($conn, $sql9)) {} else { }
                            // fin inserta en la tabla bitacora
                            echo '<script>
                                    alert("Rol editado con exito");
                                    window.location.href="../../vistas/ajustes/vista_roles.php";                   
                                </script>';
                                mysqli_close($conn);
                                
                        }

              }
      
      break;
      
      //para eliminar en la tabla mysl  
      case "eliminar";

    //validar que no este asignado a un usuario
    $validar_rol = "SELECT * FROM tbl_usuarios WHERE ID_ROL='$id_rol'";
    $result4 = mysqli_query($conn, $validar_rol); 
     if (mysqli_num_rows($result4) > 0) { 

         echo '<script>
                 alert("No se puede eliminar el rol, ya que esta en uso");
                 window.location.href="../../vistas/ajustes/vista_roles.php";                   
               </script>';
               mysqli_close($conn);

     }else{

                //validar que no este asignado en la tabla tbl_ms_roles_objetos
                $validar_rol = "SELECT * FROM tbl_ms_roles_ojetos WHERE ID_ROL='$id_rol'";
                $result5 = mysqli_query($conn, $validar_rol); 
                if (mysqli_num_rows($result5) > 0) { 

                    echo '<script>
                            alert("No se puede eliminar el rol, ya que esta en uso.");
                            window.location.href="../../vistas/ajustes/vista_roles.php";                   
                          </script>';
                          mysqli_close($conn);
                }else{
                        $sql3 = "DELETE FROM tbl_roles WHERE ID_ROL='$id_rol'";
                        if (mysqli_query($conn, $sql3)) {
                            // inicio inserta en la tabla bitacora
                            $sql7 = "INSERT INTO tbl_bitacora (ID_USUARIO, ID_OBJETO, USUARIO, ACCION, OBSERVACION)
                            VALUES (2, 1, '$usuario1[usuario]', 'ELIMINO', 'ELIMINO EL ROL ($anterior)')";
                             if (mysqli_query($conn, $sql7)) {} else { }
                        // fin inserta en la tabla bitacora
                            header('Location: ../../vistas/ajustes/vista_roles.php');
                        }else{
                                echo '<script>
                                        alert("Error al tratar de eliminar el rol");
                                    </script>'; mysqli_error($conn);
                            }
                        mysqli_close($conn);
                     }
          }

      break;
      
      default:
          
          $conn->close();   
  }// Fin del switch, para validar el valor del boton accion


?>
