<?php
require '../../controladores/co_solicitud_empleo.php';
?>

<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<title>Solicitud de Empleo</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Solicitud de Empleo</title>
    
    <style> 
body {
  background-image: url('../../imagenes/fondo.jpg');
  background-repeat: no-repeat;
  background-attachment: fixed; 
  background-size: 100% 100%;
}

</style>
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
<!-- oncopy="return false" onpaste="return false"  esto no permite copiar ni pegar -->
<body style="background-color:rgb(241, 243, 243);"   oncopy="return false" onpaste="return false">
<!-- inicio oculta el codigo fuente de la pagina -->
<body oncontextmenu="return false">
<!-- Fin oculta el codigo fuente de la pagina -->


<!-- inicio navbar -->
<div class="w3-top">
  <div class="w3-bar w3-white w3-card" id="myNavbar">
    <a href="http://localhost/SEACCO/" class="w3-bar-item w3-button w3-wide"><i class="fa fa-home"></i>Inicio</a>
    <a href="http://localhost/SEACCO/vistas/bienvenidos/vista_portafolio.php" class="w3-bar-item w3-button w3-wide"><i class="fa fa-th"></i> Portafolio</a>
    <!-- Right-sided navbar links -->
    <div class="w3-right w3-hide-small">
      <a href="http://localhost/SEACCO/vistas/bienvenidos/index_solicitud_empleo.php" class="w3-bar-item w3-button"><i class="fa fa-user"></i> Solicitud de Empleo</a>
      <a href="http://localhost/SEACCO/vistas/bienvenidos/vista_cotizar.php" class="w3-bar-item w3-button"><i class="fa fa-list-alt"></i> Cotizar Proyecto</a>
      
     
      
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

  <!-- El Modal -->

  <div  class="modal-dialog" >
    <div class="modal-content " >     

      <!--Inicio Cuerpo del modal -->
      <div class="modal-body ">
        <form action="" method="POST"  enctype="multipart/form-data">
            <div class="mb-3 mt-3">
                <center><h4>Datos Personales</h4></center><br>
                
                <center><img src="../../imagenes/seacco.jpg" alt="Girl in a jacket" width="150" height="150"><br></center>

            <div class="row">
                <div class="col">
                  <label for="email"  class="form-label">Nombre:</label>
                  <input style="background-color:rgb(240, 244, 245);" type="text"     onkeyup="un_espacio(this);"  autocomplete="off"  value="<?php echo "$nombre"; ?>" 
                   minlength="3" maxlength="30" class="form-control"  placeholder="Ingrese su primer nombre" name="nombre" required
                  onkeypress="return soloLetras(event);">
                </div>
                
                
                <div class="col">
                  <label for="pwd" class="form-label">Apellido:</label>
                  <input style="background-color:rgb(240, 244, 245);" type="text" onkeyup="un_espacio(this);"  autocomplete="off" value="<?php echo "$apellido"; ?>"
                   onkeyup="mayus(this);" minlength="3" maxlength="30" class="form-control"  placeholder="Ingrese su primer apellido" name="apellido" 
                   required onkeypress="return soloLetras(event);"  >
                </div>
            </div>
            
                  
                  <span>
                  
                  </span>
                  
                
            </div>
            <div class="row">
                <div class="col">
                  <label for="pwd" class="form-label">Correo:</label>
                  <input style="background-color:rgb(240, 244, 245);" type="email" autocomplete="off" value="<?php echo "$correo"; ?>" 
                  onkeypress="return clave1(event);" class="form-control"  placeholder="Ingrese su correo" name="correo" required
                  minlength="" maxlength="50">
                </div>
                <div class="col">
                  <label for="pwd" class="form-label">DNI:</label>
                  <input minlength="13" style="background-color:rgb(240, 244, 245);" type="text" onkeyup="quitarespacios(this); sinespacio(this); "  autocomplete="off" value="<?php echo "$dni"; ?>"  
                  class="form-control"  placeholder="DNI" name="dni"  required maxlength="13" onkeypress="return solonumero(event)" 
                  required pattern="[0-9]+[1-9].{13,}" title="13 caracteres y no todos ceros" >
                </div>
            </div>
            <div class="row">
                <div class="col">
                  <label for="pwd" class="form-label">Profesión:</label>
                  <select style="background-color:rgb(240, 244, 245);" required  class="form-select" id="lista1" name="profesion"  >
                  <option value="">Seleccione una profesión</option>
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
                  <textarea style="background-color:rgb(240, 244, 245);" type="text" onkeyup="un_espacio(this);" autocomplete="off"  value="<?php echo "$direccion"; 
                  ?>" onKeyUP="this.value=this.value.toUpperCase();" class="form-control" 
                  placeholder="Ingrese su dirección" name="direccion" required minlength="3" maxlength="255"  ></textarea>
                </div>
            </div>
            <div class="row"> 
                <div class="col">
                  <label for="pwd" class="form-label">Celular:</label>
                  <input style="background-color:rgb(240, 244, 245);" type="text" onkeyup="quitarespacios(this); sinespacio(this); "  autocomplete="off"  value="<?php echo "$celular"; ?>" 
                  class="form-control"  placeholder="Ingrese su celular" name="celular" required minlength="8" 
                  onkeypress="return solonumero(event)" maxlength="8" pattern="[0-9]+[1-9]+[0-9]+" title="8 caracteres y no todos ceros">
                </div>
                <div class="col">
                  <label for="pwd" class="form-label">Referencia:</label>
                  <input style="background-color:rgb(240, 244, 245);" type="text" onkeyup="un_espacio(this);" autocomplete="off"  value="<?php echo "$referencia"; ?>"
                  onkeypress="return soloLetras(event);" onKeyUP="this.value=this.value.toUpperCase();" class="form-control"  
                   placeholder="Ingrese nombre referencia" name="referencia" required minlength="3" maxlength="30"  >
                </div>
            </div>
            <div class="row">
                <div class="col">
                  <label for="pwd" class="form-label">Celular Referencia:</label>
                  <input style="background-color:rgb(240, 244, 245);" type="text" onkeyup="quitarespacios(this); sinespacio(this); " autocomplete="off"  
                  value="<?php echo "$celular_referencia"; ?>" class="form-control"  placeholder="Opcional" 
                  name="celular_referencia" onkeypress="return solonumero(event)" required minlength="8" maxlength="8" pattern="[0-9]+[1-9]+[0-9]+" 
                  title="8 caracteres y no todos ceros" >
                </div>
                <div class="col">
                  <label for="pwd" class="form-label">Experiencia Laboral:</label>
                  <textarea style="background-color:rgb(240, 244, 245);" type="text" onkeyup="un_espacio(this);" autocomplete="off"  
                  value="<?php echo "$experiencia_laboral"; ?>" onkeypress="return SoloLetras(event);" 
                  onKeyUP="this.value=this.value.toUpperCase();" class="form-control"  placeholder="Expeirencia laboral" 
                  name="experiencia_laboral" required minlength="3" maxlength="255"></textarea>
                </div>
            </div>
            <div class="row">
                <div class="col"> 
                  <label for="pwd" class="form-label">Currículum:</label>
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
                         <option value="">Seleccione un genero</option>
                          <option value="<?php  echo $id_genero ?>"><?php echo $genero3 ?></option>
                          <?php
                           }}// finaliza el if y el while
                           ?>
                   </select>
                </div>  
                <div class="col">
                <label for="pwd" class="form-label">Área:</label>
                <select style="background-color:rgb(240, 244, 245);" value="<?php echo "$area"; ?>" class="form-select" id="lista1" name="area" required >
                        <?php
                            include 'conexion/conexion.php';
                            $area = "SELECT * FROM tbl_areas ORDER BY ID_AREA";
                            $area2 = mysqli_query($conn, $area);
                            if (mysqli_num_rows($area2) > 0) {
                                while($row = mysqli_fetch_assoc($area2))
                                {
                                $id_area = $row['ID_AREA'];
                                $area3 =$row['AREA'];
                         ?>
                         <option value="">Seleccione un área</option>
                          <option value="<?php  echo $id_area ?>"><?php echo $area3 ?></option>
                          <?php
                           }}// finaliza el if y el while
                           ?>
                   </select>
                </div>               
           </div><br>
            <div class="d-grid">
            <button type="submit" name="accion" value="registrar" class="btn btn-dark btn-block">Registrar</button><br>
            <a href="/SEACCO/" class="btn btn-danger btn-block">Cancelar</a>
            </div>         
            
        </form>
      </div>
       <!--Fin Cuerpo del modal -->

         </div>
  </div>

  
</body>
<!-- un espacio entre palabras -->
<script type="text/javascript" src="../../js/converir_a_mayusculas.js"></script>
<script type="text/javascript" src="../../js/un_espacio.js"></script>
<script type="text/javascript" src="../../js/evitar_reenvio.js"></script>

</html>



<script>
      function soloLetras(e){
       key = e.keyCode || e.which;
       tecla = String.fromCharCode(key).toLowerCase();
       letras = " áéíóúabcdefghijklmnñopqrstuvwxyz";
       especiales = ["8-37-39-46"];

       tecla_especial = false
       for(var i in especiales){
        if(key == especiales[i]){
          tecla_especial = true;
          break;
        }
      }

      if(letras.indexOf(tecla)==-1 && !tecla_especial){
        return false;
      }
    }
  </script>


<script type="text/javascript">

function sinespacio(e) {

  var limpia = e.value;
        limpia = limpia.toUpperCase().replace(' ', '');
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