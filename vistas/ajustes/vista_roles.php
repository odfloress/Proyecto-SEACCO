<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Roles</title>
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
          <div class="col-sm-6">
            <h1></h1>
            <!-- Inicio de modal de agregar -->
<div class="container mt-3">
        <h3>Roles de Usuario Agregados</h3> <br>  
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#myModal">
            Nuevo Rol
        </button>
    </div>

<!-- El Modal -->
    <div class="modal" id="myModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Encabezado del modal -->
                <div class="modal-header">
                    <h4 class="modal-title">Nuevo Rol</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <!-- Fin Encabezado del modal -->

                <!-- Cuerpo del modal Modal -->
                <div class="modal-body">
                <div class="container mt-3">
	                <label for="pwd" class="form-label">Rol:</label><br>
                    <input type="text" name="" id="">  
                </div>

              <div class="container mt-3">
<label for="pwd" class="form-label">Nuevo Acceso:</label>
<form action="/action_page.php">
<div class="form-check">
<input type="checkbox" class="form-check-input" id="check1" name="option1" value="something" checked>
<label class="form-check-label" for="check1">Visualizar</label>
</div>
<div class="form-check">
<input type="checkbox" class="form-check-input" id="check2" name="option2" value="something">
<label class="form-check-label" for="check2">Guardar</label>
</div>
<div class="form-check">
<input type="checkbox" class="form-check-input" id="check3" name="option3" value="something">
<label class="form-check-label" for="check3">Actualizar</label>
</div>
<div class="form-check">
<input type="checkbox" class="form-check-input" id="check4" name="option4" value="something">
<label class="form-check-label" for="check4">Elimiar</label>
</div>
</form>
</div>
<div class="container mt-3">
<label for="pwd" class="form-label">Pantallas:</label>
<form action="/action_page.php">
<div class="form-check">
<input type="checkbox" class="form-check-input" id="check1" name="option1" value="something" checked>
<label class="form-check-label" for="check1">Personas</label>
</div>
<div class="form-check">
<input type="checkbox" class="form-check-input" id="check2" name="option2" value="something">
<label class="form-check-label" for="check2">Catalogo</label>
</div>
<div class="form-check">
<input type="checkbox" class="form-check-input" id="check3" name="option3" value="something">
<label class="form-check-label" for="check3">Inventario</label>
</div>
<div class="form-check">
<input type="checkbox" class="form-check-input" id="check4" name="option4" value="something">
<label class="form-check-label" for="check4">Proyectos</label>
</div>
<div class="form-check">
<input type="checkbox" class="form-check-input" id="check4" name="option4" value="something">
<label class="form-check-label" for="check4">Reportes</label>
</div>
<div class="form-check">
<input type="checkbox" class="form-check-input" id="check4" name="option4" value="something">
<label class="form-check-label" for="check4">Ajustes</label>
</div>
</form>
                </div>

                <div class="container mt-3">
	                <label for="pwd" class="form-label">Estado de Rol:</label>
                    <form>
                        <select class="form-select form-select-sm mt-3">
                            <option>Activo</option>
                            <option>Inactivo</option>
                        </select>
                    </form>    
                </div>


                </div>
                <!-- Fin Cuerpo del modal Modal -->
                <!-- pie del modal -->
                <div class="modal-footer">
      	            <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Guardar</button>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                </div>
                <!-- Fin pie del modal -->
            </div>
        </div>
    </div>
    <!-- Fin  de modal de agregar --> <br>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              
            </ol>
            
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
                <h3 class="card-title">Bitacora Universal</h3>
                
              </div>
              
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Id</th>
                    <th>Rol</th>
                    <th>Estado</th>
        	        <th>Acciones</th>
                  </tr>
                  </thead>
                  <tbody>
                  <tr>
                  <td>1</td>
                <td>Administrador</td>
                <td>Activo</td> 
                <td>
                <div class="btn-group">
<!-- Inicio de modal de editar -->
<div class="container mt-3">
        
        <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#myModal2">
        <i class="fas fa-pencil-alt"></i>
        </button>
    </div>

<!-- El Modal -->
    <div class="modal" id="myModal2">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Encabezado del modal -->
                <div class="modal-header">
                    <h4 class="modal-title">Editar Rol</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <!-- Fin Encabezado del modal -->

                <!-- Cuerpo del modal Modal -->
                <div class="modal-body">
                <div class="container mt-3">
	                <label for="pwd" class="form-label">Rol:</label><br>
                    <input type="text" name="" id="">  
                </div>

              <div class="container mt-3">
<label for="pwd" class="form-label">Nuevo Acceso:</label>
<form action="/action_page.php">
<div class="form-check">
<input type="checkbox" class="form-check-input" id="check1" name="option1" value="something" checked>
<label class="form-check-label" for="check1">Visualizar</label>
</div>
<div class="form-check">
<input type="checkbox" class="form-check-input" id="check2" name="option2" value="something">
<label class="form-check-label" for="check2">Guardar</label>
</div>
<div class="form-check">
<input type="checkbox" class="form-check-input" id="check3" name="option3" value="something">
<label class="form-check-label" for="check3">Actualizar</label>
</div>
<div class="form-check">
<input type="checkbox" class="form-check-input" id="check4" name="option4" value="something">
<label class="form-check-label" for="check4">Elimiar</label>
</div>
</form>
</div>
<div class="container mt-3">
<label for="pwd" class="form-label">Pantallas:</label>
<form action="/action_page.php">
<div class="form-check">
<input type="checkbox" class="form-check-input" id="check1" name="option1" value="something" checked>
<label class="form-check-label" for="check1">Personas</label>
</div>
<div class="form-check">
<input type="checkbox" class="form-check-input" id="check2" name="option2" value="something">
<label class="form-check-label" for="check2">Catalogo</label>
</div>
<div class="form-check">
<input type="checkbox" class="form-check-input" id="check3" name="option3" value="something">
<label class="form-check-label" for="check3">Inventario</label>
</div>
<div class="form-check">
<input type="checkbox" class="form-check-input" id="check4" name="option4" value="something">
<label class="form-check-label" for="check4">Proyectos</label>
</div>
<div class="form-check">
<input type="checkbox" class="form-check-input" id="check4" name="option4" value="something">
<label class="form-check-label" for="check4">Reportes</label>
</div>
<div class="form-check">
<input type="checkbox" class="form-check-input" id="check4" name="option4" value="something">
<label class="form-check-label" for="check4">Ajustes</label>
</div>
</form>
                </div>

                <div class="container mt-3">
	                <label for="pwd" class="form-label">Estado de Rol:</label>
                    <form>
                        <select class="form-select form-select-sm mt-3">
                            <option>Activo</option>
                            <option>Inactivo</option>
                        </select>
                    </form>    
                </div>


                </div>
                <!-- Fin Cuerpo del modal Modal -->
                <!-- pie del modal -->
                <div class="modal-footer">
      	            <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Guardar</button>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                </div>
                <!-- Fin pie del modal -->
            </div>
        </div>
    </div>
    <!-- Fin  de modal de Editar -->
                    <button  value="btnEliminar" name="accion" 
                        onclick="return confirm('¿Quieres eliminar este dato?')"
                        type="submit" class="btn btn-danger " data-id="19">
                        <i class="fas fa-trash-alt"></i>
                    </button>
</div>
                </td>                      
                 </tr>  
                 
                  
                  
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
</html>
