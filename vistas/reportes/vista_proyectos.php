<?php
session_start();
if(!isset($_SESSION['usuario'])){
 
        header('Location: ../../_login.php');
        session_unset();
        session_destroy();
        die();
        
}
include '../../controladores/crud_bitacora.php';


?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Reportes Proyectos</title>

  <?php include '../../configuracion/navar.php' ?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Reporte Proyectos</h1>
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
            <div class="card">
              
              <!-- /.card-header -->
              
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
             <!-- inicio rango de fechas -->
            <form>
            <div class="row">
                <div class="col">
                Fecha Inicial <input type="date" class="form-control" id="creationDateFromCampaign" value="2021-01-01" />
                </div>
                <div class="col">
                Fecha Final <input type="date" class="form-control" id="creationDateToCampaign" value="2021-02-01" />
                </div>
                <div class="col"><br>
                <button type="button" class="btn btn-danger">Filatrar</button>
                </div>
            </div>
        </form>
        <br>
        <!-- fin rango de fechas -->
            <div class="card">
              <div class="card-header">
              
              </div>
              
              <!-- /.card-header -->
              <div class="card-body">
              <table id="example1"  class="table table-bordered table-striped responsive" >
                  <thead>
                  <tr>
                    <th >ID</th>
                    <th>Fecha/Hora</th>
                    <th>Usuario</th>
                    <th>Operación</th>
                    <th>Pantalla</th>
                    <th>Campo</th>
                    <th>ID Registro</th>
                    <th>Valor Original</th>
                    <th>Valor Nuevo</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php 
                  
                  $cont = 0;
                  while ($filas= mysqli_fetch_assoc($result)){
                    ?>
                    <?php  $cont++; ?>

                  <tr>
                    <td><?php echo $cont; ?></td>
                    <td><?php echo $filas['FECHA'] ?></td>
                    <td><?php echo $filas['USUARIO'] ?></td>
                    <td><?php echo $filas['OPERACION'] ?></td> 
                    <td><?php echo $filas['PANTALLA'] ?></td> 
                    <td><?php echo $filas['CAMPO'] ?></td> 
                    <td><?php echo $filas['ID_REGISTRO'] ?></td> 
                    <td><?php echo $filas['VALOR_ORIGINAL'] ?></td> 
                    <td><?php echo $filas['VALOR_NUEVO'] ?></td>                         
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
<script src="../../plantilla/AdminLTE-3.2.0/plugins/pdfmake/pdfmake.min.js"></script>
<script src="../../plantilla/AdminLTE-3.2.0/plugins/pdfmake/vfs_fonts.js"></script>
<script src="../../plantilla/AdminLTE-3.2.0/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="../../plantilla/AdminLTE-3.2.0/plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="../../plantilla/AdminLTE-3.2.0/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<!-- AdminLTE App -->
<script src="../../plantilla/AdminLTE-3.2.0/dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../../plantilla/AdminLTE-3.2.0/dist/js/demo.js"></script>
<!-- Page specific script -->
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
                            "print": "Imprimir",
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
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
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




<script>
/* Función de filtrado */
$.fn.dataTable.ext.search.push(
  (conf, fila, indice) => {
    /* Creamos las fechas máximo y mínimo desde el campo */
    const min = new Date(creationDateFromCampaign.value);
    const max = new Date(creationDateToCampaign.value);
    /* Aquí creamos la fecha de la fila en curso */
    const fecha = new Date(fila[1]);
    /* Comparamos la fecha con el rango */
    if (fecha >= min && fecha <= max) {
      /* Si está entre las fechas mostramos la fila */
      return true;
    }
    /* En caso contario no mostramos la fila */
    return false;
  }
);
 
$(document).ready(() => {
    var tabla = $('#example1').DataTable();
 
    $('#creationDateFromCampaign, #creationDateToCampaign').on('change', () => {
        tabla.draw();
    });
});



</script>
</body>
</html>
