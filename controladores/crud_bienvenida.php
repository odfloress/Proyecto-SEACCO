<?php
include '../../conexion/conexion.php';
//para mostrar los datos de la tabla mysql y mostrar en el crud
$sql = "SELECT * FROM tbl_bienvenida_portafolio WHERE TIPO='BIENVENIDA' OR TIPO='NUESTRO_EQUIPO'";
$result = mysqli_query($conn, $sql);


// //Variables para recuperar la información de los campos de la vista del crud del portafolio 
$id_imagen=(isset($_POST['id_imagen']))?$_POST['id_imagen']:"";
$tipo=(isset($_POST['tipo']))?$_POST['tipo']:"";
$titulo=(isset($_POST['titulo']))?$_POST['titulo']:"";
$descripcion=(isset($_POST['descripcion']))?$_POST['descripcion']:"";
$ruta=(isset($_POST['ruta']))?$_POST['ruta']:"";
$foto=(isset($_POST['foto']))?$_POST['foto']:"";

//variable para recuperar los botones de la vista del crud del portafolio 
$accion=(isset($_POST['accion']))?$_POST['accion']:"";

//variable de sesion
$usuario1 = $_SESSION;


switch($accion){
//para insertar en la tabla mysl
case "agregar": 

// agrega la imagen a la carpeta y la ruta en la base de datos
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
        $sql = "INSERT INTO tbl_bienvenida_portafolio (TIPO, IMAGEN, RUTA, TITULO, DESCRIPCION)
                VALUES ('$tipo', '$nombreimagen', '$destino$nombreimagen', '$titulo', '$descripcion')";
        $res = mysqli_query($conn, $sql);
         if($res){
             // inicio inserta en la tabla bitacora
             $sql = "INSERT INTO tbl_bitacora (USUARIO, ACCION, OBSERVACION)
             VALUES ('$usuario1[usuario]', 'INSERTO', 'INSERTO UN REGISTRO DE TIPO ($tipo) Y TITULO ($titulo) ')";
             if (mysqli_query($conn, $sql)) {} else {}
             // fin inserta en la tabla bitacora
            echo '<script type="text/javascript">
                     alert("Agregado correctamente");
                     window.location.href="../../vistas/catalogo/vista_bienvenida";
                 </script>';
         }else{
                die("Error". mysqli_error($conn));
              }
}else{
    // inicio inserta en la tabla bitacora
    $sql = "INSERT INTO tbl_bitacora (USUARIO, ACCION, OBSERVACION)
    VALUES ('$usuario1[usuario]', 'INTENTO', 'NO LOGRO INSERTAR YA QUE EL ARCHIVO NO ERA IMAGEN')";
    if (mysqli_query($conn, $sql)) {} else {}
    // fin inserta en la tabla bitacora
    echo '<script type="text/javascript">
             alert("Archivo no permitido");
             window.location.href="../../vistas/catalogo/vista_bienvenida";
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
                 window.location.href="../../vistas/catalogo/vista_bienvenida";
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
            window.location.href="../../vistas/catalogo/vista_bienvenida";
         </script>';
}
  

break;

//para eliminar en la tabla mysl  
case "eliminar";
if($id_imagen>13){


$sql3 = "DELETE FROM tbl_bienvenida_portafolio WHERE ID_IMAGEN='$id_imagen'";
if (mysqli_query($conn, $sql3)) {
  // inicio inserta en la tabla bitacora
  $sqlB1 = "INSERT INTO tbl_bitacora (USUARIO, ACCION, OBSERVACION)
  VALUES ('$usuario1[usuario]', 'ELIMINO', 'ELIMIO UNA IMAGEN DE BIENVENIDA')";
  if (mysqli_query($conn, $sqlB1)) {} else { }
// fin inserta en la tabla bitacora
    unlink($ruta);
    header('Location: ../../vistas/catalogo/vista_bienvenida');
}else{
  // inicio inserta en la tabla bitacora
  $sqlB1 = "INSERT INTO tbl_bitacora (USUARIO, ACCION, OBSERVACION)
  VALUES ('$usuario1[usuario]', 'INTENTO', 'ERROR AL ELIMINAR UNA IMAGEN DE BIENVENIDA')";
  if (mysqli_query($conn, $sqlB1)) {} else { }
// fin inserta en la tabla bitacora
        echo '<script>
                  alert("Error al tratar de eliminar categoria");
              </script>'; mysqli_error($conn);
     }
  mysqli_close($conn);

    }else{
        echo '<script type="text/javascript">
        alert("Este registo no puede ser eliminado");
        window.location.href="../../vistas/catalogo/vista_bienvenida";
     </script>';
    }

break;


}
?>