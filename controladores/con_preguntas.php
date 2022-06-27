<?php
  // require '../conexion/conexion.php';

  // //Variables para recuperar la información de los campos de la vista preguntas_seguridad
  // $pregunta=(isset($_POST['preguntas']))?$_POST['preguntas']:"";
  // $respuesta=(isset($_POST['respuesta']))?$_POST['respuesta']:"";
   
  // $accion=(isset($_POST['accion']))?$_POST['accion']:"";

  // switch($accion){
  //     case "guardar": 

  //       // validar que exista la pregunta en la tabla tbl_preguntas
  //          $validar_pregunta = "SELECT * FROM tbl_preguntas WHERE PREGUNTA='$pregunta'";
  //          $result = mysqli_query($conn, $validar_pregunta);
  //          if (mysqli_num_rows($result) > 0) {
                
            
  //             while($row = mysqli_fetch_assoc($result)) {
  //               echo  $row["PREGUNTA"];
              
  //             }
           





  //                      }else{
  //                                 echo '<script>
  //                                           alert("Error al intentar guardar la respuesta");
  //                                           window.Location = "/login.php";
  //                                       </script>';                                  
  //                                        mysqli_error($conn);
                           
               
    
  //           } // fin del else principal
             
  //     break;
      
  //       default:
          
  //         $conn->close();   
  // }// Fin del switch, para validar el valor del boton accion


?>
