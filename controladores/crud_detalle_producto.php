<?php
  require '../../conexion/conexion.php';
  //para mostrar los datos de la tabla mysql y mostrar en el crud
  $sql = "SELECT * FROM ((tbl_detalle_compra d
  INNER JOIN tbl_unidad_medida u ON d.ID_UNIDAD_MEDIDA = u.ID_UNIDAD_MEDIDA)
  INNER JOIN tbl_productos p ON d.ID_PRODUCTO = p.ID_PRODUCTO)";
  $result = mysqli_query($conn, $sql);
 

  // //Variables para recuperar la información de los campos de la vista roles
  $id_rol=(isset($_POST['id_rol']))?$_POST['id_rol']:"";
  $producto=(isset($_POST['producto']))?$_POST['producto']:"";
  $garantia14=(isset($_POST['garantia']))?$_POST['garantia']:"";
  $unidad_medida14=(isset($_POST['unidad_medida']))?$_POST['unidad_medida']:"";
  $cantidad=(isset($_POST['cantidad']))?$_POST['cantidad']:"";
  $precio=(isset($_POST['precio']))?$_POST['precio']:"";
  $anterior=(isset($_POST['nombre_anterior']))?$_POST['nombre_anterior']:"";
  
  $usuario1 = $_SESSION;

  //selecciona el id de la comra en proceso
  $validar_compra7 = "SELECT * FROM tbl_compras WHERE USUARIO='$usuario1[usuario]' and ESTADO_COMPRA='EN PROCESO'";
  $validar_compra77 = mysqli_query($conn, $validar_compra7);
  if (mysqli_num_rows($validar_compra77) > 0)
  {
        while($row = mysqli_fetch_assoc($validar_compra77)) 
        {
              $id_compra = $row["ID_COMPRA"];
              $precio_anterior = $row["TOTAL_COMPRA"];
        }
  }


  //variable para recuperar los botones de la vista roles  
  $accion=(isset($_POST['accion']))?$_POST['accion']:"";
  
  
  switch($accion){
  
      case "agregar": 
        // valida si ya esta agregado el producto
        $validar_producto = "SELECT * FROM tbl_detalle_compra WHERE ID_PRODUCTO='$producto'";
        $result1 = mysqli_query($conn, $validar_producto); 
         if (mysqli_num_rows($result1) > 0) { 
                
                echo '<script>
                        alert("Error, el producto ya esta agregardo.");
                      </script>';
                      mysqli_close($conn);
         }else{ 

                    //si no esta agregado permite insertar
                    $sql1 = "INSERT INTO tbl_detalle_compra (ID_COMPRA, ID_PRODUCTO, GARANTIA, ID_UNIDAD_MEDIDA, CANTIDAD, PRECIO)
                    VALUES ('$id_compra', '$producto', '$garantia14', '$unidad_medida14', '$cantidad', '$precio')";
                    if (mysqli_query($conn, $sql1)) {

                        //  // inicio inserta en la tabla bitacora
                        //     $sql7 = "INSERT INTO tbl_bitacora (USUARIO, ACCION, OBSERVACION)
                        //     VALUES ('$usuario1[usuario]', 'INSERTO', 'Agrego un producto a la compra con id ( $id_compra )')";
                        //      if (mysqli_query($conn, $sql7)) {} else { }
                        // // fin inserta en la tabla bitacora
                        $total = $cantidad * $precio;
                        $total_compra = "UPDATE tbl_compras SET TOTAL_COMPRA=TOTAL_COMPRA+ $total WHERE ID_COMPRA='$id_compra'";
                        if (mysqli_query($conn, $total_compra)) 
                        {
                        }

                        echo '<script>
                                alert("Producto agregado con exito");
                                window.location.href="../../vistas/inventario/vista_detalle_producto.php";                   
                            </script>';
                             mysqli_close($conn);
                    } else {
                            echo '<script>
                                    alert("Error al tratar de agregar el producto");
                                  </script>'; 
                                  mysqli_error($conn);
                           }
                    
                    mysqli_close($conn);

              }                      
      break;

       //para editar en la tabla mysl      
      case "editar";

        // valida si existe el rol con el mismo nombre
        $validar_rol= "SELECT * FROM tbl_roles WHERE Rol='$rol'";
        $result2 = mysqli_query($conn, $validar_rol); 
         if (mysqli_num_rows($result2) > 0) { 
              
            $sql2 = "UPDATE tbl_roles SET ROL='$anterior', DESCRIPCION='$descripcion'  WHERE ID_ROL='$id_rol'";
                if (mysqli_query($conn, $sql2)) {

                   
                           
                     // inicio inserta en la tabla bitacora
                     $sql8 = "INSERT INTO tbl_bitacora (USUARIO, ACCION, OBSERVACION)
                     VALUES ('$usuario1[usuario]', 'EDITO', 'EDITO DESCRIPCION DEL ROL ($rol)')";
                     
                      if (mysqli_query($conn, $sql8)) {} else { }
                    // fin inserta en la tabla bitacora
                    echo '<script>
                            alert("Descripción del rol editado con exito");
                            window.location.href="../../vistas/ajustes/vista_roles.php";                   
                          </script>';
                          mysqli_close($conn);
                        

                }else{
                         echo '<script>
                                  alert("Error al tratar de editar rol");
                               </script>'; mysqli_error($conn);
                     }

                     mysqli_close($conn);

               // si no existe el rol con el mismo nombre
              }else{
                        $sql2 = "UPDATE tbl_roles SET ROL='$rol', DESCRIPCION='$descripcion'  WHERE ID_ROL='$id_rol'";
                        if (mysqli_query($conn, $sql2)) {

                            
                                
                            // inicio inserta en la tabla bitacora
                            $sql9 = "INSERT INTO tbl_bitacora (USUARIO, ACCION, OBSERVACION)
                            VALUES ('$usuario1[usuario]', 'EDITO', 'RENOMBRO EL ROL ($anterior) A $rol')";
                            if (mysqli_query($conn, $sql9)) {} else { }
                            // fin inserta en la tabla bitacora
                            echo '<script>
                                    alert("Rol editado con exito");
                                    window.location.href="../../vistas/ajustes/vista_roles.php";                   
                                </script>';
                                mysqli_close($conn);
                                
                        }

              }
      
      break;
      
      //para eliminar en la tabla mysl  
      case "eliminar";

    //validar que no este asignado a un usuario
    $validar_rol = "SELECT * FROM tbl_usuarios WHERE ID_ROL='$id_rol'";
    $result4 = mysqli_query($conn, $validar_rol); 
     if (mysqli_num_rows($result4) > 0) { 
         // inicio inserta en la tabla bitacora
         $sql9 = "INSERT INTO tbl_bitacora (USUARIO, ACCION, OBSERVACION)
         VALUES ('$usuario1[usuario]', 'INTENTO', 'NO LOGRO ELIMINAR YA QUE ESTABA EN USO EL ROL ($rol)')";
         if (mysqli_query($conn, $sql9)) {} else { }
         // fin inserta en la tabla bitacora
         echo '<script>
                 alert("No se puede eliminar el rol, ya que esta en uso");
                 window.location.href="../../vistas/ajustes/vista_roles.php";                   
               </script>';
               mysqli_close($conn);

     }else{

                //validar que no este asignado en la tabla tbl_ms_roles_objetos
                $validar_rol = "SELECT * FROM tbl_ms_roles_ojetos WHERE ID_ROL='$id_rol'";
                $result5 = mysqli_query($conn, $validar_rol); 
                if (mysqli_num_rows($result5) > 0) { 
                        // inicio inserta en la tabla bitacora
                        $sql9 = "INSERT INTO tbl_bitacora (USUARIO, ACCION, OBSERVACION)
                        VALUES ('$usuario1[usuario]', 'INTENTO', 'NO LOGRO YA QUE ESTA EN USO EL ROL ($rol)')";
                        if (mysqli_query($conn, $sql9)) {} else { }
                        // fin inserta en la tabla bitacora

                    echo '<script>
                            alert("No se puede eliminar el rol, ya que esta en uso.");
                            window.location.href="../../vistas/ajustes/vista_roles.php";                   
                          </script>';
                          mysqli_close($conn);
                }else{
                        $sql3 = "DELETE FROM tbl_roles WHERE ID_ROL='$id_rol'";
                        if (mysqli_query($conn, $sql3)) {
                            // inicio inserta en la tabla bitacora
                            $sql7 = "INSERT INTO tbl_bitacora (USUARIO, ACCION, OBSERVACION)
                            VALUES ('$usuario1[usuario]', 'ELIMINO', 'ELIMINO EL ROL ($anterior)')";
                             if (mysqli_query($conn, $sql7)) {} else { }
                        // fin inserta en la tabla bitacora
                            header('Location: ../../vistas/ajustes/vista_roles.php');
                        }else{
                                echo '<script>
                                        alert("Error al tratar de eliminar el rol");
                                    </script>'; mysqli_error($conn);
                            }
                        mysqli_close($conn);
                     }
          }

      break;
      
      default:
          
          $conn->close();   
  }// Fin del switch, para validar el valor del boton accion


?>
