<?php
session_start();
if(!isset($_SESSION['usuario'])){
 
        header('Location: ../iniciar_sesion/index_login.php');
        session_unset();
        session_destroy();
        die();
        
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Perfil</title>

  <?php include '../../configuracion/navar.php' ?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Perfil</h1>
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
<div class="col-md-4">
 <!-- codigo inicio perfil -->
 <div class="card card-primary card-outline">
              <div class="card-body box-profile">
                <div class="text-center">
                  <img class="profile-user-img img-fluid img-circle"
                       src="../../imagenes/seacco.jpg"
                       alt="User profile picture">
                </div>

                <h3 class="profile-username text-center">DAVIDS</h3>

                <p class="text-muted text-center">información</p>

                <ul class="list-group list-group-unbordered mb-3">
                  <li class="list-group-item">
                    <b>Usuario</b> <a class="float-right">DAVIDS</a>
                  </li>
                  <li class="list-group-item">
                    <b>Nombre</b> <a class="float-right">David Sánchez</a>
                  </li>
                  <li class="list-group-item">
                    <b>Correo</b> <a class="float-right">prueba@gmail.com</a>
                  </li>
                </ul>

                <a href="#" class="btn btn-primary btn-block"><b>Guardar</b></a>
              </div>
              <!-- /.card-body -->
            </div>
            </div>
           <!-- codigo fin perfil -->
 <!-- /.col -->
 <div class="col-md-8">
            <div class="card">
              <div class="card-header p-2">
                <ul class="nav nav-pills">
                  <!-- <li class="nav-item"><a class="nav-link active" href="#activity" data-toggle="tab">Perfil</a></li> -->
                  <!-- <li class="nav-item"><a class="nav-link" href="#timeline" data-toggle="tab">Editar perfil</a></li> -->
                  <!-- <li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab">Actualizar contraseña</a></li> -->
                  <h4>Actualizar contraseña</h4>
                </ul>
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content">
                  <!-- <div class="active tab-pane" id="activity">
                    codigo inicio perfil
                    <!-- Colocar imagen -->
                    
                    <!-- codigo fin perfil -->

                 
                  </div>
                  <!-- /.tab-pane -->
                  <!-- <div class="tab-pane" id="timeline"> -->
                    <!-- The timeline -->
                   <!-- editar perfil
                  </div> -->
                  <!-- /.tab-pane -->

                  <div class="tab-pane" id="settings">
                    <form class="form-horizontal">
                      <div class="form-group row">
                        <label for="inputName" class="col-sm-2 col-form-label">Usuario:</label>
                        <div class="col-sm-10">
                          <input type="email" class="form-control" id="inputName" placeholder="Usuario">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputEmail" class="col-sm-2 col-form-label">Nueva contraseña:</label>
                        <div class="col-sm-10">
                          <input type="email" class="form-control" id="inputEmail" placeholder="Contraseña">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputName2" class="col-sm-2 col-form-label">Confirmar contraseña</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="inputName2" placeholder="Contraseña">
                        </div>
                      </div>
                      
                      
                      
                      <div class="form-group row">
                        <div class="offset-sm-2 col-sm-10">
                          <button type="submit" class="btn btn-primary">Actualizar</button>
                        </div>
                      </div>
                    </form>
                  </div>
                  <br><br>
                  <!-- /.tab-pane -->
                </div>
                <!-- /.tab-content -->
              </div><!-- /.card-body -->
            </div>
            <!-- /.card -->
          
          <!-- /.col -->

<!-- fin contenido -->



<?php include '../../configuracion/footer.php' ?>






