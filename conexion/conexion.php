<?php 

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "seacco_bd";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}












// $servername = "localhost";
// $username = "root";
// $password = "";
// $dbname = "seacco_bd";

// // crear conexion
// $conn = new mysqli($servername, $username, $password, $dbname);
// // validar conexion 
// if ($conn->connect_error) {
//     die("conexion fallida: " . $conn->connect_error);
//   }
  

?>
