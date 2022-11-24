<?php
  require '../../conexion/conexion.php';

  ////////////////// recuperar la información de los formularios de la vista de nuestros contactos /////////////
  $id_contacto=(isset($_POST['id_contacto']))?$_POST['id_contacto']:"";
  $telefono=(isset($_POST['telefono']))?$_POST['telefono']:"";
  $correo=(isset($_POST['correo']))?$_POST['correo']:"";
  $correo_empleados=(isset($_POST['correo_empleados']))?$_POST['correo_empleados']:"";
  $direccion=(isset($_POST['direccion']))?$_POST['direccion']:"";
  $facebook=(isset($_POST['facebook']))?$_POST['facebook']:"";
  $instagram=(isset($_POST['instagram']))?$_POST['instagram']:"";

   ////////// variable para recuperar los botones de la vista de nuestros contactos //////////////
   $accion=(isset($_POST['accion']))?$_POST['accion']:"";
  
  ///////////////// INICIO SELECCIONAR LOS DATOS ACTUALES ////////////////////
   $mostrar_actuales= "SELECT * FROM tbl_nuestros_contactos WHERE ID_CONTACTO='$id_contacto'";
   $sultados_actuales = $conn->query($mostrar_actuales);
   if ($sultados_actuales->num_rows > 0) 
   {
    while($datos_actuales = $sultados_actuales->fetch_assoc()) 
    {
      $TELEFONOSS = $datos_actuales["TELEFONO"];
      $CORREOSS = $datos_actuales["CORREO"];
      $DIRECCIONN = $datos_actuales["DIRECCION"];
      $FACEBOOKK = $datos_actuales["FACEBOOK"];
      $INSTAGRAMM = $datos_actuales["INSTAGRAM"];
    }
  }
  ///////////////// FIN SELECCIONAR LOS DATOS ACTUALES ////////////////////
   
  ////////////////////////// información del usuario logueado /////////////////
  $usuario1 = $_SESSION;

  switch($accion)
  {
    case "editar";
      $sql2 = "UPDATE tbl_nuestros_contactos SET TELEFONO='$telefono', CORREO='$correo', DIRECCION='$direccion', 
                                                  FACEBOOK='$facebook',  INSTAGRAM='$instagram' 
                                                  WHERE ID_CONTACTO='$id_contacto'";
      $sql77= "UPDATE tbl_nuestros_contactos SET CORREO='$correo_empleados' WHERE ID_CONTACTO=2 ";
      $resultado77 = mysqli_query($conn, $sql77);

      if (mysqli_query($conn, $sql2)) 
      {
        // ////////////// INICIO FUNCION BITACORA /////////////////////
        
        if($TELEFONOSS !== $telefono) ///////////// TELEFONO
        {
          include_once 'funcion_bitacora.php';
          bitacora('EDITO', 'CONTACTOS', 'TELEFONO', $id_contacto, $TELEFONOSS, $telefono);
        }

        if($DIRECCIONN !== $direccion) ///////////// DIRECCION
        {
          include_once 'funcion_bitacora.php';
          bitacora('EDITO', 'CONTACTOS', 'DIRECCION', $id_contacto, $DIRECCIONN, $direccion);
        }

        if($FACEBOOKK !== $facebook) ///////////// FACEBOOK
        {
          include_once 'funcion_bitacora.php';
          bitacora('EDITO', 'CONTACTOS', 'FACEBOOK', $id_contacto, $FACEBOOKK, $facebook);
        }

        if($INSTAGRAMM !== $instagram) ///////////// INSTAGRAM
        {
          include_once 'funcion_bitacora.php';
          bitacora('EDITO', 'CONTACTOS', 'INSTAGRAM', $id_contacto, $INSTAGRAMM, $instagram);
        }
      
         // ////////////// FIN FUNCION BITACORA ///////////////////////

        echo '<script>
                alert("Datos actualizados exitosamente");
                window.location.href="../../vistas/mantenimiento/vista_nuestros_contactos.php";                   
              </script>';
              mysqli_close($conn); 
       }else{
              echo '<script>
                      alert("Error al tratar de editar los contactos");
                    </script>'; mysqli_error($conn);
            }
                    
   break;
    default:    
    $conn->close(); 

  }




?>
