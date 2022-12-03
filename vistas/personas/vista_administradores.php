<?php
session_start();
if(!isset($_SESSION['usuario'])){
 
        header('Location: ../../_login.php');
        session_unset();
        session_destroy();
        die();
        
}
include '../../controladores/crud_administradores.php';
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
               $profesion = "SELECT * FROM tbl_ms_roles_ojetos WHERE ID_ROL='$id_rol7' and ID_OBJETO=1 and PERMISO_CONSULTAR=0";
               $profesionn = mysqli_query($conn, $profesion);
               if (mysqli_num_rows($profesionn) > 0)
               {
                header('Location: ../../vistas/tablero/vista_perfil.php');
                die();
               }else{
                      $profesion = "SELECT * FROM tbl_ms_roles_ojetos WHERE ID_ROL='$id_rol7' and ID_OBJETO=1 and PERMISO_CONSULTAR=1";
                      $profesionn = mysqli_query($conn, $profesion);
                      if (mysqli_num_rows($profesionn) > 0){}
                      else{
                        header('Location: ../../vistas/tablero/vista_perfil.php');
                        die();
                      }
               }
                // inicio inserta en la tabla bitacora
                $sql = "INSERT INTO tbl_bitacora (USUARIO, ACCION, OBSERVACION)
                VALUES ('$usuario1[usuario]', 'CONSULTO', 'CONSULTO LA PANTALLA  ADMINISTRATIVA DE USUARIOS')";
                if (mysqli_query($conn, $sql)) {} else {}
                // fin inserta en la tabla bitacora


?>
<?php 
  include '../../conexion/conexion.php';
  $minima_contraseña = "SELECT * FROM tbl_parametros WHERE PARAMETRO = 'MIN_CONTRASENA'";
  $resultado_minimo = mysqli_query($conn, $minima_contraseña);
    while ($mostrar_minima = mysqli_fetch_assoc($resultado_minimo)){
      $parametro_min = $mostrar_minima["VALOR"];
    }

    $maxima_contraseña = "SELECT * FROM tbl_parametros WHERE PARAMETRO = 'MAX_CONTRASENA'";
  $resultado_maximo = mysqli_query($conn, $maxima_contraseña);
    while ($mostrar_maxima = mysqli_fetch_assoc($resultado_maximo)){
      $parametro_max = $mostrar_maxima["VALOR"];
    }
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
  <!-- /// para exportar en pdf /// -->
  <script type="text/javascript" src="../../js/complemento_1_jspdf.min.js"></script>
	<script type="text/javascript" src="../../js/complemento_2_jspdf.plugin.autotable.min.js"></script>
  



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
        <!-- El Modal -->
    <div class="modal" id="myModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <!----------------------- Encabezado del modal Registro nuevo usuario-->
                <!-- <form action="" method="post"> -->
                <form action="" method="post"  class="needs-validation" novalidate enctype="multipart/form-data">
                  <div class="modal-header">
                      <h4 class="modal-title">Registro nuevo usuario</h4>
                      <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                  </div>
                  <!-- Fin Encabezado del modal -->

                 <!-- Cuerpo del modal Modal -->
                  <div class="modal-body">
                      
                      <!-- Inicio del select de rol -->
                      <label for="sel1" class="form-label">Rol:</label>
                      <select  class="form-select"  name="rol" required >
                      <option value="">Seleccione un Rol</option>
                          <?php
                          include '../../conexion/conexion.php';
                          $roles = "SELECT * FROM tbl_roles WHERE ID_ROL!=3 ORDER BY ID_ROL";
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

                      <!-- Inicio del select deL estado -->
                      <label for="sel1" class="form-label">Estado:</label>
                      <select class="form-select"  name="estado" required >
                          <option value="">Seleccione una Estado</option>
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
                      <input type="text" onkeypress="return soloLetras(event);" class="form-control" name="nombre"  required value="" placeholder="" autocomplete="on" onkeyup="mayus(this);" onkeyup="un_espacio(this);"  maxlength="30" id="campoNombre">
                                <!-- Mensaje de la validacion -->
                                <div class="invalid-feedback">
                                    Favor ingrese un nombre
                                </div >

                      <label for="">Apellidos:</label>
                      <input type="text" onkeypress="return soloLetras(event);" class="form-control" name="apellido"  onkeyup="un_espacio(this);" required value="" placeholder="" autocomplete="off" onkeyup="mayus(this);"    maxlength="30"  >
                                <!-- Mensaje de la validacion -->
                                <div class="invalid-feedback">
                                    Favor ingrese un Apellido
                                </div >

                      <label for="">Usuario:</label>
                      <input type="text" class="form-control" name="usuario" required value="" autocomplete = "off"  onkeypress="return soloLetras(event);" minlength="3" maxlength="20" onkeyup="mayus(this);" required onblur="quitarespacios(this);" onkeydown="sinespacio(this);">
                                <!-- Mensaje de la validacion -->
                                <div class="invalid-feedback">
                                    Favor ingrese un usuario valido
                                </div >

                      <label for="">Contraseña:</label>
                      <div class="col-sm-15 " >
                        <input type="password" class="form-control" name="contrasena" id="myInput" title="una mayuscula, minuscula, 8 caracteres, un 1 numero  " value="" minlength="<?php echo $parametro_min?>" maxlength="<?php echo $parametro_max?>" 
                        onkeypress="return clave1(event);" required onblur="quitarespacioss(this);" onkeyup="sinespacioss(this);" pattern="(?=.*[\d])(?=.*[a-z])(?=.*[A-Z]).{<?php echo $parametro_min?>,}">
                        <input type="checkbox" onclick="mostrarContrasena()" > Mostrar/Ocultar
                                <div class="invalid-feedback">
                                  Ingrese una contraseña de 8 caracteres mínimo, mayusculas, numeros y/o 1 caracter especial
                                </div>
                          
                      </div>

                      <label for="">Correo:</label>
                      <input type="email" class="form-control" name="correo" required value="" autocomplete="off" placeholder="" onkeypress="return clave1(event);"> 
                                <div class="invalid-feedback">
                                  Favor ingrese un correo electrónico
                                </div>
                      
                      <label for="pwd" class="form-label">Genero:</label>
                      <select style="background-color:rgb(240, 244, 245);" value="<?php echo "$genero"; ?>" class="form-select" id="lista1" name="genero" required >
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
                      <!-- <label for="">Genero:</label>
                      <select class="form-select"  name="genero" required >
                        <option value=""></option>
                        <option value="M">M</option>
                        <option value="F">F</option>
                      </select> -->

                      <label for="">DNI:</label>
                      <input type="text" onkeyup="quitarespacios(this); sinespacio(this); " class="form-control" name="dni" required value="" autocomplete="off" minlength="13" maxlength="13" onkeypress="return solonumero(event)" 
                      required pattern="(?!0{13})^[0-9][0-9]{12}$" title="13 caracteres y no todos ceros">
                            <!-- Mensaje de la validacion -->
                            <div class="invalid-feedback">
                                    Favor ingrese un DNI sin guiones ni espacios y que contenga trece digitos
                              </div >

                      <label for="pwd" class="form-label">Profesión:</label>
                        <select style="background-color:rgb(240, 244, 245);" value="<?php echo "$profesion"; ?>" class="form-select" id="lista1" name="profesion" required >
                        <option value="">Seleccione una Profesión</option>
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

                      <label for="">Dirección:</label>
                      <textarea type="text" class="form-control" name="direccion" onkeyup="un_espacio(this);" required value="" autocomplete="off" onkeyup="mayus(this);" maxlength="255" ></textarea>
                      <div class="invalid-feedback">
                                    Ingrese la dirección de residencia actual del usuario
                              </div >

                      <label for="">Teléfono:</label>
                      <input type="text" onkeyup="quitarespacios(this); sinespacio(this); " autocomplete="off" class="form-control" name="celular" minlength="8" maxlength="8" required value="" placeholder="" required pattern="[0-9]+[1-9]+[0-9]+" title="8 caracteres y no todos ceros" onkeypress="return solonumero(event)" >
                      
                      <label for="">Referencia:</label>
                      <input type="text" onkeyup="un_espacio(this);" class="form-control" name="referencia"  autocomplete="off" onkeyup="mayus(this);" maxlength="50" 
                      >

                      <label for="">Teléfono  de referencia:</label>
                      <input type="text" onkeyup="quitarespacios(this); sinespacio(this); " autocomplete="off"  class="form-control" name="celular_referencia" minlength="8" maxlength="8"  value="" placeholder=""  pattern="[0-9]+[1-9]+[0-9]+" title="8 caracteres y no todos ceros" onkeypress="return solonumero(event)">

                      <label for="">Experiencia laboral:</label>
                      <textarea type="text" class="form-control" name="experiencia_laboral" onkeyup="un_espacio(this);" value="" autocomplete="off" onkeyup="mayus(this);" maxlength="255" required ></textarea>

                      <label for="">Currículum:</label>
                      <input type="file" class="form-control" name="curriculum"  accept=".pdf, .doxc" value="" placeholder="Opcional" required>

                      <label for="">Foto:</label>
                      <input type="file" class="form-control" name="foto" accept=".jpg, .png, .jpej, .JPEG, .JPG, .PNG" value="" placeholder="Opcional"  required>

                      <label for="pwd" class="form-label">Área:</label>
                        <select style="background-color:rgb(240, 244, 245);" value="<?php echo "$area"; ?>" class="form-select" id="lista1" name="area" required >
                        <option value="">Seleccione un Área</option>
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
                          <label for="">Fecha Entrada:</label>
                    <input class="form-control" type="Datetime-local" name="fecha_inicio" minlength="" maxlength="" id="" required value="<?php echo "$fecha_inicio" ?>">
                    
                  
                  </div>
                <!-- Fin Cuerpo del modal Modal -->               
                <!-- pie del modal -->
                <div class="modal-footer">
      	            <button type="submit" name="accion" value="agregar" class="btn btn-primary">Agregar</button>
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
                
                <!-- <h3 class="card-title">Usuarios</h3> -->
                  <form id="form" action="" method="post">
                    <div class="btn-group">
                      <?php 
                      include '../../conexion/conexion.php';
                      $area1 = "SELECT * FROM tbl_ms_roles_ojetos WHERE ID_ROL='$id_rol7' and ID_OBJETO=1 and PERMISO_INSERCION=1";
                      $area2 = mysqli_query($conn, $area1);
                      if (mysqli_num_rows($area2) > 0)
                      {
                        echo '<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#myModal">
                                    Nuevo Usuario
                                </button>';
                                          }
                                        ?> 
                              <button type="submit"  name="accion" value="reporte_pdf" class="btn btn-secondary buttons-pdf buttons-html5"  onclick="return confirm('¿Quieres generar reporte de Usuarios?')" onclick="textToPdf()"><span>Reporte PDF</span></button>
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
                  <th class="desaparecerTemporalmente1">Id</th>
                  <th class="desaparecerTemporalmente1">Rol</th>
                  <th class="desaparecerTemporalmente1">Estado</th>
                  <th class="desaparecerTemporalmente1">Nombre</th>
                  <th class="desaparecerTemporalmente1">Apellido</th>
                  <th class="desaparecerTemporalmente1">Usuario</th>
                  <th class="desaparecerTemporalmente1">Correo</th>
                  <th class="desaparecerTemporalmente1">Genero</th>                  
                  <th class="desaparecerTemporalmente1">DNI</th>
                  <th class="desaparecerTemporalmente1">Profesión</th>
                  <th class="desaparecerTemporalmente1">Dirección</th>
                  <th class="desaparecerTemporalmente1">Teléfono</th>
                  <th class="desaparecerTemporalmente">Referencia</th>
                  <th class="desaparecerTemporalmente">Teléfono Referencia</th>
                  <th class="desaparecerTemporalmente1">Experiencia laboral</th>
                  <th class="desaparecerTemporalmente">Currículum</th>                                                    
                  <th class="desaparecerTemporalmente">Foto</th>
                  <th class="desaparecerTemporalmente1">Área</th>
                  <th class="desaparecerTemporalmente1">Fecha Entrada</th>
                  <th class="desaparecerTemporalmente1">Fecha Salida</th>
                  <th class="desaparecerTemporalmente1">Motivo Salida</th>
                  
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
                          $area1 = "SELECT * FROM tbl_ms_roles_ojetos WHERE ID_ROL='$id_rol7' and ID_OBJETO=1 and PERMISO_ACTUALIZACION=1";
                          $area2 = mysqli_query($conn, $area1);
                          if (mysqli_num_rows($area2) > 0)
                          {?>
                                 <!-- inicio boton editar -->
                      <button type="button"  class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#myModal2<?php echo $filas['ID_USUARIO'] ?>" >
                      <i class="fas fa-pencil-alt"></i>
                      </button> <?php 
                          }
                        ?>
                        

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
                        $roles = "SELECT * FROM tbl_roles WHERE ID_ROL!=3 ORDER BY ID_ROL";
                        $roles2 = mysqli_query($conn, $roles);
                        if (mysqli_num_rows($roles2) > 0) {
                            while($row = mysqli_fetch_assoc($roles2))
                            {
                              $id = $row['ID_ROL'];
                              $rol =$row['ROL'];
                        ?>
                          <option value="<?php  echo $id.$rol; ?>"><?php echo $rol?></option>
                          <?php
                           }}// finaliza el if y el while
                           ?>
                   </select>
                    
                    <!-- Inicio del select deL estado -->
                    <label for="sel1" class="form-label">Estado:</label>
                    <input type="hidden" name="estado_usuario" value="<?php echo $filas['NOMBRE_ESTADO']; ?>" >
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
                              $estado =$row['NOMBRE_ESTADO'];
                        ?>
                          <option value="<?php  echo $id.$estado ?>"><?php echo $estado?></option>
                          <?php
                           }}// finaliza el if y el while
                           ?>
                   </select>
                    <!-- Inicio del select deL estado -->
                    
                    <label for="">Nombres:</label>
                    <input type="text"  hidden class="form-control" name="nombre" pattern="[A-Za-z]*" required value="<?php echo $filas['NOMBRE'] ?>"  autocomplete="off" onkeyup="mayus(this);" maxlength="30" >
                    <input type="text" onkeyup="un_espacio(this);"  class="form-control" name="nombre_anterior" pattern="[A-Za-z]*" required value="<?php echo $filas['NOMBRE'] ?>"  autocomplete="off" onkeyup="mayus(this);" maxlength="30" 
                    onkeypress="return soloLetras(event);" >

                    <label for="">Apellidos:</label>
                    <input type="text" onkeyup="un_espacio(this);" class="form-control" name="apellido" pattern="[A-Za-z]*" required value="<?php echo $filas['APELLIDO'] ?>" autocomplete="off" onkeyup="mayus(this);" maxlength="30" 
                    onkeypress="return soloLetras(event);" >

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
                          <option value="<?php  echo $id_genero.$genero; ?>"><?php echo $genero?></option>
                          <?php
                           }}// finaliza el if y el while
                           ?>
                   </select>
                    

                    <label for="">DNI:</label>
                    <input type="text" class="form-control" name="dni" required value="<?php echo $filas['DNI'] ?>" autocomplete="off" 
                    minlength="15" maxlength="15"  onkeypress="return solonumero(event)" placeholder="0000-0000-000000" onkeyup="quitarespacios(this); sinespacio(this); ">

                    <label for="">Profesión:</label>
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
                          <option value="<?php  echo $id_profesion.$profesion3; ?>"><?php echo $profesion3?></option>
                          <?php
                           }}// finaliza el if y el while
                           ?>
                   </select>

                    <label for="">Dirección:</label>
                    <input type="text" onkeyup="un_espacio(this);" class="form-control" name="direccion" required value="<?php echo $filas['DIRECCION'] ?>" 
                    autocomplete="off" onkeyup="mayus(this);" maxlength="255" >

                    <label for="">Teléfono:</label>
                    <input type="number" onkeyup="quitarespacios(this); sinespacio(this); " minlength="8" maxlength="8"  class="form-control" name="celular" required value="<?php echo $filas['CELULAR'] ?>" 
                    placeholder=""  >
                    
                    <label for="">Referencia:</label>
                    <input type="text" onkeyup="un_espacio(this);" class="form-control" name="referencia" required value="<?php echo $filas['REFERENCIA'] ?>" 
                    autocomplete="off" onkeyup="mayus(this);" maxlength="50" >

                    <label for="">Teléfono de referencia:</label>
                    <input type="number" onkeyup="quitarespacios(this); sinespacio(this);" minlength="8" maxlength="8" class="form-control" name="celular_referencia" required value="<?php echo $filas['CEL_REFERENCIA'] ?>" 
                    placeholder=""  >

                    <label for="">Experiencia laboral:</label>
                    <input type="text" onkeyup="un_espacio(this);" class="form-control" name="experiencia_laboral" required value="<?php echo $filas['EXPERIENCIA_LABORAL'] ?>" 
                    autocomplete="off" onkeyup="mayus(this);" maxlength="255" >

                    <label for="">Currículum:</label>
                    <input type="file" class="form-control" name="curriculum" accept=".pdf, .doxc" value="<?php echo $filas['CURRICULUM'] ?>" 
                    placeholder="" >

                    <label for="">Foto:</label>
                    <input type="file" class="form-control" name="imagenes" accept=".jpg, .png, .jpej, .JPEG, .JPG, .PNG" value="<?php echo $filas['FOTO'] ?>" placeholder="" >

                    <input type="hidden" name="ruta_curriculum" value="<?php echo $filas['CURRICULUM'] ?>">
                    <input type="hidden" name="ruta_imagen" value="<?php echo $filas['FOTO'] ?>">
 
                     
                    <label for="pwd" class="form-label">Área:</label>
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
                          <option value="<?php  echo $id_area.$area3; ?>"><?php echo $area3?></option>
                          <?php
                           }}// finaliza el if y el while
                           ?>

                    </select>
                    <label for="">Fecha Entrada:</label>
                    <input class="form-control" type="Datetime-local" name="fecha_inicio" minlength="" maxlength="" id="" required value="<?php echo $filas['FECHA_ENTRADA'] ?>">
                    
                    <label for="">Fecha Salida:</label>
                    <input class="form-control" type="Datetime-local" name="fecha_final" minlength="" maxlength="" id="" required value="<?php echo $filas['FECHA_SALIDA'] ?>">
                    
                    <label for="">Motivo Salida:</label>
                      <textarea type="text" class="form-control" name="motivo_salida" onkeyup="un_espacio(this);" value="" autocomplete="off" onkeyup="mayus(this);" maxlength="255" required ><?php echo $filas['MOTIVO_SALIDA'] ?></textarea>
                </div>
                <!-- Fin Cuerpo del modal Modal -->


                                <!-- pie del modal -->
                                <div class="modal-footer">
                                <button type="submit" name="accion" value="editar" class="btn btn-primary" onclick="return confirm('¿Desea editar la usuario?')">Guardar</button>
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
                            <?php 
                            ////////////////////// INICIO PERMISO DE ELIMINAR //////////////////////////////
                          include '../../conexion/conexion.php';
                          $area1 = "SELECT * FROM tbl_ms_roles_ojetos WHERE ID_ROL='$id_rol7' and ID_OBJETO=1 and PERMISO_ELIMINACION=1";
                          $area2 = mysqli_query($conn, $area1);
                          if (mysqli_num_rows($area2) > 0)
                          {?>
                             <button  value="eliminar" name="accion" 
                        onclick="return confirm('¿Quieres eliminar este dato?')"
                        type="submit" class="btn btn-danger ">
                        <i class="fas fa-trash-alt"></i>
                    </button>
                    <!---- ////////////////////// FIN PERMISO DE ELIMINAR ////////////////////////////// -->
                    <?php 
                          }
                        ?></form>
                          <input type="hidden" name="id_usuario"  value="<?php echo $filas['ID_USUARIO'] ?>">
                        <!--- ////////////////////// INICIO PERMISO DE EDITA CONTRASEÑA ////////////////////////////// -->
                        <?php 
                            
                          include '../../conexion/conexion.php';
                          $area1 = "SELECT * FROM tbl_ms_roles_ojetos WHERE ID_ROL='$id_rol7' and ID_OBJETO=1 and PERMISO_ACTUALIZACION=1";
                          $area2 = mysqli_query($conn, $area1);
                          if (mysqli_num_rows($area2) > 0)
                          {?>
                          
                             <button
                        type="button" class="btn btn-success" onclick="ocultar()" data-bs-toggle="modal" data-bs-target="#myModalr<?php echo $filas['USUARIO'] ?>">
                        <i class="fas fa-key"></i>
                    </button>
                    <!-- The Modal -->
                      <div class="modal" id="myModalr<?php echo $filas['USUARIO'] ?>">
                        <div class="modal-dialog">
                          <div class="modal-content">

                            <!-- Modal Header -->
                            <div class="modal-header">
                              <h4 class="modal-title">Restablecer Contaseña</h4>
                              <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>

                            <!-- Modal body -->
                            <div class="modal-body">
                            <form action="" method="post">
                            <label for="">Usuario:</label>
                            <input type="text" readonly class="form-control" name="usuario" required value="<?php echo $filas['USUARIO'] ?>" placeholder="" >
                            <br>
                      <label for="">Nueva contraseña:</label>
                        <input type="password" class="form-control mostrar" name="contrasena" id="contra" placeholder="Nueva contraseña" 
                        onkeypress="return clave1(event);" required onblur="quitarespacioss(this);" onkeyup="sinespacioss(this);" minlength="<?php echo $parametro_min?>" maxlength="<?php echo $parametro_max?>" 
                        pattern="(?=.*[\d])(?=.*[a-z])(?=.*[A-Z]).{<?php echo $parametro_min?>,}" >
                        <input type="checkbox" onclick="mostrarContrasena2()" > Mostrar/Ocultar
                        <br>
                      <label for="">Confirmar contraseña:</label>
                        <input type="password" class="form-control mostrar2" name="confirmar_contrasena" id="contrac" 
                        onkeypress="return clave1(event);" placeholder="Confirmar nueva contraseña"  minlength="<?php echo $parametro_min?>" maxlength="<?php echo $parametro_max?>"
                        required onblur="quitarespacioss(this);" onkeyup="sinespacioss(this);" 
                        pattern="(?=.*[\d])(?=.*[a-z])(?=.*[A-Z]).{<?php echo $parametro_min?>,}" >
                        <input type="checkbox" onclick="mostrarContrasena3()" > Mostrar/Ocultar
                      
                            </div>

                            <!-- Modal footer -->
                            <div class="modal-footer">
                              <button type="submit" value="restablecer" name="accion" class="btn btn-success">Actualizar</button>
                              <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                            </div>

                          </div>
                        </div>
                      </div>
                    
                        <?php 
                      }
                    ?></form>
                    <!--- ////////////////////// FIN PERMISO DE EDITAR CONTRASEÑA ////////////////////////////// --->
</td>
                     <td class="desaparecerTemporalmente1"><?php echo $filas['ID_USUARIO'] ?></td>
                     <td class="desaparecerTemporalmente1"><?php echo $filas['ROL'] ?></td>
                     <td class="desaparecerTemporalmente1"><?php echo $filas['NOMBRE_ESTADO'] ?></td>
                     <td class="desaparecerTemporalmente1"><?php echo $filas['NOMBRE'] ?></td>
                     <td class="desaparecerTemporalmente1"><?php echo $filas['APELLIDO'] ?></td>
                     <td class="desaparecerTemporalmente1"><?php echo $filas['USUARIO'] ?></td>
                     <td class="desaparecerTemporalmente1"><?php echo $filas['CORREO'] ?></td>
                     <td class="desaparecerTemporalmente1"><?php echo $filas['GENERO'] ?></td>
                     <td class="desaparecerTemporalmente1"><?php echo $filas['DNI'] ?></td>
                     <td class="desaparecerTemporalmente1"><?php echo $filas['PROFESION'] ?></td>
                     <td class="desaparecerTemporalmente1"><?php echo $filas['DIRECCION'] ?></td>
                     <td class="desaparecerTemporalmente1"><?php echo $filas['CELULAR'] ?></td>
                     <td class="desaparecerTemporalmente"><?php echo $filas['REFERENCIA'] ?></td>
                     <td class="desaparecerTemporalmente"><?php echo $filas['CEL_REFERENCIA'] ?></td>
                     <td class="desaparecerTemporalmente1"><?php echo $filas['EXPERIENCIA_LABORAL'] ?></td>
                     <td class="desaparecerTemporalmente"><a href="<?php echo $filas['CURRICULUM'] ?>" download>Descargar</a></td>                     
                     <td class="desaparecerTemporalmente"><img class="img-thumbnail" width="100px" src="<?php echo $filas['FOTO'] ?>" /></td>
                     <td class="desaparecerTemporalmente1"><?php echo $filas['AREA'] ?></td>
                     <td class="desaparecerTemporalmente1"><?php echo $filas['FECHA_ENTRADA'] ?></td>
                     <td class="desaparecerTemporalmente1"><?php echo $filas['FECHA_SALIDA'] ?></td>
                     <td class="desaparecerTemporalmente1"><?php echo $filas['MOTIVO_SALIDA'] ?></td>

                     
                     
                    
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
                          "buttons": [ "excel", "colvis"],
                          buttons:[ 
                                    {
                                            extend:    'excelHtml5',
                                            text:      'Exportar a Excel',
                                            titleAttr: 'Exportar a Excel',
                                            title:     'REPORTE DE ADMINISTRADORES', //T´tulo del reporte
                                            exportOptions: {
                                              // Columnas que se verán en el reporte
                                                columns: [1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,18]
                                            } 
                                    },
                                    {
                                            extend:    'colvis',
                                            text:      'Visualizar',
                                            
                                          
                                          
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

</body>
<script type="text/javascript" src="../../js/un_espacio.js"></script>
<script type="text/javascript" src="../../js/evitar_reenvio.js"></script>
</html>


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


    <script type="text/javascript">
  
        function mayus(e) {
          e.value = e.value.toUpperCase();
         }
    </script>


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
<!--INICIO PARA LA CONTRASEÑA ------>
<script type="text/javascript">
    function sinespacioss(e) {

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
    function quitarespacioss(e) {

      var cadena =  e.value;
      cadena = cadena.trim();

      e.value = cadena;

    };
</script>
<!-- FIN PARA LA CONTRASEÑA ------>
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

        function mostrarContrasena(){
          var x = document.getElementById("myInput");
          if (x.type === "password"){
            x.type = "text";
          }else{
            x.type = "password";
          }
        }
          
        function mostrarContrasena2(){
          var x = document.getElementById("contra");
          if (x.type === "password"){
            $(".mostrar").attr("type","text");
          }else{
            $(".mostrar").attr("type","password");
          } 
        }

        function mostrarContrasena3(){
          var x = document.getElementById("contrac");
          if (x.type === "password"){
            $(".mostrar2").attr("type","text");
          }else{
            $(".mostrar2").attr("type","password");
          }
        }

        function ocultar(){
          $(".mostrar").attr("type","password");
          $(".mostrar2").attr("type","password");
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

  <!-- // Inicio para exportar en pdf // -->
<?php
if(!isset($_POST['reporte_catalogo']))
{
	require '../../conexion/conexion.php';
	$sql = "SELECT * FROM ((((( tbl_usuarios p
      INNER JOIN tbl_roles g ON p.ID_ROL = g.ID_ROL)
      INNER JOIN tbl_estado_usuario u ON p.ID_ESTADO_USUARIO = u.ID_ESTADO_USUARIO)
      INNER JOIN tbl_generos e ON p.ID_GENERO = e.ID_GENERO)
      INNER JOIN tbl_profesiones d ON p.ID_PROFESION = d.ID_PROFESION) 
      INNER JOIN tbl_areas a ON p.ID_AREA = a.ID_AREA) 
  ORDER BY p.ID_ROL desc";
	$query = $conn->query($sql);
	$data = array();
	while($r=$query->fetch_object()){
	$data[] =$r;
	}

}else{		
			  
			require '../../conexion/conexion.php';
			$asignacion=(isset($_POST['reporte_catalogo']))?$_POST['reporte_catalogo']:"";
			$sql = "SELECT * FROM ((((( tbl_usuarios p
      INNER JOIN tbl_roles g ON p.ID_ROL = g.ID_ROL)
      INNER JOIN tbl_estado_usuario u ON p.ID_ESTADO_USUARIO = u.ID_ESTADO_USUARIO)
      INNER JOIN tbl_generos e ON p.ID_GENERO = e.ID_GENERO)
      INNER JOIN tbl_profesiones d ON p.ID_PROFESION = d.ID_PROFESION) 
      INNER JOIN tbl_areas a ON p.ID_AREA = a.ID_AREA)
      WHERE p.ID_ROL='$asignacion'";
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
    //deshabilitar campo de acciones
    $(".desaparecerTemporalmente1").css("display","");
    $(".desaparecerTemporalmente").css("display","none");

			
			const pdf = new jsPDF('L', 'mm', 'Job');

      pdf.autoTable(
				{ 
          html:'#example1',
					
					margin:{ top: 30 },
          
          columnStyles: {    
      
            0: {cellWidth: 8},
            1: {cellWidth: 20}, 
            2: {cellWidth: 20},  
            3: {cellWidth: 20},  
            4: {cellWidth: 20},  
            5: {cellWidth: 20},            
            6: {cellWidth: 20},
            7: {cellWidth: 20},
            8: {cellWidth: 20},
            9: {cellWidth: 20},
            10: {cellWidth: 20},
            11: {cellWidth: 20},
            12: {cellWidth: 20},
            // 13: {cellWidth: 20},
            // 14: {cellWidth: 20},
            // 15: {cellWidth: 30},
            // 16: {cellWidth: 30},
            15: {cellWidth: 20},
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
				pdf.text("Reporte de usuarios", pdf.internal.pageSize.getWidth() / 2, 20, null, 'center');

												//////// pie de Pagina ///////
				//muestra la fecha
				pdf.setFont('times');
				pdf.setFontSize(9);
				var today = new Date();
				let horas = today.getHours()
				let jornada = horas >=12 ? 'PM' : 'AM';
				var newdat = "Fecha: " + today.getDate() + "/" + (today.getMonth()+1) + "/" + today.getFullYear() + " " + (horas % 12) + ":" + today.getMinutes() + ":" + today.getSeconds() + " " + jornada;
				pdf.text(260-20,297-284,newdat);
        pdf.text('<?php echo 'Creado por: '. $_SESSION['usuario']; ?>', 281, 20, {
            align: 'right',
            });

				//muestra el numero de pagina
				pdf.text('Pagina ' + String(i) + '/' + String(pageCount),282-20,297-89,null,null,"right");
			}
				//Fin Encabezado y pie de pagina

							pdf.save('Reporte de Usuarios.pdf');
              $(".desaparecerTemporalmente").css("display","");
	})

</script>
<!-- // Fin para exportar en pdf // -->

<script>
      // Valida con textos y colores los imputs de los form
      // Example starter JavaScript for disabling form submissions if there are invalid fields

      (() => {
      'use strict'

      // Fetch all the forms we want to apply custom Bootstrap validation styles to
      const forms = document.querySelectorAll('.needs-validation')

      // Loop over them and prevent submission
      Array.from(forms).forEach(form => {
      form.addEventListener('submit', event => {
        if (!form.checkValidity()) {
          event.preventDefault()
          event.stopPropagation()
        }

        form.classList.add('was-validated')
      }, false)
      })
      })()
</script>
<script>
    // Quita espacios de los inputs
    document.getElementById("campoNombre").addEventListener('keyup', (e) => {

          let nombre = e.target.value;
          e.target.value = nombre.toUpperCase().trim();

      });
    document.getElementById("campoApellido").addEventListener('keyup', (e) => {

          let nombre = e.target.value;
          e.target.value = nombre.toUpperCase().trim();

      });
    
</script>