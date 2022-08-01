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
                  <p>Solicitudes</p>
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
        <p>Usuarios registrados</p>
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

$sqlT = "SELECT * FROM tbl_proyectos WHERE UBICACION='TEGUCIGALPA'";
if ($resultT=mysqli_query($conn,$sqlT)) {
    $rowcountT=mysqli_num_rows($resultT);

    $sqlC = "SELECT * FROM tbl_proyectos WHERE UBICACION='COMAYAGUA'";
if ($resultC=mysqli_query($conn,$sqlC)) {
    $rowcountC=mysqli_num_rows($resultC);

    $sqlY = "SELECT * FROM tbl_proyectos WHERE UBICACION='YORO'";
if ($resultY=mysqli_query($conn,$sqlY)) {
    $rowcountY=mysqli_num_rows($resultY);

    $sqlO = "SELECT * FROM tbl_proyectos WHERE UBICACION='OLANCHO'";
if ($resultO=mysqli_query($conn,$sqlO)) {
    $rowcountO=mysqli_num_rows($resultO);

    $sqlV = "SELECT * FROM tbl_proyectos WHERE UBICACION='VALLE'";
if ($resultV=mysqli_query($conn,$sqlV)) {
    $rowcountV=mysqli_num_rows($resultV);

    $sql = "SELECT * FROM tbl_proyectos";
if ($result=mysqli_query($conn,$sql)) {
    $rowcount=mysqli_num_rows($result);
?>                         
<canvas id="myChart" style="width:100%;max-width:100%"></canvas>

<script>
var xValues = ["","Tegucigalpa", "Comayagua", "Yoro", "Olancho","Valle", ""];
var yValues = [0, <?php echo $rowcountT?>, <?php echo $rowcountC?>, <?php echo $rowcountY?>, <?php echo $rowcountO?>,<?php echo $rowcountV?>,<?php echo $rowcount?>];
var barColors = ["blue", "green", "pink", "yellow","blue", "green"];

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
      text: "Proyectos por Departamento"
    }
  }
});
</script>
<?php };};};};};};
?>
              </center>
            </div>
          </div>
          <!-- Fin codigo grafica 1 -->
          <!-- inicio codigo grafica 2 -->
          <div class="col-lg-6">
            <div class="card">
<?php
include "../../conexion/conexion.php";

$sql = "SELECT * FROM tbl_proyectos WHERE ID_ESTADOS=1";
if ($result=mysqli_query($conn,$sql)) {
    $rowcount=mysqli_num_rows($result);

    $sql2 = "SELECT * FROM tbl_proyectos WHERE ID_ESTADOS=2";
if ($result2=mysqli_query($conn,$sql2)) {
    $rowcount2=mysqli_num_rows($result2);

    $sql3 = "SELECT * FROM tbl_proyectos WHERE ID_ESTADOS=3";
if ($result3=mysqli_query($conn,$sql3)) {
    $rowcount3=mysqli_num_rows($result3);

    $sql4 = "SELECT * FROM tbl_proyectos WHERE ID_ESTADOS=4";
if ($result4=mysqli_query($conn,$sql4)) {
    $rowcount4=mysqli_num_rows($result4);

    $sql5 = "SELECT * FROM tbl_proyectos WHERE ID_ESTADOS=5";
if ($result5=mysqli_query($conn,$sql5)) {
    $rowcount5=mysqli_num_rows($result5);
?>
<center>
<canvas id="myChart2" style="width:100%;max-width:100%"></canvas>

<script>
var xValues = ["SOLICITUD", "EN PROCESO", "TERMINADO"];
var yValues = [<?php echo $rowcount?>, <?php echo $rowcount2?>, <?php echo $rowcount3?>];
var barColors = [
  "#b91d47",
  "#00aba9",
  "#2b5797",
  "#e8c3b9",
  "#1e7145"
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
      text: "Cotizaciones por ubicación"
    }
  }
});
</script>

              </center>
              <?php };};};};};?>
            </div>
          </div>
           <!-- fin codigo grafica 2 -->
          <!-- fin de todas las graficas -->




          <!-- fin contenido -->

      
<?php include '../../configuracion/footer.php' ?>






