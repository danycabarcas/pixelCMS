<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'Sitio Oficial' ?></title>
    <!-- Favicon Oficial -->
    <link rel="icon" href="https://www.gov.co/assets/images/logo.png">
    
    <!-- Gov.co Styles -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        :root {
            --gov-blue: #0943b5;
            --gov-blue-dark: #063184;
            --gov-font: 'Work Sans', sans-serif;
        }
        body { font-family: var(--gov-font); background-color: #f8f9fa; }
        
        /* Barra Gov.co */
        .gov-bar { background-color: #0943b5; padding: 5px 0; color: white; font-size: 13px; }
        .gov-logo { height: 25px; filter: brightness(0) invert(1); }
        
        /* Menu Principal */
        .main-navbar { background-color: #0943b5; border-bottom: 4px solid #fccd00; }
        .nav-link { color: white !important; font-weight: 500; text-transform: uppercase; font-size: 14px; }
        .nav-link:hover { background-color: rgba(255,255,255,0.1); }
        
        /* Footer */
        .gov-footer { background-color: #f2f2f2; border-top: 5px solid #0943b5; padding: 40px 0; font-size: 14px; }
    </style>
</head>
<body>

    <!-- Barra Superior Oficial Gov.co -->
    <div class="gov-bar">
        <div class="container d-flex justify-content-between align-items-center">
            <img src="https://cdn.www.gov.co/assets/images/logoGovCO.png" class="gov-logo" alt="Logo de GOV.CO">
            <span>Portal Oficial del Estado Colombiano</span>
        </div>
    </div>

    <!-- Navegación del Ente (Hospital) -->
    <nav class="navbar navbar-expand-lg main-navbar shadow">
        <div class="container">
            <a class="navbar-brand text-white d-flex align-items-center" href="/">
                <i class="fas fa-hospital mr-2"></i>
                <div style="line-height: 1.1;">
                    <span style="font-size: 14px; display: block; opacity: 0.8;">Sitio Oficial del</span>
                    <span style="font-weight: 700; font-size: 18px;"><?= $empresa['nombre'] ?? 'Entidad' ?></span>
                </div>
            </a>
            
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav">
                <i class="fas fa-bars text-white"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item"><a class="nav-link" href="/">Inicio</a></li>
                    <li class="nav-item"><a class="nav-link" href="/noticias">Noticias</a></li>
                    <li class="nav-item"><a class="nav-link" href="/transparencia">Transparencia</a></li>
                    <li class="nav-item"><a class="nav-link" href="/pqrs">P.Q.R.S.D</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Contenido Dinámico -->
    <main class="py-5 bg-white shadow-sm" style="min-height: 60vh;">
        <div class="container">
            {{content}}
        </div>
    </main>

    <!-- Footer Oficial -->
    <footer class="gov-footer mt-5">
        <div class="container">
            <div class="row">
                <div class="col-md-6 border-right">
                    <h5><?= $empresa['nombre'] ?? 'Especializada Entidad Pública' ?></h5>
                    <p class="text-muted"><i class="fas fa-map-marker-alt"></i> <?= $empresa['direccion'] ?? 'Dirección No Registrada' ?></p>
                    <p class="text-muted"><i class="fas fa-envelope"></i> <?= $empresa['email_contacto'] ?? 'contacto@gobierno.gov.co' ?></p>
                </div>
                <div class="col-md-6 pl-md-5">
                    <h5>¿Tienes dudas?</h5>
                    <p class="mb-1"><i class="fab fa-whatsapp text-success"></i> <?= $empresa['whatsapp'] ?? 'N/A' ?></p>
                    <small class="text-muted">Horario de atención: Lunes a Viernes 8:00 AM - 5:00 PM</small>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
