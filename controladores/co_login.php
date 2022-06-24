<?php
  session_start();
  require 'conexion/conexion.php';

  //Variables para recuperar la información de los campos del login
  $usuario=(isset($_POST['usuario']))?$_POST['usuario']:"";
  $contrasena=(isset($_POST['contrasena']))?$_POST['contrasena']:"";
  $accion=(isset($_POST['accion']))?$_POST['accion']:"";

  // Encripta la contraseña
  $contrasena= hash('sha512', $contrasena);

  // Inicio del switch, para validar el valor del boton accion
  switch($accion){
    case "ingresar": 

     // Valida que exista el usuario y contraseña
     $validar_usuario = "SELECT * FROM tbl_usuarios WHERE USUARIO='$usuario' and CONTRASENA='$contrasena'";
     $result = mysqli_query($conn, $validar_usuario); 
      if (mysqli_num_rows($result) > 0) { 

          // Valida los intentos fallidos en la tabla tbl_usuarios 
          $validar_intento = "SELECT * FROM tbl_usuarios WHERE usuario='$usuario' and intentos<4";
          $result1 = mysqli_query($conn, $validar_intento);
            if (mysqli_num_rows($result1) > 0) {

                $_SESSION['usuario'] = $usuario;
                header('Location: vistas/tablero/vista_tablero.php');

                //Deja en cero los intentos fallidos
                $conn = new mysqli($servername, $username, $password, $dbname);
                $sql =  "UPDATE tbl_usuarios SET intentos=0 WHERE usuario='$usuario'";
                if ($conn->query($sql) === TRUE) {}
              exit() ;

            }else{
                  // Da una alerta si supero los intentos fallidos y cierra cualquier conexion a la BD
                  echo '<script>
                          alert("Bloqueado por intentos fallidos");
                          window.Location = "/_login.php";
                        </script>';
                        mysqli_close($conn);       
                  }
               
     }else{
          // Suma los intentos fallidos en la tabla tbl_usuarios y cierra cualquier conexion a la BD
           $conn = new mysqli($servername, $username, $password, $dbname);
           $sql =  "UPDATE tbl_usuarios SET intentos=intentos+1 WHERE usuario='$usuario'";
            if ($conn->query($sql) === TRUE) {
             echo '<script>
                      alert("Usuario o contraseña invalidos");
                      window.Location = "/_login.php";
                   </script>';
                   mysqli_close($conn);
             } 
          }                   
    break;
      // si el valor del boton no es ingresar cierra cualquier conexion que exista a la BD
    default:
    $conn->close();   
 }// Fin del switch, para validar el valor del boton accion


?>
