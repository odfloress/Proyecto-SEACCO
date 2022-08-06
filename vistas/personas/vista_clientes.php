<?php
session_start();
if(!isset($_SESSION['usuario'])){
         header('Location: ../iniciar_sesion/index_login.php');
        session_unset();
        session_destroy();
        die();
      
}
include '../../controladores/crud_clientes.php';
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
               $clientes = "SELECT * FROM tbl_ms_roles_ojetos WHERE ID_ROL='$id_rol7' and ID_OBJETO=4 and PERMISO_CONSULTAR=0";
               $clientes2 = mysqli_query($conn, $clientes);
               if (mysqli_num_rows($clientes2) > 0)
               {
                header('Location: ../../vistas/tablero/vista_perfil.php');
                die();
               }else{
                $role = "SELECT * FROM tbl_ms_roles_ojetos WHERE ID_ROL='$id_rol7' and ID_OBJETO=4 and PERMISO_CONSULTAR=1";
                $roless = mysqli_query($conn, $role);
                if (mysqli_num_rows($roless) > 0){}
                else{
                  header('Location: ../../vistas/tablero/vista_perfil.php');
                  die();
                }
               }
               // inicio inserta en la tabla bitacora
               $sql = "INSERT INTO tbl_bitacora (USUARIO, ACCION, OBSERVACION)
               VALUES ('$usuario[usuario]', 'CONSULTO', 'CONSULTO LA PANTALLA ADMINISTRATIVA DE CLIENTES')";
               if (mysqli_query($conn, $sql)) {} else {}
               // fin inserta en la tabla bitacora
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Clientes</title>
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
                <h3>Clientes</h3> <br> 
                <?php 
              include '../../conexion/conexion.php';
              $clientes = "SELECT * FROM tbl_ms_roles_ojetos WHERE ID_ROL='$id_rol7' and ID_OBJETO=4 and PERMISO_INSERCION=1";
              $clientes2 = mysqli_query($conn, $clientes);
              if (mysqli_num_rows($clientes2) > 0)
              {
              echo ' <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#myModal">
              Nuevo Cliente
                </button>';
                        }
                      ?> 
            </div>

      <!-- El Modal -->
      <div class="modal" id="myModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Encabezado del modal -->
                <div class="modal-header">
                    <h4 class="modal-title">Nuevo Cliente</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <!-- Fin Encabezado del modal -->

                <!-- Cuerpo del modal Modal -->
                <form action="" method="post">
                    <div class="modal-body">

                        <label for="">Codigo</label>
                        <input type="text" class="form-control" name="codigo" required value="" placeholder=""   onkeyup="mayus(this);" >
                        <br>
                        <label for="">Nombre Cliente</label>
                        <input type="text" class="form-control" name="nombre" required value="" placeholder="" id="txtnombre_cliente" onkeypress="return soloLetras(event);" onkeyup="mayus(this);" >
                        <br>
                        <label for="">Apellido</label>
                        <input type="text" class="form-control" name="apellido" required value="" placeholder="" id="txtapellido" onkeypress="return soloLetras(event);" onkeyup="mayus(this);" >
                        <br>
                        <label for="">Correo</label>
                        <input type="text" class="form-control" name="correo" required value="" placeholder="" id="txtcorreo"   > autocomplete = "off" >
                        <br>
                        <label for="">Telefono</label>
                        <input type="number" class="form-control" name="telefono" required value="" placeholder="" id="txttelefono"   > autocomplete = "off"  >
                        <br>
                        <label for="">Direccion</label>
                        <input type="text" class="form-control" name="direccion" required value="" placeholder="" id="txtcorreo"   >
                        <br>
                        <label for="">Referencia</label>
                        <input type="text" class="form-control" name="nombre_referencia" required value="" placeholder="" id="txtnombrer" autocomplete = "off" onkeypress="return soloLetras(event);" minlength="3" maxlength="20" onkeyup="mayus(this);" >
                        <br>
                        <label for="pwd" class="form-label">Genero:</label>
                          <select style="background-color:rgb(240, 244, 245);" value="<?php echo "$genero"; ?>" class="form-select" id="lista1" name="genero" required >
                                  <?php
                                      include '../../conexion/conexion.php';
                                      $genero = "SELECT * FROM tbl_generos ORDER BY ID_GENERO";
                                      $genero2 = mysqli_query($conn, $genero);
                                      if (mysqli_num_rows($genero2) > 0) {
                                          while($row = mysqli_fetch_assoc($genero2))
                                          {
                                          $id_genero = $row['ID_GENERO'];
                                          $genero3 =$row['GENERO'];
                                  ?>
                                    <option value="<?php  echo $id_genero ?>"><?php echo $genero3 ?></option>
                                    <?php
                                    }}// finaliza el if y el while
                                    ?>
                          </select>
                        <label for="pwd" class="form-label">Foto:</label>
                        <input style="background-color:rgb(240, 244, 245);" type="file" accept=".jpg, .png, .jpej, .JPEG, .JPG, .PNG" autocomplete="off"  value="<?php echo "$foto"; ?>" class="form-control" required placeholder="Adjunte su foto" name="foto">
                    </div>
                           
                
                <div class="row">
                  <div class="col">
                      <!-- Fin Cuerpo del modal Modal -->
                      <!-- pie del modal -->
                      <div class="modal-footer">
                          <button type="submit" name="accion" value="agregar" class="btn btn-primary" onclick="return confirm('¿Desea agregar el Cliente?')">Agregar</button>
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
              <button type="submit"  name="accion" value="reporte_pdf" class="btn btn-secondary buttons-pdf buttons-html5"  onclick="return confirm('¿Quieres generar reporte de proveedores?')" onclick="textToPdf()"><span>Reporte PDF</span></button>
	            </form>
                <!-- <h3 class="card-title">CLIENTES</h3> -->
            
                
              </div>
              
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                  <th>Acciones</th>
                  <!-- <th>Id</th> -->
                  <th>Id Cliente</th>
                  <th>Codigo</th>
                  <th>Nombre Cliente</th>
                  <th>Apellido</th>
                  <th>Correo</th>
                  <th>Telefono</th>
                  <th>Direccion</th>
                  <th>Referencia</th>
                  <th>Genero</th>
                  <th>Foto</th>
                  include '../../conexion/conexion.php';
                  //para mostrar los datos de la tabla mysql y mostrar en el crud
                  $sql7 = "SELECT * FROM tbl_clientes WHERE TIPO NOT IN (SELECT TIPO FROM  tbl_clientes WHERE TIPO = 'ID_CLIENTE' )";
                  $result = mysqli_query($conn, $sql7);
                  if (mysqli_num_rows($result) > 0) {
                  while ($filas= mysqli_fetch_assoc($result)){
                    ?>
            
                  </tr>
                  </thead>
                  <tbody>
                  <?php 

                  ?>
                  <tr>
                  <td>
                  <?php 
                          include '../../conexion/conexion.php';
                          $clientes = "SELECT * FROM tbl_ms_roles_ojetos WHERE ID_ROL='$id_rol7' and ID_OBJETO=4 and PERMISO_ACTUALIZACION=1";
                          $clientes2 = mysqli_query($conn, $clientes);
                          if (mysqli_num_rows($clientes2) > 0)
                          {?>
                        <!-- inicio boton editar -->
                      <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#myModal2<?php echo $filas['ID_CLIENTE'] ?>">
                      <i class="fas fa-pencil-alt"></i>
                      </button>
                      <?php 
                          }
                        ?>
                          <!-- El Modal -->
                          <div class="modal" id="myModal2<?php echo $filas['ID_CLIENTE'] ?>">
                            <div class="modal-dialog">
                              <div class="modal-content">

                                <!-- Encabezado del modal -->
                                <div class="modal-header">
                                  <h4 class="modal-title">Editar cliente</h4>
                                  <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <!-- Fin Encabezado del modal -->


                                <!-- Cuerpo del modal Modal -->
                                <form action="" method="post">
                                          <div class="modal-body">
                                              <input type="hidden" name="nombre_anterior" value="<?php echo $filas['NOMBRE'] ?>">
                                              <label for="">Id Cliente</label>
                                              <input type="text" class="form-control" readonly name="id_cliente" required value="<?php echo $filas['ID_CLIENTE'] ?>" placeholder="" id="txtid_cliente"   >
                                              <br>
                                              <label for="">Codigo</label>
                                              <input type="text" class="form-control" readonly name="id_codigo" required value="<?php echo $filas['ID_CODIGO'] ?>" placeholder="" id="txtid_codigo"   >
                                              <br>
                                              <label for="">Nombre Cliente</label>
                                              <input type="text" class="form-control" readonly name="nombre" required value="<?php echo $filas['NOMBRE_CLIENTE'] ?>" placeholder="" id="txtnombre_cliente"   >
                                              <br>
                                              <label for="">Apellido</label>
                                              <input type="text" class="form-control" readonly name="apellido" required value="<?php echo $filas['APELLIDO'] ?>" placeholder="" id="txtapellido"   >
                                              <br>
                                              <label for="">Correo</label>
                                             <input type="email" class="form-control" name="correo" autocomplete = "off" required value="<?php echo $filas['CORREO'] ?>" placeholder="" id="txtcorreo"  >
                                             <br>  
                                              label for="">Telefono</label>
                                             <input type="number" class="form-control" name="telefono" autocomplete = "off" required value="<?php echo $filas['TELEFONO'] ?>" placeholder="" id="txttelefono"   >
                                             <br>
                                              <label for="">Direccion</label>
                                             <input type="text" class="form-control" name="direccion" autocomplete = "off" required value="<?php echo $filas['DIRECCION'] ?>" placeholder="" id="txtdireccion"  onkeyup="mayus(this);" >
                                             <br>
                                              <<label for="">Referencia</label>
                                             <input type="text" class="form-control" name="nombre_referencia" autocomplete = "off" required value="<?php echo $filas['REFERENCIA'] ?>" placeholder="" id="txtnombre_referencia" onkeypress="return soloLetras(event);" onkeyup="mayus(this);" >
                                             <br>
                                              <label for="">Genero</label>
                                              <input type="text" class="form-control" name="Genero" required value="" placeholder="" id="txtGenero" onkeypress="return soloLetras(event);" onkeyup="mayus(this);" >
                                              <br>
                                           </div>
                                <!-- Fin Cuerpo del modal Modal -->

                                <!-- pie del modal -->
                                <div class="modal-footer">
                                <button type="submit" name="accion" value="editar" class="btn btn-primary" onclick="return confirm('¿Desea editar el cliente?')">Guardar</button>
                                  <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                                </div>
                              </form>
                                  <!-- Fin pie del modal -->
                                  <form action="" method="post">
                              </div>
                            </div>
                          </div>
                          <?php 
                          include '../../conexion/conexion.php';
                          $clientes = "SELECT * FROM tbl_ms_roles_ojetos WHERE ID_ROL='$id_rol7' and ID_OBJETO=4 and PERMISO_ELIMINACION=1";
                          $clientes2 = mysqli_query($conn, $clientes);
                          if (mysqli_num_rows($clientes2) > 0)
                          {?>
                         
                          <input type="hidden" name="id_cliente"  value="<?php echo $filas['ID_CLIENTE'] ?>">
                          input type="hidden" name="nombre_anterior" value="<?php echo $filas['NOMBRE'] ?>">
                          <button  value="eliminar" name="accion" 
                          onclick="return confirm('¿Quieres eliminar este Registro?')"
                          type="submit" class="btn btn-danger " data-id="19">
                          <i class="fas fa-trash-alt"></i>
                    </button></form>  <?php } ?>
</td>
                         
                      </td>
                                         <td ><?php echo $filas['ID_CLIENTE'] ?></td>
                                         <td><?php echo $filas['CODIGO'] ?></td>
                                         <td><?php echo $filas['NOMBRE_CLIENTE'] ?></td>
                                         <td><?php echo $filas['APELLIDO'] ?></td>
                                         <td><?php echo $filas['CORREO'] ?></td>
                                         <td><?php echo $filas['TELEFONO'] ?></td>
                                         <td><?php echo $filas['DIRECCION'] ?></td>
                                         <td><?php echo $filas['REFERENCIA'] ?></td>
                                         <td><?php echo $filas['GENERO'] ?></td>
                                         <td><?php echo $filas['FOTO'] ?></td>
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
    buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
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
<script>
	//para descar al tocar el boton	
	var form = document.getElementById("form")
	form.addEventListener("submit",function(event) {
   
	event.preventDefault()
 
				const pdf = new jsPDF('p', 'mm', 'letter');			
        	

				var columns = ["", "", "", "", ""];
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
				pdf.text("Reporte de Clientes", 84,20,);

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

							pdf.save('Reporte de Clientes.pdf');
	})
  
</script>
<!-- // Fin para exportar en pdf // -->
<script type="text/javascript" src="../../js/evitar_reenvio.js"></script>
</html>





