<?php
  require '../../conexion/conexion.php';
  //para mostrar los datos de la tabla mysql y mostrar en el crud
  $sql = "SELECT * FROM tbl_ms_objetos";
  $result = mysqli_query($conn, $sql);

// refresaca cada segundo  header("Refresh:1");
  // //Variables para recuperar la información de los campos de la vista roles
  $id_objeto=(isset($_POST['id_objeto']))?$_POST['id_objeto']:"";
  $objeto=(isset($_POST['objeto']))?$_POST['objeto']:"";
  $descripcion=(isset($_POST['descripcion']))?$_POST['descripcion']:"";
  $tipo_objeto=(isset($_POST['tipo_objeto']))?$_POST['tipo_objeto']:"";
  $anterior=(isset($_POST['nombre_anterior']))?$_POST['nombre_anterior']:"";
  
  $usuario1 = $_SESSION;

  //variable para recuperar los botones de la vista roles  
  $accion=(isset($_POST['accion']))?$_POST['accion']:"";
  
  
  switch($accion){
      //para insertar en la tabla mysl
      case "agregar": 
        // valida si existe una pantalla con el mismo nombre
        $validar_pantalla = "SELECT * FROM tbl_ms_objetos WHERE OBJETO='$objeto'";
        $validar_pantalla2 = mysqli_query($conn, $validar_pantalla); 
         if (mysqli_num_rows($validar_pantalla2) > 0) { 
                
                echo '<script>
                        alert("La pantalla ya existe");
                      </script>';
                      mysqli_close($conn);
         }else{ 

                    //si no existe el estado permite insertar
                    $sql1 = "INSERT INTO tbl_ms_objetos (OBJETO, DESCRIPCION, TIPO_OBJETO)
                    VALUES ('$objeto', '$descripcion', '$tipo_objeto')";
                    if (mysqli_query($conn, $sql1)) {

                         // inicio inserta en la tabla bitacora
                            $sql7 = "INSERT INTO tbl_bitacora (USUARIO, ACCION, OBSERVACION)
                            VALUES ('$usuario1[usuario]', 'INSERTO', 'CREO LA PANTALLA($objeto)')";
                             if (mysqli_query($conn, $sql7)) {} else { }
                        // fin inserta en la tabla bitacora
                        echo '<script>
                                alert("Pantalla creada con exito");
                                window.location.href="../../vistas/mantenimiento/vista_pantallas.php";                   
                            </script>';
                            
                    } else {
                            echo '<script>
                                    alert("Error al tratar de crear la pantalla");
                                  </script>'; 
                                  mysqli_error($conn);
                           }
                    
                    mysqli_close($conn);

              }                      
      break;

       //para editar en la tabla mysl      
      case "editar";

        // valida si existe la pantalla con el mismo nombre
        $validar_pantalla= "SELECT * FROM tbl_ms_objetos WHERE OBJETO='$objeto'";
        $validar_pantalla2 = mysqli_query($conn, $validar_pantalla); 
         if (mysqli_num_rows($validar_pantalla2) > 0) { 
              
   
                     // inicio inserta en la tabla bitacora
                     $sql8 = "INSERT INTO tbl_bitacora (USUARIO, ACCION, OBSERVACION)
                     VALUES ('$usuario1[usuario]', 'INTENTO', 'NO LOGRO EDITAR LA PANTALLA ($objeto) YA QUE EXISTE UNO IGUAL')";
                      if (mysqli_query($conn, $sql8)) {} else { }
                    // fin inserta en la tabla bitacora
                    echo '<script>
                            alert("Patalla ya existe, intente con otro nombre");                  
                          </script>';
                        

               // si no existe una pantalla con el mismo nombre
              }else{
                        $sql2 = "UPDATE tbl_ms_objetos SET OBJETO='$objeto', DESCRIPCION='$descripcion', TIPO_OBJETO='$tipo_objeto'  WHERE ID_OBJETO='$id_objeto'";
                        if (mysqli_query($conn, $sql2)) {

                            // inicio inserta en la tabla bitacora
                            $sql9 = "INSERT INTO tbl_bitacora (USUARIO, ACCION, OBSERVACION)
                            VALUES ('$usuario1[usuario]', 'EDITO', 'RENOMBRO LA PANTALLA ($anterior) A $objeto')";
                            if (mysqli_query($conn, $sql9)) {} else { }
                            // fin inserta en la tabla bitacora
                            echo '<script>
                                    alert("Pantalla editada con exito");
                                    window.location.href="../../vistas/mantenimiento/vista_pantalla.php";                     
                                </script>';
                                mysqli_close($conn);
                                
                        }

              }
      
      break;
      
      //para eliminar en la tabla mysl  
      case "eliminar";

    //validar que no este asignado un proyecto
    
                        $sql3 = "DELETE FROM tbl_ms_objetos WHERE ID_OBJETO='$id_objeto'";
                        if (mysqli_query($conn, $sql3)) {
                            // inicio inserta en la tabla bitacora
                            $sql7 = "INSERT INTO tbl_bitacora (USUARIO, ACCION, OBSERVACION)
                            VALUES ('$usuario1[usuario]', 'ELIMINO', 'ELIMINO LA PANTALLA ($anterior)')";
                             if (mysqli_query($conn, $sql7)) {} else { }
                        // fin inserta en la tabla bitacora
                            header('Location: ../../vistas/mantenimiento/vista_pantalla.php');
                        }else{
                                echo '<script>
                                        alert("Error al tratar de eliminar la pantalla");
                                    </script>'; mysqli_error($conn);
                            }
                        mysqli_close($conn);
                    
        

      break;
      
      default:
          
          $conn->close();   
  }


?>
