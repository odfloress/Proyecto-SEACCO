<?php
require 'controladores/co_registrar.php';
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
        <form action="" method="POST">
            <div class="mb-3 mt-3">
                <center><h4>Registrar usuario</h4></center><br>
                
                <center><img src="imagenes/seacco.jpg" alt="Girl in a jacket" width="150" height="150"><br></center>

            <div class="row">
                <div class="col">
                  <label for="email"  class="form-label">Nombre:</label>
                  <input style="background-color:rgb(240, 244, 245);" type="text" autocomplete="off"   onkeyup="mayus(this);" maxlength="30" class="form-control"  placeholder="Ingrese el nombre" name="nombre" required>
                </div>
                <div class="col">
                  <label for="pwd" class="form-label">Apellido:</label>
                  <input style="background-color:rgb(240, 244, 245);" type="text" autocomplete="off"  onkeyup="mayus(this);" maxlength="30" class="form-control"  placeholder="Ingrese su apellido" name="apellido" required>
                </div>
            </div>
            <div class="row">
                <div class="col">
                  <label for="pwd" class="form-label">Usuario:</label>
                  <input style="background-color:rgb(240, 244, 245);" type="text" autocomplete="off" onkeypress="return clave(event);"  onKeyUP="this.value=this.value.toUpperCase();"  class="form-control" placeholder="Asignar usuario" name="usuario" required>
                </div>
                <div class="col">
                  <div class="form-group">
                  <label for="pwd" class="form-label">Contraseña:</label> 
                    <div class="input-group mb-3">
                    <input style="background-color:rgb(240, 244, 245);" type="password" id="id_password"  autocomplete="off"  class="form-control"  placeholder="Ingrese la contraseña" name="contrasena" max="10" required pattern="(?=.*[\d])(?=.*[a-z])(?=.*[A-Z]).{8,}" onblur="quitarespacios(this);"  onkeyup="sinespacio(this);" required="" minlength="8" maxlength="9" >
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
                  <input style="background-color:rgb(240, 244, 245);" type="email" autocomplete="off" class="form-control"  placeholder="Ingrese su correo" name="correo" required>
                </div>
                <div class="col">
                  <label for="pwd" class="form-label">DNI:</label>
                  <input style="background-color:rgb(240, 244, 245);" type="text" autocomplete="off" class="form-control"  placeholder="0000-0000-000000" name="dni" minlength="13" maxlength="13" onkeypress="return solonumero(event)" required>
                </div>
            </div>
            <div class="row">
                <div class="col">
                  <label for="pwd" class="form-label">Profesión:</label>
                  <input style="background-color:rgb(240, 244, 245);" type="text" autocomplete="off" onkeypress="return SoloLetras(event);"  onKeyUP="this.value=this.value.toUpperCase();" class="form-control"  placeholder="Ingrese su profesion" name="profesion" required>
                </div>
                <div class="col">
                  <label for="pwd" class="form-label">Dirección:</label>
                  <input style="background-color:rgb(240, 244, 245);" type="text" autocomplete="off" onkeypress="return SoloLetras(event);"  onKeyUP="this.value=this.value.toUpperCase();" class="form-control"  placeholder="Ingrese su dirección" name="direccion" required>
                </div>
            </div>
            <div class="row"> 
                <div class="col">
                  <label for="pwd" class="form-label">Celular:</label>
                  <input style="background-color:rgb(240, 244, 245);" type="number" autocomplete="off" class="form-control"  placeholder="Ingrese su celular" name="celular" required>
                </div>
                <div class="col">
                  <label for="pwd" class="form-label">Referencia:</label>
                  <input style="background-color:rgb(240, 244, 245);" type="text" autocomplete="off" onkeypress="return SoloLetras(event);"  onKeyUP="this.value=this.value.toUpperCase();" class="form-control"  placeholder="Ingrese nombre referencia" name="referencia" required>
                </div>
            </div>
            <div class="row">
                <div class="col">
                  <label for="pwd" class="form-label">Celular referencia:</label>
                  <input style="background-color:rgb(240, 244, 245);" type="number" autocomplete="off" class="form-control"  placeholder="Opcional" name="celular_referencia" >
                </div>
                <div class="col">
                  <label for="pwd" class="form-label">Experiencia laboral:</label>
                  <input style="background-color:rgb(240, 244, 245);" type="text" autocomplete="off" onkeypress="return SoloLetras(event);"  onKeyUP="this.value=this.value.toUpperCase();" class="form-control"  placeholder="Ingrese su profesión u oficio" name="experiencia_laboral" required>
                </div>
            </div>
            <div class="row">
                <div class="col"> 
                  <label for="pwd" class="form-label">Curriculum:</label>
                  <input style="background-color:rgb(240, 244, 245);" type="file" autocomplete="off" class="form-control"  placeholder="Adjunte su curriculum" name="curriculum" required>
                </div>
                <div class="col">
                  <label for="pwd" class="form-label">Foto:</label>
                  <input style="background-color:rgb(240, 244, 245);" type="file" autocomplete="off" class="form-control"  placeholder="Adjunte su foto" name="foto">
                </div>
            </div>
            <div class="row">
                <div class="col">
                <label for="pwd" class="form-label">Genero:</label>
                <input class="form-control" autocomplete="off" maxlength="1" list="browsers" type="text" id="calcular" name="genero"  id="browser" placeholder="Seleccione" pattern="([F-M])" required >
                <datalist id="browsers">
                  <option value="F">
                  <option value="M">
                </datalist> 
                </div>  
                <div class="col">
                <label for="pwd" class="form-label">Area:</label>
                <input class="form-control" autocomplete="off" maxlength="20" list="browsers1" type="text" id="calcular" name="area"  id="browser" placeholder="Seleccione"  required >
                <datalist id="browsers1">
                  <option value="ADMINISTRATIVA">
                  <option value="MANO DE OBRA">
                </datalist> 
                </div>               
           </div><br>
            <div class="d-grid">
            <button type="submit" name="accion" value="registrar" class="btn btn-dark btn-block">Registrar</button><br>
            <a href="http://localhost/SEACCO/_login" class="btn btn-danger btn-block">Cancelar</a>
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