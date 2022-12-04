<?php
  require '../../conexion/conexion.php';
  //para mostrar los datos de la tabla mysql y mostrar en el crud
  $sql = "SELECT * FROM (tbl_compras c
  INNER JOIN tbl_proveedores p ON c.ID_PROVEEDOR = p.ID_PROVEEDOR)";
  $result = mysqli_query($conn, $sql);


  // //Variables para recuperar la información de los campos de la vista roles
  $compra=(isset($_POST['compra']))?$_POST['compra']:"";  
  $proveedor4=(isset($_POST['proveedor']))?$_POST['proveedor']:"";
  $codigo=(isset($_POST['codigo']))?$_POST['codigo']:"";    

  $usuario1 = $_SESSION;

  //variable para recuperar los botones de la vista roles  
  $accion=(isset($_POST['accion']))?$_POST['accion']:"";
  
  
  switch($accion){
     /////////////////////////////////// PARA CREAR COMPRA ////////////////////////////////////
      case "agregar": 
        date_default_timezone_set("America/Guatemala");
        $fecha = date("Y-m-d H:i:s");
                    
                    $sql1 = "INSERT INTO tbl_compras (ID_PROVEEDOR, NUMERO_COMPRA, TOTAL_COMPRA, FECHA_COMPRA, USUARIO, ESTADO_COMPRA)
                    VALUES ('$proveedor4', '$codigo', '0', '$fecha', '$usuario1[usuario]', 'EN PROCESO')";
                    if (mysqli_query($conn, $sql1)) {

                        echo '<script>
                                alert("Seleccione los productos de la compra");
                                window.location.href="../../vistas/inventario/vista_detalle_producto.php";                   
                            </script>';
                             mysqli_close($conn);
                    } else {
                            echo '<script>
                                    alert("Error al tratar de realizar la compra");
                                  </script>'; 
                                  mysqli_error($conn);
                           }
                    
                    mysqli_close($conn);

                                
      break;

       
      
      
      default:
          
          $conn->close();   
  }// Fin del switch, para validar el valor del boton accion


?>
