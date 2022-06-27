
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
        <form action="../../controladores/con_preguntas.php" method="POST">
            <div class="mb-3 mt-3">
               <center> <h3>Preguntas de seguridad</h3></center>
            <center><img src="../../imagenes/seacco.jpg" alt="Girl in a jacket" width="150" height="150"><br></center>
           
            <div class="container mt-3">

                <label for="sel1" class="form-label">Preguntas:</label>
                <select class="form-select" id="sel1" name="preguntas" >
                <option></option>
                <option>COLOR FAVORITO</option>
                <option>COMIDA FAVORITA</option>
                </select>


            </div>
            </div>
            <div class="mb-3">
            <label for="pwd" class="form-label">Respuesta:</label>
            <input type="text" class="form-control" id="email" placeholder="Ingrese su respuesta" name="respuesta">
            </div>
            <div class="d-grid">
            <button type="submit" name="accion" value="guardar" class="btn btn-dark btn-block">Guardar</button>
            </div>
          
            
        </form>
      </div>
       <!--Fin Cuerpo del modal -->

     

    </div>
  </div>



</body>
<script type="text/javascript" src="../../js/evitar_reenvio.js"></script>
</html>
