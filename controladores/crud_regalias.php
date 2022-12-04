<?php
  require '../../conexion/conexion.php';
  //para mostrar los datos de la tabla mysql y mostrar en el crud
  $sql = "SELECT ID_REGALIA, tbl_regalias.ID_PRODUCTO AS ID_PRODUCTOSS, tbl_productos.NOMBRE AS NOMBRE_PRODUCTO, CANTIDAD_REGALIA, DESCRIPCION_REGALIA, USUARIO, FECHA_REGALIA FROM (tbl_regalias 
  INNER JOIN tbl_productos  ON tbl_regalias.ID_PRODUCTO = tbl_productos.ID_PRODUCTO)";
  $result = mysqli_query($conn, $sql);


 // //Variables para recuperar la información de los campos de la vista 
  $productoo=(isset($_POST['producto']))?$_POST['producto']:"";
  $cantidad=(isset($_POST['cantidad']))?$_POST['cantidad']:"";
  $descricion=(isset($_POST['descripcion']))?$_POST['descripcion']:"";

 
  $id_devolucion=(isset($_POST['id_regalia']))?$_POST['id_regalia']:"";
  $id_productoss=(isset($_POST['id_productoss']))?$_POST['id_productoss']:"";
  

  

  $usuario1 = $_SESSION;

  //variable para recuperar los botones de la vista categprias de productos  
  $accion=(isset($_POST['accion']))?$_POST['accion']:"";
  
  date_default_timezone_set("America/Guatemala");
        $fecha = date("Y-m-d H:i:s");


    
      
 
  switch($accion){
      //para insertar en la tabla mysl
      case "agregar": 
       
       
               
                $sql1 = "INSERT INTO tbl_regalias (ID_PRODUCTO, CANTIDAD_REGALIA,  DESCRIPCION_REGALIA, USUARIO, FECHA_REGALIA)
                VALUES ('$productoo','$cantidad', '$descricion', '$usuario1[usuario]','$fecha')";
                if (mysqli_query($conn, $sql1)) 
                {
                    $ultimo_id = mysqli_insert_id($conn);
                     ///////////// INSERTA EN LA TABLA TBL_KARDEX /////////////
                    $kardex = "INSERT INTO tbl_kardex (ID_PRODUCTO, ID_COMPRA,  USUARIO, CANTIDAD, TIPO_MOVIMIENTO, FECHA_HORA)
                     VALUES ($productoo, $ultimo_id, '$usuario1[usuario]', $cantidad,  'OTRA ENTRADA', '$fecha')";
                     if (mysqli_query($conn, $kardex)) 
                        {
                            ///////////// RESTA AL INVENTARIO /////////////
                            $inventario = "UPDATE tbl_inventario SET CANTIDAD_DISPONIBLE=CANTIDAD_DISPONIBLE + $cantidad WHERE ID_PRODUCTOS='$productoo'";
                            if (mysqli_query($conn, $inventario)) {}

                        }


                                     
                    echo '<script>
                                alert("Proceso completado con exito");
                                window.location.href="../../vistas/inventario/regalias.php";                   
                            </script>';
                             mysqli_close($conn);
                } else {
                        echo '<script>
                                alert("Error al tratar de ingresar entrada");
                              </script>'; 
                       }
                
                mysqli_close($conn);
              
                                  

             
      break;
      
      //para eliminar en la tabla mysl  
      case "eliminar";

      // echo $id_productoss.'<br>';
      // echo $id_devolucion.'<br>';
      // echo $cantidad.'<br>';
      // echo $fecha.'<br>';
      // die();
      $sql3 = "DELETE FROM tbl_regalias WHERE ID_REGALIA='$id_devolucion'";
      if (mysqli_query($conn, $sql3)) 
      {
   
      
            
           ///////////// INSERTA EN LA TABLA TBL_KARDEX /////////////
           $kardex = "INSERT INTO tbl_kardex (ID_PRODUCTO, ID_COMPRA,  USUARIO, CANTIDAD, TIPO_MOVIMIENTO, FECHA_HORA)
           VALUES ($id_productoss, $id_devolucion, '$usuario1[usuario]', $cantidad,  'ANULACION DE ENTRADA', '$fecha')";
           if (mysqli_query($conn, $kardex)) 
              {
                  ///////////// RESTA AL INVENTARIO /////////////
                  $inventario = "UPDATE tbl_inventario SET CANTIDAD_DISPONIBLE=CANTIDAD_DISPONIBLE - $cantidad WHERE ID_PRODUCTOS='$id_productoss'";
                  if (mysqli_query($conn, $inventario)) {}

              }

            echo '<script>
                    alert("Elimino la entrada");
                    window.location.href="../../vistas/inventario/regalias.php";                     
                  </script>';
                  mysqli_close($conn);
     
          
      }else{
              echo '<script>
                        alert("Error al tratar de eliminar la entrada");
                        window.location.href="../../vistas/inventario/regalias.php";  
                    </script>'; mysqli_error($conn);
                    mysqli_close($conn);
           }
        
     
    
      break;
      
      default:
          
          $conn->close();   
  }// Fin del switch, para validar el valor del boton accion


?>

