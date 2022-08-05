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
                        alert("El nombre de genero ya existe");
                      </script>';
                      mysqli_close($conn);
         }else{ 

                    //si no existe el genero permite insertar
                    $sql1 = "INSERT INTO tbl_generos (GENERO)
                    VALUES ('$genero7')";
                    if (mysqli_query($conn, $sql1)) {

                         // inicio inserta en la tabla bitacora
                            $sql7 = "INSERT INTO tbl_bitacora (USUARIO, ACCION, OBSERVACION)
                            VALUES ('$usuario1[usuario]', 'INSERTO', 'CREO EL GENERO ($genero7)')";
                             if (mysqli_query($conn, $sql7)) {} else { }
                        // fin inserta en la tabla bitacora
                        echo '<script>
                                alert("Genero creado con exito");
                                window.location.href="../../vistas/mantenimiento/vista_genero.php";                   
                            </script>';
                             mysqli_close($conn);
                    } else {
                            echo '<script>
                                    alert("Error al tratar de crear genero");
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
              
   
                     // inicio inserta en la tabla bitacora
                     $sql8 = "INSERT INTO tbl_bitacora (USUARIO, ACCION, OBSERVACION)
                     VALUES ('$usuario1[usuario]', 'INTENTO', 'NO LOGRO EDITAR El GENERO ($genero7) YA QUE EXISTE UNO IGUAL')";
                     
                      if (mysqli_query($conn, $sql8)) {} else { }
                    // fin inserta en la tabla bitacora
                    echo '<script>
                            alert("El genero ya existe intente con otro nombre");                  
                          </script>';
                          mysqli_close($conn);

               // si no existe el genero con el mismo nombre
              }else{
                        $sql2 = "UPDATE tbl_generos SET GENERO='$genero7'  WHERE ID_GENERO='$id_genero'";
                        if (mysqli_query($conn, $sql2)) {

                            // inicio inserta en la tabla bitacora
                            $sql9 = "INSERT INTO tbl_bitacora (USUARIO, ACCION, OBSERVACION)
                            VALUES ('$usuario1[usuario]', 'EDITO', 'RENOMBRO EL GENERO ($anterior) A $genero7')";
                            if (mysqli_query($conn, $sql9)) {} else { }
                            // fin inserta en la tabla bitacora
                            echo '<script>
                                    alert("Genero editado con exito");
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
         // inicio inserta en la tabla bitacora
         $sql9 = "INSERT INTO tbl_bitacora (USUARIO, ACCION, OBSERVACION)
         VALUES ('$usuario1[usuario]', 'INTENTO', 'NO LOGRO ELIMINAR YA QUE ESTA EN USO EL GENERO ($genero7)')";
         if (mysqli_query($conn, $sql9)) {} else { }
         // fin inserta en la tabla bitacora
         echo '<script>
                 alert("No se puede eliminar el genero, ya que esta en uso");
                 window.location.href="../../vistas/mantenimiento/vista_genero.php";                  
               </script>';
               mysqli_close($conn);

     }else{
                        $sql3 = "DELETE FROM tbl_generos WHERE ID_GENERO='$id_genero'";
                        if (mysqli_query($conn, $sql3)) {
                            // inicio inserta en la tabla bitacora
                            $sql7 = "INSERT INTO tbl_bitacora (USUARIO, ACCION, OBSERVACION)
                            VALUES ('$usuario1[usuario]', 'ELIMINO', 'ELIMINO EL GENERO ($anterior)')";
                             if (mysqli_query($conn, $sql7)) {} else { }
                        // fin inserta en la tabla bitacora
                            header('Location: ../../vistas/mantenimiento/vista_genero.php');
                        }else{
                                echo '<script>
                                        alert("Error al tratar de eliminar el genero");
                                    </script>'; mysqli_error($conn);
                            }
                        mysqli_close($conn);
                    
          }

      break;
      
      default:
          
          $conn->close();   
  }


?>
