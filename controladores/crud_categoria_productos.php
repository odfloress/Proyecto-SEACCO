<?php
  require '../../conexion/conexion.php';
  //para mostrar los datos de la tabla mysql y mostrar en el crud
  $sql = "SELECT * FROM tbl_categoria_producto";
  $result = mysqli_query($conn, $sql);


  // //Variables para recuperar la información de los campos de la vista categorias de productos
  $id_categoria=(isset($_POST['id_categoria']))?$_POST['id_categoria']:"";
  $categoria=(isset($_POST['categoria']))?$_POST['categoria']:"";

  //variable para recuperar los botones de la vista categprias de productos  
  $accion=(isset($_POST['accion']))?$_POST['accion']:"";
  
  
  switch($accion){
      //para insertar en la tabla mysl
      case "agregar": 
        // valida si existe una categoria con el mismo nombre
        $validar_categoria = "SELECT * FROM tbl_categoria_producto WHERE NOMBRE_CATEGORIA='$categoria'";
        $result1 = mysqli_query($conn, $validar_categoria); 
         if (mysqli_num_rows($result1) > 0) { 
              
         
           echo '<script>
                    alert("El nombre de categoría ingresado ya existe, intente con otro");
                 </script>';
                 mysqli_close($conn);
         }else{ 

                //si no existe una categoria permite insertar
                $sql1 = "INSERT INTO tbl_categoria_producto (NOMBRE_CATEGORIA)
                VALUES ('$categoria')";
                if (mysqli_query($conn, $sql1)) {
                  header('Location: ../../vistas/inventario/vista_categorias_productos.php');

                } else {
                        echo '<script>
                                alert("Error al tratar de crear categoria");
                              </script>'; mysqli_error($conn);
                       }
                
                mysqli_close($conn);

              }                    

             
      break;

       //para editar en la tabla mysl      
      case "editar";

        // valida si existe una categoria con el mismo nombre
        $validar_categoria = "SELECT * FROM tbl_categoria_producto WHERE NOMBRE_CATEGORIA='$categoria'";
        $result2 = mysqli_query($conn, $validar_categoria); 
         if (mysqli_num_rows($result2) > 0) { 
              
         
           echo '<script>
                    alert("No se puede editar, ya existe una categoría con ese nombre");
                 </script>';
                 mysqli_close($conn);
         }else{ 

                $sql2 = "UPDATE tbl_categoria_producto SET NOMBRE_CATEGORIA='$categoria' WHERE ID_CATEGORIA='$id_categoria'";
                if (mysqli_query($conn, $sql2)) {
                   header('Location: ../../vistas/inventario/vista_categorias_productos.php');

                }else{
                     echo '<script>
                            alert("Error al tratar de editar categoría");
                           </script>'; mysqli_error($conn);
                     }

                mysqli_close($conn);
              }
      
      break;
      
      //para eliminar en la tabla mysl  
      case "eliminar";
          //validar que no este asignado a un producto
    $validar_rol = "SELECT * FROM tbl_productos WHERE ID_CATEGORIA='$id_categoria'";
    $result4 = mysqli_query($conn, $validar_rol); 
     if (mysqli_num_rows($result4) > 0) { 
        //  // inicio inserta en la tabla bitacora
        //  $sql9 = "INSERT INTO tbl_bitacora (USUARIO, ACCION, OBSERVACION)
        //  VALUES ('$usuario1[usuario]', 'INTENTO', 'NO LOGRO ELIMINAR YA QUE ESTABA EN USO EL ROL ($rol)')";
        //  if (mysqli_query($conn, $sql9)) {} else { }
        //  // fin inserta en la tabla bitacora
         echo '<script>
                 alert("No se puede eliminar la categoria, esta se encuentra en uso");
                 window.location.href="../../vistas/inventario/vista_categorias_productos.php";                   
               </script>';
               mysqli_close($conn);

     }else{

      $sql3 = "DELETE FROM tbl_categoria_producto WHERE ID_CATEGORIA='$id_categoria'";
      if (mysqli_query($conn, $sql3)) {

          header('Location: ../../vistas/inventario/vista_categorias_productos.php');
      }else{
              echo '<script>
                        alert("Error al tratar de eliminar categoria");
                    </script>'; mysqli_error($conn);
           }
          }

      break;
      
      default:
          
          $conn->close();   
  }// Fin del switch, para validar el valor del boton accion


?>
