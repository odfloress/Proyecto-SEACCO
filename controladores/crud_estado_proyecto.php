<?php
  require '../../conexion/conexion.php';
  //para mostrar los datos de la tabla mysql y mostrar en el crud
  $sql = "SELECT * FROM tbl_estados_proyectos WHERE ID_ESTADOS!=1 and ID_ESTADOS!=4 and ID_ESTADOS!=5 and ID_ESTADOS!=6" ;
  $result = mysqli_query($conn, $sql);


  // //Variables para recuperar la información de los campos de la vista estados proyecto
  $id_estados=(isset($_POST['id_estados']))?$_POST['id_estados']:"";
  $nombre=(isset($_POST['nombre']))?$_POST['nombre']:"";
  $anterior=(isset($_POST['nombre_anterior']))?$_POST['nombre_anterior']:"";
  $estado=(isset($_POST['estado']))?$_POST['estado']:"";

  $usuario1 = $_SESSION;

  //variable para recuperar los botones de la vista estados proyecto  
  $accion=(isset($_POST['accion']))?$_POST['accion']:"";
  
  
  switch($accion){
      //para insertar en la tabla mysl
      case "agregar": 
        // valida si existe un estado con el mismo nombre
        $validar_estados = "SELECT * FROM tbl_estados_proyectos WHERE ESTADO_PROYECTO='$nombre'";
        $result1 = mysqli_query($conn, $validar_estados); 
         if (mysqli_num_rows($result1) > 0) { 
              
         
           echo '<script>
                    alert("Estado ya existe");
                 </script>';
                 mysqli_close($conn);
         }else{ 

                //si no existe un estado permite insertar
                $sql1 = "INSERT INTO tbl_estados_proyectos (ESTADO_PROYECTO, ESTADO)
                VALUES ('$nombre','$estado')";
                if (mysqli_query($conn, $sql1)) {
                  
                  $last_id = $conn->insert_id;

                   echo '<script>
                   alert("Estado creado con exito");
                   window.location.href="../../vistas/proyectos/vista_estado_proyecto.php";                   
                 </script>';
                 mysqli_close($conn);
              
                  
                  
                } else {
                  
                        echo '<script>
                                alert("Error al tratar de crear el estado");
                              </script>'; mysqli_error($conn);
                       }
                
                mysqli_close($conn);

              }                    

             
      break;

       //para editar en la tabla mysl      
      case "editar";
       // valida si existe el provvedor con el mismo nombre
      $validar_estados= "SELECT * FROM tbl_estados_proyectos WHERE ESTADO_PROYECTO='$nombre'";
      $result2 = mysqli_query($conn, $validar_estados); 
       if (mysqli_num_rows($result2) > 0) { 
            
          $sql2 = "UPDATE tbl_estados_proyectos SET ESTADO_PROYECTO='$anterior', ESTADO='$estado' WHERE ID_ESTADOS='$id_estados'";
              if (mysqli_query($conn, $sql2)) {

                   echo '<script>
                           alert("Campos del estado editado con exito");
                           window.location.href="../../vistas/proyectos/vista_estado_proyecto.php";                   
                         </script>';
                         mysqli_close($conn);
                       
 
               }else{
                $sql10 = "INSERT INTO tbl_bitacora (USUARIO, ACCION, OBSERVACION)
                VALUES ('$usuario1[usuario]', 'ERROR', 'ERROR AL EDITAR ESTADO')";
                if (mysqli_query($conn, $sql8)) {} else { }
                        echo '<script>
                                 alert("Error al tratar de editar estado");
                              </script>'; mysqli_error($conn);
                    }
 
                    mysqli_close($conn);
                     // si no existe el estado con el mismo nombre
          }else{
                $sql2 = "UPDATE tbl_estados_proyectos SET ESTADO_PROYECTO='$nombre' WHERE ID_ESTADOS='$id_estados'";
                if (mysqli_query($conn, $sql2)) {

                 echo '<script>
                 alert("Estado editado con exito");
                 window.location.href="../../vistas/proyectos/vista_estado_proyecto.php";                   
               </script>';
               mysqli_close($conn);
                   

                }else{
                  $sql10 = "INSERT INTO tbl_bitacora (USUARIO, ACCION, OBSERVACION)
                VALUES ('$usuario1[usuario]', 'ERROR', 'ERROR AL EDITAR ESTADO')";
                if (mysqli_query($conn, $sql8)) {} else { }
                     echo '<script>
                            alert("Error al tratar de editar el estado");
                           </script>'; mysqli_error($conn);
                     }

                mysqli_close($conn);
                    }
        
      
      
      break;
      
      //para eliminar en la tabla mysl  
      case "eliminar";
       //validar que no este asignado a un proyecto
    $validar_estados = "SELECT * FROM tbl_proyectos WHERE ID_ESTADOS='$id_estados'";
    $result4 = mysqli_query($conn, $validar_estados); 
     if (mysqli_num_rows($result4) > 0) { 

         echo '<script>
                 alert("No se puede eliminar el Estado, ya que esta en uso");
                 window.location.href="../../vistas/proyectos/vista_estado_proyecto.php";                   
               </script>';
               mysqli_close($conn);

     }else{
      $sql3 = "DELETE FROM tbl_estados_proyectos WHERE ID_ESTADOS='$id_estados'";
      if (mysqli_query($conn, $sql3)) {

    echo '<script>
    alert("Elimino el Estado de proyecto");
    window.location.href="../../vistas/proyectos/vista_estado_proyecto.php";                   
  </script>';
  mysqli_close($conn);
      }else{
        $sql10 = "INSERT INTO tbl_bitacora (USUARIO, ACCION, OBSERVACION)
        VALUES ('$usuario1[usuario]', 'ERROR', 'ERROR AL ELIMINAR EL ESTADO')";
        if (mysqli_query($conn, $sql8)) {} else { }
              echo '<script>
                        alert("Error al tratar de eliminar estado");
                    </script>'; mysqli_error($conn);
           }
        mysqli_close($conn);
     }
      break;
      
      default:
          
          $conn->close();   
  }// Fin del switch, para validar el valor del boton accion


?>


