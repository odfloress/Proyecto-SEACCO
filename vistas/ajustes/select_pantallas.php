
 
<?php $tipo=(isset($_POST['lista1']))?$_POST['lista1']:"";

?>


<label for="">Seleccione la pantalla</label>
<select class="form-select" id="lista1" name="lista2" required >
   
    <?php
        include '../../conexion/conexion.php';
        $seleccion_rol=(isset($_POST['rol']))?$_POST['rol']:"";echo $seleccion_rol;
        $roles = "SELECT * FROM tbl_ms_objetos  WHERE ID_OBJETO  NOT IN (SELECT ID_OBJETO  FROM  tbl_ms_roles_ojetos WHERE ID_ROL = '$tipo' ) ORDER BY ID_OBJETO";
        // $roles = "SELECT * FROM tbl_ms_objetos ORDER BY ID_OBJETO";
        $roles2 = mysqli_query($conn, $roles);
        if (mysqli_num_rows($roles2) > 0) {
            while($row = mysqli_fetch_assoc($roles2))
            {
            $id_rol = $row['ID_OBJETO'];
            $rol =$row['OBJETO'];
     ?>
      <option value="<?php  echo $id_rol ?>"><?php echo $rol ?></option>
      <?php
       }}// finaliza el if y el while
       ?>
</select>











