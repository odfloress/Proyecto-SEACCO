<?php
  session_start();
  require 'conexion/conexion.php';

  //Variables para recuperar la información de los campos y boton del login
  $usuario=(isset($_POST['usuario']))?$_POST['usuario']:"";
  $contrasena=(isset($_POST['contrasena']))?$_POST['contrasena']:"";
  $accion=(isset($_POST['accion']))?$_POST['accion']:"";

  // Desencripta la contraseña
  $contrasena= hash('sha512', $contrasena);
 
   // Valida la configuración de intentos fallidos de la tabla tbl_parametros
   $validar_conf_intentos = "SELECT * FROM tbl_parametros WHERE PARAMETRO='INTENTOS'";
   $result1 = mysqli_query($conn, $validar_conf_intentos);
   if (mysqli_num_rows($result1) > 0) {
      while($row = mysqli_fetch_assoc($result1)) {
             $confi_intento =  $row["VALOR"];
   }}

   // Valida la configuración de Preguntas de la tabla tbl_parametros
   $validar_conf_preguntas = "SELECT * FROM tbl_parametros WHERE PARAMETRO='PREGUNTAS'";
   $result2 = mysqli_query($conn, $validar_conf_preguntas);
   if (mysqli_num_rows($result2) > 0) {
      while($row = mysqli_fetch_assoc($result2)) {
             $confi_pregunta =  $row["VALOR"];
   }}

  
  switch($accion){
    case "ingresar": 
                                /////////// VALIDACION DEL USUSARIO /////////////

      // Valida que exista el usuario y contraseña
      $validar_usuario = "SELECT USUARIO, CONTRASENA FROM tbl_usuarios
      WHERE USUARIO='$usuario' and CONTRASENA='$contrasena'";
      $result = mysqli_query($conn, $validar_usuario); 
       if (mysqli_num_rows($result) > 0) { 

            // Valida si la cuenta esta inactiva Con id=2
            $validar_usuario = "SELECT USUARIO, CONTRASENA, ID_ESTADO_USUARIO FROM tbl_usuarios
            WHERE USUARIO='$usuario' and CONTRASENA='$contrasena' and ID_ESTADO_USUARIO=2";
            $result = mysqli_query($conn, $validar_usuario); 
            if (mysqli_num_rows($result) > 0) 
            {
              // inicio inserta en la tabla bitacora
              $sql = "INSERT INTO tbl_bitacora (USUARIO, ACCION, OBSERVACION)
              VALUES ('$usuario', 'INTENTO', 'NO LOGRO INGRESAR YA QUE SU CUENTA ESTA INACTIVA')";
              if (mysqli_query($conn, $sql)) {} else {}
              // fin inserta en la tabla bitacora
              echo '<script>
                       alert("Su cuenta esta inactiva por favor contactarse con el administrador");
                       window.location.href="/SEACCO/_login";
                    </script>';
                      mysqli_close($conn);
                      die();
            }else{
                      // Valida los intentos fallidos (Que es si esta bloqueada)
                      $validar_usuario = "SELECT USUARIO, CONTRASENA, INTENTOS FROM tbl_usuarios 
                      WHERE USUARIO='$usuario' and CONTRASENA='$contrasena' and INTENTOS>=$confi_intento";
                      $result = mysqli_query($conn, $validar_usuario); 
                      if (mysqli_num_rows($result) > 0) 
                      {
                        $sql8 = "UPDATE tbl_usuarios SET ID_ESTADO_USUARIO=3 WHERE usuario='$usuario'";
                        if ($conn->query($sql8) === TRUE) {
                          // inicio inserta en la tabla bitacora
                            $sql = "INSERT INTO tbl_bitacora (USUARIO, ACCION, OBSERVACION)
                            VALUES ('$usuario', 'INTENTO', 'NO LOGRO INGRESAR YA QUE SU CUENTA ESTA BLOQUEADA')";
                            if (mysqli_query($conn, $sql)) {} else {}
                            // fin inserta en la tabla bitacora
                             echo '<script>
                                      alert("Su cuenta esta bloqueada por intentos fallidos");
                                      window.location.href="/SEACCO/_login";
                                  </script>';
                                  mysqli_close($conn);
                                }
                          die();
                      }else{
                              //valida si el usuario es NUEVO (es id 4)  y si ya configuro las preguntas de seguridad
                              $validar_usuario1 = "SELECT USUARIO, CONTRASENA, ID_ESTADO_USUARIO, CANT_PREGUNTAS FROM tbl_usuarios 
                              WHERE USUARIO='$usuario' and CONTRASENA='$contrasena' and ID_ESTADO_USUARIO=4 and CANT_PREGUNTAS<$confi_pregunta";
                              $result = mysqli_query($conn, $validar_usuario1); 
                              if (mysqli_num_rows($result) > 0) 
                              {
                                $_SESSION['nombre'] = $usuario;
                                // inicio inserta en la tabla bitacora
                                $sql = "INSERT INTO tbl_bitacora (USUARIO, ACCION, OBSERVACION)
                                VALUES ('$usuario', 'INTENTO', 'NO LOGRO INGRESAR YA QUE NO HABIA CONFIGURADO LAS PREGUNTAS DE SEGURIDAD')";
                                if (mysqli_query($conn, $sql)) {} else {}
                                // fin inserta en la tabla bitacora
                                echo '<script>
                                      alert("Debe configurar las preguntas de seguridad");
                                      window.location.href="http://localhost/SEACCO/vistas/iniciar_sesion/preguntas_seguridad";
                                  </script>';
                                 
                              }else
                                  {
                                     //valida si el usuario es Activo (es id 1)  y si ya configuro las preguntas de seguridad
                                      $validar_usuario1 = "SELECT USUARIO, CONTRASENA, ID_ESTADO_USUARIO, CANT_PREGUNTAS FROM tbl_usuarios 
                                      WHERE USUARIO='$usuario' and CONTRASENA='$contrasena' and ID_ESTADO_USUARIO=1 and CANT_PREGUNTAS<$confi_pregunta";
                                      $result = mysqli_query($conn, $validar_usuario1); 
                                      if (mysqli_num_rows($result) > 0) 
                                      {
                                        $_SESSION['nombre'] = $usuario;
                                        // inicio inserta en la tabla bitacora
                                        $sql = "INSERT INTO tbl_bitacora (USUARIO, ACCION, OBSERVACION)
                                        VALUES ('$usuario', 'INTENTO', 'NO LOGRO INGRESAR YA QUE NO HABIA CONFIGURADO LAS PREGUNTAS DE SEGURIDAD')";
                                        if (mysqli_query($conn, $sql)) {} else {}
                                        // fin inserta en la tabla bitacora
                                        echo '<script>
                                              alert("Debe configurar las preguntas de seguridad");
                                              window.location.href="http://localhost/SEACCO/vistas/iniciar_sesion/preguntas_seguridad";
                                          </script>';
                                      }else{
                                              // Valida que exista el usuario y contraseña y que este activo
                                              $validar_usuario3 = "SELECT USUARIO, CONTRASENA, ID_ESTADO_USUARIO FROM tbl_usuarios
                                              WHERE USUARIO='$usuario' and CONTRASENA='$contrasena' and ID_ESTADO_USUARIO=1";
                                              $result = mysqli_query($conn, $validar_usuario3); 
                                                if (mysqli_num_rows($result) > 0) 
                                                { 
                                                  $_SESSION['usuario'] = $usuario;
                                                  header('Location: vistas/tablero/vista_tablero.php');

                                                  // inicio inserta en la tabla bitacora
                                                  $sql = "INSERT INTO tbl_bitacora (USUARIO, ACCION, OBSERVACION)
                                                  VALUES ('$usuario', 'INGRESO', 'EL USUARIO $usuario (SUPERADMIN) SE LOGUIO')";
                                                  if (mysqli_query($conn, $sql)) {} else {}
                                                  // fin inserta en la tabla bitacora

                                                  // Deja en cero los intentos fallidos
                                                  $conn = new mysqli($servername, $username, $password, $dbname);
                                                  $sql =  "UPDATE tbl_usuarios SET intentos=0 WHERE usuario='$usuario'";
                                                  if ($conn->query($sql) === TRUE) {}
                                                  exit() ;
                                                }else{
                                                  echo '<script>
                                                            alert("Su cuenta aun no esta activa por favor contactarse con el administrador");
                                                            window.location.href="/SEACCO/_login";
                                                        </script>';
                                                        mysqli_close($conn);
                                                    }
                                            }
                                  }
                           }
                   }        
        }else{
           // Valida los intentos fallidos
           $validar_usuario1 = "SELECT * FROM tbl_usuarios 
           WHERE USUARIO='$usuario' and INTENTOS>=$confi_intento";
           $result = mysqli_query($conn, $validar_usuario1); 
           if (mysqli_num_rows($result) > 0) {
              // Bloquea la cuenta
              $conn = new mysqli($servername, $username, $password, $dbname);
              $sql7 = "UPDATE tbl_usuarios SET ID_ESTADO_USUARIO=3, intentos=intentos+1 WHERE usuario='$usuario'";
              if ($conn->query($sql7) === TRUE) {
                // inicio inserta en la tabla bitacora
                $sql = "INSERT INTO tbl_bitacora (USUARIO, ACCION, OBSERVACION)
                VALUES ('$usuario', 'BLOQUEO', 'SELE BLOQUEO LA CUENTA POR INTENTOS FALLIDOS')";
                if (mysqli_query($conn, $sql)) {} else {}
                // fin inserta en la tabla bitacora
                echo '<script>
                          alert("Su cuenta esta bloqueada por intentos fallidos");
                          window.location.href="/SEACCO/_login";
                      </script>';
                        mysqli_close($conn);}
                       
            }else{

                // Suma los intentos fallidos en la tabla tbl_usuarios y cierra cualquier conexion a la BD
                    $conn = new mysqli($servername, $username, $password, $dbname);
                    $sql =  "UPDATE tbl_usuarios SET intentos=intentos+1 WHERE usuario='$usuario'";
                      if ($conn->query($sql) === TRUE) {
                        // inicio inserta en la tabla bitacora
                        $sql = "INSERT INTO tbl_bitacora (USUARIO, ACCION, OBSERVACION)
                        VALUES ('$usuario', 'INTENTO', 'INTENTO FALLIDO POR CONTRASEÑA INCORRECTA')";
                        if (mysqli_query($conn, $sql)) {} else {}
                        // fin inserta en la tabla bitacora
                          echo '<script>
                                  alert("Usuario o contraseña invalidos");
                                  window.location.href="/SEACCO/_login";
                                </script>';
                                mysqli_close($conn);
                                exit() ;
                        }
               } 
        }
       
           
    break;
      // si el valor del boton no es ingresar cierra cualquier conexion que exista a la BD
    default:
    $conn->close();   
 }


?>
