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
  $sql = "SELECT * FROM (((((tbl_asignaciones a
          INNER JOIN tbl_usuarios u ON a.ID_USUARIO = u.ID_USUARIO)
          INNER JOIN tbl_proyectos p ON a.ID_PROYECTO = p.ID_PROYECTO)
          INNER JOIN tbl_productos pr ON a.ID_PRODUCTO = pr.ID_PRODUCTO)
          INNER JOIN tbl_estado_asignacion ea ON a.ID_ESTADO_ASIGNACION = ea.ID_ESTADO_ASIGNACION)
          INNER JOIN tbl_estado_herramienta eh ON a.ID_ESTADO_HERRAMIENTA = eh.ID_ESTADO_HERRAMIENTA)
          
          ORDER BY ID_ASIGNADO";
  $result = mysqli_query($conn, $sql);
 

  // //Variables para recuperar la información de los campos de la vista roles
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

  //variable para recuperar los botones de la vista roles  
  $accion=(isset($_POST['accion']))?$_POST['accion']:"";
  
  
  switch($accion){
  
      case "agregar": 
        // valida si ya esta agregado el producto
        $validar_producto = "SELECT * FROM tbl_asignaciones WHERE ID_PRODUCTO='$id_producto' and ID_ASIGNADO='$id_asignado'";
        $result1 = mysqli_query($conn, $validar_producto); 
         if (mysqli_num_rows($result1) > 0) { 
                
                echo '<script>
                        alert("Error, el producto ya esta agregado.");
                      </script>';
                      mysqli_close($conn);
         }else{ 

                    ///////////// INSERTA EN LA TABLA TBL_DETALLE_ASIGACIONES /////////////

                    $sql1 = "INSERT INTO tbl_detalle_asignacion (ID_ASIGNADO, ID_PRODUCTO, CANTIDAD)
                    VALUES ('$id_asignado', '$id_producto', '$cantidad')";
                    if (mysqli_query($conn, $sql1)) {


                  ///////////// INSERTA EN LA TABLA TBL_KARDEX /////////////
                  $kardex = "INSERT INTO tbl_kardex (ID_PRODUCTO, ID_ASIGNACION, USUARIO, CANTIDAD, TIPO_MOVIMIENTO)
                  VALUES ('$id_producto', '$id_asignado', '$usuario1[usuario]', '$cantidad', 'SALIDA')";
                  if (mysqli_query($conn, $kardex)) 
                      {
                        ///////////// SUMA AL INVENTARIO /////////////
                        $inventario = "UPDATE tbl_inventario SET CANTIDAD_DISPONIBLE=CANTIDAD_DISPONIBLE + $cantidad WHERE ID_PRODUCTOS='$id_producto'";
                        if (mysqli_query($conn, $inventario)) {}

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
                    
              }                    
      break;

      case "cancelar";
      ///////////// ELIMINA DE LA TABLA DETALLE DE ASIGNACION /////////////
      $detalle5 = "DELETE FROM tbl_detalle_asignacion WHERE ID_ASIGNADO='$id_asignado'";
      if (mysqli_query($conn, $detalle5)) 
      {
                ///////////// ELIMINA DE LA TABLA KARDEX /////////////
                $kardex1 = "DELETE FROM tbl_kardex WHERE ID_ASIGNADO='$id_asignado'";
                if (mysqli_query($conn, $kardex1)) {}
                ///////////// ELIMINA LA ASIGNACION DE LA TABLA DE ASIGNACIONES /////////////
                $compra1 = "DELETE FROM tbl_detalle_asignacion WHERE ID_ASIGNADO='$id_asignado'";
                if (mysqli_query($conn, $compra1)) {}
                echo '<script>
                                alert("Asignación eliminada con exito");
                                window.location.href="../../vistas/inventario/detalle_asignacion.php";                   
                            </script>';
      }
      case "confirmar";
      $confirmar = "UPDATE tbl_asignaciones SET ESTADO_ASIGNACION='FINALIZADA' WHERE ID_ASIGNADO='$id_asignado'";
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

       ///////////// RESTA AL INVENTARIO /////////////
       $inventario = "UPDATE tbl_inventario SET CANTIDAD_DISPONIBLE=CANTIDAD_DISPONIBLE - $cantidad WHERE ID_PRODUCTOS='$id_producto'";
       if (mysqli_query($conn, $inventario)) {}

        ///////////// ELIMINA DE LA TABLA KARDEX /////////////
       $sql3 = "DELETE FROM tbl_kardex WHERE ID_PRODUCTO='$id_producto' and ID_ASIGNADO='$id_asignado' ";
        if (mysqli_query($conn, $sql3)) {}
        ///////////// ELIMINA DE LA TABLA DETALLE DE COMPRA /////////////
                        $sql3 = "DELETE FROM tbl_detalle_asignacion WHERE ID_PRODUCTO='$id_producto'";
                        if (mysqli_query($conn, $sql3)) {
                               

                            header('Location: ../../vistas/inventario/detalle_asignacion.php');
                        }else{
                                echo '<script>
                                        alert("Error al tratar de eliminar el producto");
                                    </script>'; mysqli_error($conn);
                            }
                        mysqli_close($conn);
                   
          

      break;
      
      default:
          
          
      $conn->close();   
  }// Fin del switch, para validar el valor del boton accion


?>
