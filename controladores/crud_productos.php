<?php
  require '../../conexion/conexion.php';
  //para mostrar los datos de la tabla mysql y mostrar en el crud
  $sql = "SELECT * FROM tbl_productos";
  $result = mysqli_query($conn, $sql);


  // //Variables para recuperar la información de los campos de la vista categorias de productos
  $id_producto=(isset($_POST['id_producto']))?$_POST['id_producto']:"";
  $id_categoria=(isset($_POST['id_categoria']))?$_POST['id_categoria']:"";
  $foto=(isset($_POST['foto']))?$_POST['foto']:"";
  $codigo=(isset($_POST['codigo']))?$_POST['codigo']:"";
  $nombre=(isset($_POST['nombre']))?$_POST['nombre']:"";
  $descipcion_modelo=(isset($_POST['descripcion_modelo']))?$_POST['descripcion_modelo']:"";
  

  //variable para recuperar los botones de la vista categorias de productos  
  $accion=(isset($_POST['accion']))?$_POST['accion']:"";
  
  
  switch($accion){
      //para insertar en la tabla mysl
      case "agregar": 
        // valida si existe una producto con el mismo ID
        $validar_producto = "SELECT * FROM tbl_productos WHERE NOMBRE='$id_producto'";
        $result1 = mysqli_query($conn, $validar_producto); 
         if (mysqli_num_rows($result1) > 0) { 
              
         
           echo '<script>
                    alert("producto ya existe");
                 </script>';
                 mysqli_close($conn);
         }else{ 

                //si no existe un producto permite insertar
                $sql1 = "INSERT INTO tbl_productos (ID_PRODUCTO, ID_CATEGORIA, FOTO, CODIGO, NOMBRE, DESCRIPCION_MODELO)
                VALUES ('$id_producto','$id_categoria','$foto','$codigo','$nombre','$descripcion_modelo')";
                if (mysqli_query($conn, $sql1)) {
                    header('Location: ../../vistas/personas/vista_productos.php');

                } else {
                        echo '<script>
                                alert("Error al tratar de crear el producto");
                              </script>'; mysqli_error($conn);
                       }
                
                mysqli_close($conn);

              }                    

             
      break;

       //para editar en la tabla mysl      
      case "editar";

        // valida si existe una categoria con el mismo nombre
        $validar_producto = "SELECT * FROM tbl_productos WHERE NOMBRE='$id_producto'";
        $result2 = mysqli_query($conn, $validar_producto); 
         if (mysqli_num_rows($result2) > 0) { 
              
         
           echo '<script>
                    alert("No se puede editar, ya existe un producto con ese ID");
                 </script>';
                 mysqli_close($conn);
         }else{ 

                $sql2 = "UPDATE tbl_productos SET ID_PRODUCTO='$id_producto', ID_CATEGORIA='$id_categoria', FOTO='$foto',CODIGO='$codigo', NOMBRE='$nomnbre', DESCRIPCION_MODELO='$descripcion_modelo' WHERE ID_PRODUCTO='$id_producto'";
                if (mysqli_query($conn, $sql2)) {
                   header('Location: ../../vistas/personas/vista_productos.php');

                }else{
                     echo '<script>
                            alert("Error al tratar de editar el producto");
                           </script>'; mysqli_error($conn);
                     }

                mysqli_close($conn);
              }
      
      break;
      
      //para eliminar en la tabla mysl  
      case "eliminar";

      $sql3 = "DELETE FROM tbl_productos WHERE ID_PRODUCTO='$id_producto'";
      if (mysqli_query($conn, $sql3)) {

          header('Location: ../../vistas/personas/vista_productos.php');
      }else{
              echo '<script>
                        alert("Error al tratar de eliminar el producto");
                    </script>'; mysqli_error($conn);
           }
        mysqli_close($conn);

      break;
      
      default:
          
          $conn->close();   
  }// Fin del switch, para validar el valor del boton accion