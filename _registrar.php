<?php
require 'controladores/co_registrar.php';
?>
<?php 
  include 'conexion/conexion.php';
  $minima_contraseña = "SELECT * FROM tbl_parametros WHERE PARAMETRO = 'MIN_CONTRASENA'";
  $resultado_minimo = mysqli_query($conn, $minima_contraseña);
    while ($mostrar_minima = mysqli_fetch_assoc($resultado_minimo)){
      $parametro_min = $mostrar_minima["VALOR"];
    }

    $maxima_contraseña = "SELECT * FROM tbl_parametros WHERE PARAMETRO = 'MAX_CONTRASENA'";
  $resultado_maximo = mysqli_query($conn, $maxima_contraseña);
    while ($mostrar_maxima = mysqli_fetch_assoc($resultado_maximo)){
      $parametro_max = $mostrar_maxima["VALOR"];
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Registrar Usuario</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
  
  <style> 
body {
  background-image: url('imagenes/fondo.jpg');
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
<!-- El Modal -->

  <div  class="modal-dialog" >
    <div class="modal-content " >     
    <!-- class="was-validated" -->
      <!--Inicio Cuerpo del modal -->
      <div class="modal-body ">
        <form action="" method="POST"    enctype="multipart/form-data" class="needs-validation" novalidate>
            <div class="mb-3 mt-3">
                <center><h4>Registrar Usuario</h4></center><br>
                
                <center><img src="imagenes/seacco.jpg" alt="Girl in a jacket" width="150" height="150"><br></center>

            <div class="row">
                <div class="col">
                  <label for="email"  class="form-label">Nombre:</label>
                  <input style="background-color:rgb(240, 244, 245);" type="text" onkeyup="un_espacio(this);" autocomplete="off"  value="<?php echo "$nombre"; ?>" onkeyup="mayus(this);" 
                  maxlength="30" class="form-control"  placeholder="Ingrese su primer nombre" name="nombre" required
                   minlength="3" maxlength="30" onkeypress="return soloLetras(event);">
                </div>
                <div class="col">
                  <label for="pwd" class="form-label">Apellido:</label>
                  <input style="background-color:rgb(240, 244, 245);" type="text" onkeyup="un_espacio(this);" autocomplete="off" value="<?php echo "$apellido"; ?>" onkeyup="mayus(this);" 
                  maxlength="30" class="form-control"  placeholder="Ingrese su primer apellido" name="apellido" required
                  minlength="3" maxlength="30" onkeypress="return soloLetras(event);">
                </div>
            </div>
            <div class="row">
                <div class="col">
                  <label for="pwd" class="form-label">Usuario:</label>
                  <input style="background-color:rgb(240, 244, 245);" type="text" autocomplete="off" 
                  value="<?php echo "$usuario"; ?>" onkeypress="return clave(event);"  onKeyUP="this.value=this.value.toUpperCase();"  
                  class="form-control" placeholder="Asignar usuario" name="usuario" required minlength="3" maxlength="20">
                </div>
                
                <div class="col">
                  <div class="form-group">
                  <label for="pwd" class="form-label">Contraseña:</label> 
                  <div class="invalid-feedback">Un caracter, Mayuscula, y numero</div>
                    <div class="input-group mb-3">
                      <input style="background-color:rgb(240, 244, 245);" type="password" id="id_password"  autocomplete="off" 
                      onkeypress="return clave1(event);"  class="form-control"  placeholder="Ingrese la contraseña" name="contrasena"  
                      required pattern="(?=.*[\d])(?=.*[a-z])(?=.*[A-Z]).{<?php echo $parametro_min?>,}" onblur="quitarespacio(this);"  
                      onkeyup="sinespacios(this);" required="" minlength="<?php echo $parametro_min?>" maxlength="<?php echo $parametro_max?>" >
                      <div class="input-group-append ">
                            
                          <div class="input-group-text">
                            <span>
                            <i class="far fa-eye" id="togglePassword"  ></i>
                            </span>
                            
                          </div> 
                      </div>  
                    </div>
                  </div>
                  
                  <span>
                  
                  </span>
                  
                </div>
            </div>
            <div class="row">
                <div class="col">
                  <label for="pwd" class="form-label">Correo:</label>
                  <input style="background-color:rgb(240, 244, 245);" type="email"  autocomplete="off" value="<?php echo "$correo"; ?>" 
                  onkeypress="return clave1(event);" class="form-control"  placeholder="Ingrese su correo" name="correo" required
                  minlength="3" maxlength="50">
                </div>
                <div class="col">
                  <label for="pwd" class="form-label">DNI:</label>
                  <input style="background-color:rgb(240, 244, 245);" type="text" onkeyup="quitarespacios(this); sinespacio(this); " autocomplete="off" value="<?php echo "$dni"; ?>" 
                  class="form-control"  placeholder="Ingrese su DNI" name="dni" minlength="13" maxlength="13" 
                  onkeypress="return solonumero(event)" required pattern="[0-9]+[1-9]+" title="13 caracteres y no todos ceros">
                  <div class="invalid-feedback">Ingrese du DNI sin espacion ni guiones.</div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                  <label for="pwd" class="form-label">Profesión:</label>
                  <select style="background-color:rgb(240, 244, 245);" value="<?php echo "$profesion"; ?>" class="form-select" 
                  id="lista1" name="profesion" required >
                  <option value="">Seleccione una profesión</option>
                        <?php
                            include 'conexion/conexion.php';
                            $profesion = "SELECT * FROM tbl_profesiones WHERE ESTADO='ACTIVO' ORDER BY ID_PROFESION";
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
               
                
                  <label for="pwd" class="form-label">Dirección:</label>
                  <textarea style="background-color:rgb(240, 244, 245);" type="text" onkeyup="un_espacio(this);" autocomplete="off"  
                  value="<?php echo "$direccion"; ?>" onkeypress="return SoloLetras(event);"  
                  onKeyUP="this.value=this.value.toUpperCase();" class="form-control"  
                  placeholder="Ingrese su dirección" name="direccion" required minlength="3" maxlength="255"></textarea>
                  </div>
            </div>
            <div class="row"> 
                <div class="col">
                  <label for="pwd" class="form-label">Celular:</label>
                  <input style="background-color:rgb(240, 244, 245);" type="text" onkeyup="quitarespacios(this); sinespacio(this); " autocomplete="off"  
                  value="<?php echo "$celular"; ?>" class="form-control"  placeholder="Numero de celular" 
                  name="celular" required minlength="8" onkeypress="return solonumero(event)" maxlength="8" 
                  pattern="[0-9]+[1-9]+[0-9]+" title="8 caracteres y no todos ceros">
                </div>
                <div class="col">
                  <label for="pwd" class="form-label">Referencia:</label>
                  <input style="background-color:rgb(240, 244, 245);" type="text" onkeyup="un_espacio(this);" autocomplete="off"  
                  value="<?php echo "$referencia"; ?>" onkeypress="return SoloLetras(event);"  
                  onKeyUP="this.value=this.value.toUpperCase();" class="form-control"  placeholder="Ingrese nombre referencia" 
                  name="referencia" required minlength="3" maxlength="30">
                </div>
            </div>
            <div class="row">
                <div class="col">
                  <label for="pwd" class="form-label">Celular de Referencia:</label>
                  <input style="background-color:rgb(240, 244, 245);" type="text" onkeyup="quitarespacios(this); sinespacio(this); " autocomplete="off"  
                  value="<?php echo "$celular_referencia"; ?>" class="form-control"  placeholder="Numero opcional" 
                  name="celular_referencia" onkeypress="return solonumero(event)" required minlength="8" maxlength="8" 
                  pattern="[0-9]+[1-9]+[0-9]+" title="8 caracteres y no todos ceros">
              
                
                  <label for="pwd" class="form-label">Experiencia Laboral:</label>
                  <textarea style="background-color:rgb(240, 244, 245);" type="text" onkeyup="un_espacio(this);" autocomplete="off"  
                  value="<?php echo "$experiencia_laboral"; ?>" onkeypress="return SoloLetras(event);"  
                  onKeyUP="this.value=this.value.toUpperCase();" class="form-control"  placeholder="Ingrese experiencia laboral" 
                  name="experiencia_laboral" required minlength="3" maxlength="30"></textarea>
                </div>
            </div>
            <div class="row">
                <div class="col"> 
                  <label for="pwd" class="form-label">Currículum:</label>
                  <input style="background-color:rgb(240, 244, 245);" type="file" accept=".pdf, .docx" autocomplete="off"  
                  value="<?php echo "$curriculum"; ?>" class="form-control"  placeholder="Adjunte su curriculum" name="curriculum" 
                  required>
                </div>
                <div class="col">
                  <label for="pwd" class="form-label">Foto:</label>
                  <input style="background-color:rgb(240, 244, 245);" type="file" accept=".jpg, .png, .jpej, .JPEG, .JPG, .PNG" 
                  autocomplete="off"  value="<?php echo "$foto"; ?>" class="form-control" required placeholder="Adjunte su foto" 
                  name="foto">
                </div>
            </div>
            <div class="row">
                <div class="col">
                <label for="pwd" class="form-label">Genero:</label>
                <select style="background-color:rgb(240, 244, 245);" value="<?php echo "$genero"; ?>" class="form-select" 
                id="lista1" name="genero" required >
                <option value="">Seleccione un Genero</option>
                        <?php
                            include 'conexion/conexion.php';
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
                <label for="pwd" class="form-label">Área de Trabajo:</label>
                <select style="background-color:rgb(240, 244, 245);" value="<?php echo "$area"; ?>" class="form-select" id="lista1" 
                name="area" required >
                <option value="">Seleccione una Área de Trabajo</option>
                        <?php
                            include 'conexion/conexion.php';
                            $area = "SELECT * FROM tbl_areas WHERE ESTADO='ACTIVO' ORDER BY ID_AREA";
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
<script type="text/javascript" src="js/un_espacio.js"></script>
<script type="text/javascript" src="js/evitar_reenvio.js"></script>

</html>
<script type="text/javascript">
 function mayus(e) {
   e.value = e.value.toUpperCase();
 }
</script>

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


<script type="text/javascript">
    function sinespacios(e) {

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
    function quitarespacio(e) {

      var cadena =  e.value;
      cadena = cadena.trim();

      e.value = cadena;

    };
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

        <!-- Validaciones campos registrar -->
<script>

    // Example starter JavaScript for disabling form submissions if there are invalid fields
    (() => {
    'use strict'

    // Fetch all the forms we want to apply custom Bootstrap validation styles to
    const forms = document.querySelectorAll('.needs-validation')

    // Loop over them and prevent submission
    Array.from(forms).forEach(form => {
    form.addEventListener('submit', event => {
      if (!form.checkValidity()) {
        event.preventDefault()
        event.stopPropagation()
      }

      form.classList.add('was-validated')
    }, false)
    })
    })()
</script>