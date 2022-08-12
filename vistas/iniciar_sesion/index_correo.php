
<?php
session_start();
if(!isset($_SESSION['correo'])){
 
        header('Location: ../../_login.php');
        session_unset();
        session_destroy();
        die();
        
}
require '../../conexion/conexion.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

$result = "";
$enlace = "http://localhost/SEACCO/vistas/iniciar_sesion/index_restablecer.php";
$logo = "https://ingenieriacivilyarquitectura.com/wp-content/uploads/2022/04/ideas-de-casas-modernas-1.jpg";

if(isset($_POST['submit'])){
    require '../../PHPMailer/Exception.php';
    require '../../PHPMailer/PHPMailer.php';
    require '../../PHPMailer/SMTP.php';

      date_default_timezone_set('America/Guatemala');
      $fecha_actual = date("Y-m-d H:i:s");
      $fecha_siguiente = date("Y-m-d H:i:s",strtotime($fecha_actual."+ 1 days")-1);
    
     
    $correo=(isset($_POST['correo']))?$_POST['correo']:"";
    $token=(isset($_POST['token']))?$_POST['token']:"";
  
      
    
    $mail = new PHPMailer(true);
  // Valida que exista el correo
  $validar_correo = "SELECT * FROM tbl_usuarios WHERE CORREO='$correo' and USUARIO='$_SESSION[correo]'";
  $resultado = mysqli_query($conn, $validar_correo); 
  if (mysqli_num_rows($resultado) > 0) { 

    while($row = mysqli_fetch_assoc($resultado))
     {
       $nombre_persona = $row['NOMBRE']. " ". $row['APELLIDO'] ;
     }
     


      try {

          $mail->SMTPOptions = array(
              'ssl' => array(
              'verify_peer' => false,
              'verify_peer_name' => false,
              'allow_self_signed' => true
              )
          );

          //Server settings
          $mail->SMTPDebug = 0;                      //Enable verbose debug output
          $mail->isSMTP();                                            //Send using SMTP
          $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
          $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
          $mail->Username   = 'seaccoc@gmail.com';                     //SMTP username
          $mail->Password   = 'plhmloymsptqqhpc';                               //SMTP password
          $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
          $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

          //Recipients
          $mail->setFrom('seaccoc@gmail.com', 'Constructora SEACCO');
          $mail->addAddress($_POST['correo'],'Usuario');     //Add a recipient
          //$mail->addAddress('ellen@example.com');               //Name is optional
          //$mail->addReplyTo('info@example.com', 'Information');
          //$mail->addCC('cc@example.com');
          //$mail->addBCC('bcc@example.com');

          //Attachments
          //$mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
          //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

          //Content
          $mail->isHTML(true);                                  //Set email format to HTML      es la letra ñ (&ntilde;)
          $mail->Subject = 'Cambio de contraseña';
          $mail->Body    = '<h3>¡Hola! '.$nombre_persona.'</h3> <img src="'.$logo.'" alt=""><br>
          Est&aacute; recibiendo este correo electr&oacute;nico porque recibimos una solicitud de restablecimiento de contrase&ntilde;a para su cuenta. Tu token es:<br>

        
          <h3>'.$token.'</h3> <br>
          <b>El token tiene una duración de 24 horas,</b> presione <a type="button" href="http://localhost/SEACCO/vistas/iniciar_sesion/index_restablecer.php">aqu&iacute;</a> para recuperar la contrase&ntildea <br><br>
          Si no solicit&oacute; un restablecimiento de contrase&ntilde;a, no se requiere ninguna otra acci&oacute;n. <br>
          Saludos,  Constructora SEACCO S. De R.L.';
          //$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
         $mail->CharSet = 'UTF-8';
          $mail->send();

          // inicio inserta en la tabla bitacora
            $sqlB2 = "INSERT INTO tbl_bitacora (USUARIO, ACCION, OBSERVACION)
              VALUES ('$_SESSION[correo]', 'SOLICITO', 'SOLICITO CAMBIO DE CONTRASEÑA POR CORREO')";
              if (mysqli_query($conn, $sqlB2)) {} else { }
          // fin inserta en la tabla bitacora
       
              echo '<script>
                      alert("Correo enviado exitosamente");
                      window.location.href="../../_login.php";
                  </script>';
      } catch (Exception $e) {
          echo "Error al enviar el mensaje: {$mail->ErrorInfo}";
      }
          // if(!$mail->send()){
          //     $result="Algo esta mal, por favor inténtelo de nuevo.";
          // }
          // else{
          //     $result="Gracias correo enviado exitosamente. Revise su correo!!!";
          // }
          $token= hash('sha512', $token);
          //Inicio inserta el token
          include '../../conexion/conexion.php';
          $sql77 = "UPDATE tbl_usuarios SET TOKEN='$token', VENCIMIENTO_TOKEN='$fecha_siguiente' WHERE USUARIO='$_SESSION[correo]'";
          if ($conn->query($sql77) === TRUE) {}
          // fin inserta el token
    
  }else{
    echo '<script>
            alert("correo  electrónico no coincide");
            window.location.href="../../vistas/iniciar_sesion/index_correo.php";
          </script>';
  }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Metodo correo</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
  <style> 
body {
  background-image: url('../../imagenes/fondo.jpg');
  background-repeat: no-repeat;
  background-attachment: fixed; 
  background-size: 100% 100%;
}

</style>
 
</head>
<body>

<!-- inicio oculta el codigo fuente de la pagina -->
<body oncontextmenu="return false">
<!-- Fin oculta el codigo fuente de la pagina --> 

<?php 
function generate_string($strength)
{
  
  $input = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
  $input_length = strlen($input);
  $random_string = "";
  for($i = 0; $i < $strength; $i ++){
    $random_character = $input[mt_rand(0, $input_length -1)];
    $random_string .= $random_character; 
  }
  return $random_string;
}

// echo generate_string(5);

?>

<br><br>
<!-- El Modal -->

  <div  class="modal-dialog" >
    <div class="modal-content " >     

      <!--Inicio Cuerpo del modal -->
      <div class="modal-body ">
        <form action="" method="post">
            <div class="mb-3 mt-3">
               <center><img src="../../imagenes/seacco.jpg" alt="Girl in a jacket" width="150" height="150"><br></center>
                <div class="alert alert-success">
                  <strong>¿Olvidó su contraseña?</strong> No hay problema. Simplemente déjenos saber su dirección de correo electrónico y le enviaremos un enlace para restablecer la contraseña que le permitirá elegir una nueva.
                </div>
              <label for="email" class="form-label">Correo:</label>
              <input style="background-color:rgb(240, 244, 245);" autocomplete = "off" type="email" class="form-control"  placeholder="Ingrese el correo" name="correo">
              <center><div><p class="text-success"><?= $result; ?></p></div></center>
              <input type="hidden" lang="es" href="qa-html-language-declarations.es" name="token" value="<?php echo generate_string(7); ?>">
            </div>
            <div class="d-grid">
            <button type="submit" name="submit" class="btn btn-primary btn-block">Enviar</button><br> 
            <a href="http://localhost/SEACCO/_login" class="btn btn-danger btn-block">Regresar</a><br>
            </div>
            
        </form>
      </div>
       <!--Fin Cuerpo del modal -->
    </div>
  </div>


</body>
</html>
