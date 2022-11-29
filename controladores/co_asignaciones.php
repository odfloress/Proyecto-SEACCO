<?php
  require '../../conexion/conexion.php';
  //para mostrar los datos de la tabla mysql y mostrar en el crud

  $sql = "SELECT ID_ASIGNADO, ID_PRODUCTO, NOMBRE_PROYECTO, USUARIO,  tbl_productos.NOMBRE AS PRODUCTOSS, CANT_ASIGNADA, CANT_ENTREGADA, ESTADO_ASIGNACION, DESCRIPCION_ASIGNACION, DESCRIPCION_ENTREGA, FECHA_ASIGNADO, FECHA_ENTREGA FROM ((((tbl_asignaciones 
  INNER JOIN tbl_proyectos ON tbl_asignaciones.ID_PROYECTO = tbl_proyectos.ID_PROYECTO)
  INNER JOIN tbl_usuarios  ON tbl_asignaciones.ID_USUARIO = tbl_usuarios.ID_USUARIO)
  INNER JOIN tbl_productos ON tbl_asignaciones.ID_PRODUCTOS = tbl_productos.ID_PRODUCTO)
  INNER JOIN tbl_estado_asignacion  ON tbl_asignaciones.ID_ESTADO_ASIGNACION = tbl_estado_asignacion.ID_ESTADO_ASIGNACION)";
  $result = mysqli_query($conn, $sql);


  // //Variables para recuperar la información de los campos de la vista roles
  $ID_ASIGNACION = (isset($_POST['id_asignado']))?$_POST['id_asignado']:"";

  $ID_PROYECTO=(isset($_POST['id_proyecto']))?$_POST['id_proyecto']:"";
  $ID_USUARIO=(isset($_POST['id_usuario']))?$_POST['id_usuario']:"";
  $ID_PRODUCTO=(isset($_POST['id_producto']))?$_POST['id_producto']:"";
  $CANT_ASIGNADA=(isset($_POST['cantidad_asignada']))?$_POST['cantidad_asignada']:"";
  $CANT_ENTREGADA=(isset($_POST['cantidad_entregada']))?$_POST['cantidad_entregada']:"";
  $CANT_A_ENTREGADAR=(isset($_POST['cantidad_entregada1']))?$_POST['cantidad_entregada1']:"";
  $ID_ESTADO_ASIGNACION=(isset($_POST['id_estado_asignacion']))?$_POST['id_estado_asignacion']:"";
  $DESCRIPCION_ASIGNACION=(isset($_POST['descripcion_asignacion']))?$_POST['descripcion_asignacion']:"";
  $DESCRIPCION_ENTREGA=(isset($_POST['descripcion_entrega']))?$_POST['descripcion_entrega']:"";
  $fecha_asignacion=(isset($_POST['fecha_asignacion']))?$_POST['fecha_asignacion']:"";
  $fecha_entrega=(isset($_POST['fecha_entrega']))?$_POST['fecha_entrega']:"";


  $usuario1 = $_SESSION;
  //variable para recuperar los botones de la vista roles  
  $accion=(isset($_POST['accion']))?$_POST['accion']:"";
  
  date_default_timezone_set("America/Guatemala");
  $fechasss = date("Y-m-d h:i:s");

      // seleccionar la cantidad de producto del inventario
      $cantidad_inventario = "SELECT * FROM tbl_inventario WHERE ID_PRODUCTOS='$ID_PRODUCTO'";
      $cantidad_inventario1 = mysqli_query($conn, $cantidad_inventario);
      if (mysqli_num_rows($cantidad_inventario1) > 0)
      {
       while($row = mysqli_fetch_assoc($cantidad_inventario1))
        { 
            $inventario = $row['CANTIDAD_DISPONIBLE'];
        } 
      }
  
  switch($accion){
      //para insertar en la tabla mysl
      case "agregar": 
    
        if($CANT_ASIGNADA <= $inventario)
        {
           if($fecha_entrega>$fecha_asignacion){     
              $sql1 = "INSERT INTO tbl_asignaciones (ID_PROYECTO, ID_USUARIO, ID_PRODUCTOS, CANT_ASIGNADA, CANT_ENTREGADA, ID_ESTADO_ASIGNACION, DESCRIPCION_ASIGNACION, FECHA_ASIGNADO, FECHA_ENTREGA)
                    VALUES ('$ID_PRODUCTO', '$ID_USUARIO', '$ID_PRODUCTO', '$CANT_ASIGNADA', 0, '$ID_ESTADO_ASIGNACION', '$DESCRIPCION_ASIGNACION' , '$fecha_asignacion', '$fecha_entrega')";
                    if (mysqli_query($conn, $sql1)) 
                  {

                        $ultimo_id = mysqli_insert_id($conn);
                         ///////////// INSERTA EN LA TABLA TBL_KARDEX /////////////
                         $kardex = "INSERT INTO tbl_kardex (ID_PRODUCTO, ID_ASIGNACION, USUARIO, CANTIDAD, TIPO_MOVIMIENTO, FECHA_HORA)
                                    VALUES ('$ID_PRODUCTO', '$ultimo_id', '$usuario1[usuario]', '$CANT_ASIGNADA', 'SALIDA ASIGNACION', '$fechasss')";
                         if (mysqli_query($conn, $kardex)) 
                           {
                            ///////////// RESTA AL INVENTARIO /////////////
                            $inventario = "UPDATE tbl_inventario SET CANTIDAD_DISPONIBLE=CANTIDAD_DISPONIBLE - $CANT_ASIGNADA WHERE ID_PRODUCTOS='$ID_PRODUCTO'";
                            if (mysqli_query($conn, $inventario)) {}

                            }
                         
                        echo '<script>
                                alert("asignación creada con éxito");
                                window.location.href="../../vistas/inventario/vista_asignaciones.php";                   
                            </script>';
                           
                   }else{
                            echo '<script>
                                    alert("Error al tratar de realizar la asignación");
                                    window.location.href="../../vistas/inventario/vista_asignaciones.php"; 
                                  </script>'; 
                                  
                         }

            }else{
              echo '<script>
                      alert("Error, Fecha de entrega debe ser mayor a la asignada.");
                     
                    </script>'; 
            } 
                    
     }else{
                                echo '<script>
                                         alert("Error, la cantidad asignada es mayor al inventario disponible");
                                        //  window.location.href="../../vistas/inventario/vista_asignaciones.php"; 
                                      </script>'; 
                          }
                                
      break;
      case "editar": 

        $CANTIDAD_restante = $CANT_ASIGNADA - $CANT_ENTREGADA;


        if($CANT_A_ENTREGADAR <= $CANTIDAD_restante)
        {
          $Nueva_cantidad = $CANT_ENTREGADA + $CANT_A_ENTREGADAR;
            $sql2 = "UPDATE tbl_asignaciones SET CANT_ENTREGADA='$Nueva_cantidad', ID_ESTADO_ASIGNACION='$ID_ESTADO_ASIGNACION', DESCRIPCION_ENTREGA='$DESCRIPCION_ENTREGA'  WHERE ID_ASIGNADO='$ID_ASIGNACION'";
            if (mysqli_query($conn, $sql2)) 
            {

                    ///////////// INSERTA EN LA TABLA TBL_KARDEX /////////////
                  $kardex = "INSERT INTO tbl_kardex (ID_PRODUCTO, ID_ASIGNACION, USUARIO, CANTIDAD, TIPO_MOVIMIENTO, FECHA_HORA)
                  VALUES ('$ID_PRODUCTO', '$ID_ASIGNACION', '$usuario1[usuario]', '$CANT_A_ENTREGADAR', 'ENTRADA ASIGNACION', '$fechasss')";
                  if (mysqli_query($conn, $kardex)) 
                  {

                    
                    ///////////// SUMA AL INVENTARIO /////////////
                    $inventario = "UPDATE tbl_inventario SET CANTIDAD_DISPONIBLE=CANTIDAD_DISPONIBLE + $CANT_A_ENTREGADAR WHERE ID_PRODUCTOS='$ID_PRODUCTO'";
                      if (mysqli_query($conn, $inventario)) {}

                  }

                    echo '<script>
                            alert("Edición éxitosa.");
                            window.location.href="../../vistas/inventario/vista_asignaciones.php";  
                          </script>'; 

            }
        }else{
          echo '<script>
                  alert("Error, la cantidad no coincide.");
                  // window.location.href="../../vistas/inventario/vista_asignaciones.php";  
                </script>'; 
        }


        break;

        case "eliminar": 
          if($CANT_ENTREGADA==0){

          
          

          $sql3 = "DELETE FROM tbl_asignaciones WHERE ID_ASIGNADO='$ID_ASIGNACION'";
          if (mysqli_query($conn, $sql3)) 
          {
             ///////////// ELIMINA DE LA TABLA KARDEX /////////////
            $sql3 = "DELETE FROM tbl_kardex WHERE ID_PRODUCTO='$ID_PRODUCTO' and ID_ASIGNACION='$ID_ASIGNACION' ";
            if (mysqli_query($conn, $sql3)) 
            {
                  ///////////// SUMA AL INVENTARIO /////////////
                  $inventario = "UPDATE tbl_inventario SET CANTIDAD_DISPONIBLE=CANTIDAD_DISPONIBLE + $CANT_ASIGNADA WHERE ID_PRODUCTOS='$ID_PRODUCTO'";
                  if (mysqli_query($conn, $inventario)) {}
            }
              header('Location: ../../vistas/inventario/vista_asignaciones.php');
          }else{
                  echo '<script>
                          alert("Error al tratar de eliminar la asignación");
                      </script>'; 
              }
          mysqli_close($conn);

        }else{
          echo '<script>
          alert("Error, la asignacion esta en proceso.");
          window.location.href="../../vistas/inventario/vista_asignaciones.php";  
        </script>'; 
        }

        break;
       
        case "eliminar_entrega": 

          $sql2 = "UPDATE tbl_asignaciones SET CANT_ENTREGADA=CANT_ENTREGADA-$CANT_ENTREGADA WHERE ID_ASIGNADO='$ID_ASIGNACION'";
          if (mysqli_query($conn, $sql2)) 
          {
                 ///////////// ELIMINA DE LA TABLA KARDEX /////////////
            $sql3 = "DELETE FROM tbl_kardex WHERE ID_PRODUCTO='$ID_PRODUCTO' and ID_ASIGNACION='$ID_ASIGNACION' and CANTIDAD='$CANT_ENTREGADA' AND FECHA_HORA='$fecha_entrega'";
            if (mysqli_query($conn, $sql3)) 
            {
                  ///////////// resta AL INVENTARIO /////////////
                  $inventario = "UPDATE tbl_inventario SET CANTIDAD_DISPONIBLE=CANTIDAD_DISPONIBLE - $CANT_ENTREGADA WHERE ID_PRODUCTOS='$ID_PRODUCTO'";
                  if (mysqli_query($conn, $inventario)) {}
            }
              header('Location: ../../vistas/inventario/vista_asignaciones.php');
          }

        
        break;
      
      default:
          
          $conn->close();   
  }// Fin del switch, para validar el valor del boton accion


?>
