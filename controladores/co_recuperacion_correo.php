<?php
  require '../../conexion/conexion.php';
  

  // //Variables para recuperar la información de los campos de la vista recuperacion_correo
  $correo=(isset($_POST['correo']))?$_POST['correo']:"";
  $usuario=(isset($_POST['usuario']))?$_POST['usuario']:"";
  $usuario = $_SESSION; 

  $accion=(isset($_POST['accion']))?$_POST['accion']:"";
  
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../../PHPMailer/Exception.php';
require '../../PHPMailer/PHPMailer.php';
require '../../PHPMailer/SMTP.php';
  
  switch($accion){
      case "validar": 
            // Valida que el correo exista en la base de datos
            $recuperacion = "SELECT * FROM tbl_usuarios WHERE CORREO='$correo' and USUARIO='$usuario[nombre]'";
            $result = mysqli_query($conn, $recuperacion);
            if (mysqli_num_rows($result) > 0) {
                echo '<script>
                alert("Correo enviado exitosamente");
                window.location.href="../../vistas/iniciar_sesion/metodo_recuperacion.php";                   
              </script>';           

                      } else {  
                        echo '<script>
                                alert("Correo no encontrado en la base de datos");
                             </script>';
                     mysqli_close($conn);
                              
                              
                             }

                                          
      break;
      case "cancelar": 
//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->SMTPDebug = 0;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'seaccoc@gmail.com';                     //SMTP username
    $mail->Password   = 'lveucqeygmxrtigm';                               //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
    $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('seaccoc@gmail.com', 'Constructora SEACCO');
    $mail->addAddress($correo, 'Wilmer Cabrera');     //Add a recipient
    //$mail->addAddress('ellen@example.com');               //Name is optional
    //$mail->addReplyTo('info@example.com', 'Information');
    //$mail->addCC('cc@example.com');
    //$mail->addBCC('bcc@example.com');

    //Attachments
    //$mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
    //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'RESTAURACIÓN DE CONTRASEÑA';
    $mail->Body    = 'Hola '.$usuario.' Se ha iniciado un proceso de restauración de contraseña. Por favor ingrese al siguiente enlace';


    $mail->send();
    echo 'Mensaje enviado correctamente';
} catch (Exception $e) {
    echo "Error al enviar el mensaje: {$mail->ErrorInfo}";
}

            





        // remove all session variables
        session_unset();

        // destroy the session
        session_destroy();

        header('Location: ../../_login.php');

        break;
        default:
          
          $conn->close();   
  }// Fin del switch, para validar el valor del boton accion


?>