<?php
  require '../../conexion/conexion.php';
  //para mostrar los datos de la tabla mysql y mostrar en el crud
  $sql = "SELECT ID_PROYECTO, NOMBRE_CLIENTE, NOMBRE, ESTADO_PROYECTO, NOMBRE_PROYECTO, DESCRIPCION, DEPARTAMENTO, UBICACION, FECHA_INICIO, FECHA_FINAL FROM ((((tbl_proyectos p
  INNER JOIN tbl_clientes c ON p.ID_CLIENTE = c.ID_CLIENTE)
  INNER JOIN tbl_usuarios u ON p.ID_USUARIO = u.ID_USUARIO)
  INNER JOIN tbl_estados_proyectos e ON p.ID_ESTADOS = e.ID_ESTADOS)
  INNER JOIN tbl_departamentos d ON p.ID_DEPARTAMENTO = d.ID_DEPARTAMENTO)";

  
  
  $result = mysqli_query($conn, $sql);



  // //Variables para recuperar la información de los campos de la vista categorias de productos
  $id_proyecto=(isset($_POST['id_proyecto']))?$_POST['id_proyecto']:"";
  $id_cliente=(isset($_POST['id_cliente']))?$_POST['id_cliente']:"";
  $id_usuario=(isset($_POST['id_usuario']))?$_POST['id_usuario']:"";
  $id_estado=(isset($_POST['id_estado']))?$_POST['id_estado']:"";
  $nombre=(isset($_POST['nombre']))?$_POST['nombre']:"";
  $descripcion=(isset($_POST['descripcion']))?$_POST['descripcion']:"";
  $ubicacion=(isset($_POST['ubicacion']))?$_POST['ubicacion']:"";
  $fecha_inicio=(isset($_POST['fecha_inicio']))?$_POST['fecha_inicio']:"";
  $fecha_final=(isset($_POST['fecha_final']))?$_POST['fecha_final']:"";
  
  $usuario1 = $_SESSION;
  
  //variable para recuperar los botones de la vista categprias de productos  
  $accion=(isset($_POST['accion']))?$_POST['accion']:"";
  
  
  switch($accion){
      //para insertar en la tabla mysl
      case "agregar": 
        // valida si existe una proyecto con el mismo nombre
        $validar_proveedor = "SELECT * FROM tbl_proyectos WHERE NOMBRE='$nombre'";
        $result1 = mysqli_query($conn, $validar_proveedor); 
         if (mysqli_num_rows($result1) > 0) { 
              
         
           echo '<script>
                    alert("proyecto ya existe");
                 </script>';
                 mysqli_close($conn);
         }else{ 

                //si no existe un proyecto permite insertar
                $sql1 = "INSERT INTO tbl_proyectos ( ID_PROYECTO,ID_CLIENTE, ID_USUARIO,ID_ESTADOS, NOMBRE, DESCRIPCION, UBICACION, FECHA_INICIO, FECHA_FINAL)
                VALUES ('$id_proyecto','$id_cliente','$id_usuario','$id_estado','$nombre','$descripcion','$ubicacion','$fecha_inicio','$fecha_final')";
                if (mysqli_query($conn, $sql1)) {
                  // inicio inserta en la tabla bitacora
                  $sql7 = "INSERT INTO tbl_bitacora (USUARIO, ACCION, OBSERVACION)
                  VALUES ('$usuario1[usuario]', 'INSERTO', 'CREO EL PROYECTO ($nombre)')";
                   if (mysqli_query($conn, $sql7)) {} else { }
              // fin inserta en la tabla bitacora
                    header('Location: ../../vistas/proyectos/vista_proyectos.php');

                } else {
                        echo '<script>
                                alert("Error al tratar de crear el proyecto");
                              </script>'; mysqli_error($conn);
                       }
                
                mysqli_close($conn);

              }                    

             
      break;

       //para editar en la tabla mysl      
      case "editar";
       $sql2 = "UPDATE tbl_proyectos SET ID_CLIENTE='$id_cliente', ID_USUARIO='$id_usuario', ID_ESTADOS='$id_estado',NOMBRE='$nombre', DESCRIPCION='$descripcion', UBICACION='$ubicacion', FECHA_INICIO='$fecha_inicio', FECHA_FINAL='$fecha_final' WHERE ID_PROYECTO='$id_proyecto'";
                if (mysqli_query($conn, $sql2)) {
                  // inicio inserta en la tabla bitacora
                  $sql8 = "INSERT INTO tbl_bitacora (USUARIO, ACCION, OBSERVACION)
                  VALUES ('$usuario1[usuario]', 'EDITO', 'EDITO EL PROYECTO ($nombre)')";
                  
                   if (mysqli_query($conn, $sql8)) {} else { }
                 // fin inserta en la tabla bitacora
                   header('Location: ../../vistas/proyectos/vista_proyectos.php');

                }else{
                     echo '<script>
                            alert("Error al tratar de editar el proyecto");
                           </script>'; mysqli_error($conn);
                     }

                mysqli_close($conn);
              
      
      break;
      
      //para eliminar en la tabla mysl  
      case "eliminar";

      $sql3 = "DELETE FROM tbl_proyectos WHERE ID_PROYECTO='$id_proyecto'";
      if (mysqli_query($conn, $sql3)) {
        // inicio inserta en la tabla bitacora
        $sql7 = "INSERT INTO tbl_bitacora (USUARIO, ACCION, OBSERVACION)
        VALUES ('$usuario1[usuario]', 'ELIMINO', 'ELIMINO EL PROYECTO ($nombre)')";
         if (mysqli_query($conn, $sql7)) {} else { }
    // fin inserta en la tabla bitacora
          header('Location: ../../vistas/proyectos/vista_proyectos.php');
      }else{
              echo '<script>
                        alert("Error al tratar de eliminar el proyecto");
                    </script>'; mysqli_error($conn);
           }
        mysqli_close($conn);

      break;
      
      default:
          
          $conn->close();   
  }// Fin del switch, para validar el valor del boton accion


?>
