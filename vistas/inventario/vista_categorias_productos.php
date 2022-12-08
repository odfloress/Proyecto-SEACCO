<?php
session_start();
if(!isset($_SESSION['usuario'])){
 
        header('Location: ../../_login.php');
        session_unset();
        session_destroy();
        die();
        
}
include '../../controladores/crud_categoria_productos.php';
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
               $tablero = "SELECT * FROM tbl_ms_roles_ojetos WHERE ID_ROL='$id_rol7' and ID_OBJETO=11 and PERMISO_CONSULTAR=0";
               $tablero2 = mysqli_query($conn, $tablero);
               if (mysqli_num_rows($tablero2) > 0)
               {
                header('Location: ../../vistas/tablero/vista_perfil.php');
                die();
               }else{
                $role = "SELECT * FROM tbl_ms_roles_ojetos WHERE ID_ROL='$id_rol7' and ID_OBJETO=11 and PERMISO_CONSULTAR=1";
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
  <title>Categorias de productos</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

           <!-- /// Para exportar en pdf /// -->
  <script type="text/javascript" src="../../js/complemento_1_jspdf.min.js"></script>
	<script type="text/javascript" src="../../js/complemento_2_jspdf.plugin.autotable.min.js"></script>
  
  <script type="text/javascript" src="../../js/un_espacio.js"></script>
  <script type="text/javascript" src="../../js/converir_a_mayusculas.js"></script>

  <script>
  function clave1(e) {
  key = e.keyCode || e.which;
  tecla = String.fromCharCode(key).toString();
  letras = " ABCDEFGHIJKLMNÑOPQRSTUVWXYZabcdefghijklmnñopqrstuvwxyz0123456789";
  
  especiales = [8,13];
  tecla_especial = false;
  for(var i in especiales) {
    if(key == especiales[i]){
      tecla_especial = true;
      break;
    }
  }
  
  if(letras.indexOf(tecla) == -1 && !tecla_especial){
    alert("Solo letras y números");
    return false;
  }
}
</script>    

  <?php include '../../configuracion/navar.php' ?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-7">
          <h3>Categorias de productos</h3>
            <!-- Inicio de modal de agregar -->


<!-- El Modal -->
    <div class="modal" id="myModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Encabezado del modal -->
                <form action="" method="post">
                <div class="modal-header">
                    <h4 class="modal-title">Nueva categoria</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <!-- Fin Encabezado del modal -->

                <!-- Cuerpo del modal Modal -->
                <div class="modal-body">
               
                    <label for="">Categoria:</label>
                    <input    minlength="3" maxlength="50" type="text" class="form-control" onkeypress="return clave1(event);" onkeyup="mayus(this); un_espacio(this); " name="categoria" required value="" placeholder="" id="txtPrecio_Compra"   >
                    <br>
                    <label for="">Estado</label>
                    <select class="form-select"  name="estado" required>
                    <option value="">Selecciona un estado</option>
                    <option value="ACTIVO">ACTIVO</option>
                    <option value="INACTIVO">INACTIVO</option>
                    </select>
                
                </div>
                <!-- Fin Cuerpo del modal Modal -->
                <!-- pie del modal -->
                <div class="modal-footer">
      	            <button type="submit" name="accion" value="agregar" class="btn btn-primary" onclick="return confirm('¿Desea agregar la categoria?')">Agregar</button>
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
                <!-- <h3 class="card-title">Categorias</h3> -->
             
                
                <form id="form" action="" method="post">
                <?php 

include '../../conexion/conexion.php';
$tablero = "SELECT * FROM tbl_ms_roles_ojetos WHERE ID_ROL='$id_rol7' and ID_OBJETO=11 and PERMISO_INSERCION=1";
$tablero2 = mysqli_query($conn, $tablero);
if (mysqli_num_rows($tablero2) > 0)
 {
   echo '<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#myModal">
   Nueva categoria
   <form id="form" action="" method="post">';
 }
?>
         
             <button type="submit"  name="accion" value="reporte_pdf" class="btn btn-secondary buttons-pdf buttons-html5"  onclick="return confirm('¿Desea generar reporte de categorias de productos?')" onclick="textToPdf()"><span>Reporte PDF</span></button>
             </form>
         </button>
 
                </form>
              </div>
              
              <!-- /.card-header -->
              <div class="card-body ">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                  <th class="desaparecerTemporalmente">Acciones</th>
                  <th class="desaparecerTemporalmente1">ID</th>
                  <th class="desaparecerTemporalmente1">Categoría</th>
                  <th class="desaparecerTemporalmente1">Estado</th>
                  
                  </tr>
                  </thead>
                  <tbody>
                    <?php 
                    $cont = 0;
                    while ($filas= mysqli_fetch_assoc($result)){
 
                     ?>
                     <?php  $cont++; ?>

                  <tr>
                  <td class="desaparecerTemporalmente">
                        <!-- inicio boton editar -->

                        <?php 
                          include '../../conexion/conexion.php';
                          $tablero = "SELECT * FROM tbl_ms_roles_ojetos WHERE ID_ROL='$id_rol7' and ID_OBJETO=11 and PERMISO_ACTUALIZACION=1";
                          $tablero2 = mysqli_query($conn, $tablero);
                          if (mysqli_num_rows($tablero2) > 0)
                          {?>
                              <!-- inicio boton editar -->
                              <button type="button"  class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#myModal2<?php echo $filas['ID_CATEGORIA'] ?>" >
                      <i class="fas fa-pencil-alt"></i>
                      </button>  <?php
                          }
                        ?>



                        
                    

                          <!-- El Modal -->
                          <div class="modal" id="myModal2<?php echo $filas['ID_CATEGORIA'] ?>">
                            <div class="modal-dialog">
                              <div class="modal-content">

                                <!-- Encabezado del modal -->
                                <div class="modal-header">
                                  <h4 class="modal-title">Editar categoria</h4>
                                  <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <!-- Fin Encabezado del modal -->


                                <!-- Cuerpo del modal Modal -->
                                <form action="" method="post">
                                          <div class="modal-body">
                                          <input type="hidden" name="nombre_anterior" value="<?php echo $filas['NOMBRE_CATEGORIA'] ?>">
                                              <label for="">ID rol</label>
                                              <input type="text" readonly class="form-control" name="id_categoria" required value="<?php echo $filas['ID_CATEGORIA'] ?>" placeholder=""  >
                                              <br>
                                              <label for="">Categoría</label>
                                              <input type="text" class="form-control" name="categoria" required value="<?php echo $filas['NOMBRE_CATEGORIA'] ?>" placeholder=""  autocomplete = "off"  
                                              minlength="3" maxlength="50" onkeypress="return clave1(event);" onkeyup="mayus(this); un_espacio(this);"  >
                                                <br>
                                               <label for="">Estado</label>
                                               <select class="form-select"  name="estado" required >
                                                        <option> </option>
                                                        <?php
                                                        $estado = "SELECT * FROM tbl_categoria_producto WHERE ID_CATEGORIA=$filas[ID_CATEGORIA]";
                                                        $estado2 = mysqli_query($conn, $estado);
                                                        if (mysqli_num_rows($estado2) > 0) {
                                                            while($row = mysqli_fetch_assoc($estado2))
                                                            {
                                                            $estado = $row['ESTADO'];
                                                            ?>
                                                              <option value="<?php  echo $estado; ?>" selected><?php echo $estado; ?></option>
                                                            
                                                    <?php
                                                  ?>
                                                      <?php if ($estado=="ACTIVO"){
                                                        echo '<option value="INACTIVO">INACTIVO</option>';
                                                      }else{
                                                        echo '<option value="ACTIVO">ACTIVO</option>';
                                                      }
                                                      ?>
                                                      <?php
                                                            }}// finaliza el if y el while
                                                      ?> 
                                              </select> 
                                              
                                          
                                          </div>
                                <!-- Fin Cuerpo del modal Modal -->

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
                          $tablero = "SELECT * FROM tbl_ms_roles_ojetos WHERE ID_ROL='$id_rol7' and ID_OBJETO=11 and PERMISO_ELIMINACION=1";
                          $tablero2 = mysqli_query($conn, $tablero);
                          if (mysqli_num_rows($tablero2) > 0)
                          {?>
                          
                      <button  value="eliminar" name="accion" 
                        onclick="return confirm('¿Quieres eliminar este dato?')"
                        type="submit" class="btn btn-danger ">
                        <i class="fas fa-trash-alt"></i>
                    </button></form>

                    <?php 
                          }
                        ?>
                    
</td>
                     <td ><?php echo $filas['ID_CATEGORIA'] ?></td>
                     <td class="desaparecerTemporalmente1"><?php echo $filas['NOMBRE_CATEGORIA'] ?></td>
                     <td class="desaparecerTemporalmente1"><?php echo $filas['ESTADO'] ?></td>
                    
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
<!-- Plugins para reporte en excel -->
<script src="../../plantilla/AdminLTE-3.2.0/plugins/datatables-buttons/js/buttons.html5.min.js"></script> 
 <script src="../../plantilla/AdminLTE-3.2.0/plugins/datatables-buttons/js/buttons.print.min.js"></script>

<script src="../../plantilla/AdminLTE-3.2.0/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<!-- AdminLTE App -->
<script src="../../plantilla/AdminLTE-3.2.0/dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../../plantilla/AdminLTE-3.2.0/dist/js/demo.js"></script>
<!-- INICIO muestra los botones, traduce y Agrupar -->

<script>
  $(function () {
    $("#example1").DataTable({
      "order": [[ 1, "desc" ]],
      "lengthMenu": [[10, 25, 50,   100, -1], [10, 25, 50, 100, "Todos"]],
      language: {
                          processing: "Tratamiento en curso...",
                          search: "Buscar&nbsp;:",
                          lengthMenu: "Consultar de _MENU_ items",
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
                          "buttons": ["excel", "colvis"], 
                          buttons:[
                            {
                            extend:     'excelHtml5',
                            text:       'Exportar a Excel',
                            titleAttr:  'Exportar a Excel',
                            title:     'REPORTE DE CATEGORIA DE PRODUCTOS',
                            exportOptions:{
                              columns: [1,2,3]
                            }
                          },
                          {
                            extend: 'colvis',
                            text:   'Visualizar',
                            title:  'REPORTE DE CATEGORIA DE PRODUCTOS',
                          } 
                          ]                  
        
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
	$sql = "SELECT * FROM tbl_categoria_producto 
  ORDER BY ID_CATEGORIA desc";
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
  $(".desaparecerTemporalmente1").css("display","");
  $(".desaparecerTemporalmente").css("display","none");

				const pdf = new jsPDF('p', 'mm', 'letter');			
        	

				
				

				pdf.autoTable(
				{ 
          html:'#example1',
					
					margin:{ top: 30 },
          
          columnStyles: {
      
            0: {cellWidth: 15},
            1: {cellWidth: 90},
            2: {cellWidth: 84}
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
				pdf.text('<?php echo $nombre_constructora ?>', pdf.internal.pageSize.getWidth() / 2, 15, null, 'center'); // de esta manera se puede centrar el titulo
       
				//muestra el titulo secundario
				pdf.setFont('times');
				pdf.setFontSize(12);
				pdf.text("Reporte de categorías de productos", pdf.internal.pageSize.getWidth() / 2, 20, null, 'center');

												//////// pie de Pagina ///////
				//muestra la fecha
				pdf.setFont('times');
				pdf.setFontSize(9);
				var today = new Date();
				let horas = today.getHours()
				let jornada = horas >=12 ? 'PM' : 'AM';
				var newdat = "Fecha: " + today.getDate() + "/" + (today.getMonth()+1) + "/" + today.getFullYear() + " " + (horas % 12) + ":" + today.getMinutes() + ":" + today.getSeconds() + " " + jornada;
				pdf.text(183-20,297-284,newdat);
        pdf.text('<?php echo 'Creado por: '. $_SESSION['usuario']; ?>', 202, 20, {
            align: 'right',
            });
        

				//muestra el numero de pagina
				pdf.text('Pagina ' + String(i) + '/' + String(pageCount),220-20,297-27,null,null,"right");
			}
				//Fin Encabezado y pie de pagina

							pdf.save('Reporte de categorías de productos.pdf');
              $(".desaparecerTemporalmente").css("display","");
	})
  
</script>

<!-- // Fin para exportar en pdf // -->
<script type="text/javascript" src="../../js/evitar_reenvio.js"></script>

</html>
