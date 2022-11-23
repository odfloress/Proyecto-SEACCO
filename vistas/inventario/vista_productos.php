<?php
session_start();
if(!isset($_SESSION['usuario'])){
 
        header('Location: ../../_login.php');
        session_unset();
        session_destroy();
        die();
        
}

include '../../controladores/crud_productos.php';
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
               $tablero = "SELECT * FROM tbl_ms_roles_ojetos WHERE ID_ROL='$id_rol7' and ID_OBJETO=12 and PERMISO_CONSULTAR=0";
               $tablero2 = mysqli_query($conn, $tablero);
               if (mysqli_num_rows($tablero2) > 0)
               {
                header('Location: ../../vistas/tablero/vista_perfil.php');
                die();
               }else{
                $role = "SELECT * FROM tbl_ms_roles_ojetos WHERE ID_ROL='$id_rol7' and ID_OBJETO=12 and PERMISO_CONSULTAR=1";
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
  <title>Productos</title>
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
          <h3>Productos</h3>

            <!-- Inicio de modal de agregar -->
<div class="container mt-3">
<form id="form" action="" method="post">

  <!-- /// Para exportar en pdf /// -->
  <script type="text/javascript" src="../../js/complemento_1_jspdf.min.js"></script>
	<script type="text/javascript" src="../../js/complemento_2_jspdf.plugin.autotable.min.js"></script>
<?php 

      include '../../conexion/conexion.php';
      $tablero = "SELECT * FROM tbl_ms_roles_ojetos WHERE ID_ROL='$id_rol7' and ID_OBJETO=12 and PERMISO_INSERCION=1";
      $tablero2 = mysqli_query($conn, $tablero);
      if (mysqli_num_rows($tablero2) > 0)
       {
         echo '<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#myModal">
                 Nuevo producto
               </button>';
       }
 ?>
               
              <button type="submit"  name="accion" value="reporte_pdf" class="btn btn-secondary buttons-pdf buttons-html5"  onclick="return confirm('¿Desea generar reporte de productos?')" onclick="textToPdf()"><span>Reporte PDF</span></button>
	            </div>  
            </form>       
  
    
<!-- El Modal -->
    <div class="modal" id="myModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Encabezado del modal -->
                <div class="modal-header">
                    <h4 class="modal-title">Nuevo Producto</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <!-- Fin Encabezado del modal -->
                <form action="" method="post" enctype="multipart/form-data">
                <!-- Cuerpo del modal Modal -->
                <div class="modal-body">
                <label for="pwd" class="form-label">Categoría:</label>              
                  <select  value="<?php echo "$id_categoria"; ?>" required class="form-select" id="lista1" name="id_categoria" required >
                  <option >Seleccione</option>
                        <?php
                           include '../../conexion/conexion.php';
                            $id_categoria = "SELECT * FROM tbl_categoria_producto WHERE ESTADO='ACTIVO' ORDER BY ID_CATEGORIA";
                            $genero2 = mysqli_query($conn, $id_categoria);
                            if (mysqli_num_rows($genero2) > 0) {
                                while($row = mysqli_fetch_assoc($genero2))
                                {
                                $id_categoria = $row['ID_CATEGORIA'];
                                $categoria33 =$row['NOMBRE_CATEGORIA'];
                         ?>
                          <option value="<?php  echo $id_categoria ?>"><?php echo $categoria33 ?></option>
                          <?php
                           }}// finaliza el if y el while
                           ?>
                   </select>
                <br>
                <label for="">Codigo Prodcuto:</label>
                <input type="text" onkeyup="quitarespacios(this); sinespacio(this);" class="form-control" autocomplete="off" 
                onkeyup="mayus(this);" name="codigo" minlength="2" maxlength="30" required value="<?php echo "$codigo"; ?>" 
                placeholder="Ingrese el codigo del producto" minlength="4" maxlength="9">
                <br>
                <label for="">Nombre:</label>
                <input type="text" onkeyup="un_espacio(this);" autocomplete="off"  value="<?php echo "$nombre"; ?>" 
                onkeyup="mayus(this);" maxlength="255" class="form-control"  placeholder="Ingrese el nombre del producto" name="nombre" required
                minlength="3" maxlength="50">
                <br>
                <label for="">Descripción Modelo:</label>
                <input type="text" onkeyup="un_espacio(this);" autocomplete="off"  value="<?php echo "$descripcion_modelo"; ?>" 
                onkeyup="mayus(this);" maxlength="255" class="form-control"  placeholder="Ingrese la descripción del modelo" name="descripcion_modelo" required
                minlength="3" maxlength="255">
                <br>     
                <label for="">Cantidad Minima:</label>
                <input type="number" class="form-control" autocomplete="off" onkeyup="mayus(this);" name="cantidad_min" 
                required value="<?php echo "$cantidad_min"; ?>" placeholder="Ingrese la cantidad minima" minlength="1" maxlength="12">
                <br>  
                <label for="">Cantidad Maxima:</label>
                <input type="number" class="form-control" autocomplete="off" onkeyup="mayus(this);" name="cantidad_max" 
                required value="<?php echo "$cantidad_max"; ?>" placeholder="Ingrese la cantidad maxima" minlength="1" maxlength="12">
                <br>
                <label for="">Imagen:</label>
                <input type="file" class="form-control" accept=".jpg, .png, .jpeg, .JPEG, .JPG, .PNG" name="imagenes" required value="<?php echo "$nombreimagen"; ?>" placeholder=""  >
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

                <!-- <h3 class="card-title">PRODUCTOS</h3> -->
              </div>
              
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                  <th class="desaparecerTemporalmente">ACCIONES</th>
                  <th class="desaparecerTemporalmente1">ID</th>
                  <th class="desaparecerTemporalmente1">CATEGORIA</th>
                  <th class="desaparecerTemporalmente1">CODIGO</th>
                  <th class="desaparecerTemporalmente">IMAGEN</th>
                  <th class="desaparecerTemporalmente1">NOMBRE</th>
                  <th class="desaparecerTemporalmente1">DESCRIPCIÓN MODELO</th>
                  <th class="desaparecerTemporalmente1">CANTIDAD MINIMA</th>
                  <th class="desaparecerTemporalmente1">CANTIDAD MAXIMA</th>
                  </tr>
                  </thead>
                  <tbody>
                    
                  <?php
                  include '../../conexion/conexion.php';
                  //para mostrar los datos de la tabla mysql y mostrar en el crud                
                  $sql7 = "SELECT * FROM (tbl_productos p
                  INNER JOIN tbl_categoria_producto c ON p.ID_CATEGORIA = c.ID_CATEGORIA)
                  ORDER BY ID_PRODUCTO";
                  $result = mysqli_query($conn, $sql7);
                  if (mysqli_num_rows($result) > 0) {
                    $cont = 0;
                  while ($filas= mysqli_fetch_assoc($result)){
                    ?>
                    <?php  $cont++; ?>
                  <tr>
                  <td class="desaparecerTemporalmente">
                  <?php 
                          include '../../conexion/conexion.php';
                          $tablero = "SELECT * FROM tbl_ms_roles_ojetos WHERE ID_ROL='$id_rol7' and ID_OBJETO=12 and PERMISO_ACTUALIZACION=1";
                          $tablero2 = mysqli_query($conn, $tablero);
                          if (mysqli_num_rows($tablero2) > 0)
                          {?>
                              <!-- inicio boton editar -->
                              <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#myModal2<?php echo $filas['ID_PRODUCTO'] ?>">
                              <i class="fas fa-pencil-alt"></i>
                              </button>  <?php 
                          }
                        ?>
                      

                          <!-- El Modal -->
                          <div class="modal" id="myModal2<?php echo $filas['ID_PRODUCTO'] ?>">
                            <div class="modal-dialog">
                              <div class="modal-content">

                                <!-- Encabezado del modal -->
                                <div class="modal-header">
                                  <h4 class="modal-title">Editar Producto </h4>
                                  <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <!-- Fin Encabezado del modal -->


                                <!-- Cuerpo del modal Modal -->
                                <form action="" method="post" enctype="multipart/form-data">
                                <div class="modal-body">
                                <input type="hidden" name="nombre_anterior" value="<?php echo $filas['NOMBRE'] ?>"> 
                                <label for="">Id Producto:</label>
                                <input type="text" class="form-control" name="id_productos" readonly required value="<?php echo $filas['ID_PRODUCTO'] ?>" placeholder="" id="txtPrecio_Compra"   >
                                <br>
                  <label for="pwd" class="form-label">Categoría:</label>
                  <select style="background-color:rgb(240, 244, 245);" class="form-select" id="lista1" name="id_categoria" required >
                  <?php
                        include '../../conexion/conexion.php';
                        $id_categoria = "SELECT * FROM tbl_categoria_producto ORDER BY ID_CATEGORIA";
                        $genero2 = mysqli_query($conn, $id_categoria);
                        if (mysqli_num_rows($genero2) > 0) {
                            while($row = mysqli_fetch_assoc($genero2))
                            {
                            $id_categoria = $row['ID_CATEGORIA'];
                            $categoria3 =$row['NOMBRE_CATEGORIA'];
    
                                if($categoria3 == $filas["NOMBRE_CATEGORIA"]){?>
                                  <option value="<?php  echo $id_categoria; ?>" selected><?php echo $categoria3; ?></option>
                                
                                 <?php
                                }else{ ?>
                                 <option value="<?php  echo $id_categoria; ?>"><?php echo $categoria3; ?></option>
                                 <?php
                        }}}  // finaliza el if y el while
                       ?>
                  </select>
                  <br> 
                  <label for="">Codigo Producto:</label>
                <input type="text" onkeyup="quitarespacios(this); sinespacio(this);" class="form-control" autocomplete="off" 
                name="codigo" minlength="2" maxlength="30" required value="<?php echo $filas['CODIGO'] ?>" placeholder="" 
                minlength="4" maxlength="14">
                <br>
                <label for="">Nombre:</label>
                <input type="text" onkeyup="un_espacio(this);" autocomplete="off"  value="<?php echo $filas['NOMBRE'] ?>" 
                onkeyup="mayus(this);" maxlength="255" class="form-control"  placeholder="" name="nombre" required 
                minlength="3" maxlength="50">
                <br>
                <label for="">Descripción Modelo:</label>
                <input type="text" onkeyup="un_espacio(this);" autocomplete="off"  value="<?php echo $filas['DESCRIPCION_MODELO'] ?>" 
                onkeyup="mayus(this);" maxlength="255" class="form-control"  placeholder="" name="descripcion_modelo" required 
                minlength="3" maxlength="255">
                <br> 
                    
                <label for="">Cantidad Minima:</label>
                <input type="number" class="form-control" autocomplete="off" name="cantidad_min" required 
                value="<?php echo $filas['CANTIDAD_MIN'] ?>" placeholder="" minlength="1" maxlength="12">
                <br>
                <label for="">Cantidad Maxima:</label>
                <input type="number" class="form-control" autocomplete="off" name="cantidad_max" required 
                value="<?php echo $filas['CANTIDAD_MAX'] ?>" placeholder="" minlength="1" maxlength="12">
                <br>
                <input type="hidden" name="foto" value="<?php echo $filas['FOTO'] ?>">
                <input type="hidden" name="ruta" value="<?php echo $filas['FOTO'] ?>">
                <label for="">Imagen:</label><br>
                <img class="img-thumbnail" width="100px" src="<?php echo $filas['FOTO'] ?>"  /><br>
                <input type="file" class="form-control" accept=".jpg, .png, .jpeg, .JPEG, .JPG, .PNG" name="imagenes"  value="" placeholder=""  >
                <br> 
                
                </div>
                                         
                                <!-- Fin Cuerpo del modal Modal -->

                                <!-- pie del modal -->
                                <div class="modal-footer">
                                <button type="submit" name="accion" value="editar" class="btn btn-primary" onclick="return confirm('¿Desea editar el Producto?')">Guardar</button>
                                  <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                                </div>
                              </form>
                                  <!-- Fin pie del modal -->
                                  <form action="" method="post" >
                              </div>
                            </div>
                          </div>
                          <!-- fin boton editar -->
                          
                          <?php 
                          include '../../conexion/conexion.php';
                          $tablero = "SELECT * FROM tbl_ms_roles_ojetos WHERE ID_ROL='$id_rol7' and ID_OBJETO=12 and PERMISO_ELIMINACION=1";
                          $tablero2 = mysqli_query($conn, $tablero);
                          if (mysqli_num_rows($tablero2) > 0)
                          {?>
                          <input type="hidden" name="id_productos"  value="<?php echo $filas['ID_PRODUCTO'] ?>">
                          <input type="hidden" name="nombre_anterior" value="<?php echo $filas['NOMBRE'] ?>">
                             <button  value="eliminar" name="accion" 
                        onclick="return confirm('¿Quieres eliminar este dato?')"
                        type="submit" class="btn btn-danger " data-id="19">
                        <i class="fas fa-trash-alt"></i>
                        </button> <?php 
                          }
                        ?>
                     </form>
</td>
                     <td class="desaparecerTemporalmente1"><?php echo $filas['ID_PRODUCTO'] ?></td>
                     <td class="desaparecerTemporalmente1"><?php echo $filas['NOMBRE_CATEGORIA'] ?></td>                  
                     <td class="desaparecerTemporalmente1"><?php echo $filas['CODIGO'] ?></td>
                     <td class="desaparecerTemporalmente"><img class="img-thumbnail" width="100px" src="<?php echo $filas['FOTO'] ?>" /></td>
                     <td class="desaparecerTemporalmente1"><?php echo $filas['NOMBRE'] ?></td>
                     <td class="desaparecerTemporalmente1"><?php echo $filas['DESCRIPCION_MODELO'] ?></td> 
                     <td class="desaparecerTemporalmente1" style="text-align: right;"><?php echo $filas['CANTIDAD_MIN'] ?></td>
                     <td class="desaparecerTemporalmente1" style="text-align: right;"><?php echo $filas['CANTIDAD_MAX'] ?></td>                                                         
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
      "order": [[ 1, "desc" ]],
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
                          "buttons": ["excel", "colvis"], 
                          buttons:[
                            {
                            extend:     'excelHtml5',
                            text:       'Exportar a Excel',
                            titleAttr:  'Exportar a Excel',
                            title:     'REPORTE DE PRODCUTOS',
                            exportOptions:{
                              columns: [1,2,3,4,5,6,7]
                            }
                          },
                          {
                            extend: 'colvis',
                            text:   'Visualizar',
                            title:  'REPORTE DE PRODCUTOS',
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
<!-- Enlace Script para que convierta a mayusculas las teclas que se van pulsando -->
<script type="text/javascript" src="../../js/converir_a_mayusculas.js"></script>

<!-- Enlace Script para quitar espacios en blanco -->
<script type="text/javascript" src="../../js/quitar_espacios.js"></script>
</body>

<!-- // Inicio para exportar en pdf // -->
<?php

	require '../../conexion/conexion.php';
	$sql = "SELECT * FROM (tbl_productos pr
  INNER JOIN tbl_categoria_producto cp ON pr.ID_CATEGORIA = cp.ID_CATEGORIA)
  ORDER BY ID_PRODUCTO desc";
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
<!-- // Inicio para exportar en pdf // -->

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
      
            0: {cellWidth: 15},
            1: {cellWidth: 30},
            2: {cellWidth: 30},
            3: {cellWidth: 50},
            4: {cellWidth: 66},
            5: {cellWidth: 30},
            6: {cellWidth: 30}
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
				pdf.text("Reporte de productos", pdf.internal.pageSize.getWidth() / 2, 20, null, 'center');

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

				//muestra el numero de pagina
				pdf.text('Pagina ' + String(i) + '/' + String(pageCount),282-20,297-89,null,null,"right");
			}
				//Fin Encabezado y pie de pagina

							pdf.save('Reporte de productos.pdf');
              $(".desaparecerTemporalmente").css("display","");
	})
  
</script>
<!-- // Fin para exportar en pdf // -->
<script type="text/javascript" src="../../js/un_espacio.js"></script>
<script type="text/javascript" src="../../js/evitar_reenvio.js"></script>
<script type="text/javascript">


function sinespacio(e) {

  var limpia = e.value;
        limpia = limpia.toUpperCase().replace(' ', '');
        e.value = limpia;

};
</script>

<script type="text/javascript">
function quitarespacios(e) {

  var cadena =  e.value;
  cadena = cadena.trim();

  e.value = cadena;

};
</script>

</html>
