<?php
  require '../../conexion/conexion.php';
  $usuario1 = $_SESSION;
   //selecciona el id de la comra en proceso
   $validar_compra7 = "SELECT * FROM tbl_asignaciones WHERE USUARIO='$usuario1[usuario]' and ESTADO_ASIGNACION='EN PROCESO'";
   $validar_compra77 = mysqli_query($conn, $validar_compra7);
   if (mysqli_num_rows($validar_compra77) > 0)
   {
         while($row = mysqli_fetch_assoc($validar_compra77)) 
         {
               $id_asignado = $row["ID_ASIGNADO"];
         }
   }

  //para mostrar los datos de la tabla mysql y mostrar en el crud
  $sql = "SELECT * FROM tbl_detalle_asignacion WHERE ID_ASIGNADO='$id_asignado'";
  $result = mysqli_query($conn, $sql);

 

  // //Variables para recuperar la información de los campos de la vista roles
  //$id_asignado=(isset($_POST['id_asignado']))?$_POST['id_asignado']:"";
  $id_producto=(isset($_POST['id_producto']))?$_POST['id_producto']:"";
  $descripcion_asignacion=(isset($_POST['descripcion_asignacion']))?$_POST['descripcion_asignacion']:"";
  $cantidad=(isset($_POST['cantidad']))?$_POST['cantidad']:"";
  $id_estado_herramienta=(isset($_POST['id_estado_herramienta']))?$_POST['id_estado_herramienta']:"";
  $id_estado_asignacion=(isset($_POST['id_estado_asignacion']))?$_POST['id_estado_asignacion']:"";
  $fecha_asignado=(isset($_POST['fecha_asignado']))?$_POST['fecha_asignado']:"";
  $fecha_entrega=(isset($_POST['fecha_entrega']))?$_POST['fecha_entrega']:"";
  $id_estado_herramienta=(isset($_POST['id_estado_herramienta']))?$_POST['id_estado_herramienta']:"";
  $id_estado_asignacion=(isset($_POST['id_estado_asignacion']))?$_POST['id_estado_asignacion']:"";

  //variable para recuperar los botones de la vista roles  
  $accion=(isset($_POST['accion']))?$_POST['accion']:"";
  
     //selecciona el id de la asignación en proceso
     $validar_asignacion10 = "SELECT * FROM tbl_asignaciones WHERE USUARIO='$usuario1[usuario]' and ESTADO_ASIGNACION='EN PROCESO'";
     $validar_asignacion11 = mysqli_query($conn, $validar_asignacion10);
     if (mysqli_num_rows($validar_asignacion11) > 0)
     {
           while($row = mysqli_fetch_assoc($validar_asignacion11)) 
           {
                 $id_asignado = $row["ID_ASIGNADO"];
           }
     }

  switch($accion){
  
      case "agregar": 

                    ///////////// INSERTA EN LA TABLA TBL_DETALLE_ASIGACIONES /////////////

                    $sql1 = "INSERT INTO tbl_detalle_asignacion (ID_ASIGNADO, DESCRIPCION_ASIGNACION, ID_PRODUCTO, CANTIDAD, ID_ESTADO_HERRAMIENTA, ID_ESTADO_ASIGNACION)
                    VALUES ('$id_asignado', '$descripcion_asignacion', '$id_producto', '$cantidad','$id_estado_herramienta','$id_estado_asignacion')";
                    if (mysqli_query($conn, $sql1)) {


                  ///////////// INSERTA EN LA TABLA TBL_KARDEX /////////////
                  $kardex = "INSERT INTO tbl_kardex (ID_PRODUCTO, ID_COMPRA, ID_ASIGNACION, USUARIO, CANTIDAD, TIPO_MOVIMIENTO)
                  VALUES ('$id_producto', NULL, '$id_asignado', '$usuario1[usuario]', '$cantidad', 'SALIDA')";
                  if (mysqli_query($conn, $kardex)) 
                      {

                      }

                      echo '<script>
                                alert("Producto agregado con exito");
                                window.location.href="../../vistas/inventario/detalle_asignacion.php";                   
                            </script>';
                               

                    } else {
                            echo '<script>
                                    alert("Error al tratar de agregar el producto");
                                  </script>'; 
                               
                           
                    
              }                    
      break;

      case "cancelar";

                      ///////////// ELIMINA DE LA TABLA KARDEX /////////////
                      $kardex1 = "UPDATE tbl_kardex SET TIPO_MOVIMIENTO='ENTRADA' WHERE ID_ASIGNACION='$id_asignado'";
                      if (mysqli_query($conn, $kardex1)) 
                          { }
      ///////////// ELIMINA DE LA TABLA DETALLE DE ASIGNACION /////////////
      $detalle5 = "DELETE FROM tbl_detalle_asignacion WHERE ID_ASIGNADO='$id_asignado'";
      if (mysqli_query($conn, $detalle5)) 
      {

                ///////////// ELIMINA LA ASIGNACION DE LA TABLA DE ASIGNACIONES /////////////
                $compra1 = "DELETE FROM tbl_asignaciones WHERE ID_ASIGNADO='$id_asignado'";
                if (mysqli_query($conn, $compra1)) {}
                echo '<script>
                                alert("Asignación eliminada con exito");
                                window.location.href="../../vistas/inventario/detalle_asignacion.php";                   
                            </script>';
      }
      case "confirmar";
      $confirmar = "UPDATE tbl_asignaciones SET ESTADO_ASIGNACION='FINALIZADO' WHERE ID_ASIGNADO='$id_asignado'";
      if (mysqli_query($conn, $confirmar)) 
      {
        echo '<script>
                alert("Asignación completada con exito");
                window.location.href="../../vistas/inventario/detalle_asignacion.php";                   
              </script>';
      }
              
      break;

      break;
      //para eliminar en la tabla mysl  
      case "eliminar";
      $eliminar_producto = "SELECT * FROM tbl_detalle_asignacion";
      $eliminar_producto1 = mysqli_query($conn, $eliminar_producto);
      if (mysqli_num_rows($eliminar_producto1) > 0)
      {
            while($row = mysqli_fetch_assoc($eliminar_producto1)) 
            {
                  $id_detalle_asignacion = $row["ID_DETALLE_ASIGNACION"];
            }
      }

      $kardex2 = "UPDATE tbl_kardex SET TIPO_MOVIMIENTO='ENTRADA' WHERE ID_ASIGNACION='$id_asignado'";
      if (mysqli_query($conn, $kardex2)) 
          { }
                        $sql3 = "DELETE FROM tbl_detalle_asignacion WHERE ID_DETALLE_ASIGNACION='$id_detalle_asignacion'";
                        if (mysqli_query($conn, $sql3)) {

                      mysqli_close($conn);
                               
                            header('Location: ../../vistas/inventario/detalle_asignacion.php');
                        }else{
                                echo '<script>
                                        alert("Error al tratar de eliminar el producto");
                                    </script>'; mysqli_error($conn);
                            }

                   
      break;
      
      default:
          
          
      $conn->close();   
  }// Fin del switch, para validar el valor del boton accion


?>
