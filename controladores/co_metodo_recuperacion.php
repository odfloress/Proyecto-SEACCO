<?php
  session_start();
  require '../../conexion/conexion.php';

  //Variables para recuperar la información de los campos del login
  $usuario=(isset($_POST['usuario']))?$_POST['usuario']:"";
  $accion=(isset($_POST['accion']))?$_POST['accion']:"";
 

   // Inicio del switch, para validar el valor del boton accion
  switch($accion){
    case "correo": 

     // Valida que exista el usuario
     $validar_usuario = "SELECT * FROM tbl_usuarios WHERE USUARIO='$usuario'";
     $result = mysqli_query($conn, $validar_usuario); 
      if (mysqli_num_rows($result) > 0) { 
        $_SESSION['nombre'] = $usuario;
        header('Location: ../iniciar_sesion/recuperacion_correo.php');
                                  
      }else{
           
               echo '<script>
                        alert("Usuario no existe");
                        window.Location = "../iniciar_sesion/recuperacion_correo.php";
                     </script>';
                     mysqli_close($conn);
               
            }                    
    break;
      
    case "pregunta": 
        // Valida que exista el usuario
     $validar_usuario = "SELECT * FROM tbl_usuarios WHERE USUARIO='$usuario'";
     $result = mysqli_query($conn, $validar_usuario); 
      if (mysqli_num_rows($result) > 0) { 
        $_SESSION['nombre'] = $usuario;
        header('Location: ../iniciar_sesion/recuperacion_preguntas.php');
           echo "execelente";
                           
      }else{
           
               echo '<script>
                        alert("Usuario no existe");
                        window.Location = "/_login.php";
                     </script>';
                     mysqli_close($conn);
               
            }      

    break; 
    default:
    $conn->close();   
 }// Fin del switch, para validar el valor del boton accion


?>
