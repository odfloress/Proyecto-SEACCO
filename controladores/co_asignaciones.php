<?php
  require '../../conexion/conexion.php';
  //para mostrar los datos de la tabla mysql y mostrar en el crud
  $sql = "SELECT * FROM tbl_asignaciones";
  $result = mysqli_query($conn, $sql);


  // //Variables para recuperar la información de los campos de la vista asignaciones
  $id_asignado=(isset($_POST['id_asignado']))?$_POST['id_asignado']:"";
  $id_producto=(isset($_POST['id_producto']))?$_POST['id_producto']:"";
  $id_proyecto=(isset($_POST['id_proyecto']))?$_POST['id_proyecto']:"";
  $id_usuario=(isset($_POST['id_usuario']))?$_POST['id_usuario']:"";
  $descripcion=(isset($_POST['descripcion']))?$_POST['descripcion']:"";
  $cantidad=(isset($_POST['cantidad']))?$_POST['cantidad']:"";
  $estado_herramienta=(isset($_POST['estado_herramienta']))?$_POST['estado_herramienta']:"";
  $estado_asignacion=(isset($_POST['estado_asignacion']))?$_POST['estado_asignacion']:"";
  $fecha_asignado=(isset($_POST['fecha_asignado']))?$_POST['fecha_asignado']:"";
  $fecha_entrega=(isset($_POST['fecha_entrega']))?$_POST['fecha_entrega']:"";

  //variable para recuperar los botones de la vista asignaciones 
  $accion=(isset($_POST['accion']))?$_POST['accion']:"";
  
 switch ($accion){ 
case 'accion':
         // validar si existe el producto en la base de datos.
         $validar_producto = "SELECT * FROM tbl_productos WHERE ID_PRODUCTO = $id_producto ";
         $result = mysqli_query($conn, $validar_producto); 
          if (mysqli_num_rows($result) > 1) { 
               
                          //Si existe el código de producto permite insertar
                          $sql = "INSERT INTO tbl_asignaciones (ID_ASIGNADO, ID_PRODUCTO, ID_PROYECTO, ID_USUARIO, DESCRIPCION, CANTIDAD,
                          ESTADO_HERRAMIENTA, ESTADO_ASIGNACION, FECHA_ASIGNADO, FECHA_ENTREGA)
                   VALUES(1, '$id_producto', '$id_proyecto', '$id_usuario', '$descripcion', '$cantidad',
                          '$estado_herramienta', '$estado_asignacion', '$fecha_asignado', '$fecha_entrega')";
 
 
                     
                     echo '<script>
                     alert("El código de producto no existe. Intente con un código válido");
                  </script>';
                  $conn->close();  
 
 
 
          }else{ 
           echo  '<script>
           alert("Asignación guardada con éxito");
           window.location.href="/Proyecto-SEACCO/vistas/inventario/vista_asignaciones";
           </script>';
           $conn->close();    
             } 

  break;
                 
}

$conn->close();        
        
                
  // Fin del switch, para validar el valor del boton accion


?>