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
  <title>Bitácora</title>
   
         <!-- /// Para exportar en pdf /// -->
  <script type="text/javascript" src="../../js/complemento_1_jspdf.min.js"></script>
	<script type="text/javascript" src="../../js/complemento_2_jspdf.plugin.autotable.min.js"></script>
<!-- INICIO PARA FILTRAR UNA TABLA EN TIEMPO REAL -->
  <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
<script>
      /* Custom filtering function which will search data in column four between two values */
$.fn.dataTable.ext.search.push(function (settings, data, dataIndex) {
    var min = parseInt($('#min').val(), 10);
    var max = parseInt($('#max').val(), 10);
    var age = parseFloat(data[0]) || 0; // use data for the age column
 
    if (
        (isNaN(min) && isNaN(max)) ||
        (isNaN(min) && age <= max) ||
        (min <= age && isNaN(max)) ||
        (min <= age && age <= max)
    ) {
        return true;
    }
    return false;
});
 
// $(document).ready(function () {
//     var table = $(".desaparecerTemporalmente2").DataTable();
 
//     // Event listener to the two range filtering inputs to redraw on input
//     $('#min, #max').keyup(function () {
//         table.draw();
//     });
// });
    </script>

  <!-- FIN PARA FILTRAR UNA TABLA EN TIEMPO REAL -->
  <?php include '../../configuracion/navar.php' ?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Bitácora</h1>
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
         
        <br>
        <!-- fin rango de fechas -->
            <div class="card">
              <div class="card-header">
                      <!-- Inicio formulario de rango de fechas--------------------------------------------->
              
                <form class="form-inline" role="form" >
                      <div class="form-group col-md-4" class="form-group">
                      <p class="text-body">Fecha Inicial: </p> &nbsp; 
                      <input type="text" class="form-control" id="min" name="min">
                      </div>
                      <div class="form-group col-md-4">
                      <p class="text-body">Fecha Final: </p> &nbsp; 
                      <input type="datetime-local" class="form-control" id="max" name="max">
                      </div>

                </form><br>
 <!-- Fin formulario de rango de fechas--------------------------------------------------------------->
              <form id="form">
              <button type="submit"  name="accion" value="reporte_pdf" class="btn btn-secondary buttons-pdf buttons-html5"  onclick="return confirm('¿Desea generar reporte de bitácora?')" onclick="textToPdf()"><span>Reporte PDF</span></button>


	            </form>
                <!-- <h3 class="card-title">Bitacora Universal</h3> -->
              
              </div>
              <!-- /.card-header -->
              
              <div class="card-body">
             
                <table id="example1"  class="table table-bordered table-striped " >
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
<!-- <script src="../../plantilla/AdminLTE-3.2.0/plugins/jquery/jquery.min.js"></script> -->
<!-- Bootstrap 4 -->
<script src="../../plantilla/AdminLTE-3.2.0/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- DataTables  & Plugins -->
<!-- <script src="../../plantilla/AdminLTE-3.2.0/plugins/datatables/jquery.dataTables.min.js"></script> -->
<script src="../../plantilla/AdminLTE-3.2.0/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="../../plantilla/AdminLTE-3.2.0/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="../../plantilla/AdminLTE-3.2.0/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="../../plantilla/AdminLTE-3.2.0/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="../../plantilla/AdminLTE-3.2.0/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="../../plantilla/AdminLTE-3.2.0/plugins/jszip/jszip.min.js"></script>
<script src="../../plantilla/AdminLTE-3.2.0/plugins/pdfmake/pdfmake.min.js"></script>
<script src="../../plantilla/AdminLTE-3.2.0/plugins/pdfmake/vfs_fonts.js"></script>


<script src="../../plantilla/AdminLTE-3.2.0/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<!-- AdminLTE App -->
<script src="../../plantilla/AdminLTE-3.2.0/dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../../plantilla/AdminLTE-3.2.0/dist/js/demo.js"></script>
<!-- Page specific script -->

<script>
 


  $(function () {
    var table = $("#example1").DataTable();
    $('#min, #max').keyup(function () {
        table.draw();
    });
     table .DataTable({
    
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
   
   } );

 
</script>

<!-- // Inicio para exportar en pdf // -->
<?php

	require '../../conexion/conexion.php';
	$sql = "SELECT * FROM tbl_bitacora 
  ORDER BY ID_BITACORA desc";
	$query = $conn->query($sql);
	$data = array();
	while($r=$query->fetch_object())
	$data[] =$r;    

?>

<?php
    $select_nombre = "SELECT * FROM tbl_parametros WHERE PARAMETRO='NOMBRE'";
    $select_nombre1 = mysqli_query($conn, $select_nombre);
    if (mysqli_num_rows($select_nombre1) > 0)
    {
    while($row = mysqli_fetch_assoc($select_nombre1))
      {
          $nombre_constructora = $row['VALOR'];
      }
    }
?>

<script>
	//para descar al tocar el boton
	var form = document.getElementById("form")
	form.addEventListener("submit",function(event) {
	event.preventDefault()

			
			const pdf = new jsPDF('p', 'mm', 'letter');
						
			var columns = ["Usuario", "Acción", "Descripción", "Fecha"];
			var data = [
  <?php foreach($data as $d):?>
	
      ["<?php echo $d->USUARIO; ?>", "<?php echo $d->ACCION; ?>", "<?php echo $d->OBSERVACION; ?>","<?php echo $d->FECHA; ?>"],
      <?php endforeach; ?>
  ];
				pdf.autoTable(columns,data,
				{ 
					
					margin:{ top: 30 }}
				);
		
			//Inicio Encabezado y pie de pagina
			const pageCount = pdf.internal.getNumberOfPages();
			for(var i = 1; i <= pageCount; i++) 
			{
				pdf.setPage(i);
												//////// Encabezado ///////
				//Inicio para imagen de logo 
				var logo = new Image();
				logo.src = '../../imagenes/LoogSEACCO.jpg';
				pdf.addImage(logo, 'JPEG',14,7,24,15);
				//Fin para imagen de logo 

				//muestra el titulo principal
				pdf.setFont('Arial');
				pdf.setFontSize(17);
				pdf.text("<?php echo $nombre_constructora;?>", 70,15,);

				//muestra el titulo secundario
				pdf.setFont('times');
				pdf.setFontSize(10);
				pdf.text("Reporte de bitácora", 84,20,);

												//////// pie de Pagina ///////
				//muestra la fecha
				pdf.setFont('times');
				pdf.setFontSize(9);
				var today = new Date();
				let horas = today.getHours()
				let jornada = horas >=12 ? 'PM' : 'AM';
				var newdat = "Fecha: " + today.getDate() + "/" + (today.getMonth()+1) + "/" + today.getFullYear() + " " + (horas % 12) + ":" + today.getMinutes() + ":" + today.getSeconds() + " " + jornada;
				pdf.text(183-20,297-284,newdat);

				//muestra el numero de pagina
				pdf.text('Pagina ' + String(i) + '/' + String(pageCount),220-20,297-27,null,null,"right");
			}
				//Fin Encabezado y pie de pagina

							pdf.save('Reporte de bitácora.pdf');
	})

</script>
<!-- // Fin para exportar en pdf // -->

</script>
</body>
</html>