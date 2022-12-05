<?php
    //conexion bd 
    require '../../conexion/conexion.php';

        $nombre=(isset($_POST['nombre']))?$_POST['nombre']:"";
        $apellido=(isset($_POST['apellido']))?$_POST['apellido']:"";
        $correo=(isset($_POST['correo']))?$_POST['correo']:"";
        $telefono=(isset($_POST['telefono']))?$_POST['telefono']:"";
        $dni=(isset($_POST['dni']))?$_POST['dni']:"";
        //$direccionPersonal=(isset($_POST['direccionPersonal']))?$_POST['direccionPersonal']:"";
        //$referencia=(isset($_POST['referencia']))?$_POST['referencia']:"";
        //$genero=(isset($_POST['genero']))?$_POST['genero']:"";
        //$foto=(isset($_POST['foto']))?$_POST['foto']:"";
        //$id_genero=(isset($_POST['id_genero']))?$_POST['id_genero']:"";

        $descripcion=(isset($_POST['descripcion']))?$_POST['descripcion']:"";
        $depto=(isset($_POST['departamento']))?$_POST['departamento']:"";
        $ubicacion=(isset($_POST['ubicacion']))?$_POST['ubicacion']:"";
        $proyecto=(isset($_POST['proyecto']))?$_POST['proyecto']:"";
        $genero=(isset($_POST['genero']))?$_POST['genero']:"";
        

        //variable para recuperar los botones de la vista categprias de productos  
        $accion=(isset($_POST['accion']))?$_POST['accion']:"";

switch($accion){
 //para insertar en la tabla mysl
  case "registrar": 
        
           
              $sqlcliente = "INSERT INTO tbl_clientes (CODIGO,NOMBRE_CLIENTE,APELLIDO,CORREO,TELEFONO,ID_GENERO) 
                VALUES ('$dni','$nombre','$apellido','$correo','$telefono', $genero)";
                if (mysqli_query($conn,$sqlcliente)){
                  

                  //Inicio consulta para seleccionar el ultimo cliente registrado
                  $idcliente = "SELECT * FROM tbl_clientes ORDER BY ID_CLIENTE DESC limit 1;";
                  $idcliente2 = mysqli_query($conn, $idcliente);
                  if (mysqli_num_rows($idcliente2) > 0)
                  {
                  while($row = mysqli_fetch_assoc($idcliente2))
                    { 
                        $idcliente3 = $row['ID_CLIENTE'];
                    } 
                  }
                  //Fin consulta para seleccionar el ultimo cliente registrado

                  //Inicio consulta para seleccionar el ultimo cliente registrado
                  $idusuario= "SELECT * FROM tbl_usuarios ORDER BY ID_USUARIO DESC limit 1;";
                  $idusuario2 = mysqli_query($conn, $idusuario);
                  if (mysqli_num_rows($idusuario2) > 0)
                  {
                  while($row = mysqli_fetch_assoc($idusuario2))
                    { 
                        $idusuario3 = $row['ID_USUARIO'];
                    } 
                  }
                  //Fin consulta para seleccionar el ultimo cliente registrado

                  date_default_timezone_set('America/Guatemala');
                  $fecha   = new DateTime();
                  $result = $fecha->format('Y-m-d-H-i-s');

                  $sqlproyecto ="INSERT INTO tbl_proyectos (ID_CLIENTE,ID_USUARIO,ID_ESTADOS,NOMBRE_PROYECTO,DESCRIPCION,
                    ID_DEPARTAMENTO,UBICACION,FECHA_INICIO,FECHA_FINAL)
                    VALUES ('$idcliente3','$idusuario3',1,'$proyecto','$descripcion','$depto','$ubicacion','$result','$result')";
                    if (mysqli_query($conn,$sqlproyecto)){}

                  echo '<script>
                    alert("Cotización enviada correctamente");
                    window.location.href="/SEACCO/";      
                  </script>';
                mysqli_close($conn);
                } else {
                  echo '<script>
                    alert("Erro al enviar Cotización");
                                   
                  </script>';
                mysqli_close($conn);
                }
             
                  
                  /*$sqlproyecto ="INSERT INTO tbl_proyectos (ID_CLIENTE,ID_USUARIO,ID_ESTADOS,NOMBRE_PROYECTO,DESCRIPCION,
                    ID_DEPARTAMENTO,UBICACION,FECHA_INICIO,FECHA_FINAL)
                    VALUES (2,33,1,'$proyecto','$descripcion','$depto','$ubicacion','$result','$result')";*/

                  
            break; 

            default:
          
          $conn->close(); 
  } // Fin del switch, para validar el valor del boton accion

?>