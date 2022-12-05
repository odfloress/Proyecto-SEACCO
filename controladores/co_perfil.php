<?php
require "../../conexion/conexion.php";
$sql = "SELECT * FROM tbl_usuarios";
$result = mysqli_query($conn, $sql);

$accion=(isset($_POST['accion']))?$_POST['accion']:"";

$actual=(isset($_POST['actual']))?$_POST['actual']:"";
$contrasenanueva=(isset($_POST['contrasena']))?$_POST['contrasena']:"";
$contrasenaconfirmar=(isset($_POST['confirmar_contrasena']))?$_POST['confirmar_contrasena']:"";
$nombre=(isset($_POST['nombre2']))?$_POST['nombre2']:"";
$nombre_anterior=(isset($_POST['nombre3']))?$_POST['nombre3']:"";
$apellido=(isset($_POST['apellido2']))?$_POST['apellido2']:"";
$correo=(isset($_POST['correo2']))?$_POST['correo2']:"";
$correo_anterior=(isset($_POST['correo_anterior']))?$_POST['correo_anterior']:"";
$usuario1 = $_SESSION;

switch ($accion){

  case "actualizar":
    

    $actual= hash('sha512', $actual);
    // Valida que exista la contraseña
    $validar_actual = "SELECT * FROM tbl_usuarios WHERE CONTRASENA='$actual'";
    $reultado = mysqli_query($conn,$validar_actual);

    if (mysqli_num_rows($reultado) > 0){
      if($contrasenanueva == $contrasenaconfirmar){
        // encripta la contraseña
        $contrasenanueva= hash('sha512', $contrasenanueva);
        $contrasenaconfirmar= hash('sha512', $contrasenaconfirmar);
        
        $conn = new mysqli($servername, $username, $password, $dbname);
        $sqlresultado =  "UPDATE tbl_usuarios SET CONTRASENA='$contrasenanueva' WHERE USUARIO='$usuario1[usuario]'";
        if ($conn->query($sqlresultado) === TRUE) {

          // inicio inserta en la tabla bitacora
          $sql = "INSERT INTO tbl_bitacora (USUARIO, OPERACION, PANTALLA, CAMPO, VALOR_ORIGINAL, VALOR_NUEVO)
                    VALUES ('$usuario1[usuario]', 'EDITO','PERFIL', 'CONTRASEÑA', '*********','*********')";
            if (mysqli_query($conn, $sql)) {} else { }
          // fin inserta en la tabla bitacora

          echo '<script>
            alert("Contraseña actualizada exitosamente");
            window.Location = "/_login.php";
          </script>';
            
        } 

      }else {
        
        echo '<script>
          alert("Las contraseñas ingresadas no coinciden");
          window.Location = "/_login.php";
        </script>';
      }
    }else{
      
      echo '<script>
        alert("Contraseña actual incorrecta");
        window.Location = "/_login.php";
    </script>';
      mysqli_close($conn);      
    }
  break;
      
  case "guardar":
        // Valida que exista la correo
    $validar_actual = "SELECT * FROM tbl_usuarios WHERE CORREO='$correo'";
    $reultado = mysqli_query($conn,$validar_actual);

    if (mysqli_num_rows($reultado) > 0){
      $conn = new mysqli($servername, $username, $password, $dbname);
        $sqlguardar2 = "UPDATE tbl_usuarios SET NOMBRE='$nombre',APELLIDO='$apellido' WHERE USUARIO='$usuario1[usuario]'";
      if (mysqli_query($conn, $sqlguardar2)) {}
      echo '<script>
        alert("Datos actualizados.");
        window.Location = "/_login.php";
      </script>';
    }else{

      $conn = new mysqli($servername, $username, $password, $dbname);
        $sqlguardar = "UPDATE tbl_usuarios SET NOMBRE='$nombre',APELLIDO='$apellido',CORREO='$correo' WHERE USUARIO='$usuario1[usuario]'";

      if (mysqli_query($conn, $sqlguardar)) {

        

        echo '<script>
          alert("Información actualizada exitosamente.");
          window.Location = "/_login.php";
        </script>';
      } else {
       
        echo '<script>
        alert("Error al actualizar la información");
        window.Location = "/_login.php";
      </script>';
      }

    }

      
      mysqli_close($conn);
    
    
  break;

  case "editarfoto":

        $ruta= (isset($_POST['ruta']))?$_POST['ruta']:"";
        $tmpFoto1= $_FILES["imagenes"]["tmp_name"];

        if($tmpFoto1!="") {
            $permitidos = array("jpg", "png", "jpeg", "JPEG", "JPG", "PNG");
            $extencion = pathinfo($_FILES['imagenes']["name"], PATHINFO_EXTENSION);
            
        
        }else{
            $permitidos = array("jpg", "png", "jpeg", "JPEG", "JPG", "PNG");
            $ultimo = "jpg";
            $extencion = "$ultimo";
        }
        $direccion = "$ruta";
        
        if(in_array($extencion, $permitidos))
        {
            $Fecha= new DateTime();
            $destino ="../../imagenes/";
            $nombreimagen=($_FILES['imagenes']["name"]!="")?$Fecha->getTimestamp()."_".$_FILES["imagenes"]["name"]:"imagen.jpg";
            $tmpFoto= $_FILES["imagenes"]["tmp_name"];
            if($tmpFoto!="") 
            {
             unlink($ruta); 
             move_uploaded_file($tmpFoto,$destino.$nombreimagen);
            } 
            $direccion = "$destino$nombreimagen";
            // Inserta en la tabla tbl_usuarios
          $sql = "UPDATE tbl_usuarios SET FOTO='$direccion' WHERE USUARIO='$usuario1[usuario]'";

          if (mysqli_query($conn, $sql)) {
            
              echo '<script type="text/javascript">
                 alert("Foto de perfil actualizada exitosamente");  
              </script>';
          }else{
            
              echo '<script type="text/javascript">
              alert("Error al actualizar la foto de perfil");
              
          </script>';
            }
          
          mysqli_close($conn);

        }
          
}

?>