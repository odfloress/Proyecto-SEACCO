<?php
  session_start();
  require 'conexion/conexion.php';

  //Variables para recuperar la información de los campos del login
  $usuario=(isset($_POST['usuario']))?$_POST['usuario']:"";
  $contrasena=(isset($_POST['contrasena']))?$_POST['contrasena']:"";
  $accion=(isset($_POST['accion']))?$_POST['accion']:"";

  // Desencripta la contraseña
  $contrasena= hash('sha512', $contrasena);
 

  // Inicio del switch, para validar el valor del boton accion
  switch($accion){
    case "ingresar": 

      // Valida que exista el usuario y contraseña y que sea superadmin
     $validar_usuario = "SELECT * FROM tbl_usuarios WHERE USUARIO='$usuario' and CONTRASENA='$contrasena' and ID_ROL=3";
     $result = mysqli_query($conn, $validar_usuario); 
      if (mysqli_num_rows($result) > 0) { 

        $_SESSION['usuario'] = $usuario;
        header('Location: vistas/tablero/vista_tablero.php');

         // inicio inserta en la tabla bitacora
         $sql = "INSERT INTO tbl_bitacora (ID_USUARIO, ID_OBJETO, USUARIO, ACCION, OBSERVACION)
         VALUES (2, 1, '$usuario', 'INGRESO', 'EL USUARIO $usuario (SUPERADMIN) SE LOGUIO')";
         
         if (mysqli_query($conn, $sql)) {
           
         } else {}
         // fin inserta en la tabla bitacora
        
        //Deja en cero los intentos fallidos
         $conn = new mysqli($servername, $username, $password, $dbname);
         $sql =  "UPDATE tbl_usuarios SET intentos=0 WHERE usuario='$usuario'";
         if ($conn->query($sql) === TRUE) {}
         exit() ;
      }else{

      // Valida si estado es inactivo
     $validar_usuario = "SELECT * FROM tbl_usuarios WHERE USUARIO='$usuario' and CONTRASENA='$contrasena' and ID_ESTADO_USUARIO=2";
     $result = mysqli_query($conn, $validar_usuario); 
      if (mysqli_num_rows($result) > 0) { 

        echo '<script>
                alert("Su cuenta esta inactiva por favor contactarse cono el administrador");
                window.Location = "/_login.php";
             </script>';
            mysqli_close($conn);

      }else{
        
        


     // Valida que exista el usuario y contraseña
     $validar_usuario = "SELECT * FROM tbl_usuarios WHERE USUARIO='$usuario' and CONTRASENA='$contrasena'";
     $result = mysqli_query($conn, $validar_usuario); 
      if (mysqli_num_rows($result) > 0) { 

           // Valida la configuración de intentos fallidos de la tabla tbl_parametros
            $validar_conf_intentos = "SELECT * FROM tbl_parametros WHERE PARAMETRO='INTENTOS'";
            $result2 = mysqli_query($conn, $validar_conf_intentos);
            if (mysqli_num_rows($result2) > 0) {
                
                while($row = mysqli_fetch_assoc($result2)) {
                      $intento =  $row["VALOR"];

                  // Valida los intentos fallidos en la tabla tbl_usuarios 
                   $validar_intento = "SELECT * FROM tbl_usuarios WHERE usuario='$usuario' and intentos<$intento";
                   $result3 = mysqli_query($conn, $validar_intento);
                  } //fin del primer while 
                   if (mysqli_num_rows($result3) > 0) {
                        

                        // Valida la configuración de preguntas de la tabla tbl_parametros
                        $validar_conf_preguntas = "SELECT * FROM tbl_parametros WHERE PARAMETRO='PREGUNTAS'";
                        $result4 = mysqli_query($conn, $validar_conf_preguntas);
                        if (mysqli_num_rows($result4) > 0) {
                          
                            while($row = mysqli_fetch_assoc($result4)) {
                              $pregunta =  $row["VALOR"];

                              // Valida las preguntas en la tabla tbl_usuarios 
                              $validar_pregunta = "SELECT * FROM tbl_usuarios WHERE usuario='$usuario' and CANT_PREGUNTAS<$pregunta";
                              $result5 = mysqli_query($conn, $validar_pregunta);
                            }//fin del segundo while
                            if (mysqli_num_rows($result5) > 0) {
                              $_SESSION['usuario'] = $usuario;
                                header('Location: http://localhost/SEACCO/vistas/iniciar_sesion/preguntas_seguridad');
                              
                            }else {// Fin del if que valida las preguntas de la tabla tbl_usuarios e inicia el else
                                     $_SESSION['usuario'] = $usuario;
                                     header('Location: vistas/tablero/vista_tablero.php');
                                     
                                     //Deja en cero los intentos fallidos
                                      $conn = new mysqli($servername, $username, $password, $dbname);
                                      $sql =  "UPDATE tbl_usuarios SET intentos=0 WHERE usuario='$usuario'";
                                      if ($conn->query($sql) === TRUE) {}
                                      exit() ;
                                  } // fin del else de validar preguntas


                        }else{echo "no existe la configuracion";} // Fin del if que valida si existe el parametro Preguntas e inicia el else

                   }else{// Fin del if que valida los intentos fallidos de la tabla tbl_usuarios e inicia el else
                          echo '<script>
                                  alert("Bloqueado por intentos fallidos");
                                  window.Location = "/_login.php";
                                </script>';
                          mysqli_close($conn);
                        }
     
                  

            }else{echo "no existe la configuracion";} // Fin del if que valida si existe el parametro intentos e inicia el else

          
      }else{ // fin del if principal e inicio del else

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
            }  } 
          }  // fin el if que valida si es superadmin            
    break;
      // si el valor del boton no es ingresar cierra cualquier conexion que exista a la BD
    default:
    $conn->close();   
 }// Fin del switch, para validar el valor del boton accion


?>
