<!DOCTYPE html>
<html>
<head>
<!-- <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script> -->
   <!-- inicio para Modal -->
   
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
   <!-- fin para Modal -->
    
<title>Portafolio</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
  body,h1,h2,h3,h4,h5,h6 {font-family: "Raleway", sans-serif}
  body, html {
              height: 100%;
              line-height: 1.8;
             }
  .w3-bar .w3-button {
            padding: 16px;
                     }
</style>
</head>
<body>

<!-- Navbar (sit on top) -->
<div class="w3-top">
    <div class="w3-bar w3-white w3-card" id="myNavbar">
      <a href="http://localhost/SEACCO/" class="w3-bar-item w3-button w3-wide"><i class="fa fa-home"></i>Inicio</a>
    
      <!-- Right-sided navbar links -->
      <div class="w3-right w3-hide-small">        
      <a href="http://localhost/SEACCO/vistas/bienvenidos/index_solicitud_empleo.php" class="w3-bar-item w3-button"><i class="fa fa-user"></i> Solicitud empleo</a>
      <a href="http://localhost/SEACCO/vistas/bienvenidos/vista_cotizar.php" class="w3-bar-item w3-button"><i class="fa fa-list-alt"></i> Cotizar</a>
      <a href="http://localhost/SEACCO/vistas/bienvenidos/vista_portafolio.php" class="w3-bar-item w3-button"><i class="fa fa-th"></i> Portafolio</a>
      <a href="#contact" class="w3-bar-item w3-button"><i class="fa fa-envelope"></i> CONTACTANOS</a>      
    </div>

    <!-- Hide right-floated links on small screens and replace them with a menu icon -->
    <a href="javascript:void(0)" class="w3-bar-item w3-button w3-right w3-hide-large w3-hide-medium" onclick="w3_open()">
      <i class="fa fa-bars"></i>
    </a>
  </div>
</div>

<!-- Sidebar on small screens when clicking the menu icon -->
<nav class="w3-sidebar w3-bar-block w3-white w3-card w3-animate-left w3-hide-medium w3-hide-large" style="display:none" id="mySidebar">
  <a href="javascript:void(0)" onclick="w3_close()" class="w3-bar-item w3-button w3-large w3-padding-16"> Cerrar X</a>
  <a href="http://localhost/SEACCO/vistas/bienvenidos/index_solicitud_empleo.php" onclick="w3_close()" class="w3-bar-item w3-button">Solicitud empleo</a>
  <a href="http://localhost/SEACCO/vistas/bienvenidos/vista_cotizar.php" onclick="w3_close()" class="w3-bar-item w3-button">Cotizar</a>
  <a href="http://localhost/SEACCO/vistas/bienvenidos/vista_portafolio.php" onclick="w3_close()" class="w3-bar-item w3-button">Portafolio</a>
  <a href="#contact" onclick="w3_close()" class="w3-bar-item w3-button">CONTACTANOS</a>  
</nav>
<br><br>
 
<!-- Carousel -->
<div id="demo" class="carousel slide" data-bs-ride="carousel" >

  <!-- Indicators/dots -->
  <div class="carousel-indicators">
    <button type="button" data-bs-target="#demo" data-bs-slide-to="0" class="active"></button>
    <button type="button" data-bs-target="#demo" data-bs-slide-to="1"></button>
    <button type="button" data-bs-target="#demo" data-bs-slide-to="2"></button>
  </div>
  
  <!-- The slideshow/carousel -->
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="../../imagenes/imagen1.1.jpg" alt="Los Angeles" class="d-block" style="width:100%;height:590px;" >
    </div>
    <div class="carousel-item">
      <img src="../../imagenes/imagen1.2.jpg" alt="Chicago" class="d-block" style="width:100%;height:590px;">
    </div>
    <div class="carousel-item">
      <img src="../../imagenes/imagen1.3.jpg" alt="New York" class="d-block" style="width:100%;height:590px;">
    </div>
  </div>
  
  <!-- Left and right controls/icons -->
  <button class="carousel-control-prev" type="button" data-bs-target="#demo" data-bs-slide="prev">
    <span class="carousel-control-prev-icon"></span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#demo" data-bs-slide="next">
    <span class="carousel-control-next-icon"></span>
  </button>
</div>
<!-- fin Carrucel -->

<!-- inicio card -->

<div class="w3-container" style="padding:128px 16px" id="about">
  <h3 class="w3-center">Nuestros trabajos</h3> 
  <div class="w3-row-padding " style="margin-top:64px">

  <?php 
  include '../../conexion/conexion.php';
  $sql = "SELECT * FROM tbl_bienvenida_portafolio WHERE TIPO='PORTAFOLIO'";
  $result = mysqli_query($conn, $sql);
  while($row = mysqli_fetch_assoc($result)) {
   
  ?>

    <!-- inicio card 1 -->
  <div class="w3-col w3-third w3-margin-bottom">
      <div class="w3-card">
      <img src="<?php echo $row["RUTA"]; ?>" alt="Jane" style="width:100%" width="500" height="300">
        <div class="w3-container">
          <h3><?php echo $row["TITULO"]; ?></h3>
         
         <!-- inicio boton informacion -->
      <div class="container mt-3">                                          
        <div class="dropdown">
          <button type="button" class="btn btn-primary " data-bs-toggle="dropdown">
            ver información
          </button>
          
           <textarea readonly class="dropdown-menu" style="background-color: white;" class="form-control"name="" id="" cols="40" rows="5"><?php echo $row["DESCRIPCION"]; ?></textarea>
          
        </div>
      </div>
      <br>
      <!-- fin  boton informacion -->  

        </div>
      </div>
    </div>
     <!-- fin card 1 -->
    <?php } ?>
    
    
  </div> 
</div>

<!-- fin card -->







<!-- Contact Section -->
<div class="w3-container w3-light-grey" style="padding:128px 16px" id="contact">
  <h3 class="w3-center">CONTACTANOS</h3>
  <p class="w3-center w3-large">Mantengámonos en contacto. Mandanos un mensaje:</p>
  <div style="margin-top:48px">
    <p><i class="fa fa-map-marker fa-fw w3-xxlarge w3-margin-right"></i> Tegucigalpa, Honduras</p>
    <p><i class="fa fa-phone fa-fw w3-xxlarge w3-margin-right"></i> Telefono: 9660-7632</p>
    <p><i class="fa fa-envelope fa-fw w3-xxlarge w3-margin-right"> </i> Correo: proyectos@seaccoconstruye.com</p>
    <br>
     <!-- inicio mapa -->
  <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3869.8943255546815!2d-87.1795425126564!3d14.083414958674373!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8f6fbdd69e8f86fd%3A0x29aa117c9a4923a1!2sConstructora%20SEACCO%20S.%20De.%20R.L.!5e0!3m2!1ses-419!2shn!4v1653890939969!5m2!1ses-419!2shn" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
<!-- Fin mapa -->
    
  </div>
</div>

<!-- Footer -->
<footer class="w3-center w3-black w3-padding-64">
  <a href="#home" class="w3-button w3-light-grey"><i class="fa fa-arrow-up w3-margin-right"></i>Ir a inicio</a>
  <div class="w3-xlarge w3-section">
  <a href="https://www.facebook.com/pages/category/Construction-Company/Constructora-Seacco-658896417875063/"> <i class="fa fa-facebook-official w3-hover-opacity"></i></a>
    <i class="fa fa-instagram w3-hover-opacity"></i>
    <i class="fa fa-snapchat w3-hover-opacity"></i>
    <i class="fa fa-pinterest-p w3-hover-opacity"></i>
    <i class="fa fa-twitter w3-hover-opacity"></i>
    <i class="fa fa-linkedin w3-hover-opacity"></i>
  </div>
  <p>Constructora <a href="https://www.w3schools.com/w3css/default.asp" title="W3.CSS" target="_blank" class="w3-hover-text-green">SEACCO</a></p>
</footer>
 
<script>
// Modal Image Gallery
function onClick(element) {
  document.getElementById("img01").src = element.src;
  document.getElementById("modal01").style.display = "block";
  var captionText = document.getElementById("caption");
  captionText.innerHTML = element.alt;
}
// Toggle between showing and hiding the sidebar when clicking the menu icon
var mySidebar = document.getElementById("mySidebar");
function w3_open() {
  if (mySidebar.style.display === 'block') {
    mySidebar.style.display = 'none';
  } else {
    mySidebar.style.display = 'block';
  }
}
// Close the sidebar with the close button
function w3_close() {
    mySidebar.style.display = "none";
}
</script>

</body>
</html>