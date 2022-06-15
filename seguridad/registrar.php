<?php
require 'conexion.php';
$nombre=(isset($_POST['nombre']))?$_POST['nombre']:"";
$correo=(isset($_POST['correo']))?$_POST['correo']:"";
$usuario=(isset($_POST['usuario']))?$_POST['usuario']:"";

$contrasena=(isset($_POST['contrasena']))?$_POST['contrasena']:"";
$accion=(isset($_POST['accion']))?$_POST['accion']:"";

  // encripta la contraseña
$contrasena= hash('sha512', $contrasena);

switch($accion){
    case "registrar": // es insertar por que el valor del boton es insertar
     // validar que no se repita el correo
     $validar_correo = "SELECT * FROM usuarios WHERE correo='$correo'";
     $result = mysqli_query($conn, $validar_correo);
     
     if (mysqli_num_rows($result) > 0) {
       
 
         echo '<script>
                 alert("el correo ya existe, intente con otro");
                 window.Location = "/index_registrar.php";
               </script>';
              
               
              mysqli_close($conn);
               
     }else{



     $sql = "INSERT INTO usuarios (nombre, correo, usuario, contrasena)
                    VALUES ('$nombre', '$correo', '$usuario', '$contrasena')";


// Insertar en la bd
                if (mysqli_query($conn, $sql)) {
                  echo '<script>
                          alert("usuario creado con exito");
                          window.Location = "/index_registrar.php";
                        </script>';
                        $error = 1;
                } else {
                  echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                }

                mysqli_close($conn);
                    
              }
                   
    break;
    case "calcular":
      $nu= 1;
      if($nu === 1){
        $error ="Hola";
      }
     

    
      default:
        // echo "algo salio mal";
        $conn->close();   
}


?>
