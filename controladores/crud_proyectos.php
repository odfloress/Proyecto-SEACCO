<?php
  require '../../conexion/conexion.php';
  //para mostrar los datos de la tabla mysql y mostrar en el crud
  $sql = "SELECT ID_PROYECTO, NOMBRE_CLIENTE, NOMBRE, ESTADO_PROYECTO, NOMBRE_PROYECTO, DESCRIPCION, DEPARTAMENTO, 
  UBICACION, FECHA_INICIO, FECHA_FINAL FROM ((((tbl_proyectos p
  INNER JOIN tbl_clientes c ON p.ID_CLIENTE = c.ID_CLIENTE)
  INNER JOIN tbl_usuarios u ON p.ID_USUARIO = u.ID_USUARIO)
  INNER JOIN tbl_estados_proyectos e ON p.ID_ESTADOS = e.ID_ESTADOS ) 
  INNER JOIN tbl_departamentos d ON p.ID_DEPARTAMENTO = d.ID_DEPARTAMENTO) ";

  
  
  $result = mysqli_query($conn, $sql);



  // //Variables para recuperar la información de los campos de la vista categorias de productos
  $id_proyecto=(isset($_POST['id_proyecto']))?$_POST['id_proyecto']:"";
  $id_cliente=(isset($_POST['id_cliente']))?$_POST['id_cliente']:"";
  $nombre_cliente_id = intval(preg_replace('/[^0-9]+/', '', $id_cliente), 10);
  $nuevo_nombre_cliente= preg_replace('/[0-9]+/', '', $id_cliente);
  $id_usuario=(isset($_POST['id_usuario']))?$_POST['id_usuario']:"";
  $nombre_usuario_id = intval(preg_replace('/[^0-9]+/', '', $id_usuario), 10);
  $nuevo_nombre_usuario= preg_replace('/[0-9]+/', '', $id_usuario);
  $id_estado=(isset($_POST['id_estado']))?$_POST['id_estado']:"";
  $estado_id = intval(preg_replace('/[^0-9]+/', '', $id_estado), 10);
  $nuevo_nombre_estado= preg_replace('/[0-9]+/', '', $id_estado);
  $nombre=(isset($_POST['nombre']))?$_POST['nombre']:"";
  $descripcion=(isset($_POST['descripcion']))?$_POST['descripcion']:"";
  $id_departamento=(isset($_POST['id_departamento']))?$_POST['id_departamento']:"";
  $departamento_id = intval(preg_replace('/[^0-9]+/', '', $id_departamento), 10);
  $nuevo_nombre_departamento= preg_replace('/[0-9]+/', '', $id_departamento);
  $ubicacion=(isset($_POST['ubicacion']))?$_POST['ubicacion']:"";
  $fecha_inicio=(isset($_POST['fecha_inicio']))?$_POST['fecha_inicio']:"";
  $fecha_final=(isset($_POST['fecha_final']))?$_POST['fecha_final']:"";
  $anterior=(isset($_POST['nombre_anterior']))?$_POST['nombre_anterior']:"";

  $usuario1 = $_SESSION;
  
  //variable para recuperar los botones de la vista categprias de productos  
  $accion=(isset($_POST['accion']))?$_POST['accion']:"";
  
  ///////////////// INICIO SELECCIONAR LOS DATOS ACTUALES ////////////////////
  $mostrar_actuales= "SELECT * FROM  ((((tbl_proyectos p
  INNER JOIN tbl_clientes c ON p.ID_CLIENTE = c.ID_CLIENTE)
  INNER JOIN tbl_usuarios u ON p.ID_USUARIO = u.ID_USUARIO)
  INNER JOIN tbl_estados_proyectos e ON p.ID_ESTADOS = e.ID_ESTADOS ) 
  INNER JOIN tbl_departamentos d ON p.ID_DEPARTAMENTO = d.ID_DEPARTAMENTO)   
   WHERE ID_PROYECTO='$id_proyecto'";
  $sultados_actuales = $conn->query($mostrar_actuales);
  if ($sultados_actuales->num_rows > 0) 
  {
   while($datos_actuales = $sultados_actuales->fetch_assoc()) 
   {
     $ID_CLIENTE = $datos_actuales["ID_CLIENTE"];
     $NOMBRE_CLIENTE = $datos_actuales["NOMBRE_CLIENTE"];
     $ID_USUARIO = $datos_actuales["ID_USUARIO"];
     $NOMBRE = $datos_actuales["NOMBRE"];
     $ID_ESTADOS = $datos_actuales["ID_ESTADOS"];
     $ESTADO_PROYECTO	 = $datos_actuales["ESTADO_PROYECTO"];
     $NOMBRE_PROYECTO = $datos_actuales["NOMBRE_PROYECTO"];
     $DESCRIPCION = $datos_actuales["DESCRIPCION"];
     $ID_DEPARTAMENTO = $datos_actuales["ID_DEPARTAMENTO"];
     $DEPARTAMENTO = $datos_actuales["DEPARTAMENTO"];
     $UBICACION = $datos_actuales["UBICACION"];
     $FECHA_INICIO = $datos_actuales["FECHA_INICIO"];
     $FECHA_FINAL = $datos_actuales["FECHA_FINAL"];
   }
 }
 ///////////////// FIN SELECCIONAR LOS DATOS ACTUALES ////////////////////
  
  switch($accion){
      //para insertar en la tabla mysl
      case "agregar": 
        // valida si existe una proyecto con el mismo nombre
        $validar_proveedor = "SELECT * FROM tbl_proyectos WHERE NOMBRE_PROYECTO='$nombre'";
        $result1 = mysqli_query($conn, $validar_proveedor); 
         if (mysqli_num_rows($result1) > 0) { 
              
         
           echo '<script>
                    alert("Proyecto ya existe");
                 </script>';
                 mysqli_close($conn);
         }else{ 
          if ($fecha_final<$fecha_inicio) { 
              
         
            echo '<script>
                     alert("Fecha incorrecta, intentelo de nuevo");
                  </script>';
                  mysqli_close($conn);
          }else{ 
                //si no existe un proyecto permite insertar
                $sql1 = "INSERT INTO tbl_proyectos ( ID_PROYECTO,ID_CLIENTE, ID_USUARIO,ID_ESTADOS, NOMBRE_PROYECTO, DESCRIPCION, ID_DEPARTAMENTO,UBICACION, FECHA_INICIO, FECHA_FINAL)
                VALUES ('$id_proyecto','$id_cliente','$id_usuario','$id_estado','$nombre','$descripcion','$id_departamento','$ubicacion','$fecha_inicio','$fecha_final')";
                if (mysqli_query($conn, $sql1)) {

                  $last_id = $conn->insert_id;

                  // inicio inserta en la tabla bitacora
                  $sql = "INSERT INTO tbl_bitacora (USUARIO, OPERACION, PANTALLA, CAMPO, ID_REGISTRO, VALOR_ORIGINAL, VALOR_NUEVO)
                      VALUES ('$usuario1[usuario]', 'INSERTO','PROYECTOS', 'PROYECTO','$last_id', 'NUEVO','$nombre')";
                    if (mysqli_query($conn, $sql)) {} else { }
                  // fin inserta en la tabla bitacora
                  
              echo '<script>
              alert("Proyecto creado con exito");
              window.location.href="../../vistas/proyectos/vista_proyectos.php";                   
            </script>';
            mysqli_close($conn);
                } else {
                        echo '<script>
                                alert("Error al tratar de crear el proyecto");
                              </script>'; mysqli_error($conn);
                       }
                
                mysqli_close($conn);

              }}                    

             
      break;

       //para editar en la tabla mysl      
      case "editar";
      //echo $DESCRIPCION.'<br>';
      //echo $descripcion.'<br>';
      //echo $nuevo_nombre_cliente.'<br>';
     // echo $NOMBRE.'<br>';
      //echo $nombre_usuario_id.'<br>';
      //echo $nuevo_nombre_usuario.'<br>';
      //die();
      // valida si existe el proyecto con el mismo nombre
      $validar_proyecto= "SELECT * FROM tbl_proyectos WHERE NOMBRE_PROYECTO='$nombre'";
      $result2 = mysqli_query($conn, $validar_proyecto); 
      if (mysqli_num_rows($result2) > 0) { 
            
          $sql2 = "UPDATE tbl_proyectos SET ID_CLIENTE='$id_cliente', ID_USUARIO='$id_usuario',	ID_ESTADOS='$id_estado', NOMBRE_PROYECTO='$anterior', DESCRIPCION='$descripcion',  ID_DEPARTAMENTO='$id_departamento', UBICACION='$ubicacion', FECHA_INICIO='$fecha_inicio', FECHA_FINAL='$fecha_final' WHERE ID_PROYECTO='$id_proyecto'";
              if (mysqli_query($conn, $sql2)) {
   
                   // ////////////// INICIO FUNCION BITACORA /////////////////////
        
        if($ID_CLIENTE != $nombre_cliente_id) ///////////// 
        {
          include_once 'funcion_bitacora.php';
          bitacora('EDITO', 'PROYECTOS', 'CLIENTE', $id_proyecto, $NOMBRE_CLIENTE, $nuevo_nombre_cliente);
        }

        if($ID_USUARIO != $nombre_usuario_id) ///////////// 
        {
          include_once 'funcion_bitacora.php';
          bitacora('EDITO', 'PROYECTOS', 'USUARIO', $id_proyecto, $NOMBRE, $nuevo_nombre_usuario);
        }

        if($ID_ESTADOS != $estado_id) ///////////// 
        {
          include_once 'funcion_bitacora.php';
          bitacora('EDITO', 'PROYECTOS', 'ESTADO', $id_proyecto, $ESTADO_PROYECTO, $nuevo_nombre_estado);
        }

        if($NOMBRE_PROYECTO != $nombre) ///////////// 
        {
          include_once 'funcion_bitacora.php';
          bitacora('EDITO', 'PROYECTOS', 'NOMBRE PROYECTO', $id_proyecto, $NOMBRE_PROYECTO, $nombre);
        }
        
        if($DESCRIPCION != $descripcion) ///////////// 
        {
          include_once 'funcion_bitacora.php';
          bitacora('EDITO', 'PROYECTOS', 'DESCRIPCION', $id_proyecto, $DESCRIPCION, $descripcion);
        }
        
        if($ID_DEPARTAMENTO != $departamento_id) ///////////// 
        {
          include_once 'funcion_bitacora.php';
          bitacora('EDITO', 'PROYECTOS', 'DEPARTAMENTO', $id_proyecto, $DEPARTAMENTO, $nuevo_nombre_departamento);
        }
        
        if($UBICACION != $ubicacion) ///////////// 
        {
          include_once 'funcion_bitacora.php';
          bitacora('EDITO', 'PROYECTOS', 'UBICASION', $id_proyecto, $UBICACION, $ubicacion);
        }
        
        if($FECHA_INICIO != $fecha_inicio) ///////////// 
        {
          include_once 'funcion_bitacora.php';
          bitacora('EDITO', 'PROYECTOS', 'FECHA INICIO', $id_proyecto, $FECHA_INICIO, $fecha_inicio);
        }
        
        if($FECHA_FINAL != $fecha_final) ///////////// 
        {
          include_once 'funcion_bitacora.php';
          bitacora('EDITO', 'PROYECTOS', 'FECHA FINAL', $id_proyecto, $FECHA_FINAL, $fecha_final);
        }
      
         // ////////////// FIN FUNCION BITACORA ///////////////////////
              
                  echo '<script>
                          alert("Campos del Proyecto editado con exito");
                          window.location.href="../../vistas/proyectos/vista_proyectos.php";                   
                        </script>';
                        mysqli_close($conn);
                      

              }else{
                 
                       echo '<script>
                                alert("Error al tratar de editar proyecto");
                             </script>'; mysqli_error($conn);
                   }

                   mysqli_close($conn);

             // si no existe el proveedor con el mismo nombre
          }else{
          $sql4 = "UPDATE tbl_proyectos SET ID_CLIENTE='$id_cliente', ID_USUARIO='$id_usuario', ID_ESTADOS='$id_estado', NOMBRE_PROYECTO='$nombre', DESCRIPCION='$descripcion',  ID_DEPARTAMENTO='$id_departamento', UBICACION='$ubicacion', FECHA_INICIO='$fecha_inicio', FECHA_FINAL='$fecha_final' WHERE ID_PROYECTO='$id_proyecto'"; 
                if (mysqli_query($conn, $sql4)) {
                 
             // ////////////// INICIO FUNCION BITACORA /////////////////////
        
        if($ID_CLIENTE != $nombre_cliente_id) ///////////// 
        {
          include_once 'funcion_bitacora.php';
          bitacora('EDITO', 'PROYECTOS', 'CLIENTE', $id_proyecto, $NOMBRE_CLIENTE, $nuevo_nombre_cliente);
        }

        if($ID_USUARIO != $nombre_usuario_id) ///////////// 
        {
          include_once 'funcion_bitacora.php';
          bitacora('EDITO', 'PROYECTOS', 'USUARIO', $id_proyecto, $NOMBRE, $nuevo_nombre_usuario);
        }

        if($ID_ESTADOS != $estado_id) ///////////// 
        {
          include_once 'funcion_bitacora.php';
          bitacora('EDITO', 'PROYECTOS', 'ESTADO', $id_proyecto, $ESTADO_PROYECTO, $nuevo_nombre_estado);
        }

        if($NOMBRE_PROYECTO != $nombre) ///////////// 
        {
          include_once 'funcion_bitacora.php';
          bitacora('EDITO', 'PROYECTOS', 'NOMBRE PROYECTO', $id_proyecto, $NOMBRE_PROYECTO, $nombre);
        }
        
        if($DESCRIPCION != $descripcion) ///////////// 
        {
          include_once 'funcion_bitacora.php';
          bitacora('EDITO', 'PROYECTOS', 'DESCRIPCION', $id_proyecto, $DESCRIPCION, $descripcion);
        }
        
        if($ID_DEPARTAMENTO != $departamento_id) ///////////// 
        {
          include_once 'funcion_bitacora.php';
          bitacora('EDITO', 'PROYECTOS', 'DEPARTAMENTO', $id_proyecto, $DEPARTAMENTO, $nuevo_nombre_departamento);
        }
        
        if($UBICACION != $ubicacion) ///////////// 
        {
          include_once 'funcion_bitacora.php';
          bitacora('EDITO', 'PROYECTOS', 'UBICASION', $id_proyecto, $UBICACION, $ubicacion);
        }
        
        if($FECHA_INICIO != $fecha_inicio) ///////////// 
        {
          include_once 'funcion_bitacora.php';
          bitacora('EDITO', 'PROYECTOS', 'FECHA INICIO', $id_proyecto, $FECHA_INICIO, $fecha_inicio);
        }
        
        if($FECHA_FINAL != $fecha_final) ///////////// 
        {
          include_once 'funcion_bitacora.php';
          bitacora('EDITO', 'PROYECTOS', 'FECHA FINAL', $id_proyecto, $FECHA_FINAL, $fecha_final);
        }
      
         // ////////////// FIN FUNCION BITACORA ///////////////////////
                 echo '<script>
                 alert("Proyecto editado con exito");
                 window.location.href="../../vistas/proyectos/vista_proyectos.php";                   
               </script>';
               mysqli_close($conn);
                   

                }else{
                  
                     echo '<script>
                            alert("Error al tratar de editar el proyecto");
                           </script>'; mysqli_error($conn);
                     }

                mysqli_close($conn);
              }
            
         
             
              
                
                     
      
      break;
      
      //para eliminar en la tabla mysl  
      case "eliminar";

      $sql3 = "DELETE FROM tbl_proyectos WHERE ID_PROYECTO='$id_proyecto'";
      if (mysqli_query($conn, $sql3)) {
        // inicio inserta en la tabla bitacora
        $sql = "INSERT INTO tbl_bitacora (USUARIO, OPERACION, PANTALLA, CAMPO, ID_REGISTRO, VALOR_ORIGINAL, VALOR_NUEVO)
        VALUES ('$usuario1[usuario]', 'EDITO','PROYECTOS', 'PROYECTO','$id_proyecto', 'ELIMINADO','ELIMINADO')";
      if (mysqli_query($conn, $sql)) {} else { }
    // fin inserta en la tabla bitacora

    echo '<script>
    alert("Elimino el proyecto");
    window.location.href="../../vistas/proyectos/vista_proyectos.php";                   
    </script>';
    mysqli_close($conn);
          
      }else{
              echo '<script>
                        alert("Error al tratar de eliminar el proyecto");
                    </script>'; mysqli_error($conn);
           }
        mysqli_close($conn);

      break;
      
      default:
          
          $conn->close();   
  }// Fin del switch, para validar el valor del boton accion


?>