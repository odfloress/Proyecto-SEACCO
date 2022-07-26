<?php
  require '../../conexion/conexion.php';
  $sql = "SELECT * FROM tbl_nuestros_contactos";
  $result = mysqli_query($conn, $sql);


  // //Variables para recuperar la información de los campos de la vista categorias de productos
  $id_contacto=(isset($_POST['id_contacto']))?$_POST['id_contacto']:"";
  $telefono=(isset($_POST['telefono']))?$_POST['telefono']:"";
  $correo=(isset($_POST['correo']))?$_POST['correo']:"";
  $direccion=(isset($_POST['direccion']))?$_POST['direccion']:"";
  $facebook=(isset($_POST['facebook']))?$_POST['facebook']:"";
  $instagram=(isset($_POST['instagram']))?$_POST['instagram']:"";
  

  //variable para recuperar los botones de la vista categprias de productos  
  $accion=(isset($_POST['accion']))?$_POST['accion']:"";
  
  
  switch($accion){
      //para insertar en la tabla mysl
      case "agregar":

            //si no existe un proveedor permite insertar
                $sql1 = "INSERT INTO tbl_nuestros_contactos ( ID_CONTACTO,	TELEFONO,	CORREO,	DIRECCION,	FACEBOOK,	INSTAGRAM)
                VALUES ('$id_contacto','$telefono','$correo','$direccion','$facebook','$instagram')";
                if (mysqli_query($conn, $sql1)) {
                  // inicio inserta en la tabla bitacora
                  $sql7 = "INSERT INTO tbl_bitacora (USUARIO, ACCION, OBSERVACION)
                  VALUES ('$usuario1[usuario]', 'INSERTO', 'CREO EL CONTACTO')";
                   if (mysqli_query($conn, $sql7)) {} else { }
              // fin inserta en la tabla bitacora
                    header('Location: ../../vistas/ajustes/vista_nuestros_contactos.php');

                } else {
                        echo '<script>
                                alert("Error al tratar de crear el contacto");
                              </script>'; mysqli_error($conn);
                       }
                
                mysqli_close($conn);

             

             
      break;

       

    
      
    default:
          
    $conn->close();   
  }// Fin del switch, para validar el valor del boton accion


?>
