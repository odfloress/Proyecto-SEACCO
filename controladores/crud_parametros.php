<?php
  require '../../conexion/conexion.php';
  //para mostrar los datos de la tabla mysql y mostrar en el crud
  $sql = "SELECT * FROM tbl_parametros";
  $result = mysqli_query($conn, $sql);

// refresaca cada segundo  header("Refresh:1");
  // //Variables para recuperar la información de los campos de la vista roles
  $id_parametro=(isset($_POST['id_parametro']))?$_POST['id_parametro']:"";
  $valor=(isset($_POST['valor']))?$_POST['valor']:"";
  $parametro=(isset($_POST['parametro']))?$_POST['parametro']:"";
  
  $usuario1 = $_SESSION;

  //variable para recuperar los botones de la vista roles  
  $accion=(isset($_POST['accion']))?$_POST['accion']:"";
  
  
  switch($accion){

       //para editar en la tabla mysl      
      case "editar";

        $sql2 = "UPDATE tbl_parametros SET VALOR='$valor'  WHERE ID_PARAMETRO='$id_parametro'";
            if (mysqli_query($conn, $sql2)) {
                // inicio inserta en la tabla bitacora
                    $sql9 = "INSERT INTO tbl_bitacora (USUARIO, ACCION, OBSERVACION)
                    VALUES ('$usuario1[usuario]', 'ACTUALIZO', 'ACTUALIZO EL VALOR DEL PARAMETRO ($parametro) VALOR A ($valor)')";
                    if (mysqli_query($conn, $sql9)) {} else { }
                // fin inserta en la tabla bitacora
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
