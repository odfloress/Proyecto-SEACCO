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

    <div class="small-box bg-info">
          <div class="inner">
            <h3>150</h3>
            <p>Cotizaciones</p>
          </div>
          <div class="icon">
            <i class="far fa-clipboard"> </i> 
          </div>
            <a href="#" class="small-box-footer">Más información <i class="fas fa-arrow-circle-right"></i></a>
      </div>
  </div>
<!-- fin codigo card -->
<!-- inicio codigo card -->          
          <div class="col-lg-3 col-6">
         
            <div class="small-box bg-success">
                <div class="inner">
                  <h3>53<sup style="font-size: 20px"></sup></h3>
                  <p>Solicitudes</p>
                </div>
                <div class="icon">
                  <i class="fas fa-envelope-open-text"></i>
                </div>
                <a href="#" class="small-box-footer">Más información<i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>
<!-- fin codigo card -->
<!-- inicio codigo card -->
<div class="col-lg-3 col-6">

<div class="small-box bg-info">
      <div class="inner">
        <h3>150</h3>
        <p>Usuarios registrados</p>
      </div>
      <div class="icon">
        <i class="fa fa-users"> </i> 
      </div>
        <a href="#" class="small-box-footer">Más información <i class="fas fa-arrow-circle-right"></i></a>
  </div>
</div>
<!-- fin codigo card -->
          <!-- fin codigo card -->
          <!-- inicio codigo card -->
          <div class="col-lg-3 col-6">
         
            <div class="small-box bg-success">
                <div class="inner">
                  <h3>53<sup style="font-size: 20px"></sup></h3>
                  <p>Proyectos</p>
                </div>
                <div class="icon">
                  <i class="fas fa-share-alt"></i>
                </div>
                <a href="#" class="small-box-footer">Más información<i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>
          <!-- fin codigo card -->
          <!-- fin de todas las card -->

          <!-- inicio de todas las graficas -->
  <!-- inicio codigo grafica 1 -->
          <div class="col-lg-6">
            <div class="card">
              <center>
                           
<canvas id="myChart" style="width:100%;max-width:100%"></canvas>

<script>
var xValues = ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"];
var yValues = [70, 59, 54, 57, 40, 59, 44, 44, 57, 59, 54, 24];
var barColors = ["blue", "green","blue","green","blue","green","blue","green","blue","green","blue","green"];

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
      text: "Proyectos por mes"
    }
  }
});
</script>
              </center>
            </div>
          </div>
          <!-- Fin codigo grafica 1 -->
          <!-- inicio codigo grafica 2 -->
          <div class="col-lg-6">
            <div class="card">
              <center>
              <canvas id="myChart2" style="width:100%;max-width:100%"></canvas>

<script>
var xValues = ["Valle", "Valle", "Comayagua", "Atlantida", "Comayagua"];
var yValues = [55, 49, 44, 24, 15];
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
            </div>
          </div>
           <!-- fin codigo grafica 2 -->
          <!-- fin de todas las graficas -->




          <!-- fin contenido -->

      
<?php include '../../configuracion/footer.php' ?>






