<?php
session_start();
if(!isset($_SESSION['usuario'])){
 
        //header('Location: ../iniciar_sesion/index_login.php');
        //session_unset();
        //session_destroy();
        //die();
        include '../../controladores/co_asignaciones.php';   
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Asignaciones</title>
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
        <h3>Asignaciones</h3> <br>  
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#myModal">
            Nueva asignación
        </button>
    </div>

<!-- El Modal -->

    <div class="modal" id="myModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Encabezado del modal -->
                <div class="modal-header">
                     <h4 class="modal-title">Nueva asignación</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <!-- Fin Encabezado del modal -->

                <!-- Cuerpo del modal Modal -->
                <div class="modal-body">

                <form action="co_asignaciones.php" method="POST">

                    <label for="sel1" class="form-label">Proyecto:</label>
                <select placeholder="Seleccione" class="form-select" id="sel1" name="proyectos" required >
                  <option></option>
                  <?php
                      include '../../conexion/conexion.php';
                      $getproyecto1 = "SELECT * FROM tbl_proyectos  WHERE ID_PROYECTO  ORDER BY ID_PROYECTO";
                      $getproyecto2 = mysqli_query($conn, $getproyecto1);
                      if (mysqli_num_rows($getproyecto2) > 0) {
                          while($row = mysqli_fetch_assoc($getproyecto2))
                            {
                              $id = $row['ID_PROYECTO'];
                              $proyecto =$row['NOMBRE'];
                           ?>
                              <option value="<?php  echo $id; ?>"><?php echo $proyecto?></option>
                          <?php
                    }}// finaliza el if y el while

                ?>
                </select>


                <br>
                    <label for="">Id producto</label>
                    <input type="text" class="form-control" name="id_producto" required value="" placeholder="Ingrese el código del producto" id="id_producto"   >
                    <br>
                    <label for="">Cantidad</label>
                    <input type="text" class="form-control" name="cantidad" required value="" placeholder="Ingrese la cantidad" id="cantidad"   >
                    <br>
                    
                    <label for="sel1" class="form-label">Estado de la herramienta:</label>
                <select placeholder="Seleccione" class="form-select" id="sel1" name="estado_herramienta" required >
                  <option></option>
                  <?php
                      include '../../conexion/conexion.php';
                      $getestado_herr = "SELECT * FROM tbl_estado_herramienta  WHERE ID_ESTADO  ORDER BY ID_ESTADO";
                      // $getpregunta1 = "SELECT * FROM tbl_preguntas  WHERE ID_PREGUNTA  NOT IN (SELECT ID_PREGUNTA  FROM  tbl_respuestas_usuario WHERE USUARIO = 'JO' ) ORDER BY ID_PREGUNTA";
                      $getestado_herr = mysqli_query($conn, $getestado_herr);
                      if (mysqli_num_rows($getestado_herr) > 0) {
                          while($row = mysqli_fetch_assoc($getestado_herr))
                            {
                              $id_estado = $row['ID_ESTADO'];
                              $estado =$row['ESTADO'];
                           ?>
                              <option value="<?php  echo $id_estado; ?>"><?php echo $estado?></option>
                          <?php
                    }}// finaliza el if y el while

                ?>
                </select>

                <label for="sel1" class="form-label">Estado de la asignacion:</label>
                <select placeholder="Seleccione" class="form-select" id="sel1" name="estado_asignacion" required >
                  <option></option>
                  <?php
                      include '../../conexion/conexion.php';
                      $getestado_asig = "SELECT * FROM tbl_estado_asignacion  WHERE ID_ASIGNACION  ORDER BY ID_ASIGNACION";
                      // $getpregunta1 = "SELECT * FROM tbl_preguntas  WHERE ID_PREGUNTA  NOT IN (SELECT ID_PREGUNTA  FROM  tbl_respuestas_usuario WHERE USUARIO = 'JO' ) ORDER BY ID_PREGUNTA";
                      $getestado_asig = mysqli_query($conn, $getestado_asig);
                      if (mysqli_num_rows($getestado_asig) > 0) {
                          while($row = mysqli_fetch_assoc($getestado_asig))
                            {
                              $id_asignacion = $row['ID_ASIGNACION'];
                              $estado_asignacion =$row['ESTADO_ASIGNACION'];
                           ?>
                              <option value="<?php  echo $id_asignacion; ?>"><?php echo $estado_asignacion?></option>
                          <?php
                    }}// finaliza el if y el while

                ?>
                </select>
                </select>
                    <label for="">Descripción de la asignación</label>
                    <input type="text" class="form-control" name="descripcion" required value="" placeholder="Ingrese un breve comentario sobre la asignación" id="descripción"   >
                    <br>
                    <div class="row">
                <div class="col">
                  <label type="text"  class="form-label">Fecha de asignación:</label>
                  <input style="background-color:rgb(240, 244, 245);" type="date" autocomplete="of" name="fecha_entrega" required>
                </div>
                <div class="col">
                  <label type="text" class="form-label">Fecha de entrega:</label>
                  <input style="background-color:rgb(240, 244, 245);" type="date" autocomplete="off" name="fecha_entrega" required>
                </div>
            </div>
                
                </div>



                </form>

                <!-- Fin Cuerpo del modal Modal -->
                <!-- pie del modal -->
                <div class="modal-footer">
      	            <button type="submit" name="accion" value="accion" class="btn btn-primary" data-bs-dismiss="modal">Agregar</button>
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
                <h3 class="card-title">Asignaciones de herramientas</h3>
                
              </div>
              
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                  <th>Acciones</th>
                  <th>Id</th>
                  <th>Id Producto</th>
                  <th>Proyecto</th>
                  <th>Asignado</th>
                  <th>Descripción</th>
                  <th>Cantidad</th>
                  <th>Estado herramienta</th>
                  <th>Estado asignación</th>
                  <th>Fecha asignado</th>
                  <th>Fecha entrega</th>                  
                  </tr>
                  </thead>
                  <tbody>

                  <?php while ($filas= mysqli_fetch_assoc($result)){
 
                  ?>   
                    
                  <tr>
                  <td>
                        <!-- inicio boton editar -->
                      <button type="button" class="btn btn-warning" data-bs-toggle="modal">
                      <i class="fas fa-pencil-alt" id="myModal"></i>
                      </button>

                          <!-- El Modal -->
                          <div class="modal" id="myModal2<?php echo $filas['ID'] ?>">
                            <div class="modal-dialog">
                              <div class="modal-content">

                                <!-- Encabezado del modal -->
                                <div class="modal-header">
                                  <h4 class="modal-title">Editar estado</h4>
                                  <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <!-- Fin Encabezado del modal -->


                                <!-- Cuerpo del modal Modal -->
                                <form action="co_asignaciones.php" method="post">
                                          <div class="modal-body">                                         
                                              <label for="">Id</label>
                                              <input type="text" readonly class="form-control" name="id" required value="<?php echo $filas['ID'] ?>" placeholder="" id="id"   >
                                              <br>
                                              <label for="">Id producto</label>
                                              <input type="text" readonly class="form-control" name="id_producto" required value="<?php echo $filas['ID_PRODUCTO'] ?>" placeholder="" id="id_producto">
                                              <br>
                                              <label for="">Proyecto</label>
                                              <input type="text" readonly class="form-control" name="id_proyecto" required value="<?php echo $filas['ID_PROYECTO'] ?>" placeholder="" id="id_proyecto">
                                              <br>
                                              <label for="">Usuario</label>
                                              <input type="text" readonly class="form-control" name="id_usuario" required value="<?php echo $filas['ID_USUARIO'] ?>" placeholder="" id="id_usuario">
                                              <br>
                                              <label for="">Descripcion</label>
                                              <input type="text" readonly class="form-control" name="descripcion" required value="<?php echo $filas['DESCRIPCION'] ?>" placeholder="" id="descripcion">
                                              <br>
                                              <label for="">Cantidad</label>
                                              <input type="text" readonly class="form-control" name="cantidad" required value="<?php echo $filas['CANTIDAD'] ?>" placeholder="" id="cantidad">
                                              <br>
                                              <label for="">Estado de herramienta</label>
                                              <input type="text" readonly class="form-control" name="estado_herramienta" required value="<?php echo $filas['ESTADO_HERRAMIENTA'] ?>" placeholder="" id="estado_herramienta">
                                              <br>
                                              <label for="">Estado de asignación</label>
                                              <input type="text" readonly class="form-control" name="estado_asignacion" required value="<?php echo $filas['ESTADO_ASIGNACION'] ?>" placeholder="" id="estado_asignacion">                          
                                              <br>
                                              <label for="">Fecha de asignación</label>
                                              <input type="text" readonly class="form-control" name="fecha_asignado" required value="<?php echo $filas['FECHA_ASIGNADO'] ?>" placeholder="" id="fecha_asignado">                          
                                              <br>
                                              <label for="">Fecha de entrega</label>
                                              <input type="text" readonly class="form-control" name="fecha_entrega" required value="<?php echo $filas['FECHA_ENTREGA'] ?>" placeholder="" id="fecha_entrega">                          
                                              <br>                                         
                                          </div>
                                <!-- Fin Cuerpo del modal Modal -->

                                <!-- pie del modal -->
                                <div class="d-grid">
                                <button type="submit" name="accion" value="accion"class="btn btn-primary" data-bs-dismiss="modal">Agregar</button>
                                  <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                                </div>
                                  <!-- Fin pie del modal -->
                              </div>
                            </div>
                          </div>
                          <!-- fin boton editar -->
                      <button  value="accion" name="accion" 
                        onclick="return confirm('¿Seguro que desea agregar esta asignacion?')"
                        type="submit" class="btn btn-danger " data-id="19">
                        <i class="fas fa-trash-alt"></i>
                    </button>
                  </form>
</td>                  
                     <td><?php echo $filas['ID_ASIGNADO'] ?></td>
                     <td><?php echo $filas['ID_PRODUCTO'] ?></td>
                     <td><?php echo $filas['ID_PROYECTO'] ?></td>
                     <td><?php echo $filas['ID_USUARIO'] ?></td>
                     <td><?php echo $filas['DESCRIPCION'] ?></td>
                     <td><?php echo $filas['CANTIDAD'] ?></td>
                     <td><?php echo $filas['ESTADO_HERRAMIENTA'] ?></td>
                     <td><?php echo $filas['ESTADO_ASIGNACION'] ?></td>
                     <td><?php echo $filas['FECHA_ASIGNADO'] ?></td>
                     <td><?php echo $filas['FECHA_ENTREGA'] ?></td>
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
</html>
