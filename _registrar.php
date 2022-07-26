<?php
session_start();
if(!isset($_SESSION['usuario'])){
 
        //header('Location: ../iniciar_sesion/index_login.php');
        //session_unset();
        //session_destroy();
        //die();
        include 'controladores/co_registrar.php';   
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
  letras = "ABCDEFGHIJKLMNÑOPQRSTUVWXZabcdefghijklmnñopqrstuvwxyz0123456789";
  
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


</head>
<!-- oncopy="return false" onpaste="return false"  esto no permite copiar ni pegar -->
<body style="background-color:rgb(241, 243, 243);"   oncopy="return false" onpaste="return false">
<!-- inicio oculta el codigo fuente de la pagina -->
<body oncontextmenu="return false">
<!-- Fin oculta el codigo fuente de la pagina -->
<!-- El Modal -->

  <div  class="modal-dialog" >
    <div class="modal-content " >     

      <!--Inicio Cuerpo del modal -->
      <div class="modal-body ">
        <form action="co_registrar.php" method="POST">
            <div class="mb-3 mt-3">
                <center><h4>Registrar usuario</h4></center><br>
                
                <center><img src="imagenes/seacco.jpg" alt="Girl in a jacket" width="150" height="150"><br></center>

            <div class="row">
                <div class="col">
                  <label for="email"  class="form-label">Nombre:</label>
                  <input style="background-color:rgb(240, 244, 245);" type="text" autocomplete="of"   onkeyup="mayus(this);" maxlength="30" class="form-control"  placeholder="Ingrese el nombre" name="nombre" required value="<?php if(isset($nombre)) echo $nombre?>">
                </div>
                <div class="col">
                  <label for="pwd" class="form-label">Apellido:</label>
                  <input style="background-color:rgb(240, 244, 245);" type="text" autocomplete="off"  onkeyup="mayus(this);" maxlength="30" class="form-control"  placeholder="Ingrese su apellido" name="apellido" required value="<?php if(isset($apellido)) echo $apellido?>">
                </div>
            </div>
            <div class="row">
                <div class="col">
                  <label for="pwd" class="form-label">Usuario:</label>
                  <input style="background-color:rgb(240, 244, 245);" type="text" autocomplete="off" onkeypress="return clave(event);"  onKeyUP="this.value=this.value.toUpperCase();"  class="form-control" placeholder="Asignar usuario" name="usuario" required value="<?php if(isset($usuario)) echo $usuario?>">
                </div>
                <div class="col">
                  <label for="pwd" class="form-label">Contraseña:</label>
                  <input style="background-color:rgb(240, 244, 245);" type="password" autocomplete="off"  class="form-control"  placeholder="Ingrese la contraseña" name="contrasena" id="myInput" max="10" required pattern="(?=.*[\d])(?=.*[a-z])(?=.*[A-Z]).{8,}" onblur="quitarespacios(this);"  onkeyup="sinespacio(this);" required="" minlength="8">
                  <input type="checkbox" onclick="myFunction()" name="" id=""> Mostrar/Ocultar
                </div>
            </div>
            <div class="row">
                <div class="col">
                  <label for="pwd" class="form-label">Correo:</label>
                  <input style="background-color:rgb(240, 244, 245);" type="email" autocomplete="off" class="form-control"  placeholder="Ingrese su correo" name="correo" required value="<?php if(isset($correo)) echo $correo?>">
                </div>
                <div class="col">
                  <label for="pwd" class="form-label">DNI:</label>
                  <input style="background-color:rgb(240, 244, 245);" type="text" autocomplete="off" class="form-control"  placeholder="Ingrese su DNI sin guiones" name="dni" minlength="13" maxlength="15" required value="<?php if(isset($dni)) echo $dni?>">
                </div>
            </div>
            <div class="row">
                <div class="col">
                  <label for="pwd" class="form-label">Profesión:</label>
                  <input style="background-color:rgb(240, 244, 245);" type="text" autocomplete="off" onkeypress="return SoloLetras(event);"  onKeyUP="this.value=this.value.toUpperCase();" class="form-control"  placeholder="Ingrese su profesion" name="profesion" required value="<?php if(isset($profesion)) echo $profesion?>">
                </div>
                <div class="col">
                  <label for="pwd" class="form-label">Dirección:</label>
                  <input style="background-color:rgb(240, 244, 245);" type="text" autocomplete="off" onkeypress="return SoloLetras(event);"  onKeyUP="this.value=this.value.toUpperCase();" class="form-control"  placeholder="Ingrese su dirección" name="direccion" required value="<?php if(isset($direccion)) echo $direccion?>">
                </div>
            </div>
            <div class="row"> 
                <div class="col">
                  <label for="pwd" class="form-label">Celular:</label>
                  <input style="background-color:rgb(240, 244, 245);" type="number" autocomplete="off" class="form-control"  placeholder="Ingrese su celular" name="celular" required value="<?php if(isset($celular)) echo $celular?>">
                </div>
                <div class="col">
                  <label for="pwd" class="form-label">Referencia:</label>
                  <input style="background-color:rgb(240, 244, 245);" type="text" autocomplete="off" onkeypress="return SoloLetras(event);"  onKeyUP="this.value=this.value.toUpperCase();" class="form-control"  placeholder="Ingrese nombre referencia" name="referencia" required value="<?php if(isset($referencia)) echo $referencia?>">
                </div>
            </div>
            <div class="row">
                <div class="col">
                  <label for="pwd" class="form-label">Celular referencia:</label>
                  <input style="background-color:rgb(240, 244, 245);" type="number" autocomplete="off" class="form-control"  placeholder="Opcional" name="celular_referencia" value="<?php if(isset($celular_referencia)) echo $celular_referencia?>">
                </div>
                <div class="col">
                  <label for="pwd" class="form-label">Experiencia laboral:</label>
                  <input style="background-color:rgb(240, 244, 245);" type="text" autocomplete="off" onkeypress="return SoloLetras(event);"  onKeyUP="this.value=this.value.toUpperCase();" class="form-control"  placeholder="Ingrese su profesión u oficio" name="experiencia_laboral" required value="<?php if(isset($experiencia_laboral)) echo $experiencia_laboral?>">
                </div>
            </div>
            <div class="row">
                <div class="col"> 
                  <label for="pwd" class="form-label">Curriculum:</label>
                  <input style="background-color:rgb(240, 244, 245);" type="file" autocomplete="off" class="form-control"  placeholder="Adjunte su curriculum" name="curriculum">
                </div>
                <div class="col">
                  <label for="pwd" class="form-label">Foto:</label>
                  <input style="background-color:rgb(240, 244, 245);" type="file" autocomplete="off" class="form-control"  placeholder="Adjunte su foto" name="foto">
                </div> 
            </div>

            <div class="row">
                <div class="col">             
            <label for="sel1" class="form-label">Género:</label>
                <select placeholder="Seleccione" class="form-select" id_="sel1" name="genero" required >
                  <option></option>
                  <?php
                      include '../conexion.php';
                      $getgenero = "SELECT * FROM tbl_genero WHERE ID_GENERO ORDER BY ID_GENERO";
                      $getgenero1 = mysqli_query($conn, $getgenero);
                      if (mysqli_num_rows($getgenero1) > 0) {
                          while($row = mysqli_fetch_assoc($getgenero1))
                            {
                              $id_genero = $row['ID_GENERO'];
                              $genero =$row['GENERO'];
                           ?>
                              <option value="<?php  echo $id_genero; ?>"><?php echo $genero?></option>
                          <?php
                    }}// finaliza el if y el while

                ?>
                 </select>
            </div>
            <br>
           
                <div class="col">
                <label for="pwd" class="form-label">Area:</label>
                <input class="form-control" autocomplete="off" maxlength="20" list="browsers1" type="text" id="calcular" name="area"  id="browser" placeholder="Seleccione"  required value="<?php if(isset($area)) echo $area?>">
                <datalist id="browsers1">
                  <option value="ADMINISTRATIVA">
                  <option value="MANO DE OBRA">
                </datalist> 
                </div>   
                </div>             
           </div>
           <br>
            <div class="d-grid">
            <button type="submit" name="accion" value="registrar" class="btn btn-dark btn-block">Registrar</button><br>
            <a href="Proyecto-SEACCO/vistas/iniciar_sesion/preguntas_seguridad" class="btn btn-danger btn-block">Cancelar</a>
            </div>         
            
        </form>
      </div>
       <!--Fin Cuerpo del modal -->
    <!-- Mostrar y/u ocultar contraseña -->
    <script>
function myFunction() {
  var x = document.getElementById("myInput");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
}
</script>

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

function solonumeros(e) {
  var teclado= e.value;
  var numero= "";
  var especiales = "";

  key=e.keyCode||e.which;
  teclado = string.fromCharCode(key);
  numero = "0123456789";
  especiales = "8-37-38-46"; //Arreglo
  teclado_especial=false;

  for(var i in especiales){
    if(key==especiales[i]){
teclado_especial = true;
       }
  }
if (numero.indexOf(teclado)==-1 && !teclado_especial){
  return false;
}
};
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
