<?php
  require '../../conexion/conexion.php';
  //para mostrar los datos de la tabla mysql y mostrar en el crud
  $sql = "SELECT * FROM (tbl_asignaciones a
          INNER JOIN tbl_proyectos p ON a.ID_PROYECTO = p.ID_PROYECTO)
          ORDER BY ID_ASIGNADO";
  $result = mysqli_query($conn, $sql);


  // //Variables para recuperar la información de los campos de la vista roles
  $asignacion=(isset($_POST['asignacion']))?$_POST['asignacion']:"";  
  $id_producto=(isset($_POST['id_producto']))?$_POST['id_producto']:"";
  $id_proyecto=(isset($_POST['id_proyecto']))?$_POST['id_proyecto']:"";
  $empleado1=(isset($_POST['id_usuario']))?$_POST['id_usuario']:"";
  //$descripcion_asignacion=(isset($_POST['descripcion_asignacion']))?$_POST['descripcion_asignacion']:"";
  $cantidad=(isset($_POST['cantidad']))?$_POST['cantidad']:"";
  $id_estado_herramienta=(isset($_POST['id_estado_herramienta']))?$_POST['id_estado_herramienta']:"";
  $id_estado_asignacion=(isset($_POST['id_estado_asignacion']))?$_POST['id_estado_asignacion']:"";
  $fecha_asignado=(isset($_POST['fecha_asignado']))?$_POST['fecha_asignado']:"";
  $fecha_entrega=(isset($_POST['fecha_entrega']))?$_POST['fecha_entrega']:"";
  $id_estado_herramienta=(isset($_POST['id_estado_herramienta']))?$_POST['id_estado_herramienta']:"";
  $id_estado_asignacion=(isset($_POST['id_estado_asignacion']))?$_POST['id_estado_asignacion']:"";
  $usuario1 = $_SESSION;
  //variable para recuperar los botones de la vista roles  
  $accion=(isset($_POST['accion']))?$_POST['accion']:"";
  
  
  switch($accion){
      //para insertar en la tabla mysl
      case "agregar": 
        
                    //si no existe el rol permite insertar
                    $sql1 = "INSERT INTO tbl_asignaciones (ID_PROYECTO, DESCRIPCION_ASIGNACION, FECHA_ENTREGA, USUARIO, ESTADO_ASIGNACION)
                    VALUES ('$id_proyecto', '$descripcion_asignacion', '$fecha_entrega', '$usuario1[usuario]', 'EN PROCESO')";
                    if (mysqli_query($conn, $sql1)) {

                         // inicio inserta en la tabla bitacora
                            $sql7 = "INSERT INTO tbl_bitacora (USUARIO, ACCION, OBSERVACION)
                            VALUES ('$usuario1[usuario]', 'INSERTO', 'CREÓ UNA ASIGNACIÓN')";
                             if (mysqli_query($conn, $sql7)) {} else { }
                        // fin inserta en la tabla bitacora
                        echo '<script>
                                alert("Seleccione los productos de la asignación");
                                window.location.href="../../vistas/inventario/detalle_asignacion.php";                   
                            </script>';
                           
                    } else {
                            echo '<script>
                                    alert("Error al tratar de realizar la asignación");
                                  </script>'; 
                                  mysqli_error($conn);
                           }
                    
                    mysqli_close($conn);

                                
      break;
//       case "detalle": 
//         echo $compra;

//         break;
       
      
      
      default:
          
          $conn->close();   
  }// Fin del switch, para validar el valor del boton accion


?>
