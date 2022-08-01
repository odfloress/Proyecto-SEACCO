<?php
require '../../controladores/co_solicitud_empleo.php';
?>

<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<title>Solicitud de empleo</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<script>
  function clave(e) {
  key = e.keyCode || e.which;
  tecla = String.fromCharCode(key).toString();
  letras = "ABCDEFGHIJKLMNÑOPQRSTUVWXYZabcdefghijklmnñopqrstuvwxyz";
  
  especiales = [8,13];
  tecla_especial = false;
  for(var i in especiales) {
    if(key == especiales[i]){
      tecla_especial = true;
      break;
    }
  }
  
  if(letras.indexOf(tecla) == -1 && !tecla_especial){
    alert("Ingresar solo mayusculas");
    return false;
  }
}
</script>
<script>
  function clave1(e) {
  key = e.keyCode || e.which;
  tecla = String.fromCharCode(key).toString();
  letras = "ABCDEFGHIJKLMNÑOPQRSTUVWXZabcdefghijklmnñopqrstuvwxyz0123456789,#$%&/=!¡?¿()*{}[]-_'.@<>";
  
  especiales = [8,13];
  tecla_especial = false;
  for(var i in especiales) {
    if(key == especiales[i]){
      tecla_especial = true;
      break;
    }
  }
  
  if(letras.indexOf(tecla) == -1 && !tecla_especial){
    alert("Sin espacios");
    return false;
  }
}
</script>

<!-- enlace del scritpt para evitar si preciona F12, si preciona Ctrl+Shift+I, si preciona Ctr+u  -->
<script type="text/javascript" src="js/evita_ver_codigo_utilizando_teclas.js"></script>


</head>
<body>


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

<br><br>

<!-- First Parallax Image with Logo Text -->

  <!-- contenido -->
  <br><br>
  <center>
  <div class="container mt-3">
		
  	<center><h1>Solicitud de Empleo</h1></center>
    
	<br>
  <div class="row">
  <center><div class="col-sm-6 bg-light text-dark p-3">
<div>
    </div>
     <div class="col-sm-6 bg-light text-dark p-3">
      <div>
<div class="container mt-3">
  <h1></h1>
  <br>
  <h3></h3>
  <br>
  
  <button type="button2" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#Modal">
    Llenar Solicitud
  </button>
</div></center>

<!-- The Modal -->
<div class="modal fade" id="Modal">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Datos Personales</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <!-- Modal body -->
      <div class="modal-body ">
      <form action="" method="POST"  enctype="multipart/form-data">
      <center><img src="../../imagenes/seacco.jpg" alt="Girl in a jacket" width="150" height="150"><br></center>

            <div class="row">
                <div class="col">
                  <label for="email"  class="form-label">Nombre:</label>
                  <input style="background-color:rgb(240, 244, 245);" type="text" autocomplete="off"  value="<?php echo "$nombre"; ?>" onkeyup="mayus(this);" maxlength="30" class="form-control"  placeholder="Ingrese el nombre" name="nombre" required>
                </div>
                <div class="col">
                  <label for="pwd" class="form-label">Apellido:</label>
                  <input style="background-color:rgb(240, 244, 245);" type="text" autocomplete="off" value="<?php echo "$apellido"; ?>" onkeyup="mayus(this);" maxlength="30" class="form-control"  placeholder="Ingrese su apellido" name="apellido" required>
                </div>
            </div>
           <div class="row">
                 <!--<div class="col">
                  <label for="pwd" class="form-label">Usuario:</label>
                  <input style="background-color:rgb(240, 244, 245);" type="text" autocomplete="off" value="<?php echo "$usuario"; ?>" onkeypress="return clave(event);"  onKeyUP="this.value=this.value.toUpperCase();"  class="form-control" placeholder="Asignar usuario" name="usuario" required>
                </div>-->
                <!--<div class="col">
                      <div class="form-group">
                        <label for="pwd" class="form-label">Contraseña:</label> 
                        <div class="input-group mb-3">
                          <input style="background-color:rgb(240, 244, 245);" type="password" id="id_password"  autocomplete="off" onkeypress="return clave1(event);"  class="form-control"  placeholder="Ingrese la contraseña" name="contrasena"  required pattern="(?=.*[\d])(?=.*[a-z])(?=.*[A-Z]).{8,}" onblur="quitarespacios(this);"  onkeyup="sinespacio(this);" required="" minlength="8" maxlength="40" >
                          <div class="input-group-append ">
                            
                            <div class="input-group-text">
                              <span>
                              <i class="far fa-eye" id="togglePassword"  ></i>
                              </span>
                            
                            </div> 
                          </div>  
                        </div>
                      </div>-->
                  
                  <span>
                  
                  </span>
                  
                
            </div>
            <div class="row">
                <div class="col">
                  <label for="pwd" class="form-label">Correo:</label>
                  <input style="background-color:rgb(240, 244, 245);" type="email" autocomplete="off" value="<?php echo "$correo"; ?>" onkeypress="return clave1(event);" class="form-control"  placeholder="Ingrese su correo" name="correo" required>
                </div>
                <div class="col">
                  <label for="pwd" class="form-label">DNI:</label>
                  <input style="background-color:rgb(240, 244, 245);" type="text" autocomplete="off" value="<?php echo "$dni"; ?>" class="form-control"  placeholder="" name="dni" minlength="13" maxlength="13" onkeypress="return solonumero(event)" required pattern="[0-9]+[1-9]+" title="13 caracteres y no todos ceros">
                </div>
            </div>
            <div class="row">
                <div class="col">
                  <label for="pwd" class="form-label">Profesión:</label>
                  <select style="background-color:rgb(240, 244, 245);" value="<?php echo "$profesion"; ?>" class="form-select" id="lista1" name="profesion" required >
                        <?php
                            include '../../conexion/conexion.php';
                            $profesion = "SELECT * FROM tbl_profesiones ORDER BY ID_PROFESION";
                            $profesion2 = mysqli_query($conn, $profesion);
                            if (mysqli_num_rows($profesion2) > 0) {
                                while($row = mysqli_fetch_assoc($profesion2))
                                {
                                $id_profesion = $row['ID_PROFESION'];
                                $profesion3 =$row['PROFESION'];
                         ?>
                          <option value="<?php  echo $id_profesion ?>"><?php echo $profesion3 ?></option>
                          <?php
                           }}// finaliza el if y el while
                           ?>
                   </select>
                </div>
                <div class="col">
                  <label for="pwd" class="form-label">Dirección:</label>
                  <input style="background-color:rgb(240, 244, 245);" type="text" autocomplete="off"  value="<?php echo "$direccion"; ?>" onkeypress="return SoloLetras(event);"  onKeyUP="this.value=this.value.toUpperCase();" class="form-control"  placeholder="Ingrese su dirección" name="direccion" required>
                </div>
            </div>
            <div class="row"> 
                <div class="col">
                  <label for="pwd" class="form-label">Celular:</label>
                  <input style="background-color:rgb(240, 244, 245);" type="text" autocomplete="off"  value="<?php echo "$celular"; ?>" class="form-control"  placeholder="Ingrese su celular" name="celular" required minlength="8" onkeypress="return solonumero(event)" maxlength="8" pattern="[0-9]+[1-9]+[0-9]+" title="8 caracteres y no todos ceros">
                </div>
                <div class="col">
                  <label for="pwd" class="form-label">Referencia:</label>
                  <input style="background-color:rgb(240, 244, 245);" type="text" autocomplete="off"  value="<?php echo "$referencia"; ?>" onkeypress="return SoloLetras(event);"  onKeyUP="this.value=this.value.toUpperCase();" class="form-control"  placeholder="Ingrese nombre referencia" name="referencia" required>
                </div>
            </div>
            <div class="row">
                <div class="col">
                  <label for="pwd" class="form-label">Celular referencia:</label>
                  <input style="background-color:rgb(240, 244, 245);" type="text" autocomplete="off"  value="<?php echo "$celular_referencia"; ?>" class="form-control"  placeholder="Opcional" name="celular_referencia" onkeypress="return solonumero(event)" required minlength="8" maxlength="8" pattern="[0-9]+[1-9]+[0-9]+" title="8 caracteres y no todos ceros">
                </div>
                <div class="col">
                  <label for="pwd" class="form-label">Experiencia laboral:</label>
                  <input style="background-color:rgb(240, 244, 245);" type="text" autocomplete="off"  value="<?php echo "$experiencia_laboral"; ?>" onkeypress="return SoloLetras(event);"  onKeyUP="this.value=this.value.toUpperCase();" class="form-control"  placeholder="Ingrese su profesión u oficio" name="experiencia_laboral" required>
                </div>
            </div>
            <div class="row">
                <div class="col"> 
                  <label for="pwd" class="form-label">Curriculum:</label>
                  <input style="background-color:rgb(240, 244, 245);" type="file" accept=".pdf, .docx" autocomplete="off"  value="<?php echo "$curriculum"; ?>" class="form-control"  placeholder="Adjunte su curriculum" name="curriculum" required>
                </div>
                <div class="col">
                  <label for="pwd" class="form-label">Foto:</label>
                  <input style="background-color:rgb(240, 244, 245);" type="file" accept=".jpg, .png, .jpej, .JPEG, .JPG, .PNG" autocomplete="off"  value="<?php echo "$foto"; ?>" class="form-control" required placeholder="Adjunte su foto" name="foto">
                </div>
            </div>
            <div class="row">
                <div class="col">
                <label for="pwd" class="form-label">Genero:</label>
                <select style="background-color:rgb(240, 244, 245);" value="<?php echo "$genero"; ?>" class="form-select" id="lista1" name="genero" required >
                        <?php
                            include '../../conexion/conexion.php';
                            $genero = "SELECT * FROM tbl_generos ORDER BY ID_GENERO";
                            $genero2 = mysqli_query($conn, $genero);
                            if (mysqli_num_rows($genero2) > 0) {
                                while($row = mysqli_fetch_assoc($genero2))
                                {
                                $id_genero = $row['ID_GENERO'];
                                $genero3 =$row['GENERO'];
                         ?>
                          <option value="<?php  echo $id_genero ?>"><?php echo $genero3 ?></option>
                          <?php
                           }}// finaliza el if y el while
                           ?>
                   </select>
                </div>  
                <div class="col">
                <label for="pwd" class="form-label">Area:</label>
                <select style="background-color:rgb(240, 244, 245);" value="<?php echo "$area"; ?>" class="form-select" id="lista1" name="area" required >
                        <?php
                            include '../../conexion/conexion.php';
                            $area = "SELECT * FROM tbl_areas ORDER BY ID_AREA";
                            $area2 = mysqli_query($conn, $area);
                            if (mysqli_num_rows($area2) > 0) {
                                while($row = mysqli_fetch_assoc($area2))
                                {
                                $id_area = $row['ID_AREA'];
                                $area3 =$row['AREA'];
                         ?>
                          <option value="<?php  echo $id_area ?>"><?php echo $area3 ?></option>
                          <?php
                           }}// finaliza el if y el while
                           ?>
                   </select>
                </div>               
           </div><br>

      <!-- Modal footer -->
      <div class="modal-footer">
      <button type="submit" name="accion" value="registrar" class="btn btn-dark btn-block">Enviar</button><br>
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
      </div>
      </form>
      </div>
    </div>
  	</div>
	</div>
	</div>
    
    </div>
  </div>
</div>
  </center>

<div class="container mt-3">
<!-- Carousel -->
<div id="demo" class="carousel slide" data-bs-ride="carousel">

  <!-- Indicators/dots -->
  <div class="carousel-indicators">
    <button type="button" data-bs-target="#demo" data-bs-slide-to="0" class="active"></button>
    <button type="button" data-bs-target="#demo" data-bs-slide-to="1"></button>
    <button type="button" data-bs-target="#demo" data-bs-slide-to="2"></button>
  </div>
  
  <!-- The slideshow/carousel -->
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src='../../imagenes/banner3.jpg' alt="Los Angeles" class="d-block" style="width:1300px;height:770px;">
    </div>
    <div class="carousel-item">
      <img src='../../imagenes/imagen1.jpeg' alt="cambiar" class="d-block" style="width:1300px;height:770px;">
    </div>
    <div class="carousel-item">
      <img src='../../imagenes/banner2.jpg' alt="Chicago" class="d-block"  style="width:1300px;height:770px;">
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
</div>

  <!-- fin contenido -->

<script>
// Modal Image Gallery
function onClick(element) {
  document.getElementById("img01").src = element.src;
  document.getElementById("modal01").style.display = "block";
  var captionText = document.getElementById("caption");
  captionText.innerHTML = element.alt;
}

// Change style of navbar on scroll
window.onscroll = function() {myFunction()};
function myFunction() {
    var navbar = document.getElementById("myNavbar");
    if (document.body.scrollTop > 100 || document.documentElement.scrollTop > 100) {
        navbar.className = "w3-bar" + " w3-card" + " w3-animate-top" + " w3-white";
    } else {
        navbar.className = navbar.className.replace(" w3-card w3-animate-top w3-white", "");
    }
}

// Used to toggle the menu on small screens when clicking on the menu button
function toggleFunction() {
    var x = document.getElementById("navDemo");
    if (x.className.indexOf("w3-show") == -1) {
        x.className += " w3-show";
    } else {
        x.className = x.className.replace(" w3-show", "");
    }
}
</script>

</body>
</html>
<script type="text/javascript" src="js/evitar_reenvio.js"></script>

</html>
<script type="text/javascript">
 function mayus(e) {
   e.value = e.value.toUpperCase();
 }
</script>

<script type="text/javascript">

function sinespacio(e) {

  var cadena =  e.value;
  var limpia = "";
  var parts = cadena.split(" ");
  var length = parts.length;

  for (var i = 0; i < length; i++) {
    nuevacadena = parts[i];
    subcadena = nuevacadena.trim();

    if(subcadena != "") {
      limpia += subcadena + " ";
    }
  }
  limpia = limpia.trim();
  e.value = limpia;

};
</script>

<script type="text/javascript">
function quitarespacios(e) {

  var cadena =  e.value;
  cadena = cadena.trim();

  e.value = cadena;

};
</script>

<script type="text/javascript"> function solonumero(e) {
        tecla = (document.all) ? e.keyCode : e.which;
        if (tecla==8) return true;
        else if (tecla==0||tecla==9)  return true;
       // patron =/[0-9\s]/;// -> solo letras
        patron =/[0-9\s]/;// -> solo numeros
        te = String.fromCharCode(tecla);
        return patron.test(te);
    }
	</script>

              <!-- Script para ver contraseña de ver contraseña  -->
  <script>
    const togglePassword = document.querySelector('#togglePassword');
    const password = document.querySelector('#id_password');

      togglePassword.addEventListener('click', function (e) {
    // toggle the type attribute
    const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
    password.setAttribute('type', type);
    // toggle the eye slash icon
    this.classList.toggle('fa-eye-slash');
      });
  </script>