<!DOCTYPE html>
<html lang="en">
<head>
      <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
      <title>Restabecimiento de Base de Datos</title>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
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
			<center><h4>EXPORTACION Y RESTAURACIÓN</h4></center>
			<center><h4>DE BASE DE DATOS</h4></center><br>
                <center><img src="../../imagenes/seacco.jpg" alt="Girl in a jacket" width="150" height="150"><br></center>
				<br>				
<body>
<center><label>La restauración de su base de datos se guardará en la siguiente dirección de su equipo: C:\xampp\htdocs\SEACCO\Restauracion_BD\backup </label></center>
<br>

	<br>
<center><a href="./Backup.php">Realizar copia de seguridad</a></center>
	<form action="./Restore.php" method="POST">
	<br>
		<label>Selecciona un punto de restauración</label><br>
		<select name="restorePoint">
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
		
		<button type="submit" class="btn btn-primary">Restaurar</button>
	</form>
</body>
<!-- Enlace Script para evitar reenvio de forulario -->
<script type="text/javascript" src="js/evitar_reenvio.js"></script>
</html>
