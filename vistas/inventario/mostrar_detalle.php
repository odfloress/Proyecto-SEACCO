
<?php
session_start();
if(!isset($_SESSION['usuario'])){
 
        header('Location: ../../_login.php');
        session_unset();
        session_destroy();
        die();
        
}
include '../../controladores/crud_compras.php';
// Selecciona el id del rol del usuario logueado
include '../../conexion/conexion.php';


$usuario = $_SESSION;
$roles34 = "SELECT * FROM tbl_usuarios WHERE USUARIO='$usuario[usuario]'";
$roles35 = mysqli_query($conn, $roles34);
if (mysqli_num_rows($roles35) > 0)
{
 while($row = mysqli_fetch_assoc($roles35))
  { 
      $id_rol7 = $row['ID_ROL'];
  } 
}

               //valida si tiene permisos de consultar la pantalla 
               $role = "SELECT * FROM tbl_ms_roles_ojetos WHERE ID_ROL='$id_rol7' and ID_OBJETO=8 and PERMISO_CONSULTAR=0";
               $roless = mysqli_query($conn, $role);
               if (mysqli_num_rows($roless) > 0)
               {
                header('Location: ../../vistas/tablero/vista_perfil.php');
                die();
               }else{
                      $role = "SELECT * FROM tbl_ms_roles_ojetos WHERE ID_ROL='$id_rol7' and ID_OBJETO=8 and PERMISO_CONSULTAR=1";
                      $roless = mysqli_query($conn, $role);
                      if (mysqli_num_rows($roless) > 0){}
                      else{
                        header('Location: ../../vistas/tablero/vista_perfil.php');
                        die();
                      }
               }

                

                if(!isset($_POST['compra'])){
                    header('Location: ../../vistas/inventario/vista_compras.php');
                }
                $compra=(isset($_POST['compra']))?$_POST['compra']:"";  // es el id de la compra
                $codigo_factura=(isset($_POST['codigo']))?$_POST['codigo']:"Sin código"; 
                if(empty($codigo_factura)){
                  $codigo_factura='Sin código';
                 
                }else{
                  $codigo_factura=$codigo_factura;
                 
                }
                $fecha=(isset($_POST['fecha']))?$_POST['fecha']:""; 
                $proveedores=(isset($_POST['proveedores']))?$_POST['proveedores']:""; 
                


?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>compras</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- enlace del scritpt para evitar si preciona F12, si preciona Ctrl+Shift+I, si preciona Ctr+u  -->
    <script type="text/javascript" src="../../js/evita_ver_codigo_utilizando_teclas.js"></script>
       <!-- /// para exportar en pdf /// -->
   <script type="text/javascript" src="../../js/complemento_1_jspdf.min.js"></script>
	<script type="text/javascript" src="../../js/complemento_2_jspdf.plugin.autotable.min.js"></script>



  <?php include '../../configuracion/navar.php' ?>
  <!-- Inicio evita el click derecho de la pagina -->
<body oncontextmenu="return false">
<!-- Fin evita el click derecho de la pagina --> 
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-7">
            
          <!-- <center><h3 class="card-title">Detalle de la compra realizada al proveedor <?php echo $proveedores; ?></h3></center> -->
     
          </div>
          <div class="col-sm-8">
            <ol class="breadcrumb float-sm-right">
            <center><h3 class="card-title">Detalle de la compra realizada al proveedor: <?php echo $proveedores; ?> con el código: <?php echo $codigo_factura; ?></h3></center>
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
             
                <form id="form" action="" method="post">
              <button type="submit"  name="accion" value="reporte_pdf" class="btn btn-secondary buttons-pdf buttons-html5"  onclick="return confirm('¿Quieres generar reporte detalle de compra?')" onclick="textToPdf()"><span>Reporte PDF</span></button>
	            </form>
                
              </div>
              
              <!-- /.card-header -->
              <div class="card-body ">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    
                  <!-- <th>ID</th> -->
                  <th class="desaparecerTemporalmente1">#</th>
                  <th class="desaparecerTemporalmente1">Código factura</th>
                  <th class="desaparecerTemporalmente1">Producto</th>
                  <th class="desaparecerTemporalmente1">Garantía</th>
                  <th class="desaparecerTemporalmente1">Unidad de medida</th>
                  <th class="desaparecerTemporalmente1">Cantidad</th>
                  <th class="desaparecerTemporalmente1">Precio</th>
                  <th class="desaparecerTemporalmente1">Fecha</th>
                  
                  
                  </tr>
                  </thead>
                  <tbody>
                  <?php
                  include '../../conexion/conexion.php';
                  //para mostrar los datos de la tabla mysql y mostrar en el crud
                  $sql7 = "SELECT * FROM ((tbl_detalle_compra d
                  INNER JOIN tbl_unidad_medida u ON d.ID_UNIDAD_MEDIDA = u.ID_UNIDAD_MEDIDA)
                  INNER JOIN tbl_productos p ON d.ID_PRODUCTO = p.ID_PRODUCTO) WHERE ID_COMPRA='$compra'";
                  $result = mysqli_query($conn, $sql7);
                  if (mysqli_num_rows($result) > 0) {
                    $cont = 0;
                  while ($filas= mysqli_fetch_assoc($result)){
                    ?>
                    <?php  $cont++; ?>
                  <tr>
                     
                    <!-- <td ><?php echo $filas['ID_DETALLE'] ?></td> -->
                    <td class="desaparecerTemporalmente1"><?php echo $cont; ?></td>
                     <td class="desaparecerTemporalmente1"><?php echo $codigo_factura; ?></td>
                     <td class="desaparecerTemporalmente1"><?php echo $filas['NOMBRE'] ?></td>
                     <td class="desaparecerTemporalmente1"><?php echo $filas['GARANTIA'] ?></td>
                     <td class="desaparecerTemporalmente1"><?php echo $filas['UNIDAD_MEDIDA'] ?></td>
                     <td class="desaparecerTemporalmente1" style="text-align: right;"><?php echo $filas['CANTIDAD'] ?></td>
                     <td class="desaparecerTemporalmente1" style="text-align: right;"><?php echo $filas['PRECIO'] ?></td>
                     <td class="desaparecerTemporalmente1"><?php echo $fecha; ?></td>
                    
      </tr>
                <?php } }?>  
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
<script src="../../plantilla/AdminLTE-3.2.0/plugins/datatables-buttons/js/buttons.html5.min.js"></script> 
 <script src="../../plantilla/AdminLTE-3.2.0/plugins/datatables-buttons/js/buttons.print.min.js"></script>


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
      "order": [[ 0, "desc" ]],
      "lengthMenu": [[10, 25, 50,   100, -1], [10, 25, 50, 100, "Todos"]],
      
      language: {
                          processing: "Tratamiento en curso...",
                          search: "Buscar&nbsp;:",
                          lengthMenu: "Consultar _MENU_ items",
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
                         "buttons": ["excel",  "colvis"],  

//  Inicio   exportar en excel 
    buttons:[ 
{
extend:    'excelHtml5',
text:      'Exportar a Excel',
titleAttr: 'Exportar a Excel',
title:     'Detalle de la compra al proveedor -'+' <?php echo $proveedores; ?>'+' Con el codigo -'+' <?php echo $codigo_factura; ?>',
exportOptions: {
columns: [0,1,2,3,4,5,6,7]
}
},
{
extend:    'colvis',
text:      'Visualizar',



}

] 
//  Fin   exportar en excel  
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

<!-- Enlace Script para que solo permita letras -->
<script type="text/javascript" src="../../js/solo_letras.js"></script>

 <!-- Enlace Script para que convierta a mayusculas las teclas que se van pulsando -->
 <script type="text/javascript" src="../../js/converir_a_mayusculas.js"></script>

 <!-- Enlace Script para quitar espacios en blanco -->
 <script type="text/javascript" src="../../js/quitar_espacios.js"></script>
</body>

<!-- // Inicio para exportar en pdf // -->

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
  $(".desaparecerTemporalmente1").css("display","");
  $(".desaparecerTemporalmente").css("display","none");

				const pdf = new jsPDF('L', 'mm', 'letter');			
        	

				
				

				pdf.autoTable(
				{ 
          html:'#example1',
					
					margin:{ top: 30 },
          
          columnStyles: {    
      
            0: {cellWidth: 11},
            1: {cellWidth: 35}, 
            2: {cellWidth: 35},  
            3: {cellWidth: 34},  
            4: {cellWidth: 35},  
            5: {cellWidth: 30},            
            6: {cellWidth: 30},
            7: {cellWidth: 40}
           
           } 
          }
				);
			//Inicio Encabezado y pie de pagina
			const pageCount = pdf.internal.getNumberOfPages();
			for(var i = 1; i <= pageCount; i++) 
			{
				pdf.setPage(i);
												//////// Encabezado ///////
				//Inicio para imagen de logo 
				var logo = new Image();
				logo.src = '../../imagenes/seacco.jpg';
				pdf.addImage(logo, 'JPEG',14,7,24,15);
				//Fin para imagen de logo 

				//muestra el titulo principal
				pdf.setFont('Arial');
				pdf.setFontSize(17);
				pdf.text('<?php echo $nombre_constructora ?>', pdf.internal.pageSize.getWidth() / 2, 15, null, 'center');

				//muestra el titulo secundario
				pdf.setFont('times');
				pdf.setFontSize(12);
				pdf.text('Reporte de compra a:'+'<?php echo $proveedores ?>', pdf.internal.pageSize.getWidth() / 2, 20, null, 'center');

												//////// pie de Pagina ///////
				//muestra la fecha
				pdf.setFont('times');
				pdf.setFontSize(9);
				var today = new Date();
				let horas = today.getHours()
				let jornada = horas >=12 ? 'PM' : 'AM';
				var newdat = "Fecha: " + today.getDate() + "/" + (today.getMonth()+1) + "/" + today.getFullYear() + " " + (horas % 12) + ":" + today.getMinutes() + ":" + today.getSeconds() + " " + jornada;
				pdf.text(245-20,297-284,newdat);
        pdf.text('<?php echo 'Creado por: '. $_SESSION['usuario']; ?>', 264, 20, {
            align: 'right',
            });
        // pdf.text(245-25,297-281,"<?php echo 'Creado por:'. $_SESSION['usuario']; ?>");

				//muestra el numero de pagina
				pdf.text('Pagina ' + String(i) + '/' + String(pageCount),282-20,297-89,null,null,"right");
			}
				//Fin Encabezado y pie de pagina

							pdf.save('Reporte de detalle de compra.pdf');
              $(".desaparecerTemporalmente").css("display","");
	})

</script>

<!-- // Fin para exportar en pdf // -->
<script type="text/javascript" src="../../js/evitar_reenvio.js"></script>
</html>
