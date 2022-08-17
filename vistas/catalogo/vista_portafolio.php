<?php
session_start();
if(!isset($_SESSION['usuario'])){
 
        header('Location: ../../_login.php');
        session_unset();
        session_destroy();
        die();
        
}

include '../../controladores/crud_portafolio.php';
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
               $tablero = "SELECT * FROM tbl_ms_roles_ojetos WHERE ID_ROL='$id_rol7' and ID_OBJETO=7 and PERMISO_CONSULTAR=0";
               $tablero2 = mysqli_query($conn, $tablero);
               if (mysqli_num_rows($tablero2) > 0)
               {
                header('Location: ../../vistas/tablero/vista_perfil.php');
                die();
               }else{
                $role = "SELECT * FROM tbl_ms_roles_ojetos WHERE ID_ROL='$id_rol7' and ID_OBJETO=7 and PERMISO_CONSULTAR=1";
                $roless = mysqli_query($conn, $role);
                if (mysqli_num_rows($roless) > 0){}
                else{
                  header('Location: ../../vistas/tablero/vista_perfil.php');
                  die();
                }
         }
                // inicio inserta en la tabla bitacora
                $sql = "INSERT INTO tbl_bitacora (USUARIO, ACCION, OBSERVACION)
                VALUES ('$usuario1[usuario]', 'CONSULTO', 'CONSULTO LA PANTALLA  ADMINISTRATIVA DEL PORTAFOLIO')";
                if (mysqli_query($conn, $sql)) {} else {}
                // fin inserta en la tabla bitacora
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Portafolio</title>
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
          <h3>Portafolio</h3> 
            <!-- Inicio de modal de agregar -->
<div class="container mt-3">

        
    </div>
    
<!-- El Modal -->
    <div class="modal" id="myModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Encabezado del modal -->
                <div class="modal-header">
                    <h4 class="modal-title">Nuevo </h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <!-- Fin Encabezado del modal -->
                <form action="" method="post" enctype="multipart/form-data">
                <!-- Cuerpo del modal Modal -->
                <div class="modal-body">
                <label for="">Catálago</label>
                <select style="background-color:rgb(240, 244, 245);" value="<?php echo "$id_departamento"; ?>" class="form-select" id="lista1" name="tipo" required >
                    <option value="">Selecciona un catálago</option>
                        <?php
                            include 'conexion/conexion.php';
                            $departamento = "SELECT * FROM tbl_catalogo ORDER BY ID_CATALOGO";
                            $departamento2 = mysqli_query($conn, $departamento);
                            if (mysqli_num_rows($departamento2) > 0) {
                                while($row = mysqli_fetch_assoc($departamento2))
                                {
                                $id_departamento = $row['ID_CATALOGO'];
                                $departamento3 =$row['NOMBRE_CATALOGO'];
                         ?>
                          <option value="<?php  echo $id_departamento ?>"><?php echo $departamento3 ?></option>
                          <?php
                           }}// finaliza el if y el while
                           ?>
                   </select>
                    <br>
                    <label for="">Imagen</label>
                    <input type="file" class="form-control" accept=".jpg, .png, .jpej, .JPEG, .JPG, .PNG" name="imagenes" required value="<?php echo "$nombreimagen"; ?>" placeholder=""  >
                    <br>
                    <label for="">Título</label>
                    <input type="text" class="form-control"  name="titulo" required value="<?php echo "$titulo"; ?>" placeholder="" 
                    autocomplete = "off"  onkeypress="return soloLetras(event);" minlength="3" maxlength="50" onkeyup="mayus(this);"  >
                    <br>
                    <label for="">Descripción</label>
                    <TEXtarea  style="background-color: white;" name="descripcion" class="form-control"name="" id="" cols="40" rows="5"
                    autocomplete = "off"  onkeypress="return soloLetras(event);" minlength="3" maxlength="300" onkeyup="mayus(this);" ><?php echo "$descripcion"; ?></TEXtarea>
                
                    <br>
                    
                
                </div>
                <!-- Fin Cuerpo del modal Modal -->
                <!-- pie del modal -->
                <div class="modal-footer">
                
      	            <button type="submit" name="accion" value="agregar" class="btn btn-primary" >Agregar</button>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                </div>
                <!-- Fin pie del modal -->
            </div>
        </div>
    </div>
    </form>
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
            
            <div class="card">
              <div class="card-header">
                <!-- /// filtrar reporte //// -->
                <form action="" method="post">
                <div class="row">
                    <div class="col">
                      <!-- ///////////////////// -->
                      <?php $asignacion=(isset($_POST['reporte_catalogo']))?$_POST['reporte_catalogo']:"";   ?> 
                      <!-- <?php echo $asignacion; ?> -->
                      <br>
                        <select style="background-color:rgb(240, 244, 245);" value="<?php echo $id_cliente; ?>" required  class="form-select" id="lista1" name="reporte_catalogo"  >
                                          <option >Seleccione un tipo</option>
                                              <?php
                                                  include '../../conexion/conexion.php';
                                                  $catalago777 = "SELECT * FROM tbl_catalogo";
                                                  $catalago7777 = mysqli_query($conn, $catalago777);
                                                  if (mysqli_num_rows($catalago7777) > 0) {
                                                      while($row = mysqli_fetch_assoc($catalago7777))
                                                      {
                                                        $id_catalogoo = $row['ID_CATALOGO'];
                                                      $catalago77777 =$row['NOMBRE_CATALOGO'];
                                              ?>
                                                <option value="<?php  echo $id_catalogoo; ?>"><?php echo $catalago77777; ?></option>
                                                <?php
                                          }}// finaliza el if y el while
                                          ?>
                                        </select>
                                                          </div>
                    <div class="col"><br>
                    <button class="btn btn-danger" type="submit">Filtrar reporte</button>
                    </div>
               </div>
                                 
                                        
                        </form> <br><!-- ///////////////////// -->
                <!-- /// fin filtrar reporte /// -->
              <form id="form">
                    <div class="btn-group">
                    <?php 
                                include '../../conexion/conexion.php';
                                $tablero = "SELECT * FROM tbl_ms_roles_ojetos WHERE ID_ROL='$id_rol7' and ID_OBJETO=7 and PERMISO_INSERCION=1";
                                $tablero2 = mysqli_query($conn, $tablero);
                                if (mysqli_num_rows($tablero2) > 0)
                                {
                                  echo '<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#myModal">
                                          Nuevo
                                        </button>';
                                                    }
                        ?>
              <button type="submit"  name="accion" value="reporte_pdf" class="btn btn-secondary buttons-pdf buttons-html5"  onclick="return confirm('¿Quieres generar reporte de portafolio?')" onclick="textToPdf()"><span>Reporte PDF</span></button>
	               </div>
            </form>
                <!-- <h3 class="card-title">PORTAFOLIO</h3> -->
              </div>
              
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                  <th>Acciones</th>
                  <th>Id</th>
                  <th>Tipo</th>
                  <th>Imagen</th>
                  <th>Título</th>
                  <th>Descripción</th>
                  
                  </tr>
                  </thead>
                  <tbody>
                  <?php
                  include '../../conexion/conexion.php';
                  //para mostrar los datos de la tabla mysql y mostrar en el crud
                  $sql77 = "SELECT * FROM (tbl_portafolio p
                 INNER JOIN tbl_catalogo c ON p.ID_CATALOGO = c.ID_CATALOGO)";
                  $result = mysqli_query($conn, $sql77);
                  if (mysqli_num_rows($result) > 0) {
                  while ($filas= mysqli_fetch_assoc($result)){
                    ?>
                  <tr>
                  <td>
                  <?php 
                          include '../../conexion/conexion.php';
                          $tablero = "SELECT * FROM tbl_ms_roles_ojetos WHERE ID_ROL='$id_rol7' and ID_OBJETO=7 and PERMISO_ACTUALIZACION=1";
                          $tablero2 = mysqli_query($conn, $tablero);
                          if (mysqli_num_rows($tablero2) > 0)
                          {?>
                              <!-- inicio boton editar -->
                              <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#myModal2<?php echo $filas['ID_IMAGEN'] ?>">
                              <i class="fas fa-pencil-alt"></i>
                              </button>  <?php 
                          }
                        ?>
                      

                          <!-- El Modal -->
                          <div class="modal" id="myModal2<?php echo $filas['ID_IMAGEN'] ?>">
                            <div class="modal-dialog">
                              <div class="modal-content">

                                <!-- Encabezado del modal -->
                                <div class="modal-header">
                                  <h4 class="modal-title">Editar </h4>
                                  <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <!-- Fin Encabezado del modal -->


                                <!-- Cuerpo del modal Modal -->
                                          <div class="modal-body">
                                              <form action="" method="post" enctype="multipart/form-data">
                                                <input type="hidden" name="foto" value="<?php echo $filas['IMAGEN'] ?>">
                                                <input type="hidden" name="catalogo" value="<?php echo $filas['NOMBRE_CATALOGO'] ?>">
                                              <input type="hidden" name="id_imagen"  value="<?php echo $filas['ID_IMAGEN'] ?>">
                                              <label for="">Imagen</label><br>
                                              <img class="img-thumbnail" width="100px" src="<?php echo $filas['RUTA_PORTAFOLIO'] ?>" /><br><br>
                                              <input type="file" class="form-control" accept=".jpg, .png, .jpeg, .JPEG, .JPG, .PNG" name="imagenes"  value="" placeholder=""  >
                                              <br>
                                              <label for="">Catálago:</label><br>
                                              <select class="form-select"  name="tipo" required >
                                                    <option value="<?php echo $filas['ID_CATALOGO'] ?>"><?php echo $filas['NOMBRE_CATALOGO'] ?> </option>
                                                    <?php
                                                            include 'conexion/conexion.php';
                                                            $estado = "SELECT * FROM tbl_catalogo ORDER BY ID_CATALOGO";
                                                            $estado2 = mysqli_query($conn, $estado);
                                                            if (mysqli_num_rows($estado2) > 0) {
                                                                while($row = mysqli_fetch_assoc($estado2))
                                                                {
                                                                $id_estado = $row['ID_CATALOGO'];
                                                                $estado3 =$row['NOMBRE_CATALOGO'];
                                                                if($estado3 == $filas["NOMBRE_CATALOGO"]){?>
                                                                  <option value="<?php  echo $id_estado; ?>" selected><?php echo $estado3; ?></option>
                                                                
                                                        <?php
                                                        }else{ ?>
                                                          <option value="<?php  echo $id_estado; ?>"><?php echo $estado3; ?></option>
                                                          <?php
                                                                }}}// finaliza el if y el while
                                                          ?> 
                                                  </select> 
                                              <label for="">Título</label>
                                              <input type="text" class="form-control"  name="titulo" required value="<?php echo $filas['TITULO'] ?>" placeholder="" 
                                              autocomplete = "off"  onkeypress="return soloLetras(event);" minlength="3" maxlength="255" onkeyup="mayus(this);"  >
                                              <br>
                                              <label for="">Descripción</label>
                                              <TEXtarea  style="background-color: white;" name="descripcion" class="form-control"name="" id="" cols="40" rows="5"
                                              autocomplete = "off"  onkeypress="return soloLetras(event);" minlength="3" maxlength="300" onkeyup="mayus(this);" ><?php echo $filas['DESCRIPCION_PORTAFOLIO'] ?></TEXtarea>
                                          
                                              <br>
                                          
                                          </div>
                                <!-- Fin Cuerpo del modal Modal -->

                                <!-- pie del modal -->
                                <div class="modal-footer">
                                <button type="submit" class="btn btn-primary" name="accion" value="editar" onclick="return confirm('¿Quieres editar este dato?')">Guardar</button>
                                  <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                                </div>
                                  <!-- Fin pie del modal -->
                              </div>
                            </div>
                          </div>
                          <!-- fin boton editar -->
                          <input type="hidden" name="ruta"  value="<?php echo $filas['RUTA'] ?>">
                          <?php 
                          include '../../conexion/conexion.php';
                          $tablero = "SELECT * FROM tbl_ms_roles_ojetos WHERE ID_ROL='$id_rol7' and ID_OBJETO=7 and PERMISO_ELIMINACION=1";
                          $tablero2 = mysqli_query($conn, $tablero);
                          if (mysqli_num_rows($tablero2) > 0)
                          {?>
                             <button  value="eliminar" name="accion" 
                        onclick="return confirm('¿Quieres eliminar este dato?')"
                        type="submit" class="btn btn-danger " data-id="19">
                        <i class="fas fa-trash-alt"></i>
                    </button> <?php 
                          }
                        ?>
                     </form>
</td>
                      <td><?php echo $filas['ID_IMAGEN'] ?></td>
                     <td><?php echo $filas['NOMBRE_CATALOGO'] ?></td>
                     <td><img class="img-thumbnail" width="100px" src="<?php echo $filas['RUTA_PORTAFOLIO'] ?>" /></td>
                     <td><?php echo $filas['TITULO'] ?></td>
                     <td><TEXtarea readonly style="background-color: white;" class="form-control"name="" id="" cols="40" rows="5"><?php echo $filas['DESCRIPCION_PORTAFOLIO'] ?></TEXtarea></td>
                    
      </tr>
      <?php }} ?>  
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
<!-- <script src="../../plantilla/AdminLTE-3.2.0/plugins/datatables-buttons/js/buttons.html5.min.js"></script> 
 <script src="../../plantilla/AdminLTE-3.2.0/plugins/datatables-buttons/js/buttons.print.min.js"></script> -->



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

<!-- Enlace Script para quitar espacios en blanco -->
<script type="text/javascript" src="../../js/quitar_espacios.js"></script>
</body>

<!-- // Inicio para exportar en pdf // -->
<?php
if(!isset($_POST['reporte_catalogo']))
{
	require '../../conexion/conexion.php';
	$sql = "SELECT * FROM (tbl_portafolio p
  INNER JOIN tbl_catalogo c ON p.ID_CATALOGO = c.ID_CATALOGO) 
  ORDER BY p.ID_CATALOGO desc";
	$query = $conn->query($sql);
	$data = array();
	while($r=$query->fetch_object()){
	$data[] =$r;
	}
}else{		
			  
			require '../../conexion/conexion.php';
			$asignacion=(isset($_POST['reporte_catalogo']))?$_POST['reporte_catalogo']:"";
			$sql = "SELECT * FROM (tbl_portafolio p
      INNER JOIN tbl_catalogo c ON p.ID_CATALOGO = c.ID_CATALOGO) 
      WHERE p.ID_CATALOGO='$asignacion'";
			$query = $conn->query($sql);
			$data = array();
			while($r=$query->fetch_object()){
			$data[] =$r;
			}
				
			}
     

?>

<script>
	//para descar al tocar el boton
	var form = document.getElementById("form")
	form.addEventListener("submit",function(event) {
	event.preventDefault()

			
			const pdf = new jsPDF('p', 'mm', 'letter');
						
			var columns = ["Tipo", "Título", "Descripción"];
			var data = [
  <?php foreach($data as $d):?>
	
      ["<?php echo $d->NOMBRE_CATALOGO; ?>", "<?php echo $d->TITULO; ?>", "<?php echo $d->DESCRIPCION_PORTAFOLIO; ?>"],
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
				pdf.text("Constructora SEACCO", 70,15,);

				//muestra el titulo secundario
				pdf.setFont('times');
				pdf.setFontSize(10);
				pdf.text("Reporte de portafolio", 84,20,);

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

							pdf.save('Reporte de portafolio.pdf');
	})

</script>
<!-- // Fin para exportar en pdf // -->
<script type="text/javascript" src="../../js/evitar_reenvio.js"></script>
</html>


<script>
 // Inicio Script para que solo permita letras

 function soloLetras(e){
      key = e.keyCode || e.which;
      tecla = String.fromCharCode(key).toLowerCase();
      letras = " áéíóúabcdefghijklmnñopqrstuvwxyz¿?";
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

//   Fin Script para que solo permita letras
</script>

