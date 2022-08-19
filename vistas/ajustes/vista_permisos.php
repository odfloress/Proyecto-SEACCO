<?php
session_start();
if(!isset($_SESSION['usuario'])){
 
        header('Location: ../../_login.php');
        session_unset();
        session_destroy();
        die();
        
}
include '../../controladores/crud_permisos.php';
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
               $tablero = "SELECT * FROM tbl_ms_roles_ojetos WHERE ID_ROL='$id_rol7' and ID_OBJETO=20 and PERMISO_CONSULTAR=0";
               $tablero2 = mysqli_query($conn, $tablero);
               if (mysqli_num_rows($tablero2) > 0)
               {
                header('Location: ../../vistas/tablero/vista_perfil.php');
                die();
               }else{
                $role = "SELECT * FROM tbl_ms_roles_ojetos WHERE ID_ROL='$id_rol7' and ID_OBJETO=20 and PERMISO_CONSULTAR=1";
                $roless = mysqli_query($conn, $role);
                if (mysqli_num_rows($roless) > 0){}
                else{
                  header('Location: ../../vistas/tablero/vista_perfil.php');
                  die();
                }
               }
               // inicio inserta en la tabla bitacora
               $sql = "INSERT INTO tbl_bitacora (USUARIO, ACCION, OBSERVACION)
               VALUES ('$usuario1[usuario]', 'CONSULTO', 'CONSULTO LA PANTALLA ADMINISTRATIVA DE PERMISOS')";
               if (mysqli_query($conn, $sql)) {} else {}
               // fin inserta en la tabla bitacora


?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Permisos</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>

   <!-- /// para exportar en pdf /// -->
   <script type="text/javascript" src="../../js/complemento_1_jspdf.min.js"></script>
	<script type="text/javascript" src="../../js/complemento_2_jspdf.plugin.autotable.min.js"></script>

  



  <?php include '../../configuracion/navar.php' ?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-2">
          <h1>Permisos</h1>
            <!-- Inicio de modal de agregar -->
<div class="container mt-3">
         
        
    </div>

<!-- El Modal -->
    <div class="modal" id="myModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Encabezado del modal -->
                <form action="" method="post">
                <div class="modal-header">
                    <h4 class="modal-title">Crear Permisos</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <!-- Fin Encabezado del modal -->

                <!-- Cuerpo del modal Modal -->
                <div class="modal-body">
               
                    <label for="">Seleccione el rol</label>
                    <select class="form-select" id="lista1" name="lista1" required >
                        <?php
                            include '../../conexion/conexion.php';
                            $roles = "SELECT * FROM tbl_roles ORDER BY ID_ROL";
                            $roles2 = mysqli_query($conn, $roles);
                            if (mysqli_num_rows($roles2) > 0) {
                                while($row = mysqli_fetch_assoc($roles2))
                                {
                                $id_rol = $row['ID_ROL'];
                                $rol =$row['ROL'];
                         ?>
                          <option value="<?php  echo $id_rol ?>"><?php echo $rol ?></option>
                          <?php
                           }}// finaliza el if y el while
                           ?>
                   </select>

                    <div id="select2lista"></div>

                    
                   <input type="checkbox"  name="insertar" value="1">
                    <label for="insertar"> Insertar</label><br>
                    <input type="checkbox"  name="eliminar2" value="1">
                    <label for="eliminar"> Eliminar</label><br>
                    <input type="checkbox" name="editar2" value="1">
                    <label for="vehicle3"> Editar</label><br>
                    <input type="checkbox" name="consultar" value="1">
                    <label for="vehicle3"> Consultar</label><br>
                
                </div>
                <!-- Fin Cuerpo del modal Modal -->
                <!-- pie del modal -->
                <div class="modal-footer">
      	            <button type="submit" name="accion" value="agregar" class="btn btn-primary">Agregar</button>
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
              <form id="form" action="" method="post">
                    <div class="btn-group">
                    <?php 
      include '../../conexion/conexion.php';
      $area1 = "SELECT * FROM tbl_ms_roles_ojetos WHERE ID_ROL='$id_rol7' and ID_OBJETO=20 and PERMISO_INSERCION=1";
      $area2 = mysqli_query($conn, $area1);
      if (mysqli_num_rows($area2) > 0)
       {
         echo '<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#myModal">
                    Nuevo Permiso
                </button>';
                          }
                        ?> 
              <button type="submit"  name="accion" value="reporte_pdf" class="btn btn-secondary buttons-pdf buttons-html5"  onclick="return confirm('¿Quieres generar reporte de Permisos?')" onclick="textToPdf()"><span>Reporte PDF</span></button>
	               </div>
            </form>
                <!-- <h3 class="card-title">Permisos de los roles</h3> -->
                
              </div>
              
              <!-- /.card-header -->
              <div class="card-body ">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                  <th>Acciones</th>
                  <th>Pantalla</th>
                  <th>Rol</th>
                  <th>Insertar</th>
                  <th>Eliminar</th>
                  <th>Editar</th>
                  <th>Consultar</th>
                  
                  
                  </tr>
                  </thead>
                  <tbody>
                    <?php 
                    include '../../conexion/conexion.php';
                    $sql = "SELECT * FROM ((tbl_ms_roles_ojetos p 
                    INNER JOIN tbl_roles r ON p.ID_ROL = r.ID_ROL)
                    INNER JOIN tbl_ms_objetos o ON p.ID_OBJETO = o.ID_OBJETO)";
                    $result = mysqli_query($conn, $sql);
                    while ($filas= mysqli_fetch_assoc($result)){
 
                     ?>
                  <tr>
                  <td>
                        <!-- inicio boton editar -->
                          <!-- Valida si tiene permiso para EDITAR un PERMISO -->
                          <?php 
                          include '../../conexion/conexion.php';
                          $tablero = "SELECT * FROM tbl_ms_roles_ojetos WHERE ID_ROL='$id_rol7' and ID_OBJETO=20 and PERMISO_ACTUALIZACION=1";
                          $tablero2 = mysqli_query($conn, $tablero);
                          if (mysqli_num_rows($tablero2) > 0)
                          {?>
                            <button type="button"  class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#myModal2<?php echo $filas['ID_ROL'] ?>" >
                      <i class="fas fa-pencil-alt"></i>
                      </button> <?php 
                          }
                        ?>
                      

                          <!-- El Modal -->
                          <div class="modal" id="myModal2<?php echo $filas['ID_ROL'] ?>">
                            <div class="modal-dialog">
                              <div class="modal-content">

                                <!-- Encabezado del modal -->
                                <div class="modal-header">
                                
                                  <h4 class="modal-title">Editar rol</h4>
                                  <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <!-- Fin Encabezado del modal -->


                                <!-- Cuerpo del modal Modal -->
                                <form action="" method="post">
                                <div class="modal-body">
               
                    <label for="">Rol</label>
                    <input type="hidden" name="lista1" value="<?php echo $filas['ID_ROL']?>">
                    <input type="text" class="form-control" readonly name="MOSTRAR rol" value="<?php echo $filas['ROL']?>">

                    <label for="">Pantalla</label>
                    <input type="hidden" name="lista2" value="<?php echo $filas['ID_OBJETO']?>">
                    <input type="text" class="form-control" readonly name="Mostrar pantalla" value="<?php echo $filas['OBJETO']?>">



                   <input type="checkbox"  name="insertar" value="1" <?php if ($filas['PERMISO_INSERCION']==1){echo "checked";}?>>
                    <label for="insertar"> Insertar</label><br>
                    <input type="checkbox"  name="eliminar2" value="1" <?php if ($filas['PERMISO_ELIMINACION']==1){echo "checked";}?>>
                    <label for="eliminar"> Eliminar</label><br>
                    <input type="checkbox" name="editar2" value="1" <?php if ($filas['PERMISO_ACTUALIZACION']==1){echo "checked";}?>>
                    <label for="vehicle3"> Editar</label><br>
                    <input type="checkbox" name="consultar" value="1" <?php if ($filas['PERMISO_CONSULTAR']==1){echo "checked";}?>>
                    <label for="vehicle3"> Consultar</label><br>
                
                </div>
                                <!-- Fin Cuerpo del modal Modal -->

                                <!-- pie del modal -->
                                <div class="modal-footer">
                                  
                                <button type="submit" name="accion" value="editar" class="btn btn-primary" >Guardar</button>
                                  <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                                </div>
                             
                                  <!-- Fin pie del modal -->
                                 
                              </div>
                            </div>
                          </div>
                          <!-- fin boton editar -->
                         
                         
                          <?php 
                          include '../../conexion/conexion.php';
                          $tablero = "SELECT * FROM tbl_ms_roles_ojetos WHERE ID_ROL='$id_rol7' and ID_OBJETO=20 and PERMISO_ELIMINACION=1";
                          $tablero2 = mysqli_query($conn, $tablero);
                          if (mysqli_num_rows($tablero2) > 0)
                          {?>
                             <button  value="eliminar" name="accion" 
                        onclick="return confirm('¿Quieres eliminar este dato?')"
                        type="submit" class="btn btn-danger ">
                        <i class="fas fa-trash-alt"></i>
                    </button> <?php 
                          }
                        ?>
                     </form>
                    
</td>
                     <td ><?php echo $filas['OBJETO'] ?></td>
                     <td><?php echo $filas['ROL'] ?></td>
                     <td><?php if ($filas['PERMISO_INSERCION']<1){echo "NO";}else{ Echo "SI"; } ?></td>
                     <td><?php if ($filas['PERMISO_ELIMINACION']<1){echo "NO";}else{ Echo "SI"; } ?></td>
                     <td><?php if ($filas['PERMISO_ACTUALIZACION']<1){echo "NO";}else{ Echo "SI"; } ?></td>
                     <td><?php if ($filas['PERMISO_CONSULTAR']<1){echo "NO";}else{ Echo "SI"; } ?></td>
                    
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
<script>
	//para descar al tocar el boton	
	var form = document.getElementById("form")
	form.addEventListener("submit",function(event) {
   
	event.preventDefault()
 
				const pdf = new jsPDF('p', 'mm', 'letter');			
        	

				var columns = ["", "", "", "", "", "", "", "", ""];
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
				pdf.text("Constructora SEACCO", 75,15,);

				//muestra el titulo secundario
				pdf.setFont('times');
				pdf.setFontSize(12);
				pdf.text("Reporte de Permisos", 84,20,);

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

							pdf.save('Reporte de Permisos.pdf');
	})
  
</script>
<!-- // Fin para exportar en pdf // -->
<script type="text/javascript" src="../../js/evitar_reenvio.js"></script>
</html>

<script type="text/javascript">
	$(document).ready(function(){
		$('#lista1').val(1);
		recargarLista();

		$('#lista1').change(function(){
			recargarLista();
		});
	})
</script>
<script type="text/javascript">
	function recargarLista(){
		$.ajax({
			type:"POST",
			url:"select_pantallas.php",
			data:"lista1=" + $('#lista1').val(),
			success:function(r){
				$('#select2lista').html(r);
			}
		});
	}
</script>
