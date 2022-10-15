<?php
session_start();
if(!isset($_SESSION['usuario'])){
 
        header('Location: ../../_login.php');
        session_unset();
        session_destroy();
        die();
        
}
include '../../controladores/co_asignaciones.php';
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

               

                if(!isset($_POST['asignacion'])){
                    header('Location: ../../vistas/inventario/vista_asignaciones.php');
                }
                $asignacion=(isset($_POST['asignacion']))?$_POST['asignacion']:"";  
 


?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title> Detalle de asignaciones</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- enlace del scritpt para evitar si preciona F12, si preciona Ctrl+Shift+I, si preciona Ctr+u  -->
    <script type="text/javascript" src="../../js/evita_ver_codigo_utilizando_teclas.js"></script>

               <!-- /// Para exportar en pdf /// -->
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
            
          <h3 class="card-title">Detalle de la asignación número <?php echo $asignacion; ?></h3>
     
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
            </div>
            <div class="card table-responsive">
              <div class="card-header">

                <form id="form" action="" method="post">
              <button type="submit"  name="accion" value="reporte_pdf" class="btn btn-secondary buttons-pdf buttons-html5"  onclick="return confirm('¿Desea generar reporte de detalle de asignaciones?')" onclick="textToPdf()"><span>Reporte PDF</span></button>
	            
            </form>
                </div>              

              <!-- /.card-header -->
              <div class="card-body ">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                  <th>Id Detalle asignación</th>
                  <th>Producto</th>
                  <th>Cantidad</th>
                  <th>Descripcion de asignacion</th>
                  <th>Empleado</th>                 
                  <th>Proyecto</th>
                  <th>Fecha de asignación</th>
                  <!-- <th>Fecha de devolución de herramientas</th> -->
                  <th>Acciones</th>

                           
                  </tr>
                  </thead>
                </body>
                  <?php
                  include '../../conexion/conexion.php';
                  //para mostrar los datos de la tabla mysql y mostrar en el crud
                  $sql7 = "SELECT * FROM (((tbl_detalle_asignacion d
                  INNER JOIN tbl_asignaciones a ON d.ID_ASIGNADO = a.ID_ASIGNADO)
                  INNER JOIN tbl_proyectos p ON a.ID_PROYECTO = p.ID_PROYECTO)
                  INNER JOIN tbl_productos pr ON d.ID_PRODUCTO = pr.ID_PRODUCTO)
                  WHERE a.ID_ASIGNADO='$asignacion'";
                  $result = mysqli_query($conn, $sql7);
                  if (mysqli_num_rows($result) > 0) {
                  while ($filas= mysqli_fetch_assoc($result)){
                    ?>


                  <tr>
                                
                     <td><?php echo $filas['ID_DETALLE_ASIGNACION'] ?></td>
                     <td><?php echo $filas['NOMBRE'] ?></td>
                     <td><?php echo $filas['CANTIDAD'] ?></td>
                     <td><?php echo $filas['DESCRIPCION_ASIGNACION1'] ?></td>
                     <td><?php echo $filas['USUARIO1'] ?></td>
                     <td><?php echo $filas['NOMBRE_PROYECTO'] ?></td>
                     <td><?php echo $filas['FECHA_ASIGNADO'] ?></td>
                     <!-- <td><?php echo $filas['FECHA_ENTREGA'] ?></td> -->
                     <td>
                         <!-- inicio boton editar -->
                         <button type="button"  class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#myModal2<?php echo $filas['ID_DETALLE_ASIGNACION'] ?>" >
                      <i class="fas fa-pencil-alt"></i>
                      </button>

                          <!-- El Modal -->
                          <div class="modal" id="myModal2<?php echo $filas['ID_DETALLE_ASIGNACION'] ?>">
                            <div class="modal-dialog">
                              <div class="modal-content">

                                <!-- Encabezado del modal -->
                                <div class="modal-header">
                                  <h4 class="modal-title">Entregar</h4>
                                  <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <!-- Fin Encabezado del modal -->


                                <!-- Cuerpo del modal Modal -->
                                <form action="" method="post">
                                          <div class="modal-body">
                                          <input type="hidden" name="asignacion" value="<?php echo $asignacion; ?>">
                                          <input type="hidden" name="id_productos_totales" value="<?php echo $filas['ID_PRODUCTO'] ?>">
                                              <label for="">ID asignación</label>
                                              <input type="text" readonly class="form-control" name="id_asignado" required value="<?php echo $filas['ID_DETALLE_ASIGNACION'] ?>" placeholder="" id="txtPrecio_Compra"   >
                                              <br>
                                              <label for="">Cantidad Asignada</label>
                                              <input type="text" class="form-control" readonly name="cantidad_asignada" required value="<?php echo $filas['CANTIDAD'] ?>" placeholder="" id="txtPrecio_Compra"   >
                                              <br>
                                              <br>
                                              <label for="">Cantidad a entregar</label>
                                              <input type="text" class="form-control"  name="cantidad_entregar" required value="" placeholder="" id="txtPrecio_Compra"   >
                                              <br>
                                              <label for="">Descripción</label>
                                              <input type="text" class="form-control" name="descripcion" required value="<?php echo $filas['DESCRIPCION_ASIGNACION1'] ?>" placeholder="" id="txtPrecio_Compra"   >
                                              <br>
                                          
                                          </div>
                                <!-- Fin Cuerpo del modal Modal -->

                                <!-- pie del modal -->
                                <div class="modal-footer">
                                <button type="submit" name="accion" value="editar" class="btn btn-primary" onclick="return confirm('¿Desea entregar esta herramienta?')">Entregar</button>
                                  <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                                </div>
                             </form>
                                  <!-- Fin pie del modal -->
                                 
                              </div>
                            </div>
                          </div>
                          <!-- fin boton editar -->
                     </td>

                     
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

<!-- Enlace Script para que solo permita letras -->
<script type="text/javascript" src="../../js/solo_letras.js"></script>

 <!-- Enlace Script para que convierta a mayusculas las teclas que se van pulsando -->
 <script type="text/javascript" src="../../js/converir_a_mayusculas.js"></script>

 <!-- Enlace Script para quitar espacios en blanco -->
 <script type="text/javascript" src="../../js/quitar_espacios.js"></script>
</body>

<!-- // Inicio para exportar en pdf // -->
<?php

	require '../../conexion/conexion.php';
  $sql1 = "SELECT * FROM ((((((tbl_detalle_asignacion da
          INNER JOIN tbl_productos pr ON da.ID_PRODUCTO = pr.ID_PRODUCTO)
          INNER JOIN tbl_asignaciones a ON da.ID_ASIGNADO = a.ID_ASIGNADO)
          INNER JOIN tbl_estado_herramienta eh ON da.ID_ESTADO_HERRAMIENTA = eh.ID_ESTADO_HERRAMIENTA)
          INNER JOIN tbl_estado_asignacion ea ON da.ID_ESTADO_ASIGNACION = ea.ID_ESTADO_ASIGNACION)
          INNER JOIN tbl_inventario i ON da.ID_PRODUCTO = i.ID_PRODUCTOS)
          INNER JOIN tbl_proyectos p ON a.ID_PROYECTO = p.ID_PROYECTO)
  ORDER BY ID_DETALLE_ASIGNACION asc";
	$query = $conn->query($sql1);
	$data = array();
	while($r=$query->fetch_object()){
    $data[] =$r; 
  }

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

			
			const pdf = new jsPDF('L', 'mm', 'letter');
						
			var columns = ["ID", "Producto", "Cantidad", "Descripción", "Empleado", "Proyecto", "Fecha de asignación"];
			var data = [
  <?php foreach($data as $d):?>
	
      ["<?php echo $d->ID_DETALLE_ASIGNACION; ?>", "<?php echo $d->NOMBRE; ?>", "<?php echo $d->CANTIDAD; ?>",
       "<?php echo $d->DESCRIPCION_ASIGNACION1; ?>", "<?php echo $d->USUARIO1; ?>", "<?php echo $d->NOMBRE_PROYECTO; ?>", 
       "<?php echo $d->FECHA_ASIGNADO; ?>"],
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
				pdf.text("<?php echo $nombre_constructora;?>", 113,15,);

				//muestra el titulo secundario
				pdf.setFont('times');
				pdf.setFontSize(12);
				pdf.text("Reporte de detalle de asignaciones", 110,20,);

												//////// pie de Pagina ///////
				//muestra la fecha
				pdf.setFont('times');
				pdf.setFontSize(9);
				var today = new Date();
				let horas = today.getHours()
				let jornada = horas >=12 ? 'PM' : 'AM';
				var newdat = "Fecha: " + today.getDate() + "/" + (today.getMonth()+1) + "/" + today.getFullYear() + " " + (horas % 12) + ":" + today.getMinutes() + ":" + today.getSeconds() + " " + jornada;
				pdf.text(250-20,297-284,newdat);

				//muestra el numero de pagina
				pdf.text('Pagina ' + String(i) + '/' + String(pageCount),220-20,297-27,null,null,"right");
			}
				//Fin Encabezado y pie de pagina

							pdf.save('Reporte de detalle de asignaciones.pdf');
	})

</script>
<!-- // Fin para exportar en pdf // -->

<script type="text/javascript" src="../../js/evitar_reenvio.js"></script>
</html>




<?php
require '../../conexion/conexion.php';
// //Variables para recuperar la información de los campos de la vista categorias de productos
$id_asignaciones=(isset($_POST['id_asignado']))?$_POST['id_asignado']:"";
$cantidad_asignada=(isset($_POST['cantidad_asignada']))?$_POST['cantidad_asignada']:"";
$cantidad_entregar=(isset($_POST['cantidad_entregar']))?$_POST['cantidad_entregar']:"";
$descripcion=(isset($_POST['descripcion']))?$_POST['descripcion']:"";
$id_productos_totales=(isset($_POST['id_productos_totales']))?$_POST['id_productos_totales']:"";


//variable para recuperar los botones de la vista categprias de productos  
$accion=(isset($_POST['accion']))?$_POST['accion']:"";



switch($accion){
  case "editar";
            if($cantidad_entregar<=$cantidad_asignada){

          $sql2 = "UPDATE tbl_inventario SET CANTIDAD_DISPONIBLE=CANTIDAD_DISPONIBLE+'$cantidad_entregar' WHERE ID_PRODUCTOS='$id_productos_totales'";
          if (mysqli_query($conn, $sql2)) {
            //  header('Location: ../../vistas/inventario/vista_categorias_productos.php');
            $sql5 = "UPDATE tbl_detalle_asignacion SET CANTIDAD=CANTIDAD-'$cantidad_entregar', DESCRIPCION_ASIGNACION1='$descripcion' WHERE ID_PRODUCTO='$id_productos_totales' and ID_DETALLE_ASIGNACION='$id_asignaciones'";
            if (mysqli_query($conn, $sql5)) {}

            echo '<script>
            alert("Se entregá la cantidad de ' . $cantidad_entregar . ', de ' . $cantidad_asignada . ', de la asignación con ID ' . $asignacion. '.");
            window.location.href="../../vistas/inventario/mostrar_detalle_asignaciones.php";
           </script>';
          }else{
               echo '<script>
                      alert("Error al entregar herramienta");
                     </script>'; mysqli_error($conn);
               }

              }else{
                echo '<script>
                      alert("Error, la cantidad a entregar debe ser menor o igual a la asignada");
                     </script>';
              }

  
       

break;


}

?>