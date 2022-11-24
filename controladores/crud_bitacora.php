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


switch($accion)
{

  case "eliminar": 

    if($codigo == 7777747)
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