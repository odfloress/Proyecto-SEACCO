<?php
include '../../conexion/conexion.php';





if(isset($_FILES['imagenes'])){
    $nombreimagen= $_FILES['imagenes']['name'];
    $ruta = $_FILES['imagenes']['tmp_name'];
    $destino = "../../imagenes/".$nombreimagen;

    if(copy($ruta, $destino)){
        $sql = "INSERT INTO tbl_bienvenida_portafolio (TIPO, IMAGEN, RUTA, TITULO, DESCRIPCION)
                              VALUES ('PORTAFOLIO', '$nombreimagen', '$destino', 'PRUEBA', 'DESCRIPCION')";
        $res = mysqli_query($conn, $sql);

         if($res){
            echo '<script type="text/javascript">
                     alert("Agregado correctamente");
                 </script>';
         }else{
            die("Error". msqli_error($conn));
         }

    }

}

?>

