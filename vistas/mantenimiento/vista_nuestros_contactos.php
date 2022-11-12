<?php
session_start();
if(!isset($_SESSION['usuario'])){
 
        header('Location: ../../_login.php');
        session_unset();
        session_destroy();
        die();
        
}
include '../../controladores/crud_nuestros_contactos.php';
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
               $contacto = "SELECT * FROM tbl_ms_roles_ojetos WHERE ID_ROL='$id_rol7' and ID_OBJETO=18 and PERMISO_CONSULTAR=0";
               $contacto2 = mysqli_query($conn, $contacto);
               if (mysqli_num_rows($contacto2) > 0)
               {
                header('Location: ../../vistas/tablero/vista_perfil.php');
                die();
               }else{
                $role = "SELECT * FROM tbl_ms_roles_ojetos WHERE ID_ROL='$id_rol7' and ID_OBJETO=18 and PERMISO_CONSULTAR=1";
                $roless = mysqli_query($conn, $role);
                if (mysqli_num_rows($roless) > 0){}
                else{
                  header('Location: ../../vistas/tablero/vista_perfil.php');
                  die();
                }
               }
               // inicio inserta en la tabla bitacora
               $sql = "INSERT INTO tbl_bitacora (USUARIO, ACCION, OBSERVACION)
               VALUES ('$usuario1[usuario]', 'CONSULTO', 'CONSULTO LA PANTALLA ADMINISTRATIVA DE CONTACTOS')";
               if (mysqli_query($conn, $sql)) {} else {}
               // fin inserta en la tabla bitacora
           
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Nuestros Contactos</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

  <?php include '../../configuracion/navar.php' ?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0"></h1>
          </div><!-- /.col -->
          
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">
         
<!-- Contenido -->


 <div >
<center><h2>Nuestros Contactos</h2></center>

      <!-- Modal Header -->
      <center><div  class="modal-header">
         
        </div></center>

      <!-- Modal body -->
      <div class="modal-body">
      <?php
          include '../../conexion/conexion.php';
          $contactos = "SELECT * FROM tbl_nuestros_contactos WHERE ID_CONTACTO=1";
          $Resultado_contactos= mysqli_query($conn, $contactos);
            while($mostrar_contactos = mysqli_fetch_assoc($Resultado_contactos)) {
                      $ID_CONTACTO = $mostrar_contactos["ID_CONTACTO"];
                     $TELEFONO = $mostrar_contactos["TELEFONO"];
                     $CORREO_PARA_CLIENTES = $mostrar_contactos["CORREO"];
                     $DIRECCION = $mostrar_contactos["DIRECCION"];
                     $FACEBOOK = $mostrar_contactos["FACEBOOK"];
                     $INSTAGRAM = $mostrar_contactos["INSTAGRAM"];

                   }
        ?>
        <?php
          $correo_para_empleados = "SELECT * FROM tbl_nuestros_contactos WHERE ID_CONTACTO=2";
          $Resultado_correo_para_empleados = mysqli_query($conn, $correo_para_empleados);
            while($mostrar_correo_para_empleados = mysqli_fetch_assoc($Resultado_correo_para_empleados)) {
                     $CORREO_EMPLEADOS = $mostrar_correo_para_empleados["CORREO"];
                   }
        ?>
     
          <form action="" method="post">
       
          <!-- <label for="">ID Contactos</label> -->
          <input type="hidden" name="id_contacto" class="form-control " readonly value="<?php echo $ID_CONTACTO; ?>" placeholder="Ingrese su id">
           <br>

          <label for="">Número teléfono:</label>
          <input  type="text" autocomplete="off" name="telefono" value="<?php echo $TELEFONO; ?>" class="form-control"  placeholder="Numero de celular"  required minlength="8" onkeypress="return solonumero(event)" maxlength="8" pattern="[0-9]+[1-9]+[0-9]+" title="8 caracteres y no todos ceros">
        
           <br>

           <label for="">Correo para clientes:</label>
           <input type="email" name="correo" class="form-control" value="<?php echo $CORREO_PARA_CLIENTES; ?>" placeholder="Opcional Ingrese su correo" maxlength="255">
           <br>

           <label for="">Correo para Empleados:</label>
           <input type="email" name="correo_empleados" class="form-control" value="<?php echo $CORREO_EMPLEADOS; ?>" placeholder="Opcional Ingrese su correo" maxlength="255">
           <br>

           <label for="">Dirección:</label>
           <input type="text" name="direccion" class="form-control " maxlength="255" value="<?php echo $DIRECCION; ?>" placeholder="Ingrese su direccion" onkeyup="mayus(this);"  >
           <br>

            <label for="">Facebook:</label>
            <input type="text" name="facebook" class="form-control " value="<?php echo $FACEBOOK; ?>"placeholder="Ingrese su facebook"  maxlength="255">
            <br>
            <label for="">Instagram:</label>
            <input type="text" name="instagram" class="form-control " value="<?php echo $INSTAGRAM ?>" placeholder="Ingrese su instagram" maxlength="255" >
            <br>       
  
      </div>
        <!-- Modal footer -->
        <?php 
        include '../../conexion/conexion.php';
        $contacto = "SELECT * FROM tbl_ms_roles_ojetos WHERE ID_ROL='$id_rol7' and ID_OBJETO=18 and PERMISO_ACTUALIZACION=1";
        $contacto2 = mysqli_query($conn, $contacto);
        if (mysqli_num_rows($contacto2) > 0)
         {?>
      <div class="modal-footer">
      	            
                  <!-- <button type="submit" name="accion" value="agregar" class="btn btn-primary" onclick="return confirm('¿Desea agregar el contacto?')">Agregar</button> -->
                  <button type="submit" name="accion" value="editar" class="btn btn-primary" onclick="return confirm('¿Desea editar el contacto?')">Guardar</button>
                  <!-- <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button> -->
                </div><?php 
                          }
                        ?>
                     
                </form> 
            
               
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
    

<!-- fin contenido -->
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
    <!-- Control sidebar content goes here -->
    
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- REQUIRED SCRIPTS -->
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
<!-- jQuery -->
<script src="../../plantilla/AdminLTE-3.2.0/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../../plantilla/AdminLTE-3.2.0/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="../../plantilla/AdminLTE-3.2.0/dist/js/adminlte.min.js"></script>
</body>
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
