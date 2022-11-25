<?php 
    require '../../conexion/conexion.php';
    //para mostrar los datos de la tabla mysql y mostrar en el crud
    $sql = "SELECT ID_RESPUESTA,PREGUNTA,USUARIO,RESPUESTA FROM tbl_respuestas_usuario r INNER JOIN tbl_preguntas p ON r.ID_PREGUNTA = p.ID_PREGUNTA WHERE USUARIO = '$_SESSION[usuario]'";
//(tbl_respuestas_usuario p
//INNER JOIN tbl_preguntas c ON p.ID_PREGUNTA = c.ID_PREGUNTA)
    $result = mysqli_query($conn, $sql);


// //Variables para recuperar la información de los campos de la vista respuestas de usuario
$id_repuesta=(isset($_POST['id_repuesta']))?$_POST['id_repuesta']:"";
$repuesta=(isset($_POST['repuesta']))?$_POST['repuesta']:"";
$repuesta_anterior=(isset($_POST['repuesta_anterior']))?$_POST['repuesta_anterior']:"";
$id_pregunta=(isset($_POST['id_pregunta']))?$_POST['id_pregunta']:"";
$usuario=(isset($_POST['usuario']))?$_POST['usuario']:"";

    $usuario1 = $_SESSION;

//variable para recuperar los botones de la vista roles  
$accion=(isset($_POST['accion']))?$_POST['accion']:"";

switch($accion){
    
    //para editar en la tabla mysl      
    case "editar";

    // valida si existe la profesion con el mismo nombre
    $validar_repuesta= "SELECT * FROM tbl_respuestas_usuario WHERE ID_RESPUESTA='$id_repuesta'";
    $result2 = mysqli_query($conn, $validar_repuesta); 
     if (mysqli_num_rows($result2) > 0) { 
          
            $sql2 = "UPDATE tbl_respuestas_usuario SET RESPUESTA='$repuesta'  WHERE ID_RESPUESTA='$id_repuesta'";
            if (mysqli_query($conn, $sql2)) {
                // ////////////// INICIO FUNCION BITACORA /////////////////////
                if($repuesta_anterior !== $repuesta) ///////////// 
                {
                include_once 'funcion_bitacora.php';
                bitacora('EDITO', 'PREGUNTAS DE SEGURIDAD', 'PREGUNTA', $id_repuesta, $repuesta_anterior, $repuesta);
                }
                // ////////////// FIN FUNCION BITACORA ///////////////////////
                echo '<script>
                            alert("Edición de respuesta exitasa"); 
                            window.location.href="../../vistas/ajustes/vista_respuestas_usuarios.php";                
                      </script>';
                      mysqli_close($conn);
            }
           // si no existe la repuesta con el mismo nombre
          }else{
                    $sql2 = "UPDATE tbl_respuestas_usuario SET RESPUESTA='$repuesta' WHERE ID_RESPUESTA='$id_repuesta'";
                    if (mysqli_query($conn, $sql2)) {
                    // ////////////// INICIO FUNCION BITACORA /////////////////////
                    if($repuesta_anterior !== $repuesta) ///////////// PREGUNTA
                    {
                    include_once 'funcion_bitacora.php';
                    bitacora('EDITO', 'PREGUNTAS DE SEGURIDAD', 'PREGUNTA', $id_repuesta, $repuesta_anterior, $repuesta);
                    }
                    // ////////////// FIN FUNCION BITACORA ///////////////////////
                        echo '<script>
                                alert("Edición exitosa");
                                window.location.href="../../vistas/ajustes/vista_respuestas_usuarios.php";                     
                            </script>';
                            mysqli_close($conn);
                            
                    }

          }
  
  break;
  
  //para eliminar en la tabla mysl  
  case "eliminar";

        //validar que no este asignado a un usuario
        $validar_profesion = "SELECT * FROM tbl_respuestas_usuario WHERE ID_RESPUESTA='$id_repuesta'";
        $result4 = mysqli_query($conn, $validar_profesion); 
        if (mysqli_num_rows($result4) > 0) { 
            
            echo '<script>
                    alert("Esta opción no esta disponible");
                    window.location.href="../../vistas/ajustes/vista_respuestas_usuarios.php";                  
                </script>';
                mysqli_close($conn);

        }else{
            echo '<script>
            alert("Esta opción no esta disponible");
            window.location.href="../../vistas/ajustes/vista_respuestas_usuarios.php";                  
        </script>';
        mysqli_close($conn);
                        
            }

        break;
    default:
          
          $conn->close(); 
}
?>