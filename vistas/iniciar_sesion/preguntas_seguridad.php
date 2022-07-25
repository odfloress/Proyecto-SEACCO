<?php
session_start();
if(!isset($_SESSION['nombre'])){
 
        header('Location: ../../_login.php');
        session_unset();
        session_destroy();
        die();
}
include '../../controladores/con_preguntas.php';
?>      

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Configuración preguntas</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
  <style> 
  body {
        background-image: url('../../imagenes/fondo.jpg');
        background-repeat: no-repeat;
        background-attachment: fixed; 
        background-size: 100% 100%;
       }

</style>
<!-- enlace del scritpt para evitar si preciona F12, si preciona Ctrl+Shift+I, si preciona Ctr+u  -->
<script type="text/javascript" src="../../js/evita_ver_codigo_utilizando_teclas.js"></script>
</head>
<!-- oncopy="return false" onpaste="return false"  esto no permite copiar ni pegar -->
<body style="background-color:rgb(241, 243, 243);" oncopy="return false" onpaste="return false">
<!-- inicio oculta el codigo fuente de la pagina -->
<body oncontextmenu="return false">
<!-- Fin oculta el codigo fuente de la pagina -->

<br><br>
<!-- El Modal -->

  <div  class="modal-dialog" >
    <div class="modal-content " >     
 
      <!--Inicio Cuerpo del modal -->
      <div class="modal-body ">
        <form action="" method="POST">
            <div class="mb-3 mt-3">
              <center><h3>Configuración</h3></center><br>
            <div class="alert alert-success">
            <strong>¡Hola!</strong> Configure sus preguntas y respuestas antes de ingresar al sistema <br> <strong> <?php echo "Respondido " . $respondido . " de " . $pregunta; ?></strong><br>
            </div>            
           
            <div class="container mt-3">

                <label for="sel1" class="form-label">Usuario:</label>
                <input type="text" name="" value="<?php $usuario = $_SESSION; echo $usuario['nombre']; ?>" class="form-control" readonly>
                

                <label for="sel1" class="form-label">Preguntas:</label>
                <select placeholder="Seleccione" class="form-select" id="sel1" name="preguntas" required >
                  <option></option>
                  <?php
                      include '../../conexion/conexion.php';
                      $getpregunta1 = "SELECT * FROM tbl_preguntas  WHERE ID_PREGUNTA  NOT IN (SELECT ID_PREGUNTA  FROM  tbl_respuestas_usuario WHERE USUARIO = '$usuario[nombre]' ) ORDER BY ID_PREGUNTA";
                      // $getpregunta1 = "SELECT * FROM tbl_preguntas  WHERE ID_PREGUNTA  NOT IN (SELECT ID_PREGUNTA  FROM  tbl_respuestas_usuario WHERE USUARIO = 'JO' ) ORDER BY ID_PREGUNTA";
                      $getpregunta2 = mysqli_query($conn, $getpregunta1);
                      if (mysqli_num_rows($getpregunta2) > 0) {
                          while($row = mysqli_fetch_assoc($getpregunta2))
                            {
                              $id = $row['ID_PREGUNTA'];
                              $pregunta =$row['PREGUNTA'];
                           ?>
                              <option value="<?php  echo $id; ?>"><?php echo $pregunta?></option>
                          <?php
                    }}// finaliza el if y el while
                ?>
                </select>

                <label for="pwd" class="form-label">Respuesta:</label>
                <input type="text" class="form-control" id="email" placeholder="Ingrese su respuesta" name="respuesta" autocomplete="off"   onkeyup="mayus(this);" maxlength="30" required>
                <br>                
                <div class="d-grid">
                  <button type="submit" name="accion" value="guardar" class="btn btn-dark btn-block">Guardar</button><br>
                  </form>
                </div>  
              </div>
            </div>
        
      </div>
       <!--Fin Cuerpo del modal -->
    </div>
  </div>

</body>
<script type="text/javascript" src="../../js/evitar_reenvio.js"></script>
</html>

 <!-- Enlace Script para que convierta a mayusculas las teclas que se van pulsando -->
 <script type="text/javascript" src="../../js/converir_a_mayusculas.js"></script>