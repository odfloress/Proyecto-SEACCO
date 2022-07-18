<?php
  require '../../conexion/conexion.php';
 

  // //Variables para recuperar la información de los campos de la vista roles
  $rol=(isset($_POST['lista1']))?$_POST['lista1']:"";
  $pantalla=(isset($_POST['lista2']))?$_POST['lista2']:"";
  $insertar=(isset($_POST['insertar']))?$_POST['insertar']:"";
  $eliminar=(isset($_POST['eliminar2']))?$_POST['eliminar2']:"";
  $editar=(isset($_POST['editar2']))?$_POST['editar2']:"";
  $consultar=(isset($_POST['consultar']))?$_POST['consultar']:"";
  
  //variable de sesion
  $usuario1 = $_SESSION;

  //variable para recuperar los botones de la vista roles  
  $accion=(isset($_POST['accion']))?$_POST['accion']:"";

  //Selecciona el nombre del rol
  $roles4 = "SELECT * FROM tbl_roles WHERE ID_ROL='$rol'";
                            $roles5 = mysqli_query($conn, $roles4);
                            if (mysqli_num_rows($roles5) > 0) 
                            { 
                                while($row = mysqli_fetch_assoc($roles5)){
                                $nombre_rol = "$row[ROL]";
                            }
                            }

 //Selecciona el nombre de la pantalla
 $roles14 = "SELECT * FROM tbl_ms_objetos WHERE ID_OBJETO='$pantalla'";
 $roles15 = mysqli_query($conn, $roles14);
 if (mysqli_num_rows($roles15) > 0) 
 { 
     while($row = mysqli_fetch_assoc($roles15)){
     $nombre_pantalla = "$row[OBJETO]";
 }
 }
  

  
  switch($accion){
      //para insertar en la tabla mysl
      case "agregar": 

           $sql1 = "INSERT INTO tbl_ms_roles_ojetos (ID_OBJETO, ID_ROL, PERMISO_INSERCION, PERMISO_ELIMINACION, PERMISO_ACTUALIZACION, PERMISO_CONSULTAR)
                    VALUES ('$pantalla', '$rol', '$insertar', '$eliminar', '$editar', '$consultar')";

                 if (mysqli_query($conn, $sql1)) {

                      // inicio inserta en la tabla bitacora
                      $sql7 = "INSERT INTO tbl_bitacora (ID_USUARIO, ID_OBJETO, USUARIO, ACCION, OBSERVACION)
                      VALUES (2, 1, '$usuario1[usuario]', 'INSERTO', 'CREO PERMISOS AL ROL ($nombre_rol) PARA LA PANTALLA ($nombre_pantalla)')";
                      if (mysqli_query($conn, $sql7)) {} else { }
                      // fin inserta en la tabla bitacora

                              echo '<script>
                                      alert("Permisos creados con exito");
                                      window.location.href="../../vistas/ajustes/vista_permisos.php";                   
                                    </script>';
                                  mysqli_close($conn);
                }else{
                       echo '<script>
                                alert("Error al tratar de crear los permisos");
                             </script>'; 
                             mysqli_error($conn);
                           }
                    
                    mysqli_close($conn);
                        
      break;

       //para editar en la tabla mysl      
      case "editar";

                        $sql17 = "UPDATE tbl_ms_roles_ojetos SET PERMISO_INSERCION='$insertar', PERMISO_ELIMINACION='$eliminar', 
                        PERMISO_ACTUALIZACION='$editar', PERMISO_CONSULTAR='$consultar' WHERE ID_OBJETO='$pantalla' and ID_ROL='$rol'";
                        if (mysqli_query($conn, $sql17)) {
                           
                                
                            // inicio inserta en la tabla bitacora
                            $sql9 = "INSERT INTO tbl_bitacora (ID_USUARIO, ID_OBJETO, USUARIO, ACCION, OBSERVACION)
                            VALUES (2, 1, '$usuario1[usuario]', 'EDITO', 'EDITO LOS PERMISOS DE ROL ($nombre_rol) DE LA PANTALLA ($nombre_pantalla) ')";
                            
                            if (mysqli_query($conn, $sql9)) {} else { }
                            // fin inserta en la tabla bitacora
                            echo '<script>
                                    alert("Permiso editado con exito");
                                    window.location.href="../../vistas/ajustes/vista_permisos.php";                   
                                  </script>';
                                mysqli_close($conn);
                                
                        }

            
      
      break;
      
      //para eliminar en la tabla mysl  
      case "eliminar";

    
                        $sql3 = "DELETE FROM tbl_ms_roles_ojetos WHERE ID_ROL='$rol' and ID_OBJETO='$pantalla'";
                        if (mysqli_query($conn, $sql3)) {
                            // inicio inserta en la tabla bitacora
                            $sql7 = "INSERT INTO tbl_bitacora (ID_USUARIO, ID_OBJETO, USUARIO, ACCION, OBSERVACION)
                            VALUES (2, 1, '$usuario1[usuario]', 'ELIMINO', 'ELIMINO LOS PERMISOS DE ROL ($nombre_rol) DE LA PANTALLA ($nombre_pantalla)')";
                             if (mysqli_query($conn, $sql7)) {} else { }
                        // fin inserta en la tabla bitacora
                            header('Location: ../../vistas/ajustes/vista_permisos.php');
                        }else{
                                echo '<script>
                                        alert("Error al tratar de eliminar el permiso");
                                    </script>'; mysqli_error($conn);
                            }
                        mysqli_close($conn);
                   
        

      break;
      
      default:
          
          $conn->close();   
  }// Fin del switch, para validar el valor del boton accion


?>
