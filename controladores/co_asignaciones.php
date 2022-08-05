<?php
  require '../../conexion/conexion.php';
  //para mostrar los datos de la tabla mysql y mostrar en el crud
  $sql = "SELECT * FROM (((((tbl_asignaciones a
          INNER JOIN tbl_usuarios u ON a.ID_USUARIO = u.ID_USUARIO)
          INNER JOIN tbl_proyectos p ON a.ID_PROYECTO = p.ID_PROYECTO)
          INNER JOIN tbl_productos pr ON a.ID_PRODUCTO = pr.ID_PRODUCTO)
          INNER JOIN tbl_estado_asignacion ea ON a.ID_ESTADO_ASIGNACION = ea.ID_ESTADO_ASIGNACION)
          INNER JOIN tbl_estado_herramienta eh ON a.ID_ESTADO_HERRAMIENTA = eh.ID_ESTADO_HERRAMIENTA)
          
          ORDER BY ID_ASIGNADO";
  $result = mysqli_query($conn, $sql);


  // //Variables para recuperar la información de los campos de la vista asignaciones
  $id_asignado=(isset($_POST['id_asignado']))?$_POST['id_asignado']:"";
  $id_producto=(isset($_POST['id_producto']))?$_POST['id_producto']:"";
  $id_proyecto=(isset($_POST['id_proyecto']))?$_POST['id_proyecto']:"";
  $empleado=(isset($_POST['usuario1']))?$_POST['usuario1']:"";
  $descripcion_asignacion=(isset($_POST['descripcion_asignacion']))?$_POST['descripcion_asignacion']:"";
  $cantidad=(isset($_POST['cantidad']))?$_POST['cantidad']:"";
  $id_estado_herramienta=(isset($_POST['id_estado_herramienta']))?$_POST['id_estado_herramienta']:"";
  $id_estado_asignacion=(isset($_POST['id_estado_asignacion']))?$_POST['id_estado_asignacion']:"";
  $fecha_asignado=(isset($_POST['fecha_asignado']))?$_POST['fecha_asignado']:"";
  $fecha_entrega=(isset($_POST['fecha_entrega']))?$_POST['fecha_entrega']:"";
  $id_estado_herramienta=(isset($_POST['id_estado_herramienta']))?$_POST['id_estado_herramienta']:"";
  $id_estado_asignacion=(isset($_POST['id_estado_asignacion']))?$_POST['id_estado_asignacion']:"";
  $usuario1=$_SESSION;

  //variable para recuperar los botones de la vista asignaciones 
  $accion=(isset($_POST['accion']))?$_POST['accion']:"";
  
 switch ($accion){ 
case 'agregar':
         // validar si la asignación existe en la base de datos.
         $validar_asignacion = "SELECT * FROM tbl_asignaciones WHERE ID_ASIGNADO='$id_asignado'";
         $result1 = mysqli_query($conn, $validar_asignacion); 
          if (mysqli_num_rows($result1) > 0) {               
                          //Si código de asignación existe de producto no permite insertar                    
                     echo '<script>
                     alert("El código de asignación ya existe, intente nuevamente");
                  </script>';
                  mysqli_close($conn);  
 
          }else{ 

            $sql1 = "INSERT INTO tbl_asignaciones (ID_PRODUCTO, ID_PROYECTO, ID_USUARIO, DESCRIPCION_ASIGNACION, CANTIDAD,
            ID_ESTADO_HERRAMIENTA, ID_ESTADO_ASIGNACION, FECHA_ASIGNADO, FECHA_ENTREGA)
     VALUES('$id_producto', '$id_proyecto', '$empleado', '$descripcion_asignacion', '$cantidad',
            '$id_estado_herramienta', '$id_estado_asignacion', '$fecha_asignado', '$fecha_entrega')";
                if (mysqli_query($conn, $sql1)) { 
                // fin inserta en la tabla bitacora
                echo '<script>
                alert("Asignacion creada con exito");
                window.location.href="../../vistas/inventario/vista_asignaciones.php";                   
                </script>';
                  // inicio inserta en la tabla bitacora
                  $sql2 = "INSERT INTO tbl_bitacora (USUARIO, ACCION, OBSERVACION)
                  VALUES ('$usuario1[usuario]', 'INSERTÓ', 'CREÓ UNA ASIGNACIÓN PARA EL EMPLEADO $empleado')";
                  
                  if (mysqli_query($conn, $sql2)) {
                    
                  } else {                 
                  }
                 // fin inserta en la tabla bitacora

                  // inicio inserta en la tabla kardex
                  $sql5 = "INSERT INTO tbl_kardex (ID_PRODUCTO, USUARIO, CANTIDAD, TIPO_MOVIMIENTO)
                  VALUES ('$id_producto', '$usuario1[usuario]', '$cantidad','SALIDA')";
                  
                  if (mysqli_query($conn, $sql5)) {
                    
                  } else {                 
                  }
                 // fin inserta en la tabla kardex
                }else {
                echo "Error: " . $sql5 . "<br>" . mysqli_error($conn);
                }
                   
                }                    
        break;
      
       //para editar en la tabla mysl      
       case 'editar':
        $sql3 = "UPDATE tbl_asignaciones SET ID_PRODUCTO='$id_producto', ID_PROYECTO='$id_proyecto', ID_USUARIO='$empleado', DESCRIPCION_ASIGNACION='$descripcion_asignacion', CANTIDAD='$cantidad',
        ID_ESTADO_HERRAMIENTA='$id_estado_herramienta', ID_ESTADO_ASIGNACION='$id_estado_asignacion', FECHA_ASIGNADO='$fecha_asignado', FECHA_ENTREGA='$fecha_entrega' WHERE ID_ASIGNADO = '$id_asignado'";
                 if (mysqli_query($conn, $sql3)) { 
                        // fin inserta en la tabla bitacora
                        echo '<script>
                        alert("Asignacion actualizada con exito");
                        window.location.href="../../vistas/inventario/vista_asignaciones.php";                   
                        </script>';
                          // inicio inserta en la tabla bitacora
                          $sql4 = "INSERT INTO tbl_bitacora (USUARIO, ACCION, OBSERVACION)
                          VALUES ('$usuario1[usuario]', 'ACTUALIZÓ', 'ACTALIZÓ LA ASIGNACIÓN DEL EMPLEADO $empleado')";
                          
                          if (mysqli_query($conn, $sql4)) {
                            
                          } else {                 
                          }
                         // fin inserta en la tabla bitacora
                         $transaccion = "SELECT ID_ESTADO_ASIGNACION FROM tbl_asignaciones WHERE ID_ASIGNADO='$id_asignado'";
                         $result2 = mysqli_query($conn, $transaccion);
                          // inicio inserta en la tabla kardex
                          if ($transaccion =='1') {               
                                //Si código de asignación existe de producto no permite insertar                    
                                $sql7 = "INSERT INTO tbl_kardex (ID_PRODUCTO, USUARIO, CANTIDAD, TIPO_MOVIMIENTO)
                                VALUES ('$id_producto', '$usuario1[usuario]', '$cantidad','SALIDA')";
                                } else {
                                        
                                $sql8 = "INSERT INTO tbl_kardex (ID_PRODUCTO, USUARIO, CANTIDAD, TIPO_MOVIMIENTO)
                                VALUES ('$id_producto', '$usuario1[usuario]', '$cantidad','ENTRADA')";                                
                          if (mysqli_query($conn, $sql8)) {
                            
                        } else {                 
                        }
                }
                         // fin inserta en la tabla kardex
                        }else {
                        echo "Error: " . $sql5 . "<br>" . mysqli_error($conn);
                        }
                                                                   
break; 

      //para eliminar en la tabla mysl  
      case "eliminar":

      $sql6 = "DELETE FROM tbl_asignaciones WHERE ID_ASIGNADO='$id_asignado'";
      if (mysqli_query($conn, $sql6)) {
        echo '<script>
        alert("Asignación eliminada exitosamente");
        window.location.href="../../vistas/inventario/vista_asignaciones.php";                     
    </script>';
    mysqli_close($conn);
      }else{
              echo '<script>
                        alert("Error al tratar de eliminar la asignación");
                    </script>'; mysqli_error($conn);
           }
        mysqli_close($conn);

      break;
      
      default:
          
          $conn->close();   
  }// Fin del switch, para validar el valor del boton accion     

?>