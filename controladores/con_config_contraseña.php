<?php
  require '../../conexion/conexion.php';
  

  // //Variables para recuperar la información de los campos de la vista preguntas_seguridad
  $contrasena_actual=(isset($_POST['contrasena_actual']))?$_POST['contrasena_actual']:"";
  $nueva_contrasena=(isset($_POST['nueva_contrasena']))?$_POST['nueva_contrasena']:"";
  $confirmar_contrasena=(isset($_POST['confirmar_contrasena']))?$_POST['confirmar_contrasena']:"";
  $usuario = $_SESSION; 

  $contrasena_actual= hash('sha512', $contrasena_actual);

  $accion=(isset($_POST['accion']))?$_POST['accion']:"";
  
  
  switch($accion){
      case "actualizar": 

        // Valida que exista el usuario y contraseña
        $validar_usuario = "SELECT * FROM tbl_usuarios WHERE USUARIO='$usuario[usuario]' and CONTRASENA='$contrasena_actual'";
        $result = mysqli_query($conn, $validar_usuario); 
        if (mysqli_num_rows($result) > 0) { 

          if ($nueva_contrasena == $confirmar_contrasena) {

            $confirmar_contrasena= hash('sha512', $confirmar_contrasena);
            $conn = new mysqli($servername, $username, $password, $dbname);
             $sql =  "UPDATE tbl_usuarios SET CONTRASENA='$confirmar_contrasena' WHERE usuario='$usuario[usuario]'";
              if ($conn->query($sql) === TRUE) {
               echo '<script>
                        alert("excelente");
                        window.Location = "/_login.php";
                     </script>';
                     mysqli_close($conn);
                     header('Location: ../tablero/vista_tablero.php');
                     exit();
               } 
            
          } else {
            echo '<script>
                        alert("Error intente nuevamente ");
                        window.Location = "/_login.php";
                     </script>';
          }





        
        }else{ // fin del if principal e inicio del else

          echo '<script>
                        alert("Contraseña actual incorrecta");
                        window.Location = "/_login.php";
                     </script>';
                     mysqli_close($conn);
        }

             
      break;
      
        default:
          
          $conn->close();   
  }// Fin del switch, para validar el valor del boton accion


?>
