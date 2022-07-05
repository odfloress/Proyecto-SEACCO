<?php
require "../../conexion/conexion.php";
$sql = "SELECT * FROM tbl_usuarios";
$result = mysqli_query($conn, $sql);

  if(isset($_POST['actualizar'])){
    
    $actual=(isset($_POST['actual']))?$_POST['actual']:"";
    $contrasenanueva=(isset($_POST['contrasena']))?$_POST['contrasena']:"";
    $contrasenaconfirmar=(isset($_POST['confirmar_contrasena']))?$_POST['confirmar_contrasena']:"";
    $usuario1 = $_SESSION;

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
          echo '<script>
            alert("Contraseña actualizada");
            window.Location = "/_login.php";
          </script>';
            
        } 

      }else {
        echo '<script>
          alert("Las contraseñas no coinciden");
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


  }
//Editar datos del perfil del modal


?>