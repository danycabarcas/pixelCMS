<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?= $title ?? 'Pixel CMS - Panel Maestro' ?></title>

  <!-- Google Font: Source Sans Pro & Outfit -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;600&display=swap" rel="stylesheet">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <!-- Theme style (AdminLTE) -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">
  
  <style>
    body { font-family: 'Outfit', sans-serif; }
    .main-sidebar { background-color: #1f2d3d !important; } /* Deep Blue-Gray */
    .brand-link { background-color: #343a40 !important; border-bottom: 1px solid #4b545c !important; }
    .nav-sidebar .nav-link.active { background-color: #3b82f6 !important; }
    .content-wrapper { background-color: #f4f6f9; }
  </style>
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <ul class="navbar-nav">
      <li class="nav-item"><a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a></li>
      <li class="nav-item d-none d-sm-inline-block"><a href="/master" class="nav-link">Inicio</a></li>
    </ul>
    <ul class="navbar-nav ml-auto">
      <li class="nav-item"><a class="nav-link text-danger" href="/logout"><i class="fas fa-sign-out-alt"></i> Salir</a></li>
    </ul>
  </nav>

  <!-- Sidebar -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="/master" class="brand-link">
      <span class="brand-text font-weight-light pl-3"><b>Pixel</b> CMS</span>
    </a>
    <div class="sidebar">
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu">
          <li class="nav-item">
            <a href="/master" class="nav-link active"><i class="nav-icon fas fa-building"></i><p>Gestión de Empresas</p></a>
          </li>
          <li class="nav-item">
            <a href="/admin/pages" class="nav-link"><i class="nav-icon fas fa-file-alt"></i><p>Páginas del CMS</p></a>
          </li>
        </ul>
      </nav>
    </div>
  </aside>

  <!-- Content -->
  <div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6"><h1 class="m-0 text-dark"><?= $title ?? 'Gestión' ?></h1></div>
        </div>
      </div>
    </div>
    <div class="content"><div class="container-fluid">{{content}}</div></div>
  </div>

  <footer class="main-footer"><strong>Pixel CMS &copy; 2026 AdminLTE.</strong> Todos los derechos reservados.</footer>
</div>

<!-- AdminLTE Scripts -->
<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>
</body>
</html>
