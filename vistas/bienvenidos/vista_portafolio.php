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
<!-- inicio de estilos para redes sociales -->
<style>
/* body {margin:0;height:2000px;} */

.icon-bar {
  position: fixed;
  top: 50%;
  -webkit-transform: translateY(-50%);
  -ms-transform: translateY(-50%);
  transform: translateY(-50%);
}

.icon-bar a {
  display: block;
  text-align: center;
 
  padding: 16px;
  transition: all 0.3s ease;
  color: white;
  font-size: 20px;
}

.icon-bar a:hover {
  background-color: #000;
}

.facebook {
  background: #3B5998;
  color: white;
}

.twitter {
  background: #55ACEE;
  color: white;
}

.google {
  background: #dd4b39;
  color: white;
}

.linkedin {
  background: #007bb5;
  color: white;
}

.youtube {
  background: #bb0000;
  color: white;
}

.content {
  margin-left: 75px;
  font-size: 30px;

  
}
.w3-row-padding {
  
  margin-left: 40px;
  
  }
</style>
<!-- inicio de estilos para redes sociales -->
</head>
<body>
    <!-- inicio redes sociales -->
    <?php 
        include '../../conexion/conexion.php';
      $sqlB4 = "SELECT * FROM tbl_nuestros_contactos";
      $resultB4 = mysqli_query($conn, $sqlB4);
      while($rowB4 = mysqli_fetch_assoc($resultB4)) {
      ?>
<div class="icon-bar" >
  <a href="<?php echo $rowB4['FACEBOOK'] ?>" class="facebook"><i class="fa fa-facebook"></i></a> 
  <a href="<?php echo $rowB4['INSTAGRAM'] ?>" class="youtube"><i class="fa fa-instagram"></i></a>
</div>
<?php }?>

 <!-- Fin redes sociales -->
<!-- Navbar (sit on top) -->
<div class="w3-top">
  
    <div class="w3-bar w3-white w3-card" id="myNavbar">
      <a href="http://localhost/SEACCO/" class="w3-bar-item w3-button w3-wide"><i class="fa fa-home"></i>Inicio</a>
      <a href="http://localhost/SEACCO/vistas/bienvenidos/vista_portafolio.php" class="w3-bar-item w3-button w3-wide"><i class="fa fa-th"></i> Portafolio</a>
      <!-- Right-sided navbar links -->
      <div class="w3-right w3-hide-small">        
      <a href="http://localhost/SEACCO/vistas/bienvenidos/index_solicitud_empleo.php" class="w3-bar-item w3-button"><i class="fa fa-user"></i> Solicitar Empleo</a>
      <a href="http://localhost/SEACCO/vistas/bienvenidos/vista_cotizar.php" class="w3-bar-item w3-button"><i class="fa fa-list-alt"></i> Cotizar Proyecto</a>

      <a href="#contact" class="w3-bar-item w3-button"><i class="fa fa-envelope"></i> Contáctanos</a>       
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
  <a href="http://localhost/SEACCO/vistas/bienvenidos/index_solicitud_empleo.php" onclick="w3_close()" class="w3-bar-item w3-button"> Solicitud de Empleo</a>
  <a href="http://localhost/SEACCO/vistas/bienvenidos/vista_cotizar.php" onclick="w3_close()" class="w3-bar-item w3-button"> Cotizar Proyecto</a>
  <a href="http://localhost/SEACCO/vistas/bienvenidos/vista_portafolio.php" onclick="w3_close()" class="w3-bar-item w3-button">Portafolio</a>
  <a href="#contact" onclick="w3_close()" class="w3-bar-item w3-button"> Contáctanos</a>  
</nav>

<br><br>
<?php  
      $id_catalogo=(isset($_POST['id_catalogo']))?$_POST['id_catalogo']:""; 
      $catalogo=(isset($_POST['catalogo']))?$_POST['catalogo']:"";  
        if(!isset($_POST['catalogo']))
        {  ?> 
 
<!-- Carousel -->
<div id="demo" class="carousel slide" data-bs-ride="carousel" >

  <!-- Indicators/dots -->
  <div class="carousel-indicators">
    <button type="button" data-bs-target="#demo" data-bs-slide-to="0" class="active"></button>
   <?php 
      include "../../conexion/conexion.php";
      $sqlr = "SELECT * FROM tbl_portafolio WHERE ID_CATALOGO=3";
      if ($resultr=mysqli_query($conn,$sqlr)) {
          $rowcountr=mysqli_num_rows($resultr);  
      
          for ($x = 1; $x <=  $rowcountr; $x++) {         
    ?> 
    <button type="button" data-bs-target="#demo" data-bs-slide-to="<?php echo $x; ?>"></button>
    <?php } ?>
    <?php }?>

    
  </div>
  
  <!-- The slideshow/carousel -->
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="../../imagenes/fondo.jpg" alt="Los Angeles" class="d-block" style="width:100%;height:590px;" >
    </div>
    <?php 
  include '../../conexion/conexion.php';
  $sql = "SELECT * FROM tbl_portafolio WHERE ID_CATALOGO=3";
  $result = mysqli_query($conn, $sql);
  while($muestra = mysqli_fetch_assoc($result)) {
   
  ?>
    <div class="carousel-item">
      <img src="<?php echo $muestra["RUTA_PORTAFOLIO"]; ?>" alt="Chicago" class="d-block" style="width:100%;height:590px;">
    </div>
    <?php } ?>
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
<?php }  ?>
<br>

                                  <!--     si existe un post muestra las imagenes  -->

      <?php  
      $id_catalogo=(isset($_POST['id_catalogo']))?$_POST['id_catalogo']:""; 
      $catalogo=(isset($_POST['catalogo']))?$_POST['catalogo']:"";  
        if(isset($_POST['catalogo']))
        {  ?>        
                  <!-- //////////////// SELECCIONA LAS IMAGENES DE LA CATEGORIA SELECCIONADA //////////////// --> 
                  <?php 
                            include '../../conexion/conexion.php';
                            $sql777 = "SELECT * FROM tbl_catalogo WHERE ID_CATALOGO='$id_catalogo'";
                            $result777 = mysqli_query($conn, $sql777);
                           while($mostrar = mysqli_fetch_assoc($result777)) {
                            $nombre = $mostrar["NOMBRE_CATALOGO"];
                            $id_catalagos = $mostrar["ID_CATALOGO"];
                            }  ?>
                                  
                                  <div class="w3-container" style="padding:128px 16px" id="about">
                                        <h3 class="w3-center"><b><?php echo 'CATÁLOGO DE '.$nombre; ?></b></h3> 
                                        <div class="w3-row-padding " style="margin-top:64px">


                                        <?php 
                                        include '../../conexion/conexion.php';
                                        $sql = "SELECT * FROM tbl_portafolio WHERE ID_CATALOGO='$id_catalagos'";
                                        $result = mysqli_query($conn, $sql);
                                        while($row = mysqli_fetch_assoc($result)) {
                                        echo $mostrar['NOMBRE_CATALOGO'];
                                        ?>
                                           <!-- inicio card -->

                                        
                                          <!-- inicio card 1 -->
                                        <div class="w3-col w3-third w3-margin-bottom">
                                            <div class="w3-card">
                                            <img src="<?php echo $row["RUTA_PORTAFOLIO"]; ?>" alt="Jane" style="width:100%" width="500" height="300">
                                              <div class="w3-container">
                                                <h3><?php echo $row["TITULO"]; ?></h3>
                                              
                                              <!-- inicio boton informacion -->
                                            <div class="container mt-3">                                          
                                              <div class="dropdown">
                                                <button type="button" class="btn btn-primary " data-bs-toggle="dropdown">
                                                Ver Información
                                                </button>
                                                
                                                <textarea readonly class="dropdown-menu" style="background-color: white;" class="form-control"name="" id="" cols="40" rows="5"><?php echo $row["DESCRIPCION_PORTAFOLIO"]; ?></textarea>
                                                
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
                                   <!-- //////////////// SELECCIONA LAS CATEGORIAS //////////////// -->         
  <?php }  ?>

                          <?php 
                              include '../../conexion/conexion.php';
                              $validar_nombre = "SELECT * FROM tbl_parametros WHERE PARAMETRO='NOMBRE'";
                              $resultado_nombre = mysqli_query($conn, $validar_nombre);
                            while($mostrar7 = mysqli_fetch_assoc($resultado_nombre)) {
                              $nombre_contructora = $mostrar7["VALOR"];
                              }  
                            ?>
                                         <!-- inicio card -->  
                                        <h3 class="w3-center"><b>Catálogos de <?php echo $nombre_contructora; ?></b></h3> 
                                         
                                        <div  class="w3-row-padding " style="margin-top:64px">

                                        <?php 
                                        include '../../conexion/conexion.php';
                                        $sql = "SELECT * FROM tbl_catalogo WHERE ID_CATALOGO != 3";
                                        $result = mysqli_query($conn, $sql);
                                        while($row = mysqli_fetch_assoc($result)) {
                                        
                                        ?>
                                          <!-- inicio card 1 -->
                                        <div   class="w3-col w3-third w3-margin-bottom">
                                            <div class="w3-card">
                                            <img src="<?php echo $row["RUTA"]; ?>" alt="Jane" style="width:100%" width="500" height="300">
                                              <div class="w3-container" >
                                              <br>
                                              <h3><b><?php echo $row["NOMBRE_CATALOGO"]; ?> </b></h3>
                                                <!-- <textarea readonly  style="background-color: white; border: white; font-weight: bold; text-align:center;" class="form-control" cols="1" rows="1"> <?php echo $row["NOMBRE_CATALOGO"]; ?> </textarea> -->
                                                <textarea readonly  style="background-color: white; border: white;" class="form-control" name="" id="" cols="40" rows="4"><?php echo $row["DESCRIPCION"]; ?></textarea>
                                               
                                              
                                              <!-- inicio boton informacion -->
                                            <div class="container mt-3">                                          
                                              <div class="dropdown">
                                               
                                                <form action="" method="post">
                                                  <input type="hidden" name="id_catalogo" value="<?php echo $row["ID_CATALOGO"]; ?>">
                                                  <button class="btn btn-primary" name="catalogo" type="submit">Mostrar Catálogo</button>
                                                </form>                                                
                                              
                                                
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

                                      <!-- fin card -->
                

<!-- Contact Section -->
<div class="w3-container w3-light-grey" style="padding:128px 16px" id="contact">
  <h3 class="w3-center">Contáctanos</h3>
  <p class="w3-center w3-large">Mantengámonos en contacto. Mandanos un mensaje:</p>
  <div style="margin-top:48px">
                          <?php 
                              include '../../conexion/conexion.php';
                              $validar_contactos = "SELECT * FROM tbl_nuestros_contactos";
                              $resultado_contactos = mysqli_query($conn, $validar_contactos);
                            while($mostrar74 = mysqli_fetch_assoc($resultado_contactos)) {
                              $direccion = $mostrar74["DIRECCION"];
                              $telefono = $mostrar74["TELEFONO"];
                              $correo = $mostrar74["CORREO"];
                              $facebook = $mostrar74["FACEBOOK"];
                              $instagram = $mostrar74["INSTAGRAM"];
                              }  
                            ?>
    <p><i class="fa fa-map-marker fa-fw w3-xxlarge w3-margin-right"></i> Dirección: <?php echo $direccion; ?></p>
    <p><i class="fa fa-phone fa-fw w3-xxlarge w3-margin-right"></i> Teléfono: <?php echo $telefono; ?></p>
    <p><i class="fa fa-envelope fa-fw w3-xxlarge w3-margin-right"> </i> Correo: <?php echo $correo; ?></p>
    <br>
     <!-- inicio mapa -->
  <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3869.8943255546815!2d-87.1795425126564!3d14.083414958674373!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8f6fbdd69e8f86fd%3A0x29aa117c9a4923a1!2sConstructora%20SEACCO%20S.%20De.%20R.L.!5e0!3m2!1ses-419!2shn!4v1653890939969!5m2!1ses-419!2shn" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
<!-- Fin mapa -->
    
  </div>
</div>

<!-- Footer -->
<footer class="w3-center w3-black w3-padding-64">
  <a href="#demo" class="w3-button w3-light-grey"><i class="fa fa-arrow-up w3-margin-right"></i>Ir al Inicio</a>
  <div class="w3-xlarge w3-section">

  </div>
  <p>Constructora <a href="<?php echo $facebook; ?>" title="W3.CSS" target="_blank" class="w3-hover-text-green"><?php echo $nombre_contructora; ?></a></p>
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
<!-- Enlace Script para evitar reenvio de forulario -->
<script type="text/javascript" src="../../js/evitar_reenvio.js"></script>
</html>