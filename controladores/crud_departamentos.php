<?php
  require '../../conexion/conexion.php';
  //para mostrar los datos de la tabla mysql y mostrar en el crud
  $sql = "SELECT * FROM tbl_departamentos";
  $result = mysqli_query($conn, $sql);

// refresaca cada segundo  header("Refresh:1");
  // //Variables para recuperar la información de los campos de la vista roles
  $id_departamento=(isset($_POST['id_departamento']))?$_POST['id_departamento']:"";
  $departamento=(isset($_POST['departamento']))?$_POST['departamento']:"";
  $anterior=(isset($_POST['nombre_anterior']))?$_POST['nombre_anterior']:"";
  
  $usuario1 = $_SESSION;

  //variable para recuperar los botones de la vista roles  
  $accion=(isset($_POST['accion']))?$_POST['accion']:"";
  
  
  switch($accion){
      //para insertar en la tabla mysl
      case "agregar": 
        // valida si existe un departamento con el mismo nombre
        $validar_departamento = "SELECT * FROM tbl_departamentos WHERE DEPARTAMENTO='$departamento'";
        $validar_departamento2 = mysqli_query($conn, $validar_departamento); 
         if (mysqli_num_rows($validar_departamento2) > 0) { 
                
                echo '<script>
                        alert("Departamento ya existe");
                      </script>';
                      mysqli_close($conn);
         }else{ 

                    //si no existe el estado permite insertar
                    $sql1 = "INSERT INTO tbl_departamentos (DEPARTAMENTO)
                    VALUES ('$departamento')";
                    if (mysqli_query($conn, $sql1)) {

                         // inicio inserta en la tabla bitacora
                            $sql7 = "INSERT INTO tbl_bitacora (USUARIO, ACCION, OBSERVACION)
                            VALUES ('$usuario1[usuario]', 'INSERTO', 'CREO EL DEPARTAMENTO ($departamento)')";
                             if (mysqli_query($conn, $sql7)) {} else { }
                        // fin inserta en la tabla bitacora
                        echo '<script>
                                alert("Departamento creado con exito");
                                window.location.href="../../vistas/mantenimiento/vista_departamentos.php";                   
                            </script>';
                            
                    } else {
                            echo '<script>
                                    alert("Error al tratar de crear el departamento");
                                  </script>'; 
                                  mysqli_error($conn);
                           }
                    
                    mysqli_close($conn);

              }                      
      break;

       //para editar en la tabla mysl      
      case "editar";

        // valida si existe el departamento con el mismo nombre
        $validar_departamento= "SELECT * FROM tbl_departamentos WHERE DEPARTAMENTO='$departamento'";
        $validar_departamento2 = mysqli_query($conn, $validar_departamento); 
         if (mysqli_num_rows($validar_departamento2) > 0) { 
              
   
                     // inicio inserta en la tabla bitacora
                     $sql8 = "INSERT INTO tbl_bitacora (USUARIO, ACCION, OBSERVACION)
                     VALUES ('$usuario1[usuario]', 'INTENTO', 'NO LOGRO EDITAR EL DEPARTAMENTO ($departamento) YA QUE EXISTE UNO IGUAL')";
                      if (mysqli_query($conn, $sql8)) {} else { }
                    // fin inserta en la tabla bitacora
                    echo '<script>
                            alert("Departamento ya existe, intente con otro nombre");                  
                          </script>';
                        

               // si no existe un departamento con el mismo nombre
              }else{
                        $sql2 = "UPDATE tbl_departamentos SET DEPARTAMENTO='$departamento'  WHERE ID_DEPARTAMENTO='$id_departamento'";
                        if (mysqli_query($conn, $sql2)) {

                            // inicio inserta en la tabla bitacora
                            $sql9 = "INSERT INTO tbl_bitacora (USUARIO, ACCION, OBSERVACION)
                            VALUES ('$usuario1[usuario]', 'EDITO', 'RENOMBRO EL DEPARTAMENTO ($anterior) A $departamento')";
                            if (mysqli_query($conn, $sql9)) {} else { }
                            // fin inserta en la tabla bitacora
                            echo '<script>
                                    alert("Departamento editado con exito");
                                    window.location.href="../../vistas/mantenimiento/vista_departamentos.php";                     
                                </script>';
                                mysqli_close($conn);
                                
                        }

              }
      
      break;
      
      //para eliminar en la tabla mysl  
      case "eliminar";

    //validar que no este asignado un proyecto
    $validar_departamento = "SELECT * FROM tbl_proyectos WHERE UBICACION='$departamento'";
    $validar_departamento2 = mysqli_query($conn, $validar_departamento); 
     if (mysqli_num_rows($validar_departamento2) > 0) { 
         // inicio inserta en la tabla bitacora
         $sql9 = "INSERT INTO tbl_bitacora (USUARIO, ACCION, OBSERVACION)
         VALUES ('$usuario1[usuario]', 'INTENTO', 'NO LOGRO ELIMINAR, YA QUE ESTA EN USO EL DEPARTAMENTO ($departamento)')";
         if (mysqli_query($conn, $sql9)) {} else { }
         // fin inserta en la tabla bitacora
         echo '<script>
                 alert("No se puede eliminar el departamento, ya que esta en uso");
                 window.location.href="../../vistas/mantenimiento/vista_departamentos.php";                   
               </script>';
               mysqli_close($conn);

     }else{
                        $sql3 = "DELETE FROM tbl_departamentos WHERE ID_DEPARTAMENTO='$id_departamento'";
                        if (mysqli_query($conn, $sql3)) {
                            // inicio inserta en la tabla bitacora
                            $sql7 = "INSERT INTO tbl_bitacora (USUARIO, ACCION, OBSERVACION)
                            VALUES ('$usuario1[usuario]', 'ELIMINO', 'ELIMINO EL DEPARTAMENTO ($anterior)')";
                             if (mysqli_query($conn, $sql7)) {} else { }
                        // fin inserta en la tabla bitacora
                            header('Location: ../../vistas/mantenimiento/vista_departamentos.php');
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
