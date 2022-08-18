<?php
  require '../../conexion/conexion.php';
  //para mostrar los datos de la tabla mysql y mostrar en el crud
  $sql = "SELECT * FROM (tbl_asignaciones a
          INNER JOIN tbl_proyectos p ON a.ID_PROYECTO = p.ID_PROYECTO)
          ORDER BY ID_ASIGNADO";
  $result = mysqli_query($conn, $sql);


  // //Variables para recuperar la información de los campos de la vista roles

  $id_proyecto=(isset($_POST['id_proyecto']))?$_POST['id_proyecto']:"";
  $usuario1 = $_SESSION;
  //variable para recuperar los botones de la vista roles  
  $accion=(isset($_POST['accion']))?$_POST['accion']:"";
  
  
  switch($accion){
      //para insertar en la tabla mysl
      case "agregar": 
        
                    //si no existe el rol permite insertar
                    $sql1 = "INSERT INTO tbl_asignaciones (ID_PROYECTO, DESCRIPCION_ASIGNACION, USUARIO, ESTADO_ASIGNACION)
                    VALUES ('$id_proyecto', '$descripcion_asignacion', '$usuario1[usuario]', 'EN PROCESO')";
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
