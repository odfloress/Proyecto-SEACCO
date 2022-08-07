<?php
include '../../conexion/conexion.php';


// //Variables para recuperar la información de los campos de la vista del crud de productos
// $id_imagen=(isset($_POST['id_imagen']))?$_POST['id_imagen']:"";

$id_categoria=(isset($_POST['id_categoria']))?$_POST['id_categoria']:"";
$codigo=(isset($_POST['codigo']))?$_POST['codigo']:"";
$nombre=(isset($_POST['nombre']))?$_POST['nombre']:"";
$descripcion_modelo=(isset($_POST['descripcion_modelo']))?$_POST['descripcion_modelo']:"";


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
    //$validar_correo = "SELECT * FROM tbl_clientes WHERE CORREO='$correo'";
    //$result4 = mysqli_query($conn, $validar_correo); 
     //if (mysqli_num_rows($result4) > 0) 
     { 
      //      echo '<script type="text/javascript">
      //                 alert("Correo ya existe, intente con otro");
       //           </script>';
     //}else{
            // INICIO INSERTA EN LA TABLA PRODUCTOS
                $sql = "INSERT INTO tbl_productos ( ID_CATEGORIA, FOTO, CODIGO, NOMBRE, DESCRIPCION_MODELO )
                VALUES ('$id_categoria', '$nombreimagen', '$codigo', '$nombre', '$descripcion_modelo','$destino$nombreimagen')";
                 $res = mysqli_query($conn, $sql);
                if($res){
                    // inicio inserta en la tabla bitacora
                    $sql = "INSERT INTO tbl_bitacora (USUARIO, ACCION, OBSERVACION)
                    VALUES ('$usuario1[usuario]', 'INSERTO', 'REGISTRO EL PRODUCTO ($nombre) EN LA PANTALLA PRODUCTOS')";
                    if (mysqli_query($conn, $sql)) {} else {}
                    // fin inserta en la tabla bitacora

                    echo '<script type="text/javascript">
                            alert("Creado con exito");
                            window.location.href="../../vistas/personas/vista_productOs.php";
                        </script>';
                }else{           
                        echo '<script type="text/javascript">
                                alert("Error al insertar");
                            </script>';
                      }
                // FIN INSERTA EN LA TABLA PRODUCTOS

          }

          
}else{
    // inicio inserta en la tabla bitacora
    $sql = "INSERT INTO tbl_bitacora (USUARIO, ACCION, OBSERVACION)
    VALUES ('$usuario1[usuario]', 'INTENTO', 'NO LOGRO INSERTAR YA QUE EL ARCHIVO NO ERA IMAGEN EN LA PATALLA PRODUCTOS')";
    if (mysqli_query($conn, $sql)) {} else {}
    // fin inserta en la tabla bitacora
    echo '<script type="text/javascript">
             alert("Archivo no permitido");
             window.location.href="../../vistas/catalogo/vista_portafolio";
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
                 window.location.href="../../vistas/catalogo/vista_producto";
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
            window.location.href="../../vistas/catalogo/vista_producto";
         </script>';
}
  

break;


//para eliminar en la tabla mysl  
case "eliminar";
echo $ruta;
echo $id_imagen;


$sql3 = "DELETE FROM tbl_bienvenida_portafolio WHERE ID_IMAGEN='$id_imagen'";
if (mysqli_query($conn, $sql3)) {
    unlink($ruta);
    // inicio inserta en la tabla bitacora
    $sql = "INSERT INTO tbl_bitacora (USUARIO, ACCION, OBSERVACION)
    VALUES ('$usuario1[usuario]', 'ELIMINO', 'ELIMINO UN REGISTRO DE TIPO ($tipo) Y TITULO ($titulo) ')";
    if (mysqli_query($conn, $sql)) {} else {}
    // fin inserta en la tabla bitacora
    header('Location: ../../vistas/catalogo/vista_portafolio');
}else{
        echo '<script>
                  alert("Error al tratar de eliminar categoria");
              </script>'; mysqli_error($conn);
     }
  mysqli_close($conn);

break;


}
?>

