<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<title>Cotizar</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
body,h1,h2,h3,h4,h5,h6 {font-family: "Raleway", Arial, Helvetica, sans-serif}
</style>
</head>
<body class="w3-light-grey">
<!-- inicio navbar -->
<div class="w3-top">
  <div class="w3-bar w3-white w3-card" id="myNavbar">
    <a href="http://localhost/SEACCO/" class="w3-bar-item w3-button w3-wide"><i class="fa fa-home"></i>Inicio</a>
    <!-- Right-sided navbar links -->
    <div class="w3-right w3-hide-small">
      <a href="http://localhost/SEACCO/vistas/bienvenidos/index_solicitud_empleo.php" class="w3-bar-item w3-button"><i class="fa fa-user"></i> Solicitud empleo</a>
      <a href="http://localhost/SEACCO/vistas/bienvenidos/vista_cotizar.php" class="w3-bar-item w3-button"><i class="fa fa-list-alt"></i> Cotizar</a>
      <a href="http://localhost/SEACCO/vistas/bienvenidos/vista_portafolio.php" class="w3-bar-item w3-button"><i class="fa fa-th"></i> Portafolio</a>
     
      
    </div>
    <!-- Hide right-floated links on small screens and replace them with a menu icon -->

    <a href="javascript:void(0)" class="w3-bar-item w3-button w3-right w3-hide-large w3-hide-medium" onclick="w3_open()">
      <i class="fa fa-bars"></i>
    </a>
  </div>
</div>

<!-- Sidebar on small screens when clicking the menu icon -->
<nav class="w3-sidebar w3-bar-block w3-white w3-card w3-animate-left w3-hide-medium w3-hide-large" style="display:none" id="mySidebar">
  <a href="javascript:void(0)" onclick="w3_close()" class="w3-bar-item w3-button w3-large w3-padding-16"> X</a>
  <a href="http://localhost/SEACCO/vistas/bienvenidos/index_solicitud_empleo.php" onclick="w3_close()" class="w3-bar-item w3-button">Solicitud empleo</a>
  <a href="http://localhost/SEACCO/vistas/bienvenidos/vista_cotizar.php" onclick="w3_close()" class="w3-bar-item w3-button">Cotizar</a>
  <a href="http://localhost/SEACCO/vistas/bienvenidos/vista_portafolio.php" onclick="w3_close()" class="w3-bar-item w3-button">Portafolio</a>
 
  
</nav>
<!-- fin navbar -->

<!-- Header -->

  <img class="w3-image" src="../../imagenes/fondo.jpg" alt="The Hotel" style="min-width:100%" width="100%" height="100%">
  <div class="w3-display-left w3-padding w3-col l6 m8">
 <br>
    <div class="w3-container w3-blue">
     <center> <h2></i>Cotizar Proyectos</h2></center>
    </div>
    <div class="w3-container w3-white w3-padding-16">
      <form action="/action_page.php" target="_blank">
        <div class="w3-row-padding" style="margin:0 -16px;">
          <div class="w3-half w3-margin-bottom">
            <label for="">Nombre Completo</label>
            <input type="text" class="w3-input w3-border" placeholder="Ingre su nombre">
          </div>
          <div class="w3-half">
            <label for="">Numero telefono</label>
            <input type="number" class="w3-input w3-border" placeholder="Ingre su numero">
          </div>
        </div>
        <div class="w3-row-padding" style="margin:8px -16px;">
          <div class="w3-half w3-margin-bottom">
            <label for="">Correo</label>
            <input type="text" class="w3-input w3-border" placeholder="Opcional Ingrese su correo" name="email">
          </div>
          <div class="w3-half">
            <label for="">Proyecto</label>
             <select name="txtMetodo_Compra" class="w3-input w3-border" required="true">
	    <option  value="">Seleccione el proyecto a cotizar</option>
        <option  value="">AVALÚOS</option>
        <option  value="">TOPOGRAFÍA</option>
        <option  value="">DISEÑOS 3D</option> 
        <option  value="">PLANOS</option>
        <option  value="">PRESUPUESTOS</option>
        <option  value="">INFRAESTRUCTURA</option>
        <option  value="">EDIFICACIONES DE TODO TIPO</option>  
        <option  value="">INFORMES OBRAS, DAÑOS Y SEGUIMIENTOS</option>  
        <option  value="">CONSULTORÍAS CIVILES</option>  
        <option  value="">CONSULTORÍAS AMBIENTALES EN PROYECTOS CIVILES</option> 
        <option  value="">Otro</option> 
       </select>
            
             </div>
             <div class="w3-row-padding" style="margin:8px -16px;">
          <div class="w3-half w3-margin-bottom">
            <label for="">Especificar</label>
           <input type="text" class="w3-input w3-border" placeholder="Especifique el proyecto"> 
          </div>
          <div class="w3-half">
            <label for="">Lugar de proyecto</label>
           <input type="text" class="w3-input w3-border" placeholder="Especifique el lugar del proyecto">  
           <br>
         
           <a href="http://127.0.0.1:8000/" class="btn btn-primary" onclick="return confirm('¿Quieres enviar la cotización?')">Enviar la Cotización</a>
       <a href="http://127.0.0.1:8000/" class="btn btn-danger" onclick="return confirm('¿Quieres cancelar la cotización?')">Cancelar</a>
             </div>
            
            
        </div>
        
      </form>
    </div>
  </div>




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