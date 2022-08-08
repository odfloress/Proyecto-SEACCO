<?php
session_start();
if(!isset($_SESSION['usuario'])){
 
        header('Location: ../../_login.php');
        session_unset();
        session_destroy();
        die();
        
}
include '../../controladores/crud_detalle_producto.php';
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
                VALUES ('$usuario1[usuario]', 'CONSULTO', 'CONSULTO LA PANTALLA  ADMINISTRATIVA DE DETALLE DE COMPRAS')";
                if (mysqli_query($conn, $sql)) {} else {}
                // fin inserta en la tabla bitacora


?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Detalle de compra</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- enlace del scritpt para evitar si preciona F12, si preciona Ctrl+Shift+I, si preciona Ctr+u  -->
    <script type="text/javascript" src="../../js/evita_ver_codigo_utilizando_teclas.js"></script>



  <?php include '../../configuracion/navar.php' ?>
  <!-- Inicio evita el click derecho de la pagina -->
<body oncontextmenu="return false">
<!-- Fin evita el click derecho de la pagina --> 
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
      <h1>Detalle de compra</h1>
        <div class="row mb-2">
          <div class="col-sm-2">
            <h1></h1>
            <!-- Inicio de modal de agregar -->
<div class="container mt-3">
  
        <h3></h3> <br> 
        <?php 
      include '../../conexion/conexion.php'; 

                $tablero = "SELECT * FROM tbl_ms_roles_ojetos WHERE ID_ROL='$id_rol7' and ID_OBJETO=8 and PERMISO_INSERCION=1";
                $tablero2 = mysqli_query($conn, $tablero);
                if (mysqli_num_rows($tablero2) > 0)
                {
                  echo '<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#myModal">
                              Seleccione los productos
                          </button>';
                }
         
                                  ?> 
        
    </div>

<!-- El Modal -->
    <div class="modal" id="myModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Encabezado del modal -->
                <form action="" method="post">
                <div class="modal-header">
                    <h4 class="modal-title">Añadir producto</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <!-- Fin Encabezado del modal -->

                <!-- Cuerpo del modal Modal -->
                <div class="modal-body">
               
                <label for="">Seleccione el producto</label>
                    <select class="form-select" id="lista1" name="producto" required >
                        <?php
                            include '../../conexion/conexion.php';
                            $productos = "SELECT * FROM tbl_productos ORDER BY ID_PRODUCTO";
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
                   </select><br>

                   <label for="">Garantia</label>
                    <input type="text" class="form-control" name="garantia" required value="<?php echo $garantia14;?>" placeholder=""  autocomplete = "off"  onkeypress="return soloLetras(event);" minlength="3" maxlength="255" 
                    onkeyup="mayus(this);" required ><br>

                    <label for="">Seleccione la unidad de medida</label>
                    <select class="form-select" id="lista1" name="unidad_medida" required >
                        <?php
                            include '../../conexion/conexion.php';
                            $unidades = "SELECT * FROM tbl_unidad_medida ORDER BY ID_UNIDAD_MEDIDA";
                            $unidades2 = mysqli_query($conn, $unidades);
                            if (mysqli_num_rows($unidades2) > 0) {
                                while($row = mysqli_fetch_assoc($unidades2))
                                {
                                $id_unidades = $row['ID_UNIDAD_MEDIDA'];
                                $medidas =$row['UNIDAD_MEDIDA'];
                         ?>
                          <option value="<?php  echo $id_unidades ?>"><?php echo $medidas; ?></option>
                          <?php
                           }}// finaliza el if y el while
                           ?>
                   </select><br>
                   <label for="">Cantidad</label>
                   <input type="number" class="form-control" name="cantidad" required value="<?php echo $cantidad; ?>" placeholder=""  
                    autocomplete = "off"   >

                    <label for="">Precio</label>
                    <input type="number" class="form-control" name="precio" required value="<?php echo $precio; ?>" placeholder=""  
                    autocomplete = "off"   >
                
                </div>
                <!-- Fin Cuerpo del modal Modal -->
                <!-- pie del modal -->
                <div class="modal-footer">
      	            <button type="submit" name="accion" value="agregar" class="btn btn-primary" onclick="return confirm('¿Desea añadir el producto?')">Agregar</button>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                </div>
                <!-- Fin pie del modal -->
                </form>
            </div>
        </div>
    </div>
    <!-- Fin  de modal de agregar --> <br>
          </div>
          <div class="col-sm-12">
            <ol class="breadcrumb float-sm-right">
              <?php 
              //selecciona el id de la comra en proceso
                $validar_compra7 = "SELECT * FROM tbl_compras WHERE USUARIO='$usuario1[usuario]' and ESTADO_COMPRA='EN PROCESO'";
                $validar_compra77 = mysqli_query($conn, $validar_compra7);
                if (mysqli_num_rows($validar_compra77) > 0)
                {
                      while($row = mysqli_fetch_assoc($validar_compra77)) 
                      {
                            $precio_total = $row["TOTAL_COMPRA"];
                            
                      }
                }
              ?>
              
              <input  type="number" readonly class="form-control" value="<?php echo $precio_total;?>" id="">
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
                <!-- <h3 class="card-title">Compras</h3> -->
                <form action="" method="post">
                <button type="submit" name="accion" value="cancelar" class="btn btn-danger" onclick="return confirm('¿Desea cancelar la compra?')">Cancelar compra</button>
                <button type="submit" name="accion" value="confirmar" class="btn btn-primary" onclick="return confirm('¿Desea terminar la compra?')">Confirmar compra</button>


                </form>
                
              </div>
              
              <!-- /.card-header -->
              <div class="card-body ">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                 <th>Acciones</th>
                  <th>Id detalle</th>
                  <th>Id compra</th>
                  <th>producto</th>
                  <th>Garantia</th>
                  <th>Unidad de medida</th>
                  <th>Cantidad</th>
                  <th>Precio</th>

                  
                  
                  </tr>
                  </thead>
                  <tbody>
                    <?php 
                    
                    while ($filas= mysqli_fetch_assoc($result)){
 
                     ?>
                  <tr>
                  <td>
                  <form action="" method="post">
                         
                          <!-- fin boton editar -->
                          <input type="hidden" name="cantidad"  value="<?php echo $filas['CANTIDAD'] ?>">
                          <input type="hidden" name="precio" value="<?php echo $filas['PRECIO'] ?>">
                          <input type="hidden" name="producto" value="<?php echo $filas['ID_PRODUCTO'] ?>">
                          <?php 
                          include '../../conexion/conexion.php';
                          $tablero = "SELECT * FROM tbl_ms_roles_ojetos WHERE ID_ROL='$id_rol7' and ID_OBJETO=8 and PERMISO_ELIMINACION=1";
                          $tablero2 = mysqli_query($conn, $tablero);
                          if (mysqli_num_rows($tablero2) > 0)
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
                     <td ><?php echo $filas['ID_DETALLE'] ?></td>
                     <td><?php echo $filas['ID_COMPRA'] ?></td>
                     <td><?php echo $filas['NOMBRE'] ?></td>
                     <td><?php echo $filas['GARANTIA'] ?></td>
                     <td><?php echo $filas['UNIDAD_MEDIDA'] ?></td>
                     <td><?php echo $filas['CANTIDAD'] ?></td>
                     <td><?php echo $filas['PRECIO'] ?></td>
                     
                    
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
<script type="text/javascript" src="../../js/evitar_reenvio.js"></script>
</html>
