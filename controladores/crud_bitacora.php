<?php
include '../../conexion/conexion.php';

//para mostrar los datos de la tabla mysql y mostrar en el crud
$sql = "SELECT * FROM tbl_bitacora ORDER BY FECHA DESC";
$result = mysqli_query($conn, $sql);



//variable para recuperar los botones de la vista del crud del portafolio 
$accion=(isset($_POST['accion']))?$_POST['accion']:"";

$inicial=(isset($_POST['inicial']))?$_POST['inicial']:"";
$final=(isset($_POST['final']))?$_POST['final']:"";
$codigo=(isset($_POST['codigo']))?$_POST['codigo']:"";
$codigo= hash('sha512', $codigo);

$usuario = $_SESSION;


      
       $minima_contraseña = "SELECT * FROM tbl_parametros WHERE PARAMETRO='MIN_CONTRASENA'";
       $resultado_minima = mysqli_query($conn, $minima_contraseña);
            while($mostrar_minima = mysqli_fetch_assoc($resultado_minima)) {
                  $parametro_min = $mostrar_minima["VALOR"];
            }

       $maxima_contraseña = "SELECT * FROM tbl_parametros WHERE PARAMETRO='MAX_CONTRASENA'";
       $resultado_maxima = mysqli_query($conn, $maxima_contraseña);
       while($mostrar_maxima = mysqli_fetch_assoc($resultado_maxima)) {
                  $parametro_max = $mostrar_maxima["VALOR"];
            }



switch($accion)
{

  case "eliminar": 

    $contraseña = "SELECT * FROM tbl_usuarios WHERE USUARIO='ADMINISTRADOR' and CONTRASENA='$codigo'";
    $resultado_contraseña = mysqli_query($conn, $contraseña);
    if (mysqli_num_rows($resultado_contraseña) > 0)
    {
        
      $sql5 = "DELETE FROM tbl_bitacora WHERE FECHA BETWEEN '$inicial' AND '$final'";
      if (mysqli_query($conn, $sql5)) 
      {     
        echo '<script>
                 alert("Eliminación exitosa.");
                 window.location.href="../../vistas/ajustes/vista_bitacora.php";                  
               </script>';
      }else{
        echo '<script>
                 alert("Error al tratar de eliminar la bitácora");
              </script>'; mysqli_error($conn);
      }
    
    }else{
      echo '<script>
                 alert("Código no coincide.");
              </script>'; mysqli_error($conn);
    }

  break;
  default:
          
  $conn->close();   
}

  ?>