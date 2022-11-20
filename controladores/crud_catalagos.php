<?php
include '../../conexion/conexion.php';


// //Variables para recuperar la información de los campos de la vista del crud del portafolio 
$id_imagen=(isset($_POST['id_imagen']))?$_POST['id_imagen']:"";
$titulo=(isset($_POST['titulo']))?$_POST['titulo']:"";
$descripcion=(isset($_POST['descripcion']))?$_POST['descripcion']:"";
$ruta=(isset($_POST['ruta']))?$_POST['ruta']:"";
$foto = substr($ruta, 15);


//variable para recuperar los botones de la vista del crud del portafolio 
$accion=(isset($_POST['accion']))?$_POST['accion']:"";

//variable de sesion
$usuario1 = $_SESSION;

switch($accion){
//para insertar en la tabla mysl
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
        $sql = "INSERT INTO tbl_catalogo (RUTA, NOMBRE_CATALOGO, DESCRIPCION)
                VALUES ('$destino$nombreimagen', '$titulo', '$descripcion')";
        $res = mysqli_query($conn, $sql);
         if($res){
            
            echo '<script type="text/javascript">
                     alert("Agregado correctamente");
                     window.location.href="../../vistas/catalogo/vista_catalagos";
                 </script>';
         }else{
                die("Error". mysqli_error($conn));
              }
}else{
    
    echo '<script type="text/javascript">
             alert("Archivo no permitido");
             window.location.href="../../vistas/catalogo/vista_catalagos.php";
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

    
    $sql2 = "UPDATE tbl_catalogo SET   RUTA='$direccion', NOMBRE_CATALOGO='$titulo', DESCRIPCION='$descripcion' WHERE ID_CATALOGO='$id_imagen'";
    if (mysqli_query($conn, $sql2)) 
    {
        
        echo '<script>
                 alert("Edición exitosa");
                 window.location.href="../../vistas/catalogo/vista_catalagos";
              </script>';

    }else{
         echo '<script>
                alert("Error en la edición ");
                window.location.href="../../vistas/catalogo/vista_catalagos";
               </script>'; mysqli_error($conn);
         }
         mysqli_close($conn);
}else{
   
    echo '<script type="text/javascript">
            alert("Archivo no permitido");
            window.location.href="../../vistas/catalogo/vista_catalagos";
         </script>';
}
  

break;


//para eliminar en la tabla mysl  
case "eliminar";
$validar_rol = "SELECT * FROM tbl_portafolio WHERE ID_CATALOGO='$id_imagen'";
$result4 = mysqli_query($conn, $validar_rol); 
 if (mysqli_num_rows($result4) > 0) { 
    echo '<script>
                 alert("No se puede eliminar el catalogo, ya que esta en uso");
                 window.location.href="../../vistas/catalogo/vista_catalagos";                   
               </script>';
               mysqli_close($conn);

 }else{

        $sql3 = "DELETE FROM tbl_catalogo WHERE ID_CATALOGO='$id_imagen'";
        if (mysqli_query($conn, $sql3)) {
            unlink($ruta);
            
            header('Location: ../../vistas/catalogo/vista_catalagos');
        }else{
                echo '<script>
                        alert("Error al tratar de eliminar categoria");
                    </script>'; mysqli_error($conn);
            }
        mysqli_close($conn);
        }

break;



}
?>

