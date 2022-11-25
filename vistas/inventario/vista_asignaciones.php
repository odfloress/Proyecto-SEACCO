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
    <!-- enlace del scritpt para evitar si preciona F12, si preciona Ctrl+Shift+I, si preciona Ctr+u  -->
    <script type="text/javascript" src="../../js/evita_ver_codigo_utilizando_teclas.js"></script>

           <!-- /// Para exportar en pdf /// -->
  <script type="text/javascript" src="../../js/complemento_1_jspdf.min.js"></script>
	<script type="text/javascript" src="../../js/complemento_2_jspdf.plugin.autotable.min.js"></script>

   <!-- ////////////// Inicio para select ////////// -->
<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css"> -->
<link rel='stylesheet prefetch' href='https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.11.2/css/bootstrap-select.min.css'>
<link rel="stylesheet" href="../../css/est.css">

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.3/js/bootstrap-select.min.js"></script>
<!-- ////////////// Fin para select ////////// -->

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
          <div class="col-sm-2">
            <h1></h1>
            <!-- Inicio de modal de agregar -->
<div class="container mt-3">
  
        <h3>Asignaciones</h3>  
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
                <label for="">Seleccione el proyecto</label>
                    <select name="id_proyecto" required class="form-control selectpicker"  data-live-search="true">
                    <option>Seleccione</option>
                        <?php
                            include '../../conexion/conexion.php';
                            $proyecto = " SELECT * FROM tbl_proyectos WHERE ID_ESTADOS!=6 and ID_ESTADOS!=5 and ID_ESTADOS!=3";
                            $proyecto1 = mysqli_query($conn, $proyecto);
                            if (mysqli_num_rows($proyecto1) > 0) {
                                while($row = mysqli_fetch_assoc($proyecto1))
                                {
                                $id_proyecto = $row['ID_PROYECTO'];
                                $nombre_proyecto =$row['NOMBRE_PROYECTO'];
                         ?>
                          <option value="<?php  echo $id_proyecto ?>"><?php echo $id_proyecto .' - '.  $nombre_proyecto ?></option>
                          <?php
                           }}// finaliza el if y el while
                           ?>
                   </select><br><br>
                   <label for="">Seleccione el usuario</label>
                    <select  name="id_usuario" required class="form-control selectpicker"  data-live-search="true">
                    <option>Seleccione</option>
                        <?php
                            include '../../conexion/conexion.php';
                            $usuariooo = " SELECT * FROM tbl_usuarios WHERE ID_ESTADO_USUARIO=1 AND USUARIO!='ADMINISTRADOR'";
                            $usario77 = mysqli_query($conn, $usuariooo);
                            if (mysqli_num_rows($usario77) > 0) {
                                while($row = mysqli_fetch_assoc($usario77))
                                {
                                $id_usuario = $row['ID_USUARIO'];
                                $usuarioo =$row['USUARIO'];
                         ?>
                          <option value="<?php  echo $id_usuario ?>"><?php echo $id_usuario .' - '.  $usuarioo ?></option>
                          <?php
                           }}// finaliza el if y el while
                           ?>
                   </select><br><br>

                   <label for="">Producto</label>
                    <select  name="id_producto" required class="form-control selectpicker"  data-live-search="true" >
                    <option value="">Selecciona el producto</option>
                        <?php
                            include '../../conexion/conexion.php';
                            $productos = "SELECT * FROM tbl_productos  ";
                            $productos2 = mysqli_query($conn, $productos);
                            if (mysqli_num_rows($productos2) > 0) {
                                while($row = mysqli_fetch_assoc($productos2))
                                {
                                $id_productoss = $row['ID_PRODUCTO'];
                                $producto =$row['NOMBRE'];
                         ?>
                          <option value="<?php  echo $id_productoss ?>"><?php echo $producto ?></option>
                          <?php
                           }}// finaliza el if y el while
                           ?>
                   </select><br><br>
                   <label for="">Cantidad asignada</label>
                   <input type="text" class="form-control" name="cantidad_asignada" required value="<?php echo $CANT_ASIGNADA; ?>" placeholder=""  
                    autocomplete = "off" minlength="1" maxlength="12"  onkeypress="return filterFloat(event,this);" >
                   
                    <label for="sel1" class="form-label">Estado de la asignación:</label>
                <select  name="id_estado_asignacion" required class="form-control selectpicker"  data-live-search="true">
                  <option>Seleccione</option>
                  <?php
                      include '../../conexion/conexion.php';
                      $getestado_herr = "SELECT * FROM  tbl_estado_asignacion";
                      // $getpregunta1 = "SELECT * FROM tbl_preguntas  WHERE ID_PREGUNTA  NOT IN (SELECT ID_PREGUNTA  FROM  tbl_respuestas_usuario WHERE USUARIO = 'JO' ) ORDER BY ID_PREGUNTA";
                      $getestado_herr = mysqli_query($conn, $getestado_herr);
                      if (mysqli_num_rows($getestado_herr) > 0) {
                          while($row = mysqli_fetch_assoc($getestado_herr))
                            {
                              $id_estado_herramienta = $row['ID_ESTADO_ASIGNACION'];
                              $estado_herramienta =$row['ESTADO_ASIGNACION'];
                           ?>
                              <option value="<?php  echo $id_estado_herramienta ?>"><?php echo $id_estado_herramienta .' - '.($estado_herramienta)?></option>
                          <?php
                    }}// finaliza el if y el while

                ?>
                </select><br><br>

                <label for="">Descripción de asignación:</label>
                    <TEXtarea  style="background-color: white;" onkeyup="un_espacio(this);" name="descripcion_asignacion" class="form-control" id="" required cols="40" rows="5"
                    autocomplete = "off"   minlength="3" maxlength="245"  ><?php echo $DESCRIPCION_ASIGNACION; ?></TEXtarea>
                    

                    <label for="">Fecha asignación:</label>
                    <input type="datetime-local" name="fecha_asignacion" class="form-control" id="">
                    <label for="">Fecha entrega:</label>
                    <input type="datetime-local" name="fecha_entrega" class="form-control" id="">
                </div>
                <!-- Fin Cuerpo del modal Modal -->
                <!-- pie del modal -->
                <div class="modal-footer">
      	            <button type="submit" name="accion" value="agregar" class="btn btn-primary" onclick="return confirm('¿Desea crear esta asignación?')">Agregar</button>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                </div>
                <!-- Fin pie del modal -->
                </form>
            </div>
        </div>
    </div>
    <!-- Fin  de modal de agregar -->
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
              <form id="form" action="" method="post">
        <?php 
      include '../../conexion/conexion.php'; 


                $tablero = "SELECT * FROM tbl_ms_roles_ojetos WHERE ID_ROL='$id_rol7' and ID_OBJETO=8 and PERMISO_INSERCION=1";
                $tablero2 = mysqli_query($conn, $tablero);
                if (mysqli_num_rows($tablero2) > 0)
                {
                  echo '<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#myModal">
                              Nueva asignación
                          </button>';
                }
         
                                  ?> 

        <button type="submit"  name="accion" value="reporte_pdf" class="btn btn-secondary buttons-pdf buttons-html5"  onclick="return confirm('¿Quieres generar reporte de asignaciones?')" onclick="textToPdf()"><span>Reporte PDF</span></button>
       
      </form>
                <!-- <h3 class="card-title">Compras</h3> -->
                
              </div>
              
              <!-- /.card-header -->
              <div class="card-body ">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Accion</th>
                    <th>ID</th>
                    <th>Proyecto</th>
                    <th>Usuario</th> 
                    <th>Producto</th>
                    <th>Cant. Asignada</th> 
                    <th>Cant. Entregada</th>
                    <th>Estado asignación</th> 
                    <th>Descripción asignación</th> 
                    <th>Descripción entrega</th>
                    <th>Fecha asignado</th>          
                    <th>Fecha entrega</th> 
                  </tr>
                  </thead>
                  <tbody>
                    <?php 
                    $cont = 0;
                    while ($filas= mysqli_fetch_assoc($result)){
 
                     ?>
                     <?php  $cont++; ?>
                  <tr>
                      <td><form action="../../vistas/inventario/mostrar_detalle_asignaciones.php" method="post">
                            <input type="hidden" name="asignacion" value="<?php echo $filas['ID_ASIGNADO'] ?>">

                          <button type="submit" name="accion" value="detalle" class="btn btn-primary">Ver detalle</button>
                          </form>
                      </td>
                     <td><?php echo $filas['ID_ASIGNADO'] ?></td>
                     <td><?php echo $filas['NOMBRE_PROYECTO'] ?></td>  
                     <td><?php echo $filas['USUARIO'] ?></td>
                     <td><?php echo $filas['PRODUCTOSS'] ?></td>
                     <td><?php echo $filas['CANT_ASIGNADA'] ?></td>
                     <td><?php echo $filas['CANT_ENTREGADA']; ?></td>
                     <td><?php echo $filas['ESTADO_ASIGNACION'] ?></td>
                     <td><?php echo $filas['DESCRIPCION_ASIGNACION']; ?></td>
                     <td><?php echo $filas['DESCRIPCION_ENTREGA']; ?></td>
                     <td><?php echo $filas['FECHA_ASIGNADO']; ?></td>
                     <td><?php echo $filas['FECHA_ENTREGA']; ?></td>

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
	$sql = "SELECT * FROM (tbl_asignaciones a
  INNER JOIN tbl_proyectos p ON a.ID_PROYECTO = p.ID_PROYECTO)
  ORDER BY ID_ASIGNADO desc";
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
						
			var columns = ["Id asignación", "Proyecto"];
			var data = [
  <?php foreach($data as $d):?>
	
      ["<?php echo $d->ID_ASIGNADO; ?>", "<?php echo $d->NOMBRE_PROYECTO; ?>"],
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
				pdf.setFontSize(12);
				pdf.text("Reporte de asignaciones", 75,20,);

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

							pdf.save('Reporte de asignaciones.pdf');
	})

</script>
<!-- // Fin para exportar en pdf // -->

<script type="text/javascript" src="../../js/evitar_reenvio.js"></script>
</html>
