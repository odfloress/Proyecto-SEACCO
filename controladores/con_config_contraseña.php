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
        $validar_usuario = "SELECT * FROM tbl_usuarios WHERE USUARIO='$usuario[nombre]' and CONTRASENA='$contrasena_actual'";
        $result = mysqli_query($conn, $validar_usuario); 
        if (mysqli_num_rows($result) > 0) 
        { 

          if ($nueva_contrasena == $confirmar_contrasena) 
          {

               $confirmar_contrasena= hash('sha512', $confirmar_contrasena);
               $conn = new mysqli($servername, $username, $password, $dbname);
               $sql =  "UPDATE tbl_usuarios SET CONTRASENA='$confirmar_contrasena' WHERE usuario='$usuario[nombre]'";
               if ($conn->query($sql) === TRUE) 
               {
                  // inicio inserta en la tabla bitacora
                  $sql7 = "INSERT INTO tbl_bitacora ( USUARIO, ACCION, OBSERVACION)
                  VALUES ('$usuario[nombre]', 'ACTUALIZO', 'EL SUARIO $usuario[nombre] ACTUALIZO SU CONTRASEÑA')";
                  // $sql7 = "INSERT INTO tbl_bitacora (ID_USUARIO, ID_OBJETO, USUARIO, ACCION, OBSERVACION)
                  // VALUES (2, 1, '$usuario[nombre]', 'ACTUALIZO', 'EL SUARIO $usuario[nombre] ACTUALIZO SU CONTRASEÑA')";
                  if (mysqli_query($conn, $sql7)) {} else {}
                  // fin inserta en la tabla bitacora
                
                  echo '<script>
                            alert("Contraseña Actualizada");
                            window.location.href="../../_login";
                        </script>';
                          session_unset();
                          session_destroy();
                          mysqli_close($conn);
                          die();
               } 
          }else{
                // inicio inserta en la tabla bitacora
                $sql7 = "INSERT INTO tbl_bitacora (USUARIO, ACCION, OBSERVACION)
                VALUES ('$usuario[nombre]', 'INTENTO', 'ERROR AL ACTUALIZAR LA CONTRASEÑA YA QUE NO COINCIDEN')";
                // $sql7 = "INSERT INTO tbl_bitacora (ID_USUARIO, ID_OBJETO, USUARIO, ACCION, OBSERVACION)
                // VALUES (2, 1, '$usuario[nombre]', 'INTENTO', 'ERROR AL ACTUALIZAR LA CONTRASEÑA YA QUE NO COINCIDEN')";
                if (mysqli_query($conn, $sql7)) {} else {}
                // fin inserta en la tabla bitacora
                echo '<script>
                            alert("Las contraseñas no coinciden");
                            window.Location = "/_login.php";
                        </script>'; mysqli_error($conn);
               }

        }else{ 
          // inicio inserta en la tabla bitacora
          $sql7 = "INSERT INTO tbl_bitacora ( USUARIO, ACCION, OBSERVACION)
          VALUES ( '$usuario[nombre]', 'INTENTO', 'ERROR AL ACTUALIZAR LA CONTRASEÑA YA QUE NO COINCIDE LA ACTUAL')";
          // $sql7 = "INSERT INTO tbl_bitacora (ID_USUARIO, ID_OBJETO, USUARIO, ACCION, OBSERVACION)
          // VALUES (2, 1, '$usuario[nombre]', 'INTENTO', 'ERROR AL ACTUALIZAR LA CONTRASEÑA YA QUE NO COINCIDE LA ACTUAL')";
          if (mysqli_query($conn,  $sql7)) {} else {}
          // fin inserta en la tabla bitacora
               echo '<script>
                        alert("Contraseña actual incorrecta");
                        window.location.href="../../vistas/iniciar_sesion/cambio_contraseña";
                     </script>';
                     mysqli_close($conn);
             }

             
      break;
      case "cancelar":

          echo '<script>
                  window.location.href="../../_login";
                </script>';
                    session_unset();
                    session_destroy();
                    mysqli_close($conn);
                    die();

      break;
      
        default:
          
          $conn->close();   
  }


?>
