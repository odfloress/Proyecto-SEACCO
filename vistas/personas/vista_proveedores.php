<?php
session_start();
if(!isset($_SESSION['usuario'])){
 
        header('Location: ../iniciar_sesion/index_login.php');
        session_unset();
        session_destroy();
        die();
        
}
include '../../controladores/crud_proveedor.php';
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
               $proveedor = "SELECT * FROM tbl_ms_roles_ojetos WHERE ID_ROL='$id_rol7' and ID_OBJETO=5 and PERMISO_CONSULTAR=0";
               $proveedor2 = mysqli_query($conn, $proveedor);
               if (mysqli_num_rows($proveedor2) > 0)
               {
                header('Location: ../../vistas/tablero/vista_perfil.php');
                die();
               }else{
                $role = "SELECT * FROM tbl_ms_roles_ojetos WHERE ID_ROL='$id_rol7' and ID_OBJETO=5 and PERMISO_CONSULTAR=1";
                $roless = mysqli_query($conn, $role);
                if (mysqli_num_rows($roless) > 0){}
                else{
                  header('Location: ../../vistas/tablero/vista_perfil.php');
                  die();
                }
               }
               // inicio inserta en la tabla bitacora
               $sql = "INSERT INTO tbl_bitacora (USUARIO, ACCION, OBSERVACION)
               VALUES ('$usuario1[usuario]', 'CONSULTO', 'CONSULTO LA PANTALLA ADMINISTRATIVA DE PROVEEDORES')";
               if (mysqli_query($conn, $sql)) {} else {}
               // fin inserta en la tabla bitacora
           

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Proveedores</title>
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
          <div class="col-sm-6">
            <h1></h1>
            <!-- Inicio de modal de agregar -->
<div class="container mt-3">
        <h3>Proveedores</h3> <br>  
    
        
    </div>
        

<!-- El Modal -->
    <div class="modal" id="myModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Encabezado del modal -->
                <div class="modal-header">
                    <h4 class="modal-title">Nuevo proveedor</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <!-- Fin Encabezado del modal -->

                <!-- Cuerpo del modal Modal -->
                <form action="" method="post">
                <div class="modal-body">
                
                    <label for="">Nombre Proveedor:</label>
                    <input type="text" class="form-control" name="nombre"  value="<?php echo $nombre; ?>" required value="" placeholder="" id="txtPrecio_Compra" autocomplete = "off" onkeypress="return soloLetras(event);" minlength="4" maxlength="50" onkeyup="mayus(this);" >
                    <br>
                    <label for="">Nombre Referencia:</label>
                    <input type="text" class="form-control" name="nombre_referencia" value="<?php echo $nombre_referencia; ?>"  required value="" placeholder="" id="txtnombrer" autocomplete = "off" onkeypress="return soloLetras(event);" minlength="4" maxlength="50" onkeyup="mayus(this);" >
                    <br>
                    <label for="">Sector Comercial:</label>
                    <input type="text" class="form-control" name="sector_comercial"  value="<?php echo $sector_comercial; ?>" required value="" placeholder="" id="txtsectorcomercial" autocomplete = "off" onkeypress="return soloLetras(event);" minlength="4" maxlength="50" onkeyup="mayus(this);" >
                    <br>
                    <label for="">Dirección:</label>
                    <input type="text" class="form-control" name="direccion" required value=""  value="<?php echo $direccion; ?>" placeholder="" id="txtdireccionproveedor" autocomplete = "off" onkeyup="mayus(this);" >
                    <br>
                    <label for="">Teléfono</label>
                    <input type="number" class="form-control" name="telefono" required value="" value="<?php echo $telefono; ?>"  placeholder="" id="txttelefono" autocomplete = "off" minlength="8" maxlength="8" required value="" placeholder="" required pattern="[0-9]+[1-9]+[0-9]+" title="8 caracteres y no todos ceros" onkeypress="return solonumero(event)" >
                    <br>
                    <label for="">Correo</label>
                    <input type="email" class="form-control" name="correo" required value=""  value="<?php echo $correo; ?>" placeholder="" id="txtcorreo"  autocomplete = "off" >
                    <br>
                </div>
                <!-- Fin Cuerpo del modal Modal -->
                <!-- pie del modal -->
                <div class="modal-footer">
      	            <button type="submit" name="accion" value="agregar" class="btn btn-primary" >Agregar</button>
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
              <form id="form" action="" method="post">
                    <div class="btn-group">
                    <?php 
      include '../../conexion/conexion.php';
      $area1 = "SELECT * FROM tbl_ms_roles_ojetos WHERE ID_ROL='$id_rol7' and ID_OBJETO=30 and PERMISO_INSERCION=1";
      $area2 = mysqli_query($conn, $area1);
      if (mysqli_num_rows($area2) > 0)
       {
         echo '<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#myModal">
                    Nuevo Proveedor
                </button>';
                          }
                        ?> 
              <button type="submit"  name="accion" value="reporte_pdf" class="btn btn-secondary buttons-pdf buttons-html5"  onclick="return confirm('¿Quieres generar reporte de Proveedores?')" onclick="textToPdf()"><span>Reporte PDF</span></button>
	               </div>
            </form>
                
              </div>
              
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                  <th>Acciones</th>
                  <th>Id</th>
                  <th>Nombre Proveedor</th>
                  <th>Nombre Referencia</th>
                  <th>Sector Comercial</th>
                  <th>Dirección</th>
                  <th>Teléfono</th>
                  <th>Correo</th>
                  
                  </tr>
                  </thead>
                  <tbody>
                  <?php while ($filas= mysqli_fetch_assoc($result)){

                  ?>
                  <tr>
                  <td>
                  <?php 
                          include '../../conexion/conexion.php';
                          $proveedor = "SELECT * FROM tbl_ms_roles_ojetos WHERE ID_ROL='$id_rol7' and ID_OBJETO=5 and PERMISO_ACTUALIZACION=1";
                          $proveedor2 = mysqli_query($conn, $proveedor);
                          if (mysqli_num_rows($proveedor2) > 0)
                          {?>
                        <!-- inicio boton editar -->
                      <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#myModal2<?php echo $filas['ID_PROVEEDOR'] ?>">
                      <i class="fas fa-pencil-alt"></i>
                      </button>
                      <?php 
                          }
                        ?>
                          <!-- El Modal -->
                          <div class="modal" id="myModal2<?php echo $filas['ID_PROVEEDOR'] ?>">
                            <div class="modal-dialog">
                              <div class="modal-content">

                                <!-- Encabezado del modal -->
                                <div class="modal-header">
                                  <h4 class="modal-title">Editar proveedor</h4>
                                  <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <!-- Fin Encabezado del modal -->


                                <!-- Cuerpo del modal Modal -->
                                <form action="" method="post">
                                          <div class="modal-body">
                                          <input type="hidden" name="nombre_anterior" value="<?php echo $filas['NOMBRE'] ?>">
                                              <!--<label  for="">Id Proveedor:</label> -->
                                              <input type="hidden" class="form-control" name="id_proveedor" readonly required value="<?php echo $filas['ID_PROVEEDOR'] ?>" placeholder="" id="txtPrecio_Compra"   >
                                              <br>
                                              <label for="">Nombre Proveedor:</label>
                                              <input type="text" class="form-control" name="nombre" autocomplete = "off" required value="<?php echo $filas['NOMBRE'] ?>" placeholder="" id="txtPrecio_Compra" onkeypress="return soloLetras(event);" onkeyup="mayus(this);" >
                                              <br>
                                              <label for="">Nombre Referencia:</label>
                                             <input type="text" class="form-control" name="nombre_referencia" autocomplete = "off" required value="<?php echo $filas['NOMBRE_REFERENCIA'] ?>" placeholder="" id="txtnombrer" onkeypress="return soloLetras(event);" onkeyup="mayus(this);" >
                                             <br>
                                             <label for="">Sector Comercial:</label>
                                             <input type="text" class="form-control" name="sector_comercial" autocomplete = "off" required value="<?php echo $filas['SECTOR_COMERCIAL'] ?>" placeholder="" id="txtsectorcomercial" onkeypress="return soloLetras(event);" onkeyup="mayus(this);" >
                                             <br>
                                             <label for="">Dirección:</label>
                                             <input type="text" class="form-control" name="direccion" autocomplete = "off" required value="<?php echo $filas['DIRECCION'] ?>" placeholder="" id="txtdireccionproveedor"  onkeyup="mayus(this);" >
                                             <br>
                                             <label for="">Teléfono:</label>
                                             <input type="text" class="form-control" name="telefono" autocomplete = "off" required value="<?php echo $filas['TELEFONO'] ?>" placeholder="" id="txttelefono" minlength="8" maxlength="8" required value="" placeholder="" required pattern="[0-9]+[1-9]+[0-9]+" title="8 caracteres y no todos ceros" onkeypress="return solonumero(event)"  >
                                             <br>
                                             <label for="">Correo:</label>
                                             <input type="email" class="form-control" name="correo" autocomplete = "off" required value="<?php echo $filas['CORREO'] ?>" placeholder="" id="txtcorreo"  >
                                             <br>   
                                           </div>
                                <!-- Fin Cuerpo del modal Modal -->

                                <!-- pie del modal -->
                                <div class="modal-footer">
                                <button type="submit" name="accion" value="editar" class="btn btn-primary">Guardar</button>
                                  <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                                </div>
                              </form>
                                  <!-- Fin pie del modal -->
                                  <form action="" method="post">
                              </div>
                            </div>
                          </div>
                          <!-- fin boton editar -->
                          <?php 
                          include '../../conexion/conexion.php';
                          $proveedor = "SELECT * FROM tbl_ms_roles_ojetos WHERE ID_ROL='$id_rol7' and ID_OBJETO=5 and PERMISO_ELIMINACION=1";
                          $proveedor2 = mysqli_query($conn, $proveedor);
                          if (mysqli_num_rows($proveedor2) > 0)
                          {?>

                          <input type="hidden" name="id_proveedor"  value="<?php echo $filas['ID_PROVEEDOR'] ?>">
                          <input type="hidden" name="nombre_anterior" value="<?php echo $filas['NOMBRE'] ?>">
                      <button  value="eliminar" name="accion" 
                        onclick="return confirm('¿Quieres eliminar este dato?')"
                        type="submit" class="btn btn-danger " data-id="19">
                        <i class="fas fa-trash-alt"></i>
                    </button>
                    <?php 
                          }
                        ?>
                      </form>
</td>
                         
                    </td>
                                         <td ><?php echo $filas['ID_PROVEEDOR'] ?></td>
                                         <td><?php echo $filas['NOMBRE'] ?></td>
                                         <td><?php echo $filas['NOMBRE_REFERENCIA'] ?></td>
                                         <td><?php echo $filas['SECTOR_COMERCIAL'] ?></td>
                                         <td><?php echo $filas['DIRECCION'] ?></td>
                                         <td><?php echo $filas['TELEFONO'] ?></td>
                                         <td><?php echo $filas['CORREO'] ?></td>
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
	$sql = "SELECT * FROM tbl_proveedores 
  ORDER BY NOMBRE asc";
	$query = $conn->query($sql);
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

			
			const pdf = new jsPDF('p', 'mm', 'letter');
						
			var columns = ["Nombre", "Referencia", "Sector comercial", "Dirección", "Teléfono", "Correo"];
			var data = [
  <?php foreach($data as $d):?>
	
      ["<?php echo $d->NOMBRE; ?>", "<?php echo $d->NOMBRE_REFERENCIA; ?>", "<?php echo $d->SECTOR_COMERCIAL; ?>", "<?php echo $d->DIRECCION; ?>", "<?php echo $d->TELEFONO; ?>", "<?php echo $d->CORREO; ?>"],
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
				logo.src = '../../imagenes/seacco.jpg';
				pdf.addImage(logo, 'JPEG',14,7,24,15);
				//Fin para imagen de logo 

				//muestra el titulo principal
				pdf.setFont('Arial');
				pdf.setFontSize(17);
				pdf.text("<?php echo $nombre_constructora; ?>", 75,15,);

				//muestra el titulo secundario
				pdf.setFont('times');
				pdf.setFontSize(12);
				pdf.text("Reporte de proveedores", 82,20,);

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

							pdf.save('Reporte de proveedores.pdf');
	})

</script>
<!-- // Fin para exportar en pdf // -->
<script type="text/javascript" src="../../js/evitar_reenvio.js"></script>
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
</html>


