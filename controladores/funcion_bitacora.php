<?php
function bitacora($OPERACION, $PANTALLA, $CAMPO, $ID_REGISTRO, $VALOR_ORIGINAL, $VALOR_NUEVO){
include '../../conexion/conexion.php';
//se obtiene el codigo del usuario
$usuario =$_SESSION['usuario'];

date_default_timezone_set("America/Guatemala");



$fecha = date("Y-m-d h:i:s");


$consultaBitacora=mysqli_query($conn,"INSERT INTO tbl_bitacora (FECHA, USUARIO, OPERACION, PANTALLA, CAMPO, ID_REGISTRO, VALOR_ORIGINAL, VALOR_NUEVO)
                        VALUES ('$fecha', '$_SESSION[usuario]', '$OPERACION', '$PANTALLA', '$CAMPO', '$ID_REGISTRO', '$VALOR_ORIGINAL', '$VALOR_NUEVO')");


}


?>