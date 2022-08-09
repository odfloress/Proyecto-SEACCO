<?php
include '../../conexion/conexion.php';
//para mostrar los datos de la tabla mysql y mostrar en el crud
$sql = "SELECT * FROM tbl_clientes";
$result = mysqli_query($conn, $sql);


// //Variables para recuperar la información de los campos de la vista del crud del portafolio 
// $id_imagen=(isset($_POST['id_imagen']))?$_POST['id_imagen']:"";
$codigo=(isset($_POST['codigo']))?$_POST['codigo']:"";
$nombre=(isset($_POST['nombre']))?$_POST['nombre']:"";
$apellido=(isset($_POST['apellido']))?$_POST['apellido']:"";
$correo=(isset($_POST['nombre']))?$_POST['correo']:"";
$telefono=(isset($_POST['telefono']))?$_POST['telefono']:"";
$direccion=(isset($_POST['direccion']))?$_POST['direccion']:"";
$referencia=(isset($_POST['referencia']))?$_POST['referencia']:"";
$genero=(isset($_POST['genero']))?$_POST['genero']:"";
$usuario1 = $_SESSION;
// $ruta=(isset($_POST['ruta']))?$_POST['ruta']:"";
// $foto=(isset($_POST['foto']))?$_POST['foto']:"";

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
                VALUES ('$codigo', '$nombre', '$apellido', '$correo', '$telefono', '$direccion', '$referencia', '$genero', '$destino$nombreimagen')";
                 $res = mysqli_query($conn, $sql);
                if($res){
                    // inicio inserta en la tabla bitacora
                    $sql = "INSERT INTO tbl_bitacora (USUARIO, ACCION, OBSERVACION)
                    VALUES ('$usuario1[usuario]', 'INSERTO', 'REGISTRO EL CLIENTE ($nombre) EN LA PANTALLA CLIENTES')";
                    if (mysqli_query($conn, $sql)) {} else {}
                    // fin inserta en la tabla bitacora

                    echo '<script type="text/javascript">
                            alert("Creado con exito");
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
    VALUES ('$usuario1[usuario]', 'INTENTO', 'NO LOGRO INSERTAR YA QUE EL ARCHIVO NO ERA IMAGEN EN LA PATALLA CLIENTES')";
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
$direccion = "$ruta";

if(in_array($extencion, $permitidos))
{
    $Fecha= new DateTime();
    $destino ="../../imagenes/";
    $nombreimagen=($_FILES['imagenes']["name"]!="")?$Fecha->getTimestamp()."_".$_FILES["imagenes"]["name"]:"$foto";
    $tmpFoto= $_FILES["imagenes"]["tmp_name"];
    if($tmpFoto!="") 
    {
     unlink($ruta); 
     move_uploaded_file($tmpFoto,$destino.$nombreimagen);
    } 
    $direccion = "$destino$nombreimagen";

    
    $sql2 = "UPDATE tbl_bienvenida_portafolio SET TIPO='$tipo', IMAGEN='$nombreimagen', RUTA='$direccion', TITULO='$titulo', DESCRIPCION='$descripcion' WHERE ID_IMAGEN='$id_imagen'";
    if (mysqli_query($conn, $sql2)) 
    {
        // inicio inserta en la tabla bitacora
        $sql = "INSERT INTO tbl_bitacora (USUARIO, ACCION, OBSERVACION)
        VALUES ('$usuario1[usuario]', 'EDITO', 'EDITO UN REGISTRO DE TIPO ($tipo) Y TITULO ($titulo)')";
        if (mysqli_query($conn, $sql)) {} else {}
         // fin inserta en la tabla bitacora
        echo '<script>
                 alert("Edición exitosa");
                 window.location.href="../../vistas/catalogo/vista_portafolio";
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
    VALUES ('$usuario1[usuario]', 'INTENTO', 'NO LOGRO EDITAR YA QUE EL ARCHIVO NO ERA IMAGEN')";
    if (mysqli_query($conn, $sql)) {} else {}
    // fin inserta en la tabla bitacora
    echo '<script type="text/javascript">
            alert("Archivo no permitido");
            window.location.href="../../vistas/catalogo/vista_portafolio";
         </script>';
}
  

break;


//para eliminar en la tabla mysl  
$validar_proveedor = "SELECT * FROM tbl_clientes WHERE ID_CLIENTE='$id_cliente'";
    $result4 = mysqli_query($conn, $validar_proveedor); 
     if (mysqli_num_rows($result4) > 0) { 
         // inicio inserta en la tabla bitacora
         $sql9 = "INSERT INTO tbl_bitacora (USUARIO, ACCION, OBSERVACION)
         VALUES ('$usuario1[usuario]', 'INTENTO', 'NO LOGRO ELIMINAR YA QUE ESTABA EN USO EL cliente ($nombre)')";
         if (mysqli_query($conn, $sql9)) {} else { }
         // fin inserta en la tabla bitacora
         echo '<script>
                 alert("No se puede eliminar el producto, ya que esta en uso");
                 window.location.href="../../vistas/inventario/vista_clientes.php";                   
               </script>';
               mysqli_close($conn);

     }else{
      $sql3 = "DELETE FROM tbl_clientes WHERE ID_CLIENTE='$id_cliente'";
      if (mysqli_query($conn, $sql3)) {
        // inicio inserta en la tabla bitacora
        $sql7 = "INSERT INTO tbl_bitacora (USUARIO, ACCION, OBSERVACION)
        VALUES ('$usuario1[usuario]', 'ELIMINO', 'ELIMINO EL PRODUCTO ($nombre)')";
         if (mysqli_query($conn, $sql7)) {} else { }
    // fin inserta en la tabla bitacora
    echo '<script>
        alert("Elimino el cliente");
        window.location.href="../../vistas/personas/vista_clientes.php";                   
        </script>';
        mysqli_close($conn);
     
          
      }else{
         // inicio inserta en la tabla bitacora
         $sql10 = "INSERT INTO tbl_bitacora (USUARIO, ACCION, OBSERVACION)
         VALUES ('$usuario1[usuario]', 'ERROR', 'ERROR AL ELIMINAR EL Producto ($id_cliente)')";
          if (mysqli_query($conn, $sql7)) {} else { }
     // fin inserta en la tabla bitacora
              echo '<script>
                        alert("Error al tratar de eliminar el producto");
                    </script>'; mysqli_error($conn);
           }
        mysqli_close($conn);
      }
    
      break;
      
      default:
          
          $conn->close();   
  }// Fin del switch, para validar el valor del boton accion


?>
