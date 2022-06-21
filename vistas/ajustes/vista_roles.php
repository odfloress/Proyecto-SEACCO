<?php
session_start();
if(!isset($_SESSION['usuario'])){
 
        header('Location: ../iniciar_sesion/index_login.php');
        session_unset();
        session_destroy();
        die();
        
}
print_r($_SESSION);
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
  <title>Administracion</title>

  <?php include '../../configuracion/navar.php' ?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0"></h1>
          </div><!-- /.col -->
          
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">
         
<!-- Contenido -->
<div class="container mt-3">
        <h3>Roles de Usuario Agregados</h3> <br>  
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#myModal">
            Nuevo Rol
        </button>
    </div>

<!-- El Modal -->
    <div class="modal" id="myModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Encabezado del modal -->
                <div class="modal-header">
                    <h4 class="modal-title">Nuevo Rol</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <!-- Fin Encabezado del modal -->

                <!-- Cuerpo del modal Modal -->
                <div class="modal-body">
                <div class="container mt-3">
	                <label for="pwd" class="form-label">Rol:</label><br>
                    <input type="text" name="" id="">  
                </div>

              <div class="container mt-3">
<label for="pwd" class="form-label">Nuevo Acceso:</label>
<form action="/action_page.php">
<div class="form-check">
<input type="checkbox" class="form-check-input" id="check1" name="option1" value="something" checked>
<label class="form-check-label" for="check1">Visualizar</label>
</div>
<div class="form-check">
<input type="checkbox" class="form-check-input" id="check2" name="option2" value="something">
<label class="form-check-label" for="check2">Guardar</label>
</div>
<div class="form-check">
<input type="checkbox" class="form-check-input" id="check3" name="option3" value="something">
<label class="form-check-label" for="check3">Actualizar</label>
</div>
<div class="form-check">
<input type="checkbox" class="form-check-input" id="check4" name="option4" value="something">
<label class="form-check-label" for="check4">Elimiar</label>
</div>
</form>
</div>
<div class="container mt-3">
<label for="pwd" class="form-label">Pantallas:</label>
<form action="/action_page.php">
<div class="form-check">
<input type="checkbox" class="form-check-input" id="check1" name="option1" value="something" checked>
<label class="form-check-label" for="check1">Personas</label>
</div>
<div class="form-check">
<input type="checkbox" class="form-check-input" id="check2" name="option2" value="something">
<label class="form-check-label" for="check2">Catalogo</label>
</div>
<div class="form-check">
<input type="checkbox" class="form-check-input" id="check3" name="option3" value="something">
<label class="form-check-label" for="check3">Inventario</label>
</div>
<div class="form-check">
<input type="checkbox" class="form-check-input" id="check4" name="option4" value="something">
<label class="form-check-label" for="check4">Proyectos</label>
</div>
<div class="form-check">
<input type="checkbox" class="form-check-input" id="check4" name="option4" value="something">
<label class="form-check-label" for="check4">Reportes</label>
</div>
<div class="form-check">
<input type="checkbox" class="form-check-input" id="check4" name="option4" value="something">
<label class="form-check-label" for="check4">Ajustes</label>
</div>
</form>
                </div>

                <div class="container mt-3">
	                <label for="pwd" class="form-label">Estado de Rol:</label>
                    <form>
                        <select class="form-select form-select-sm mt-3">
                            <option>Activo</option>
                            <option>Inactivo</option>
                        </select>
                    </form>    
                </div>


                </div>
                <!-- Fin Cuerpo del modal Modal -->
                <!-- pie del modal -->
                <div class="modal-footer">
      	            <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Guardar</button>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                </div>
                <!-- Fin pie del modal -->
            </div>
        </div>
    </div>
    <!-- Fin  de modal de agregar --> <br>
    <!-- Inicio de la tabla -->
    <div class="container" style="margin-top: 10px;padding: 5px">
        <table id="tablax" class="table  table-bordered table-striped ">
            <thead>
                <tr>
                <th>Id</th>
                <th>Rol</th>
                <th>Estado</th>
        	    <th>Acciones</th>
                </tr>
            </thead>
            <tbody id="myTable">
                <tr>
                <td>1</td>
                <td>Administrador</td>
                <td>Activo</td>
                <td> 
                <form action="" method="post">               
                    <!-- Inicio de modal de editar -->
<div class="container mt-3">
        
        <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#myModal2">
            Editar
        </button>
    </div>

<!-- El Modal -->
    <div class="modal" id="myModal2">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Encabezado del modal -->
                <div class="modal-header">
                    <h4 class="modal-title">Editar Rol</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <!-- Fin Encabezado del modal -->

                <!-- Cuerpo del modal Modal -->
                <div class="modal-body">
                <div class="container mt-3">
	                <label for="pwd" class="form-label">Rol:</label><br>
                    <input type="text" name="" id="">  
                </div>

              <div class="container mt-3">
<label for="pwd" class="form-label">Nuevo Acceso:</label>
<form action="/action_page.php">
<div class="form-check">
<input type="checkbox" class="form-check-input" id="check1" name="option1" value="something" checked>
<label class="form-check-label" for="check1">Visualizar</label>
</div>
<div class="form-check">
<input type="checkbox" class="form-check-input" id="check2" name="option2" value="something">
<label class="form-check-label" for="check2">Guardar</label>
</div>
<div class="form-check">
<input type="checkbox" class="form-check-input" id="check3" name="option3" value="something">
<label class="form-check-label" for="check3">Actualizar</label>
</div>
<div class="form-check">
<input type="checkbox" class="form-check-input" id="check4" name="option4" value="something">
<label class="form-check-label" for="check4">Elimiar</label>
</div>
</form>
</div>
<div class="container mt-3">
<label for="pwd" class="form-label">Pantallas:</label>
<form action="/action_page.php">
<div class="form-check">
<input type="checkbox" class="form-check-input" id="check1" name="option1" value="something" checked>
<label class="form-check-label" for="check1">Personas</label>
</div>
<div class="form-check">
<input type="checkbox" class="form-check-input" id="check2" name="option2" value="something">
<label class="form-check-label" for="check2">Catalogo</label>
</div>
<div class="form-check">
<input type="checkbox" class="form-check-input" id="check3" name="option3" value="something">
<label class="form-check-label" for="check3">Inventario</label>
</div>
<div class="form-check">
<input type="checkbox" class="form-check-input" id="check4" name="option4" value="something">
<label class="form-check-label" for="check4">Proyectos</label>
</div>
<div class="form-check">
<input type="checkbox" class="form-check-input" id="check4" name="option4" value="something">
<label class="form-check-label" for="check4">Reportes</label>
</div>
<div class="form-check">
<input type="checkbox" class="form-check-input" id="check4" name="option4" value="something">
<label class="form-check-label" for="check4">Ajustes</label>
</div>
</form>
                </div>

                <div class="container mt-3">
	                <label for="pwd" class="form-label">Estado de Rol:</label>
                    <form>
                        <select class="form-select form-select-sm mt-3">
                            <option>Activo</option>
                            <option>Inactivo</option>
                        </select>
                    </form>    
                </div>


                </div>
                <!-- Fin Cuerpo del modal Modal -->
                <!-- pie del modal -->
                <div class="modal-footer">
      	            <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Guardar</button>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                </div>
                <!-- Fin pie del modal -->
            </div>
        </div>
    </div>
    <!-- Fin  de modal de Editar -->
                    <button  value="btnEliminar" name="accion" 
                        onclick="return confirm('¿Quieres eliminar este dato?')"
                        type="submit" class="btn btn-danger " data-id="19">
                        <i class="fa fa-times fa fa-white"></i>
                            Eliminar
                    </button>
                </form>  
                 
                       
            </tbody>        
        </table>
    </div>

<!-- fin contenido -->



<?php include '../../configuracion/footer.php' ?>


