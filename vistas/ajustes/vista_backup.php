<?php
session_start();
if(!isset($_SESSION['usuario'])){
 
        header('Location: ../../_login.php');
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
  <title>Backup</title>
  <meta charset="utf-8">
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
            <h1 class="m-0">Backup</h1>
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
<div class="container">
      <!-- Database List -->
      <center>
        <div class="row">
          <div class="col-lg-4 offset-lg-4 o_database_list">
              <img src="../../imagenes/seacco.jpg" class="img-fluid d-block mx-auto"/>
              <br>
              <div class="shadow-lg p-4 mb-4 bg-white">
                  <div class="container mt-3 ">
                  <div class="btn-group btn-group-sm d-grid gap-3">
                                      
                      <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#myModal">
                          Respaldar Base de Datos
                      </button>
                  </div>

                  <!-- The Modal -->
                  <div class="modal" id="myModal">
                                      <div class="modal-dialog modal-lg">
                                          <div class="modal-content">

                                          <!-- Modal Header -->
                                              <div class="modal-header">
                                                  <h4 class="modal-title">Respaldar Base de Datos</h4>
                                                  <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                              </div>

                                          <!-- Modal body -->
                                          <div class="modal-body">

                                              <div class="form-group">
                                                  <label for="name" class="col-form-label">Nombre de la Base de Datos</label>
                                                  <input id="dbname_backup" type="text" name="name" class="form-control" required="required" readonly="readonly"/>
                                              </div>
                                                  <div class="form-group">
                                                      <label for="backup_format" class="col-form-label">Formato</label>
                                                      <select id="backup_format" name="backup_format" class="form-control" required="required">
                                                          <option value="zip">zip (incluye almacén de archivos)</option>
                                                          <option value="dump">pg_dump custom format (without filestore)</option>
                                                          </select>
                                                  </div>
                                              </div>
                                                          
                                          <!-- Modal footer -->
                                              <div class="modal-footer">
                                                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Continuar</button>
                                                  <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                                              </div>
                                      </div>
                  </div>
              </div>
              


              </div>
                  <div class="container mt-3 ">
                      <div class="btn-group btn-group-sm d-grid gap-3">
                                      
                                      <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#myModal2">
                                        Restaurar Base de Datos
                                      </button>
                                    </div>

                                    <!-- The Modal -->
                                    <div class="modal" id="myModal2">
                                      <div class="modal-dialog modal-lg">
                                        <div class="modal-content">

                                          <!-- Modal Header -->
                                          <div class="modal-header">
                                            <h4 class="modal-title">Restaurar Base de Datos</h4>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                          </div>

                                          <!-- Modal body -->
                                          <div class="modal-body">

                                                            <div class="form-group row">
                                                                <label for="backup_file" class="col-md-4 col-form-label">Archivo</label>
                                                                <div class="col-md-8">
                                                                    <input id="backup_file" type="file" name="backup_file" class="required"/>
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <label for="name" class="col-md-4 col-form-label">Nombre de la Base de Datos</label>
                                                                <div class="col-md-8">
                                                                    <input id="dbname_backup" type="text" name="name" class="form-control" required="required" pattern="^[a-zA-Z0-9][a-zA-Z0-9_.-]+$" title="Solo se permiten caracteres alfanuméricos, guiones bajos, guiones y puntos."/>
                                                                </div>
                                                            </div>
                                                            <BR> 
                                                            <div class="form-group row">
                                                                <label for="name2" class="col-md-4 col-form-label">Servidor Local</label>
                                                                <div class="col-md-8">
                                                                    <input id="dbname_restore" type="text" name="name" class="form-control" required="required" pattern="^[a-zA-Z0-9][a-zA-Z0-9_.-]+$" title="Solo se permiten caracteres alfanuméricos, guiones bajos, guiones y puntos."/>
                                                                </div>
                                                            </div>
                                                             <BR>

                                                    

                                          <!-- Modal footer -->
                                          <div class="modal-footer">
                                            <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Continuar</button>
                                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                                          </div>

                                        </div>
                                      </div>


                                  </div>
                              
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      
                  
              
         
    
  
      </center>



<!-- fin contenido -->



<?php include '../../configuracion/footer.php' ?>






