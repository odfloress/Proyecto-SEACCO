<?php
session_start();
if(!isset($_SESSION['usuario'])){
 
        header('Location: ../iniciar_sesion/index_login.php');
        session_unset();
        session_destroy();
        die();
        
}
include '../../controladores/crud_devolucion.php';
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
               $proveedor = "SELECT * FROM tbl_ms_roles_ojetos WHERE ID_ROL='$id_rol7' and ID_OBJETO=33 and PERMISO_CONSULTAR=0";
               $proveedor2 = mysqli_query($conn, $proveedor);
               if (mysqli_num_rows($proveedor2) > 0)
               {
                header('Location: ../../vistas/tablero/vista_perfil.php');
                die();
               }else{
                $role = "SELECT * FROM tbl_ms_roles_ojetos WHERE ID_ROL='$id_rol7' and ID_OBJETO=33 and PERMISO_CONSULTAR=1";
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
  <title>Devoluciones</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
  <!-- enlace del scritpt para evitar si preciona F12, si preciona Ctrl+Shift+I, si preciona Ctr+u  -->
  <script type="text/javascript" src="../../js/evita_ver_codigo_utilizando_teclas.js"></script>
   <!-- ////////////// Inicio para select ////////// -->
<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css"> -->
<link rel='stylesheet prefetch' href='https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.11.2/css/bootstrap-select.min.css'>
<link rel="stylesheet" href="../../css/est.css">

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.3/js/bootstrap-select.min.js"></script>
<!-- ////////////// Fin para select ////////// -->
         <!-- /// para exportar en pdf /// -->
   <script type="text/javascript" src="../../js/complemento_1_jspdf.min.js"></script>
	<script type="text/javascript" src="../../js/complemento_2_jspdf.plugin.autotable.min.js"></script>

<script>function quitarespacios1(e) {
  
  var cadena =  e.value;
  var limpia = e.value;
        limpia = limpia.replace(" ", '');
        e.value = limpia;
  
  };</script>
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
        <h3>Devoluciones de compras</h3>  
    
        
    </div>
        

<!-- El Modal -->
    <div class="modal" id="myModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Encabezado del modal -->
                <div class="modal-header">
                    <h4 class="modal-title">Nueva devolución</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <!-- Fin Encabezado del modal -->

                <!-- Cuerpo del modal Modal -->
                <form action="" method="post">
                <div class="modal-body">
                
                <label for="">Producto:</label>
                    <select  name="producto" required class="form-control selectpicker"  data-live-search="true" >
                    <option value="">Selecciona el producto</option>
                        <?php
                            include '../../conexion/conexion.php';
                            $productos = "SELECT * FROM tbl_productos ORDER BY NOMBRE asc";
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

                    <label for="">Cantidad:</label>
                    <input type="text" class="form-control" name="cantidad" required value="<?php echo $cantidad; ?>" placeholder=""  
                    autocomplete = "off" minlength="1" maxlength="12"  onkeypress="return filterFloat(event,this);" >
                    <br>
                    <label for="">Seleccione el proveedor</label>
                    <select  name="proveedor" required class="form-control selectpicker"  data-live-search="true" >
                       <option value=""> </option>
                       <?php
                            include '../../conexion/conexion.php';
                            $preveedor = "SELECT * FROM tbl_proveedores ORDER BY ID_PROVEEDOR";
                            $preveedor2 = mysqli_query($conn, $preveedor);
                            if (mysqli_num_rows($preveedor2) > 0) {
                                while($row = mysqli_fetch_assoc($preveedor2))
                                {
                                $id_proveedor = $row['ID_PROVEEDOR'];
                                $proveedor =$row['NOMBRE'];
                         ?>
                          <option value="<?php  echo $id_proveedor ?>"><?php echo $proveedor ?></option>
                          <?php
                           }}// finaliza el if y el while
                           ?>
                   </select><br><br>
                    <label for="">Descripción:</label>
                    <TEXtarea  style="background-color: white;" onkeyup="un_espacio(this);" name="descripcion" class="form-control" id="" required cols="40" rows="5"
                    autocomplete = "off"   minlength="3" maxlength="245"  ><?php echo $descricion; ?></TEXtarea>
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
      $area1 = "SELECT * FROM tbl_ms_roles_ojetos WHERE ID_ROL='$id_rol7' and ID_OBJETO=33 and PERMISO_INSERCION=1";
      $area2 = mysqli_query($conn, $area1);
      if (mysqli_num_rows($area2) > 0)
       {
         echo '<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#myModal">
                    Nueva devolución
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
                  <th class="desaparecerTemporalmente">Acciones</th>
                  <th class="desaparecerTemporalmente1" >ID</th>
                  <th class="desaparecerTemporalmente1">Producto</th>
                  <th class="desaparecerTemporalmente1">Cantidad</th>
                  <th class="desaparecerTemporalmente1">Proveedor</th>
                  <th class="desaparecerTemporalmente1">Descripción</th>
                  <th class="desaparecerTemporalmente1">Usuario</th>
                  <th class="desaparecerTemporalmente1">Fecha</th>
                  
                  </tr>
                  </thead>
                  <tbody>
                  <?php 
                  $cont = 0;
                  while ($filas= mysqli_fetch_assoc($result)){

                  ?>
                   
                  <tr>
                  <td class="desaparecerTemporalmente">
                 
                          
                          <?php 
                          include '../../conexion/conexion.php';
                          $proveedor = "SELECT * FROM tbl_ms_roles_ojetos WHERE ID_ROL='$id_rol7' and ID_OBJETO=33 and PERMISO_ELIMINACION=1";
                          $proveedor2 = mysqli_query($conn, $proveedor);
                          if (mysqli_num_rows($proveedor2) > 0)
                          {?>
                            <form action="" method="post">
                            <input type="hidden" name="id_productoss" value="<?php echo $filas['ID_PRODUCTOSS'] ?>">
                                <input type="hidden" name="cantidad" value="<?php echo $filas['CANTIDAD'] ?>">
                          <input type="hidden" name="id_devolucion"  value="<?php echo $filas['ID_DEVOLUCION'] ?>">
                        
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
                                         <td class="desaparecerTemporalmente1"><?php echo $filas['ID_DEVOLUCION'] ?></td>
                                         <td class="desaparecerTemporalmente1"><?php echo $filas['NOMBRE_PRODUCTO'] ?></td>
                                         <td class="desaparecerTemporalmente1"><?php echo $filas['CANTIDAD'] ?></td>
                                         <td class="desaparecerTemporalmente1"><?php echo $filas['NOMBRE'] ?></td>
                                         <td class="desaparecerTemporalmente1"><?php echo $filas['DESCRIPCION_DEVOLUCION'] ?></td>
                                         <td class="desaparecerTemporalmente1"><?php echo $filas['USUARIO'] ?></td>
                                         <td class="desaparecerTemporalmente1"><?php echo $filas['FECHA'] ?></td>
                                        
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
                          "buttons": ["excel",  "colvis"],  

                      //  Inicio   exportar en excel 
                          buttons:[ 
    {
            extend:    'excelHtml5',
            text:      'Exportar a Excel',
            titleAttr: 'Exportar a Excel',
            title:     'REPORTE DE PROVEEDORES',
            exportOptions: {
                columns: [1,2,3,4,5,6,7]
            }
    },
    {
            extend:    'colvis',
            text:      'Visualizar',
            
           
           
    }
   
] 
  //  Fin   exportar en excel                 
        
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
<!-- un espacio entre palabras -->
<script type="text/javascript" src="../../js/un_espacio.js"></script>
<!-- Enlace Script para que solo permita letras -->
<script type="text/javascript" src="../../js/solo_letras.js"></script>

<!-- Enlace Script para que convierta a mayusculas las teclas que se van pulsando -->
<script type="text/javascript" src="../../js/converir_a_mayusculas.js"></script>

<!-- Enlace Script para quitar espacios en blanco -->
<script type="text/javascript" src="../../js/quitar_espacios.js"></script>
</body>

<!-- // Inicio para exportar en pdf // -->

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

				const pdf = new jsPDF('L', 'mm', 'letter');			
        	

				
				

				pdf.autoTable(
				{ 
          html:'#example1',
					
					margin:{ top: 30 },
          
          columnStyles: {    
      
            0: {cellWidth: 11},
            1: {cellWidth: 41}, 
            2: {cellWidth: 40},  
            3: {cellWidth: 35},  
            4: {cellWidth: 55},  
            5: {cellWidth: 20},            
            6: {cellWidth: 50}
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
				pdf.text('<?php echo $nombre_constructora ?>', pdf.internal.pageSize.getWidth() / 2, 15, null, 'center');

				//muestra el titulo secundario
				pdf.setFont('times');
				pdf.setFontSize(12);
				pdf.text("Reporte de proveedores", pdf.internal.pageSize.getWidth() / 2, 20, null, 'center');

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
        // pdf.text(245-25,297-281,"<?php echo 'Creado por:'. $_SESSION['usuario']; ?>");

				//muestra el numero de pagina
				pdf.text('Pagina ' + String(i) + '/' + String(pageCount),282-20,297-89,null,null,"right");
			}
				//Fin Encabezado y pie de pagina

							pdf.save('Reporte de proveedores.pdf');
              $(".desaparecerTemporalmente").css("display","");
	})

</script>
<script type="text/javascript" src="../../js/un_espacio.js"></script>
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


<!-- permitir un punto y 2 decimales -->
<script type="text/javascript">

function filterFloat(evt,input){
    // Backspace = 8, Enter = 13, ‘0′ = 48, ‘9′ = 57, ‘.’ = 46, ‘-’ = 43
    var key = window.Event ? evt.which : evt.keyCode;   
    var chark = String.fromCharCode(key);
    var tempValue = input.value+chark;
    var isNumber = (key >= 48 && key <= 57);
    var isSpecial = (key == 8 || key == 13 || key == 0 ||  key == 46);
    if(isNumber || isSpecial){
        return filter(tempValue);
    }        
    
    return false;    
    
}
function filter(__val__){
    var preg = /^([0-9]+\.?[0-9]{0,2})$/; 
    return (preg.test(__val__) === true);
}

</script>

