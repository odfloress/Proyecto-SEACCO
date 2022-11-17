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
  <title>Reportes inventario</title>

  <?php include '../../configuracion/navar.php' ?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Reporte Inventario</h1>
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
        <br>
        <!-- fin rango de fechas -->
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Reportes del inventario</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Id</th>
                    <th>Item</th>
                    <th>Tipo</th>
                    <th>Nombre</th>
                    <th>Garantía</th>
                    <th>Estado</th>
                    <th>Proyecto</th>
                    <th>Precio</th>
                  </tr>
                  </thead>
                  <tbody>
                  <tr>
                    <td>1Motorsdddddddddddd</td>
                    <td>cc1Motorsdddddddddddd</td>
                    <td>Motorsdddddddddddd</td>
                    <td>TaladroMotorsdddddddddddd</td>
                    <td>N/A</td>
                    <td>uso</td>
                    <td>sdfsdfsdfsdf</td>
                    <td>1234</td>
                  </tr>
                  <tr>
                    <td>2</td>
                    <td>cc1</td>
                    <td>Electrico</td>
                    <td>Taladro</td>
                    <td>N/A</td>
                    <td>uso</td>
                    <td>sdfsdf</td>
                    <td>1234</td>
                  </tr>
                  <tr>
                    <td>2</td>
                    <td>cc1</td>
                    <td>Electrico</td>
                    <td>Taladro</td>
                    <td>N/A</td>
                    <td>uso</td>
                    <td>sdfsdf</td>
                    <td>1234</td>
                  </tr>
                  <tr>
                    <td>2</td>
                    <td>cc1</td>
                    <td>Electrico</td>
                    <td>Taladro</td>
                    <td>N/A</td>
                    <td>uso</td>
                    <td>sdfsdf</td>
                    <td>1234</td>
                  </tr>
                  <tr>
                    <td>2</td>
                    <td>cc1</td>
                    <td>Electrico</td>
                    <td>Taladro</td>
                    <td>N/A</td>
                    <td>uso</td>
                    <td>sdfsdf</td>
                    <td>1234</td>
                  </tr><tr>
                    <td>2</td>
                    <td>cc1</td>
                    <td>Electrico</td>
                    <td>Taladro</td>
                    <td>N/A</td>
                    <td>uso</td>
                    <td>sdfsdf</td>
                    <td>1234</td>
                  </tr><tr>
                    <td>2</td>
                    <td>cc1</td>
                    <td>Electrico</td>
                    <td>Taladro</td>
                    <td>N/A</td>
                    <td>uso</td>
                    <td>sdfsdf</td>
                    <td>1234</td>
                  </tr><tr>
                    <td>2</td>
                    <td>cc1</td>
                    <td>Electrico</td>
                    <td>Taladro</td>
                    <td>N/A</td>
                    <td>uso</td>
                    <td>sdfsdf</td>
                    <td>1234</td>
                  </tr><tr>
                    <td>2</td>
                    <td>cc1</td>
                    <td>Electrico</td>
                    <td>Taladro</td>
                    <td>N/A</td>
                    <td>uso</td>
                    <td>sdfsdf</td>
                    <td>1234</td>
                  </tr><tr>
                    <td>2</td>
                    <td>cc1</td>
                    <td>Electrico</td>
                    <td>Taladro</td>
                    <td>N/A</td>
                    <td>uso</td>
                    <td>sdfsdf</td>
                    <td>1234</td>
                  </tr><tr>
                    <td>2</td>
                    <td>cc1</td>
                    <td>Electrico</td>
                    <td>Taladro</td>
                    <td>N/A</td>
                    <td>uso</td>
                    <td>sdfsdf</td>
                    <td>1234</td>
                  </tr><tr>
                    <td>2</td>
                    <td>cc1</td>
                    <td>Electrico</td>
                    <td>Taladro</td>
                    <td>N/A</td>
                    <td>uso</td>
                    <td>sdfsdf</td>
                    <td>1234</td>
                  </tr><tr>
                    <td>2</td>
                    <td>cc1</td>
                    <td>Electrico</td>
                    <td>Taladro</td>
                    <td>N/A</td>
                    <td>uso</td>
                    <td>sdfsdf</td>
                    <td>1234</td>
                  </tr><tr>
                    <td>2</td>
                    <td>cc1</td>
                    <td>Electrico</td>
                    <td>Taladro</td>
                    <td>N/A</td>
                    <td>uso</td>
                    <td>sdfsdf</td>
                    <td>1234</td>
                  </tr><tr>
                    <td>2</td>
                    <td>cc1</td>
                    <td>Electrico</td>
                    <td>Taladro</td>
                    <td>N/A</td>
                    <td>uso</td>
                    <td>sdfsdf</td>
                    <td>1234</td>
                  </tr><tr>
                    <td>2</td>
                    <td>cc1</td>
                    <td>Electrico</td>
                    <td>Taladro</td>
                    <td>N/A</td>
                    <td>uso</td>
                    <td>sdfsdf</td>
                    <td>1234</td>
                  </tr><tr>
                    <td>2</td>
                    <td>cc1</td>
                    <td>Electrico</td>
                    <td>Taladro</td>
                    <td>N/A</td>
                    <td>uso</td>
                    <td>sdfsdf</td>
                    <td>1234</td>
                  </tr><tr>
                    <td>2</td>
                    <td>cc1</td>
                    <td>Electrico</td>
                    <td>Taladro</td>
                    <td>N/A</td>
                    <td>uso</td>
                    <td>sdfsdf</td>
                    <td>1234</td>
                  </tr><tr>
                    <td>2</td>
                    <td>cc1</td>
                    <td>Electrico</td>
                    <td>Taladro</td>
                    <td>N/A</td>
                    <td>uso</td>
                    <td>sdfsdf</td>
                    <td>1234</td>
                  </tr><tr>
                    <td>2</td>
                    <td>cc1</td>
                    <td>Electrico</td>
                    <td>Taladro</td>
                    <td>N/A</td>
                    <td>uso</td>
                    <td>sdfsdf</td>
                    <td>1234</td>
                  </tr><tr>
                    <td>2</td>
                    <td>cc1</td>
                    <td>Electrico</td>
                    <td>Taladro</td>
                    <td>N/A</td>
                    <td>uso</td>
                    <td>sdfsdf</td>
                    <td>1234</td>
                  </tr><tr>
                    <td>2</td>
                    <td>cc1</td>
                    <td>Electrico</td>
                    <td>Taladro</td>
                    <td>N/A</td>
                    <td>uso</td>
                    <td>sdfsdf</td>
                    <td>1234</td>
                  </tr><tr>
                    <td>2</td>
                    <td>cc1</td>
                    <td>Electrico</td>
                    <td>Taladro</td>
                    <td>N/A</td>
                    <td>uso</td>
                    <td>sdfsdf</td>
                    <td>1234</td>
                  </tr><tr>
                    <td>2</td>
                    <td>cc1</td>
                    <td>Electrico</td>
                    <td>Taladro</td>
                    <td>N/A</td>
                    <td>uso</td>
                    <td>sdfsdf</td>
                    <td>1234</td>
                  </tr><tr>
                    <td>2</td>
                    <td>cc1</td>
                    <td>Electrico</td>
                    <td>Taladro</td>
                    <td>N/A</td>
                    <td>uso</td>
                    <td>sdfsdf</td>
                    <td>1234</td>
                  </tr><tr>
                    <td>2</td>
                    <td>cc1</td>
                    <td>Electrico</td>
                    <td>Taladro</td>
                    <td>N/A</td>
                    <td>uso</td>
                    <td>sdfsdf</td>
                    <td>1234</td>
                  </tr><tr>
                    <td>2</td>
                    <td>cc1</td>
                    <td>Electrico</td>
                    <td>Taladro</td>
                    <td>N/A</td>
                    <td>uso</td>
                    <td>sdfsdf</td>
                    <td>1234</td>
                  </tr><tr>
                    <td>2</td>
                    <td>cc1</td>
                    <td>Electrico</td>
                    <td>Taladro</td>
                    <td>N/A</td>
                    <td>uso</td>
                    <td>sdfsdf</td>
                    <td>1234</td>
                  </tr><tr>
                    <td>2</td>
                    <td>cc1</td>
                    <td>Electrico</td>
                    <td>Taladro</td>
                    <td>N/A</td>
                    <td>uso</td>
                    <td>sdfsdf</td>
                    <td>1234</td>
                  </tr><tr>
                    <td>2</td>
                    <td>cc1</td>
                    <td>Electrico</td>
                    <td>Taladro</td>
                    <td>N/A</td>
                    <td>uso</td>
                    <td>sdfsdf</td>
                    <td>1234</td>
                  </tr><tr>
                    <td>2</td>
                    <td>cc1</td>
                    <td>Electrico</td>
                    <td>Taladro</td>
                    <td>N/A</td>
                    <td>uso</td>
                    <td>sdfsdf</td>
                    <td>1234</td>
                  </tr><tr>
                    <td>2</td>
                    <td>cc1</td>
                    <td>Electrico</td>
                    <td>Taladro</td>
                    <td>N/A</td>
                    <td>uso</td>
                    <td>sdfsdf</td>
                    <td>1234</td>
                  </tr><tr>
                    <td>2</td>
                    <td>cc1</td>
                    <td>Electrico</td>
                    <td>Taladro</td>
                    <td>N/A</td>
                    <td>uso</td>
                    <td>sdfsdf</td>
                    <td>1234</td>
                  </tr><tr>
                    <td>2</td>
                    <td>cc1</td>
                    <td>Electrico</td>
                    <td>Taladro</td>
                    <td>N/A</td>
                    <td>uso</td>
                    <td>sdfsdf</td>
                    <td>1234</td>
                  </tr><tr>
                    <td>2</td>
                    <td>cc1</td>
                    <td>Electrico</td>
                    <td>Taladro</td>
                    <td>N/A</td>
                    <td>uso</td>
                    <td>sdfsdf</td>
                    <td>1234</td>
                  </tr><tr>
                    <td>2</td>
                    <td>cc1</td>
                    <td>Electrico</td>
                    <td>Taladro</td>
                    <td>N/A</td>
                    <td>uso</td>
                    <td>sdfsdf</td>
                    <td>1234</td>
                  </tr><tr>
                    <td>2</td>
                    <td>cc1</td>
                    <td>Electrico</td>
                    <td>Taladro</td>
                    <td>N/A</td>
                    <td>uso</td>
                    <td>sdfsdf</td>
                    <td>1234</td>
                  </tr><tr>
                    <td>2</td>
                    <td>cc1</td>
                    <td>Electrico</td>
                    <td>Taladro</td>
                    <td>N/A</td>
                    <td>uso</td>
                    <td>sdfsdf</td>
                    <td>1234</td>
                  </tr><tr>
                    <td>2</td>
                    <td>cc1</td>
                    <td>Electrico</td>
                    <td>Taladro</td>
                    <td>N/A</td>
                    <td>uso</td>
                    <td>sdfsdf</td>
                    <td>1234</td>
                  </tr><tr>
                    <td>2</td>
                    <td>cc1</td>
                    <td>Electrico</td>
                    <td>Taladro</td>
                    <td>N/A</td>
                    <td>uso</td>
                    <td>sdfsdf</td>
                    <td>1234</td>
                  </tr><tr>
                    <td>2</td>
                    <td>cc1</td>
                    <td>Electrico</td>
                    <td>Taladro</td>
                    <td>N/A</td>
                    <td>uso</td>
                    <td>sdfsdf</td>
                    <td>1234</td>
                  </tr><tr>
                    <td>2</td>
                    <td>cc1</td>
                    <td>Electrico</td>
                    <td>Taladro</td>
                    <td>N/A</td>
                    <td>uso</td>
                    <td>sdfsdf</td>
                    <td>1234</td>
                  </tr><tr>
                    <td>2</td>
                    <td>cc1</td>
                    <td>Electrico</td>
                    <td>Taladro</td>
                    <td>N/A</td>
                    <td>uso</td>
                    <td>sdfsdf</td>
                    <td>1234</td>
                  </tr><tr>
                    <td>2</td>
                    <td>cc1</td>
                    <td>Electrico</td>
                    <td>Taladro</td>
                    <td>N/A</td>
                    <td>uso</td>
                    <td>sdfsdf</td>
                    <td>1234</td>
                  </tr><tr>
                    <td>2</td>
                    <td>cc1</td>
                    <td>Electrico</td>
                    <td>Taladro</td>
                    <td>N/A</td>
                    <td>uso</td>
                    <td>sdfsdf</td>
                    <td>1234</td>
                  </tr><tr>
                    <td>2</td>
                    <td>cc1</td>
                    <td>Electrico</td>
                    <td>Taladro</td>
                    <td>N/A</td>
                    <td>uso</td>
                    <td>sdfsdf</td>
                    <td>1234</td>
                  </tr><tr>
                    <td>2</td>
                    <td>cc1</td>
                    <td>Electrico</td>
                    <td>Taladro</td>
                    <td>N/A</td>
                    <td>uso</td>
                    <td>sdfsdf</td>
                    <td>1234</td>
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
// Funcion buscar por rango de fechas


$(document).ready(function() {
	// Funcion para convertir imagen 
	function getBase64FromImageUrl(url) {
    var img = new Image();
		img.crossOrigin = "anonymous";
    img.onload = function () {
        var canvas = document.createElement("canvas");
        canvas.width =this.width;
        canvas.height =this.height;
        var ctx = canvas.getContext("2d");
        ctx.drawImage(this, 0, 0);
        var dataURL = canvas.toDataURL("image/png");
        return dataURL.replace(/^data:image\/(png|jpg);base64,/, "");
    };
    img.src = url;  
	}// fin funcion imagen


 

    var table= $('#example1').DataTable(
    		{
    
         
      dom: 'Bfrtip',
      dom:
          "<'row'<'col-sm-2'f><'col-sm-12'B>>" +
          "<'row'<'col-sm-12'tr>>" +
         "<'row'<'col-sm-4'i><'col-sm-4 text-center'l><'col-sm-4'p>>",
			"paging": true,
			"autoWidth": true,
            "order": [[ 0, "desc" ]],/// ordenar los datos desendente
            "lengthChange": false,
            
            
            language: {//traducir
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
                         },//traducir fin
    
    
       
			"buttons": [
      
				{ 
                    
					text:'<i> Reporte</i>',
					extend: 'pdfHtml5',
                    title:'',
                   'download': 'open', // Abrir directamente en la ventan
				//	orientation: 'landscape', //orientacion de la pagina 
					pageSize: 'letter', //A3 , A5 , A6 , legal , letter tamano de la pagina
       
                    exportOptions: {
                    columns: [ 0, 1, 2,3,4,5,]// ocultar la columna de accion PARA OCULTA UNA COLUMNA SOLO QUITE EL NUMERO DE COLUNMA
                    
                }, 
					customize: function (doc) {// funcon para darle estilo al pdf

  //           var cols = [];
  //  cols[0] = {text: 'Left part', alignment: 'left', margin:[20] };
  //  cols[1] = {text: 'Right part', alignment: 'right', margin:[0,0,20], width: "400px" };      

         

						doc.content.splice(1,0);
						var today = new Date();//fecha
            let horas = today.getHours()
            let jornada = horas >=12 ? 'PM' : 'AM';
						var jsDate = today.getDate() + "/" + (today.getMonth()+1) + "/" + today.getFullYear() + " " + (horas % 12) + ":" + today.getMinutes() + ":" + today.getSeconds() + " " + jornada;//fecha
                        var logo = 'data:image/jpeg;base64,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';
                        doc.pageMargins = [80,80,80,80];//margenes 
						doc.defaultStyle.fontSize = 12;//tamno de letra cuerpo
						doc.styles.tableHeader.fontSize = 11;// tamano de letra encabezado
         
            
						doc['header']=(function() {//funcion encabezado
							return {
                                columns: [
                                        [{
                                                text: 'Constructora SEACCO',
                                                fontSize: 14,
                                                bold: true,
                                                alignment: 'center',
                                              
                                                width: '*'
                                            },
                                            {
                                                stack: [{
                                                        columns: [{
                                                                text: ['Reporte de Inventario','  ', { text: $('#min').val()},	'  ',	{ text:  $('#max').val()}],
                                                                fontSize: 14,
                                                                alignment: 'center',
                                                                width: '*',
                                                               
                                                            },
                                                          
                                                        ]
                                                    },
                                                    {
                                                        columns: [{
                                                                text: ['Fecha: ', { text: jsDate.toString() }],
                                                                fontSize: 12,
                                                                alignment: 'right',
                                                                
                                                                width: '*',
                                                                
                                                            },
                                                            
                                                        ]
                                                    },
                                                    
                                                ]
                                            }
                                        ],
                                        {
										image: logo,
                    alignment: 'left',
										width: 45,// posicion del logo
									},
                                    ],//fin columm
								        margin: 15
							}
              
						});
            
						// encabezado fin
						doc['footer']=(function(page, pages) {// funcion pie de pagina 
							return {
								columns: [
									{
										alignment: 'right',
										text: ['Página ', { text: page.toString() },	'/',	{ text: pages.toString() }],
                                    fontSize: 10,
									}
								],
								margin: 20  
							}
						});
                        //color titulo
						// doc.styles.tableHeader = { fillColor:'#CACFD2 ', color:'black' }
						// // COLORES
						// var objLayout = {};
						// objLayout['hLineWidth'] = function(i) { return .5; };
						// objLayout['vLineWidth'] = function(i) { return .5; };
						// objLayout['hLineColor'] = function(i) { return '#aaa'; };
						// objLayout['vLineColor'] = function(i) { return '#aaa'; };
						// objLayout['paddingLeft'] = function(i) { return 4; };
						// objLayout['paddingRight'] = function(i) { return 4; };
            
						// doc.content[0].layout = objLayout;
            
				}
        
				}
        
      ]


		});
       

      // poner numero a filas
 

      table.on( 'order.desc search.desc', function () {
   table.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
      cell.innerHTML = i + 1;
      table.cell(cell).invalidate('dom'); 
   } );
} ).draw();
});

</script>

</body>
</html>
