<?php
session_start();
if(!isset($_SESSION['usuario'])){
 
        header('Location: ../../_login.php');
        session_unset();
        session_destroy();
        die();
        
}
include '../../controladores/crud_nuestros_contactos.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Administracion</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

  <?php include '../../configuracion/navar.php' ?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0"></h1>
          </div><!-- /.col -->
          
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">
         
<!-- Contenido -->


 <div >
<center><h2>Nuestros Contactos</h2></center>
      <!-- Modal Header -->
      <center><div  class="modal-header">
         
        </div></center>

      <!-- Modal body -->
      <div class="modal-body">
      <?php while ($filas= mysqli_fetch_assoc($result)){

?>
          <form action="" method="post">
          <label for="">Id Contactos</label>
          <input type="number" name="id_contacto" class="form-control " readonly value="<?php echo $filas['ID_CONTACTO'] ?>" placeholder="Ingrese su id">
           <br>

          <label for="">Numero telefono</label>
          <input type="tel" name="telefono" class="form-control " placeholder="Ingrese su numero" value="<?php echo $filas['TELEFONO'] ?>" pattern="[0-9]{9}" onkeypress="return solonumero(event)">
           <br>

           <label for="">Correo</label>
           <input type="email" name="correo" class="form-control" value="<?php echo $filas['CORREO'] ?>" placeholder="Opcional Ingrese su correo" >
           <br>

           <label for="">Dirección</label>
           <input type="text" name="direccion" class="form-control " value="<?php echo $filas['DIRECCION'] ?>" placeholder="Ingrese su direccion" onkeyup="mayus(this);" maxlength="30" >
           <br>

            <label for="">Facebook</label>
            <input type="text" name="facebook" class="form-control " value="<?php echo $filas['FACEBOOK'] ?>"placeholder="Ingrese su facebook" onkeyup="mayus(this);" maxlength="30">
            <br>
            <label for="">Instagram</label>
            <input type="text" name="instagram" class="form-control " value="<?php echo $filas['INSTAGRAM'] ?>" placeholder="Ingrese su instagram" onkeyup="mayus(this);" maxlength="30" >
            <br>       
  
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
      	            <button type="submit" name="accion" value="agregar" class="btn btn-primary" onclick="return confirm('¿Desea agregar el contacto?')">Agregar</button>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                </div>
      
                </form> 
                <?php } ?>
    </div>
  
    

<!-- fin contenido -->



<?php include '../../configuracion/footer.php' ?>

</body>
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
        patron =/[0-9-\s]/;// -> solo numeros
        te = String.fromCharCode(tecla);
        return patron.test(te);
    }
	</script>
