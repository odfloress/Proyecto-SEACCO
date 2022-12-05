<?php
  require '../../conexion/conexion.php';
  //para mostrar los datos de la tabla mysql y mostrar en el crud
  $sql = "SELECT * FROM tbl_parametros";
  $result = mysqli_query($conn, $sql);

// refresaca cada segundo  header("Refresh:1");
  // //Variables para recuperar la información de los campos de la vista roles
  $id_parametro=(isset($_POST['id_parametro']))?$_POST['id_parametro']:"";
  $valor=(isset($_POST['valor']))?$_POST['valor']:"";
  $anterior_valor=(isset($_POST['anterior_valor']))?$_POST['anterior_valor']:"";
  $parametro=(isset($_POST['parametro']))?$_POST['parametro']:"";
  
  $usuario1 = $_SESSION;

  //variable para recuperar los botones de la vista roles  
  $accion=(isset($_POST['accion']))?$_POST['accion']:"";
  
  
  switch($accion){

       //para editar en la tabla mysl      
      case "editar";
      date_default_timezone_set('America/Guatemala');
      $fecha   = new DateTime();
      $result = $fecha->format('Y-m-d-H-i-s');

        $sql2 = "UPDATE tbl_parametros SET VALOR='$valor', FECHA_MODIFICACION	='$result'  WHERE ID_PARAMETRO='$id_parametro'";
            if (mysqli_query($conn, $sql2)) {
                // ////////////// INICIO FUNCION BITACORA /////////////////////
                if($anterior_valor !== $valor) ///////////// 
                {
                include_once 'funcion_bitacora.php';
                bitacora('EDITO', 'PARAMETROS', 'VALOR', $id_parametro, $anterior_valor, $valor);
                }
                // ////////////// FIN FUNCION BITACORA ///////////////////////
                    echo '<script>
                            alert("Parametro editado con exito");
                            window.location.href="../../vistas/ajustes/vista_parametro.php";                     
                        </script>';
                            mysqli_close($conn);     
            }

      break;
      
      default:
          
          $conn->close();   
  }

?>
