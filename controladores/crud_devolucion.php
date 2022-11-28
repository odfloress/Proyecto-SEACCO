<?php
  require '../../conexion/conexion.php';
  //para mostrar los datos de la tabla mysql y mostrar en el crud
  $sql = "SELECT ID_DEVOLUCION, tbl_devoluciones.ID_PRODUCTO AS ID_PRODUCTOSS, tbl_productos.NOMBRE AS NOMBRE_PRODUCTO, CANTIDAD, tbl_proveedores.NOMBRE, DESCRIPCION_DEVOLUCION, USUARIO, FECHA FROM ((tbl_devoluciones 
  INNER JOIN tbl_proveedores ON tbl_devoluciones.ID_PROVEEDOR = tbl_proveedores.ID_PROVEEDOR)
  INNER JOIN tbl_productos  ON tbl_devoluciones.ID_PRODUCTO = tbl_productos.ID_PRODUCTO)";
  $result = mysqli_query($conn, $sql);


  // //Variables para recuperar la información de los campos de la vista categorias de productos
  $id_devolucion=(isset($_POST['id_devolucion']))?$_POST['id_devolucion']:"";
  $id_productoss=(isset($_POST['id_productoss']))?$_POST['id_productoss']:"";
  
  $productoo=(isset($_POST['producto']))?$_POST['producto']:"";
  $cantidad=(isset($_POST['cantidad']))?$_POST['cantidad']:"";
  $proveedorr=(isset($_POST['proveedor']))?$_POST['proveedor']:"";
  $descricion=(isset($_POST['descripcion']))?$_POST['descripcion']:"";
  

  $usuario1 = $_SESSION;

  //variable para recuperar los botones de la vista categprias de productos  
  $accion=(isset($_POST['accion']))?$_POST['accion']:"";
  
  date_default_timezone_set("America/Guatemala");
        $fecha = date("Y-m-d H:i:s");

      
 
  switch($accion){
      //para insertar en la tabla mysl
      case "agregar": 
       

                //si no existe un proveedor permite insertar
                $sql1 = "INSERT INTO tbl_devoluciones (ID_PRODUCTO, CANTIDAD, ID_PROVEEDOR, DESCRIPCION_DEVOLUCION, USUARIO, FECHA)
                VALUES ('$productoo','$cantidad','$proveedorr','$descricion', '$usuario1[usuario]','$fecha')";
                if (mysqli_query($conn, $sql1)) 
                {
                    $ultimo_id = mysqli_insert_id($conn);
                     ///////////// INSERTA EN LA TABLA TBL_KARDEX /////////////
                    $kardex = "INSERT INTO tbl_kardex (ID_PRODUCTO, ID_COMPRA,  USUARIO, CANTIDAD, TIPO_MOVIMIENTO, FECHA_HORA)
                     VALUES ($productoo, $ultimo_id, '$usuario1[usuario]', $cantidad,  'DEVOLUCION', '$fecha')";
                     if (mysqli_query($conn, $kardex)) 
                        {
                            ///////////// SUMA AL INVENTARIO /////////////
                            $inventario = "UPDATE tbl_inventario SET CANTIDAD_DISPONIBLE=CANTIDAD_DISPONIBLE - $cantidad WHERE ID_PRODUCTOS='$productoo'";
                            if (mysqli_query($conn, $inventario)) {}

                        }


                                     
                    echo '<script>
                                alert("Devolución completada con exito");
                                window.location.href="../../vistas/inventario/devoluciones.php";                   
                            </script>';
                             mysqli_close($conn);
                } else {
                        echo '<script>
                                alert("Error al tratar de crear la devolución");
                              </script>'; mysqli_error($conn);
                       }
                
                mysqli_close($conn);

                                  

             
      break;
      
      //para eliminar en la tabla mysl  
      case "eliminar";
    //   die();
      $sql3 = "DELETE FROM tbl_devoluciones WHERE ID_DEVOLUCION='$id_devolucion'";
      if (mysqli_query($conn, $sql3)) 
      {
   
            ///////////// ELIMINA DE LA TABLA TBL_KARDEX /////////////
            $kardex = "DELETE FROM `tbl_kardex` WHERE ID_PRODUCTO=$id_productoss AND ID_COMPRA=$id_devolucion";
            if (mysqli_query($conn, $kardex)) 
               {
                   ///////////// SUMA AL INVENTARIO /////////////
                   $inventario = "UPDATE tbl_inventario SET CANTIDAD_DISPONIBLE=CANTIDAD_DISPONIBLE + $cantidad WHERE ID_PRODUCTOS='$id_productoss'";
                   if (mysqli_query($conn, $inventario)) {}

               }

            echo '<script>
                    alert("Elimino el devolución");
                    window.location.href="../../vistas/inventario/devoluciones.php";                     
                  </script>';
                  mysqli_close($conn);
     
          
      }else{
              echo '<script>
                        alert("Error al tratar de eliminar la devolución");
                        window.location.href="../../vistas/inventario/devoluciones.php";  
                    </script>'; mysqli_error($conn);
                    mysqli_close($conn);
           }
        
     
    
      break;
      
      default:
          
          $conn->close();   
  }// Fin del switch, para validar el valor del boton accion


?>

