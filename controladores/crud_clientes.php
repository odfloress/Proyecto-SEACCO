<?php
  require '../../conexion/conexion.php';
  //para mostrar los datos de la tabla mysql y mostrar en el crud
  $sql = "SELECT * FROM tbl_clientes";
  $result = mysqli_query($conn, $sql);


  // //Variables para recuperar la información de los campos de la vista clientes
  $id_cliente=(isset($_POST['id_cliente']))?$_POST['id_cliente']:"";
  $codigo=(isset($_POST['codigo']))?$_POST['codigo']:"";
  $nombre=(isset($_POST['nombre']))?$_POST['nombre']:"";
  $apellido=(isset($_POST['apellido']))?$_POST['apellido']:"";
  $correo=(isset($_POST['correo']))?$_POST['correo']:"";
  $telefono=(isset($_POST['telefono']))?$_POST['telefono']:"";
  $direccion=(isset($_POST['direccion']))?$_POST['direccion']:"";
  $referencia=(isset($_POST['nombre_referencia']))?$_POST['nombre_referencia']:"";
  $genero=(isset($_POST['genero']))?$_POST['genero']:"";
  $foto=(isset($_POST['foto']))?$_POST['foto']:"";
  //variable para recuperar los botones de la vista clientes  
  $accion=(isset($_POST['accion']))?$_POST['accion']:"";
  
  
  switch($accion){
      //para insertar en la tabla mysl
      case "agregar": 
        // valida si existe una categoria con el mismo nombre
        $validar_cliente = "SELECT * FROM tbl_clientes WHERE NOMBRE='$nombre'";
        $result1 = mysqli_query($conn, $validar_cliente); 
         if (mysqli_num_rows($result1) > 0) { 
              
         
           echo '<script>
                    alert("cliente ya existe");
                 </script>';
                 mysqli_close($conn);
         }else{ 
            $sql7 = "INSERT INTO tbl_clientes (CODIGO, NOMBRE_CLIENTE, APELLIDO, CORREO, TELEFONO, DIRECCION, REFERENCIA, GENERO)
                    VALUES ('$codigo', '$nombre', '$apellido', '$correo', '$telefono', '$direccion', '$referencia', '$genero')";

                    if (mysqli_query($conn, $sql7)) {
                    echo "New record created successfully";
                    } else {
                    echo "Error: " . $sql7 . "<br>" . mysqli_error($conn);
}

                

              }                    

             
      break;

       //para editar en la tabla mysl      
      case "editar";

        // valida si existe una categoria con el mismo nombre
        $validar_proveedor = "SELECT * FROM tbl_clientes WHERE NOMBRE_CLIENTE='$nombre'";
        $result2 = mysqli_query($conn, $validar_clientes); 
         if (mysqli_num_rows($result2) > 0) { 
              
         
           echo '<script>
                    alert("No se puede editar, ya existe un cliente con ese nombre");
                 </script>';
                 mysqli_close($conn);
         }else{ 

                $sql2 = "UPDATE tbl_clientes SET NOMBRE_CLIENTE='$nombre', APELLIDO='$apellido', CORREO='$correo',TELEFONO='$telefono', DIRECCION='$direccion', REFERENCIA='$referencia', GENERO='$genero , FOTO='$foto WHERE ID_CLIENTE='$id_cliente'";
                if (mysqli_query($conn, $sql2)) {
                   header('Location: ../../vistas/personas/clientes.php');

                }else{
                     echo '<script>
                            alert("Error al tratar de editar el cliente");
                           </script>'; mysqli_error($conn);
                     }

                mysqli_close($conn);
              }
      
      break;
      
      //para eliminar en la tabla mysl  
      case "eliminar";

      $sql3 = "DELETE FROM tbl_clientes WHERE ID_CLIENTE='$id_cliente'";
      if (mysqli_query($conn, $sql3)) {

          header('Location: ../../vistas/personas/vista_clientes.php');
      }else{
              echo '<script>
                        alert("Error al tratar de eliminar el cliente");
                    </script>'; mysqli_error($conn);
           }
        mysqli_close($conn);

      break;
      
      default:
          
          $conn->close();   
  }// Fin del switch, para validar el valor del boton accion


?>