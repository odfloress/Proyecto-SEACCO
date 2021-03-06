<?php
session_start();
if(!isset($_SESSION['usuario'])){
 
        header('Location: ../../_login.php');
        session_unset();
        session_destroy();
        die();
        
}
include '../../controladores/crud_administradores.php';


?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Usuarios</title>
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
          <div class="col-sm-2">
            <h1></h1>
            <!-- Inicio de modal de agregar -->
<div class="container mt-3">
        <h3>Usuarios</h3> <br>  
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#myModal">
            Nuevo usuario
        </button>
        <!-- El Modal -->
    <div class="modal" id="myModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Encabezado del modal -->
                <!-- <form action="" method="post"> -->
                <form action="" method="post" enctype="multipart/form-data">
                <div class="modal-header">
                    <h4 class="modal-title">Nuevo usuario</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <!-- Fin Encabezado del modal -->

                <!-- Cuerpo del modal Modal -->
                <div class="modal-body">
                    
                    <!-- Inicio del select de rol -->
                    <label for="sel1" class="form-label">Rol:</label>
                    <select  class="form-select"  name="rol" required >
                        <option></option>
                        <?php
                        include '../../conexion/conexion.php';
                        $roles = "SELECT * FROM tbl_roles ORDER BY ID_ROL";
                        $roles2 = mysqli_query($conn, $roles);
                        if (mysqli_num_rows($roles2) > 0) {
                            while($row = mysqli_fetch_assoc($roles2))
                            {
                              $id = $row['ID_ROL'];
                              $rol =$row['ROL'];
                        ?>
                          <option value="<?php  echo $id; ?>"><?php echo $rol?></option>
                          <?php
                           }}// finaliza el if y el while
                           ?>
                   </select>
                    <!-- Inicio del select de rol -->
                    <!-- Inicio del select deL estado -->
                    <label for="sel1" class="form-label">Estado:</label>
                    <select class="form-select"  name="estado" required >
                        <option></option>
                        <?php
                        include '../../conexion/conexion.php';
                        $estados = "SELECT * FROM tbl_estado_usuario ORDER BY ID_ESTADO_USUARIO";
                        $estados2 = mysqli_query($conn, $estados);
                        if (mysqli_num_rows($estados2) > 0) {
                            while($row = mysqli_fetch_assoc($estados2))
                            {
                              $id = $row['ID_ESTADO_USUARIO'];
                              $estado =$row['NOMBRE_ESTADO'];
                        ?>
                          <option value="<?php  echo $id; ?>"><?php echo $estado?></option>
                          <?php
                           }}// finaliza el if y el while
                           ?>
                   </select>
                    <!-- Inicio del select deL estado -->
                    


                    <label for="">Nombres:</label>
                    <input type="text" class="form-control" name="nombre" required value="" placeholder="" autocomplete="on" onkeyup="mayus(this);" maxlength="30">

                    <label for="">Apellidos:</label>
                    <input type="text" class="form-control" name="apellido" required value="" placeholder="" autocomplete="off" onkeyup="mayus(this);" maxlength="30" >

                    <label for="">Usuario:</label>
                    <input type="text" class="form-control" name="usuario" required value="" autocomplete = "off"  onkeypress="return soloLetras(event);" minlength="3" maxlength="20" onkeyup="mayus(this);" required onblur="quitarespacios(this);" onkeydown="sinespacio(this);">

                    <label for="">Contrase??a:</label>
                    <input type="password" class="form-control" name="contrasena" title="una mayuscula, minuscula, 8 caracteres, un 1 numero  " value="" minlength="8" maxlength="30" required onblur="quitarespacios(this);" onkeyup="sinespacio(this);" pattern="(?=.*[\d])(?=.*[a-z])(?=.*[A-Z]).{8,}">
                  
                    <label for="">Correo:</label>
                    <input type="email" class="form-control" name="correo" required value="" autocomplete="off" placeholder="" > 
                     
                    <label for="pwd" class="form-label">Genero:</label>
                    <select style="background-color:rgb(240, 244, 245);" value="<?php echo "$genero"; ?>" class="form-select" id="lista1" name="genero" required >
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
                    <!-- <label for="">Genero:</label>
                    <select class="form-select"  name="genero" required >
                      <option value=""></option>
                      <option value="M">M</option>
                      <option value="F">F</option>
                    </select> -->

                    <label for="">DNI:</label>
                    <input type="text" class="form-control" name="dni" required value="" autocomplete="off" minlength="15" maxlength="15"  onkeypress="return solonumero(event)" placeholder="0000-0000-000000" >

                    <label for="pwd" class="form-label">Profesi??n:</label>
                      <select style="background-color:rgb(240, 244, 245);" value="<?php echo "$profesion"; ?>" class="form-select" id="lista1" name="profesion" required >
                            <?php
                                include 'conexion/conexion.php';
                                $profesion = "SELECT * FROM tbl_profesiones ORDER BY ID_PROFESION";
                                $profesion2 = mysqli_query($conn, $profesion);
                                if (mysqli_num_rows($profesion2) > 0) {
                                    while($row = mysqli_fetch_assoc($profesion2))
                                    {
                                    $id_profesion = $row['ID_PROFESION'];
                                    $profesion3 =$row['PROFESION'];
                            ?>
                              <option value="<?php  echo $id_profesion ?>"><?php echo $profesion3 ?></option>
                              <?php
                              }}// finaliza el if y el while
                              ?>
                      </select>
                    <!-- <label for="">Profesion:</label>
                    <input type="text" class="form-control" name="profesion" required value="" autocomplete="off" onkeyup="mayus(this);" maxlength="30" > -->

                    <label for="">Direcci??n:</label>
                    <input type="text" class="form-control" name="direccion" required value="" autocomplete="off" onkeyup="mayus(this);" maxlength="70" >

                    <label for="">Telefono:</label>
                    <input type="number" autocomplete="off" class="form-control" name="celular" required value="" placeholder="" >
                    
                    <label for="">Referencia:</label>
                    <input type="text" class="form-control" name="referencia" required value="" autocomplete="off" onkeyup="mayus(this);" maxlength="30" >

                    <label for="">Telefono de referencia:</label>
                    <input type="number" autocomplete="off"  class="form-control" name="celular_referencia" required value="" placeholder="" >

                    <label for="">Experiencia laboral:</label>
                    <input type="text" class="form-control" name="experiencia_laboral" required value="" autocomplete="off" onkeyup="mayus(this);" maxlength="30" >

                    <label for="">Curriculum:</label>
                    <input type="file" class="form-control" name="curriculum"  value="" placeholder="Opcional" >

                    <label for="">Foto:</label>
                    <input type="file" class="form-control" name="foto" value="" placeholder="Opcional" >

                    <label for="pwd" class="form-label">Area:</label>
                      <select style="background-color:rgb(240, 244, 245);" value="<?php echo "$area"; ?>" class="form-select" id="lista1" name="area" required >
                              <?php
                                  include 'conexion/conexion.php';
                                  $area = "SELECT * FROM tbl_areas ORDER BY ID_AREA";
                                  $area2 = mysqli_query($conn, $area);
                                  if (mysqli_num_rows($area2) > 0) {
                                      while($row = mysqli_fetch_assoc($area2))
                                      {
                                      $id_area = $row['ID_AREA'];
                                      $area3 =$row['AREA'];
                              ?>
                                <option value="<?php  echo $id_area ?>"><?php echo $area3 ?></option>
                                <?php
                                }}// finaliza el if y el while
                                ?>
                        </select>
                    
                
                </div>
                <!-- Fin Cuerpo del modal Modal -->               
                <!-- pie del modal -->
                <div class="modal-footer">
      	            <button type="submit" name="accion" value="agregar" class="btn btn-primary" onclick="return confirm('??Desea agregar un usuario?')">Agregar</button>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                </div>
                <!-- Fin pie del modal -->
                </form>
            </div>
        </div>
    </div>
    <!-- Fin  de modal de agregar --> <br>

    </div>


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
                <h3 class="card-title">Usuarios</h3>
                
              </div>
              
              <!-- /.card-header -->
              <div class="card-body ">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                  <th>Acciones</th>
                  <th>Id</th>
                  <th>Rol</th>
                  <th>estado</th>
                  <th>Nombre</th>
                  <th>Apellido</th>
                  <th>Usuario</th>
                  <th>Correo</th>
                  <th>Genero</th>                  
                  <th>DNI</th>
                  <th>Profesion</th>
                  <th>Direcci??n</th>
                  <th>Telefono</th>
                  <th>Referencia</th>
                  <th>Telefono referencia</th>
                  <th>Experiencia laboral</th>
                  <th>Curriculum</th>                                                    
                  <th>Foto</th>
                  <th>Area</th>
                  
                  </tr>
                  </thead>
                  <tbody>
                    <?php while ($filas= mysqli_fetch_assoc($result)){

                     ?>
                  <tr>
                  <td>  
                        <!-- inicio boton editar -->
                      <button type="button"  class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#myModal2<?php echo $filas['ID_USUARIO'] ?>" >
                      <i class="fas fa-pencil-alt"></i>
                      </button>

                          <!-- El Modal -->
                          <div class="modal" id="myModal2<?php echo $filas['ID_USUARIO'] ?>">
                            <div class="modal-dialog">
                              <div class="modal-content">

                                <!-- Encabezado del modal -->
                                <div class="modal-header">
                                  <h4 class="modal-title">Editar usuario</h4>
                                  <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <!-- Fin Encabezado del modal -->


                                <!-- Cuerpo del modal Modal -->
                <!-- <form action="" method="post"> -->
                <form action="" method="post" enctype="multipart/form-data">
                              
                <div class="modal-body">
                    <label for="">Id del Usuario:</label>
                    <input type="text" class="form-control" readonly name="id_usuario" required value="<?php echo $filas['ID_USUARIO'] ?>"  placeholder=""  >
                    <!-- Inicio del select de rol -->
                    <label for="sel1" class="form-label">Rol:</label>
                    <select  class="form-select"  name="rol" required >
                        <option value="<?php echo $filas['ID_ROL']; ?>"> <?php echo $filas['ROL']; ?></option>
                        <?php
                        include '../../conexion/conexion.php';
                        $roles = "SELECT * FROM tbl_roles ORDER BY ID_ROL";
                        $roles2 = mysqli_query($conn, $roles);
                        if (mysqli_num_rows($roles2) > 0) {
                            while($row = mysqli_fetch_assoc($roles2))
                            {
                              $id = $row['ID_ROL'];
                              $rol =$row['ROL'];
                        ?>
                          <option value="<?php  echo $id; ?>"><?php echo $rol?></option>
                          <?php
                           }}// finaliza el if y el while
                           ?>
                   </select>
                    <!-- Inicio del select de rol -->
                    <!-- Inicio del select deL estado -->
                    <label for="sel1" class="form-label">Estado:</label>
                    <select class="form-select"  name="estado" required >
                    <option value="<?php echo $filas['ID_ESTADO_USUARIO']; ?>"> <?php echo $filas['NOMBRE_ESTADO']; ?></option>
                       
                        <?php
                        include '../../conexion/conexion.php';
                        $estados = "SELECT * FROM tbl_estado_usuario ORDER BY ID_ESTADO_USUARIO";
                        $estados2 = mysqli_query($conn, $estados);
                        if (mysqli_num_rows($estados2) > 0) {
                            while($row = mysqli_fetch_assoc($estados2))
                            {
                              $id = $row['ID_ESTADO_USUARIO'];
                              $estado =$row['NOMBRE'];
                        ?>
                          <option value="<?php  echo $id; ?>"><?php echo $estado?></option>
                          <?php
                           }}// finaliza el if y el while
                           ?>
                   </select>
                    <!-- Inicio del select deL estado -->
                    
                    <label for="">Nombres:</label>
                    <input type="text" class="form-control" name="nombre" required value="<?php echo $filas['NOMBRE'] ?>"  autocomplete="off" onkeyup="mayus(this);" maxlength="30" >

                    <label for="">Apellidos:</label>
                    <input type="text" class="form-control" name="apellido" required value="<?php echo $filas['APELLIDO'] ?>" autocomplete="off" onkeyup="mayus(this);" maxlength="30" >

                    <label for="">Usuario:</label>
                    <input type="text" readonly class="form-control" name="usuario" required value="<?php echo $filas['USUARIO'] ?>" placeholder="" >

                    
                    

                    <label for="">Correo:</label>
                    <input type="email" readonly class="form-control" name="correo" required value="<?php echo $filas['CORREO'] ?>" placeholder="" >
                     
                    <label for="">Genero:</label>
                    <select class="form-select"  name="genero" required >
                    <option value="<?php echo $filas['ID_GENERO']; ?>"> <?php echo $filas['GENERO']; ?></option>
                       
                        <?php
                        include '../../conexion/conexion.php';
                        $generos = "SELECT * FROM tbl_generos ORDER BY ID_GENERO";
                        $generos2 = mysqli_query($conn, $generos);
                        if (mysqli_num_rows($generos2) > 0) {
                            while($row = mysqli_fetch_assoc($generos2))
                            {
                              $id_genero = $row['ID_GENERO'];
                              $genero =$row['GENERO'];
                        ?>
                          <option value="<?php  echo $id_genero; ?>"><?php echo $genero?></option>
                          <?php
                           }}// finaliza el if y el while
                           ?>
                   </select>
                    

                    <label for="">DNI:</label>
                    <input type="text" class="form-control" name="dni" required value="<?php echo $filas['DNI'] ?>" autocomplete="off" minlength="15" maxlength="15"  onkeypress="return solonumero(event)" placeholder="0000-0000-000000" >

                    <label for="">Profesion:</label>
                    <select class="form-select"  name="profesion" required >
                    <option value="<?php echo $filas['ID_PROFESION']; ?>"> <?php echo $filas['PROFESION']; ?></option>
                       
                        <?php
                        include '../../conexion/conexion.php';
                        $profesion = "SELECT * FROM tbl_profesiones ORDER BY ID_PROFESION";
                        $profesion2 = mysqli_query($conn, $profesion);
                        if (mysqli_num_rows($profesion2) > 0) {
                            while($row = mysqli_fetch_assoc($profesion2))
                            {
                              $id_profesion = $row['ID_PROFESION'];
                              $profesion3 =$row['PROFESION'];
                        ?>
                          <option value="<?php  echo $id_profesion; ?>"><?php echo $profesion3?></option>
                          <?php
                           }}// finaliza el if y el while
                           ?>
                   </select>

                    <label for="">Direcci??n:</label>
                    <input type="text" class="form-control" name="direccion" required value="<?php echo $filas['DIRECCION'] ?>" autocomplete="off" onkeyup="mayus(this);" maxlength="70" >

                    <label for="">Telefono:</label>
                    <input type="number" class="form-control" name="celular" required value="<?php echo $filas['CELULAR'] ?>" placeholder="" >
                    
                    <label for="">Referencia:</label>
                    <input type="text" class="form-control" name="referencia" required value="<?php echo $filas['REFERENCIA'] ?>" autocomplete="off" onkeyup="mayus(this);" maxlength="70" >

                    <label for="">Telefono de referencia:</label>
                    <input type="number" class="form-control" name="celular_referencia" required value="<?php echo $filas['CEL_REFERENCIA'] ?>" placeholder="" >

                    <label for="">Experiencia laboral:</label>
                    <input type="text" class="form-control" name="experiencia_laboral" required value="<?php echo $filas['EXPERIENCIA_LABORAL'] ?>" autocomplete="off" onkeyup="mayus(this);" maxlength="30" >

                    <label for="">Curriculum:</label>
                    <input type="file" class="form-control" name="curriculum"  value="<?php echo $filas['CURRICULUM'] ?>" placeholder="" >

                    <label for="">Foto:</label>
                    <input type="file" class="form-control" name="foto" value="<?php echo $filas['FOTO'] ?>" placeholder="" >

                     
                    <label for="pwd" class="form-label">Area:</label>
                    <select class="form-select"  name="area" required >
                      <option value="<?php echo $filas['ID_AREA']; ?>"> <?php echo $filas['AREA']; ?></option>

                      <?php
                        include '../../conexion/conexion.php';
                        $area = "SELECT * FROM tbl_areas ORDER BY ID_AREA";
                        $area2 = mysqli_query($conn, $area);
                        if (mysqli_num_rows($profesion2) > 0) {
                            while($row = mysqli_fetch_assoc($area2))
                            {
                              $id_area = $row['ID_AREA'];
                              $area3 =$row['AREA'];
                        ?>
                          <option value="<?php  echo $id_area; ?>"><?php echo $area3?></option>
                          <?php
                           }}// finaliza el if y el while
                           ?>

                    </select>
                </div>
                <!-- Fin Cuerpo del modal Modal -->


                                <!-- pie del modal -->
                                <div class="modal-footer">
                                <button type="submit" name="accion" value="editar" class="btn btn-primary" onclick="return confirm('??Desea editar la categoria?')">Guardar</button>
                                  <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                                </div>
                                </form>
                                  <!-- Fin pie del modal -->
                                  <form action="" method="post">
                              </div>
                            </div>
                          </div>
                          <!-- fin boton editar -->
                          
                          
                            <input type="hidden" name="id_usuario"  value="<?php echo $filas['ID_USUARIO'] ?>">
                            
                          
                      <button  value="eliminar" name="accion" 
                        onclick="return confirm('??Quieres eliminar este dato?')"
                        type="submit" class="btn btn-danger ">
                        <i class="fas fa-trash-alt"></i>
                    </button></form>
                    
</td>
                     <td ><?php echo $filas['ID_USUARIO'] ?></td>
                     <td><?php echo $filas['ROL'] ?></td>
                     <td><?php echo $filas['NOMBRE_ESTADO'] ?></td>
                     <td><?php echo $filas['NOMBRE'] ?></td>
                     <td><?php echo $filas['APELLIDO'] ?></td>
                     <td><?php echo $filas['USUARIO'] ?></td>
                     <td><?php echo $filas['CORREO'] ?></td>
                     <td><?php echo $filas['GENERO'] ?></td>
                     <td><?php echo $filas['DNI'] ?></td>
                     <td><?php echo $filas['PROFESION'] ?></td>
                     <td><?php echo $filas['DIRECCION'] ?></td>
                     <td><?php echo $filas['CELULAR'] ?></td>
                     <td><?php echo $filas['REFERENCIA'] ?></td>
                     <td><?php echo $filas['CEL_REFERENCIA'] ?></td>
                     <td><?php echo $filas['EXPERIENCIA_LABORAL'] ?></td>
                     <td><a href="<?php echo $filas['CURRICULUM'] ?>" download>Descargar</a></td>                     
                     <td><img class="img-thumbnail" width="100px" src="<?php echo $filas['FOTO'] ?>" /></td>
                     <td><?php echo $filas['AREA'] ?></td>

                     
                     
                    
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
                            "collection": "Colecci??n",
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


<script>
      function soloLetras(e){
       key = e.keyCode || e.which;
       tecla = String.fromCharCode(key).toLowerCase();
       letras = " ??????????abcdefghijklmn??opqrstuvwxyz";
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


    <script type="text/javascript">
  
        function mayus(e) {
          e.value = e.value.toUpperCase();
         }
    </script>


    <script type="text/javascript">

        function sinespacio(e) {

        var cadena =  e.value;
        var limpia = "";
        var parts = cadena.split(" ");
        var length = parts.length;

          for (var i = 0; i < length; i++) {
              nuevacadena = parts[i];
              subcadena = nuevacadena.trim();

          if(subcadena != "") {
             limpia += subcadena + " ";
                }
          }
        limpia = limpia.trim();
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