<?php

	session_start();
	if(!isset($_SESSION['usuario'])){
	
			header('Location: ../../_login.php');
			session_unset();
			session_destroy();
			die();
			
	}
	error_reporting(0);
	require '../../conexion/conexion.php';
	//Llama función de backup
	include 'backup_function.php';

	if(isset($_POST['backupnow'])){

		$server = $_POST['server'];
		$username = $_POST['username'];
		$password = $_POST['password'];
		$dbname = $_POST['dbname'];

		// inicio inserta en la tabla bitacora
		$sql = "INSERT INTO tbl_bitacora ( USUARIO, ACCION, OBSERVACION)
		VALUES ('$_SESSION[usuario]', 'REALIZO', 'BACKUP DE LA BD')";
		
		if (mysqli_query($conn, $sql)) {
			
		} else {                 
		}
	   // fin inserta en la tabla bitacora

		
		backDb($server, $username, $password, $dbname);	
		

		exit();
		
	}
	else{
		echo 'Agregar todos los campos obligatorios';
	}

?>