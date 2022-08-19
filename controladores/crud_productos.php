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

            // valida si existe un producto con el mismo nombre
            $validar_nombre_producto = "SELECT * FROM tbl_productos WHERE NOMBRE='$nombre'";
            $result1 = mysqli_query($conn, $validar_nombre_producto); 
             if (mysqli_num_rows($result1) > 0) { 
                    
                    echo '<script>
                            alert("El nombre de producto ya existe, intente con otro");
                          </script>';
                          mysqli_close($conn);
             }else{ 

//    echo "$id_categoria" . "$cantidad_min" . "$cantidad_max ". "$destino$nombreimagen ". "$codigo" . "$nombre" . "$descripcion_modelo";
//    die();
            // INICIO INSERTA EN LA TABLA PRODUCTOS
                $sql = "INSERT INTO tbl_productos (ID_CATEGORIA, CANTIDAD_MIN, CANTIDAD_MAX, FOTO, CODIGO, NOMBRE, DESCRIPCION_MODELO)
                VALUES ('$id_categoria', '$cantidad_min', '$cantidad_max', '$destino$nombreimagen', '$codigo', '$nombre', '$descripcion_modelo')";
                 $res = mysqli_query($conn, $sql);
                if($res){
                    // inicio inserta en la tabla bitacora
                    $sql = "INSERT INTO tbl_bitacora (USUARIO, ACCION, OBSERVACION)
                    VALUES ('$usuario1[usuario]', 'INSERTO', 'REGISTRO EL PRODUCTO ($id_categoria) EN LA PANTALLA PRODUCTOS')";
                    if (mysqli_query($conn, $sql)) {} else {}
                    // fin inserta en la tabla bitacora

                    echo '<script type="text/javascript">
                            alert("Producto creado con éxito");
                            window.location.href="../../vistas/inventario/vista_productos.php";
                        </script>';
                }else{           
                        echo '<script type="text/javascript">
                                alert("Error al crear el producto");
                            </script>';
                      }
                // FIN INSERTA EN LA TABLA PRODUCTOS

        

          

    // inicio inserta en la tabla bitacora
    $sql = "INSERT INTO tbl_bitacora (USUARIO, ACCION, OBSERVACION)
    VALUES ('$usuario1[usuario]', 'INTENTO', 'NO LOGRO INSERTAR YA QUE EL ARCHIVO NO ERA IMAGEN EN LA PATALLA CLIENTES')";
    if (mysqli_query($conn, $sql)) {} else {}
    // fin inserta en la tabla bitacora
   
}else{
    echo '<script type="text/javascript">
    alert("Archivo no permitido");
    window.location.href="../../vistas/inventario/vista_productos";
 </script>';

}
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
        // inicio inserta en la tabla bitacora
        $sql = "INSERT INTO tbl_bitacora (USUARIO, ACCION, OBSERVACION)
        VALUES ('$usuario1[usuario]', 'EDITO', 'EDITO UN REGISTRO DE PRODUCTOS ($nombre)')";
        if (mysqli_query($conn, $sql)) {} else {}
         // fin inserta en la tabla bitacora
        echo '<script>
                 alert("Producto actualizado exitosamente");
                 window.location.href="../../vistas/inventario/vista_productos.php";
              </script>';
              mysqli_close($conn);

    }else{
         echo '<script>
                alert("Error en la actualización");
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
            window.location.href="../../vistas/inventario/vista_productos";
         </script>';
}
  

break;


//para eliminar en la tabla mysl  
case "eliminar";

$validar_proveedor = "SELECT * FROM tbl_kardex WHERE ID_PRODUCTO='$id_productos'";
    $result4 = mysqli_query($conn, $validar_proveedor); 
     if (mysqli_num_rows($result4) > 0) { 
         // inicio inserta en la tabla bitacora
         $sql9 = "INSERT INTO tbl_bitacora (USUARIO, ACCION, OBSERVACION)
         VALUES ('$usuario1[usuario]', 'INTENTO', 'NO LOGRO ELIMINAR YA QUE ESTABA EN USO EL PRODUCTOS ($nombre)')";
         if (mysqli_query($conn, $sql9)) {} else { }
         // fin inserta en la tabla bitacora
         echo '<script>
                 alert("No se puede eliminar el producto, este se encuentra en uso");
                 window.location.href="../../vistas/inventario/vista_productos.php";                   
               </script>';
     }else{
        $sql33 = "DELETE FROM tbl_inventario WHERE ID_PRODUCTOS='$id_productos'";
        if (mysqli_query($conn, $sql33)) {
      $sql34 = "DELETE FROM tbl_productos WHERE ID_PRODUCTO='$id_productos'";
      if (mysqli_query($conn, $sql34)){
        
            //  unlink($ruta);
    

        alert("Producto eliminado exitosamente");
        window.location.href="../../vistas/inventario/vista_productos.php";                   

        alert("Elimino el productor");
        // window.location.href="../../vistas/inventario/vista_productos.php";                   

        </script>';
        mysqli_close($conn);
     
          
      }else{
         // inicio inserta en la tabla bitacora
         $sql10 = "INSERT INTO tbl_bitacora (USUARIO, ACCION, OBSERVACION)
         VALUES ('$usuario1[usuario]', 'ERROR', 'ERROR AL ELIMINAR EL Producto ($anterior)')";
          if (mysqli_query($conn, $sql10)) {} else { }
     // fin inserta en la tabla bitacora
              echo '<script>
                        alert("Error al tratar de eliminar el producto");
                    </script>'; mysqli_error($conn);
           }
      
      }}
    
      break;
      
      default:
          
          $conn->close();   
  }// Fin del switch, para validar el valor del boton accion
}

?>