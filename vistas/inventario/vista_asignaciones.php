<?php
session_start();
if(!isset($_SESSION['usuario'])){
 
        header('Location: ../../_login.php');
        session_unset();
        session_destroy();
        die();
        
}
include '../../controladores/co_asignaciones.php';
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
               $role = "SELECT * FROM tbl_ms_roles_ojetos WHERE ID_ROL='$id_rol7' and ID_OBJETO=9 and PERMISO_CONSULTAR=0";
               $roless = mysqli_query($conn, $role);
               if (mysqli_num_rows($roless) > 0)
               {
                header('Location: ../../vistas/tablero/vista_perfil.php');
                die();
               }else{
                      $role = "SELECT * FROM tbl_ms_roles_ojetos WHERE ID_ROL='$id_rol7' and ID_OBJETO=9 and PERMISO_CONSULTAR=1";
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
  <title>Asignaciones</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- enlace del scritpt para evitar si preciona F12, si preciona Ctrl+Shift+I, si preciona Ctr+u  -->
    <script type="text/javascript" src="../../js/evita_ver_codigo_utilizando_teclas.js"></script>

           <!-- /// Para exportar en pdf /// -->
  <script type="text/javascript" src="../../js/complemento_1_jspdf.min.js"></script>
	<script type="text/javascript" src="../../js/complemento_2_jspdf.plugin.autotable.min.js"></script>

   <!-- ////////////// Inicio para select ////////// -->
<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css"> -->
<link rel='stylesheet prefetch' href='https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.11.2/css/bootstrap-select.min.css'>
<link rel="stylesheet" href="../../css/est.css">

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.3/js/bootstrap-select.min.js"></script>
<!-- ////////////// Fin para select ////////// -->


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
          <div class="col-sm-2">
            <h1></h1>
            <!-- Inicio de modal de agregar -->
<div class="container mt-3">
  
        <h3>Asignaciones</h3>  
        </div>

<!-- El Modal -->
<div class="modal" id="myModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Encabezado del modal -->
                <form action="" method="post">
                <div class="modal-header">
                    <h4 class="modal-title">Nueva asignación</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <!-- Fin Encabezado del modal -->

                <!-- Cuerpo del modal Modal -->
                <div class="modal-body">               
                <label for="">Seleccione el proyecto</label>
                    <select name="id_proyecto" required class="form-control selectpicker"  data-live-search="true">
                    <option value="">Seleccione</option>
                        <?php
                            include '../../conexion/conexion.php';
                            $proyecto = " SELECT * FROM tbl_proyectos WHERE ID_ESTADOS!=6 and ID_ESTADOS!=5 and ID_ESTADOS!=1";
                            $proyecto1 = mysqli_query($conn, $proyecto);
                            if (mysqli_num_rows($proyecto1) > 0) {
                                while($row = mysqli_fetch_assoc($proyecto1))
                                {
                                $id_proyecto = $row['ID_PROYECTO'];
                                $nombre_proyecto =$row['NOMBRE_PROYECTO'];
                         ?>
                          <option value="<?php  echo $id_proyecto ?>"><?php echo $id_proyecto .' - '.  $nombre_proyecto ?></option>
                          <?php
                           }}// finaliza el if y el while
                           ?>
                   </select><br><br>
                   <label for="">Seleccione el usuario</label>
                    <select  name="id_usuario" required class="form-control selectpicker"  data-live-search="true">
                    <option value="">Seleccione</option>
                        <?php
                            include '../../conexion/conexion.php';
                            $usuariooo = " SELECT * FROM tbl_usuarios WHERE ID_ESTADO_USUARIO=1 AND USUARIO!='ADMINISTRADOR'";
                            $usario77 = mysqli_query($conn, $usuariooo);
                            if (mysqli_num_rows($usario77) > 0) {
                                while($row = mysqli_fetch_assoc($usario77))
                                {
                                $id_usuario = $row['ID_USUARIO'];
                                $usuarioo =$row['USUARIO'];
                         ?>
                          <option value="<?php  echo $id_usuario ?>"><?php echo $id_usuario .' - '.  $usuarioo ?></option>
                          <?php
                           }}// finaliza el if y el while
                           ?>
                   </select><br><br>

                   <label for="">Producto</label>

                    <select  name="id_producto" required class="form-control selectpicker"  data-live-search="true" >
                    <option value="">Selecciona el producto</option>
                        <?php
                            include '../../conexion/conexion.php';
                            $productos = "SELECT * FROM tbl_productos  ";
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
                   <label for="">Cantidad asignada</label>
                   <input type="text" class="form-control" name="cantidad_asignada" required value="<?php echo $CANT_ASIGNADA; ?>" placeholder=""  
                    autocomplete = "off" minlength="1" maxlength="12"  onkeypress="return filterFloat(event,this);" >
                   
                    <label for="sel1" class="form-label">Estado de la asignación:</label>
                <select  name="id_estado_asignacion" required class="form-control selectpicker"  data-live-search="true">
                  <option value="">Seleccione</option>
                  <?php
                      include '../../conexion/conexion.php';
                      $getestado_herr = "SELECT * FROM  tbl_estado_asignacion";
                      // $getpregunta1 = "SELECT * FROM tbl_preguntas  WHERE ID_PREGUNTA  NOT IN (SELECT ID_PREGUNTA  FROM  tbl_respuestas_usuario WHERE USUARIO = 'JO' ) ORDER BY ID_PREGUNTA";
                      $getestado_herr = mysqli_query($conn, $getestado_herr);
                      if (mysqli_num_rows($getestado_herr) > 0) {
                          while($row = mysqli_fetch_assoc($getestado_herr))
                            {
                              $id_estado_herramienta = $row['ID_ESTADO_ASIGNACION'];
                              $estado_herramienta =$row['ESTADO_ASIGNACION'];
                           ?>
                              <option value="<?php  echo $id_estado_herramienta ?>"><?php echo $estado_herramienta; ?></option>
                          <?php
                    }}// finaliza el if y el while

                ?>
                </select><br><br>

                <label for="">Descripción de asignación:</label>
                    <TEXtarea  style="background-color: white;" onkeyup="un_espacio(this);" name="descripcion_asignacion" class="form-control" id="" required cols="40" rows="5"
                    autocomplete = "off"   minlength="3" maxlength="245"  ><?php echo $DESCRIPCION_ASIGNACION; ?></TEXtarea>
                    

                    <label for="">Fecha asignación:</label>
                    <input type="datetime-local" name="fecha_asignacion" value="<?php echo $fecha_asignacion; ?>" class="form-control" id="">
                    <label for="">Fecha entrega:</label>
                    <input type="datetime-local" name="fecha_entrega" value="<?php echo $fecha_entrega; ?>" class="form-control" id="">
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
            
            <div class="card table-responsive">
              <div class="card-header">
              <form id="form" action="" method="post">
        <?php 
      include '../../conexion/conexion.php'; 


                $tablero = "SELECT * FROM tbl_ms_roles_ojetos WHERE ID_ROL='$id_rol7' and ID_OBJETO=9 and PERMISO_INSERCION=1";
                $tablero2 = mysqli_query($conn, $tablero);
                if (mysqli_num_rows($tablero2) > 0)
                {
                  echo '<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#myModal">
                              Nueva asignación
                          </button>';
                }
         
                                  ?> 

        <button type="submit"  name="accion" value="reporte_pdf" class="btn btn-secondary buttons-pdf buttons-html5"  onclick="return confirm('¿Quieres generar reporte de asignaciones?')" onclick="textToPdf()"><span>Reporte PDF</span></button>
       
      </form>
                <!-- <h3 class="card-title">Compras</h3> -->
                
              </div>
              
              <!-- /.card-header -->
              <div class="card-body ">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th class="desaparecerTemporalmente2">Acciones</th>
                    <th class="desaparecerTemporalmente2">ID</th>
                    <th class="desaparecerTemporalmente3">Proyecto</th>
                    <th class="desaparecerTemporalmente3">Usuario</th> 
                    <th class="desaparecerTemporalmente3">Producto</th>
                    <th class="desaparecerTemporalmente3">Cantidad Asignada</th> 
                    <th class="desaparecerTemporalmente3">Cantidad Entregada</th>
                    <th class="desaparecerTemporalmente3">Estado asignación</th> 
                    <th class="desaparecerTemporalmente2">Descripción asignación</th> 
                    <th class="desaparecerTemporalmente2">Descripción entrega</th>
                    <th class="desaparecerTemporalmente3">Fecha asignado</th>          
                    <th class="desaparecerTemporalmente3">Fecha entrega</th> 
                  </tr>
                  </thead>
                  <tbody>
                    <?php 
                    

                    $cont = 0;
                    while ($filas= mysqli_fetch_assoc($result)){
 
                     ?>
                     <?php  $cont++; ?>
                  <tr>
                  <td class="desaparecerTemporalmente2"> <?php
                  date_default_timezone_set("America/Guatemala");
                  $fechaSSS = date("Y-m-d H:i:s");
                  $catidades_entregadas=$filas['CANT_ENTREGADA'];
                  $catidades_asignadas=$filas['CANT_ASIGNADA'];
                  $fecha_de_entrega_herramienta=$filas['FECHA_ENTREGA'];
                 
if( $catidades_entregadas<$catidades_asignadas and $fechaSSS>$fecha_de_entrega_herramienta){
  ?>
<button type="submit"  class="btn btn-primary" onclick="return confirm('Esta asignación se encuentra pendiente')" >
  <i class="fas fa-bell"></i>
  </button>
  <?php
}
                          ?>
                         <!-- inicio boton editar -->

                         <?php 
                          include '../../conexion/conexion.php';
                          $tablero = "SELECT * FROM tbl_ms_roles_ojetos WHERE ID_ROL='$id_rol7' and ID_OBJETO=9 and PERMISO_ACTUALIZACION=1";
                          $tablero2 = mysqli_query($conn, $tablero);
                          if (mysqli_num_rows($tablero2) > 0)
                          {?>
                              <!-- inicio boton editar -->
                              <button type="button"  class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#myModal2<?php echo $filas['ID_ASIGNADO'] ?>" >
                      <i class="fas fa-pencil-alt"></i>
                      </button>
                       <?php } ?>




                        

                          <!-- El Modal -->
                          <div class="modal" id="myModal2<?php echo $filas['ID_ASIGNADO'] ?>">
                          <div class="modal-dialog modal-xl">
                              <div class="modal-content">
                              <form action="" method="post" id="formulario">
                                <!-- Encabezado del modal -->
                                <div class="modal-header">
                                  <h4 class="modal-title">Entregar</h4>
                                  <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <!-- Fin Encabezado del modal -->


                                <div class="modal-body"> 
                                  <input type="hidden" name="id_asignado" value="<?php echo $filas['ID_ASIGNADO'] ?>">              
                <label for="">Proyecto:</label>
                <input type="text" name="" id="" readonly value="<?php echo $filas['NOMBRE_PROYECTO'] ?>" class="form-control">
                <br>  
                <label for="">Usuario:</label>
                <input type="text" name="" id="" readonly value="<?php echo $filas['USUARIO'] ?>" class="form-control">
                <br>
             
                <label for="">Producto:</label>
                <input type="hidden" name="id_producto" value="<?php echo $filas['ID_PRODUCTO'] ?>">
                <input type="text" name="" id=""readonly value="<?php echo $filas['PRODUCTOSS'] ?>" class="form-control">
                <br>
                   <label for="">Cantidad asignada:</label>
                   <input type="text" name="cantidad_asignada" id=""readonly value="<?php echo $filas['CANT_ASIGNADA'] ?>" class="form-control">
                  <br>
                  <label for="">Cantidad Entregada:</label>
                 
                   <input type="text"  class="form-control lectura" id="lectura"  readonly name="cantidad_entregada_actual" required value="<?php echo $filas['CANT_ENTREGADA'] ?>" placeholder=""  
                    autocomplete = "off" minlength="1" maxlength="12"  onkeypress="return filterFloat(event,this);" >
                    <small>
                      <input type="checkbox"  class="ver" id="ver" onclick="desaparecer()" />
                      <label class="text">Cambiar entrega</label>
                    </small>
                    <input type="hidden"  name="anterior_entraga" id="anterior_entraga" value="<?php echo $filas['CANT_ENTREGADA'] ?>">
                    <br>
                  <label class=" desaparecerTemporalmente" for="">Cantidad a Entregar:</label>
                 
                   <input type="text" class="form-control desaparecerTemporalmente"  name="cantidad_entregada1" required value="" placeholder="Ingrese la cantidad a entregar"  
                    autocomplete = "off" minlength="1" maxlength="12"  onkeypress="return filterFloat(event,this);" >
                  <br>
                    <label  for="sel1" class="form-label">Estado de la asignación:</label>
                <select  name="id_estado_asignacion" required class="form-select "  >
               
                <option value="">seleccione</option>
                  <?php
                      include '../../conexion/conexion.php';
                      $getestado_herr = "SELECT * FROM  tbl_estado_asignacion";
                      // $getpregunta1 = "SELECT * FROM tbl_preguntas  WHERE ID_PREGUNTA  NOT IN (SELECT ID_PREGUNTA  FROM  tbl_respuestas_usuario WHERE USUARIO = 'JO' ) ORDER BY ID_PREGUNTA";
                      $getestado_herr = mysqli_query($conn, $getestado_herr);
                      if (mysqli_num_rows($getestado_herr) > 0) {
                          while($row = mysqli_fetch_assoc($getestado_herr))
                            {
                              $id_estado_herramienta = $row['ID_ESTADO_ASIGNACION'];
                              $estado_herramienta =$row['ESTADO_ASIGNACION'];
                           ?>
                              <option value="<?php  echo $id_estado_herramienta ?>"><?php echo $id_estado_herramienta .' - '.($estado_herramienta)?></option>
                          <?php
                    }}// finaliza el if y el while

                ?>
                </select><br class=" desaparecerTemporalmente"><br class=" desaparecerTemporalmente">

                <label class=" desaparecerTemporalmente" for="">Descripción de asignación:</label>
                    <TEXtarea  readonly style="background-color:rgb(240, 244, 245);" onkeyup="un_espacio(this);" name="descripcion_asignacion" class="form-control desaparecerTemporalmente" id="" required cols="40" rows="5"
                    autocomplete = "off"   minlength="3" maxlength="245"  ><?php echo $filas['DESCRIPCION_ASIGNACION']; ?></TEXtarea>

                    <br class=" desaparecerTemporalmente">
                    

                    <label class=" desaparecerTemporalmente" for="">Fecha asignación:</label>
                    <input type="datetime" name="fecha_asignacion" class="form-control desaparecerTemporalmente" id="" readonly value="<?php echo $filas['FECHA_ASIGNADO'] ?>">
                    <br>
                    <label class=" desaparecerTemporalmente" for="">Fecha entrega:</label>
                    <input type="datetime" name="fecha_entrega" class="form-control desaparecerTemporalmente" id="" readonly value="<?php echo $filas['FECHA_ENTREGA'] ?>">
                <br class=" desaparecerTemporalmente">
                    <label class=" desaparecerTemporalmente" for="">Descripción de entrega:</label>
                    <TEXtarea    onkeyup="un_espacio(this);" name="descripcion_entrega" class="form-control desaparecerTemporalmente" id="" required cols="40" rows="5"
                    autocomplete = "off"   minlength="3" maxlength="245"  ><?php echo $filas['DESCRIPCION_ENTREGA']; ?></TEXtarea>
                   
                   
                    <!-- /////// Inicio tabla de entrega ///////// -->
                   
                    <table class="table table-striped desaparecerTemporalmente1" style="display:none">
                        <thead>
                          <tr>
                            <th>Acción</th>
                            <th>Cantidad</th>
                            <th>Fecha</th>
                          </tr>
                        </thead>
                        <tbody>
                        <?php
                  include '../../conexion/conexion.php';
                  //para mostrar los datos de la tabla mysql y mostrar en el crud                
                  $mostrar_KARDEX = "SELECT * FROM tbl_kardex   WHERE ID_ASIGNACION=$filas[ID_ASIGNADO] and TIPO_MOVIMIENTO='ENTRADA ASIGNACION' and CANTIDAD>0";
                  $resultado_kardex = mysqli_query($conn, $mostrar_KARDEX);
                  if (mysqli_num_rows($resultado_kardex) > 0) 
                 
                  while ($fila_kardex= mysqli_fetch_assoc($resultado_kardex)){
                    ?>
                          <tr>
                            <td> 
                             <form action="" method="post">
                             <input type="hidden" name="id_producto" value="<?php echo $filas['ID_PRODUCTO'] ?>">
                             <input type="hidden" name="id_asignado"  value="<?php echo $filas['ID_ASIGNADO'] ?>">
                              <input type="hidden" name="cantidad_entregada" value="<?php echo $fila_kardex['CANTIDAD']; ?>">
                              <input type="datetime" hidden name="fecha_entrega" value="<?php echo $fila_kardex['FECHA_HORA']; ?>">
                            <button  value="eliminar_entrega" name="accion" 
                                onclick="return confirm('¿Quieres eliminar este dato?')"
                                type="submit" class="btn btn-danger " data-id="19">
                                <i class="fas fa-trash-alt"></i>
                             </button>
                             </form>
                            </td>
                            <td><?php echo $fila_kardex['CANTIDAD']; ?></td>
                            <td><?php echo $fila_kardex['FECHA_HORA']; ?></td>
                          </tr>
                          <?php } ?>
                      </tbody>
                      </table>
                    <!-- /////// Fin tabla de entrega ///////// -->
                  </div>


                    

                                <!-- Cuerpo del modal Modal -->
                                <div class="container mt-3">          
 
                                <!-- Fin Cuerpo del modal Modal -->

                                <!-- pie del modal -->
                                <div class="modal-footer">
                                <button onclick="mostrar(); enviar_datos();" class="btn btn-success desaparecerTemporalmente1"  style="display:none" >Refrescar</button>
                                <button type="submit" name="accion" value="editar" class="btn btn-primary" >Entregar</button>
                                  <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                                </div>
                             </form>
                                  <!-- Fin pie del modal -->
                                  <form action="" method="post" >
                              </div>
                            </div>
                          </div></div>

                          <!-- fin boton editar -->
                          
                          
                          <?php 
                          include '../../conexion/conexion.php';
                          $tablero = "SELECT * FROM tbl_ms_roles_ojetos WHERE ID_ROL='$id_rol7' and ID_OBJETO=9 and PERMISO_ELIMINACION=1";
                          $tablero2 = mysqli_query($conn, $tablero);
                          if (mysqli_num_rows($tablero2) > 0)
                          {?>
                            <input type="hidden"  class="form-control lectura" id="lectura"  readonly name="cantidad_entregada" required value="<?php echo $filas['CANT_ENTREGADA'] ?>" placeholder=""  
                    autocomplete = "off" minlength="1" maxlength="12"  onkeypress="return filterFloat(event,this);" >
                           <input type="hidden" name="cantidad_asignada" id=""readonly value="<?php echo $filas['CANT_ASIGNADA'] ?>" class="form-control">
                          <input type="hidden" name="id_asignado"  value="<?php echo $filas['ID_ASIGNADO'] ?>">
                          <input type="hidden" name="id_producto" value="<?php echo $filas['ID_PRODUCTO'] ?>">
                             <button  value="eliminar" name="accion" 
                                onclick="return confirm('¿Quieres eliminar este dato?')"
                                type="submit" class="btn btn-danger " data-id="19">
                                <i class="fas fa-trash-alt"></i>
                             </button> <?php 
                          }
                        ?>
                     </form>
                     </td>
                     <td class="desaparecerTemporalmente2"><?php echo $filas['ID_ASIGNADO'] ?></td>
                     <td class="desaparecerTemporalmente3"><?php echo $filas['NOMBRE_PROYECTO'] ?></td>  
                     <td class="desaparecerTemporalmente3"><?php echo $filas['USUARIO'] ?></td>
                     <td class="desaparecerTemporalmente3"><?php echo $filas['PRODUCTOSS'] ?></td>
                     <td class="desaparecerTemporalmente3"><?php echo $filas['CANT_ASIGNADA'] ?></td>
                     <td class="desaparecerTemporalmente3"><?php echo $filas['CANT_ENTREGADA']; ?></td>
                     <td class="desaparecerTemporalmente3"><?php echo $filas['ESTADO_ASIGNACION'] ?></td>
                     <td class="desaparecerTemporalmente2"><TEXtarea  readonly style="background-color:rgb(240, 244, 245);" onkeyup="un_espacio(this);" name="descripcion_asignacion" class="form-control" id="" required cols="40" rows="5"
                    autocomplete = "off"   minlength="3" maxlength="245"  ><?php echo $filas['DESCRIPCION_ASIGNACION']; ?></TEXtarea></td>
                     <td class="desaparecerTemporalmente2">
                     <TEXtarea  readonly style="background-color:rgb(240, 244, 245);" onkeyup="un_espacio(this);" name="descripcion_asignacion" class="form-control" id="" required cols="40" rows="5"
                    autocomplete = "off"   minlength="3" maxlength="245"  ><?php echo $filas['DESCRIPCION_ENTREGA']; ?></TEXtarea>
                     </td>
                     <td class="desaparecerTemporalmente3"><?php echo $filas['FECHA_ASIGNADO']; ?></td>
                     <td class="desaparecerTemporalmente3" ><?php echo $filas['FECHA_ENTREGA']; ?></td>

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
      columnDefs: [
        { targets: [0, 1,2,3,4,5,6,7,10,11], visible: true},
        { targets: '_all', visible: false }
    ],
      language: {
                          processing: "Tratamiento en curso...",
                          search: "Buscar&nbsp;:",
                          lengthMenu: "Consultar _MENU_ items",
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
title:     'REPORTE DE ASIGNACIONES',
exportOptions: {
columns: [1,2,3,4,5,6,7,8,9,10,11]
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
  $(".desaparecerTemporalmente3").css("display","");
  $(".desaparecerTemporalmente2").css("display","none");

				const pdf = new jsPDF('L', 'mm', 'letter');			
        	
 
				
				

				pdf.autoTable(
				{ 
          html:'#example1',
					
					margin:{ top: 30 },
          
          columnStyles: {    
      
            0: {cellWidth: 37},
            1: {cellWidth: 38}, 
            2: {cellWidth: 35},  
            3: {cellWidth: 25},  
            4: {cellWidth: 25},  
            5: {cellWidth: 30},            
            6: {cellWidth: 30},
            7: {cellWidth: 30}
           
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
				pdf.text('Reporte de asignación', pdf.internal.pageSize.getWidth() / 2, 20, null, 'center');

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

							pdf.save('Reporte de asignaciones.pdf');
              $(".desaparecerTemporalmente2").css("display","");
	})

</script>

<!-- // Fin para exportar en pdf // -->

<script type="text/javascript" src="../../js/evitar_reenvio.js"></script>
</html>
<script type="text/javascript" src="../../js/un_espacio.js"></script>


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

<script>
  function desaparecer(){
  
  // $(".lectura").attr("readonly", false); 
    ////cambia elementos y le quita el required
    $(".desaparecerTemporalmente").css("display","none");
    $(".desaparecerTemporalmente").attr("required", false);
    /// muestra el boton actualizar
    $(".desaparecerTemporalmente1").css("display","");

    $(".valor_nuevo").attr("value", false);  
}
</script>

<script>
  function mostrar(){

    // Muestra los elemento que oculte ocultas
    $(".desaparecerTemporalmente").css("display","");
    // desaparece algunos elementos y coloca el required a lo que necesita
    $(".desaparecerTemporalmente1").css("display","none");
    $(".desaparecerTemporalmente").attr("required", true);
    $(".lectura").attr("readonly", true); 


}
</script>


<!-- asignar un valor desde otro input -->
<!-- <script>
  function enviar_datos(){
    location.reload();
    var total = document.getElementById('anterior_entraga').value;
    document.getElementById('lectura').value=total;
  }
</script> -->
