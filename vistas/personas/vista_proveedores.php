<?php
session_start();
if(!isset($_SESSION['usuario'])){
 
        header('Location: ../iniciar_sesion/index_login.php');
        session_unset();
        session_destroy();
        die();
        
}
include '../../controladores/crud_proveedor.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Proveedores</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

  <?php include '../../configuracion/navar.php' ?>
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
        <h3>Proveedores</h3> <br>  
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#myModal">
            Nuevo Proveedor
        </button>
    </div>

<!-- El Modal -->
    <div class="modal" id="myModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Encabezado del modal -->
                <div class="modal-header">
                    <h4 class="modal-title">Nuevo proveedor</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <!-- Fin Encabezado del modal -->

                <!-- Cuerpo del modal Modal -->
                <form action="" method="post">
                <div class="modal-body">
                
                    <label for="">Proveedor</label>
                    <input type="text" class="form-control" name="nombre" required value="" placeholder="" id="txtPrecio_Compra" onkeypress="return soloLetras(event);" minlength="3" maxlength="20" onkeyup="mayus(this);" >
                    <br>
                    <label for="">Nombre Referencia</label>
                    <input type="text" class="form-control" name="nombre_referencia" required value="" placeholder="" id="txtnombrer" onkeypress="return soloLetras(event);" minlength="3" maxlength="20" onkeyup="mayus(this);" >
                    <br>
                    <label for="">Sector comercial</label>
                    <input type="text" class="form-control" name="sector_comercial" required value="" placeholder="" id="txtsectorcomercial" onkeypress="return soloLetras(event);" minlength="3" maxlength="20" onkeyup="mayus(this);" >
                    <br>
                    <label for="">direccion</label>
                    <input type="text" class="form-control" name="direccion" required value="" placeholder="" id="txtdireccionproveedor"  onkeyup="mayus(this);" >
                    <br>
                    <label for="">Telefono</label>
                    <input type="number" class="form-control" name="telefono" required value="" placeholder="" id="txttelefono"   >
                    <br>
                    <label for="">Correo</label>
                    <input type="email" class="form-control" name="correo" required value="" placeholder="" id="txtcorreo"   >
                    <br>
                </div>
                <!-- Fin Cuerpo del modal Modal -->
                <!-- pie del modal -->
                <div class="modal-footer">
      	            <button type="submit" name="accion" value="agregar" class="btn btn-primary" onclick="return confirm('¿Desea agregar el proveedor?')">Agregar</button>
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
                <h3 class="card-title">Proveedores</h3>
                
              </div>
              
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                  <th>Acciones</th>
                  <th>Id</th>
                  <th>Nombre</th>
                  <th>Nombre referencia</th>
                  <th>Seactor comercial</th>
                  <th>Dirección</th>
                  <th>Telefono</th>
                  <th>Correo</th>
                  
                  </tr>
                  </thead>
                  <tbody>
                  <?php while ($filas= mysqli_fetch_assoc($result)){

                  ?>
                  <tr>
                  <td>
                        <!-- inicio boton editar -->
                      <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#myModal2<?php echo $filas['ID_PROVEEDOR'] ?>">
                      <i class="fas fa-pencil-alt"></i>
                      </button>

                          <!-- El Modal -->
                          <div class="modal" id="myModal2<?php echo $filas['ID_PROVEEDOR'] ?>">
                            <div class="modal-dialog">
                              <div class="modal-content">

                                <!-- Encabezado del modal -->
                                <div class="modal-header">
                                  <h4 class="modal-title">Editar proveedor</h4>
                                  <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <!-- Fin Encabezado del modal -->


                                <!-- Cuerpo del modal Modal -->
                                <form action="" method="post">
                                          <div class="modal-body">
                                              <label for="">Id Proveedor</label>
                                              <input type="text" class="form-control" name="id_proveedor" readonly required value="<?php echo $filas['ID_PROVEEDOR'] ?>" placeholder="" id="txtPrecio_Compra"   >
                                              <br>
                                              <label for="">Proveedor</label>
                                              <input type="text" class="form-control" name="nombre" required value="<?php echo $filas['NOMBRE'] ?>" placeholder="" id="txtPrecio_Compra" onkeypress="return soloLetras(event);" onkeyup="mayus(this);" >
                                              <br>
                                              <label for="">Nombre Referencia</label>
                                             <input type="text" class="form-control" name="nombre_referencia" required value="<?php echo $filas['NOMBRE_REFERENCIA'] ?>" placeholder="" id="txtnombrer" onkeypress="return soloLetras(event);" onkeyup="mayus(this);" >
                                             <br>
                                             <label for="">Sector comercial</label>
                                             <input type="text" class="form-control" name="sector_comercial" required value="<?php echo $filas['SECTOR_COMERCIAL'] ?>" placeholder="" id="txtsectorcomercial" onkeypress="return soloLetras(event);" onkeyup="mayus(this);" >
                                             <br>
                                             <label for="">direccion</label>
                                             <input type="text" class="form-control" name="direccion" required value="<?php echo $filas['DIRECCION'] ?>" placeholder="" id="txtdireccionproveedor"  onkeyup="mayus(this);" >
                                             <br>
                                             <label for="">Telefono</label>
                                             <input type="number" class="form-control" name="telefono" required value="<?php echo $filas['TELEFONO'] ?>" placeholder="" id="txttelefono"   >
                                             <br>
                                             <label for="">Correo</label>
                                             <input type="email" class="form-control" name="correo" required value="<?php echo $filas['CORREO'] ?>" placeholder="" id="txtcorreo"  >
                                             <br>   
                                           </div>
                                <!-- Fin Cuerpo del modal Modal -->

                                <!-- pie del modal -->
                                <div class="modal-footer">
                                <button type="submit" name="accion" value="editar" class="btn btn-primary" onclick="return confirm('¿Desea editar el proveedor?')">Guardar</button>
                                  <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                                </div>
                              </form>
                                  <!-- Fin pie del modal -->
                                  <form action="" method="post">
                              </div>
                            </div>
                          </div>
                          <!-- fin boton editar -->
                          <input type="hidden" name="id_proveedor"  value="<?php echo $filas['ID_PROVEEDOR'] ?>">
                      <button  value="eliminar" name="accion" 
                        onclick="return confirm('¿Quieres eliminar este dato?')"
                        type="submit" class="btn btn-danger " data-id="19">
                        <i class="fas fa-trash-alt"></i>
                    </button></form>
</td>
                         
                    </td>
                                         <td ><?php echo $filas['ID_PROVEEDOR'] ?></td>
                                         <td><?php echo $filas['NOMBRE'] ?></td>
                                         <td><?php echo $filas['NOMBRE_REFERENCIA'] ?></td>
                                         <td><?php echo $filas['SECTOR_COMERCIAL'] ?></td>
                                         <td><?php echo $filas['DIRECCION'] ?></td>
                                         <td><?php echo $filas['TELEFONO'] ?></td>
                                         <td><?php echo $filas['CORREO'] ?></td>
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
</body>
<script type="text/javascript" src="../../js/evitar_reenvio.js"></script>
</html>

<script type="text/javascript">
  
        function mayus(e) {
          e.value = e.value.toUpperCase();
         }
    </script>

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

<script>
      function soloLetras(e){
       key = e.keyCode || e.which;
       tecla = String.fromCharCode(key).toLowerCase();
       letras = " áéíóúabcdefghijklmnñopqrstuvwxyz";
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
  </script>
