<?php
session_start();
if(!isset($_SESSION['usuario'])){
 
        header('Location: ../../_login.php');
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
               $tablero = "SELECT * FROM tbl_ms_roles_ojetos WHERE ID_ROL='$id_rol7' and ID_OBJETO=4 and PERMISO_CONSULTAR=0";
               $tablero2 = mysqli_query($conn, $tablero);
               if (mysqli_num_rows($tablero2) > 0)
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
                VALUES ('$usuario[usuario]', 'CONSULTO', 'CONSULTO LA PANTALLA  ADMINISTRATIVA DE CLIENTES')";
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

  <script>
  function clave1(e) {
  key = e.keyCode || e.which;
  tecla = String.fromCharCode(key).toString();
  letras = "ABCDEFGHIJKLMNÑOPQRSTUVWXZabcdefghijklmnñopqrstuvwxyz0123456789,#$%&/=!¡?¿()*{}[]-_'.@<>";
  
  especiales = [8,13];
  tecla_especial = false;
  for(var i in especiales) {
    if(key == especiales[i]){
      tecla_especial = true;
      break;
    }
  }
  
  if(letras.indexOf(tecla) == -1 && !tecla_especial){
    alert("Sin espacios");
    return false;
  }
}
</script>
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
          <h3>Clientes</h3>
            <!-- Inicio de modal de agregar -->
<div class="container mt-3">
        
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
                <form action="" method="post" enctype="multipart/form-data">
                <!-- Cuerpo del modal Modal -->
                <div class="modal-body">
                <label for="">Codigo:</label>
                <input type="text" class="form-control" autocomplete="off" onkeyup="mayus(this);" minlength="6" maxlength="8" name="codigo" required value="<?php echo "$codigo"; ?>" placeholder="">
                <br>
                <label for="">Nombre:</label>
                <input type="text" autocomplete="off"  value="<?php echo "$nombre"; ?>" onkeyup="mayus(this);" maxlength="255" class="form-control"  placeholder="" name="nombre" required>
                <br>
                <label for="">Apellido:</label>
                <input type="text" autocomplete="off"  value="<?php echo "$apellido"; ?>" onkeyup="mayus(this);" maxlength="255" class="form-control"  placeholder="" name="apellido" required>
                <br>
                <label for="" class="form-label">Correo:</label>
                  <input  type="email" autocomplete="off" value="<?php echo "$correo"; ?>" class="form-control"  placeholder="" name="correo" required>   
                <br>
                <label for="" class="form-label">Teléfeno:</label>
                  <input type="text" autocomplete="off"  value="<?php echo "$telefono"; ?>" class="form-control"  placeholder="" name="telefono" required minlength="8" onkeypress="return solonumero(event)" maxlength="8" pattern="[0-9]+[1-9]+[0-9]+" title="8 caracteres y no todos ceros">
                <br>
                <label for="" class="form-label">Dirección:</label>
                  <input type="text" autocomplete="off"  value="<?php echo "$direccionp"; ?>" onkeyup="mayus(this);"   class="form-control"  placeholder="" name="direccion" required>
                  <br>
                  <label for="pwd" class="form-label">Referencia:</label>
                  <input type="text" autocomplete="off"  value="<?php echo "$referencia"; ?>"  onkeyup="mayus(this);"  class="form-control"  placeholder="" name="referencia" required>
                  <br>
                  <label for="pwd" class="form-label">Genero:</label>
                  <select  value="<?php echo "$genero3"; ?>" class="form-select" id="lista1" name="genero" required >
                  <option value="">Seleccione un Genero</option>
                        <?php
                            include 'conexion/conexion.php';
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
                  <br>
                  <label for="">Imagen:</label>
                    <input type="file" class="form-control" accept=".jpg, .png, .jpeg, .JPEG, .JPG, .PNG" name="imagenes"  value="<?php echo "$nombreimagen"; ?>" placeholder=""  >
                    <br>                  
                
                </div>
                <!-- Fin Cuerpo del modal Modal -->
                <!-- pie del modal -->
                <div class="modal-footer">
                
      	            <button type="submit" name="accion" value="agregar" class="btn btn-primary">Agregar</button>
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
                     <?php echo $asignacion; ?> 
                      <br>
                        <select style="background-color:rgb(240, 244, 245);" value="<?php echo $id_cliente; ?>" required  class="form-select" id="lista1" name="reporte_catalogo"  >
                                          <option >Seleccione un Filtro</option>
                                              <?php
                                                  include '../../conexion/conexion.php';
                                                  $catalago777 = "SELECT distinct NOMBRE_CLIENTE from tbl_clientes order by NOMBRE_CLIENTE";
                                                  $catalago7777 = mysqli_query($conn, $catalago777);
                                                  if (mysqli_num_rows($catalago7777) > 0) {
                                                      while($row = mysqli_fetch_assoc($catalago7777))
                                                      {
                                                      $catalago77777 =$row['NOMBRE_CLIENTE'];
                                              ?>
                                                <option value="<?php  echo $catalago77777; ?>"><?php echo $catalago77777; ?></option>
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
              <form id="form" action="" method="post">
                    <div class="btn-group">
                    <?php 
      include '../../conexion/conexion.php';
      $area1 = "SELECT * FROM tbl_ms_roles_ojetos WHERE ID_ROL='$id_rol7' and ID_OBJETO=4 and PERMISO_INSERCION=1";
      $area2 = mysqli_query($conn, $area1);
      if (mysqli_num_rows($area2) > 0)
       {
         echo '<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#myModal">
                    Nuevo Cliente
                </button>';
                          }
                        ?> 
              <button type="submit"  name="accion" value="reporte_pdf" class="btn btn-secondary buttons-pdf buttons-html5"  onclick="return confirm('¿Quieres generar reporte de Clientes?')" onclick="textToPdf()"><span>Reporte PDF</span></button>
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
                  <th>Código</th>
                  <th>Nombre</th>
                  <th>Apellido</th>
                  <th>Correo</th>
                  <th>Teléfono</th>
                  <th>Dirección</th>
                  <th>Referencia</th>
                  <th>Genero</th>
                  <th>Foto</th>
                  
                  </tr>
                  </thead>
                  <tbody>
                  <?php
                  include '../../conexion/conexion.php';
                  //para mostrar los datos de la tabla mysql y mostrar en el crud
                 



                  $sql7 = "SELECT * FROM (tbl_clientes c
                  INNER JOIN tbl_generos g ON c.ID_GENERO = g.ID_GENERO)";
                  $result = mysqli_query($conn, $sql7);
                  if (mysqli_num_rows($result) > 0) {
                    $cont = 0;
                  while ($filas= mysqli_fetch_assoc($result)){
                    ?>
                     <?php  $cont++; ?>
                  <tr>
                  <td>
                  <?php 
                          include '../../conexion/conexion.php';
                          $tablero = "SELECT * FROM tbl_ms_roles_ojetos WHERE ID_ROL='$id_rol7' and ID_OBJETO=4 and PERMISO_ACTUALIZACION=1";
                          $tablero2 = mysqli_query($conn, $tablero);
                          if (mysqli_num_rows($tablero2) > 0)
                          {?>
                              <!-- inicio boton editar -->
                              <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#myModal2<?php echo $filas['ID_CLIENTE'] ?>">
                              <i class="fas fa-pencil-alt"></i>
                              </button>  <?php 
                          }
                        ?>
                      

                          <!-- El Modal -->
                          <div class="modal" id="myModal2<?php echo $filas['ID_CLIENTE'] ?>">
                            <div class="modal-dialog">
                              <div class="modal-content">

                                <!-- Encabezado del modal -->
                                <div class="modal-header">
                                  <h4 class="modal-title">Editar Cliente</h4>
                                  <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <!-- Fin Encabezado del modal -->


                                <!-- Cuerpo del modal Modal -->
                                <form action="" method="post" enctype="multipart/form-data">
                                <div class="modal-body">
                                <input type="hidden" name="id_cliente" value="<?php echo $filas['ID_CLIENTE'] ?>">
                <label for="">Codigo</label>
                <input type="text" class="form-control" autocomplete="off" name="codigo" required value="<?php echo $filas['CODIGO'] ?>" placeholder="" onkeyup="mayus(this);">
                <br>
                <label for="">Nombre</label>
                <input type="text" autocomplete="off"  value="<?php echo $filas['NOMBRE_CLIENTE'] ?>" onkeyup="mayus(this);" maxlength="255" class="form-control"  placeholder="" name="nombre" required>
                <br>
                <label for="">Apellido</label>
                <input type="text" autocomplete="off"  value="<?php echo $filas['APELLIDO'] ?>" onkeyup="mayus(this);" maxlength="255" class="form-control"  placeholder="" name="apellido" required>
                <br>
                <label for="" class="form-label">Correo:</label>
                  <input  type="email" autocomplete="off" value="<?php echo $filas['CORREO'] ?>" onkeypress="return clave1(event);" class="form-control"  placeholder="" name="correo" required>   
                <br>
                <label for="" class="form-label">Teléfeno:</label>
                  <input type="text" autocomplete="off"  value="<?php echo $filas['TELEFONO'] ?>" class="form-control"  placeholder="" name="telefono" required minlength="8" onkeypress="return solonumero(event)" maxlength="8" pattern="[0-9]+[1-9]+[0-9]+" title="8 caracteres y no todos ceros">
                <br>
                <label for="" class="form-label">Dirección:</label>
                  <input type="text" autocomplete="off"  value="<?php echo $filas['DIRECCION'] ?>" onkeyup="mayus(this);"   class="form-control"  placeholder="" name="direccion" required>
                  <br>
                  <label for="pwd" class="form-label">Referencia:</label>
                  <input type="text" autocomplete="off"  value="<?php echo $filas['REFERENCIA'] ?>"  onkeyup="mayus(this);"  class="form-control"  placeholder="" name="referencia" required>
                  <br>
                  <label for="pwd" class="form-label">Genero:</label>
                  <select style="background-color:rgb(240, 244, 245);" class="form-select" id="lista1" name="id_genero" required >
                    
                    <?php
                        include 'conexion/conexion.php';
                        $departamento = "SELECT * FROM tbl_generos ORDER BY ID_GENERO";
                        $departamento2 = mysqli_query($conn, $departamento);
                        if (mysqli_num_rows($departamento2) > 0) {
                            while($row = mysqli_fetch_assoc($departamento2))
                            {
                            $id_departamentos = $row['ID_GENERO'];
                            $departamento3 =$row['GENERO'];

                            if($departamento3 == $filas["GENERO"]){?>
                              <option value="<?php  echo $id_departamentos; ?>" selected><?php echo $departamento3; ?></option>
                            
                     <?php
                     }else{ ?>
                      <option value="<?php  echo $id_departamentos; ?>"><?php echo $departamento3; ?></option>
                      <?php
                            }}}// finaliza el if y el while
                       ?>
               </select>
                  <br>
                  <label for="">Imagen</label><br>
                  <input type="hidden" name="foto" value="<?php echo $filas['FOTO'] ?>">
                  <img class="img-thumbnail" width="100px" src="<?php echo $filas['FOTO'] ?>" /><br>
                    <input type="file" class="form-control" accept=".jpg, .png, .jpeg, .JPEG, .JPG, .PNG" name="imagenes" value="<?php echo "$nombreimagen"; ?>" placeholder=""  >
                    <br>                  
                
                </div>
                                         
                                <!-- Fin Cuerpo del modal Modal -->

                                <!-- pie del modal -->
                                <div class="modal-footer">
                                <button type="submit" class="btn btn-primary" name="accion" value="editar" >Guardar</button>
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
                          $tablero = "SELECT * FROM tbl_ms_roles_ojetos WHERE ID_ROL='$id_rol7' and ID_OBJETO=4 and PERMISO_ELIMINACION=1";
                          $tablero2 = mysqli_query($conn, $tablero);
                          if (mysqli_num_rows($tablero2) > 0)
                          {?>
                          <input type="hidden" name="id_cliente" value="<?php echo $filas['ID_CLIENTE'] ?>">
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
                      <td><?php echo $cont; ?></td>
                     <td><?php echo $filas['CODIGO'] ?></td>
                     <td><?php echo $filas['NOMBRE_CLIENTE'] ?></td>
                     <td><?php echo $filas['APELLIDO'] ?></td>
                     <td><?php echo $filas['CORREO'] ?></td>
                     <td><?php echo $filas['TELEFONO'] ?></td>
                     <td><?php echo $filas['DIRECCION'] ?></td>
                     <td><?php echo $filas['REFERENCIA'] ?></td>
                     <td><?php echo $filas['GENERO'] ?></td>
                     <td><img  width="100px" src="<?php echo $filas['FOTO'] ?>" /></td>              
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
	$sql = "SELECT * FROM (tbl_clientes c
  INNER JOIN tbl_generos g ON c.ID_GENERO = g.ID_GENERO) 
  ORDER BY c.NOMBRE_CLIENTE desc";
	$query = $conn->query($sql);
	$data = array();
	while($r=$query->fetch_object()){
	$data[] =$r;
	}
}else{		
			  
			require '../../conexion/conexion.php';
			$asignacion=(isset($_POST['reporte_catalogo']))?$_POST['reporte_catalogo']:"";
			$sql = "SELECT * FROM (tbl_clientes c
      INNER JOIN tbl_generos g ON c.ID_GENERO = g.ID_GENERO) 
      WHERE c.NOMBRE_CLIENTE='$asignacion'";
			$query = $conn->query($sql);
			$data = array();
			while($r=$query->fetch_object()){
			$data[] =$r;
			}
				
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
						
			var columns = ["Código", "Nombre", "Apellido", "Correo", "Teléfono", "Dirección", "Referencia", "Genero"];
			var data = [
  <?php foreach($data as $d):?>
	
      ["<?php echo $d->CODIGO; ?>", "<?php echo $d->NOMBRE_CLIENTE; ?>", "<?php echo $d->APELLIDO; ?>", "<?php echo $d->CORREO; ?>", "<?php echo $d->TELEFONO; ?>", "<?php echo $d->DIRECCION; ?>", "<?php echo $d->REFERENCIA; ?>", "<?php echo $d->GENERO; ?>"],
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
				pdf.text('<?php echo $nombre_constructora ?>', 117,15,);

				//muestra el titulo secundario
				pdf.setFont('times');
				pdf.setFontSize(12);
				pdf.text("Reporte de clientes", 127,20,);

												//////// pie de Pagina ///////
				//muestra la fecha
				pdf.setFont('times');
				pdf.setFontSize(9);
				var today = new Date();
				let horas = today.getHours()
				let jornada = horas >=12 ? 'PM' : 'AM';
				var newdat = "Fecha: " + today.getDate() + "/" + (today.getMonth()+1) + "/" + today.getFullYear() + " " + (horas % 12) + ":" + today.getMinutes() + ":" + today.getSeconds() + " " + jornada;
				pdf.text(245-20,297-284,newdat);

				//muestra el numero de pagina
				pdf.text('Pagina ' + String(i) + '/' + String(pageCount),282-20,297-89,null,null,"right");
			}
				//Fin Encabezado y pie de pagina

							pdf.save('Reporte de clientes.pdf');
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

