<?php
session_start();
if(!isset($_SESSION['usuario'])){
 
        header('Location: ../iniciar_sesion/index_login.php');
        session_unset();
        session_destroy();
        die();
        
}
include '../../controladores/crud_proyectos.php';
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
               $proyecto = "SELECT * FROM tbl_ms_roles_ojetos WHERE ID_ROL='$id_rol7' and ID_OBJETO=13 and PERMISO_CONSULTAR=0";
               $proyecto2 = mysqli_query($conn, $proyecto);
               if (mysqli_num_rows($proyecto2) > 0)
               {
                header('Location: ../../vistas/tablero/vista_perfil.php');
                die();
               }else{
                $role = "SELECT * FROM tbl_ms_roles_ojetos WHERE ID_ROL='$id_rol7' and ID_OBJETO=13 and PERMISO_CONSULTAR=1";
                $roless = mysqli_query($conn, $role);
                if (mysqli_num_rows($roless) > 0){}
                else{
                  header('Location: ../../vistas/tablero/vista_perfil.php');
                  die();
                }
               }
               // inicio inserta en la tabla bitacora
               $sql = "INSERT INTO tbl_bitacora (USUARIO, ACCION, OBSERVACION)
               VALUES ('$usuario1[usuario]', 'CONSULTO', 'CONSULTO LA PANTALLA ADMINISTRATIVA DE PROYECTOS')";
               if (mysqli_query($conn, $sql)) {} else {}
               // fin inserta en la tabla bitacora
           

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Proyectos</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

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
        <h3>Proyectos</h3> <br> 
        <?php 
      include '../../conexion/conexion.php';
      $proyecto = "SELECT * FROM tbl_ms_roles_ojetos WHERE ID_ROL='$id_rol7' and ID_OBJETO=13 and PERMISO_INSERCION=1";
      $proyecto2 = mysqli_query($conn, $proyecto);
      if (mysqli_num_rows($proyecto2) > 0)
       {
         echo '<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#myModal">
                    Nuevo Proyecto
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
                    <h4 class="modal-title">Nuevo proyecto</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <!-- Fin Encabezado del modal -->

                <!-- Cuerpo del modal Modal -->
                <form action="" method="post">
                <div class="modal-body">
                      
                  <label for="">Selecciona el nombre Cliente</label>
                  <select style="background-color:rgb(240, 244, 245);" value="<?php echo "$id_cliente"; ?>" class="form-select" id="lista1" name="id_cliente" required >
                        <?php
                            include 'conexion/conexion.php';
                            $cliente = "SELECT * FROM tbl_clientes ORDER BY ID_CLIENTE";
                            $cliente2 = mysqli_query($conn, $cliente);
                            if (mysqli_num_rows($cliente2) > 0) {
                                while($row = mysqli_fetch_assoc($cliente2))
                                {
                                $id_clientes = $row['ID_CLIENTE'];
                                $cliente3 =$row['NOMBRE_CLIENTE'];
                         ?>
                          <option value="<?php  echo $id_clientes ?>"><?php echo $cliente3 ?></option>
                          <?php
                    }}// finaliza el if y el while
                    ?>
                   </select>
                  </div>
                  <div class="col">
                    <label for="">Selecciona el nombre Encargado</label>
                    <select style="background-color:rgb(240, 244, 245);" value="<?php echo "$id_usuario;" ?>" class="form-select" id="lista1" name="id_usuario" required >
                        <?php
                            include 'conexion/conexion.php';
                            $idusuario= "SELECT * FROM tbl_usuarios ORDER BY ID_USUARIO";
                            $idusuario2 = mysqli_query($conn, $idusuario);
                            if (mysqli_num_rows($idusuario2) > 0) {
                                while($row = mysqli_fetch_assoc($idusuario2))
                                {
                                $id_usuario = $row['ID_USUARIO'];
                                $idusuario3 =$row['NOMBRE'];
                         ?>
                          <option value="<?php  echo $id_usuario ?>"><?php echo $idusuario3 ?></option>
                          <?php
                           }}// finaliza el if y el while
                           ?>
                   </select>
                  </div>
                  <div class="col"> 
                  <label for="" >Selecciona nombre del Estado</label>
                  <select style="background-color:rgb(240, 244, 245);" value="<?php echo "$id_estado"; ?>" class="form-select" id="lista1" name="id_estado" required >
                        <?php
                            include 'conexion/conexion.php';
                            $estado = "SELECT * FROM tbl_estados_proyectos ORDER BY ID_ESTADOS";
                            $estado2 = mysqli_query($conn, $estado);
                            if (mysqli_num_rows($estado2) > 0) {
                                while($row = mysqli_fetch_assoc($estado2))
                                {
                                $id_estado = $row['ID_ESTADOS'];
                                $estado3 =$row['ESTADO_PROYECTO'];
                         ?>
                          <option value="<?php  echo $id_estado ?>"><?php echo $estado3 ?></option>
                          <?php
                           }}// finaliza el if y el while
                           ?>
                   </select>
                </div>  
                <div class="col">
                    <label for="">Nombre Proyecto</label>
                    <input class="form-control" type="text" name="nombre" value="<?php echo $nombre; ?>"  autocomplete="off" id="" required onkeypress="return soloLetras(event);" minlength="3" maxlength="255" onkeyup="mayus(this);">
                    <br>
                    <label for="">Descripción proyecto</label>
                    <input class="form-control" type="text" name="descripcion" id="" required value="<?php echo $descripcion; ?>" autocomplete="off" onkeypress="return soloLetras(event);" minlength="3" maxlength="300" onkeyup="mayus(this);" >
                    <br>
                    <label for="">Departamento del proyecto</label>
                    <select style="background-color:rgb(240, 244, 245);" value="<?php echo "$id_departamento;" ?>" class="form-select" id="lista1" name="id_departamento" required >
                        <?php
                            include 'conexion/conexion.php';
                            $departamento = "SELECT * FROM tbl_departamentos ORDER BY ID_DEPARTAMENTO";
                            $departamento2 = mysqli_query($conn, $departamento);
                            if (mysqli_num_rows($departamento2) > 0) {
                                while($row = mysqli_fetch_assoc($departamento2))
                                {
                                $id_departamento = $row['ID_DEPARTAMENTO'];
                                $departamento3 =$row['DEPARTAMENTO'];
                         ?>
                          <option value="<?php  echo $id_departamento ?>"><?php echo $departamento3 ?></option>
                          <?php
                           }}// finaliza el if y el while
                           ?>
                   </select>
                </div>  
                <div class="col">
                    <label for="">Ubicación Proyecto</label>
                    <input class="form-control" type="text" name="ubicacion" value="<?php echo $ubicacion; ?>" autocomplete="off"  id="" required onkeypress="return soloLetras(event);" minlength="3" maxlength="255" onkeyup="mayus(this);">
                    <br>
                    <label for="">Fecha inicio</label>
                    <input class="form-control" type="Date" name="fecha_inicio" value="<?php echo $fecha_inicio; ?>" autocomplete="off" id="" required> 
                    <br>
                    <label for="">Fecha final</label>
                    <input class="form-control" type="Date" name="fecha_final" value="<?php echo $fecha_final; ?>" autocomplete="off" id="" required>
                    <br>
        
      </div>
                <!-- Fin Cuerpo del modal Modal -->
                <!-- pie del modal -->
                <div class="modal-footer">
      	            <button type="submit" name="accion" value="agregar" class="btn btn-primary" onclick="return confirm('¿Desea agregar el proyecto?')">Agregar</button>
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
                <h3 class="card-title">Proyectos</h3>
                
              </div>
              
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                  <th>Acciones</th>
                    <th>Id proyecto</th>
                    <th>Cliente</th>
                    <th>Encargado</th>
                    <th>Estado</th>
                    <th>Proyecto</th>
                    <th>Descripción</th>
                    <th>Departamento</th>
                    <th>Ubicación</th>
                    <th>Fecha inicio</th>
                    <th>Fecha Final</th>
                    
                  </tr>
                  </thead>
                  <tbody>
                  <?php while ($filas= mysqli_fetch_assoc($result)){

                  ?>
                  <tr>
                  <td>
                  <?php 
                          include '../../conexion/conexion.php';
                          $proyecto = "SELECT * FROM tbl_ms_roles_ojetos WHERE ID_ROL='$id_rol7' and ID_OBJETO=13 and PERMISO_ACTUALIZACION=1";
                          $proyecto2 = mysqli_query($conn, $proyecto);
                          if (mysqli_num_rows($proyecto2) > 0)
                          {?>
                        <!-- inicio boton editar -->
                        <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#myModal2<?php echo $filas['ID_PROYECTO'] ?>">
                        <i class="fas fa-pencil-alt"></i>
                        </button>
                        <?php 
                          }
                        ?>
                            <!-- El Modal -->
                            <div class="modal" id="myModal2<?php echo $filas['ID_PROYECTO'] ?>">
                            <div class="modal-dialog">
                                <div class="modal-content">

                                <!-- Encabezado del modal -->
                                <div class="modal-header">
                                    <h4 class="modal-title">Editar proyecto</h4>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <!-- Fin Encabezado del modal -->


                            <!-- Cuerpo del modal Modal -->
                            <form action="" method="post">
                            <div class="modal-body">
                            <input type="hidden" name="nombre_anterior" value="<?php echo $filas['NOMBRE_PROYECTO'] ?>">  
                   <label for="">Id Proyecto</label>
                    <input class="form-control" type="number" name="id_proyecto" id="" readonly required value="<?php echo $filas['ID_PROYECTO'] ?>">
                   <br>            
                 <label for="">Nombre Cliente</label>
                 <input type="hidden" name="id_usuario" value="<?php echo $filas['ID_CLIENTE']?>">
                 <select class="form-select"  name="id_cliente" required value="<?php echo $filas['NOMBRE_CLIENTE'] ?>"<?php echo $filas['NOMBRE_CLIENTE'] ?> >
                  <?php
                        include '../../conexion/conexion.php';
                        $cliente = "SELECT * FROM tbl_clientes ORDER BY ID_CLIENTE";
                        $cliente2 = mysqli_query($conn, $cliente);
                        if (mysqli_num_rows($cliente2) > 0) {
                            while($row = mysqli_fetch_assoc($cliente2))
                            {
                              $id_cliente= $row['ID_CLIENTE'];
                              $cliente3 =$row['NOMBRE_CLIENTE'];
                        ?>
                          <option value="<?php  echo $id_cliente; ?>" selected ><?php echo $cliente3?></option>
                          <?php
                           }}// finaliza el if y el while
                           ?>
                   </select>
                   <label for="">Nombre Encargado</label>
                   <input type="hidden" name="id_usuario" value="<?php echo $filas['ID_USUARIO']?>">
                    <select class="form-select"  name="id_usuario"  required value="<?php echo $filas['NOMBRE']?>" >
                   <?php
                        include '../../conexion/conexion.php';
                        $idusuario = "SELECT * FROM tbl_usuarios ORDER BY ID_USUARIO";
                        $idusuario2 = mysqli_query($conn, $idusuario);
                        if (mysqli_num_rows($idusuario2) > 0) {
                            while($row = mysqli_fetch_assoc($idusuario2))
                            {
                              $id_usuario = $row['ID_USUARIO'];
                              $idusuario3 =$row['NOMBRE'];
                        ?>
                          <option value="<?php  echo $id_usuario; ?>" selected><?php echo $idusuario3;?></option>
                          <?php
                           }}// finaliza el if y el while
                           ?>
                   </select>
                    <label for="">Nombre Estado</label>
                    <input type="hidden" name="id_estado" value="<?php echo $filas['ID_ESTADOS']?>">
                    <select class="form-select"  name="id_estado"  value="<?php echo $filas['ESTADO_PROYECTO']?>" required >
                    
                    <?php
                            include './../conexion/conexion.php';
                            $estado = "SELECT * FROM tbl_estados_proyectos ORDER BY ID_ESTADOS";
                            $estado2 = mysqli_query($conn, $estado);
                            if (mysqli_num_rows($estado2) > 0) {
                                while($row = mysqli_fetch_assoc($estado2))
                                {
                                $id_estado = $row['ID_ESTADOS'];
                                $estado3 =$row['ESTADO_PROYECTO'];
                         ?>
                          <option value="<?php  echo $id_estado ?>" selected ><?php echo $estado3; ?></option>
                          <?php
                           }}// finaliza el if y el while
                           ?>
                   </select>
                </div>
                <div class="col"> 
                    <label for="">Nombre Proyecto</label>
                    <input class="form-control" type="text" name="nombre" id="" required value="<?php echo $filas['NOMBRE_PROYECTO'] ?>" autocomplete="off" onkeypress="return soloLetras(event);" minlength="3" maxlength="255" onkeyup="mayus(this);" >
                    <br>
                    <label for="">Descripción proyecto</label>
                    <input class="form-control" type="text" name="descripcion" id="" required value="<?php echo $filas['DESCRIPCION'] ?>" autocomplete="off" onkeypress="return soloLetras(event);" minlength="3" maxlength="300" onkeyup="mayus(this);" >
                    <br>
                    <label for="">Departamento del proyecto</label>
                    <input type="hidden" name="id_departamento" value="<?php echo $filas['ID_DEPARTAMENTO']?>">
                    <select style="background-color:rgb(240, 244, 245);" class="form-select" id="lista1" name="id_departamento" value="<?php echo $filas['DEPARTAMENTO']?>" required >
                    
                        <?php
                        include '../../conexion/conexion.php';
                        $departamento = "SELECT * FROM tbl_departamentos ORDER BY ID_DEPARTAMENTO";
                          $departamento2 = mysqli_query($conn, $departamento);
                          if (mysqli_num_rows($departamento2) > 0) {
                          while($row = mysqli_fetch_assoc($departamento2))
                                {
                                $id_departamento = $row['ID_DEPARTAMENTO'];
                                $departamento3 =$row['DEPARTAMENTO'];
                         ?>
                          <option value="<?php  echo $id_departamento ?>" selected ><?php echo $departamento3; ?></option>
                          <?php
                           }}// finaliza el if y el while
                           ?>
                   </select>
                </div>  
                <div class="col">
                    <label for="">Ubicación Proyecto</label>
                    <input class="form-control" type="text" name="ubicacion" id="" required value="<?php echo $filas['UBICACION'] ?>" autocomplete="off" onkeypress="return soloLetras(event);" minlength="3" maxlength="255" onkeyup="mayus(this);"  >
                    <br>
                    <label for="">Fecha inicio</label>
                    <input class="form-control" type="Date" name="fecha_inicio" id="" required value="<?php echo $filas['FECHA_INICIO'] ?>">
                    <br>
                    <label for="">Fecha final</label>
                    <input class="form-control" type="Date" name="fecha_final" id="" required value="<?php echo $filas['FECHA_FINAL'] ?>">
                    <br>
        
      </div>
                            <!-- Fin Cuerpo del modal Modal -->

                                <!-- pie del modal -->
                                <div class="modal-footer">
                                <button <button type="submit" name="accion" value="editar" class="btn btn-primary" onclick="return confirm('¿Desea editar el proyecto?')">Guardar</button>
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
                          $proyecto = "SELECT * FROM tbl_ms_roles_ojetos WHERE ID_ROL='$id_rol7' and ID_OBJETO=13 and PERMISO_ELIMINACION=1";
                          $proyecto2 = mysqli_query($conn, $proyecto);
                          if (mysqli_num_rows($proyecto2) > 0)
                          {?>
                            <input type="hidden" name="id_proyecto"  value="<?php echo $filas['ID_PROYECTO'] ?>">
                            <input type="hidden" name="nombre_anterior" value="<?php echo $filas['NOMBRE_PROYECTO'] ?>">
                    <button  value="eliminar" name="accion" 
                        onclick="return confirm('¿Quieres eliminar este dato?')"
                        type="submit" class="btn btn-danger " data-id="19">
                        <i class="fas fa-trash-alt"></i>
                    </button> 
                    </button>
                    <?php 
                          }
                        ?>
                  </form>
</td>
                            <td ><?php echo $filas['ID_PROYECTO'] ?></td>
                            <td><?php echo $filas['NOMBRE_CLIENTE'] ?></td>
                            <td><?php echo $filas['NOMBRE'] ?></td>
                            <td><?php echo $filas['ESTADO_PROYECTO'] ?></td>
                            <td><?php echo $filas['NOMBRE_PROYECTO'] ?></td>
                            <td><?php echo $filas['DESCRIPCION'] ?></td>
                            <td><?php echo $filas['DEPARTAMENTO'] ?></td>
                            <td><?php echo $filas['UBICACION'] ?></td>
                            <td><?php echo $filas['FECHA_INICIO'] ?></td>
                            <td><?php echo $filas['FECHA_FINAL'] ?></td>
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