<?php
session_start();
if(!isset($_SESSION['usuario'])){
 
        header('Location: ../../_login.php');
        session_unset();
        session_destroy();
        die();
        
}
include '../../controladores/crud_respuestas_usuarios.php';
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
               $profesion = "SELECT * FROM tbl_ms_roles_ojetos WHERE ID_ROL='$id_rol7' and ID_OBJETO=24 and PERMISO_CONSULTAR=0";
               $profesionn = mysqli_query($conn, $profesion);
               if (mysqli_num_rows($profesionn) > 0)
               {
                header('Location: ../../vistas/tablero/vista_perfil.php');
                die();
               }else{
                      $profesion = "SELECT * FROM tbl_ms_roles_ojetos WHERE ID_ROL='$id_rol7' and ID_OBJETO=32 and PERMISO_CONSULTAR=1";
                      $profesionn = mysqli_query($conn, $profesion);
                      if (mysqli_num_rows($profesionn) > 0){}
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
  <title>Respuestas Usuario</title>
    <!-- ////////////// Inicio para select ////////// -->
<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css"> -->
<link rel='stylesheet prefetch' href='https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.11.2/css/bootstrap-select.min.css'>
<link rel="stylesheet" href="../../css/est.css">

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.3/js/bootstrap-select.min.js"></script>
<!-- ////////////// Fin para select ////////// -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- enlace del scritpt para evitar si preciona F12, si preciona Ctrl+Shift+I, si preciona Ctr+u  -->
    <script type="text/javascript" src="../../js/evita_ver_codigo_utilizando_teclas.js"></script>

               <!-- /// Para exportar en pdf /// -->
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
        <div class="row mb-3">
        <h3>Respuestas de Usuario</h3> 
          <div class="col-sm-2">
            <h1></h1>
            <!-- Inicio de modal de agregar -->
<div class="container mt-12">
  
        
    
        
    </div>

<!-- El Modal -->
    <div class="modal" id="myModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Encabezado del modal -->
                <form action="" method="post">
                <div class="modal-header">
                    <h4 class="modal-title">Nueva Respuesta</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <!-- Fin Encabezado del modal -->

                <!-- Cuerpo del modal Modal -->
                <div class="modal-body">
               
                    
                
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
            
            <div class="card table-responsive">
              <div class="card-header">
              <form id="form" action="" method="post">
                    <div class="btn-group">
                    <?php 
      include '../../conexion/conexion.php';
      $profesion1 = "SELECT * FROM tbl_ms_roles_ojetos WHERE ID_ROL='$id_rol7' and ID_OBJETO=32 and PERMISO_INSERCION=1";
      $profesion2 = mysqli_query($conn, $profesion1);
      if (mysqli_num_rows($profesion2) > 0)
       {
         
                          }
                        ?> 
              <button type="submit"  name="accion" value="reporte_pdf" class="btn btn-secondary buttons-pdf buttons-html5"  onclick="return confirm('¿Desea generar reporte de respuestas de usuario?')" onclick="textToPdf()"><span>Reporte PDF</span></button>
	               </div>
            </form>
                <!-- <h3 class="card-title">Profesiones</h3> -->
                
              </div>
              
              <!-- /.card-header -->
              <div class="card-body ">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                  <th class="desaparecerTemporalmente">Acciones</th>
                  <th class="desaparecerTemporalmente1">ID</th>
                  <th class="desaparecerTemporalmente1">Usuario</th>
                  <th class="desaparecerTemporalmente1">Pregunta</th>
                  <th class="desaparecerTemporalmente1">Respuesta</th>
                  
                  
                  
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
                  <?php 
                          include '../../conexion/conexion.php';
                          $profesion1 = "SELECT * FROM tbl_ms_roles_ojetos WHERE ID_ROL='$id_rol7' and ID_OBJETO=32 and PERMISO_ACTUALIZACION=1";
                          $profesion2 = mysqli_query($conn, $profesion1);
                          if (mysqli_num_rows($profesion2) > 0)
                          {?>
                                 <!-- inicio boton editar -->
                      <button type="button"  class="btn btn-warning" onclick="ocultar()" data-bs-toggle="modal" data-bs-target="#myModal2<?php echo $filas['ID_RESPUESTA'] ?>" >
                      <i class="fas fa-pencil-alt"></i>
                      </button> <?php 
                          }
                        ?>
                      
                     

                          <!-- El Modal -->
                          <div class="modal" id="myModal2<?php echo $filas['ID_RESPUESTA'] ?>">
                            <div class="modal-dialog">
                              <div class="modal-content">

                                <!-- Encabezado del modal -->
                                <div class="modal-header">
                                  <h4 class="modal-title">Editar Respuesta</h4>
                                  <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <!-- Fin Encabezado del modal -->


                                <!-- Cuerpo del modal Modal -->
                                <form action="" method="post">
                                          <div class="modal-body">
                                          <input type="hidden" name="repuesta_anterior" value="<?php echo $filas['RESPUESTA'] ?>">
                                            <label for="">ID Respuesta:</label>
                                              <input type="text" readonly class="form-control" name="id_repuesta" required value="<?php echo $filas['ID_RESPUESTA'] ?>" placeholder=""  >
                                              <br>
                                              <label for="">Usuario:</label>
                                              <input type="text" readonly class="form-control" name="usuario" required value="<?php echo $filas['USUARIO'] ?>" placeholder=""  >
                                              <br>
                                              <label for="">Pregunta:</label>
                                              <select style="background-color:rgb(240, 244, 245);"   id="lista1" name="id_pregunta" required  class="form-control selectpicker"  data-live-search="true">
                                              <option value="<?php echo $filas['ID_PREGUNTAS'] ?>"><?php echo $filas['PREGUNTA'] ?></option>
                                                  <?php
                                                      include 'conexion/conexion.php';
                                                      $departamento = "SELECT * FROM tbl_preguntas";
                                                      $departamento2 = mysqli_query($conn, $departamento);
                                                      if (mysqli_num_rows($departamento2) > 0) {
                                                          while($row = mysqli_fetch_assoc($departamento2))
                                                          {
                                                          $id_departamento = $row['ID_PREGUNTA'];
                                                          $departamento3 =$row['PREGUNTA'];
                                                  ?>
                                                    <option value="<?php  echo $id_departamento.$departamento3 ?>"><?php echo $departamento3 ?></option>
                                                    <?php
                                                    }}// finaliza el if y el while
                                                    ?>
                                            </select><br>
                                            <!--  <input type="text" readonly class="form-control" name="id_pregunta" required value="<?php echo $filas['PREGUNTA'] ?>" placeholder=""  > -->
                                              <br>
                                              <label for="">Respuesta:</label>
                                             <!-- <input type="text" class="form-control" name="repuesta" required value="<?php echo $filas['RESPUESTA'] ?>" 
                                              placeholder=""  autocomplete = "off"  onkeypress="return soloLetras(event);" minlength="3" maxlength="50" 
                                              onkeyup="un_espacio(this);"  > -->

                                              <input type="password" onkeyup="un_espacio(this);" class="form-control mostrar" name="repuesta" id="contra" placeholder="" 
                                                required  minlength="3" maxlength="50" onkeypress="return soloLetras(event);" value="<?php echo $filas['RESPUESTA'] ?>">
                                                <input type="checkbox" onclick="mostrarContrasena2()" > Mostrar/Ocultar
                                             <br>
                                          
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
                          $profesion1 = "SELECT * FROM tbl_ms_roles_ojetos WHERE ID_ROL='$id_rol7' and ID_OBJETO=32 and PERMISO_ELIMINACION=1";
                          $profesion2 = mysqli_query($conn, $profesion1);
                          if (mysqli_num_rows($profesion2) > 0)
                          {?>
                             <button  value="eliminar" name="accion" 
                        onclick="return confirm('¿Quieres eliminar este dato?')"
                        type="submit" class="btn btn-danger ">
                        <i class="fas fa-trash-alt"></i>
                    </button><?php 
                          }
                        ?>
                          
                      </form>
                    
</td>
                     <td class="desaparecerTemporalmente1"><?php echo $filas['ID_RESPUESTA'] ?></td>
                     <td class="desaparecerTemporalmente1"><?php echo $filas['USUARIO'] ?></td>
                     <td class="desaparecerTemporalmente1"><?php echo $filas['PREGUNTA'] ?></td>
                     <td class="desaparecerTemporalmente1">***********</td>
                     
                    
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
                         "buttons": ["excel",  "colvis"],  
                          
                           //  Inicio   exportar en excel 
                           buttons:[ 
    {
            extend:    'excelHtml5',
            text:      'Exportar a Excel',
            titleAttr: 'Exportar a Excel',
            title:     'REPORTE DE RESPUESTAS DE USUARIO',
            exportOptions: {
                columns: [1,2,3,4]
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

<!-- Enlace Script para que solo permita letras -->
<script>
  // Inicio Script para que solo permita letras
 
  function soloLetras(e){
       key = e.keyCode || e.which;
       tecla = String.fromCharCode(key).toLowerCase();
       letras = " .áéíóúabcdefghijklmnñopqrstuvwxyz";
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
        function mostrarContrasena2(){
          var x = document.getElementById("contra");
          if (x.type === "password"){
            $(".mostrar").attr("type","text");
          }else{
            $(".mostrar").attr("type","password");
          } 
        }

        function ocultar(){
          $(".mostrar").attr("type","password");
          $(".mostrar2").attr("type","password");
        }
</script>

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

   ////////// Inicio Ocultar y mostrar columnas y tablas///////
   ///////Mostrar columnas y filas /////////////
  $(".desaparecerTemporalmente1").css("display","");

  ///////Ocultar columnas y filas /////////////
  $(".desaparecerTemporalmente").css("display","none");
   ////////// Fin Ocultar y mostrar columnas y tablas///////

			/////// tamaño de pagina ///////////////
			const pdf = new jsPDF('p', 'mm', 'letter');
				
      ////////////// Inicio estructura de la Tabla ////////////////
      pdf.autoTable(
				{ 
          html:'#example1',
					
					margin:{ top: 30 },
          
          columnStyles: {    
      
            0: {cellWidth: 15},
            1: {cellWidth: 30}, 
            2: {cellWidth: 72},
            3: {cellWidth: 72} 
            
           } 
          }
				);
      ////////////// Fin estructura de la Tabla ////////////////
  
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
      pdf.text("Reporte de respuestas de usuario", pdf.internal.pageSize.getWidth() / 2, 20, null, 'center');

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

            pdf.save('Reporte de respuestas de usuario.pdf');
            $(".desaparecerTemporalmente").css("display","");
})

</script>
<!-- // Fin para exportar en pdf // -->

<script type="text/javascript" src="../../js/evitar_reenvio.js"></script>
</html>
<script type="text/javascript" src="../../js/un_espacio.js"></script>