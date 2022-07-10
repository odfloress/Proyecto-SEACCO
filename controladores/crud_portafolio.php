<?php
include '../../conexion/conexion.php';
//para mostrar los datos de la tabla mysql y mostrar en el crud
$sql = "SELECT * FROM tbl_bienvenida_portafolio WHERE TIPO='PORTAFOLIO'";
$result = mysqli_query($conn, $sql);


// //Variables para recuperar la información de los campos de la vista del crud del portafolio 
$id_imagen=(isset($_POST['id_imagen']))?$_POST['id_imagen']:"";
$tipo=(isset($_POST['tipo']))?$_POST['tipo']:"";
$titulo=(isset($_POST['titulo']))?$_POST['titulo']:"";
$descripcion=(isset($_POST['descripcion']))?$_POST['descripcion']:"";
$ruta=(isset($_POST['ruta']))?$_POST['ruta']:"";

//variable para recuperar los botones de la vista del crud del portafolio 
$accion=(isset($_POST['accion']))?$_POST['accion']:"";



switch($accion){
//para insertar en la tabla mysl
case "agregar": 

// agrega la imagen a la carpeta y la ruta en la base de datos

if(isset($_FILES['imagenes'])){
    $nombreimagen= $_FILES['imagenes']['name'];
    $ruta = $_FILES['imagenes']['tmp_name'];
    $destino = "../../imagenes/".$nombreimagen;

    if(copy($ruta, $destino)){
        // valida si existe una la imagen con el mismo nombre
        $validar_imagen = "SELECT * FROM tbl_bienvenida_portafolio WHERE RUTA='$destino'";
        $result1 = mysqli_query($conn, $validar_imagen); 
         if (mysqli_num_rows($result1) > 0) { 
              
         
           echo '<script>
                    alert("imagen ya existe");
                 </script>';
                 mysqli_close($conn);
         }else{
        $sql = "INSERT INTO tbl_bienvenida_portafolio (TIPO, IMAGEN, RUTA, TITULO, DESCRIPCION)
                              VALUES ('$tipo', '$nombreimagen', '$destino', '$titulo', '$descripcion')";
        $res = mysqli_query($conn, $sql);

         if($res){
            echo '<script type="text/javascript">
                     alert("Agregado correctamente");
                     window.location.href="../../vistas/catalogo/vista_portafolio";
                 </script>';
         }else{
                die("Error". msqli_error($conn));
              }
            }
    }
}

break;

case "editar": 
    $sql2 = "UPDATE tbl_bienvenida_portafolio SET TITULO='$titulo', DESCRIPCION='$descripcion' WHERE ID_IMAGEN='$id_imagen'";
    if (mysqli_query($conn, $sql2)) {
        echo '<script>
                 alert("Edición exitosa");
                //  window.location.href="../../vistas/catalogo/vista_portafolio";
              </script>';

    }else{
         echo '<script>
                alert("Error en la edición ");
               </script>'; mysqli_error($conn);
         }

    mysqli_close($conn);
  

break;

//para eliminar en la tabla mysl  
case "eliminar";
echo $ruta;
echo $id_imagen;


$sql3 = "DELETE FROM tbl_bienvenida_portafolio WHERE ID_IMAGEN='$id_imagen'";
if (mysqli_query($conn, $sql3)) {
    unlink($ruta);
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

