<?php
session_start();
if(!isset($_SESSION['usuario'])){
 
        header('Location: ../../_login.php');
        session_unset();
        session_destroy();
        die();
        
}
include '../../controladores/crud_crear_preguntas.php';


?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Crear_preguntas</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
  



  <?php include '../../configuracion/navar.php' ?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <!-- <div class="card-header text-center">
              <h5> Preguntas de seguridad</h5>
          </div> -->
          <div class="col-sm-2">
            <!-- Inicio de modal de agregar -->
              
            <!-- El Modal -->
            <div class="modal" id="myModal">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <!-- Encabezado del modal -->
                        <form action="" method="post">
                        <div class="modal-header">
                            <h4 class="modal-title">Nueva Pregunta</h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <!-- Fin Encabezado del modal -->

                        <!-- Cuerpo del modal Modal -->
                        <div class="modal-body">
                      
                            <label for="">Pregunta</label>
                            <input type="text" class="form-control" name="pregunta" required value="" placeholder="" id="txtPrecio_Compra"   >
                            <br>
                        
                        </div>
                        <!-- Fin Cuerpo del modal Modal -->
                        <!-- pie del modal -->
                        <div class="modal-footer">
                            <button type="submit" name="accion" value="agregar" class="btn btn-primary" onclick="return confirm('¿Desea agregar la pregunta?')">Agregar</button>
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                        </div>
                        <!-- Fin pie del modal -->
                        </form>
                    </div>
                </div>
            </div>
            <!-- Fin  de modal de agregar --> 
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right"></ol>
            
          </div>
          
        </div>
        
      </div><!-- /.container-fluid -->
      
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <!-- /.card -->
            <div class="card">
                  <div class="card-header">
                    <h3 class="card-title" >Preguntas de seguridad</h3> 
                    
                  </div>
              
              <!-- /.card-header -->
              <div class="card-body ">
                    <div class="card-fluid "> 
                      <button type="button" class="btn btn-primary  " data-bs-toggle="modal" data-bs-target="#myModal">
                        Nueva pregunta
                      </button>
                    </div> <br>
                  

                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                  <th>Acciones</th>
                  <th>ID</th>
                  <th>Pregunta</th>
                  
                  
                  </tr>
                  </thead>
                  <tbody>
                    <?php while ($filas= mysqli_fetch_assoc($result)){

                     ?>
                  <tr>
                  <td>
                        <!-- inicio boton editar -->
                      <button type="button"  class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#myModal2<?php echo $filas['ID_PREGUNTA'] ?>" >
                      <i class="fas fa-pencil-alt"></i>
                      </button>

                          <!-- El Modal -->
                          <div class="modal" id="myModal2<?php echo $filas['ID_PREGUNTA'] ?>">
                            <div class="modal-dialog">
                              <div class="modal-content">

                                <!-- Encabezado del modal -->
                                <div class="modal-header">
                                  <h4 class="modal-title">Editar pregunta</h4>
                                  <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <!-- Fin Encabezado del modal -->


                                <!-- Cuerpo del modal Modal -->
                                <form action="" method="post">
                                          <div class="modal-body">
                                              <label for="">Id pregunta</label>
                                              <input type="text" readonly class="form-control" name="id_pregunta" required value="<?php echo $filas['ID_PREGUNTA'] ?>" placeholder="" id="txtPrecio_Compra"   >
                                              <br>
                                              <label for="">Pregunta</label>
                                              <input type="text" class="form-control" name="pregunta" required value="<?php echo $filas['PREGUNTA'] ?>" placeholder="" id="txtPrecio_Compra"   >
                                              <br>
                                          
                                          </div>
                                <!-- Fin Cuerpo del modal Modal -->

                                <!-- pie del modal -->
                                <div class="modal-footer">
                                <button type="submit" name="accion" value="editar" class="btn btn-primary" onclick="return confirm('¿Desea editar la pregunta?')">Guardar</button>
                                  <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                                </div>
                             
                                  <!-- Fin pie del modal -->
                                 
                              </div>
                            </div>
                          </div>
                          <!-- fin boton editar -->
                         
                          <!-- <input type="hidden" name="id_categoria" value="<?php echo $filas['ID_PREGUNTA'] ?>" > -->
                          
                      <button  value="eliminar" name="accion" 
                        onclick="return confirm('¿Quieres eliminar este dato?')"
                        type="submit" class="btn btn-danger ">
                        <i class="fas fa-trash-alt"></i>
                      </button></form>
                    
                  </td>
                     <td ><?php echo $filas['ID_PREGUNTA'] ?></td>
                     <td><?php echo $filas['PREGUNTA'] ?></td>
                    
                     </tr>
                <?php } ?>  
                  </tfoot>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <!-- To the right -->
    <div class="float-right d-none d-sm-inline">
     
    </div>
    <!-- Default to the left -->
    <strong>SEACCO &copy; 2022 </strong> 
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="../../plantilla/AdminLTE-3.2.0/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../../plantilla/AdminLTE-3.2.0/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- DataTables  & Plugins -->
<script src="../../plantilla/AdminLTE-3.2.0/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="../../plantilla/AdminLTE-3.2.0/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="../../plantilla/AdminLTE-3.2.0/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="../../plantilla/AdminLTE-3.2.0/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="../../plantilla/AdminLTE-3.2.0/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="../../plantilla/AdminLTE-3.2.0/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="../../plantilla/AdminLTE-3.2.0/plugins/jszip/jszip.min.js"></script>


<script src="../../plantilla/AdminLTE-3.2.0/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<!-- AdminLTE App -->
<script src="../../plantilla/AdminLTE-3.2.0/dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../../plantilla/AdminLTE-3.2.0/dist/js/demo.js"></script>
<!-- Page specific script -->
<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>
</body>
<script type="text/javascript" src="../../js/evitar_reenvio.js"></script>
</html>
