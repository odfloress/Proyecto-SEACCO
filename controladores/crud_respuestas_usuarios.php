<?php 
    require '../../conexion/conexion.php';
    //para mostrar los datos de la tabla mysql y mostrar en el crud
    $sql = "SELECT ID_RESPUESTA,PREGUNTA,USUARIO,RESPUESTA, r.ID_PREGUNTA AS ID_PREGUNTAS FROM tbl_respuestas_usuario r INNER JOIN tbl_preguntas p ON r.ID_PREGUNTA = p.ID_PREGUNTA WHERE USUARIO = '$_SESSION[usuario]'";
//(tbl_respuestas_usuario p
//INNER JOIN tbl_preguntas c ON p.ID_PREGUNTA = c.ID_PREGUNTA)
    $result = mysqli_query($conn, $sql);


// //Variables para recuperar la información de los campos de la vista respuestas de usuario
$id_repuesta=(isset($_POST['id_repuesta']))?$_POST['id_repuesta']:"";
$repuesta=(isset($_POST['repuesta']))?$_POST['repuesta']:"";
$repuesta_anterior=(isset($_POST['repuesta_anterior']))?$_POST['repuesta_anterior']:"";
$id_pregunta=(isset($_POST['id_pregunta']))?$_POST['id_pregunta']:"";
$pregunta = intval(preg_replace('/[^0-9]+/', '', $id_pregunta), 10);
$nuevo_pregunta= preg_replace('/[0-9]+/', '', $id_pregunta);
$usuario=(isset($_POST['usuario']))?$_POST['usuario']:"";

    $usuario1 = $_SESSION;

//variable para recuperar los botones de la vista roles  
$accion=(isset($_POST['accion']))?$_POST['accion']:"";

switch($accion){
    
    //para editar en la tabla mysl      
    case "editar";
    
// echo $pregunta;
//     die();
    $validar_repuesta= "SELECT * FROM tbl_respuestas_usuario WHERE ID_RESPUESTA='$id_repuesta'";
    $result2 = mysqli_query($conn, $validar_repuesta); 
     if (mysqli_num_rows($result2) > 0) { 
          
            $sql2 = "UPDATE tbl_respuestas_usuario SET RESPUESTA='$repuesta' ,ID_PREGUNTA ='$pregunta'  WHERE ID_RESPUESTA='$id_repuesta'";
            if (mysqli_query($conn, $sql2)) {
                // ////////////// INICIO FUNCION BITACORA /////////////////////
                if($repuesta_anterior !== $repuesta) ///////////// 
                {
                include_once 'funcion_bitacora.php';
                bitacora('EDITO', 'PREGUNTAS DE SEGURIDAD', 'RESPUESTA', $id_repuesta, $repuesta_anterior, $repuesta);
                }
                // ////////////// FIN FUNCION BITACORA ///////////////////////
                echo '<script>
                            alert("Edición de respuesta exitasa"); 
                             window.location.href="../../vistas/ajustes/vista_respuestas_usuarios.php";                
                      </script>';
                      mysqli_close($conn);
            }
           
          }else{
                    $sql2 = "UPDATE tbl_respuestas_usuario SET RESPUESTA='$repuesta',ID_PREGUNTA ='$pregunta' WHERE ID_RESPUESTA='$id_repuesta'";
                    if (mysqli_query($conn, $sql2)) {
                    // ////////////// INICIO FUNCION BITACORA /////////////////////
                    if($repuesta_anterior !== $repuesta) ///////////// PREGUNTA
                    {
                    include_once 'funcion_bitacora.php';
                    bitacora('EDITO', 'PREGUNTAS DE SEGURIDAD', 'RESPUESTA', $id_repuesta, $repuesta_anterior, $repuesta);
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