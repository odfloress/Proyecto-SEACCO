<?php
require "../../conexion/conexion.php";
$sql = "SELECT * FROM tbl_usuarios";
$result = mysqli_query($conn, $sql);

$accion=(isset($_POST['accion']))?$_POST['accion']:"";

$actual=(isset($_POST['actual']))?$_POST['actual']:"";
$contrasenanueva=(isset($_POST['contrasena']))?$_POST['contrasena']:"";
$contrasenaconfirmar=(isset($_POST['confirmar_contrasena']))?$_POST['confirmar_contrasena']:"";
$nombre=(isset($_POST['nombre2']))?$_POST['nombre2']:"";
$apellido=(isset($_POST['apellido2']))?$_POST['apellido2']:"";
$correo=(isset($_POST['correo2']))?$_POST['correo2']:"";
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
          $sqlB1 = "INSERT INTO tbl_bitacora (USUARIO, ACCION, OBSERVACION)
            VALUES ('$usuario1[usuario]', 'ACTUALIZO', 'CAMBIO LA CONTRASEÑA')";
            if (mysqli_query($conn, $sqlB1)) {} else { }
          // fin inserta en la tabla bitacora

          echo '<script>
            alert("Contraseña actualizada");
            window.Location = "/_login.php";
          </script>';
            
        } 

      }else {
        // inicio inserta en la tabla bitacora
        $sqlB2 = "INSERT INTO tbl_bitacora (USUARIO, ACCION, OBSERVACION)
        VALUES ('$usuario1[usuario]', 'ACTUALIZAR', 'INTENTO CAMBIAR LA CONTRASEÑA, (LAS CONTRASEÑAS NO COINCIDEN)')";
        if (mysqli_query($conn, $sqlB2)) {} else { }
      // fin inserta en la tabla bitacora
        echo '<script>
          alert("Las contraseñas no coinciden");
          window.Location = "/_login.php";
        </script>';
      }
    }else{
      // inicio inserta en la tabla bitacora
      $sqlB3 = "INSERT INTO tbl_bitacora (USUARIO, ACCION, OBSERVACION)
      VALUES ('$usuario1[usuario]', 'ACTUALIZAR', 'INTENTO CAMBIAR LA CONTRASEÑA, (CONTRASEÑA ACTUAL ES INCORECTA)')";
      if (mysqli_query($conn, $sqlB3)) {} else { }
    // fin inserta en la tabla bitacora
      echo '<script>
        alert("Contraseña actual incorrecta");
        window.Location = "/_login.php";
    </script>';
      mysqli_close($conn);      
    }
  break;
      
  case "guardar":
    
      $validar_correo = "SELECT * FROM tbl_usuarios WHERE CORREO='$correo'";
      $resultado = mysqli_query($conn, $validar_correo); 
      if (mysqli_num_rows($resultado) > 0) {
        // inicio inserta en la tabla bitacora
        $sqlB4 = "INSERT INTO tbl_bitacora (USUARIO, ACCION, OBSERVACION)
        VALUES ('$usuario1[usuario]', 'ACTUALIZO', 'ERROR AL INTEN')";
        if (mysqli_query($conn, $sqlB4)) {} else { }
      // fin inserta en la tabla bitacora
        echo '<script>
        alert("Este correo ya esta registrado");
      </script>';
      }else{
        
        $conn = new mysqli($servername, $username, $password, $dbname);
        $sqlguardar = "UPDATE tbl_usuarios SET NOMBRE='$nombre',APELLIDO='$apellido',CORREO='$correo' WHERE USUARIO='$usuario1[usuario]'";

      if (mysqli_query($conn, $sqlguardar)) {

        // inicio inserta en la tabla bitacora
        $sqlB4 = "INSERT INTO tbl_bitacora (USUARIO, ACCION, OBSERVACION)
        VALUES ('$usuario1[usuario]', 'ACTUALIZO', 'CAMBIO DATOS PERSONALES')";
        if (mysqli_query($conn, $sqlB4)) {} else { }
      // fin inserta en la tabla bitacora

        echo '<script>
          alert("Datos actualizados");
          window.Location = "/_login.php";
        </script>';
      } else {
        // inicio inserta en la tabla bitacora
        $sqlB5 = "INSERT INTO tbl_bitacora (USUARIO, ACCION, OBSERVACION)
        VALUES ('$usuario1[usuario]', 'ACTUALIZAR', 'ERROR AL ACTUALIZAR DATOS PERSONALES')";
        if (mysqli_query($conn, $sqlB5)) {} else { }
      // fin inserta en la tabla bitacora
        echo '<script>
        alert("Error al actualizar datos");
        window.Location = "/_login.php";
      </script>';
      }
      }
      mysqli_close($conn);
    
    
  break;

  case "editarfoto":
    if(isset($_FILES['imagenes'])){
      $nombreimagen= $_FILES['imagenes']['name'];
      $ruta = $_FILES['imagenes']['tmp_name'];
      $destino = "../../imagenes/".$nombreimagen;
      
      if(copy($ruta, $destino)){
        $sql5 = "UPDATE tbl_usuarios SET FOTO='$destino' WHERE USUARIO='$usuario1[usuario]'";
      $resp = mysqli_query($conn, $sql5);
      if($resp){
        // inicio inserta en la tabla bitacora
        $sqlB6 = "INSERT INTO tbl_bitacora (USUARIO, ACCION, OBSERVACION)
        VALUES ('$usuario1[usuario]', 'ACTUALIZO', 'CAMBIO SU FOTO DE PERFIL ($nombreimagen)')";
        if (mysqli_query($conn, $sqlB6)) {} else { }
      // fin inserta en la tabla bitacora
        echo '<script type="text/javascript">
                 alert("Agregado correctamente");  
             </script>';
     }else{
          // inicio inserta en la tabla bitacora
            $sqlB7 = "INSERT INTO tbl_bitacora (USUARIO, ACCION, OBSERVACION)
            VALUES ('$usuario1[usuario]', 'ACTUALIZO', 'ERROR AL CAMBIAR SU FOTO DE PERFIL ($nombreimagen)')";
            if (mysqli_query($conn, $sqlB7)) {} else { }
          // fin inserta en la tabla bitacora
            echo '<script type="text/javascript">
            alert("Error al actualizar");
            
        </script>';
          }
    }
}
}

?>