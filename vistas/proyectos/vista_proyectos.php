<?php
session_start();
if(!isset($_SESSION['usuario'])){
 
        header('Location: ../iniciar_sesion/index_login.php');
        session_unset();
        session_destroy();
        die();
        
}
include '../../controladores/crud_proyectos.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Proyectos</title>
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
        <h3>Proyectos</h3> <br>  
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#myModal">
            Nuevo proyecto
        </button>
    </div>

<!-- El Modal -->
    <div class="modal" id="myModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Encabezado del modal -->
                <div class="modal-header">
                    <h4 class="modal-title">Nuevo proyecto</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <!-- Fin Encabezado del modal -->

                <!-- Cuerpo del modal Modal -->
                <form action="" method="post">
                <div class="modal-body">
                <label for="">Id Proyecto</label>
                    <input class="form-control" type="number" name="id_proyecto" id="">
                    <br>
                  <label for="">Id Cliente</label>
                    <input class="form-control" type="number" name="id_cliente" id="">
                    <br>
                    <label for="">Id Encargado</label>
                    <input class="form-control" type="number" name="id_usuario" id="">
                    <br>
                    <label for="">Id Estado</label>
                    <input class="form-control" type="number" name="id_estado" id="">
                    <br>
                    <label for="">Nombre Proyecto</label>
                    <input class="form-control" type="text" name="nombre" id="" onkeypress="return soloLetras(event);" minlength="3" maxlength="255" onkeyup="mayus(this);>
                    <br>
                    <label for="">Descripción proyecto</label>
                    <input class="form-control" type="text" name="descripcion" id="" onkeypress="return soloLetras(event);" minlength="3" maxlength="300" onkeyup="mayus(this);">
                    <br>
                    <label for="">Ubicación Proyecto</label>
                    <input class="form-control" type="text" name="ubicacion" id="" onkeypress="return soloLetras(event);" minlength="3" maxlength="255" onkeyup="mayus(this);">
                    <br>
                    <label for="">Fecha inicio</label>
                    <input class="form-control" type="Date" name="fecha_inicio" id="">
                    <br>
                    <label for="">Fecha final</label>
                    <input class="form-control" type="Date" name="fecha_final" id="">
                    <br>
        
      </div>
                <!-- Fin Cuerpo del modal Modal -->
                <!-- pie del modal -->
                <div class="modal-footer">
      	            <button type="submit" name="accion" value="agregar" class="btn btn-primary" onclick="return confirm('¿Desea agregar el proyecto?')">Agregar</button>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                </div>
                <!-- Fin pie del modal -->
                </form>
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
                <h3 class="card-title">Proyectos</h3>
                
              </div>
              
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                  <th>Acciones</th>
                    <th>Id proyecto</th>
                    <th>Id Cliente</th>
                    <th>Id Encargado</th>
                    <th>Id Estado</th>
                    <th>Proyecto</th>
                    <th>Descripción</th>
                    <th>Ubicación</th>
                    <th>Fecha inicio</th>
                    <th>Fecha Final</th>
                    
                  </tr>
                  </thead>
                  <tbody>
                  <?php while ($filas= mysqli_fetch_assoc($result)){

                  ?>
                  <tr>
                  <td>
                        <!-- inicio boton editar -->
                        <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#myModal2<?php echo $filas['ID_PROYECTO'] ?>">
                        <i class="fas fa-pencil-alt"></i>
                        </button>

                            <!-- El Modal -->
                            <div class="modal" id="myModal2<?php echo $filas['ID_PROYECTO'] ?>">
                            <div class="modal-dialog">
                                <div class="modal-content">

                                <!-- Encabezado del modal -->
                                <div class="modal-header">
                                    <h4 class="modal-title">Editar proyecto</h4>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <!-- Fin Encabezado del modal -->


                            <!-- Cuerpo del modal Modal -->
                            <form action="" method="post">
                            <div class="modal-body">
                   <label for="">Id Proyecto</label>
                    <input class="form-control" type="number" name="id_proyecto" id="" value="<?php echo $filas['ID_CLIENTES'] ?>">
                   <br>            
                 <label for="">Id Cliente</label>
                    <input class="form-control" type="number" name="id_cliente" id="" value="<?php echo $filas['ID_CLIENTES'] ?>">
                    <br>
                    <label for="">Id Encargado</label>
                    <input class="form-control" type="number" name="id_usuario" id="" value="<?php echo $filas['ID_USUARIO'] ?>">
                    <br>
                    <label for="">Id Estado</label>
                    <input class="form-control" type="number" name="id_estado" id="" value="<?php echo $filas['ID_ESTADOS'] ?>">
                    <br>
                    <label for="">Nombre Proyecto</label>
                    <input class="form-control" type="text" name="nombre" id="" value="<?php echo $filas['NOMBRE'] ?>" onkeypress="return soloLetras(event);" minlength="3" maxlength="255" onkeyup="mayus(this);" >
                    <br>
                    <label for="">Descripción proyecto</label>
                    <input class="form-control" type="text" name="descripcion" id="" value="<?php echo $filas['DESCRIPCION'] ?>" onkeypress="return soloLetras(event);" minlength="3" maxlength="300" onkeyup="mayus(this);" >
                    <br>
                    <label for="">Ubicación Proyecto</label>
                    <input class="form-control" type="text" name="ubicacion" id=""value="<?php echo $filas['UBICACION'] ?>" onkeypress="return soloLetras(event);" minlength="3" maxlength="255" onkeyup="mayus(this);"  >
                    <br>
                    <label for="">Fecha inicio</label>
                    <input class="form-control" type="Date" name="fecha_inicio" id="" value="<?php echo $filas['FECHA_INICIO'] ?>">
                    <br>
                    <label for="">Fecha final</label>
                    <input class="form-control" type="Date" name="fecha_final" id="" value="<?php echo $filas['FECHA_FINAL'] ?>">
                    <br>
        
      </div>
                            <!-- Fin Cuerpo del modal Modal -->

                                <!-- pie del modal -->
                                <div class="modal-footer">
                                <button <button type="submit" name="accion" value="editar" class="btn btn-primary" onclick="return confirm('¿Desea editar el proyecto?')">Guardar</button>
                                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                                </div>
                                </form>
                                    <!-- Fin pie del modal -->
                                    <form action="" method="post">
                                </div>
                            </div>
                            </div>
                            <!-- fin boton editar -->
                    <button  value="eliminar" name="accion" 
                        onclick="return confirm('¿Quieres eliminar este dato?')"
                        type="submit" class="btn btn-danger " data-id="19">
                        <i class="fas fa-trash-alt"></i>
                    </button> </form>
</td>
                            <td ><?php echo $filas['ID_PROYECTO'] ?></td>
                            <td><?php echo $filas['ID_CLIENTE'] ?></td>
                            <td><?php echo $filas['ID_USUARIO'] ?></td>
                            <td><?php echo $filas['ID_ESTADO'] ?></td>
                            <td><?php echo $filas['NOMBRE'] ?></td>
                            <td><?php echo $filas['DESCRIPCION'] ?></td>
                            <td><?php echo $filas['UBICACION'] ?></td>
                            <td><?php echo $filas['FECHA_INICIO'] ?></td>
                            <td><?php echo $filas['FECHA_FINAL'] ?></td>
                            </tr>
                            <?php } ?> 
                   
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
<script type="text/javascript" src="../../js/evitar_reenvio.js"></script>
</html>

<script type="text/javascript">
  
        function mayus(e) {
          e.value = e.value.toUpperCase();
         }
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

