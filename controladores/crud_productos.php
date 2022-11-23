<?php
include '../../conexion/conexion.php';


// //Variables para recuperar la información de los campos de la vista del crud de productos
// $id_imagen=(isset($_POST['id_imagen']))?$_POST['id_imagen']:"";
$id_productos=(isset($_POST['id_productos']))?$_POST['id_productos']:"";
$id_categoria=(isset($_POST['id_categoria']))?$_POST['id_categoria']:"";
$cantidad_min=(isset($_POST['cantidad_min']))?$_POST['cantidad_min']:"";
$cantidad_max=(isset($_POST['cantidad_max']))?$_POST['cantidad_max']:"";
$codigo=(isset($_POST['codigo']))?$_POST['codigo']:"";
$nombre=(isset($_POST['nombre']))?$_POST['nombre']:"";
$descripcion_modelo=(isset($_POST['descripcion_modelo']))?$_POST['descripcion_modelo']:"";
$anterior=(isset($_POST['nombre_anterior']))?$_POST['nombre_anterior']:"";
$foto=(isset($_POST['foto']))?$_POST['foto']:"";
$foto = substr($foto, 15);
$ruta=(isset($_POST['ruta']))?$_POST['ruta']:"";
//variable para recuperar los botones de la vista del crud del portafolio 
$accion=(isset($_POST['accion']))?$_POST['accion']:"";

//variable de sesion
$usuario1 = $_SESSION;
                                      
switch($accion){
                                      ///////////  INSERTA EN PRODUCTOS /////////////
case "agregar":
    // echo $cantidad_min; 
    // echo $cantidad_max;
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
//    echo "$id_categoria" . "$cantidad_min" . "$cantidad_max ". "$destino$nombreimagen ". "$codigo" . "$nombre" . "$descripcion_modelo";
//    die();
            // INICIO INSERTA EN LA TABLA PRODUCTOS
                $sql = "INSERT INTO tbl_productos (ID_CATEGORIA, CANTIDAD_MIN, CANTIDAD_MAX, FOTO, CODIGO, NOMBRE, DESCRIPCION_MODELO)
                VALUES ('$id_categoria', '$cantidad_min', '$cantidad_max', '$destino$nombreimagen', '$codigo', '$nombre', '$descripcion_modelo')";
                 $res = mysqli_query($conn, $sql);
                if($res){
                    

                    echo '<script type="text/javascript">
                            alert("Creado con exito");
                            window.location.href="../../vistas/inventario/vista_productos.php";
                        </script>';
                }else{           
                        echo '<script type="text/javascript">
                                alert("Error al insertar");
                            </script>';
                      }
                // FIN INSERTA EN LA TABLA PRODUCTOS

        

          

    
   
}else{
    echo '<script type="text/javascript">
    alert("Archivo no permitido");
    window.location.href="../../vistas/inventario/vista_productos";
 </script>';

}

break;
//para editar en la tabla mysl   
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

    $sql2 = "UPDATE tbl_productos SET ID_CATEGORIA='$id_categoria', CANTIDAD_MIN='$cantidad_min', CANTIDAD_MAX='$cantidad_max', FOTO='$direccion', CODIGO='$codigo', NOMBRE='$nombre', DESCRIPCION_MODELO='$descripcion_modelo' WHERE ID_PRODUCTO='$id_productos'";
    if (mysqli_query($conn, $sql2)) 
    {
        
        echo '<script>
                 alert("Edición exitosa");
                 window.location.href="../../vistas/inventario/vista_productos.php";
              </script>';
              mysqli_close($conn);

    }else{
         echo '<script>
                alert("Error en la edición ");
               </script>'; mysqli_error($conn);
         }
         mysqli_close($conn);
}else{
    
    echo '<script type="text/javascript">
            alert("Archivo no permitido");
            window.location.href="../../vistas/inventario/vista_productos";
         </script>';
}
  

break;


//para eliminar en la tabla mysl  
case "eliminar";

$validar_proveedor = "SELECT * FROM tbl_kardex WHERE ID_PRODUCTO='$id_productos'";
    $result4 = mysqli_query($conn, $validar_proveedor); 
     if (mysqli_num_rows($result4) > 0) { 
         
         echo '<script>
                 alert("No se puede eliminar el producto, ya que esta en uso");
                 window.location.href="../../vistas/inventario/vista_productos.php";                   
               </script>';
     }else{
        $sql33 = "DELETE FROM tbl_inventario WHERE ID_PRODUCTOS='$id_productos'";
        if (mysqli_query($conn, $sql33)) {
      $sql34 = "DELETE FROM tbl_productos WHERE ID_PRODUCTO='$id_productos'";
      if (mysqli_query($conn, $sql34)){
    
    
    echo '<script>
    
        alert("Elimino el producto");
        // window.location.href="../../vistas/inventario/vista_productos.php";                   
        </script>';
        mysqli_close($conn);
     
          
      }else{
         
              echo '<script>
                        alert("Error al tratar de eliminar el producto");
                    </script>'; mysqli_error($conn);
           }
      
      }}
    
      break;
      
      default:
          
          $conn->close();   
  }// Fin del switch, para validar el valor del boton accion


?>