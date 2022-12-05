<?php
include '../../conexion/conexion.php';
// inicio inserta en la tabla bitacora
$sql_trigger1 = "CREATE TRIGGER `triger_resta_inventario` AFTER DELETE ON `tbl_detalle_compra` FOR EACH ROW UPDATE tbl_inventario SET  CANTIDAD_DISPONIBLE=CANTIDAD_DISPONIBLE-old.CANTIDAD WHERE ID_PRODUCTOS=old.ID_PRODUCTO";
$resutado = $result4 = mysqli_query($conn, $sql_trigger1); 
// fin inserta en la tabla bitacora
?>
<!DOCTYPE html>
<html lang="en">
<head>
      <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
      <title>Restablecimiento de Base de Datos</title>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
      <style> 
        body {
              background-image: url('../../imagenes/fondo.jpg');
              background-repeat: no-repeat;
              background-attachment: fixed; 
              background-size: 100% 100%;
              }
      </style>

    <!-- enlace del scritpt para evitar si preciona F12, si preciona Ctrl+Shift+I, si preciona Ctr+u  -->
    <script type="text/javascript" src="js/evita_ver_codigo_utilizando_teclas.js"></script>

</head>

<!-- oncopy="return false" onpaste="return false"  esto no permite copiar ni pegar -->
<body style="background-color:rgb(241, 243, 243);" oncopy="return false" onpaste="return false">


<!-- Inicio evita el click derecho de la pagina -->
<body oncontextmenu="return false">
<!-- Fin evita el click derecho de la pagina --> 
<br><br>


  <div  class="modal-dialog" >
    <div class="modal-content " >     
 
      <!--Inicio Cuerpo del modal -->
      <div class="modal-body ">
            <div class="mb-3 mt-3">
			<br>
			<center><h4>RESTAURACIÓN</h4></center>
			<center><h4> DE BASE DE DATOS</h4></center><br>
                <center><img src="../../imagenes/seacco.jpg" alt="Girl in a jacket" width="150" height="150"><br></center>
				<br>				
<body>
<center><label>BASE DE DATOS RESTAURADA EXITOSAMAENTE </label></center>
<br>
<center><a href="./index" class="btn btn-primary">Ir a inicio</a></center>

<?php
include './Connet.php';

$restorePoint=SGBD::limpiarCadena($_POST['restorePoint']);
$sql=explode(";",file_get_contents($restorePoint));
$totalErrors=0;
set_time_limit (60);
$con=mysqli_connect(SERVER, USER, PASS, BD);
$con->query("SET FOREIGN_KEY_CHECKS=0");
for($i = 0; $i < (count($sql)-1); $i++){
    if($con->query($sql[$i].";")){  }else{ $totalErrors++; }
}
$con->query("SET FOREIGN_KEY_CHECKS=1");
$con->close();
if($totalErrors<=0){

  include '../../conexion/conexion.php';
  // inicio inserta en la tabla bitacora
  $sql_trigger1 = "CREATE TRIGGER `triger_resta_inventario` AFTER DELETE ON `tbl_detalle_compra` FOR EACH ROW UPDATE tbl_inventario SET  CANTIDAD_DISPONIBLE=CANTIDAD_DISPONIBLE-old.CANTIDAD WHERE ID_PRODUCTOS=old.ID_PRODUCTO";
  $resutado = mysqli_query($conn, $sql_trigger1); 
  // fin inserta en la tabla bitacora

  $sql_trigger2 = "CREATE TRIGGER `triger_insertar_inventario` AFTER INSERT ON `tbl_productos` FOR EACH ROW INSERT INTO tbl_inventario (ID_PRODUCTOS, CANTIDAD_MINIMA, CANTIDAD_MAXIMA, CANTIDAD_DISPONIBLE) VALUES (NEW.ID_PRODUCTO, NEW.CANTIDAD_MIN, NEW.CANTIDAD_MAX, 0)";
	$resutado2  = mysqli_query($conn, $sql_trigger2);

  $sql_trigger3 = "CREATE TRIGGER `trigger_editar_inventario` AFTER UPDATE ON `tbl_productos` FOR EACH ROW UPDATE tbl_inventario SET CANTIDAD_MINIMA=NEW.CANTIDAD_MIN, CANTIDAD_MAXIMA=NEW.CANTIDAD_MAX WHERE ID_PRODUCTOS=old.ID_PRODUCTO";
  $resutado3  = mysqli_query($conn, $sql_trigger3);

	echo '<script>
	alert("Restauración completada con éxito.");
	window.location.href="./index.php";                  
	</script>';

  
  
	

}else{

	echo '<script>
	alert("Ocurrio un error inesperado, no se pudo hacer la restauración completamente"); 
	window.location.href="./index.php";                 
	</script>';

}
