<?php
  require '../../conexion/conexion.php';
  $usuario1 = $_SESSION;
   //selecciona el id de la comra en proceso
   $validar_compra7 = "SELECT * FROM tbl_compras WHERE USUARIO='$usuario1[usuario]' and ESTADO_COMPRA='EN PROCESO'";
   $validar_compra77 = mysqli_query($conn, $validar_compra7);
   if (mysqli_num_rows($validar_compra77) > 0)
   {
         while($row = mysqli_fetch_assoc($validar_compra77)) 
         {
               $id_compra = $row["ID_COMPRA"];
               $precio_anterior = $row["TOTAL_COMPRA"];
         }
   }

  //para mostrar los datos de la tabla mysql y mostrar en el crud
  $sql = "SELECT * FROM ((tbl_detalle_compra d
  INNER JOIN tbl_unidad_medida u ON d.ID_UNIDAD_MEDIDA = u.ID_UNIDAD_MEDIDA)
  INNER JOIN tbl_productos p ON d.ID_PRODUCTO = p.ID_PRODUCTO) WHERE ID_COMPRA='$id_compra'";
  $result = mysqli_query($conn, $sql);
 

  // //Variables para recuperar la información de los campos de la vista roles
  $id_detalle=(isset($_POST['id_detalle']))?$_POST['id_detalle']:"";
  $producto=(isset($_POST['producto']))?$_POST['producto']:"";
  $garantia14=(isset($_POST['garantia']))?$_POST['garantia']:"";
  $unidad_medida14=(isset($_POST['unidad_medida']))?$_POST['unidad_medida']:"";
  $cantidad=(isset($_POST['cantidad']))?$_POST['cantidad']:"";
  $precio=(isset($_POST['precio']))?$_POST['precio']:"";
  $anterior=(isset($_POST['nombre_anterior']))?$_POST['nombre_anterior']:"";
  
  //variable para recuperar los botones de la vista roles  
  $accion=(isset($_POST['accion']))?$_POST['accion']:"";
  
  date_default_timezone_set("America/Guatemala");
  $fechasss = date("Y-m-d h:i:s");
  
  switch($accion){
  /////////////////////////////////// PARA INSERTAR ////////////////////////////////////
      case "agregar": 
       ///////////// INSERTA EN LA TABLA TBL_DETALLE COMPRA /////////////

        $sql1 = "INSERT INTO tbl_detalle_compra (ID_COMPRA, ID_PRODUCTO, GARANTIA, ID_UNIDAD_MEDIDA, CANTIDAD, PRECIO)
        VALUES ('$id_compra', '$producto', '$garantia14', '$unidad_medida14', '$cantidad', '$precio')";
         if (mysqli_query($conn, $sql1)) 
         {
           ///////////// SUMA EL PRECIO TOTAL EN LA TABLA TBL_COMPRA /////////////
            $total = $cantidad * $precio;
            $total_compra = "UPDATE tbl_compras SET TOTAL_COMPRA=TOTAL_COMPRA + $total WHERE ID_COMPRA='$id_compra'";
            if (mysqli_query($conn, $total_compra)){}

            ///////////// INSERTA EN LA TABLA TBL_KARDEX /////////////
            $kardex = "INSERT INTO tbl_kardex (ID_PRODUCTO, ID_COMPRA, USUARIO, CANTIDAD, TIPO_MOVIMIENTO, FECHA_HORA)
            VALUES ('$producto', '$id_compra', '$usuario1[usuario]', '$cantidad', 'ENTRADA COMPRA', '$fechasss')";
            if (mysqli_query($conn, $kardex)) 
             {
               ///////////// SUMA AL INVENTARIO /////////////
               $inventario = "UPDATE tbl_inventario SET CANTIDAD_DISPONIBLE=CANTIDAD_DISPONIBLE + $cantidad WHERE ID_PRODUCTOS='$producto'";
                if (mysqli_query($conn, $inventario)) {}

             }
                echo '<script>
                         alert("Producto agregado con exito");
                         window.location.href="../../vistas/inventario/vista_detalle_producto.php";                   
                      </script>';
         }else{
                echo '<script>
                        alert("Error al tratar de agregar el producto");
                      </script>';          
              }                  
      break;

      case "cancelar";
      ///////////// ELIMINA DE LA TABLA DETALLE DE COMPRA /////////////
      $detalle5 = "DELETE FROM tbl_detalle_compra WHERE ID_COMPRA='$id_compra'";
      if (mysqli_query($conn, $detalle5)) 
      {
                ///////////// ELIMINA DE LA TABLA KARDEX /////////////
                $kardex1 = "DELETE FROM tbl_kardex WHERE ID_COMPRA='$id_compra'";
                if (mysqli_query($conn, $kardex1)) {}

                ///////////// ELIMINA LA COMPRA DE LA TABLA DE COMPRAS /////////////
                $compra1 = "DELETE FROM tbl_compras WHERE ID_COMPRA='$id_compra'";
                if (mysqli_query($conn, $compra1)) {}

                ///////////// RESTA AL INVENTARIO atraves de un trigger ubicado en la tabla tbl_detalle_compra /////////////
                echo '<script>
                         alert("Compra eliminada con exito");
                         window.location.href="../../vistas/inventario/vista_compras.php";                   
                      </script>';
      }

      break;

      case "confirmar";
      $pre_confirmacion = "SELECT * FROM  tbl_detalle_compra WHERE ID_COMPRA='$id_compra'";
      $pre_result = mysqli_query($conn, $pre_confirmacion);
      
      if (mysqli_num_rows($pre_result) > 0) 
      {
        $confirmar = "UPDATE tbl_compras SET ESTADO_COMPRA='FINALIZADO' WHERE ID_COMPRA='$id_compra'";
         if (mysqli_query($conn, $confirmar)) 
             {
               echo '<script>
                        alert("Compra completada con exito");
                        window.location.href="../../vistas/inventario/vista_compras.php";                   
                     </script>';
             }
       }else{
              echo '<script>
                        alert("Debe seleccionar producto para confirmar");
                        window.location.href="../../vistas/inventario/vista_detalle_producto.php";                   
                     </script>';
            }  

      break;

     
      //para eliminar en la tabla mysl  
      case "eliminar"; 
     
       ///////////// Resta EL PRECIO TOTAL EN LA TABLA TBL_COMPRA /////////////
       $total = $cantidad * $precio;
       $total_compras = "UPDATE tbl_compras SET TOTAL_COMPRA=TOTAL_COMPRA - $total WHERE ID_COMPRA=$id_compra";
       if (mysqli_query($conn, $total_compras)) {}

        ///////////// ELIMINA DE LA TABLA KARDEX /////////////
        $sql3 = "DELETE FROM tbl_kardex WHERE ID_PRODUCTO='$producto' and ID_COMPRA='$id_compra' ";
        if (mysqli_query($conn, $sql3)) {}

        ///////////// ELIMINA DE LA TABLA DETALLE DE COMPRA /////////////
        $sql3 = "DELETE FROM tbl_detalle_compra WHERE ID_PRODUCTO='$producto'";
        if (mysqli_query($conn, $sql3)) 
        {
            header('Location: ../../vistas/inventario/vista_detalle_producto.php');
        }else{
                 echo '<script>
                          alert("Error al tratar de eliminar el producto");
                       </script>'; mysqli_error($conn);
             }
        ///////////// RESTA AL INVENTARIO atraves de un trigger ubicado en la tabla tbl_detalle_compra /////////////
                        mysqli_close($conn);
      break;
      
      default:
          
          
      $conn->close();   
  }// Fin del switch, para validar el valor del boton accion


?>
