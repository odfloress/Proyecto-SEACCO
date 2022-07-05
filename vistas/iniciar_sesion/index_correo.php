
<?php
session_start();
require '../../conexion/conexion.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

$result="";
$enlace = "http://localhost/SEACCO/vistas/iniciar_sesion/index_restablecer.php";

if(isset($_POST['submit'])){
    require '../../PHPMailer/Exception.php';
    require '../../PHPMailer/PHPMailer.php';
    require '../../PHPMailer/SMTP.php';

    $correo=(isset($_POST['correo']))?$_POST['correo']:"";

    $mail = new PHPMailer(true);
  // Valida que exista el correo
  $validar_correo = "SELECT * FROM tbl_usuarios WHERE CORREO='$correo'";
  $resultado = mysqli_query($conn, $validar_correo); 
  if (mysqli_num_rows($resultado) > 0) { 

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
          $mail->Password   = 'lveucqeygmxrtigm';                               //SMTP password
          $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
          $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

          //Recipients
          $mail->setFrom('seaccoc@gmail.com', 'Constructora SEACO');
          $mail->addAddress($_POST['correo'],'Usuario');     //Add a recipient
          //$mail->addAddress('ellen@example.com');               //Name is optional
          //$mail->addReplyTo('info@example.com', 'Information');
          //$mail->addCC('cc@example.com');
          //$mail->addBCC('bcc@example.com');

          //Attachments
          //$mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
          //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

          //Content
          $mail->isHTML(true);                                  //Set email format to HTML
          $mail->Subject = 'Cambio de contraseña';
          $mail->Body    = 'Ingrese al enlace para cambiar la contraseña: </b>'.$enlace ;
          //$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

          $mail->send();
              echo '<script>
                      alert("Correo enviado exitosamente");
                  </script>';
      } catch (Exception $e) {
          echo "Error al enviar el mensaje: {$mail->ErrorInfo}";
      }
          if(!$mail->send()){
              $result="Algo esta mal, por favor inténtelo de nuevo.";
          }
          else{
              $result="Gracias correo enviado exitosamente. Revise su correo!!!";
          }
  }else{
    echo '<script>
            alert("El correo no existe");
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

<br><br>
<!-- El Modal -->

  <div  class="modal-dialog" >
    <div class="modal-content " >     

      <!--Inicio Cuerpo del modal -->
      <div class="modal-body ">
        <form action="" method="post"
            <div class="mb-3 mt-3">
               <center><img src="../../imagenes/seacco.jpg" alt="Girl in a jacket" width="150" height="150"><br></center>
                <div class="alert alert-success">
                  <strong>¿Olvidó su contraseña?</strong> No hay problema. Simplemente déjenos saber su dirección de correo electrónico y le enviaremos un enlace para restablecer la contraseña que le permitirá elegir una nueva.
                </div>
              <label for="email" class="form-label">Correo:</label>
              <input style="background-color:rgb(240, 244, 245);" type="email" class="form-control"  placeholder="Ingrese el correo" name="correo">
              <center><div><p class="text-success"><?= $result; ?></p></div></center>
            </div>
        
            <button type="submit" name="submit" class="btn btn-primary btn-block">Enviar</button><br> 
            <a href="http://localhost/SEACCO/_login" class="btn btn-danger btn-block">Regresar</a><br>
             
        </form>
      </div>
       <!--Fin Cuerpo del modal -->
    </div>
  </div>


</body>
</html>

