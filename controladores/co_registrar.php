<?php
session_start();
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

 // recupera el botón
  $accion=(isset($_POST['accion']))?$_POST['accion']:"";

  // encripta la contraseña
  $contrasena = hash('sha512', $contrasena);

  date_default_timezone_set("America/Guatemala");

  $fecha = date("Y-m-d H:i:s");

  switch($accion){
      case "registrar": 
        
        // validacion para que no se repitan los usuarios en la tabla tbl_usuarios
           $validar_usuario = "SELECT * FROM tbl_usuarios WHERE USUARIO='$usuario'";
           $result = mysqli_query($conn, $validar_usuario);
           if (mysqli_num_rows($result) > 0) {
                
                echo '<script>
                        alert("El usuario ya existe, intente con otro");
                        // window.Location = "/registrar.php";
                      </script>';
                      mysqli_close($conn);
               
          }else{  
            
            // validacion para que no se repitan los correos en la tabla tbl_usuarios
            $validar_correo = "SELECT * FROM tbl_usuarios WHERE  CORREO='$correo'";
            $result = mysqli_query($conn, $validar_correo);
            if (mysqli_num_rows($result) > 0) {
                
                echo '<script>
                        alert("El correo ya existe, intente con otro");
                        // window.Location = "/registrar.php";
                      </script>';
                      mysqli_close($conn);

            }else{

            // validacion para que no se repita el DNI en la tabla tbl_usuarios
            $validar_dni = "SELECT * FROM tbl_usuarios WHERE  DNI='$dni'";
            $result = mysqli_query($conn, $validar_dni);
            if (mysqli_num_rows($result) > 0) {
                
                echo '<script>
                        alert("El DNI ya esta registrado, verifique que el ingresado sea el correcto");
                        // window.Location = "/registrar.php";
                      </script>';
                      mysqli_close($conn);

            }else
            {

              
        $permitidos = array("pdf", "docx");
        $extencion = pathinfo($_FILES['curriculum']["name"], PATHINFO_EXTENSION);
        
        if(in_array($extencion, $permitidos)){
            $Fecha= new DateTime();
            $destino ="curriculum/";
            $nombrecurriculum=($_FILES['curriculum']["name"]!="")?$Fecha->getTimestamp()."_".$_FILES["curriculum"]["name"]:"imagen.jpg";
            $tmpArchivo= $_FILES["curriculum"]["tmp_name"];
            if($tmpArchivo!="") 
            {
             move_uploaded_file($tmpArchivo,$destino.$nombrecurriculum);
            } 

            $permitidos2 = array("jpg", "png", "jpeg", "JPEG", "JPG", "PNG");
            $extencion = pathinfo($_FILES['foto']["name"], PATHINFO_EXTENSION);
            
            if(in_array($extencion, $permitidos2)){
                $Fecha1= new DateTime();
                $destino1 ="imagenes/";
                $nombrefoto=($_FILES['foto']["name"]!="")?$Fecha1->getTimestamp()."_".$_FILES["foto"]["name"]:"imagen.jpg";
                $tmpArchivo1= $_FILES["foto"]["tmp_name"];
                if($tmpArchivo1!="") 
                {
                 move_uploaded_file($tmpArchivo1,$destino1.$nombrefoto);
                }
                   

                  // Inserta en la tabla tbl_usuarios
                  $sql = "INSERT INTO tbl_usuarios (ID_ROL, ID_ESTADO_USUARIO, NOMBRE, APELLIDO, USUARIO, ID_GENERO, CORREO, DNI, ID_PROFESION, DIRECCION, CELULAR, REFERENCIA, CEL_REFERENCIA, EXPERIENCIA_LABORAL, CURRICULUM, CONTRASENA, FOTO, ID_AREA)
                          VALUES (4,2,'$nombre', '$apellido', '$usuario', '$genero', '$correo', '$dni', '$profesion',  '$direccion', '$celular', '$referencia', '$celular_referencia', '$experiencia_laboral', '../../$destino$nombrecurriculum','$contrasena','../../$destino1$nombrefoto', '$area' )";
                  
                  if (mysqli_query($conn, $sql)) {
                    $_SESSION['nombre'] = $usuario;
                    $ultimo_id = mysqli_insert_id($conn);
                      // inicio inserta en la tabla bitacora
                      $sql_BITACORA = "INSERT INTO tbl_bitacora (FECHA, USUARIO, OPERACION, PANTALLA, CAMPO, ID_REGISTRO, VALOR_ORIGINAL, VALOR_NUEVO)
                      VALUES ('$fecha', '$usuario', 'INSERTO', 'AUTO REGISTRO', 'TODOS', $ultimo_id,  'NUEVO', 'NUEVO')";
                      if (mysqli_query($conn, $sql_BITACORA)) {} else {}
                      // fin inserta en la tabla bitacora

                    echo '<script>
                                  alert("Usuario creado con exito");
                                  window.location.href="/SEACCO/vistas/iniciar_sesion/preguntas_seguridad";
                      </script>';
       
                     
                  } else {

                    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                  }
                  
                  mysqli_close($conn);

                }else{
                    
                  echo '<script type="text/javascript">
                           alert("En foto solo archivos de imagen JPEG, JPG, PNG ");
                        </script>';
              }
                

                }else{
                      
                  echo '<script type="text/javascript">
                           alert("El curriculum solo archivos de PDF o DOCX");
                           
                        </script>';
              }




                }
                }
               } // fin del else principal
             
      break;
      
        default:
          
          $conn->close();   
  }


?>


