<?php
session_start();
require '../../conexion/conexion.php';
$usuario=(isset($_POST['usuario']))?$_POST['usuario']:"";
$contrasena=(isset($_POST['contrasena']))?$_POST['contrasena']:"";
$accion=(isset($_POST['accion']))?$_POST['accion']:"";

  // encripta la contraseña
$contrasena= hash('sha512', $contrasena);

switch($accion){
    case "ingresar": // es ingresar por que el valor del boton es ingresar
     // validar que exista el usuario y contraseña
     $validar_correo = "SELECT * FROM usuarios WHERE usuario='$usuario' and contrasena='$contrasena'";
     $result = mysqli_query($conn, $validar_correo);
     
     if (mysqli_num_rows($result) > 0) {

       
      $validar_intento = "SELECT * FROM parametros WHERE parametro='intentos' and valor<4";
      $result1 = mysqli_query($conn, $validar_intento);

      if (mysqli_num_rows($result1) > 0) {


         echo '<script>
                 alert("ingresar");
                 window.Location = "../tablero/vista_tablero.php";
               </script>';
               $_SESSION['usuario'] = $usuario;
               header('Location: ../tablero/vista_tablero.php');
              exit() ;
      }else{
      
        echo '<script>
                 alert("Bloqueado");
                 window.Location = "../iniciar_sesion/index_login.php";
               </script>';

        mysqli_close($conn);

   
                    
              }
               
     }else{
      
        echo '<script>
                 alert("Correo o contraseña invalido");
                 window.Location = "../iniciar_sesion/index_login.php";
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
