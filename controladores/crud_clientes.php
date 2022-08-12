<?php
include '../../conexion/conexion.php';
//para mostrar los datos de la tabla mysql y mostrar en el crud
$sql = "SELECT * FROM tbl_clientes";
$result = mysqli_query($conn, $sql);


// //Variables para recuperar la información de los campos de la vista del crud del portafolio 
// $id_imagen=(isset($_POST['id_imagen']))?$_POST['id_imagen']:"";


$id_cliente=(isset($_POST['id_cliente']))?$_POST['id_cliente']:"";
$codigo=(isset($_POST['codigo']))?$_POST['codigo']:"";
$nombre=(isset($_POST['nombre']))?$_POST['nombre']:"";
$apellido=(isset($_POST['apellido']))?$_POST['apellido']:"";
$correo=(isset($_POST['correo']))?$_POST['correo']:"";
$telefono=(isset($_POST['telefono']))?$_POST['telefono']:"";
$direccionp=(isset($_POST['direccion']))?$_POST['direccion']:"";
$referencia=(isset($_POST['referencia']))?$_POST['referencia']:"";
$genero=(isset($_POST['genero']))?$_POST['genero']:"";
$id_genero=(isset($_POST['id_genero']))?$_POST['id_genero']:"";
$usuario1 = $_SESSION;
// $ruta=(isset($_POST['ruta']))?$_POST['ruta']:"";
$foto2=(isset($_POST['foto']))?$_POST['foto']:"";
$foto1 = substr($foto2, 15); 

//variable para recuperar los botones de la vista del crud del portafolio 
$accion=(isset($_POST['accion']))?$_POST['accion']:"";

//variable de sesion
$usuario1 = $_SESSION;
                                      
switch($accion){
                                      ///////////  INSERTA EN CLIENTES /////////////
case "agregar": 
$permitidos = array("jpg", "png", "jpeg", "JPEG", "JPG", "PNG");
$extencion = pathinfo($_FILES['imagenes']["name"], PATHINFO_EXTENSION);

if(in_array($extencion, $permitidos)){
    $Fecha= new DateTime();
    $destino ="../../imagenes/";
    $nombreimagen=($_FILES['imagenes']["name"]!="")?$Fecha->getTimestamp()."_".$_FILES["imagenes"]["name"]:"imagen.jpg";
    $tmpFoto= $_FILES["imagenes"]["tmp_name"];
    if($tmpFoto!="") 
    {
     move_uploaded_file($tmpFoto,$destino.$nombreimagen);
    } 

    //validar si existe un correo con el mismo nommbre
    $validar_correo = "SELECT * FROM tbl_clientes WHERE CORREO='$correo'";
    $result4 = mysqli_query($conn, $validar_correo); 
     if (mysqli_num_rows($result4) > 0) 
     { 
            echo '<script type="text/javascript">
                       alert("Correo ya existe, intente con otro");
                  </script>';
     }else{
            // INICIO INSERTA EN LA TABLA CLIENTES
                $sql = "INSERT INTO tbl_clientes (CODIGO, NOMBRE_CLIENTE, APELLIDO, CORREO, TELEFONO, DIRECCION, REFERENCIA, ID_GENERO, FOTO)
                VALUES ('$codigo', '$nombre', '$apellido', '$correo', '$telefono', '$direccionp', '$referencia', '$genero', '$destino$nombreimagen')";
                 $res = mysqli_query($conn, $sql);
                if($res){
                    // inicio inserta en la tabla bitacora
                    $sql = "INSERT INTO tbl_bitacora (USUARIO, ACCION, OBSERVACION)
                    VALUES ('$usuario1[usuario]', 'INSERTO', 'REGISTRO EL CLIENTE ($nombre) EN LA PANTALLA ADMINISTRATIVA CLIENTES')";
                    if (mysqli_query($conn, $sql)) {} else {}
                    // fin inserta en la tabla bitacora

                    echo '<script type="text/javascript">
                            alert("Cliente creado con exito");
                            window.location.href="../../vistas/personas/vista_clientes.php";
                        </script>';
                }else{           
                        echo '<script type="text/javascript">
                                alert("Error al insertar");
                            </script>';
                      }
                // FIN INSERTA EN LA TABLA CLIENTES

          }

          
}else{
    // inicio inserta en la tabla bitacora
    $sql = "INSERT INTO tbl_bitacora (USUARIO, ACCION, OBSERVACION)
    VALUES ('$usuario1[usuario]', 'INTENTO', 'NO LOGRO INSERTAR YA QUE EL ARCHIVO NO ERA IMAGEN EN LA PANTALLA ADMINISTRATIVA CLIENTES')";
    if (mysqli_query($conn, $sql)) {} else {}
    // fin inserta en la tabla bitacora
    echo '<script type="text/javascript">
             alert("Archivo no permitido");
             window.location.href="../../vistas/personas/vista_clientes.php";
          </script>';
}

break;

case "editar": 
  

$tmpFoto1= $_FILES["imagenes"]["tmp_name"];
if($tmpFoto1!="") {
    $permitidos = array("jpg", "png", "jpeg", "JPEG", "JPG", "PNG");
    $extencion = pathinfo($_FILES['imagenes']["name"], PATHINFO_EXTENSION);
    

}else{
    $permitidos = array("jpg", "png", "jpeg", "JPEG", "JPG", "PNG");
    $ultimo = "jpg";
    $extencion = "$ultimo";
}
$direccion = "$foto2";

if(in_array($extencion, $permitidos))
{
    $Fecha= new DateTime();
    $destino ="../../imagenes/";
    $nombreimagen=($_FILES['imagenes']["name"]!="")?$Fecha->getTimestamp()."_".$_FILES["imagenes"]["name"]:"$foto1";
    $tmpFoto= $_FILES["imagenes"]["tmp_name"];
    if($tmpFoto!="") 
    {
     unlink($foto); 
     move_uploaded_file($tmpFoto,$destino.$nombreimagen);
    } 
    $direccion = "$destino$nombreimagen";

    
    $sql2 = "UPDATE tbl_clientes SET CODIGO='$codigo', NOMBRE_CLIENTE='$nombre', APELLIDO='$apellido', 
        CORREO='$correo', TELEFONO='$telefono',  DIRECCION='$direccionp', REFERENCIA='$referencia', ID_GENERO='$id_genero',FOTO='$direccion' 
        WHERE ID_CLIENTE='$id_cliente'";
    if (mysqli_query($conn, $sql2)) 
    {
        // inicio inserta en la tabla bitacora
        $sql = "INSERT INTO tbl_bitacora (USUARIO, ACCION, OBSERVACION)
        VALUES ('$usuario1[usuario]', 'EDITO', 'EDITO EL CLIENTE ($nombre) EN LA PANTALLA ADMINISTRATIVA CLIENTES')";
        if (mysqli_query($conn, $sql)) {} else {}
         // fin inserta en la tabla bitacora
        echo '<script>
                 alert("Edición exitosa");
                 window.location.href="../../vistas/personas/vista_clientes.php";
              </script>';

    }else{
         echo '<script>
                alert("Error en la edición ");
               </script>'; mysqli_error($conn);
         }
         mysqli_close($conn);
}else{
    // inicio inserta en la tabla bitacora
    $sql = "INSERT INTO tbl_bitacora (USUARIO, ACCION, OBSERVACION)
    VALUES ('$usuario1[usuario]', 'INTENTO', 'NO LOGRO EDITAR YA QUE EL ARCHIVO NO ERA IMAGEN EN LA PANTALLA ADMINISTRATIVA CLIENTES')";
    if (mysqli_query($conn, $sql)) {} else {}
    // fin inserta en la tabla bitacora
    echo '<script type="text/javascript">
            alert("Archivo no permitido");
            window.location.href="../../vistas/personas/vista_clientes.php";
         </script>';
}
  

break;


//para eliminar en la tabla mysl  
case "eliminar";
$validar_proveedor = "SELECT * FROM  tbl_proyectos WHERE ID_CLIENTE='$id_cliente'";
    $result4 = mysqli_query($conn, $validar_proveedor); 
     if (mysqli_num_rows($result4) > 0) { 
         // inicio inserta en la tabla bitacora
         $sql9 = "INSERT INTO tbl_bitacora (USUARIO, ACCION, OBSERVACION)
         VALUES ('$usuario1[usuario]', 'INTENTO', 'NO LOGRO ELIMINAR YA QUE ESTABA EN USO EL CLIENTE ($nombre) EN LA PANTALLA ADMINISTRATIVA CLIENTES')";
         if (mysqli_query($conn, $sql9)) {} else { }
         // fin inserta en la tabla bitacora
         echo '<script>
                 alert("No se puede eliminar el cliente, ya que esta en uso");
                 window.location.href="../../vistas/personas/vista_clientes.php";                   
               </script>';
               mysqli_close($conn);

     }else{
      $sql3 = "DELETE FROM tbl_clientes WHERE ID_CLIENTE='$id_cliente'";
      if (mysqli_query($conn, $sql3)) {
        // inicio inserta en la tabla bitacora
        $sql7 = "INSERT INTO tbl_bitacora (USUARIO, ACCION, OBSERVACION)
        VALUES ('$usuario1[usuario]', 'ELIMINO', 'ELIMINO EL CLIENTE ($nombre)')";
         if (mysqli_query($conn, $sql7)) {} else { }
    // fin inserta en la tabla bitacora
    echo '<script>
        alert("Cliente eliminado con exito");
        window.location.href="../../vistas/personas/vista_clientes.php";                   
        </script>';
        mysqli_close($conn);
     
          
      }else{
         // inicio inserta en la tabla bitacora
         $sql10 = "INSERT INTO tbl_bitacora (USUARIO, ACCION, OBSERVACION)
         VALUES ('$usuario1[usuario]', 'ERROR', 'ERROR AL ELIMINAR EL CLIENTE ($id_cliente) EN LA PANTALLA ADMINISTRATIVA CLIENTES')";
          if (mysqli_query($conn, $sql7)) {} else { }
     // fin inserta en la tabla bitacora
              echo '<script>
                        alert("Error al tratar de eliminar el cliente");
                    </script>'; mysqli_error($conn);
           }
        mysqli_close($conn);
      }
    
      break;
      
      default:
          
          $conn->close();   
  }// Fin del switch, para validar el valor del boton accion


?>
