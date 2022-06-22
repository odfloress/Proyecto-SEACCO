
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
                <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
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

  <!-- Main Sidebar Container -->
  <!-- style="background-color:rgb(255, 255, 255);" -->
  <aside  class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a  href="#" class="brand-link">
      <img src="../../imagenes/seacco.jpg" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span  class="brand-text font-weight-" >C_SEACCO</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <br>

      <!-- SidebarSearch Form -->
      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input  class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
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
          <li class="nav-item menu-open">
            <a href="http://localhost/SEACCO/vistas/tablero/vista_tablero.php" class="nav-link active">
              <i class="fa fa-home"></i>
              <p>
                Dashboard
              </p>
            </a>
            
          </li>
          <li class="nav-item">
            <a href="http://localhost/SEACCO/vistas/vista_perfil.php" class="nav-link">
              <i class="fa fa-user"></i>
              <p>
                Perfil
                <span class="right badge badge-danger">Editar</span>
              </p>
            </a>
          </li>
          
         
          <li class="nav-header">Administrar sistema</li>

        <!-- Inicio Menu personas -->
          <li class="nav-item">
            <a href="#" class="nav-link">
            <i class="fas fa-users"></i>
              <i class="fa-solid fa-people-arrows-left-right"></i>
              <p>
                Personas
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="http://localhost/SEACCO/vistas/personas/vista_administradores.php" class="nav-link">
                  <p>Administradores</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="http://localhost/SEACCO/vistas/personas/vista_clientes.php" class="nav-link">
                  <p>Clientes</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="http://localhost/SEACCO/vistas/personas/vista_proveedores.php" class="nav-link">
                  <p>Proveedores</p>
                </a>
              </li>
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
              <li class="nav-item">
                <a href="http://localhost/SEACCO/vistas/catalogo/vista_bienvenida.php" class="nav-link">
                  <p>Bienvenida</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="http://localhost/SEACCO/vistas/catalogo/vista_portafolio.php" class="nav-link">
                  <p>Portafolio</p>
                </a>
              </li>
            </ul>
          </li>
          <!-- inicio Menu catalogo -->      
          
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
              <li class="nav-item">
                <a href="http://localhost/SEACCO/vistas/inventario/vista_compras.php" class="nav-link">
                  <p>Compras</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="http://localhost/SEACCO/vistas/inventario/vista_asignaciones.php" class="nav-link">
                  <p>Asignaciones</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="http://localhost/SEACCO/vistas/inventario/vista_inventario.php" class="nav-link">
                  <p>Inventario</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="http://localhost/SEACCO/vistas/inventario/vista_categorias_productos.php" class="nav-link">
                  <p>categorias de productos</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="http://localhost/SEACCO/vistas/inventario/vista_productos.php" class="nav-link">
                  <p>Productos</p>
                </a>
              </li>
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
              <li class="nav-item">
                <a href="http://localhost/SEACCO/vistas/proyectos/vista_proyectos.php" class="nav-link">
                  <p>Proyectos</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="http://localhost/SEACCO/vistas/proyectos/vista_estado_proyecto.php" class="nav-link">
                  <p>Estado proyectos</p>
                </a>
              </li>
            </ul>
          </li>
          <!-- fin Menu proyectos --> 

          <!-- inicio Menu reportes -->
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="fas fa-chart-pie"></i>
              <p>
                Reportes
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
             
              <li class="nav-item">
                <a href="http://localhost/SEACCO/vistas/reportes/vista_personas.php" class="nav-link">
                  <p>Personas</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="http://localhost/SEACCO/vistas/reportes/vista_inventario.php" class="nav-link">
                  <p>Inventario</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="http://localhost/SEACCO/vistas/reportes/vista_proyectos.php" class="nav-link">
                  <p>Proyectos</p>
                </a>
              </li>
            </ul>
          </li>
          <!-- Fin Menu reportes -->

          <!-- inicio Menu Ajustes -->
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="fas fa-tools"></i>
              <p>
                Ajustes
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="http://localhost/SEACCO/vistas/ajustes/vista_nuestros_contactos.php" class="nav-link">
                  <p>Nuestros contactos</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="http://localhost/SEACCO/vistas/ajustes/vista_roles.php" class="nav-link">
                  <p>Roles</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="http://localhost/SEACCO/vistas/ajustes/vista_bitacora.php" class="nav-link">
                  <p>Bitacora</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="http://localhost/SEACCO/vistas/ajustes/vista_backup.php" class="nav-link">
                  <p>Backup BD</p>
                </a>
              </li>
            </ul>
          </li>

          <!-- fin Menu Ajustes -->
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
  
            