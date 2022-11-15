<?php
  require '../../conexion/conexion.php';
  //para mostrar los datos de la tabla mysql y mostrar en el crud
  $sql = "SELECT * FROM tbl_proveedores";
  $result = mysqli_query($conn, $sql);


  // //Variables para recuperar la información de los campos de la vista categorias de productos
  $id_proveedor=(isset($_POST['id_proveedor']))?$_POST['id_proveedor']:"";
  $nombre=(isset($_POST['nombre']))?$_POST['nombre']:"";
  $nombre_referencia=(isset($_POST['nombre_referencia']))?$_POST['nombre_referencia']:"";
  $sector_comercial=(isset($_POST['sector_comercial']))?$_POST['sector_comercial']:"";
  $direccion=(isset($_POST['direccion']))?$_POST['direccion']:"";
  $telefono=(isset($_POST['telefono']))?$_POST['telefono']:"";
  $correo=(isset($_POST['correo']))?$_POST['correo']:"";
  $anterior=(isset($_POST['nombre_anterior']))?$_POST['nombre_anterior']:"";

  $usuario1 = $_SESSION;

  //variable para recuperar los botones de la vista categprias de productos  
  $accion=(isset($_POST['accion']))?$_POST['accion']:"";
  
  
  switch($accion){
      //para insertar en la tabla mysl
      case "agregar": 
        // valida si existe una categoria con el mismo nombre
        $validar_proveedor = "SELECT * FROM tbl_proveedores WHERE NOMBRE='$nombre'";
        $result1 = mysqli_query($conn, $validar_proveedor); 
         if (mysqli_num_rows($result1) > 0) { 
              
         
           echo '<script>
                    alert("proveedor ya existe");
                 </script>';
                 mysqli_close($conn);
         }else{ 

                //si no existe un proveedor permite insertar
                $sql1 = "INSERT INTO tbl_proveedores (ID_PROVEEDOR, NOMBRE, NOMBRE_REFERENCIA, SECTOR_COMERCIAL, DIRECCION, TELEFONO, CORREO)
                VALUES ('$id_proveedor','$nombre','$nombre_referencia','$sector_comercial','$direccion','$telefono','$correo')";
                if (mysqli_query($conn, $sql1)) {
                                     
                    echo '<script>
                                alert("Proveedor creado con exito");
                                window.location.href="../../vistas/personas/vista_proveedores.php";                   
                            </script>';
                             mysqli_close($conn);
                } else {
                        echo '<script>
                                alert("Error al tratar de crear el proveedor");
                              </script>'; mysqli_error($conn);
                       }
                
                mysqli_close($conn);

              }                    

             
      break;

       //para editar en la tabla mysl      
      case "editar";
      // valida si existe el provvedor con el mismo nombre
      $validar_proveedor= "SELECT * FROM tbl_proveedores WHERE NOMBRE='$nombre'";
      $result2 = mysqli_query($conn, $validar_proveedor); 
      if (mysqli_num_rows($result2) > 0) { 
            
          $sql2 = "UPDATE tbl_proveedores SET NOMBRE='$anterior', NOMBRE_REFERENCIA='$nombre_referencia', SECTOR_COMERCIAL='$sector_comercial',DIRECCION='$direccion', TELEFONO='$telefono', CORREO='$correo' WHERE ID_PROVEEDOR='$id_proveedor'";
              if (mysqli_query($conn, $sql2)) {

                 

                  echo '<script>
                          alert("Campos del Proveedor editado con exito");
                          window.location.href="../../vistas/personas/vista_proveedores.php";                   
                        </script>';
                        mysqli_close($conn);
                      

              }else{
                       echo '<script>
                                alert("Error al tratar de editar proveedor");
                             </script>'; mysqli_error($conn);
                   }

                   mysqli_close($conn);

             // si no existe el proveedor con el mismo nombre
          }else{
          $sql2 = "UPDATE tbl_proveedores SET NOMBRE='$nombre', NOMBRE_REFERENCIA='$nombre_referencia', SECTOR_COMERCIAL='$sector_comercial',DIRECCION='$direccion', TELEFONO='$telefono', CORREO='$correo' WHERE ID_PROVEEDOR='$id_proveedor'";
                if (mysqli_query($conn, $sql2)) {
                  
                 echo '<script>
                 alert("Proveedor editado con exito");
                 window.location.href="../../vistas/personas/vista_proveedores.php";                   
               </script>';
               mysqli_close($conn);
                   

                }else{
                     echo '<script>
                            alert("Error al tratar de editar el proveedor");
                           </script>'; mysqli_error($conn);
                     }

                mysqli_close($conn);
              }
                  
      break;
      
      //para eliminar en la tabla mysl  
      case "eliminar";
      
      $validar_proveedor = "SELECT * FROM tbl_compras WHERE ID_PROVEEDOR='$id_proveedor'";
    $result4 = mysqli_query($conn, $validar_proveedor); 
     if (mysqli_num_rows($result4) > 0) { 
        
         echo '<script>
                 alert("No se puede eliminar el proveedor, ya que esta en uso");
                 window.location.href="../../vistas/personas/vista_proveedores.php";                   
               </script>';
               mysqli_close($conn);

     }else{
      $sql3 = "DELETE FROM tbl_proveedores WHERE ID_PROVEEDOR='$id_proveedor'";
      if (mysqli_query($conn, $sql3)) {
     
    echo '<script>
        alert("Elimino el proveedor");
        window.location.href="../../vistas/personas/vista_proveedores.php";                   
        </script>';
        mysqli_close($conn);
     
          
      }else{
              echo '<script>
                        alert("Error al tratar de eliminar el proveedor");
                    </script>'; mysqli_error($conn);
           }
        mysqli_close($conn);
      }
    
      break;
      
      default:
          
          $conn->close();   
  }// Fin del switch, para validar el valor del boton accion


?>

