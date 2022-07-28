<?php
  require '../../conexion/conexion.php';
  //para mostrar los datos de la tabla mysql y mostrar en el crud
  $sql = "SELECT * FROM tbl_estado_asignacion";
  $result = mysqli_query($conn, $sql);

// refresaca cada segundo  header("Refresh:1");
  // //Variables para recuperar la información de los campos de la vista roles
  $id_estado=(isset($_POST['id_estado']))?$_POST['id_estado']:"";
  $estado=(isset($_POST['estado']))?$_POST['estado']:"";
  $anterior=(isset($_POST['nombre_anterior']))?$_POST['nombre_anterior']:"";
  
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
                        alert("Estado ya existe");
                      </script>';
                      mysqli_close($conn);
         }else{ 

                    //si no existe el estado permite insertar
                    $sql1 = "INSERT INTO tbl_estado_asignacion (ESTADO_ASIGNACION)
                    VALUES ('$estado')";
                    if (mysqli_query($conn, $sql1)) {

                         // inicio inserta en la tabla bitacora
                            $sql7 = "INSERT INTO tbl_bitacora (USUARIO, ACCION, OBSERVACION)
                            VALUES ('$usuario1[usuario]', 'INSERTO', 'CREO EL ESTADO DE ASIGNACION ($estado)')";
                             if (mysqli_query($conn, $sql7)) {} else { }
                        // fin inserta en la tabla bitacora
                        echo '<script>
                                alert("Estado creado con exito");
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
              
   
                     // inicio inserta en la tabla bitacora
                     $sql8 = "INSERT INTO tbl_bitacora (USUARIO, ACCION, OBSERVACION)
                     VALUES ('$usuario1[usuario]', 'INTENTO', 'NO LOGRO EDITAR EL ESTADO ($estado) YA QUE EXISTE UNO IGUAL')";
                     
                      if (mysqli_query($conn, $sql8)) {} else { }
                    // fin inserta en la tabla bitacora
                    echo '<script>
                            alert("Estado ya existe intente con otro nombre");                  
                          </script>';
                          mysqli_close($conn);

               // si no existe el estado con el mismo nombre
              }else{
                        $sql2 = "UPDATE tbl_estado_asignacion SET ESTADO_ASIGNACION='$estado'  WHERE ID_ASIGNACION='$id_estado'";
                        if (mysqli_query($conn, $sql2)) {

                            // inicio inserta en la tabla bitacora
                            $sql9 = "INSERT INTO tbl_bitacora (USUARIO, ACCION, OBSERVACION)
                            VALUES ('$usuario1[usuario]', 'EDITO', 'RENOMBRO EL ESTADO ($anterior) A $estado')";
                            if (mysqli_query($conn, $sql9)) {} else { }
                            // fin inserta en la tabla bitacora
                            echo '<script>
                                    alert("Estado editado con exito");
                                    window.location.href="../../vistas/mantenimiento/vista_estados_asignacion.php";                     
                                </script>';
                                mysqli_close($conn);
                                
                        }

              }
      
      break;
      
      //para eliminar en la tabla mysl  
      case "eliminar";

    //validar que no este asignado a un usuario
    $validar_estado = "SELECT * FROM tbl_asignaciones WHERE ESTADO_ASIGNACION='$anterior'";
    $result7 = mysqli_query($conn, $validar_estado); 
     if (mysqli_num_rows($result7) > 0) { 
         // inicio inserta en la tabla bitacora
         $sql9 = "INSERT INTO tbl_bitacora (USUARIO, ACCION, OBSERVACION)
         VALUES ('$usuario1[usuario]', 'INTENTO', 'NO LOGRO ELIMINAR, YA QUE ESTA EN USO EL ESTADO ($estado)')";
         if (mysqli_query($conn, $sql9)) {} else { }
         // fin inserta en la tabla bitacora
         echo '<script>
                 alert("No se puede eliminar el estado, ya que esta en uso");
                 window.location.href="../../vistas/mantenimiento/vista_estados_asignacion.php";                   
               </script>';
               mysqli_close($conn);

     }else{
                        $sql3 = "DELETE FROM tbl_estado_asignacion WHERE ID_ASIGNACION='$id_estado'";
                        if (mysqli_query($conn, $sql3)) {
                            // inicio inserta en la tabla bitacora
                            $sql7 = "INSERT INTO tbl_bitacora (USUARIO, ACCION, OBSERVACION)
                            VALUES ('$usuario1[usuario]', 'ELIMINO', 'ELIMINO EL ESTADO ($anterior)')";
                             if (mysqli_query($conn, $sql7)) {} else { }
                        // fin inserta en la tabla bitacora
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
