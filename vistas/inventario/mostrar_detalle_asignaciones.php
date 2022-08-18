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

                // inicio inserta en la tabla bitacora
                $sql = "INSERT INTO tbl_bitacora (USUARIO, ACCION, OBSERVACION)
                VALUES ('$usuario1[usuario]', 'CONSULTO', 'CONSULTO LA PANTALLA  ADMINISTRATIVA DE ASIGNACIONES')";
                if (mysqli_query($conn, $sql)) {} else {}
                // fin inserta en la tabla bitacora

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
  <title>Asignaciones</title>
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
                  <th>Devolver asignación (Parcial/Total)</th>
                  <th>Id Detalle asignación</th>
                  <th>Producto</th>
                  <th>Cantidad</th>
                  <th>Descripcion de asignacion</th>
                  <th>Empleado</th>                 
                  <th>Proyecto</th>
                  <th>Fecha de asignación</th>
                  <th>Fecha de devolución de herramientas</th>

                           
                  </tr>
                  </thead>
                  <tbody>


                  <?php 
                          include '../../conexion/conexion.php';
                          $permiso_editar = "SELECT * FROM tbl_ms_roles_ojetos WHERE ID_ROL='$id_rol7' and ID_OBJETO=27 and PERMISO_ACTUALIZACION=1";
                          $permiso_editar2 = mysqli_query($conn, $permiso_editar);
                          if (mysqli_num_rows($permiso_editar2) > 0)
                          {?>
                                 <!-- inicio boton editar -->
                      <button type="button"  class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#myModal2<?php echo $filas['ID_DEPARTAMENTO'] ?>" >
                      <i class="fas fa-pencil-alt"></i>
                      </button> <?php 
                          }
                        ?>
                            <!-- El Modal -->
                            <div class="modal" id="myModal2<?php echo $filas['ID_DETALLE_ASIGNACION'] ?>">
                            <div class="modal-dialog">
                            <div class="modal-content">

                <!-- Encabezado del modal -->
                <form action="" method="post">
                <div class="modal-header">
                    <h4 class="modal-title">Editar asignación</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <!-- Fin Encabezado del modal -->

                <!-- Cuerpo del modal Modal -->
                <form action="" method="post">
                <div class="modal-body">
                <label for="" class="form-label">Producto:</label>
                <select placeholder="Seleccione" class="form-select" id="sel1" name="id_producto" required >
                <option>Seleccione</option>
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
                              <option value="<?php  echo $id_producto ?>"><?php echo $id_producto .' - '.($producto)?></option>
                          <?php
                    }}// finaliza el if y el while

                ?>
                </select>

                    <label for="">Cantidad</label>
                    <input type="text" class="form-control" name="cantidad" onkeypress="return solonumero(event)" required value="<?php echo "$cantidad"; ?>" onkeyup="mayus(this);" placeholder="Ingrese la cantidad" id="cantidad"   > 
                    <br>

                <label for="" class="form-label">Empleado:</label>
                <select placeholder="Seleccione" class="form-select" id="sel1" name="id_usuario" required >
                <option>Seleccione</option>
                  <?php
                      include '../../conexion/conexion.php';
                      $getusuario = "SELECT * FROM tbl_usuarios  WHERE ID_ROL = 1 OR ID_ROL = 2 AND ID_ESTADO_USUARIO= 1  ORDER BY ID_USUARIO";
                      $getusuario1 = mysqli_query($conn, $getusuario);
                      if (mysqli_num_rows($getusuario1) > 0) {
                          while($row = mysqli_fetch_assoc($getusuario1))
                            {
                              $DNI = $row['DNI'];
                              $usuario =$row['USUARIO'];
                           ?>
                              <option value="<?php  echo $usuario ?>"><?php echo $usuario .' - '.($DNI)?></option>
                          <?php
                    }}// finaliza el if y el while

                ?>
                </select>
                    <br> 
                          
                    <label for="sel1" class="form-label">Estado de la herramienta:</label>
                <select placeholder="Seleccione" class="form-select" id="sel1" name="id_estado_herramienta" required >
                  <option>Seleccione</option>
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
                              <option value="<?php  echo $id_estado_herramienta ?>"><?php echo $id_estado_herramienta .' - '.($estado_herramienta)?></option>
                          <?php
                    }}// finaliza el if y el while

                ?>
                </select>

                    <label for="">Descripción de la asignación</label>
                    <input type="text" class="form-control" name="descripcion_asignacion" required value="<?php echo "$descripcion_asignacion"; ?>" onKeyUP="this.value=this.value.toUpperCase();" placeholder="Ingrese un breve comentario sobre la asignación" id="descripción_asignacion"   >
                    <br>
                    <div class="row">
                <div class="col">
                  <label type="date" class="form-label">Fecha de devolución:</label>
                  <input class="form-control" type="Date" name="fecha_entrega" value="" autocomplete="off" id="" required>
                </div>
            </div>
                
                </div>
                                    <!-- pie del modal -->
                                    <div class="modal-footer">
                                <button type="submit" name="accion" value="editar" class="btn btn-primary" onclick="return confirm('¿Desea editar la categoria?')">Guardar</button>
                                  <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                                </div>
                             
                                  <!-- Fin pie del modal -->
                                 
                              </div>
                            </div>
                          </div>
                          <!-- fin boton editar -->                 

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
                     

                        </td>           
                    <td>
                         <button type="button"  class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#myModal2<?php echo $filas['ID_DETALLE_ASIGNACION'] ?>" >
                      <i class="fas fa-pencil-alt"></i>
                      </button></td>          
                     <td><?php echo $filas['ID_DETALLE_ASIGNACION'] ?></td>
                     <td><?php echo $filas['NOMBRE'] ?></td>
                     <td><?php echo $filas['CANTIDAD'] ?></td>
                     <td><?php echo $filas['DESCRIPCION_ASIGNACION1'] ?></td>
                     <td><?php echo $filas['USUARIO1'] ?></td>
                     <td><?php echo $filas['NOMBRE_PROYECTO'] ?></td>
                     <td><?php echo $filas['FECHA_ASIGNADO'] ?></td>
                     <td><?php echo $filas['FECHA_ENTREGA'] ?></td>

                     
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
<script>
	//para descar al tocar el boton	
	var form = document.getElementById("form")
	form.addEventListener("submit",function(event) {
   
	event.preventDefault()
 
				const pdf = new jsPDF('p', 'mm', 'letter');			
        	

				var columns = ["", "", "", "", "", "",""];
				var data = [
				[1, "Hola", "hola@gmail.com", "Mexico"],
				 ];

				pdf.autoTable(columns,data,
				{ 
					html:'#example1',
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
				pdf.text("Detalle de la asignación número <?php echo $asignacion ?>", 57,20,);

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
				pdf.text('Pagina ' + String(i) + '/' + String(pageCount),220-20,297-25,null,null,"right");
			}
				//Fin Encabezado y pie de pagina

							pdf.save('Reporte de detalle de asignaciones.pdf');
	})
  
</script>
<!-- // Fin para exportar en pdf // -->
<script type="text/javascript" src="../../js/evitar_reenvio.js"></script>
</html>
