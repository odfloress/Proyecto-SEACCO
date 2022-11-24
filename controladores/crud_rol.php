<?php
  require '../../conexion/conexion.php';
  //para mostrar los datos de la tabla mysql y mostrar en el crud
  $sql = "SELECT * FROM tbl_roles WHERE ROL NOT IN (SELECT ROL FROM  tbl_roles WHERE ID_ROL=3 ) ORDER BY ID_ROL";
  $result = mysqli_query($conn, $sql);

  /////// RECUPERAR LA INFORMACION DE LOS FORMULARIOS DE LA PANTALLA ROLES /////////////
  $id_rol=(isset($_POST['id_rol']))?$_POST['id_rol']:"";
  $rol=(isset($_POST['rol']))?$_POST['rol']:"";
  $estado_rol=(isset($_POST['estado_rol']))?$_POST['estado_rol']:"";
  $descripcion=(isset($_POST['descripcion']))?$_POST['descripcion']:"";
  $anterior=(isset($_POST['nombre_anterior']))?$_POST['nombre_anterior']:"";

  ////////////////////////// información del usuario logueado /////////////////
  $usuario1 = $_SESSION;

  ////////// variable para recuperar los botones de la vista de Roles //////////////
  $accion=(isset($_POST['accion']))?$_POST['accion']:"";

  ///////////////// INICIO SELECCIONAR LOS DATOS ACTUALES ////////////////////
  $mostrar_actuales= "SELECT * FROM tbl_roles WHERE ID_ROL='$id_rol'";
  $sultados_actuales = $conn->query($mostrar_actuales);
  if ($sultados_actuales->num_rows > 0) 
  {
   while($datos_actuales = $sultados_actuales->fetch_assoc()) 
   {
     $ROLL = $datos_actuales["ROL"];
     $DESCRIPCIONN = $datos_actuales["DESCRIPCION"];
     $ESTADO_ROLL = $datos_actuales["ESTADO_ROL"];
   }
 }
 ///////////////// FIN SELECCIONAR LOS DATOS ACTUALES ////////////////////
  
  switch($accion)
  {
   /////////////////////////////////// PARA INSERTAR ////////////////////////////////////
    case "agregar": 
      $validar_rol = "SELECT * FROM tbl_roles WHERE ROL='$rol'"; //////// VALIDA SI EXISTE UN ROL CON EL MISMO NOMBRE
      $result1 = mysqli_query($conn, $validar_rol); 
      if (mysqli_num_rows($result1) > 0) 
      { 
        echo '<script>
                alert("El nombre de rol ingresado ya existe, intente con otro");
              </script>';
              mysqli_close($conn);
      }else{ 
             $sql1 = "INSERT INTO tbl_roles (ROL, DESCRIPCION, ESTADO_ROL)  
                      VALUES ('$rol', '$descripcion', '$estado_rol')"; ////// si no existe el rol permite insertar
                      if (mysqli_query($conn, $sql1)) 
                      {     
                        $ultimo_id = mysqli_insert_id($conn);  
                        include_once 'funcion_bitacora.php';
                        bitacora('INSERTO', 'ROLES', 'NUEVO', $ultimo_id, 'NUEVO', 'NUEVO');               
                        echo '<script>
                                alert("Rol creado con exito");
                                window.location.href="../../vistas/ajustes/vista_roles.php";                   
                              </script>';
                             mysqli_close($conn);
                      }else{
                            echo '<script>
                                    alert("Error al tratar de crear rol");
                                  </script>'; 
                                  mysqli_error($conn);
                                  mysqli_close($conn);
                           }
           }                      
  break;
  /////////////////////////////////// PARA EDITAR ////////////////////////////////////
  case "editar";
      $validar_rol= "SELECT * FROM tbl_roles WHERE Rol='$rol'"; //////// VALIDA SI EXISTE UN ROL CON EL MISMO NOMBRE
      $result2 = mysqli_query($conn, $validar_rol); 
         if (mysqli_num_rows($result2) > 0) 
         {  
          $sql2 = "UPDATE tbl_roles SET  DESCRIPCION='$descripcion', ESTADO_ROL='$estado_rol'  WHERE ID_ROL='$id_rol'";
                if (mysqli_query($conn, $sql2)) 
                {
                  echo '<script>
                           alert("Descripción del rol actualizado con éxito");
                           window.location.href="../../vistas/ajustes/vista_roles.php";                   
                         </script>';
                         mysqli_close($conn);
                }else{
                      echo '<script>
                              alert("Error al tratar de editar rol");
                            </script>'; mysqli_error($conn);
                            mysqli_close($conn);
                     }

                // si no existe el rol con el mismo nombre
          }else{
                $sql2 = "UPDATE tbl_roles SET ROL='$rol', DESCRIPCION='$descripcion', ESTADO_ROL='$estado_rol'  WHERE ID_ROL='$id_rol'";
                if (mysqli_query($conn, $sql2)) 
                {
                 echo '<script>
                         alert("Rol actualizado con éxito");
                         window.location.href="../../vistas/ajustes/vista_roles.php";                   
                       </script>';
                       mysqli_close($conn);      
                }
              }

                // ////////////// INICIO FUNCION BITACORA /////////////////////
                if($ROLL !== $rol) ///////////// ROL
                {
                include_once 'funcion_bitacora.php';
                bitacora('EDITO', 'ROLES', 'ROL', $id_rol, $ROLL, $rol);
                }
                if($DESCRIPCIONN !== $descripcion) ///////////// DESCRIPCION
                {
                include_once 'funcion_bitacora.php';
                bitacora('EDITO', 'ROLES', 'DESCRIPCION', $id_rol, $DESCRIPCIONN, $descripcion);
                }
                if($ESTADO_ROLL !== $estado_rol) ///////////// ESTADO_ROL
                {
                include_once 'funcion_bitacora.php';
                bitacora('EDITO', 'ROLES', 'ESTADO', $id_rol, $ESTADO_ROLL, $estado_rol);
                }
                // ////////////// FIN FUNCION BITACORA ///////////////////////
      break;
    /////////////////////////////////// PARA ELIMINAR ////////////////////////////////////
    case "eliminar";

    //validar que no este asignado a un usuario
    $validar_rol = "SELECT * FROM tbl_usuarios WHERE ID_ROL='$id_rol'";
    $result4 = mysqli_query($conn, $validar_rol); 
     if (mysqli_num_rows($result4) > 0) 
     { 
       echo '<script>
                alert("No se puede eliminar el rol, este se encuentra en uso");
                window.location.href="../../vistas/ajustes/vista_roles.php";                   
             </script>';
             mysqli_close($conn);
     }else{
           //validar que no este asignado en la tabla tbl_ms_roles_objetos
           $validar_rol = "SELECT * FROM tbl_ms_roles_ojetos WHERE ID_ROL='$id_rol'";
           $result5 = mysqli_query($conn, $validar_rol); 
           if (mysqli_num_rows($result5) > 0) 
           { 
             echo '<script>
                       alert("No se puede eliminar el rol, este se encuentra en uso.");
                        window.location.href="../../vistas/ajustes/vista_roles.php";                   
                   </script>';
                   mysqli_close($conn);
           }else{
                 $sql3 = "DELETE FROM tbl_roles WHERE ID_ROL='$id_rol'";
                 if (mysqli_query($conn, $sql3)) 
                 {
                   include_once 'funcion_bitacora.php';
                   bitacora('ELIMINO', 'ROLES', 'ROL', $id_rol, $ROLL, $ROLL);  
                   header('Location: ../../vistas/ajustes/vista_roles.php');
                        }else{
                              echo '<script>
                                      alert("Error al tratar de eliminar el rol");
                                     </script>'; mysqli_error($conn);
                                     mysqli_close($conn);
                             }
                 }
        }
      break;
      default:
          $conn->close();   
}


?>
