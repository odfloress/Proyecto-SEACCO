<?php
  require '../../conexion/conexion.php';
  //para mostrar los datos de la tabla mysql y mostrar en el crud
  $sql = "SELECT * FROM (((((tbl_usuarios u
                       INNER JOIN tbl_generos g ON u.ID_GENERO = g.ID_GENERO)
                       INNER JOIN tbl_roles r ON u.ID_ROL = r.ID_ROL)
                       INNER JOIN tbl_areas a ON u.ID_AREA = a.ID_AREA)
                       INNER JOIN tbl_estado_usuario e ON u.ID_ESTADO_USUARIO = e.ID_ESTADO_USUARIO)
                       INNER JOIN tbl_profesiones p ON u.ID_PROFESION = p.ID_PROFESION)";

  $result = mysqli_query($conn, $sql);


  // //Variables para recuperar la información de los campos de la vista adminiistradores
  $id_usuario=(isset($_POST['id_usuario']))?$_POST['id_usuario']:"";
  $rol=(isset($_POST['rol']))?$_POST['rol']:"";
  $estado=(isset($_POST['estado']))?$_POST['estado']:"";
  $nombre=(isset($_POST['nombre']))?$_POST['nombre']:"";
  $apellido=(isset($_POST['apellido']))?$_POST['apellido']:"";
  $usuario=(isset($_POST['usuario']))?$_POST['usuario']:"";
  $contrasena=(isset($_POST['contrasena']))?$_POST['contrasena']:"";
  $correo=(isset($_POST['correo']))?$_POST['correo']:"";
  $genero=(isset($_POST['genero']))?$_POST['genero']:"";
  $dni=(isset($_POST['dni']))?$_POST['dni']:"";
  $profesion=(isset($_POST['profesion']))?$_POST['profesion']:"";
  $direccion=(isset($_POST['direccion']))?$_POST['direccion']:"";
  $celular=(isset($_POST['celular']))?$_POST['celular']:"";
  $referencia=(isset($_POST['referencia']))?$_POST['referencia']:"";
  $celular_referencia=(isset($_POST['celular_referencia']))?$_POST['celular_referencia']:"";
  $experiencia_laboral=(isset($_POST['experiencia_laboral']))?$_POST['experiencia_laboral']:"";
  $curriculum=(isset($_POST['curriculum']))?$_POST['curriculum']:"";
  $foto=(isset($_POST['foto']))?$_POST['foto']:"";  
  $area=(isset($_POST['area']))?$_POST['area']:"";
  $usuario1 = $_SESSION; 

  //variable para recuperar los botones de la vista administradores  
  $accion=(isset($_POST['accion']))?$_POST['accion']:"";
  
  // encripta la contraseña
  $contrasena= hash('sha512', $contrasena);

  
  switch($accion){
      //para insertar en la tabla mysl
      case "agregar": 
       
       // validacion para que no se repitan los usuarios en la tabla tbl_usuarios
       $validar_usuario = "SELECT * FROM tbl_usuarios WHERE USUARIO='$usuario'";
       $result = mysqli_query($conn, $validar_usuario);
       if (mysqli_num_rows($result) > 0) {

            echo '<script>
                    alert("El usuario ya existe, intente con otro");
                    window.location.href="../../vistas/personas/vista_administradores";                   
                  </script>';
                  mysqli_close($conn);              
      }else{  
        
        // validacion para que no se repitan los correos en la tabla tbl_usuarios
        $validar_correo = "SELECT * FROM tbl_usuarios WHERE  CORREO='$correo'";
        $result = mysqli_query($conn, $validar_correo);
        if (mysqli_num_rows($result) > 0) {

            echo '<script>
                    alert("El correo ya existe, intente con otro");
                    window.location.href="../../vistas/personas/vista_administradores"; 
                  </script>';
                  mysqli_close($conn);

        }else{

        // validacion para que no se repita el DNI en la tabla tbl_usuarios
        $validar_dni = "SELECT * FROM tbl_usuarios WHERE  DNI='$dni'";
        $result = mysqli_query($conn, $validar_dni);
        if (mysqli_num_rows($result) > 0) {

            echo '<script>
                    alert("El DNI ya esta registrado, verifique que el ingresado sea el correcto");
                    window.location.href="../../vistas/personas/vista_administradores";
                  </script>';
                  mysqli_close($conn);

        }else{

              // Inserta en la tabla tbl_usuarios
              $sql = "INSERT INTO tbl_usuarios (ID_ROL, ID_ESTADO_USUARIO, NOMBRE, APELLIDO, USUARIO, GENERO, CORREO, DNI, PROFESION, DIRECCION, CELULAR, REFERENCIA, CEL_REFERENCIA, EXPERIENCIA_LABORAL, CURRICULUM, CONTRASENA, FOTO, AREA)
                            VALUES ($rol,$estado,'$nombre', '$apellido', '$usuario', '$genero', '$correo', '$dni', '$profesion',  '$direccion', '$celular', '$referencia', '$celular_referencia', '$experiencia_laboral', '$curriculum','$contrasena','$foto', '$area')";
              
              if (mysqli_query($conn, $sql)) {
                echo '<script>
                              alert("Usuario creado con exito");
                              window.location.href="../../vistas/iniciar_sesion/preguntas_seguridad.php";
                  </script>';

                  // inicio inserta en la tabla bitacora
                  $sql = "INSERT INTO tbl_bitacora (ID_USUARIO, ID_OBJETO, USUARIO, ACCION, OBSERVACION)
                  VALUES (2, 1, '$usuario1[usuario]', 'INSERTO', 'CREO AL USUARIO $usuario')";
                  
                  if (mysqli_query($conn, $sql)) {
                    
                  } else {                 
                  }
                 // fin inserta en la tabla bitacora
                
              } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                
              }
              
              mysqli_close($conn);
            }
            }
           } // fin del else principal
         
             
      break;

       //para editar en la tabla mysl      
      case "editar";

     

                    // Edita en la tabla  tbl_usuarios
                    $sql2 = "UPDATE tbl_usuarios SET ID_ROL='$rol', ID_ESTADO_USUARIO='$estado', NOMBRE='$nombre', APELLIDO='$apellido', USUARIO='$usuario', GENERO='$genero', CORREO='$correo', DNI='$dni', PROFESION='$profesion', DIRECCION='$direccion', CELULAR='$celular', REFERENCIA='$referencia', CEL_REFERENCIA='$celular_referencia', EXPERIENCIA_LABORAL='$experiencia_laboral', CURRICULUM='$curriculum', FOTO='$foto'  WHERE ID_USUARIO='$id_usuario'";
                    if (mysqli_query($conn, $sql2)) {
                      echo '<script>
                              alert("Usuario editado con exito");
                              window.location.href="../../vistas/personas/vista_administradores";
                            </script>';

                            // inicio inserta en la tabla bitacora
                                $sql = "INSERT INTO tbl_bitacora (ID_USUARIO, ID_OBJETO, USUARIO, ACCION, OBSERVACION)
                                VALUES (2, 1, '$usuario1[usuario]', 'EDITO', 'EDITO AL USUARIO $usuario')";
                                
                                if (mysqli_query($conn, $sql)) {
                                  
                                } else {
                                
                                }
                          // fin inserta en la tabla bitacora

                    }else{
                              echo '<script>
                                        alert("El Usuario fué editado con exito");
                                        window.location.href="../../vistas/personas/vista_administradores";
                                    </script>';

                          mysqli_close($conn);
                        }
                       
      


              
              
      break;
      
      //para eliminar en la tabla mysl  
      case "eliminar";
        // inicio inserta en la tabla bitacora
        $sql = "INSERT INTO tbl_bitacora (ID_USUARIO, ID_OBJETO, USUARIO, ACCION, OBSERVACION)
        VALUES (2, 1, '$usuario1[usuario]', 'ELIMINO', 'ELIMINO AL USUARIO CON ID: $id_usuario')";
        
        if (mysqli_query($conn, $sql)) {
          
        } else {
        
        }
        // fin inserta en la tabla bitacora

      $sql3 = "DELETE FROM tbl_usuarios WHERE ID_USUARIO='$id_usuario'";
      if (mysqli_query($conn, $sql3)) {
        

          header('Location: ../../vistas/personas/vista_administradores');
      }else{
              echo '<script>
                        alert("Error al tratar de eliminar usuario");
                    </script>'; mysqli_error($conn);
           }
        mysqli_close($conn);

      break;
      
      default:
          
          $conn->close();   
  }// Fin del switch, para validar el valor del boton accion


?>
