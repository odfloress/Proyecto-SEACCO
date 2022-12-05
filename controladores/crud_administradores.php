<?php
  require '../../conexion/conexion.php';
  //para mostrar los datos de la tabla mysql y mostrar en el crud
  $sql = "SELECT * FROM (((((tbl_usuarios u
                       INNER JOIN tbl_generos g ON u.ID_GENERO = g.ID_GENERO)
                       INNER JOIN tbl_roles r ON u.ID_ROL = r.ID_ROL)
                       INNER JOIN tbl_areas a ON u.ID_AREA = a.ID_AREA)
                       INNER JOIN tbl_estado_usuario e ON u.ID_ESTADO_USUARIO = e.ID_ESTADO_USUARIO)
                       INNER JOIN tbl_profesiones p ON u.ID_PROFESION = p.ID_PROFESION) WHERE USUARIO!='ADMINISTRADOR'";

  $result = mysqli_query($conn, $sql);


  // //Variables para recuperar la información de los campos de la vista adminiistradores
  $id_usuario=(isset($_POST['id_usuario']))?$_POST['id_usuario']:"";
  $usuario_id=(isset($_POST['usuario_id']))?$_POST['usuario_id']:"";
  $rol=(isset($_POST['rol']))?$_POST['rol']:"";
  $id_rol = intval(preg_replace('/[^0-9]+/', '', $rol), 10);
  $nuevo_rol= preg_replace('/[0-9]+/', '', $rol);
  $estado=(isset($_POST['estado']))?$_POST['estado']:"";
  $id_estado = intval(preg_replace('/[^0-9]+/', '', $estado), 10);
  $estado_nuevo = preg_replace('/[0-9]+/', '', $estado);
  $estado_usuario=(isset($_POST['estado_usuario']))?$_POST['estado_usuario']:"";
  $nombre=(isset($_POST['nombre']))?$_POST['nombre']:"";
  $nombre_anterior=(isset($_POST['nombre_anterio']))?$_POST['nombre_anterio']:"";
  $apellido=(isset($_POST['apellido']))?$_POST['apellido']:"";
  $usuario=(isset($_POST['usuario']))?$_POST['usuario']:"";
  $contrasena=(isset($_POST['contrasena']))?$_POST['contrasena']:"";
  $correo=(isset($_POST['correo']))?$_POST['correo']:"";
  $genero=(isset($_POST['genero']))?$_POST['genero']:"";
  $id_genero = intval(preg_replace('/[^0-9]+/', '', $genero), 10);
  $nuevo_genero= preg_replace('/[0-9]+/', '', $genero);
  $dni=(isset($_POST['dni']))?$_POST['dni']:"";
  $profesion=(isset($_POST['profesion']))?$_POST['profesion']:"";
  $id_profesion = intval(preg_replace('/[^0-9]+/', '', $profesion), 10);
  $nuevo_profesion= preg_replace('/[0-9]+/', '', $profesion);
  $direccionp=(isset($_POST['direccion']))?$_POST['direccion']:"";
  $celular=(isset($_POST['celular']))?$_POST['celular']:"";
  $referencia=(isset($_POST['referencia']))?$_POST['referencia']:"";
  $celular_referencia=(isset($_POST['celular_referencia']))?$_POST['celular_referencia']:"";
  $experiencia_laboral=(isset($_POST['experiencia_laboral']))?$_POST['experiencia_laboral']:"";
  $curriculum=(isset($_POST['curriculum']))?$_POST['curriculum']:"";
  $area=(isset($_POST['area']))?$_POST['area']:"";
  $id_area = intval(preg_replace('/[^0-9]+/', '', $area), 10);
  $nuevo_area = preg_replace('/[0-9]+/', '', $area);
  $ruta=(isset($_POST['ruta_curriculum']))?$_POST['ruta_curriculum']:"";
  $ruta2=(isset($_POST['ruta_imagen']))?$_POST['ruta_imagen']:"";
  $curriculum_persona = substr($ruta, 16); 
  $foto = substr($ruta2, 15); 
  $fecha_inicio=(isset($_POST['fecha_inicio']))?$_POST['fecha_inicio']:"";
  $fecha_final=(isset($_POST['fecha_final']))?$_POST['fecha_final']:"";
  $motivo_salida=(isset($_POST['motivo_salida']))?$_POST['motivo_salida']:"";
  $contrasenanueva=(isset($_POST['contrasena']))?$_POST['contrasena']:"";
  $contrasenaconfirmar=(isset($_POST['confirmar_contrasena']))?$_POST['confirmar_contrasena']:"";
  $usuario1 = $_SESSION; 

  date_default_timezone_set("America/Guatemala");
  
  $fechaactual = date("Y-m-d h:i:s");

  //variable para recuperar los botones de la vista administradores  
  $accion=(isset($_POST['accion']))?$_POST['accion']:"";
  
 ///////////////// INICIO SELECCIONAR LOS DATOS ACTUALES ////////////////////
 $mostrar_actuales = "SELECT * FROM (((((tbl_usuarios u
                       INNER JOIN tbl_generos g ON u.ID_GENERO = g.ID_GENERO)
                       INNER JOIN tbl_roles r ON u.ID_ROL = r.ID_ROL)
                       INNER JOIN tbl_areas a ON u.ID_AREA = a.ID_AREA)
                       INNER JOIN tbl_estado_usuario e ON u.ID_ESTADO_USUARIO = e.ID_ESTADO_USUARIO)
                       INNER JOIN tbl_profesiones p ON u.ID_PROFESION = p.ID_PROFESION) WHERE USUARIO!='ADMINISTRADOR'";
$sultados_actuales = $conn->query($mostrar_actuales);
if ($sultados_actuales->num_rows > 0) 
{
 while($datos_actuales = $sultados_actuales->fetch_assoc()) 
 {
    $ID_USUARIO = $datos_actuales["ID_USUARIO"];
    $ROL = $datos_actuales["ROL"];
    $ID_ROL = $datos_actuales["ID_ROL"];
    $ID_ESTADO_USUARIO = $datos_actuales["ID_ESTADO_USUARIO"];
    $ESTADO_ACTUAL = $datos_actuales["NOMBRE_ESTADO"];
    $NOMBRE = $datos_actuales["NOMBRE"];
    $APELLIDO = $datos_actuales["APELLIDO"];
    $GENERO = $datos_actuales["GENERO"];
    $ID_GENERO = $datos_actuales["ID_GENERO"];
    $DNI = $datos_actuales["DNI"];
    $PROFESION = $datos_actuales["PROFESION"];
    $ID_PROFESION = $datos_actuales["ID_PROFESION"];
    $DIRECCION = $datos_actuales["DIRECCION"];
    $CELULAR = $datos_actuales["CELULAR"];
    $REFERENCIA = $datos_actuales["REFERENCIA"];
    $CEL_REFERENCIA = $datos_actuales["CEL_REFERENCIA"];
    $EXPERIENCIA_LABORAL = $datos_actuales["EXPERIENCIA_LABORAL"];
    $AREA = $datos_actuales["AREA"];
    $ID_AREA = $datos_actuales["ID_AREA"];
    $FECHA_ENTRADA = $datos_actuales["FECHA_ENTRADA"];
    $FECHA_SALIDA = $datos_actuales["FECHA_SALIDA"];
    $MOTIVO_SALIDA = $datos_actuales["MOTIVO_SALIDA"];
  }
}
///////////////// FIN SELECCIONAR LOS DATOS ACTUALES ////////////////////

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

        }else
        {

          $permitidos = array("pdf", "docx");
          $extencion = pathinfo($_FILES['curriculum']["name"], PATHINFO_EXTENSION);
          
          if(in_array($extencion, $permitidos)){
              $Fecha= new DateTime();
              $destino ="../../curriculum/";
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
                  $destino1 ="../../imagenes/";
                  $nombrefoto=($_FILES['foto']["name"]!="")?$Fecha1->getTimestamp()."_".$_FILES["foto"]["name"]:"imagen.jpg";
                  $tmpArchivo1= $_FILES["foto"]["tmp_name"];
                  if($tmpArchivo1!="") 
                  {
                   move_uploaded_file($tmpArchivo1,$destino1.$nombrefoto);
                  }
          

              // Inserta en la tabla tbl_usuarios
              $sql = "INSERT INTO tbl_usuarios (ID_ROL, ID_ESTADO_USUARIO, NOMBRE, APELLIDO, USUARIO, ID_GENERO, CORREO, DNI, ID_PROFESION, DIRECCION, CELULAR, REFERENCIA, CEL_REFERENCIA, EXPERIENCIA_LABORAL, CURRICULUM, CONTRASENA, FOTO, ID_AREA,	FECHA_ENTRADA)
                            VALUES ($rol,$estado,'$nombre', '$apellido', '$usuario', '$genero', '$correo', '$dni', '$profesion',  '$direccionp', '$celular', '$referencia', '$celular_referencia', '$experiencia_laboral', '$destino$nombrecurriculum','$contrasena','$destino1$nombrefoto', '$area', '$fecha_inicio')";
              
              if (mysqli_query($conn, $sql)) {
                $last_id = $conn->insert_id;

                 // inicio inserta en la tabla bitacora
                  
                 $sql = "INSERT INTO tbl_bitacora (FECHA, USUARIO, OPERACION, PANTALLA, CAMPO, ID_REGISTRO,VALOR_ORIGINAL, VALOR_NUEVO)
                 VALUES ('$fechaactual', '$usuario1[usuario]', 'INSERTO','USUARIOS', 'TODOS','$last_id' ,'NUEVO','$usuario')";
                 if (mysqli_query($conn, $sql)) {} else {}
                 // fin inserta en la tabla bitacora




                echo '<script>
                              alert("Usuario creado con exito");
                              window.location.href="../../vistas/personas/vista_administradores.php";
                  </script>';

                 
                 
                
              } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                
              }
              
              mysqli_close($conn);
            }
            }
           } // fin del else principal
          }
        }
            
        
      break;

       //para editar en la tabla mysl      
      case "editar";

      ////////// extrae la extencion de la imagen ///////////
$tmpFoto1= $_FILES["imagenes"]["tmp_name"];
if($tmpFoto1!="") {
    $permitidos = array("jpg", "png", "jpeg", "JPEG", "JPG", "PNG");
    $extencion = pathinfo($_FILES['imagenes']["name"], PATHINFO_EXTENSION);
}else{
  $permitidos = array("jpg", "png", "jpeg", "JPEG", "JPG", "PNG");
    $extencion = "jpg";
}
$direccion = "$ruta2";


if(in_array($extencion, $permitidos))
{
    ///////// elimina la imagen anterior para colocar la nueva /////////
    $Fecha= new DateTime();
    $destino ="../../imagenes/";
    $nombreimagen=($_FILES['imagenes']["name"]!="")?$Fecha->getTimestamp()."_".$_FILES["imagenes"]["name"]:"$foto";
    $tmpFoto= $_FILES["imagenes"]["tmp_name"];
    if($tmpFoto!="") 
    {
     unlink($ruta2); 
     move_uploaded_file($tmpFoto,$destino.$nombreimagen);
    } 
    $direccion = "$destino$nombreimagen";

          ////////// extrae la extencion del curriculum ///////////
          $tmpFoto2= $_FILES["curriculum"]["tmp_name"];
          if($tmpFoto2!="") {
              $permitidos2 = array("pdf", "docx");
              $extencion2 = pathinfo($_FILES['curriculum']["name"], PATHINFO_EXTENSION);
          }else{
            $permitidos2 = array("pdf", "docx");
              $extencion2 = "pdf";
          }
          $direccion2 = "$ruta";

          if(in_array($extencion2, $permitidos2))
            {
                ///////// elimina el curriculum anterior para colocar el nuevo /////////
                $Fecha1= new DateTime();
                $destino1 ="../../curriculum/";
                $nombre_curriculum=($_FILES['curriculum']["name"]!="")?$Fecha1->getTimestamp()."_".$_FILES["curriculum"]["name"]:"$curriculum_persona";
                $tmpFoto7= $_FILES["curriculum"]["tmp_name"];
                if($tmpFoto7!="") 
                {
                 unlink($ruta); 
                 move_uploaded_file($tmpFoto7,$destino1.$nombre_curriculum);
                } 
                $direccion2 = "$destino1$nombre_curriculum";
          
                        //////////// inicio realiza el update ////////
                          $sql2 = "UPDATE tbl_usuarios SET ID_ROL='$rol', ID_ESTADO_USUARIO='$id_estado', NOMBRE='$nombre', 
                          APELLIDO='$apellido', USUARIO='$usuario', ID_GENERO='$genero', CORREO='$correo', DNI='$dni', 
                          ID_PROFESION='$profesion', DIRECCION='$direccionp', CELULAR='$celular', REFERENCIA='$referencia', 
                          CEL_REFERENCIA='$celular_referencia', EXPERIENCIA_LABORAL='$experiencia_laboral' , 
                          CURRICULUM='$direccion2', FOTO='$direccion' ,  
                          ID_AREA='$area',FECHA_ENTRADA='$fecha_inicio', FECHA_SALIDA='$fecha_final', MOTIVO_SALIDA='$motivo_salida' WHERE ID_USUARIO='$id_usuario'";
         
                                        
  
                                        if (mysqli_query($conn, $sql2)) 
                                        {
                                            
             // ////////////// INICIO FUNCION BITACORA /////////////////////
        
              if($ID_ROL != $id_rol) ///////////// 
              {
                include_once 'funcion_bitacora.php';
                bitacora('EDITO', 'USUARIOS', 'ROL', $id_usuario, $ROL, $nuevo_rol);
              }

              if($ID_ESTADO_USUARIO != $id_estado) ///////////// 
              {
                include_once 'funcion_bitacora.php';
                bitacora('EDITO', 'USUARIOS', 'NOMBRE ESTADO', $id_usuario, $ESTADO_ACTUAL, $estado_nuevo);
              }

              if($NOMBRE != $nombre) ///////////// 
              {
                include_once 'funcion_bitacora.php';
                bitacora('EDITO', 'USUARIOS', 'NOMBRE', $id_usuario, $NOMBRE, $nombre);
              }

              if($APELLIDO != $apellido) ///////////// 
              {
                include_once 'funcion_bitacora.php';
                bitacora('EDITO', 'USUARIOS', 'APELLIDO', $id_usuario, $APELLIDO, $apellido);
              }

              if($ID_GENERO != $id_genero) ///////////// 
              {
                include_once 'funcion_bitacora.php';
                bitacora('EDITO', 'USUARIOS', 'GENERO', $id_usuario, $GENERO, $nuevo_genero);
              }

              if($DNI != $dni) ///////////// 
              {
                include_once 'funcion_bitacora.php';
                bitacora('EDITO', 'USUARIOS', 'DNI', $id_usuario, $DNI, $dni);
              }

              if($ID_PROFESION != $id_profesion) ///////////// 
              {
                include_once 'funcion_bitacora.php';
                bitacora('EDITO', 'USUARIOS', 'PROFESION', $id_usuario, $PROFESION, $nuevo_profesion);
              }

              if($DIRECCION != $direccionp) ///////////// 
              {
                include_once 'funcion_bitacora.php';
                bitacora('EDITO', 'USUARIOS', 'DIRECCION', $id_usuario, $DIRECCION, $direccionp);
              }

              if($CELULAR != $celular) ///////////// 
              {
                include_once 'funcion_bitacora.php';
                bitacora('EDITO', 'USUARIOS', 'CELULAR', $id_usuario, $CELULAR, $celular);
              }

              if($REFERENCIA != $referencia) ///////////// 
              {
                include_once 'funcion_bitacora.php';
                bitacora('EDITO', 'USUARIOS', 'REFERENCIA', $id_usuario, $REFERENCIA, $referencia);
              }

              if($CEL_REFERENCIA != $celular_referencia) ///////////// 
              {
                include_once 'funcion_bitacora.php';
                bitacora('EDITO', 'USUARIOS', 'CELULAR REFERENCIA', $id_usuario, $CEL_REFERENCIA, $celular_referencia);
              }

              if($EXPERIENCIA_LABORAL != $experiencia_laboral) ///////////// 
              {
                include_once 'funcion_bitacora.php';
                bitacora('EDITO', 'USUARIOS', 'EXPERIENCIA LABORAL', $id_usuario, $EXPERIENCIA_LABORAL, $experiencia_laboral);
              }

              if($ID_AREA != $id_area) ///////////// 
              {
                include_once 'funcion_bitacora.php';
                bitacora('EDITO', 'USUARIOS', 'AREA', $id_usuario, $AREA, $nuevo_area);
              }

              $fecha_inicio = str_replace("T", " ", $fecha_inicio);
              $FECHA_ENTRADA = substr($FECHA_ENTRADA, 0, -3);
              if($FECHA_ENTRADA != $fecha_inicio) ///////////// 
              {
                include_once 'funcion_bitacora.php';
                bitacora('EDITO', 'USUARIOS', 'FECHA ENTRADA', $id_usuario, $FECHA_ENTRADA, $fecha_inicio);
              }

              $fecha_final = str_replace("T", " ", $fecha_final);
              $FECHA_SALIDA = substr($FECHA_SALIDA, 0, -3);
              if($FECHA_SALIDA != $fecha_final) ///////////// 
              {
                include_once 'funcion_bitacora.php';
                bitacora('EDITO', 'USUARIOS', 'FECHA SALIDA', $id_usuario, $FECHA_SALIDA, $fecha_final);
              }

              if($MOTIVO_SALIDA != $motivo_salida) ///////////// 
              {
                include_once 'funcion_bitacora.php';
                bitacora('EDITO', 'USUARIOS', 'FMOTIVO SALIDA', $id_usuario, $MOTIVO_SALIDA, $motivo_salida);
              }
      
         // ////////////// FIN FUNCION BITACORA ///////////////////////

                                            echo '<script>
                                                    alert("Edición exitosa");
                                                    window.location.href="../../vistas/personas/vista_administradores";
                                                  </script>';

                                        }else{
                                            echo '<script>
                                                    alert("Error en la edición ");
                                                    window.location.href="../../vistas/personas/vista_administradores";
                                                  </script>'; mysqli_error($conn);
                                            }
                                            mysqli_close($conn);
                                              //////////// fin realiza el update ////////

         ///////// else de no permitido de curriculum //////////////
        }else{
          
          echo '<script type="text/javascript">
                  alert("Archivo de curriculum, no permitido");
                  window.location.href="../../vistas/personas/vista_administradores";
               </script>';
      }

         ///////// else de no permitido de imagen //////////////
}else{
 
    echo '<script type="text/javascript">
            alert("Archivo de imagen, no permitido");
            window.location.href="../../vistas/personas/vista_administradores";
         </script>';
}
  

      break;

//---------------------------------------------------------------------------------------------------------

      
      //para eliminar en la tabla mysl  
      case "eliminar";
   
   $validar_compras = "SELECT * FROM tbl_compras WHERE USUARIO='$usuario'";
   $resultado_compras = mysqli_query($conn, $validar_compras); 
    if (mysqli_num_rows($resultado_compras) > 0) 
    { 
      echo '<script>
               alert("Error, el usuario esta en uso en la pantalla compras");
               window.location.href="../../vistas/personas/vista_administradores.php";                  
            </script>';
            mysqli_close($conn);       
    }else{
          $validar_kardex = "SELECT * FROM tbl_kardex WHERE USUARIO='$usuario'";
          $resultado_kardex = mysqli_query($conn, $validar_kardex); 
           if (mysqli_num_rows($resultado_kardex) > 0) 
            {
              echo '<script>
                       alert("Error, el usuario esta en uso en la pantalla transacciones");
                       window.location.href="../../vistas/personas/vista_administradores.php";                  
                    </script>';
                    mysqli_close($conn); 
            }else{
                    $validar_bitacora = "SELECT * FROM tbl_bitacora WHERE USUARIO='$usuario'";
                    $resultado_bitacora = mysqli_query($conn, $validar_bitacora); 
                    if (mysqli_num_rows($resultado_bitacora) > 0) 
                      { 
                        echo '<script>
                                alert("Error, el usuario esta en uso.");
                                window.location.href="../../vistas/personas/vista_administradores.php";                  
                              </script>';
                              mysqli_close($conn); 
                      }else{
                              $validar_respuestas = "SELECT * FROM tbl_respuestas_usuario WHERE USUARIO='$id_usuario'";
                              $resultado_respuestas = mysqli_query($conn, $validar_respuestas); 
                              if (mysqli_num_rows($resultado_respuestas) > 0)
                              {
                                echo '<script>
                                        alert("Error, el usuario esta en uso.");
                                        window.location.href="../../vistas/personas/vista_administradores.php";                  
                                      </script>';
                                      mysqli_close($conn); 

                              }else{
                                        ///////////////////////////   INICIO ELIMINA USUARIO //////////////
                                            date_default_timezone_set("America/Guatemala");
                                            $fechaE = date("Y-m-d h:i:s");

                                              $sql3 = "DELETE FROM tbl_usuarios WHERE ID_USUARIO='$id_usuario'";
                                              if (mysqli_query($conn, $sql3)) 
                                              {
                                                  // inicio inserta en la tabla bitacora
                                                    $sqlC = "INSERT INTO tbl_bitacora (FECHA,USUARIO, OPERACION, PANTALLA, CAMPO,ID_REGISTRO, VALOR_ORIGINAL, VALOR_NUEVO)
                                                            VALUES ('$fechaE','$usuario1[usuario]', 'ELIMINO','USUARIOS', 'USUARIO','$id_usuario', 'ELIMINADO','ELIMINADO')";
                                                    if (mysqli_query($conn, $sqlC)) {} else { }
                                                    // fin inserta en la tabla bitacora
                                                echo '<script>
                                                        alert("Usuario eliminado");
                                                      </script>';
                                                header('Location: ../../vistas/personas/vista_administradores');
                                            }else{
                                                    echo '<script>
                                                              alert("Error al tratar de eliminar usuario");
                                                          </script>'; 
                                                }
                                              mysqli_close($conn);

                                              ///////////////////////////   FIN ELIMINA USUARIO //////////////
                                   }


                           }

                 }
        }



      break;
      
////////////////////////////////// RESTABLECER CONTRASEÑA DE USUARIO ///////////////////////////////
    case "restablecer"; 
    date_default_timezone_set("America/Guatemala");

    $fechaAC = date("Y-m-d h:i:s");

    if($contrasenanueva == $contrasenaconfirmar){
      // encripta la contraseña
      $contrasenanueva= hash('sha512', $contrasenanueva);
      $contrasenaconfirmar= hash('sha512', $contrasenaconfirmar);

      $sqlresultadoC =  "UPDATE tbl_usuarios SET CONTRASENA='$contrasenanueva', USUARIO='$usuario' WHERE ID_USUARIO='$usuario_id'";
      if ($conn->query($sqlresultadoC) === TRUE) {

        // inicio inserta en la tabla bitacora
        $sqlC = "INSERT INTO tbl_bitacora (FECHA,USUARIO, OPERACION, PANTALLA, CAMPO,ID_REGISTRO, VALOR_ORIGINAL, VALOR_NUEVO)
                  VALUES ('$fechaAC','$usuario1[usuario]', 'EDITO','USUARIOS', 'CONTRASEÑA','$usuario_id', '*********','*********')";
          if (mysqli_query($conn, $sqlC)) {} else { }
        // fin inserta en la tabla bitacora
 
      } 
      //Deja en cero los intentos fallidos
      $conn = new mysqli($servername, $username, $password, $dbname);
      $sql =  "UPDATE tbl_usuarios SET intentos=0 WHERE USUARIO='$usuario'";
      if ($conn->query($sql) === TRUE) {

         
              $conn = new mysqli($servername, $username, $password, $dbname);
              $sqlb =  "UPDATE tbl_usuarios SET ID_ESTADO_USUARIO=1 WHERE USUARIO='$usuario'";
              if ($conn->query($sqlb) === TRUE) {}

             

             echo '<script>
                      alert("Contraseña Actualizada");
                      window.location.href="../../vistas/personas/vista_administradores.php";
                  </script>';

      }
      
    //  header('Location: ../tablero/vista_tablero.php');


    }else {
      
      echo '<script>
        alert("Las contraseñas ingresadas no coinciden");
        window.Location = "/vistas/personas/vista_administradores.php";
      </script>';
    }
    
    break;
    


    default:
          
    $conn->close();  
  }// Fin del switch, para validar el valor del boton accion


?>
