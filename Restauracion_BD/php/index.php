<?php
session_start();
if(!isset($_SESSION['usuario'])){
 
        header('Location: ../../_login.php');
        session_unset();
        session_destroy();
        die();
        
}

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
               $role = "SELECT * FROM tbl_ms_roles_ojetos WHERE ID_ROL='$id_rol7' and ID_OBJETO=23 and PERMISO_CONSULTAR=0";
               $roless = mysqli_query($conn, $role);
               if (mysqli_num_rows($roless) > 0)
               {
                header('Location: ../../vistas/tablero/vista_perfil.php');
                die();
               }else{
                      $role = "SELECT * FROM tbl_ms_roles_ojetos WHERE ID_ROL='$id_rol7' and ID_OBJETO=23 and PERMISO_CONSULTAR=1";
                      $roless = mysqli_query($conn, $role);
                      if (mysqli_num_rows($roless) > 0){}
                      else{
                        header('Location: ../../vistas/tablero/vista_perfil.php');
                        die();
                      }
               }
                // // inicio inserta en la tabla bitacora
                // $sql = "INSERT INTO tbl_bitacora (USUARIO, ACCION, OBSERVACION)
                // VALUES ('$usuario1[usuario]', 'CONSULTO', 'CONSULTO LA PANTALLA  ADMINISTRATIVA DE ROLES')";
                // if (mysqli_query($conn, $sql)) {} else {}
                // // fin inserta en la tabla bitacora


?>
<!DOCTYPE html>
<html lang="en">
<head>
      <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
      <title>Restablecimiento de Base de Datos</title>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
	   <!-- enlace del scritpt para evitar si preciona F12, si preciona Ctrl+Shift+I, si preciona Ctr+u  -->
	   <script type="text/javascript" src="../../js/evita_ver_codigo_utilizando_teclas.js"></script>
      <style> 
        body {
              background-image: url('../../imagenes/fondo.jpg');
              background-repeat: no-repeat;
              background-attachment: fixed; 
              background-size: 100% 100%;
              }
      </style>

    <!-- enlace del scritpt para evitar si preciona F12, si preciona Ctrl+Shift+I, si preciona Ctr+u  -->
    <script type="text/javascript" src="js/evita_ver_codigo_utilizando_teclas.js"></script>

</head>

<!-- oncopy="return false" onpaste="return false"  esto no permite copiar ni pegar -->
<body style="background-color:rgb(241, 243, 243);" oncopy="return false" onpaste="return false">


<!-- Inicio evita el click derecho de la pagina -->
<body oncontextmenu="return false">
<!-- Fin evita el click derecho de la pagina --> 
<br><br>


  <div  class="modal-dialog" >
    <div class="modal-content " >     
 
      <!--Inicio Cuerpo del modal -->
      <div class="modal-body ">
            <div class="mb-3 mt-3">
			<br>
			<center><h5>EXPORTACIÓN Y RESTAUTACIÓN DE LA BASE DE DATOS</h5></center>
			<br>
                <center><img src="../../imagenes/seacco.jpg" alt="Girl in a jacket" width="150" height="150"><br></center>
				<br>				
<body>
<!-- <center><label>La restauración de su base de datos se guardará en la siguiente dirección de su equipo: C:\xampp\htdocs\SEACCO\Restauracion_BD\backup </label></center> -->
<center><label>La copia de su base de datos se guardará: dentro de su sistema de información web</label></center>
<br>

	<br>
	<?php 
                            include '../../conexion/conexion.php';
                            $tablero = "SELECT * FROM tbl_ms_roles_ojetos WHERE ID_ROL='$id_rol7' and ID_OBJETO=23 and PERMISO_INSERCION=1";
                            $tablero2 = mysqli_query($conn, $tablero);
                            if (mysqli_num_rows($tablero2) > 0)
                            {
                              echo '<center><a class="btn btn-primary"  href="./Backup.php">Realizar copia de seguridad</a></center>';
                                                }
                        ?> 
<hr style="border:0px; border-top: 5px double #000;">

	<form action="./Restore.php" method="POST">
   
		
		<label><b>Selecciona un punto de restauración</b></label><br>
		<select class="form-select" name="restorePoint">
			<option value="" disabled="" selected="">Día_Mes_Año_(H:M:S)</option>
			<?php
				include_once './Connet.php';
				$ruta=BACKUP_PATH;
				if(is_dir($ruta)){
				    if($aux=opendir($ruta)){
				        while(($archivo = readdir($aux)) !== false){
				            if($archivo!="."&&$archivo!=".."){
				                $nombrearchivo=str_replace(".sql", "", $archivo);
				                $nombrearchivo=str_replace("-", ":", $nombrearchivo);
				                $ruta_completa=$ruta.$archivo;
				                if(is_dir($ruta_completa)){
				                }else{
				                    echo '<option value="'.$ruta_completa.'">'.$nombrearchivo.'</option>';
				                }
				            }
				        }
				        closedir($aux);
				    }
				}else{
				    echo $ruta." No es ruta válida";
				}
			?>
		</select>
		<br>
		<?php 
                          include '../../conexion/conexion.php';
                          $tablero = "SELECT * FROM tbl_ms_roles_ojetos WHERE ID_ROL='$id_rol7' and ID_OBJETO=23 and PERMISO_ACTUALIZACION=1";
                          $tablero2 = mysqli_query($conn, $tablero);
                          if (mysqli_num_rows($tablero2) > 0)
                          {?>
                                 <!-- inicio boton editar -->
								 <button type="submit" onclick="return confirm('La restauración puede tardar unos minutos ¿Desea seguir con la restauracion?')" class="btn btn-primary">Restaurar</button> <?php 
                          }
                        ?>
		
		<a class="btn btn-danger" href="http://localhost/SEACCO/vistas/tablero/vista_tablero.php">Regresar al menu de inicio</a>
	</form>
</body>
<!-- Enlace Script para evitar reenvio de forulario -->
<script type="text/javascript" src="js/evitar_reenvio.js"></script>
</html>


