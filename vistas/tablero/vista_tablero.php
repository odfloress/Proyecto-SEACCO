<?php
session_start();
if(!isset($_SESSION['usuario'])){
 
        header('Location: ../../_login.php');
        session_unset();
        session_destroy();
        die();
        
}

 



// <?php $usuario = $_SESSION;
// echo $usuario['usuario']; ?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Administracion</title>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
  <?php include '../../configuracion/navar.php' ?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Tablero</h1>
          </div><!-- /.col -->
          
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">
         
<!-- Contenido -->
<!-- inicio de todas las card -->
<!-- inicio codigo card -->
<div class="col-lg-3 col-6">
<?php
include "../../conexion/conexion.php";

$sqlr = "SELECT * FROM tbl_roles";
if ($resultr=mysqli_query($conn,$sqlr)) {
    $rowcountr=mysqli_num_rows($resultr);

?>
    <div class="small-box bg-danger">
          <div class="inner">
            <h3><?php echo $rowcountr?></h3>
            <p>Roles</p>
          </div>
          <div class="icon">
            <i class="far fa-clipboard"> </i> 
          </div>
            <a href="http://localhost/SEACCO/vistas/ajustes/vista_roles.php" class="small-box-footer">Más información <i class="fas fa-arrow-circle-right"></i></a>
      </div>
  </div>
  <?php }?>
<!-- fin codigo card -->
<!-- inicio codigo card -->          
          <div class="col-lg-3 col-6">
          <?php
include "../../conexion/conexion.php";

$sqlS = "SELECT * FROM tbl_proyectos WHERE ID_ESTADOS=1";
if ($resultS=mysqli_query($conn,$sqlS)) {
    $rowcountS=mysqli_num_rows($resultS);

?>
            <div class="small-box bg-success">
                <div class="inner">
                  <h3><?php echo $rowcountS?></h3>
                  <p>Solicitudes de Proyectos</p>
                </div>
                <div class="icon">
                  <i class="fas fa-envelope-open-text"></i>
                </div>
                <a href="http://localhost/SEACCO/vistas/proyectos/vista_proyectos.php" class="small-box-footer">Más información<i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <?php }?>
<!-- fin codigo card -->
<!-- inicio codigo card -->
<div class="col-lg-3 col-6">
<?php
include "../../conexion/conexion.php";

$sql = "SELECT * FROM tbl_usuarios";
if ($result=mysqli_query($conn,$sql)) {
    $rowcount=mysqli_num_rows($result);

?>
<div class="small-box bg-info">
      <div class="inner">
        <h3><?php echo $rowcount?></h3>
        <p>Usuarios Registrados</p>
      </div>
      <div class="icon">
        <i class="fa fa-users"> </i> 
      </div>
        <a href="http://localhost/SEACCO/vistas/personas/vista_administradores.php" class="small-box-footer">Más información <i class="fas fa-arrow-circle-right"></i></a>
  </div>
</div>
<?php } ?>
<!-- fin codigo card -->
          <!-- fin codigo card -->
          <!-- inicio codigo card -->
          <div class="col-lg-3 col-6">
          <?php
include "../../conexion/conexion.php";

$sqlP = "SELECT * FROM tbl_proyectos";
if ($resultP=mysqli_query($conn,$sqlP)) {
    $rowcountP=mysqli_num_rows($resultP);
?>
            <div class="small-box bg-warning">
                <div class="inner">
                  <h3><?php echo $rowcountP?></h3>
                  <p>Proyectos</p>
                </div>
                <div class="icon">
                  <i class="fas fa-share-alt"></i>
                </div>
                <a href="http://localhost/SEACCO/vistas/proyectos/vista_proyectos.php" class="small-box-footer">Más información<i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <?php } ?>
          <!-- fin codigo card -->
          <!-- fin de todas las card -->

          <!-- inicio de todas las graficas -->
  <!-- inicio codigo grafica 1 -->
          <div class="col-lg-6">
            <div class="card">
              <center>
              <?php
include "../../conexion/conexion.php";

$sqlU1 = "SELECT * FROM tbl_proyectos WHERE ID_ESTADOS=4 AND ID_DEPARTAMENTO=1"; if ($resultU1=mysqli_query($conn,$sqlU1)) {
  $rowcountU1=mysqli_num_rows($resultU1);
  
  $sqlU2 = "SELECT * FROM tbl_proyectos WHERE ID_ESTADOS=4 AND ID_DEPARTAMENTO=2"; if ($resultU2=mysqli_query($conn,$sqlU2)) {
  $rowcountU2=mysqli_num_rows($resultU2);
  
  $sqlU3 = "SELECT * FROM tbl_proyectos WHERE ID_ESTADOS=4 AND ID_DEPARTAMENTO=3"; if ($resultU3=mysqli_query($conn,$sqlU3)) {
  $rowcountU3=mysqli_num_rows($resultU3);
  
  $sqlU4 = "SELECT * FROM tbl_proyectos WHERE ID_ESTADOS=4 AND ID_DEPARTAMENTO=4"; if ($resultU4=mysqli_query($conn,$sqlU4)) {
  $rowcountU4=mysqli_num_rows($resultU4);
  
  $sqlU5 = "SELECT * FROM tbl_proyectos WHERE ID_ESTADOS=4 AND ID_DEPARTAMENTO=5"; if ($resultU5=mysqli_query($conn,$sqlU5)) {
  $rowcountU5=mysqli_num_rows($resultU5);
  
  $sqlU6 = "SELECT * FROM tbl_proyectos WHERE ID_ESTADOS=4 AND ID_DEPARTAMENTO=6"; if ($resultU6=mysqli_query($conn,$sqlU6)) {
  $rowcountU6=mysqli_num_rows($resultU6);
  
  $sqlU7 = "SELECT * FROM tbl_proyectos WHERE ID_ESTADOS=4 AND ID_DEPARTAMENTO=7"; if ($resultU7=mysqli_query($conn,$sqlU7)) {
  $rowcountU7=mysqli_num_rows($resultU7);
  
  $sqlU8 = "SELECT * FROM tbl_proyectos WHERE ID_ESTADOS=4 AND ID_DEPARTAMENTO=8"; if ($resultU8=mysqli_query($conn,$sqlU8)) {
  $rowcountU8=mysqli_num_rows($resultU8);
  
  $sqlU9 = "SELECT * FROM tbl_proyectos WHERE ID_ESTADOS=4 AND ID_DEPARTAMENTO=9"; if ($resultU9=mysqli_query($conn,$sqlU9)) {
  $rowcountU9=mysqli_num_rows($resultU9);
  
  $sqlU10 = "SELECT * FROM tbl_proyectos WHERE ID_ESTADOS=4 AND ID_DEPARTAMENTO=10"; if ($resultU10=mysqli_query($conn,$sqlU10)) {
  $rowcountU10=mysqli_num_rows($resultU10);
  
  $sqlU11 = "SELECT * FROM tbl_proyectos WHERE ID_ESTADOS=4 AND ID_DEPARTAMENTO=11"; if ($resultU11=mysqli_query($conn,$sqlU11)) {
  $rowcountU11=mysqli_num_rows($resultU11);
  
  $sqlU12 = "SELECT * FROM tbl_proyectos WHERE ID_ESTADOS=4 AND ID_DEPARTAMENTO=12"; if ($resultU12=mysqli_query($conn,$sqlU12)) {
  $rowcountU12=mysqli_num_rows($resultU12);
  
  $sqlU13 = "SELECT * FROM tbl_proyectos WHERE ID_ESTADOS=4 AND ID_DEPARTAMENTO=13"; if ($resultU13=mysqli_query($conn,$sqlU13)) {
  $rowcountU13=mysqli_num_rows($resultU13);
  
  $sqlU14 = "SELECT * FROM tbl_proyectos WHERE ID_ESTADOS=4 AND ID_DEPARTAMENTO=14"; if ($resultU14=mysqli_query($conn,$sqlU14)) {
  $rowcountU14=mysqli_num_rows($resultU14);
  
  $sqlU15 = "SELECT * FROM tbl_proyectos WHERE ID_ESTADOS=4 AND ID_DEPARTAMENTO=15"; if ($resultU15=mysqli_query($conn,$sqlU15)) {
  $rowcountU15=mysqli_num_rows($resultU15);
  
  $sqlU16 = "SELECT * FROM tbl_proyectos WHERE ID_ESTADOS=4 AND ID_DEPARTAMENTO=16"; if ($resultU16=mysqli_query($conn,$sqlU16)) {
  $rowcountU16=mysqli_num_rows($resultU16);
  
  $sqlU17 = "SELECT * FROM tbl_proyectos WHERE ID_ESTADOS=4 AND ID_DEPARTAMENTO=17"; if ($resultU17=mysqli_query($conn,$sqlU17)) {
  $rowcountU17=mysqli_num_rows($resultU17);
  
  $sqlU18 = "SELECT * FROM tbl_proyectos WHERE ID_ESTADOS=4 AND ID_DEPARTAMENTO=18"; if ($resultU18=mysqli_query($conn,$sqlU18)) {
    $rowcountU18=mysqli_num_rows($resultU18);

    $sql = "SELECT * FROM tbl_proyectos WHERE ID_ESTADOS=4"; if ($result=mysqli_query($conn,$sql)) {
      $rowcount=mysqli_num_rows($result);
?>                         
<canvas id="myChart" style="width:100%;max-width:100%"></canvas>

<script>
var xValues = ["","La Ceiba","Colón","Comayagua","Copán","Cortés","Choluteca","El Paraíso","Francisco Morazán","Gracias a Dios",
                "Intibucá","Islas de la Bahía","La Paz","Lempira","Ocotepeque","Olancho","Santa Bárbara","Valle","Yoro",""];
var yValues = [0, <?php echo $rowcountU1?>,  <?php echo $rowcountU2?>,  <?php echo $rowcountU3?>,  <?php echo $rowcountU4?>,  <?php echo $rowcountU5?>
                , <?php echo $rowcountU6?>,  <?php echo $rowcountU7?>,  <?php echo $rowcountU8?>,  <?php echo $rowcountU9?>,  <?php echo $rowcountU10?>
                , <?php echo $rowcountU11?>, <?php echo $rowcountU12?>, <?php echo $rowcountU13?>, <?php echo $rowcountU14?>, <?php echo $rowcountU15?>
                , <?php echo $rowcountU16?>, <?php echo $rowcountU17?>, <?php echo $rowcountU18?>, <?php echo $rowcount?>];
var barColors = ["blue", "green", "pink", "yellow","blue", "green","blue", "green", "pink", "yellow","blue", "green",
                  "blue", "green", "pink", "yellow","blue", "green"];

new Chart("myChart", {
  type: "bar",
  data: {
    labels: xValues,
    datasets: [{
      backgroundColor: barColors,
      data: yValues
    }]
  },
  options: {
    legend: {display: false},
    title: {
      display: true,
      text: "Proyectos en procesos por departamentos"
    }
  }
});
</script>
<?php };};};};};};};};};};};};};};};};};};};?>
              </center>
            </div>
          </div>
          <!-- Fin codigo grafica 1 -->
          <!-- inicio codigo grafica 2 -->
          <div class="col-lg-6">
            <div class="card">
<?php
include "../../conexion/conexion.php";

$sqlD1 = "SELECT * FROM tbl_proyectos WHERE ID_ESTADOS=1 AND ID_DEPARTAMENTO=1"; if ($resultD1=mysqli_query($conn,$sqlD1)) {
    $rowcountD1=mysqli_num_rows($resultD1);

$sqlD2 = "SELECT * FROM tbl_proyectos WHERE ID_ESTADOS=1 AND ID_DEPARTAMENTO=2"; if ($resultD2=mysqli_query($conn,$sqlD2)) {
    $rowcountD2=mysqli_num_rows($resultD2);

$sqlD3 = "SELECT * FROM tbl_proyectos WHERE ID_ESTADOS=1 AND ID_DEPARTAMENTO=3"; if ($resultD3=mysqli_query($conn,$sqlD3)) {
    $rowcountD3=mysqli_num_rows($resultD3);

  $sqlD4 = "SELECT * FROM tbl_proyectos WHERE ID_ESTADOS=1 AND ID_DEPARTAMENTO=4"; if ($resultD4=mysqli_query($conn,$sqlD4)) {
      $rowcountD4=mysqli_num_rows($resultD4);
  
  $sqlD5 = "SELECT * FROM tbl_proyectos WHERE ID_ESTADOS=1 AND ID_DEPARTAMENTO=5"; if ($resultD5=mysqli_query($conn,$sqlD5)) {
      $rowcountD5=mysqli_num_rows($resultD5);
  
  $sqlD6 = "SELECT * FROM tbl_proyectos WHERE ID_ESTADOS=1 AND ID_DEPARTAMENTO=6"; if ($resultD6=mysqli_query($conn,$sqlD6)) {
      $rowcountD6=mysqli_num_rows($resultD6);

  $sqlD7 = "SELECT * FROM tbl_proyectos WHERE ID_ESTADOS=1 AND ID_DEPARTAMENTO=7"; if ($resultD7=mysqli_query($conn,$sqlD7)) {
    $rowcountD7=mysqli_num_rows($resultD7);
    
  $sqlD8 = "SELECT * FROM tbl_proyectos WHERE ID_ESTADOS=1 AND ID_DEPARTAMENTO=8"; if ($resultD8=mysqli_query($conn,$sqlD8)) {
    $rowcountD8=mysqli_num_rows($resultD8);
    
  $sqlD9 = "SELECT * FROM tbl_proyectos WHERE ID_ESTADOS=1 AND ID_DEPARTAMENTO=9"; if ($resultD9=mysqli_query($conn,$sqlD9)) {
    $rowcountD9=mysqli_num_rows($resultD9);

    $sqlD10 = "SELECT * FROM tbl_proyectos WHERE ID_ESTADOS=1 AND ID_DEPARTAMENTO=10"; if ($resultD10=mysqli_query($conn,$sqlD10)) {
      $rowcountD10=mysqli_num_rows($resultD10);
  
  $sqlD11 = "SELECT * FROM tbl_proyectos WHERE ID_ESTADOS=1 AND ID_DEPARTAMENTO=11"; if ($resultD11=mysqli_query($conn,$sqlD11)) {
      $rowcountD11=mysqli_num_rows($resultD11);
  
  $sqlD12 = "SELECT * FROM tbl_proyectos WHERE ID_ESTADOS=1 AND ID_DEPARTAMENTO=12"; if ($resultD12=mysqli_query($conn,$sqlD12)) {
      $rowcountD12=mysqli_num_rows($resultD12);
  
    $sqlD13 = "SELECT * FROM tbl_proyectos WHERE ID_ESTADOS=1 AND ID_DEPARTAMENTO=13"; if ($resultD13=mysqli_query($conn,$sqlD13)) {
        $rowcountD13=mysqli_num_rows($resultD13);
    
    $sqlD14 = "SELECT * FROM tbl_proyectos WHERE ID_ESTADOS=1 AND ID_DEPARTAMENTO=14"; if ($resultD14=mysqli_query($conn,$sqlD14)) {
        $rowcountD14=mysqli_num_rows($resultD14);
    
    $sqlD15 = "SELECT * FROM tbl_proyectos WHERE ID_ESTADOS=1 AND ID_DEPARTAMENTO=15"; if ($resultD15=mysqli_query($conn,$sqlD15)) {
        $rowcountD15=mysqli_num_rows($resultD15);
  
    $sqlD16 = "SELECT * FROM tbl_proyectos WHERE ID_ESTADOS=1 AND ID_DEPARTAMENTO=16"; if ($resultD16=mysqli_query($conn,$sqlD16)) {
      $rowcountD16=mysqli_num_rows($resultD16);
      
    $sqlD17 = "SELECT * FROM tbl_proyectos WHERE ID_ESTADOS=1 AND ID_DEPARTAMENTO=17"; if ($resultD17=mysqli_query($conn,$sqlD17)) {
      $rowcountD17=mysqli_num_rows($resultD17);
      
    $sqlD18 = "SELECT * FROM tbl_proyectos WHERE ID_ESTADOS=1 AND ID_DEPARTAMENTO=18"; if ($resultD18=mysqli_query($conn,$sqlD18)) {
      $rowcountD18=mysqli_num_rows($resultD18);
?>
<center>
<canvas id="myChart2" style="width:100%;max-width:100%"></canvas>

<script>
var xValues = ["La Ceiba","Colón","Comayagua","Copán","Cortés","Choluteca","El Paraíso","Francisco Morazán","Gracias a Dios",
                "Intibucá","Islas de la Bahía","La Paz","Lempira","Ocotepeque","Olancho","Santa Bárbara","Valle","Yoro"];
var yValues = [<?php echo $rowcountD1?>, <?php echo $rowcountD2?>, <?php echo $rowcountD3?>, <?php echo $rowcountD4?>, <?php echo $rowcountD5?>
                , <?php echo $rowcountD6?>, <?php echo $rowcountD7?>, <?php echo $rowcountD8?>, <?php echo $rowcountD9?>, <?php echo $rowcountD10?>
                , <?php echo $rowcountD11?>, <?php echo $rowcountD12?>, <?php echo $rowcountD13?>, <?php echo $rowcountD14?>, <?php echo $rowcountD15?>
                , <?php echo $rowcountD16?>, <?php echo $rowcountD17?>, <?php echo $rowcountD18?>];
var barColors = [
  "#b91d47",
  "#00aba9",
  "#2b5797",
  "#e8c3b9",
  "#1e7145",

  "#00ccff",
  "#ff3300",
  "#ff66ff",
  "#ffff66",
  "#00cc00",

  "#cc0000",
  "#00ffcc",
  "#8000ff",
  "#663300",
  "#b3d9ff",

  "#99ff99",
  "#ccccff",
  "#00cc99"
];

new Chart("myChart2", {
  type: "pie",
  data: {
    labels: xValues,
    datasets: [{
      backgroundColor: barColors,
      data: yValues
    }]
  },
  options: {
    title: {
      display: true,
      text: "Cotizaciones de proyectos por departamento"
    }
  }
});
</script>

              </center>
              <?php };};};};};};};};};};};};};};};};};};?>
            </div>
          </div>
           <!-- fin codigo grafica 2 -->
          <!-- fin de todas las graficas -->




          <!-- fin contenido -->

      
<?php include '../../configuracion/footer.php' ?>






