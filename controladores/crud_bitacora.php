<?php
require '../../conexion/conexion.php';




//para mostrar los datos de la tabla mysql y mostrar en el crud
$sql = "SELECT * FROM tbl_bitacora";
$result = mysqli_query($conn, $sql);

  ?>