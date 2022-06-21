<?php
session_start();
if(!isset($_SESSION['usuario'])){
 
        header('Location: ../iniciar_sesion/index_login.php');
        session_unset();
        session_destroy();
        die();
        
}
print_r($_SESSION);
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
          <form>

          <label for="">Numero telefono</label>
          <input type="number" class="form-control " placeholder="Ingre su numero">
           <br>

           <label for="">Correo</label>
           <input type="text" class="form-control" placeholder="Opcional Ingrese su correo" name="email">
           <br>

           <label for="">Dirección</label>
           <input type="text" class="form-control " placeholder="Ingre su nombre">
           <br>

            <label for="">Facebook</label>
            <input type="text" class="form-control " placeholder="Ingre su nombre">
            <br>
            <label for="">Instagram</label>
            <input type="text" class="form-control " placeholder="Ingre su nombre">
            <br>       
  </form>
      </div>

      <!-- Modal footer -->
      <div  class="modal-footer">
        
       <a href="http://127.0.0.1:8000/" class="btn btn-primary" onclick="return confirm('¿Desea guardar cambios?')">Guardar</a>
        
      </div>

    </div>
  
    

<!-- fin contenido -->



<?php include '../../configuracion/footer.php' ?>






