<?php
require '../../controladores/crud_cotizacion.php';
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
    <title>Registrar Usuario</title>
    
    <style> 
body {
  background-image: url('../../imagenes/1659393257_fondo1.jpg');
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

  <!-- El Modal -->

  <div  class="modal-dialog" >
    <div class="modal-content " >     

      <!--Inicio Cuerpo del modal -->
      <div class="modal-body ">
        <form action="" method="POST"  enctype="multipart/form-data">
            <div class="mb-3 mt-3">
                <center><h2>Cotiza con nosotros </h2></center><br>
                
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
                  <span>
                  
                  </span>
            </div>
            <div class="row">
                <div class="col">
                  <label for="pwd" class="form-label">Correo:</label>
                  <input style="background-color:rgb(240, 244, 245);" type="email" autocomplete="off" value="<?php echo "$correo"; ?>" onkeypress="return clave1(event);" class="form-control"  placeholder="Ingrese su correo" name="correo" required>
                </div>
                <div class="col">
                  <label for="pwd" class="form-label">Celular:</label>
                  <input style="background-color:rgb(240, 244, 245);" type="text" autocomplete="off" value="<?php echo "$celular"; ?>"  class="form-control"  placeholder="Ingrese su telefono" name="celular" minlength="8" maxlength="8" onkeypress="return solonumero(event)" required pattern="[0-9]+[1-9]+[0-9]" title="Ingrese un numero telefónico valido">
                </div>
            </div><br>
            <div class="row">
                <div class="col">
                  <label for="pwd" class="form-label">Departamento:</label>
                  <select style="background-color:rgb(240, 244, 245);"  class="form-select" id="lista1" name="profesion" required >
                        <?php
                            include '../../conexion/conexion.php';
                            $depto = "SELECT * FROM tbl_departamentos ORDER BY ID_DEPARTAMENTO";
                            $depto2 = mysqli_query($conn, $depto);
                            if (mysqli_num_rows($depto2) > 0) {
                                while($row = mysqli_fetch_assoc($depto2))
                                {
                                $id_departamento = $row['ID_DEPARTAMENTO'];
                                $depto3 =$row['DEPARTAMENTO'];
                         ?>
                          <option value="<?php  echo $id_departamento ?>"><?php echo $depto3 ?></option>
                          <?php
                           }}// finaliza el if y el while
                           ?>
                   </select>
                </div>
                <br>  
                <div class="col">
                  <label for="pwd" class="form-label">Ubicacion:</label>
                  <input style="background-color:rgb(240, 244, 245);" type="text" autocomplete="off" value="<?php echo "$ubicacion"; ?>"  onkeypress="return SoloLetras(event);"  onKeyUP="this.value=this.value.toUpperCase();" class="form-control"  placeholder="Ingrese su dirección" name="ubicacion" required>
                </div>
            </div> <br>
            <div class="row"> 
                <div class="col">
                  <label for="pwd" class="form-label">Proyecto:</label>
                  <select style="background-color:rgb(240, 244, 245);"  class="form-select" name="nombre_proyecto"  id= "nombre_proyecto" value="<?php echo "$nombre_proyecto"; ?>" required="true">
                                <option  value="">Seleccione el proyecto a cotizar</option>
                                <option  value="AVALÚOS">AVALÚOS</option>
                                <option  value="TOPOGRAFÍA">TOPOGRAFÍA</option>
                                <option  value="DISEÑOS 3D">DISEÑOS 3D</option> 
                                <option  value="PLANOS">PLANOS</option>
                                <option  value="PRESUPUESTOS">PRESUPUESTOS</option>
                                <option  value="INFRAESTRUCTURA">INFRAESTRUCTURA</option>
                                <option  value="EDIFICACIONES DE TODO TIPO">EDIFICACIONES DE TODO TIPO</option>  
                                <option  value="INFORMES OBRAS, DAÑOS Y SEGUIMIENTOS">INFORMES OBRAS, DAÑOS Y SEGUIMIENTOS</option>  
                                <option  value="CONSULTORÍAS CIVILES">CONSULTORÍAS CIVILES</option>  
                                <option  value="CONSULTORÍAS AMBIENTALES EN PROYECTOS CIVILES">CONSULTORÍAS AMBIENTALES EN PROYECTOS CIVILES</option> 
                                <option  value="Otro">Otro</option> 
                    </select>
                  
                  <br>
                  <div class="w3-half w3-margin-bottom">
                  
                      <label for="">Describa su solicitud</label>
                      <textarea style="background-color:rgb(240, 244, 245);" name="descripcion" id="" value="<?php echo "$descripcion"; ?>"  name="descripcion" cols="50" rows="5"></textarea>
                    </div>
                </div>

                
            </div><br>
            
           
            
            <div class="d-grid">
            <button type="submit" name="accion" value="registrar" class="btn btn-dark btn-block">Registrar</button><br>
            <a href="/SEACCO/_login" class="btn btn-danger btn-block">Cancelar</a>
            </div>         
            
        </form>
      </div>
       <!--Fin Cuerpo del modal -->

         </div> 
  </div>

  
</body>
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



