<?php
session_start();
?>
<!DOCTYPE html>
<html>
<body>

<?php
// remove all session variables
session_unset();

// destroy the session
session_destroy();

header('Location: ../vistas/iniciar_sesion/index_login.php');
?>

</body>
</html>