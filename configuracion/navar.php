
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../../plantilla/AdminLTE-3.2.0/plugins/fontawesome-free/css/all.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="../../plantilla/AdminLTE-3.2.0/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="../../plantilla/AdminLTE-3.2.0/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="../../plantilla/AdminLTE-3.2.0/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../../plantilla/AdminLTE-3.2.0/dist/css/adminlte.min.css">


  <style>
[class*=sidebar-dark-] {
    background-color: #b3b5ff;
}

    [class*=sidebar-dark-] .nav-header {
    background-color: inherit;
    color: #000000;
}

.navbar-white {
    background-color: #dbdbdb;
    color: #000000;
}
   


[class*=sidebar-dark] .btn-sidebar, [class*=sidebar-dark] .form-control-sidebar {
    background-color: #ededed;
    border: 1px solid #b5c8db;
    color: #fff;
}

[class*=sidebar-dark-] .nav-treeview>.nav-item>.nav-link {
    color: #00040a;
}
[class*=sidebar-dark-] .sidebar a {
    color: #01040a;
}
  </style>
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
  <!-- Navbar -->
  <!-- Navbar -->
  <nav  class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <!-- Navbar Search -->
        <li class="nav-item">
            <a class="nav-link" data-widget="navbar-search" href="#" role="button">
            <i class="fas fa-search"></i>
            </a>
            <div class="navbar-search-block">
            <form class="form-inline">
                <div class="input-group input-group-sm">
                <input class="form-control form-control-navbar" type="search" placeholder="Buscar" aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-navbar" type="submit">
                    <i class="fas fa-search"></i>
                    </button>
                    <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                    <i class="fas fa-times"></i>
                    </button>
                </div>
                </div>
            </form>
            </div>
        </li>

        <!-- Messages Dropdown Menu -->
        
        <!-- Notifications Dropdown Menu -->
        <li class="nav-item dropdown">
                <a class="nav-link" data-toggle="dropdown" href="#">
                <i class="fa fa-user"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item">
                    <i class="fa fa-user"></i> Perfil (<?php $usuario = $_SESSION; echo $usuario['usuario']; ?>)
                </a>
                <div class="dropdown-divider"></div>
                <a href="../../seguridad/cerrar_sesion.php" class="dropdown-item">
                    <i class="fas fa-file mr-2"></i> Salir
                </a>         
        </li>


            <li class="nav-item">
                    <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                    <i class="fas fa-expand-arrows-alt"></i>
                    </a>
            </li>
    </ul>
  </nav>
  <!-- /.navbar -->
  <?php 
    require '../../conexion/conexion.php';
    $select_nombre = "SELECT * FROM tbl_parametros WHERE PARAMETRO='NOMBRE'";
    $select_nombre1 = mysqli_query($conn, $select_nombre);
    if (mysqli_num_rows($select_nombre1) > 0)
    {
    while($row = mysqli_fetch_assoc($select_nombre1))
      { 
          $nombre_constructora = $row['VALOR'];
      } 
    }
?>
  <!-- Main Sidebar Container -->
  <!-- style="background-color:rgb(255, 255, 255);" -->
  <aside  class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    
    <a  href="#" class="brand-link">
      <img src="../../imagenes/seacco.jpg" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span  class="brand-text font-weight-" ><?php echo $nombre_constructora ?></span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <br>

      <!-- SidebarSearch Form -->
      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input  class="form-control form-control-sidebar" type="search" placeholder="Buscar" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
               <!-- SELECCIONA  EL ROL DEL USUARIO -->
               <?php 
               include '../../conexion/conexion.php';
               $usuario = $_SESSION;
               $roles34 = "SELECT * FROM tbl_usuarios WHERE USUARIO='$usuario[usuario]'";
               $roles35 = mysqli_query($conn, $roles34);
               if (mysqli_num_rows($roles35) > 0)
               {
                while($row = mysqli_fetch_assoc($roles35))
                 { 
                     $id_rol7 = $row['ID_ROL'];
                 } 
               }
               ?>
            
            <!-- Valida si tiene permiso para consultar la pantalla tablero -->
           
                 <li class="nav-item menu-open">
                  <a href="../../vistas/tablero/vista_tablero.php" class="nav-link active">
                    <i class="fa fa-home"></i>
                    <p>
                      Dashboard
                    </p>
                  </a>
                </li>

                <li class="nav-item">
                  <a href="../../vistas/tablero/vista_perfil.php" class="nav-link">
                    <i class="fa fa-user"></i>
                    <p>
                      Perfil
                      <span class="right badge badge-danger">Editar</span>
                    </p>
                  </a>
                </li>
            

           

          
          
          
         
          <li class="nav-header">Administrar Sistema</li>

        <!-- Inicio Menu personas -->
          <li class="nav-item">
           <!-- Valida si tiene permiso para consultar el modulo personas -->
           <a href="#" class="nav-link">
                  <i class="fas fa-users"></i>
                    <i class="fa-solid fa-people-arrows-left-right"></i>
                    <p>
                      Personas
                      <i class="fas fa-angle-left right"></i>
                    </p>
                  </a>
            <ul class="nav nav-treeview">
              <!-- Valida si tiene permiso para consultar la pantalla administradores -->
            <?php 
               include '../../conexion/conexion.php';
               $tablero = "SELECT * FROM tbl_ms_roles_ojetos WHERE ID_ROL='$id_rol7' and ID_OBJETO=1 and PERMISO_CONSULTAR=1";
               $tablero2 = mysqli_query($conn, $tablero);
               if (mysqli_num_rows($tablero2) > 0)
               {
                  echo '<li class="nav-item">
                          <a href="../../vistas/personas/vista_administradores.php" class="nav-link">
                            <p>Usuarios</p>
                          </a>
                        </li>';
               }
            ?>
             <!-- Valida si tiene permiso para consultar la pantalla Clientes -->
             <?php 
               include '../../conexion/conexion.php';
               $tablero = "SELECT * FROM tbl_ms_roles_ojetos WHERE ID_ROL='$id_rol7' and ID_OBJETO=4 and PERMISO_CONSULTAR=1";
               $tablero2 = mysqli_query($conn, $tablero);
               if (mysqli_num_rows($tablero2) > 0)
               {
                  echo '<li class="nav-item">
                          <a href="../../vistas/personas/vista_clientes.php" class="nav-link">
                            <p>Clientes</p>
                          </a>
                        </li>';
               }
            ?>
             <!-- Valida si tiene permiso para consultar la pantalla PROVEEDORES -->
             <?php 
               include '../../conexion/conexion.php';
               $tablero = "SELECT * FROM tbl_ms_roles_ojetos WHERE ID_ROL='$id_rol7' and ID_OBJETO=5 and PERMISO_CONSULTAR=1";
               $tablero2 = mysqli_query($conn, $tablero);
               if (mysqli_num_rows($tablero2) > 0)
               {
                  echo '<li class="nav-item">
                          <a href="../../vistas/personas/vista_proveedores.php" class="nav-link">
                            <p>Proveedores</p>
                          </a>
                        </li>';
               }
            ?>          
              
            </ul>
          </li>
          <!-- Fin Menu personas -->

           <!-- inicio Menu catalogo -->
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="far fa-images"></i>
              <p>
                Catálogo
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <!-- Valida si tiene permiso para consultar la pantalla del CRUD Bienvenida -->
             <?php 
               include '../../conexion/conexion.php';
               $tablero = "SELECT * FROM tbl_ms_roles_ojetos WHERE ID_ROL='$id_rol7' and ID_OBJETO=6 and PERMISO_CONSULTAR=1";
               $tablero2 = mysqli_query($conn, $tablero);
               if (mysqli_num_rows($tablero2) > 0)
               {
                  echo '<li class="nav-item">
                          <a href="../../vistas/catalogo/vista_bienvenida.php" class="nav-link">
                            <p>Bienvenida</p>
                          </a>
                        </li>';
               }
              ?> 
             <!-- Valida si tiene permiso para consultar la pantalla del CRUD PORTAFOLIO -->
             <?php 
               include '../../conexion/conexion.php';
               $tablero = "SELECT * FROM tbl_ms_roles_ojetos WHERE ID_ROL='$id_rol7' and ID_OBJETO=7 and PERMISO_CONSULTAR=1";
               $tablero2 = mysqli_query($conn, $tablero);
               if (mysqli_num_rows($tablero2) > 0)
               {
                  echo '<li class="nav-item">
                          <a href="../../vistas/catalogo/vista_portafolio.php" class="nav-link">
                            <p>Portafolio</p>
                          </a>
                        </li>';
               }
              ?> 
              <!-- Valida si tiene permiso para consultar la pantalla del CRUD CATALOGOS -->
             <?php 
               include '../../conexion/conexion.php';
               $tablero = "SELECT * FROM tbl_ms_roles_ojetos WHERE ID_ROL='$id_rol7' and ID_OBJETO=31 and PERMISO_CONSULTAR=1";
               $tablero2 = mysqli_query($conn, $tablero);
               if (mysqli_num_rows($tablero2) > 0)
               {
                  echo '<li class="nav-item">
                  <a href="../../vistas/catalogo/vista_catalagos.php" class="nav-link">
                    <p>Catálogos</p>
                  </a>
                </li>';
               }
              ?> 
              
              
            </ul>
          </li>
          <!-- Fin Menu catalogo -->      
          
        <!-- inicio Menu inventario --> 
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="fas fa-shopping-bag"></i>
              <p>
               Inventario
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
            <!-- Valida si tiene permiso para consultar la pantalla del CRUD COMPRAS -->
            <?php 
               include '../../conexion/conexion.php';
               $tablero = "SELECT * FROM tbl_ms_roles_ojetos WHERE ID_ROL='$id_rol7' and ID_OBJETO=8 and PERMISO_CONSULTAR=1";
               $tablero2 = mysqli_query($conn, $tablero);
               if (mysqli_num_rows($tablero2) > 0)
               {
                  echo '<li class="nav-item">
                  <a href="../../vistas/inventario/vista_compras.php" class="nav-link">
                    <p>Compras</p>
                  </a>
                </li>';
               }
              ?> 
                 <!-- Valida si tiene permiso para consultar la pantalla del CRUD DEVOLUCIONES -->
            <?php 
               include '../../conexion/conexion.php';
               $tablero = "SELECT * FROM tbl_ms_roles_ojetos WHERE ID_ROL='$id_rol7' and ID_OBJETO=33 and PERMISO_CONSULTAR=1";
               $tablero2 = mysqli_query($conn, $tablero);
               if (mysqli_num_rows($tablero2) > 0)
               {
                  echo '<li class="nav-item">
                  <a href="../../vistas/inventario/devoluciones.php" class="nav-link">
                    <p>Devoluciones de compras</p>
                  </a>
                </li>';
               }
              ?> 
                 <!-- Valida si tiene permiso para consultar la pantalla del CRUD OTRAS ENTRADAS -->
            <?php 
               include '../../conexion/conexion.php';
               $tablero = "SELECT * FROM tbl_ms_roles_ojetos WHERE ID_ROL='$id_rol7' and ID_OBJETO=34 and PERMISO_CONSULTAR=1";
               $tablero2 = mysqli_query($conn, $tablero);
               if (mysqli_num_rows($tablero2) > 0)
               {
                  echo '<li class="nav-item">
                  <a href="../../vistas/inventario/regalias.php" class="nav-link">
                    <p>Otras entradas</p>
                  </a>
                </li>';
               }
              ?> 
                  <!-- Valida si tiene permiso para consultar la pantalla del CRUD OTRAS saLIDAS -->
            <?php 
               include '../../conexion/conexion.php';
               $tablero = "SELECT * FROM tbl_ms_roles_ojetos WHERE ID_ROL='$id_rol7' and ID_OBJETO=35 and PERMISO_CONSULTAR=1";
               $tablero2 = mysqli_query($conn, $tablero);
               if (mysqli_num_rows($tablero2) > 0)
               {
                  echo '<li class="nav-item">
                  <a href="../../vistas/inventario/salidas.php" class="nav-link">
                    <p>Otras salidas</p>
                  </a>
                </li>';
               }
              ?> 
            <!-- Valida si tiene permiso para consultar la pantalla del CRUD ASIGNACIONES -->
            <?php 
               include '../../conexion/conexion.php';
               $tablero = "SELECT * FROM tbl_ms_roles_ojetos WHERE ID_ROL='$id_rol7' and ID_OBJETO=9 and PERMISO_CONSULTAR=1";
               $tablero2 = mysqli_query($conn, $tablero);
               if (mysqli_num_rows($tablero2) > 0)
               {
                  echo '<li class="nav-item">
                  <a href="../../vistas/inventario/vista_asignaciones.php" class="nav-link">
                    <p>Asignaciones</p>
                  </a>
                </li>';
               }
              ?> 
              <!-- Valida si tiene permiso para consultar la pantalla del CRUD INVENTARIO -->
            <?php 
               include '../../conexion/conexion.php';
               $tablero = "SELECT * FROM tbl_ms_roles_ojetos WHERE ID_ROL='$id_rol7' and ID_OBJETO=10 and PERMISO_CONSULTAR=1";
               $tablero2 = mysqli_query($conn, $tablero);
               if (mysqli_num_rows($tablero2) > 0)
               {
                  echo '<li class="nav-item">
                  <a href="../../vistas/inventario/vista_inventario.php" class="nav-link">
                    <p>Inventario</p>
                  </a>
                </li>';
               }
              ?> 
            
              <!-- Valida si tiene permiso para consultar la pantalla del CRUD CATEGORIA DE PRODUCTOS -->
            <?php 
               include '../../conexion/conexion.php';
               $tablero = "SELECT * FROM tbl_ms_roles_ojetos WHERE ID_ROL='$id_rol7' and ID_OBJETO=11 and PERMISO_CONSULTAR=1";
               $tablero2 = mysqli_query($conn, $tablero);
               if (mysqli_num_rows($tablero2) > 0)
               {
                  echo '<li class="nav-item">
                  <a href="../../vistas/inventario/vista_categorias_productos.php" class="nav-link">
                    <p>Categoría de Productos</p>
                  </a>
                </li>';
               }
              ?> 
              <!-- Valida si tiene permiso para consultar la pantalla del CRUD PRODUCTOS -->
            <?php 
               include '../../conexion/conexion.php';
               $tablero = "SELECT * FROM tbl_ms_roles_ojetos WHERE ID_ROL='$id_rol7' and ID_OBJETO=12 and PERMISO_CONSULTAR=1";
               $tablero2 = mysqli_query($conn, $tablero);
               if (mysqli_num_rows($tablero2) > 0)
               {
                  echo '<li class="nav-item">
                  <a href="../../vistas/inventario/vista_productos.php" class="nav-link">
                    <p>Productos</p>
                  </a>
                </li>';
               }
              ?> 
            </ul>
          </li>
          <!-- fin Menu inventario --> 

          <!-- nicio Menu proyectos --> 
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="fas fa-share-alt"></i>
              <p>
               Proyectos
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <!-- Valida si tiene permiso para consultar la pantalla del CRUD proyectos -->
            <?php 
               include '../../conexion/conexion.php';
               $tablero = "SELECT * FROM tbl_ms_roles_ojetos WHERE ID_ROL='$id_rol7' and ID_OBJETO=13 and PERMISO_CONSULTAR=1";
               $tablero2 = mysqli_query($conn, $tablero);
               if (mysqli_num_rows($tablero2) > 0)
               {
                  echo '<li class="nav-item">
                  <a href="../../vistas/proyectos/vista_proyectos.php" class="nav-link">
                    <p>Proyectos</p>
                  </a>
                </li>';
               }
              ?>
              <!-- Valida si tiene permiso para consultar la pantalla del CRUD ESTADO DE PROYECTOS -->
            <?php 
               include '../../conexion/conexion.php';
               $tablero = "SELECT * FROM tbl_ms_roles_ojetos WHERE ID_ROL='$id_rol7' and ID_OBJETO=14 and PERMISO_CONSULTAR=1";
               $tablero2 = mysqli_query($conn, $tablero);
               if (mysqli_num_rows($tablero2) > 0)
               {
                  echo '<li class="nav-item">
                  <a href="../../vistas/proyectos/vista_estado_proyecto.php" class="nav-link">
                    <p>Estado Proyectos</p>
                  </a>
                </li>';
               }
              ?>

              
            </ul>
          </li>
          <!-- fin Menu proyectos --> 

          <!-- inicio Menu reportes -->
          <!-- <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="fas fa-chart-pie"></i>
              <p>
                Reportes
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
             
              <li class="nav-item">
                <a href="../../vistas/reportes/vista_personas.php" class="nav-link">
                  <p>Personas</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="../../vistas/reportes/vista_inventario.php" class="nav-link">
                  <p>Inventario</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="../../vistas/reportes/vista_proyectos.php" class="nav-link">
                  <p>Proyectos</p>
                </a>
              </li>
            </ul>
          </li> -->
          <!-- Fin Menu reportes -->

          <!-- inicio Menu Ajustes -->
          
          <li class="nav-item">
            <a href="#" class="nav-link">	
              <i class="fas fa-user-shield"></i>
              <p>
                Seguridad
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <!-- Valida si tiene permiso para consultar la pantalla PARAMETRO-->
            <?php 
               include '../../conexion/conexion.php';
               $tablero = "SELECT * FROM tbl_ms_roles_ojetos WHERE ID_ROL='$id_rol7' and ID_OBJETO=28 and PERMISO_CONSULTAR=1";
               $tablero2 = mysqli_query($conn, $tablero);
               if (mysqli_num_rows($tablero2) > 0)
               {
                  echo '<li class="nav-item">
                  <a href="../../vistas/ajustes/vista_parametro.php" class="nav-link">
                    <p>Parámetros</p>
                  </a>
                </li>';
               }
              ?>
              <!-- Valida si tiene permiso para consultar la pantalla ROLES-->
            <?php 
               include '../../conexion/conexion.php';
               $tablero = "SELECT * FROM tbl_ms_roles_ojetos WHERE ID_ROL='$id_rol7' and ID_OBJETO=19 and PERMISO_CONSULTAR=1";
               $tablero2 = mysqli_query($conn, $tablero);
               if (mysqli_num_rows($tablero2) > 0)
               {
                  echo '<li class="nav-item">
                  <a href="../../vistas/ajustes/vista_roles.php" class="nav-link">
                    <p>Roles</p>
                  </a>
                </li>';
               }
              ?>
              <!-- Valida si tiene permiso para consultar la pantalla PERMISO DE ROLES -->
            <?php 
               include '../../conexion/conexion.php';
               $tablero = "SELECT * FROM tbl_ms_roles_ojetos WHERE ID_ROL='$id_rol7' and ID_OBJETO=20 and PERMISO_CONSULTAR=1";
               $tablero2 = mysqli_query($conn, $tablero);
               if (mysqli_num_rows($tablero2) > 0)
               {
                  echo '<li class="nav-item">
                  <a href="../../vistas/ajustes/vista_permisos.php" class="nav-link">
                    <p>Permisos de Roles</p>
                  </a>
                </li>';
               }
              ?>
              <!-- Valida si tiene permiso para consultar la pantalla preguntas de seguridad -->
            <?php 
               include '../../conexion/conexion.php';
               $tablero = "SELECT * FROM tbl_ms_roles_ojetos WHERE ID_ROL='$id_rol7' and ID_OBJETO=21 and PERMISO_CONSULTAR=1";
               $tablero2 = mysqli_query($conn, $tablero);
               if (mysqli_num_rows($tablero2) > 0)
               {
                  echo '<li class="nav-item">
                  <a href="../../vistas/ajustes/vista_preguntas.php" class="nav-link">
                    <p>Preguntas de Seguridad</p>
                  </a>
                </li>';
               }
            ?>
              
              <!-- Valida si tiene permiso para consultar la pantalla respuetas de usuario -->
            <?php 
               include '../../conexion/conexion.php';
               $tablero = "SELECT * FROM tbl_ms_roles_ojetos WHERE ID_ROL='$id_rol7' and ID_OBJETO=32 and PERMISO_CONSULTAR=1";
               $tablero2 = mysqli_query($conn, $tablero);
               if (mysqli_num_rows($tablero2) > 0)
               {
                  echo '<li class="nav-item">
                  <a href="../../vistas/ajustes/vista_respuestas_usuarios.php" class="nav-link">
                    <p>Respuestas de Usuario</p>
                  </a>
                </li>';
               }
            ?>
              <!-- Valida si tiene permiso para consultar la pantalla BITACORA -->
              
            <?php 
               include '../../conexion/conexion.php';
               $tablero = "SELECT * FROM tbl_ms_roles_ojetos WHERE ID_ROL='$id_rol7' and ID_OBJETO=22 and PERMISO_CONSULTAR=1";
               $tablero2 = mysqli_query($conn, $tablero);
               if (mysqli_num_rows($tablero2) > 0)
               {
                  echo '<li class="nav-item">
                  <a href="../../vistas/ajustes/vista_bitacora.php" class="nav-link">
                    <p>Bitácora</p>
                  </a>
                </li>';
               }
              ?>
              <!-- Valida si tiene permiso para consultar la pantalla BACKUP BD-->
            <?php 
               include '../../conexion/conexion.php';
               $tablero = "SELECT * FROM tbl_ms_roles_ojetos WHERE ID_ROL='$id_rol7' and ID_OBJETO=23 and PERMISO_CONSULTAR=1";
               $tablero2 = mysqli_query($conn, $tablero);
               if (mysqli_num_rows($tablero2) > 0)
               {
                  echo '<li class="nav-item">
                  <a href="../../Restauracion_BD/php/index.php" class="nav-link">
                  
                  <!-- <a href="http://localhost/SEACCO/Respaldo_BD/php/index.php" class="nav-link"> -->
                    <!-- <a href="../../vistas/ajustes/vista_backup.php" class="nav-link"> -->
                      <p>Backup BD</p>
                    </a>
                  </li>';
               }
              ?>

            </ul>
          </li>

          <!-- fin Menu Ajustes -->
          <!-- inicio Menu reportes -->
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="fas fa-tools"></i>
              <p>
                Mantenimiento
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <!-- Valida si tiene permiso para consultar la pantalla NUESTROS CONTACTOS -->
            <?php 
               include '../../conexion/conexion.php';
               $tablero = "SELECT * FROM tbl_ms_roles_ojetos WHERE ID_ROL='$id_rol7' and ID_OBJETO=18 and PERMISO_CONSULTAR=1";
               $tablero2 = mysqli_query($conn, $tablero);
               if (mysqli_num_rows($tablero2) > 0)
               {
                  echo '<li class="nav-item">
                  <a href="../../vistas/mantenimiento/vista_nuestros_contactos.php" class="nav-link">
                    <p>Nuestros Contactos</p>
                  </a>
                </li>';
               }
              ?>
               <!-- Valida si tiene permiso para consultar la pantalla PROFECIONES -->
            <?php 
               include '../../conexion/conexion.php';
               $tablero = "SELECT * FROM tbl_ms_roles_ojetos WHERE ID_ROL='$id_rol7' and ID_OBJETO=24 and PERMISO_CONSULTAR=1";
               $tablero2 = mysqli_query($conn, $tablero);
               if (mysqli_num_rows($tablero2) > 0)
               {
                  echo '<li class="nav-item">
                  <a href="../../vistas/mantenimiento/vista_profesiones.php" class="nav-link">
                    <p>Profesiones</p>
                  </a>
                </li>';
               }
              ?>
               <!-- Valida si tiene permiso para consultar la pantalla GENERO -->
            <?php 
               include '../../conexion/conexion.php';
               $tablero = "SELECT * FROM tbl_ms_roles_ojetos WHERE ID_ROL='$id_rol7' and ID_OBJETO=29 and PERMISO_CONSULTAR=1";
               $tablero2 = mysqli_query($conn, $tablero);
               if (mysqli_num_rows($tablero2) > 0)
               {
                  echo '<li class="nav-item">
                  <a href="../../vistas/mantenimiento/vista_genero.php" class="nav-link">
                    <p>Genero</p>
                  </a>
                </li>';
               }
              ?>
               <!-- Valida si tiene permiso para consultar la pantalla AREAS DE EMPLEO -->
            <?php 
               include '../../conexion/conexion.php';
               $tablero = "SELECT * FROM tbl_ms_roles_ojetos WHERE ID_ROL='$id_rol7' and ID_OBJETO=30 and PERMISO_CONSULTAR=1";
               $tablero2 = mysqli_query($conn, $tablero);
               if (mysqli_num_rows($tablero2) > 0)
               {
                  echo '<li class="nav-item">
                  <a href="../../vistas/mantenimiento/vista_area.php" class="nav-link">
                    <p>Áreas de Empleo</p>
                  </a>
                </li>';
               }
              ?>
               <!-- Valida si tiene permiso para consultar la pantalla ESTADOS DE ASIGNACION -->
            <?php 
               include '../../conexion/conexion.php';
               $tablero = "SELECT * FROM tbl_ms_roles_ojetos WHERE ID_ROL='$id_rol7' and ID_OBJETO=25 and PERMISO_CONSULTAR=1";
               $tablero2 = mysqli_query($conn, $tablero);
               if (mysqli_num_rows($tablero2) > 0)
               {
                  echo '<li class="nav-item">
                  <a href="../../vistas/mantenimiento/vista_estados_asignacion.php" class="nav-link">
                    <p>Estados de Asignación</p>
                  </a>
                </li>';
               }
              ?>
               <!-- Valida si tiene permiso para consultar la pantalla ESTADOS DE HERRAMIENTA 
            <?php 
               include '../../conexion/conexion.php';
               $tablero = "SELECT * FROM tbl_ms_roles_ojetos WHERE ID_ROL='$id_rol7' and ID_OBJETO=26 and PERMISO_CONSULTAR=1";
               $tablero2 = mysqli_query($conn, $tablero);
               if (mysqli_num_rows($tablero2) > 0)
               {
                  echo '<li class="nav-item">
                  <a href="../../vistas/mantenimiento/vista_estado_herramienta.php" class="nav-link">
                    <p>Estado de Herramientas</p>
                  </a>
                </li>';
               }
              ?> -->
            
              
              <!-- <li class="nav-item">
                <a href="../../vistas/mantenimiento/vista_departamentos.php" class="nav-link">
                  <p>Departamentos</p>
                </a>
              </li> -->
             
              
              
              
              
            </ul>
          </li>
          <!-- Fin Menu reportes -->
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
      </div>
    <!-- /.sidebar -->
  </aside>
  
            