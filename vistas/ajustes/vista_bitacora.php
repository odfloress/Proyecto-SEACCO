<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Administracion</title>

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
<div class="container mt-3">
         
        <center><h1>Bitacora</h1></center>
        <br>
       <form>
            <div class="row">
                <div class="col">
                Fecha Inicial <input type="Date" class="form-control" >
                </div>
                <div class="col">
                Fecha Final <input type="Date" class="form-control">
                </div>
                <div class="col"><br>
                <button type="button" class="btn btn-danger">Filatrar</button>
                </div>
            </div>
        </form>
       </div>
       
       <!-- fin rangos de fechas -->
    <!-- Inicio de la tabla -->
  <div class="container" style="margin-top: 10px;padding: 5px">
     <table id="tablax" class="table table-bordered table-striped">
          <thead>
            <tr>
            <th>Fecha</th>
            <th>Usuario</th>
            <th>Acción</th>
            </tr>
          </thead>
              <tbody id="myTable">
                 <tr>
                        <td>5/8/2022 7:00am</td>
                        <td>Empleado</td>
                        <td>Modificar fotografia</td>                        
                 </tr>  
                 <tr>
                        <td>8/10/2022 7:07am</td>
                        <td>Admin</td>
                        <td>Agrego usuario</td>                        
                 </tr> 
                 <tr>
                        <td>10/4/2022 7:14am</td>
                        <td>Admin</td>
                        <td>elimino usuario</td>                        
                 </tr>       
               </tbody>        
     </table>
  </div>
 <!-- Fin Inicio de la tabla -->

<!-- fin contenido -->



<?php include '../../configuracion/footer.php' ?>


