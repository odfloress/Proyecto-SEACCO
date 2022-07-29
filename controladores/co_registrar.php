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

 // recupera el botón
  $accion=(isset($_POST['accion']))?$_POST['accion']:"";

  // encripta la contraseña
  $contrasena= hash('sha512', $contrasena);

  switch($accion){
      case "registrar": 

        // $permitidos = array("pdf", "docx");
        // $extencion = pathinfo($_FILES['curriculum']["name"], PATHINFO_EXTENSION);
        
        // if(in_array($extencion, $permitidos)){
        //     $Fecha= new DateTime();
        //     $destino ="../../curriculum/";
        //     $nombrecurriculum=($_FILES['curriculum']["name"]!="")?$Fecha->getTimestamp()."_".$_FILES["curriculum"]["name"]:"imagen.jpg";
        //     $tmpArchivo= $_FILES["curriculum"]["tmp_name"];
        //     if($tmpArchivo!="") 
        //     {
        //      move_uploaded_file($tmpArchivo,$destino.$nombrecurriculum);
        //     } 
        //         $sql = "INSERT INTO tbl_bienvenida_portafolio (TIPO, IMAGEN, RUTA, TITULO, DESCRIPCION)
        //                 VALUES ('$tipo', '$nombrecurriculum', '$destino$nombrecurriculum', '$titulo', '$descripcion')";
        //         $res = mysqli_query($conn, $sql);
        //          if($res){
                     
        //             echo '<script type="text/javascript">
        //                      alert("Agregado correctamente");
        //                      window.location.href="../../vistas/catalogo/vista_portafolio";
        //                  </script>';
        //          }else{
        //                 die("Error". mysqli_error($conn));
        //               }
        // }else{
           
        //     echo '<script type="text/javascript">
        //              alert("Archivo no permitido");
        //              window.location.href="../../vistas/catalogo/vista_portafolio";
        //           </script>';
        // }
        






























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

               
                   

                  // Inserta en la tabla tbl_usuarios
                  $sql = "INSERT INTO tbl_usuarios (ID_ROL, ID_ESTADO_USUARIO, NOMBRE, APELLIDO, USUARIO, ID_GENERO, CORREO, DNI, ID_PROFESION, DIRECCION, CELULAR, REFERENCIA, CEL_REFERENCIA, EXPERIENCIA_LABORAL, CURRICULUM, CONTRASENA, FOTO, ID_AREA)
                          VALUES (2,4,'$nombre', '$apellido', '$usuario', '$genero', '$correo', '$dni', '$profesion',  '$direccion', '$celular', '$referencia', '$celular_referencia', '$experiencia_laboral', '../../$destino$nombrecurriculum','$contrasena','$foto', '$area' )";
                  
                  if (mysqli_query($conn, $sql)) {
                    echo '<script>
                                  alert("Usuario creado con exito");
                                  window.location.href="/SEACCO/_login";
                      </script>';
       
                     
                  } else {
                    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                  }
                  
                  mysqli_close($conn);
                

                }else{
           
                  echo '<script type="text/javascript">
                           alert("Archivo no permitido");
                           
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


