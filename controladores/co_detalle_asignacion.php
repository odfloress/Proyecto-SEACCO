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
  $sql = "SELECT * FROM ((((tbl_detalle_asignacion da
          INNER JOIN tbl_productos pr ON da.ID_PRODUCTO = pr.ID_PRODUCTO)
          INNER JOIN tbl_estado_herramienta eh ON da.ID_ESTADO_HERRAMIENTA = eh.ID_ESTADO_HERRAMIENTA)
          INNER JOIN tbl_estado_asignacion ea ON da.ID_ESTADO_ASIGNACION = ea.ID_ESTADO_ASIGNACION)
          INNER JOIN tbl_inventario i ON da.ID_PRODUCTO = i.ID_PRODUCTOS)
  WHERE ID_ASIGNADO='$id_asignado'";
  $result = mysqli_query($conn, $sql);

 

  // //Variables para recuperar la información de los campos de la vista detalle
  //$id_asignado=(isset($_POST['id_asignado']))?$_POST['id_asignado']:"";
  $id_producto=(isset($_POST['id_producto']))?$_POST['id_producto']:"";
  $empleado=(isset($_POST['id_usuario']))?$_POST['id_usuario']:"";
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

      // seleccionar la cantidad de producto del inventario
      $cantidad_inventario = "SELECT * FROM tbl_inventario WHERE ID_PRODUCTOS='$id_producto'";
      $cantidad_inventario1 = mysqli_query($conn, $cantidad_inventario);
      if (mysqli_num_rows($cantidad_inventario1) > 0)
      {
       while($row = mysqli_fetch_assoc($cantidad_inventario1))
        { 
            $inventario = $row['CANTIDAD_DISPONIBLE'];
        } 
      }

  switch($accion){
  
      case "agregar":  

if($cantidad <= $inventario){
                    ///////////// INSERTA EN LA TABLA TBL_DETALLE_ASIGACIONES /////////////

      $sql1 = "INSERT INTO tbl_detalle_asignacion (ID_ASIGNADO, DESCRIPCION_ASIGNACION1, ID_PRODUCTO, CANTIDAD, USUARIO1, FECHA_ENTREGA, ID_ESTADO_HERRAMIENTA, ID_ESTADO_ASIGNACION)
      VALUES ('$id_asignado', '$descripcion_asignacion', '$id_producto', '$cantidad', '$empleado', '$fecha_entrega', '$id_estado_herramienta','1')";
      if (mysqli_query($conn, $sql1)) {
 
              $restar_inventario = "UPDATE tbl_inventario SET CANTIDAD_DISPONIBLE = CANTIDAD_DISPONIBLE-'$cantidad' WHERE ID_PRODUCTOS = '$id_producto'";
              if (mysqli_query($conn, $restar_inventario)) {  
    
                      ///////////// INSERTA EN LA TABLA TBL_KARDEX /////////////
                      $kardex = "INSERT INTO tbl_kardex (ID_PRODUCTO, ID_COMPRA, ID_ASIGNACION, USUARIO, CANTIDAD, TIPO_MOVIMIENTO)
                      VALUES ('$id_producto', NULL, '$id_asignado', '$usuario1[usuario]', '$cantidad', 'SALIDA')";                   
                         if (mysqli_query($conn, $kardex)) {
        
                          echo '<script>
                                    alert("Producto agregado con exito");
                                    window.location.href="../../vistas/inventario/detalle_asignacion.php";                   
                                </script>';
                                        
                        }
                        $bitacora = "INSERT INTO tbl_bitacora (USUARIO, ACCION, OBSERVACION)
                        VALUES ('$usuario1[usuario]', 'INSERTO', 'CREÓ LA ASIGNACIÓN PARA EL EMPLEADO $empleado')";
                         if (mysqli_query($conn, $bitacora)) {} else { }
                  
                  } 
         }else {
                  echo '<script>
                               alert("Error al tratar de asignar el producto");
                        </script>'; 

               }   
            
      }else{
            echo '<script>
                     alert("Error, la cantidad asignada es mayor al del inventario");
                  </script>'; 
      }


      break;

      case "cancelar";

        ///////////// ELIMINA DE LA TABLA DETALLE DE COMPRA /////////////
      $detalle5 = "DELETE FROM tbl_detalle_asignacion WHERE ID_ASIGNADO='$id_asignado'";
      if (mysqli_query($conn, $detalle5)) 
      {
                ///////////// ELIMINA DE LA TABLA KARDEX /////////////
                $kardex1 = "DELETE FROM tbl_kardex WHERE ID_ASIGNACION='$id_asignado'";
                if (mysqli_query($conn, $kardex1)) {}
                ///////////// ELIMINA LA COMPRA DE LA TABLA DE COMPRAS /////////////
                $compra1 = "DELETE FROM tbl_asignaciones WHERE ID_ASIGNADO='$id_asignado'";
                if (mysqli_query($conn, $compra1)) {}
                ///////////// INSERTA EN BITACORA /////////////
                // inicio inserta en la tabla bitacora
                $sql = "INSERT INTO tbl_bitacora (USUARIO, ACCION, OBSERVACION)
                VALUES ('$usuario1[usuario]', 'ELIMINO', 'CANCELO UNA ASIGNACION')";
                if (mysqli_query($conn, $sql)) {} else {}
                // fin inserta en la tabla bitacora
                echo '<script>
                                alert("Asignación eliminada con exito");
                                window.location.href="../../vistas/inventario/vista_compras.php";                   
                            </script>';
      }
      break;
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

            ///////////// ELIMINA DE LA TABLA INVENTARIO /////////////

      ///////////// ELIMINA DE LA TABLA KARDEX /////////////
     $sql3 = "DELETE FROM tbl_kardex WHERE ID_PRODUCTO='$id_producto' and ID_ASIGNACION='$id_asignado' ";
      if (mysqli_query($conn, $sql3)) {}
      ///////////// ELIMINA DE LA TABLA DETALLE DE COMPRA /////////////
                      $sql3 = "DELETE FROM tbl_detalle_asignacion WHERE ID_PRODUCTO='$id_producto' and ID_ASIGNADO='$id_asignado'";
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
