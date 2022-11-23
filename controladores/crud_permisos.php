<?php
  require '../../conexion/conexion.php';
 

  /////// RECUPERAR LA INFORMACION DE LOS FORMULARIOS DE LA PANTALLA PERMISOS /////////////
  $rol=(isset($_POST['lista1']))?$_POST['lista1']:"";
  $pantalla=(isset($_POST['lista2']))?$_POST['lista2']:"";
  $insertar=(isset($_POST['insertar']))?$_POST['insertar']:"";
  $eliminar=(isset($_POST['eliminar2']))?$_POST['eliminar2']:"";
  $editar=(isset($_POST['editar2']))?$_POST['editar2']:"";
  $consultar=(isset($_POST['consultar']))?$_POST['consultar']:"";
  
  ////////////////////////// información del usuario logueado /////////////////
  $usuario1 = $_SESSION;

  ////////// variable para recuperar los botones de la vista de PERMISOS //////////////
  $accion=(isset($_POST['accion']))?$_POST['accion']:"";

  ////////////// SELECCIONA EL NOMBRE DEL ROL ////////////////////
  $roles4 = "SELECT * FROM tbl_roles WHERE ID_ROL='$rol'";
                            $roles5 = mysqli_query($conn, $roles4);
                            if (mysqli_num_rows($roles5) > 0) 
                            { 
                                while($row = mysqli_fetch_assoc($roles5))
                                {
                                  $nombre_rol = "$row[ROL]";
                                }
                            }
  ////////////// SELECCIONA EL NOMBRE DE LA PANTALLA ////////////////////
  $roles14 = "SELECT * FROM tbl_ms_objetos WHERE ID_OBJETO='$pantalla'";
  $roles15 = mysqli_query($conn, $roles14);
  if (mysqli_num_rows($roles15) > 0) 
  { 
      while($row = mysqli_fetch_assoc($roles15))
      {
        $nombre_pantalla = "$row[OBJETO]";
      }
  }

   ///////////////// INICIO SELECCIONAR LOS DATOS ACTUALES ////////////////////
   $mostrar_actuales= "SELECT * FROM tbl_ms_roles_ojetos WHERE ID_OBJETO='$pantalla' and ID_ROL='$rol'";
   $sultados_actuales = $conn->query($mostrar_actuales);
   if ($sultados_actuales->num_rows > 0) 
   {
    while($datos_actuales = $sultados_actuales->fetch_assoc()) 
    {
      $INSERTARR = $datos_actuales["PERMISO_INSERCION"];
      $ELIMINARR = $datos_actuales["PERMISO_ELIMINACION"];
      $EDITARR = $datos_actuales["PERMISO_ACTUALIZACION"];
      $CONSULTARR = $datos_actuales["PERMISO_CONSULTAR"];
    }
  }
  ///////////////// FIN SELECCIONAR LOS DATOS ACTUALES ////////////////////

  switch($accion)
  {
    /////////////////////////////////// PARA INSERTAR ////////////////////////////////////
    case "agregar": 

        $sql1 = "INSERT INTO tbl_ms_roles_ojetos (ID_OBJETO, ID_ROL, PERMISO_INSERCION, PERMISO_ELIMINACION, PERMISO_ACTUALIZACION, PERMISO_CONSULTAR)
                 VALUES ('$pantalla', '$rol', '$insertar', '$eliminar', '$editar', '$consultar')";
          if (mysqli_query($conn, $sql1)) 
          {
            $ultimo_id = mysqli_insert_id($conn); //UTLTIMO REGISTRO 

            // ////////////// INICIO FUNCION BITACORA /////////////////////
            include_once 'funcion_bitacora.php';
            bitacora('INSERTO', 'PERMISOS', 'TODOS', $ultimo_id, 'AL ROL: '. $nombre_rol, 'A LA PANTALLA: '.$nombre_pantalla);
            // ////////////// FIN FUNCION BITACORA ///////////////////////

            echo '<script>
                    alert("Permisos creados con exito");
                    window.location.href="../../vistas/ajustes/vista_permisos.php";                   
                  </script>';
                  mysqli_close($conn);
          }else{
                echo '<script>
                        alert("Error al tratar de crear los permisos");
                      </script>'; 
                      mysqli_error($conn);
                      mysqli_close($conn);
                }      
      break;

    /////////////////////////////////// PARA EDITAR ////////////////////////////////////    
    case "editar";

     $sql17 = "UPDATE tbl_ms_roles_ojetos SET PERMISO_INSERCION='$insertar', PERMISO_ELIMINACION='$eliminar', 
                      PERMISO_ACTUALIZACION='$editar', PERMISO_CONSULTAR='$consultar' WHERE ID_OBJETO='$pantalla' and ID_ROL='$rol'";
      if (mysqli_query($conn, $sql17)) 
      {
        echo '<script>
                alert("Permiso editado con exito");
                window.location.href="../../vistas/ajustes/vista_permisos.php";                   
              </script>';
              mysqli_close($conn);       
      }

    // ////////////// INICIO FUNCION BITACORA /////////////////////
    if($INSERTARR !== $insertar) ///////////// INSERTAR
    {
    include_once 'funcion_bitacora.php';
    bitacora('EDITO', 'PERMISOS', 'INSERTAR', 0, 'PANTALLA: '. $nombre_pantalla, 'ROL: '. $nombre_rol);
    }
    if($ELIMINARR !== $eliminar) ///////////// ELIMINAR
    {
    include_once 'funcion_bitacora.php';
    bitacora('EDITO', 'PERMISOS', 'ELIMINAR', 0, 'PANTALLA: '. $nombre_pantalla, 'ROL: '. $nombre_rol);
    }
    if($EDITARR !== $editar) ///////////// EDITAR
    {
    include_once 'funcion_bitacora.php';
    bitacora('EDITO', 'PERMISOS', 'EDITAR', 0, 'PANTALLA: '. $nombre_pantalla, 'ROL: '. $nombre_rol);
    }
    if($EDITARR !== $editar) ///////////// CONSULTAR
    {
    include_once 'funcion_bitacora.php';
    bitacora('EDITO', 'PERMISOS', 'CONSULTAR', 0, 'PANTALLA: '. $nombre_pantalla, 'ROL: '. $nombre_rol);
    }
  
    // ////////////// FIN FUNCION BITACORA ///////////////////////

    break;
      
    /////////////////////////////////// PARA ELIMINAR ////////////////////////////////////
    case "eliminar";

      $sql3 = "DELETE FROM tbl_ms_roles_ojetos WHERE ID_ROL='$rol' and ID_OBJETO='$pantalla'";

      if (mysqli_query($conn, $sql3)) 
      {
         // ////////////// INICIO FUNCION BITACORA /////////////////////
         include_once 'funcion_bitacora.php';
         bitacora('ELIMINO', 'PERMISOS', 'TODOS', $ultimo_id, 'PANTALLA: '.$nombre_pantalla, 'ROL: '. $nombre_rol);
         // ////////////// FIN FUNCION BITACORA ///////////////////////
        header('Location: ../../vistas/ajustes/vista_permisos.php');
        mysqli_close($conn);
      }else{
            echo '<script>
                    alert("Error al tratar de eliminar el permiso");
                  </script>'; 
                  mysqli_error($conn);
                  mysqli_close($conn);
           }
    break;
    default:
      $conn->close();   
  }
?>
