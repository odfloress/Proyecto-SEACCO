<?php
require '../../controladores/crud_cotizacion.php';
?>

<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<title>Cotizar Proyecto</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
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
    <a href="http://localhost/SEACCO/" class="w3-bar-item w3-button w3-wide"><i class="fa fa-home"></i> Inicio</a>
    <!-- Right-sided navbar links -->
    <div class="w3-right w3-hide-small">
      <a href="http://localhost/SEACCO/vistas/bienvenidos/index_solicitud_empleo.php" class="w3-bar-item w3-button"><i class="fa fa-user"></i> Solicitud de Empleo</a>
      <a href="http://localhost/SEACCO/vistas/bienvenidos/vista_cotizar.php" class="w3-bar-item w3-button"><i class="fa fa-list-alt"></i> Cotizar Proyecto</a>
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
        <form action="" method="POST"  enctype="multipart/form-data" class="needs-validation" novalidate>
          <div class="mb-3 mt-3">
                <center><h2>Cotiza con nosotros</h2></center><br>
                
                <center><img src="../../imagenes/seacco.jpg" alt="Girl in a jacket" width="150" height="150"><br></center>
                <br><h4>Datos Personales</h4>
            <div class="row">
                <div class="col">
                  <label for="email"  class="form-label">Nombre:</label>
                  <input style="background-color:rgb(240, 244, 245);" type="text" autocomplete="off"  
                  value="<?php echo "$nombre"; ?>" onkeyup="quitarespacios(this); sinespacio(this); " maxlength="30" class="form-control"  
                  placeholder="Ingrese el nombre" name="nombre" onkeypress="return soloLetras(event);" id="campoNombre"  required>
                      
                      <!-- Notificacion campo vacio -->
                      <div class="invalid-feedback">Es requerido un nombre.</div>
                </div>
                <div class="col">
                  <label for="pwd" class="form-label">Apellido:</label>
                  <input style="background-color:rgb(240, 244, 245);" type="text" onkeyup="quitarespacios(this); sinespacio(this); " maxlength="30" autocomplete="off" value="<?php echo "$apellido"; ?>" onkeyup="mayus(this);" maxlength="30" class="form-control"  placeholder="Ingrese su apellido" name="apellido" onkeypress="return soloLetras(event);" id="campoApellido" required>
                  <div class="invalid-feedback">Es requerido un apellido.</div>
                </div>
            </div>       
          </div>
          <div class="row">
                <div class="col">
                  <label for="pwd" class="form-label">DNI:</label>
                  <input   style="background-color:rgb(240, 244, 245);" type="text" onkeyup="quitarespacios(this); sinespacio(this); " autocomplete="off" 
                  value="<?php echo "$dni"; ?>"  class="form-control"  placeholder="Ingrese su DNI" name="dni" minlength="13"            
                  required maxlength="13" onkeypress="return solonumero(event)" required  
                 pattern="(?!0{13})^[0-9][0-9]{12}$"
                  title="13 caracteres y no todos ceros">              
                  <div class="invalid-feedback">Ingrese un DNI de trece digitos y no todos ceros.</div>
                </div>
                <div class="col">
                  <label for="pwd" class="form-label">Dirección Personal:</label>
                  <textarea style="background-color:rgb(240, 244, 245);" type="text" autocomplete="off"  value="<?php echo "$direccionPersonal"; ?>" onkeypress="return SoloLetras(event);" onkeyup="un_espacio(this);"  onKeyUP="this.value=this.value.toUpperCase();" class="form-control"  placeholder="Ingrese su dirección" name="direccionPersonal" required></textarea>
                  <div class="invalid-feedback">Campo requerido.</div>
                </div>
                
            </div>
            <div class="row">
                <div class="col">
                  <label for="pwd" class="form-label">Correo:</label>
                  <input style="background-color:rgb(240, 244, 245);" type="email" onkeyup="quitarespacios(this); sinespacio(this); " autocomplete="off" value="<?php echo "$correo"; ?>" onkeypress="return clave1(event);" class="form-control"  placeholder="Ingrese su correo" name="correo" required>
                  <div class="invalid-feedback">Campo requerido.</div>
                </div>
                <div class="col">
                  <label for="pwd" class="form-label">Teléfono:</label>
                  <input style="background-color:rgb(240, 244, 245);" type="text" onkeyup="quitarespacios(this); sinespacio(this); " autocomplete="off" value="<?php echo "$telefono"; ?>"  class="form-control"  placeholder="Ingrese su telefono" name="telefono" minlength="8" maxlength="8" onkeypress="return solonumero(event)" required pattern="(?!0{8})^[0-9][0-9]{7}$" title="Ingrese un numero telefónico valido">
                  <div class="invalid-feedback">Campo requerido.</div>
                </div>
            </div>
            <div class="row">
            <div class="col">
                  <label for="pwd" class="form-label">Referencia:</label>
                  <input style="background-color:rgb(240, 244, 245);" type="text" autocomplete="off"  onkeyup="un_espacio(this);" onKeyUP="this.value=this.value.toUpperCase();" autocomplete="off"  value="<?php echo "$referencia"; ?>"   onKeyUP="this.value=this.value.toUpperCase();" class="form-control"  placeholder="Nombre de referencia"  name="referencia" onkeypress="return soloLetras(event);" id="CampoReferencia" required>
                </div>
                <div class="col ">
                <label for="pwd" class="form-label">Genero:</label>                
                <select style="background-color:rgb(240, 244, 245);" value="<?php echo "$genero"; ?>" class="form-select" id="lista1" name="genero" required >
                <option  value="">Seleccione el genero</option>                        
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
              </div>
              <div class="row">
                <div class="col">
                  <label for="pwd" class="form-label">Foto:</label>
                  <input style="background-color:rgb(240, 244, 245);" type="file" accept=".jpg, .png, .jpej, .JPEG, .JPG, .PNG" autocomplete="off"  value="<?php echo "$foto"; ?>" class="form-control" required placeholder="Adjunte su foto" name="foto">
                  <div class="invalid-feedback" >Seleccione una imagen con formato /jpg/png/jpeg/JPEG/JPG/PNG</div>    
                  
                </div>
            </div>
            <br><h4>Datos del Proyecto</h4>
            <div class="row">
                <div class="col">
                  <label for="pwd" class="form-label">Departamento:</label>
                  <select style="background-color:rgb(240, 244, 245);" value="<?php echo "$depto"; ?>" class="form-select" id="lista1" name="departamento" required >
                  <option  value="">Seleccione departamento</option>
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
                  <label for="pwd" class="form-label">Ubicación del Proyecto:</label>
                  <textarea style="background-color:rgb(240, 244, 245);" type="text"  onkeyup="un_espacio(this);" autocomplete="off" value="<?php echo "$ubicacion"; ?>"    onKeyUP="this.value=this.value.toUpperCase();"  class="form-control"   placeholder="Ingrese dirección" name="ubicacion" required></textarea>
                </div>
            </div>
            

            <div class="row"> 
                <div class="col">
                  <label for="pwd" class="form-label">Proyecto:</label>
                  <select style="background-color:rgb(240, 244, 245);"  class="form-select" name="proyecto"  id= "proyecto" value="<?php echo "$proyecto"; ?>" required="true">
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
                  
                      <label for="">Describa su solicitud:</label>
                      <textarea style="background-color:rgb(240, 244, 245);" name="descripcion" id="" value="<?php echo "$descripcion"; ?>" onkeyup="un_espacio(this);"  onkeyup="mayus(this);"  cols="50" rows="5"></textarea>
                    </div>
                </div>

                
            </div><br>
            
           
            
            <div class="d-grid">
            <button type="submit" name="accion" value="registrar" class="btn btn-dark btn-block">Enviar Cotización</button><br>
            <a href="/SEACCO/" class="btn btn-danger btn-block">Cancelar</a>
            </div>         
            
        </form>
      </div>
       <!--Fin Cuerpo del modal -->

    </div> 
  </div>

  
</body>
<script type="text/javascript" src="../../js/un_espacio.js"></script>
<script type="text/javascript" src="../../js/evitar_reenvio.js"></script>

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

              
  <script>
    //  Script para ver contraseña de ver contraseña  
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

  <script>
            // Funcion para mensajes en validaciones
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

<script>
      // solo letras
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
 
 <script>
    function removeSpace(e){
      let val = (e.target.value).trim();
      console.log(val);
      }
 </script>
<script>
    // Quita espacios de los inputs
    document.getElementById("campoNombre").addEventListener('keyup', (e) => {

          let nombre = e.target.value;
          e.target.value = nombre.toUpperCase().trim();

      });
    document.getElementById("campoApellido").addEventListener('keyup', (e) => {

          let nombre = e.target.value;
          e.target.value = nombre.toUpperCase().trim();

      });
    
</script>

 


