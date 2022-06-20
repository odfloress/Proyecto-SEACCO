<?php
session_start();
require '../conexion/conexion.php';
$correo=(isset($_POST['correo']))?$_POST['correo']:"";
$usuario=(isset($_POST['usuario']))?$_POST['usuario']:"";
$contrasena=(isset($_POST['contrasena']))?$_POST['contrasena']:"";
$accion=(isset($_POST['accion']))?$_POST['accion']:"";

  // encripta la contraseña
$contrasena= hash('sha512', $contrasena);

switch($accion){
    case "ingresar": // es insertar por que el valor del boton es insertar
     // validar que no se repita el correo
     $validar_correo = "SELECT * FROM usuarios WHERE correo='$correo' and contrasena='$contrasena'";
     $result = mysqli_query($conn, $validar_correo);
     
     if (mysqli_num_rows($result) > 0) {
       
 
         echo '<script>
                 alert("ingresar");
                 window.Location = "../bienvenida.php";
               </script>';
               $_SESSION['usuario'] = $correo;
               header('Location: ../bienvenida.php');
              exit() ;
              
               
     }else{
        echo '<script>
                 alert("Correo o contraseña incorrecta");
                 window.Location = "vistas/index_login.php";
               </script>';

        mysqli_close($conn);

   
                    
              }
                   
    break;
    case "calcular":
      $nu= 1;
      if($nu === 1){
        $error ="Hola";
      }
     

    
      default:
        // echo "algo salio mal";
        $conn->close();   
}


?>
