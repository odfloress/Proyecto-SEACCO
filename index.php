<?php
require 'controladores/co_registrar.php';
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<title>Bienvenida</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<style>
  body,h1,h2,h3,h4,h5,h6 {font-family: "Raleway", sans-serif}
  body, html {
              height: 100%;
              line-height: 1.8;
             }
/* Encabezado de imagen de altura completa */
<?php 
  include 'conexion/conexion.php';
  $sqlB1 = "SELECT * FROM tbl_bienvenida_portafolio WHERE TIPO='BIENVENIDA' AND ID_IMAGEN=13";
  $resultB1 = mysqli_query($conn, $sqlB1);
  while($rowB1 = mysqli_fetch_assoc($resultB1)) {
  ?>
  .bgimg-1 {
            background-position: center;
            background-size: cover;
            background-image: url("imagenes/<?php echo $rowB1['IMAGEN'] ?>");
            min-height: 100%;
           }
           <?php }?>
  .w3-bar .w3-button {
            padding: 16px;
                     }
</style>
</head>
<body>
<br><br>

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

<header class="bgimg-1 w3-display-container w3-grayscale-min" id="home">  
  <div class="w3-display-left w3-text-white" style="padding:48px">    
    <p><a href="#about" class="w3-button w3-blue w3-padding-large w3-large w3-margin-top w3-opacity w3-hover-opacity-off">Sobre nosotros</a></p>
  </div> 
  <div class="w3-display-bottomleft w3-text-grey w3-large" style="padding:24px 48px">
   <a href="https://www.facebook.com/pages/category/Construction-Company/Constructora-Seacco-658896417875063/"> <i class="fa fa-facebook-official w3-hover-opacity"></i></a>
    <i class="fa fa-instagram w3-hover-opacity"></i>
    <i class="fa fa-snapchat w3-hover-opacity"></i>
    <i class="fa fa-pinterest-p w3-hover-opacity"></i>
    <i class="fa fa-twitter w3-hover-opacity"></i>
    <i class="fa fa-linkedin w3-hover-opacity"></i>
  </div>
</header>

<!-- About Section -->
<div class="w3-container" style="padding:128px 16px" id="about">
  <h3 class="w3-center" >SOBRE CONSTRUCTORA SEACCO </h3>  

<center>   <p>Somos una firma constructora con personal calificado y listo para ejecutar
cualquier obra civil a nivel nacional, brindamos un servicio de calidad con un
enfoque funcional y ecológico, comprometidos a mejorar continuamente y
determinados en realizar sus proyectos de acuerdo con las especificaciones,
dentro de los tiempos contratados y estándares de calidad esperados para la
plena satisfacción del cliente.</p></center>

  <div class="w3-row-padding w3-center" style="margin-top:64px">  
  <div class="w3-quarter">
      <i class="fa fa-diamond w3-margin-bottom w3-jumbo"></i>
      <p class="w3-large">POLITICA DE CALIDAD</p>

      <p>El principal objetivo de la dirección y del equipo humano de la empresa
constructora SEACCO S. de R.L. es la plena satisfacción del cliente,
implantando, desarrollando y manteniendo un sistema de gestión de la calidad
basado en la mejora continua, proporcionando servicios que cumplan los
requisitos aplicables de las partes interesadas con especial énfasis en el cliente.
</p>
 </div>
    <div class="w3-quarter">
      <i class="glyphicon glyphicon-send w3-margin-bottom w3-jumbo w3-center"></i>
      <p class="w3-large">MISIÓN</p>

      <p>Satisfacer las necesidades constructivas a nivel nacional proporcionando los más
altos estándares de calidad en construcción y servicio, apegados bajo un modelo
de calidad; brindando soluciones integradas para salvaguardar el medio ambiente
con profesionales certificados para el mismo.
</p>
    </div>
    <div class="w3-quarter">
      <i class="glyphicon glyphicon-eye-open w3-margin-bottom w3-jumbo w3-center"></i>
      <p class="w3-large">VISIÓN</p>

      <p>Ser una empresa reconocida a nivel nacional creando confianza con nuestros
clientes y brindando oportunidades de trabajo para el hondureño.</p>
    </div>
    
    <div class="w3-quarter">
      <i class="fa fa-cog w3-margin-bottom w3-jumbo"></i>
      <p class="w3-large">VALORES </p>
      <p> 
         <ul>
            <li>Respeto</li>
            <li>Honestidad</li>
            <li>Moral cristina</li>
            <li>Ética profesional</li>
            <li>Pasión por el trabajo</li>
            <li>Lealtad y agradecimiento</li>
        </ul>          
     </p>
    </div>
  </div>
</div>
<?php 
  include 'conexion/conexion.php';
  $sql7 = "SELECT * FROM tbl_bienvenida_portafolio WHERE TIPO='BIENVENIDA' AND ID_IMAGEN=14";
  $result7 = mysqli_query($conn, $sql7);
  while($row = mysqli_fetch_assoc($result7)) {
  ?>
<!-- Promo Section - "We know design" -->
<div class="w3-container w3-light-grey" style="padding:128px 16px">
  <div class="w3-row-padding">
    <div class="w3-col m6">
      <h3>POLITICA MEDIOAMBIENTAL </h3>

      <p>La empresa constructora SEACCO S. de R.L. fomenta todas aquellas acciones
que favorecen a la preservación del medioambiente, con el compromiso de
utilizar de manera racional y eficiente los recursos naturales necesarios para las
actividades que se desarrollan en los proyectos ejecutados.</p>
      <p><a href="#work" class="w3-button w3-black"><i class="fa fa-th"> </i>Ver nustros trabajos</a></p>
    </div>
    <div class="w3-col m6">
      <img class="w3-image w3-round-large" src="imagenes/<?php echo $row['IMAGEN'] ?>" alt="Buildings" width="700" height="394">
    </div>
  </div>
</div>
<?php }?>
<!-- Team Section -->

  <!-- inicio card -->

<div class="w3-container" style="padding:128px 16px" id="about">
  <h3 class="w3-center">Nuestros Equipo</h3> 
    <div class="w3-row-padding " style="margin-top:64px">

      <?php 
      include 'conexion/conexion.php';
      $sql = "SELECT * FROM tbl_bienvenida_portafolio WHERE TIPO='NUESTRO_EQUIPO'";
      $result = mysqli_query($conn, $sql);
      while($row = mysqli_fetch_assoc($result)) {
      ?>

      <!-- inicio card 1 -->
      <div class="w3-col w3-third w3-margin-bottom">
        <div class="w3-card">
          <img src="imagenes/<?php echo $row["IMAGEN"]; ?> " alt="Equipo" style="width:100%" width="500" height="300">
          <div class="w3-container">
          <h3><?php echo $row["TITULO"]; ?></h3>
         
          <!-- inicio boton informacion -->
          <div class="container mt-3">                                          
            <div class="dropdown">
              <button type="button" class="btn btn-primary " data-bs-toggle="dropdown">
                Ver Información
              </button>
              <textarea readonly class="dropdown-menu" style="background-color: white;" class="form-control"name="" 
              id="" cols="40" rows="5"><?php echo $row["DESCRIPCION"]; ?></textarea>
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
    
</div> 
</div>





<!-- Promo Section "Statistics" -->
<div class="w3-container w3-row w3-center w3-dark-grey w3-padding-64">
<h2>Nuestros Servicios</h2>  
<div class="w3-quarter">
    <br>AVALÚOS
  </div>
  <div class="w3-quarter">
     <br>TOPOGRAFÍA
  </div>
  <div class="w3-quarter">
     <br>DISEÑOS 3D
  </div>
  <div class="w3-quarter">
     <br>PLANOS
  </div>
  <div class="w3-quarter">
     <br>PRESUPUESTOS
  </div>
  <div class="w3-quarter">
     <br>INFRAESTRUCTURA
  </div><div class="w3-quarter">
     <br>EDIFICACIONES DE TODO TIPO 
  </div>
  <div class="w3-quarter">
     <br>INFORMES OBRAS, DAÑOS Y SEGUIMIENTOS
  </div>
  <div class="w3-quarter">
     <br>CONSULTORÍAS CIVILES
  </div>
  <div class="w3-quarter">
     <br>CONSULTORÍAS AMBIENTALES EN PROYECTOS CIVILES
  </div>
</div>

<!-- Work Section -->
<center>
<div class="w3-container" style="padding:128px 16px" id="work">
  <h3 class="w3-center">Nuestros trabajos</h3>
 
  <div class="w3-row-padding" style="margin-top:64px">
    <div class="w3-col l3 m6">
    <?php 
      include 'conexion/conexion.php';
      $sqlB4 = "SELECT * FROM tbl_bienvenida_portafolio WHERE TIPO='BIENVENIDA' AND ID_IMAGEN=4";
      $resultB4 = mysqli_query($conn, $sqlB4);
      while($rowB4 = mysqli_fetch_assoc($resultB4)) {
      ?>
      <img src='imagenes/<?php echo $rowB4['IMAGEN'] ?>' style="width:300px; height:150px" onclick="onClick(this)" class="w3-hover-opacity" alt="<?php echo $rowB4['DESCRIPCION'] ?>">
      <?php }?>
    </div>
     <div class="w3-col l3 m6">
     <?php 
      include 'conexion/conexion.php';
      $sqlB4 = "SELECT * FROM tbl_bienvenida_portafolio WHERE TIPO='BIENVENIDA' AND ID_IMAGEN=5";
      $resultB4 = mysqli_query($conn, $sqlB4);
      while($rowB4 = mysqli_fetch_assoc($resultB4)) {
      ?>
      <img src='imagenes/<?php echo $rowB4['IMAGEN'] ?>' style="width:300px; height:150px" onclick="onClick(this)" class="w3-hover-opacity" alt="<?php echo $rowB4['DESCRIPCION'] ?>">
      <?php }?>
    </div>
    <div class="w3-col l3 m6">
    <?php 
      include 'conexion/conexion.php';
      $sqlB4 = "SELECT * FROM tbl_bienvenida_portafolio WHERE TIPO='BIENVENIDA' AND ID_IMAGEN=6";
      $resultB4 = mysqli_query($conn, $sqlB4);
      while($rowB4 = mysqli_fetch_assoc($resultB4)) {
      ?>
      <img src='imagenes/<?php echo $rowB4['IMAGEN'] ?>' style="width:300px; height:150px" onclick="onClick(this)" class="w3-hover-opacity" alt="<?php echo $rowB4['DESCRIPCION'] ?>">
      <?php }?>
    </div>
    <div class="w3-col l3 m6">
    <?php 
      include 'conexion/conexion.php';
      $sqlB4 = "SELECT * FROM tbl_bienvenida_portafolio WHERE TIPO='BIENVENIDA' AND ID_IMAGEN=7";
      $resultB4 = mysqli_query($conn, $sqlB4);
      while($rowB4 = mysqli_fetch_assoc($resultB4)) {
      ?>
      <img src='imagenes/<?php echo $rowB4['IMAGEN'] ?>' style="width:300px; height:150px" onclick="onClick(this)" class="w3-hover-opacity" alt="<?php echo $rowB4['DESCRIPCION'] ?>">
      <?php }?>
    </div>
  </div>

  <div class="w3-row-padding w3-section">
    <div class="w3-col l3 m6">
    <?php 
      include 'conexion/conexion.php';
      $sqlB4 = "SELECT * FROM tbl_bienvenida_portafolio WHERE TIPO='BIENVENIDA' AND ID_IMAGEN=8";
      $resultB4 = mysqli_query($conn, $sqlB4);
      while($rowB4 = mysqli_fetch_assoc($resultB4)) {
      ?>
      <img src='imagenes/<?php echo $rowB4['IMAGEN'] ?>' style="width:300px; height:150px" onclick="onClick(this)" class="w3-hover-opacity" alt="<?php echo $rowB4['DESCRIPCION'] ?>">
      <?php }?>
    </div>
    <div class="w3-col l3 m6">
    <?php 
      include 'conexion/conexion.php';
      $sqlB4 = "SELECT * FROM tbl_bienvenida_portafolio WHERE TIPO='BIENVENIDA' AND ID_IMAGEN=9";
      $resultB4 = mysqli_query($conn, $sqlB4);
      while($rowB4 = mysqli_fetch_assoc($resultB4)) {
      ?>
      <img src='imagenes/<?php echo $rowB4['IMAGEN'] ?>' style="width:300px; height:150px" onclick="onClick(this)" class="w3-hover-opacity" alt="<?php echo $rowB4['DESCRIPCION'] ?>">
      <?php }?>
    </div>
    <div class="w3-col l3 m6">
    <?php 
      include 'conexion/conexion.php';
      $sqlB4 = "SELECT * FROM tbl_bienvenida_portafolio WHERE TIPO='BIENVENIDA' AND ID_IMAGEN=10";
      $resultB4 = mysqli_query($conn, $sqlB4);
      while($rowB4 = mysqli_fetch_assoc($resultB4)) {
      ?>
      <img src='imagenes/<?php echo $rowB4['IMAGEN'] ?>' style="width:300px; height:150px" onclick="onClick(this)" class="w3-hover-opacity" alt="<?php echo $rowB4['DESCRIPCION'] ?>">
      <?php }?>
    </div>
    <div class="w3-col l3 m6">
    <?php 
      include 'conexion/conexion.php';
      $sqlB4 = "SELECT * FROM tbl_bienvenida_portafolio WHERE TIPO='BIENVENIDA' AND ID_IMAGEN=11";
      $resultB4 = mysqli_query($conn, $sqlB4);
      while($rowB4 = mysqli_fetch_assoc($resultB4)) {
      ?>
      <img src='imagenes/<?php echo $rowB4['IMAGEN'] ?>' style="width:300px; height:150px" onclick="onClick(this)" class="w3-hover-opacity" alt="<?php echo $rowB4['DESCRIPCION'] ?>">
      <?php }?>
    </div>
  </div>
</div>

<!-- Modal for full size images on click-->
<div id="modal01" class="w3-modal w3-black" onclick="this.style.display='none'">
  <span class="w3-button w3-xxlarge w3-black w3-padding-large w3-display-topright" title="Close Modal Image">×</span>
  <div class="w3-modal-content w3-animate-zoom w3-center w3-transparent w3-padding-64">
    <img id="img01" class="w3-image">
    <p id="caption" class="w3-opacity w3-large"></p>
  </div>
</div>
</center>

<?php 
  include 'conexion/conexion.php';
  $sql = "SELECT * FROM tbl_nuestros_contactos ";
  $result = mysqli_query($conn, $sql);
  while($row = mysqli_fetch_assoc($result)) {
  ?>

<!-- Contact Section -->
<div class="w3-container w3-light-grey" style="padding:128px 16px" id="contact">
  <h3 class="w3-center">CONTACTANOS</h3>
  <p class="w3-center w3-large">Mantengámonos en contacto. Mandanos un mensaje:</p>
  <div style="margin-top:48px">
    <p><i class="fa fa-map-marker fa-fw w3-xxlarge w3-margin-right"></i> <?php echo $row['DIRECCION'] ?></p>
    <p><i class="fa fa-phone fa-fw w3-xxlarge w3-margin-right"></i> Telefono: <?php echo $row['TELEFONO'] ?></p>
    <p><i class="fa fa-envelope fa-fw w3-xxlarge w3-margin-right"> </i> Correo: <?php echo $row['CORREO'] ?></p>
    <br>
    <?php } ?>
  <!-- inicio mapa -->
  <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3869.8943255546815!2d-87.1795425126564!3d14.083414958674373!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8f6fbdd69e8f86fd%3A0x29aa117c9a4923a1!2sConstructora%20SEACCO%20S.%20De.%20R.L.!5e0!3m2!1ses-419!2shn!4v1653890939969!5m2!1ses-419!2shn" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
<!-- Fin mapa -->
<?php 
  include 'conexion/conexion.php';
  $sqlB3 = "SELECT * FROM tbl_bienvenida_portafolio WHERE TIPO='BIENVENIDA' AND ID_IMAGEN=3";
  $resultB3 = mysqli_query($conn, $sqlB3);
  while($rowB3 = mysqli_fetch_assoc($resultB3)) {
  ?>
    <!-- Image of location/map -->
    <img src="imagenes/<?php echo $rowB3['IMAGEN'] ?>" class="w3-image w3-greyscale" style="width:100%;margin-top:48px">
  </div>
</div>

<?php }?>

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