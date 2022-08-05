<?php
session_start();
if(!isset($_SESSION['usuario'])){
 
        header('Location: ../../_login.php');
        session_unset();
        session_destroy();
       die(); 
}
include '../../controladores/co_asignaciones.php';

?>
<!DOCTYPE html>
<html lang="es">
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
                <form action="" method="post">
                <div class="modal-header">
                     <h4 class="modal-title">Nueva asignación</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <!-- Fin Encabezado del modal -->

                <!-- Cuerpo del modal Modal -->
                <div class="modal-body">

                    <label for="">Proyecto:</label>
                <select placeholder="Seleccione" class="form-select" id="sel1" name="id_proyecto" required >
                  <option></option>
                  <?php
                      include '../../conexion/conexion.php';
                      $getproyecto1 = "SELECT * FROM tbl_proyectos  WHERE ID_ESTADOS='1' ORDER BY ID_PROYECTO";
                      $getproyecto2 = mysqli_query($conn, $getproyecto1);
                      if (mysqli_num_rows($getproyecto2) > 0) {
                          while($row = mysqli_fetch_assoc($getproyecto2))
                            {
                              $id_proyecto = $row['ID_PROYECTO'];
                              $proyecto =$row['NOMBRE_PROYECTO'];
                           ?>
                              <option value="<?php  echo $id_proyecto ?>"><?php echo $id_proyecto .' '.($proyecto)?></option>
                          <?php
                    }}// finaliza el if y el while

                ?>
                </select>


                <label for="" class="form-label">Producto:</label>
                <select placeholder="Seleccione" class="form-select" id="sel1" name="id_producto" required >
                  <option></option>
                  <?php
                      include '../../conexion/conexion.php';
                      $getproducto = "SELECT * FROM tbl_productos  WHERE ID_PRODUCTO  ORDER BY ID_PRODUCTO";
                      $getproducto1 = mysqli_query($conn, $getproducto);
                      if (mysqli_num_rows($getproducto1) > 0) {
                          while($row = mysqli_fetch_assoc($getproducto1))
                            {
                              $id_producto = $row['ID_PRODUCTO'];
                              $producto =$row['NOMBRE'];
                           ?>
                              <option value="<?php  echo $id_producto ?>"><?php echo $id_producto .' '.($producto)?></option>
                          <?php
                    }}// finaliza el if y el while

                ?>
                </select>

                    <label for="">Cantidad</label>
                    <input type="text" class="form-control" name="cantidad" required value="" placeholder="Ingrese la cantidad" id="cantidad"   > 
                    <br>
                <label for="" class="form-label">Empleado:</label>
                <select placeholder="Seleccione" class="form-select" id="sel1" name="usuario1" required >
                  <option></option>
                  <?php
                      include '../../conexion/conexion.php';
                      $getempleado = "SELECT * FROM tbl_usuarios  WHERE ID_ROL= 2 AND ID_ESTADO_USUARIO = 1 ORDER BY ID_ROL";
                      $getempleado1 = mysqli_query($conn, $getempleado);
                      if (mysqli_num_rows($getempleado1) > 0) {
                          while($row = mysqli_fetch_assoc($getempleado1))
                            {
                              $id_empleado = $row['ID_USUARIO'];
                              $usuario =$row['USUARIO'];
                           ?>
                              <option value="<?php  echo $id_empleado ?>"><?php echo $id_empleado .' '.($usuario)?></option>
                          <?php
                    }}// finaliza el if y el while

                ?>
                </select>                   
                    <label for="sel1" class="form-label">Estado de la herramienta:</label>
                <select placeholder="Seleccione" class="form-select" id="sel1" name="id_estado_herramienta" required >
                  <option></option>
                  <?php
                      include '../../conexion/conexion.php';
                      $getestado_herr = "SELECT * FROM tbl_estado_herramienta  WHERE ID_ESTADO_HERRAMIENTA  ORDER BY ID_ESTADO_HERRAMIENTA";
                      // $getpregunta1 = "SELECT * FROM tbl_preguntas  WHERE ID_PREGUNTA  NOT IN (SELECT ID_PREGUNTA  FROM  tbl_respuestas_usuario WHERE USUARIO = 'JO' ) ORDER BY ID_PREGUNTA";
                      $getestado_herr = mysqli_query($conn, $getestado_herr);
                      if (mysqli_num_rows($getestado_herr) > 0) {
                          while($row = mysqli_fetch_assoc($getestado_herr))
                            {
                              $id_estado_herramienta = $row['ID_ESTADO_HERRAMIENTA'];
                              $estado_herramienta =$row['ESTADO'];
                           ?>
                              <option value="<?php  echo $id_estado_herramienta ?>"><?php echo $id_estado_herramienta .' '.($estado_herramienta)?></option>
                          <?php
                    }}// finaliza el if y el while

                ?>
                </select>

                <label for="sel1" class="form-label">Estado de la asignacion:</label>
                <select placeholder="Seleccione" class="form-select" id="sel1" name="id_estado_asignacion" required >
                  <option></option>
                  <?php
                      include '../../conexion/conexion.php';
                      $getestado_asig = "SELECT * FROM tbl_estado_asignacion  WHERE ID_ESTADO_ASIGNACION  ORDER BY ID_ESTADO_ASIGNACION";
                      // $getpregunta1 = "SELECT * FROM tbl_preguntas  WHERE ID_PREGUNTA  NOT IN (SELECT ID_PREGUNTA  FROM  tbl_respuestas_usuario WHERE USUARIO = 'JO' ) ORDER BY ID_PREGUNTA";
                      $getestado_asig = mysqli_query($conn, $getestado_asig);
                      if (mysqli_num_rows($getestado_asig) > 0) {
                          while($row = mysqli_fetch_assoc($getestado_asig))
                            {
                              $id_estado_asignacion = $row['ID_ESTADO_ASIGNACION'];
                              $estado_asignacion =$row['ESTADO_ASIGNACION'];
                           ?>
                              <option value="<?php  echo $id_estado_asignacion ?>"><?php echo $id_estado_asignacion .' '.($estado_asignacion)?></option>
                          <?php
                    }}// finaliza el if y el while

                ?>
                </select>
                </select>
                    <label for="">Descripción de la asignación</label>
                    <input type="text" class="form-control" name="descripcion_asignacion" required value="" placeholder="Ingrese un breve comentario sobre la asignación" id="descripción_asignacion"   >
                    <br>
                    <div class="row">
                <div class="col">
                  <label type="text"  class="form-label">Fecha de asignación:</label>
                  <input style="background-color:rgb(240, 244, 245);" type="date" autocomplete="of" name="fecha_asignado" required>
                </div>
                <div class="col">
                  <label type="text" class="form-label">Fecha de entrega:</label>
                  <input style="background-color:rgb(240, 244, 245);" type="date" autocomplete="off" name="fecha_entrega" required>
                </div>
            </div>
                
                </div>

                <!-- Fin Cuerpo del modal Modal -->
                <!-- pie del modal -->
                <div class="modal-footer">
      	            <button type="submit" name="accion" value="agregar" class="btn btn-primary" onclick="return confirm('¿Desea agregar la asignacion?')">Agregar</button>
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
            
            <div class="card table-responsive">
              <div class="card-header">
                <h3 class="card-title">Asignaciones de herramientas</h3>
                
              </div>
              
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                  <th>Acciones</th>
                  <th>Id Asignación</th>
                  <th>Producto</th>
                  <th>Proyecto</th>
                  <th>Empleado</th>
                  <th>Descripción de asignación</th>
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
                      <button type="button" class="btn btn-warning" data-bs-toggle="modal"data-bs-target="#myModal2<?php echo $filas['ID_ASIGNADO'] ?>" >
                      <i class="fas fa-pencil-alt"></i>
                      </button>

                          <!-- El Modal -->
                          <div class="modal" id="myModal2<?php echo $filas['ID_ASIGNADO'] ?>">
                            <div class="modal-dialog">
                              <div class="modal-content">

                                <!-- Encabezado del modal -->
                                <div class="modal-header">
                                  <h4 class="modal-title">Editar asignación</h4>
                                  <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <!-- Fin Encabezado del modal -->


                                <!-- Cuerpo del modal Modal -->
                                <form action="" method="post">
                                          <div class="modal-body">                                         
                                              <label for="">Id asignación</label>
                                              <input type="text" readonly class="form-control" name="id_asignado" required value="<?php echo $filas['ID_ASIGNADO'] ?>" placeholder="" id="id_asignado"   >
                                              <br>
                    <label for="">Proyecto:</label>
                <select placeholder="Seleccione" class="form-select" id="sel1" name="id_proyecto" required >
                  <option></option>
                  <?php
                      include '../../conexion/conexion.php';
                      $getproyecto1 = "SELECT * FROM tbl_proyectos  WHERE ID_ESTADOS='1' ORDER BY ID_PROYECTO";
                      $getproyecto2 = mysqli_query($conn, $getproyecto1);
                      if (mysqli_num_rows($getproyecto2) > 0) {
                          while($row = mysqli_fetch_assoc($getproyecto2))
                            {
                              $id_proyecto = $row['ID_PROYECTO'];
                              $proyecto =$row['NOMBRE_PROYECTO'];
                           ?>
                              <option value="<?php  echo $id_proyecto ?>"><?php echo $id_proyecto .' '.($proyecto)?></option>
                          <?php
                    }}// finaliza el if y el while

                ?>
                </select>


                <label for="" class="form-label">Producto:</label>
                <input type="text" readonly class="form-control" name="id_producto" required value="<?php echo $filas['ID_PRODUCTO'] ?>" placeholder="" id="id_producto"   >
                <br>
                    <label for="">Cantidad</label>
                    <input type="text" class="form-control" name="cantidad" required value="" placeholder="Ingrese la cantidad" id="cantidad"   >
                    <br>
                    <label for="" class="form-label">Empleado:</label>
                <select placeholder="Seleccione" class="form-select" id="sel1" name="usuario1" required >
                  <option></option>
                  <?php
                      include '../../conexion/conexion.php';
                      $getempleado = "SELECT * FROM tbl_usuarios  WHERE ID_ROL= 2 AND ID_ESTADO_USUARIO = 1 ORDER BY ID_ROL";
                      $getempleado1 = mysqli_query($conn, $getempleado);
                      if (mysqli_num_rows($getempleado1) > 0) {
                          while($row = mysqli_fetch_assoc($getempleado1))
                            {
                              $id_empleado = $row['ID_USUARIO'];
                              $usuario =$row['USUARIO'];
                           ?>
                              <option value="<?php  echo $id_empleado ?>"><?php echo $id_empleado .' '.($usuario)?></option>
                          <?php
                    }}// finaliza el if y el while

                ?>
                </select>  



                    <label for="sel1" class="form-label">Estado de la herramienta:</label>
                <select placeholder="Seleccione" class="form-select" id="sel1" name="id_estado_herramienta" required >
                  <option></option>
                  <?php
                      include '../../conexion/conexion.php';
                      $getestado_herr = "SELECT * FROM tbl_estado_herramienta  WHERE ID_ESTADO_HERRAMIENTA  ORDER BY ID_ESTADO_HERRAMIENTA";
                      // $getpregunta1 = "SELECT * FROM tbl_preguntas  WHERE ID_PREGUNTA  NOT IN (SELECT ID_PREGUNTA  FROM  tbl_respuestas_usuario WHERE USUARIO = 'JO' ) ORDER BY ID_PREGUNTA";
                      $getestado_herr = mysqli_query($conn, $getestado_herr);
                      if (mysqli_num_rows($getestado_herr) > 0) {
                          while($row = mysqli_fetch_assoc($getestado_herr))
                            {
                              $id_estado_herramienta = $row['ID_ESTADO_HERRAMIENTA'];
                              $estado_herramienta =$row['ESTADO'];
                           ?>
                              <option value="<?php  echo $id_estado_herramienta ?>"><?php echo $id_estado_herramienta . ' '.($estado_herramienta)?></option>
                          <?php
                    }}// finaliza el if y el while

                ?>
                </select>

                <label for="sel1" class="form-label">Estado de la asignacion:</label>
                <select placeholder="Seleccione" class="form-select" id="sel1" name="id_estado_asignacion" required >
                  <option></option>
                  <?php
                      include '../../conexion/conexion.php';
                      $getestado_asig = "SELECT * FROM tbl_estado_asignacion  WHERE ID_ESTADO_ASIGNACION  ORDER BY ID_ESTADO_ASIGNACION";
                      // $getpregunta1 = "SELECT * FROM tbl_preguntas  WHERE ID_PREGUNTA  NOT IN (SELECT ID_PREGUNTA  FROM  tbl_respuestas_usuario WHERE USUARIO = 'JO' ) ORDER BY ID_PREGUNTA";
                      $getestado_asig = mysqli_query($conn, $getestado_asig);
                      if (mysqli_num_rows($getestado_asig) > 0) {
                          while($row = mysqli_fetch_assoc($getestado_asig))
                            {
                              $id_estado_asignacion = $row['ID_ESTADO_ASIGNACION'];
                              $estado_asignacion =$row['ESTADO_ASIGNACION'];
                           ?>
                              <option value="<?php  echo $id_estado_asignacion ?>"><?php echo $id_estado_asignacion .' '.($estado_asignacion)?></option>
                          <?php
                    }}// finaliza el if y el while

                ?>
                </select>
                </select>
                    <label for="">Descripción de la asignación</label>
                    <input type="text" class="form-control" name="descripcion_asignacion" required value="" placeholder="Ingrese un breve comentario sobre la asignación" id="descripción_asignacion"   >
                    <br>
                    <div class="row">
                <div class="col">
                  <label type="text"  class="form-label">Fecha de asignación:</label>
                  <input style="background-color:rgb(240, 244, 245);" type="date" autocomplete="of" name="fecha_asignado" required>
                </div>
                <div class="col">
                  <label type="text" class="form-label">Fecha de entrega:</label>
                  <input style="background-color:rgb(240, 244, 245);" type="date" autocomplete="off" name="fecha_entrega" required>
                </div>
            </div>                                    
                                          
                                <!-- Fin Cuerpo del modal Modal -->

                                <!-- pie del modal -->
                                <div class="modal-footer">
                                <button type="submit" name="accion" value="editar" class="btn btn-primary" onclick="return confirm('¿Desea editar la asignación?')">Guardar</button>
                                  <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                                </div>
                                  <!-- Fin pie del modal -->
                              </div>
                            </div>
                          </div>
                          
                          <!-- fin boton editar -->                         
                      <button value="eliminar" name="accion" 
                        onclick="return confirm('¿Quieres eliminar este dato?')"
                        type="submit" class="btn btn-danger ">
                        <i class="fas fa-trash-alt"></i>
                    </button></form>
</td>                  
                     <td><?php echo $filas['ID_ASIGNADO'] ?></td>
                     <td><?php echo $filas['NOMBRE'] ?></td>
                     <td><?php echo $filas['NOMBRE_PROYECTO'] ?></td>
                     <td><?php echo $filas['USUARIO'] ?></td>
                     <td><?php echo $filas['DESCRIPCION_ASIGNACION'] ?></td>
                     <td><?php echo $filas['CANTIDAD'] ?></td>
                     <td><?php echo $filas['ESTADO'] ?></td>
                     <td><?php echo $filas['ESTADO_ASIGNACION'] ?></td>
                     <td><?php echo $filas['FECHA_ASIGNADO'] ?></td>
                     <td><?php echo $filas['FECHA_ENTREGA'] ?></td>
                     <td><?php echo $filas['ID_PRODUCTO'] ?></td>
      </tr>
      <?php } ?>  
                  </tbody>
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
<!-- INICIO muestra los botones, traduce y Agrupar -->


<script>
  $(function () {
    $("#example1").DataTable({
      
      language: {
                          processing: "Tratamiento en curso...",
                          search: "Buscar&nbsp;:",
                          lengthMenu: "Agrupar de _MENU_ items",
                          info: "Mostrando del item _START_ al _END_ de un total de _TOTAL_ items",
                          infoEmpty: "No existen datos.",
                          infoFiltered: "(filtrado de _MAX_ elementos en total)",
                          infoPostFix: "",
                          loadingRecords: "Cargando...",
                          zeroRecords: "No se encontraron datos con tu busqueda",
                          emptyTable: "No hay datos disponibles en la tabla.",
                          paginate: {
                                          first: "Primero",
                                          previous: "Anterior",
                                          next: "Siguiente",
                                          last: "Ultimo"
                                      },
                              aria: {
                                      sortAscending: ": active para ordenar la columna en orden ascendente",
                                      sortDescending: ": active para ordenar la columna en orden descendente"
                                    },

                          buttons:{
                            "copy": "Copiar",
                            "colvis": "Visibilidad",
                            "collection": "Colección",
                            "colvisRestore": "Restaurar visibilidad",
                            "copyKeys": "Presione ctrl o u2318 + C para copiar los datos de la tabla al portapapeles del sistema. <br \/> <br \/> Para cancelar, haga clic en este mensaje o presione escape.",
                            "copySuccess": {
                                "1": "Copiada 1 fila al portapapeles",
                                "_": "Copiadas %ds fila al portapapeles"
                                },
                                },    
                         },
                         
                         "responsive": true, "lengthChange": true, "autoWidth": false,
                          "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"],                   
        
    })

      
    .buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
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
<!-- Fin muestra los botones y traduce y Agrupar -->

 <!-- Enlace Script para que convierta a mayusculas las teclas que se van pulsando -->
 <script type="text/javascript" src="../../js/converir_a_mayusculas.js"></script>
 
</body>
<script type="text/javascript" src="../../js/evitar_reenvio.js"></script>
</html>
