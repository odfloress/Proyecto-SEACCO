<?php
  require '../../conexion/conexion.php';
  

  // //Variables para recuperar la información de los campos de la vista preguntas_seguridad
  
  $nueva_contrasena=(isset($_POST['nueva_contrasena']))?$_POST['nueva_contrasena']:"";
  $confirmar_contrasena=(isset($_POST['confirmar_contrasena']))?$_POST['confirmar_contrasena']:"";
  $usuario = $_SESSION; 


  $accion=(isset($_POST['accion']))?$_POST['accion']:"";
  
  
  switch($accion){
      case "actualizar": 

       

          if ($nueva_contrasena == $confirmar_contrasena) {

            $confirmar_contrasena= hash('sha512', $confirmar_contrasena);
            $conn = new mysqli($servername, $username, $password, $dbname);
             $sql =  "UPDATE tbl_usuarios SET CONTRASENA='$confirmar_contrasena' WHERE usuario='$usuario[nombre]'";
              if ($conn->query($sql) === TRUE) {
               
                echo '<script>
                alert("Contraseña Actualizada");
              window.location.href="../../_login";
           </script>';
           session_unset();

           // destroy the session
           session_destroy();
        mysqli_close($conn);
       //  header('Location: ../tablero/vista_tablero.php');
                 //Deja en cero los intentos fallidos
                $conn = new mysqli($servername, $username, $password, $dbname);
                $sql =  "UPDATE tbl_usuarios SET intentos=0 WHERE usuario='$usuario[nombre]'";
                if ($conn->query($sql) === TRUE) {}
                 // inicio inserta en la tabla bitacora
                 $sql7 = "INSERT INTO tbl_bitacora (USUARIO, ACCION, OBSERVACION)
                 VALUES ('$usuario[usuario]', 'RECUPERACION', 'EL SUARIO $usuario[usuario] ACTUALIZO SU CONTRASEÑA')";
                 
                 if (mysqli_query($conn, $sql7)) {
                   
                 } else {
                 
                 }
             // fin inserta en la tabla bitacora
         
                

           // destroy the session
               session_destroy();
              mysqli_close($conn);
       //  header('Location: ../tablero/vista_tablero.php');
        exit();
               } 
            
          } else {
            echo '<script>
                        alert("Las contraseñas no coinciden");
                        window.Location = "/_login.php";
                     </script>';
          }





        
       

        

             
      break;
      
        default:
          
          $conn->close();   
  }// Fin del switch, para validar el valor del boton accion


?>
