<?php
  require 'conexion/conexion.php';

  //Variables para recuperar la información de los campos de la vista registro
  $nombre=(isset($_POST['nombre']))?$_POST['nombre']:"";
  $apellido=(isset($_POST['apellido']))?$_POST['apellido']:"";
  $usuario=(isset($_POST['usuario']))?$_POST['usuario']:"";
  $contrasena=(isset($_POST['contrasena']))?$_POST['contrasena']:"";
  $correo=(isset($_POST['correo']))?$_POST['correo']:"";
  $dni=(isset($_POST['dni']))?$_POST['dni']:"";
  $profesion=(isset($_POST['profesion']))?$_POST['profesion']:"";
  $direccion=(isset($_POST['direccion']))?$_POST['direccion']:"";
  $celular=(isset($_POST['celular']))?$_POST['celular']:"";
  $referencia=(isset($_POST['referencia']))?$_POST['referencia']:"";
  $celular_referencia=(isset($_POST['celular_referencia']))?$_POST['celular_referencia']:"";
  $experiencia_laboral=(isset($_POST['experiencia_laboral']))?$_POST['experiencia_laboral']:"";
  $curriculum=(isset($_POST['curriculum']))?$_POST['curriculum']:"";
  $foto=(isset($_POST['foto']))?$_POST['foto']:"";
  $genero=(isset($_POST['genero']))?$_POST['genero']:"";
  $area=(isset($_POST['area']))?$_POST['area']:"";

 
  $accion=(isset($_POST['accion']))?$_POST['accion']:"";

  // encripta la contraseña
  $contrasena= hash('sha512', $contrasena);

  switch($accion){
      case "registrar": 

        // validacion para que no se repitan los usuarios en la tabla tbl_usuarios
           $validar_usuario = "SELECT * FROM tbl_usuarios WHERE USUARIO='$usuario'";
           $result = mysqli_query($conn, $validar_usuario);
           if (mysqli_num_rows($result) > 0) {

                echo '<script>
                        alert("El usuario ya existe, intente con otro");
                        window.Location = "/registrar.php";
                      </script>';
                      mysqli_close($conn);
               
          }else{  
            
            // validacion para que no se repitan los correos en la tabla tbl_usuarios
            $validar_correo = "SELECT * FROM tbl_usuarios WHERE  CORREO='$correo'";
            $result = mysqli_query($conn, $validar_correo);
            if (mysqli_num_rows($result) > 0) {

                echo '<script>
                        alert("El correo ya existe, intente con otro");
                        window.Location = "/registrar.php";
                      </script>';
                      mysqli_close($conn);

            }else{

            // validacion para que no se repita el DNI en la tabla tbl_usuarios
            $validar_dni = "SELECT * FROM tbl_usuarios WHERE  DNI='$dni'";
            $result = mysqli_query($conn, $validar_dni);
            if (mysqli_num_rows($result) > 0) {

                echo '<script>
                        alert("El DNI ya esta registrado, verifique que el ingresado sea el correcto");
                        window.Location = "/registrar.php";
                      </script>';
                      mysqli_close($conn);

            }else{

                    // inicio inserta en la tabla bitacora
                    $sql7 = "INSERT INTO tbl_bitacora (ID_USUARIO, ID_OBJETO, USUARIO, ACCION, OBSERVACION)
                    VALUES (2, 1, '$usuario', 'REGISTRO', 'EL SUARIO $usuario SE REGISTRO')";
                    
                    if (mysqli_query($conn, $sql7)) {
                      
                    } else {
                    
                    }
              // fin inserta en la tabla bitacora

                  // Inserta en la tabla tbl_usuarios
                  $sql = "INSERT INTO tbl_usuarios (ID_ROL, ID_ESTADO_USUARIO, NOMBRE, APELLIDO, USUARIO, GENERO, CORREO, DNI, PROFESION, DIRECCION, CELULAR, REFERENCIA, CEL_REFERENCIA, EXPERIENCIA_LABORAL, CURRICULUM, CONTRASENA, FOTO)
                                VALUES (1,4,'$nombre', '$apellido', '$usuario', '$genero', '$correo', '$dni', '$profesion',  '$direccion', '$celular', '$referencia', '$celular_referencia', '$experiencia_laboral', '$curriculum','$contrasena','$foto')";
                  
                  if (mysqli_query($conn, $sql)) {
                    echo '<script>
                                  alert("Usuario creado con exito");
                                  window.location.href="/SEACCO/_login";
                      </script>';

                      
                            
                     
                  } else {
                    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                  }
                  
                  mysqli_close($conn);
                }
                }
               } // fin del else principal
             
      break;
      
        default:
          
          $conn->close();   
  }


?>


