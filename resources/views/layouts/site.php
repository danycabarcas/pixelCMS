<?php use App\Core\ThemeManager; ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $page['title'] ?? 'Pixel CMS' ?></title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&family=Work+Sans:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Work Sans', sans-serif; }
        h1, h2, h3, h4 { font-family: 'Montserrat', sans-serif; }
        .gov-blue-bg { background-color: <?= ThemeManager::getPrimaryColor() ?>; }
    </style>
    <style><?= $page['content_css'] ?? '' ?></style>
</head>
<body class="bg-gray-50 flex flex-col min-h-screen">

    <!-- GOV.CO BAR -->
    <div class="gov-blue-bg text-white py-1 px-4 text-sm relative z-50">
        <div class="container mx-auto flex justify-between items-center">
            <div class="flex items-center gap-2">
                <img src="<?= ThemeManager::getGovLogoUrl() ?>" alt="Gov.co" class="h-6 filter brightness-0 invert">
            </div>
            <div class="flex gap-4 text-xs font-medium">
                <a href="/transparencia" class="hover:underline">Transparencia</a>
                <a href="/pqrs" class="hover:underline">PQRS</a>
            </div>
        </div>
    </div>

    <!-- MAIN HEADER -->
    <header class="bg-white shadow-sm sticky top-0 z-40">
        <div class="container mx-auto px-4 py-4 flex justify-between items-center">
            <a href="/" class="flex items-center gap-3">
                <img src="<?= ThemeManager::getLogoUrl() ?>" alt="Logo" class="h-14 w-auto object-contain">
            </a>
            <nav class="hidden lg:flex items-center gap-6">
                <a href="/" class="font-semibold text-gray-700 hover:text-blue-600">Inicio</a>
                <a href="/noticias" class="font-semibold text-gray-700 hover:text-blue-600">Noticias</a>
                <a href="/contacto" class="font-semibold text-gray-700 hover:text-blue-600">Contacto</a>
            </nav>
        </div>
    </header>

    <main class="flex-grow">
        <?= $content ?>
    </main>

    <!-- FOOTER -->
    <footer class="bg-[#003366] text-white py-12">
        <div class="container mx-auto px-4 grid grid-cols-1 md:grid-cols-3 gap-8">
            <div>
                <img src="<?= ThemeManager::getLogoUrl() ?>" class="h-16 mb-4 filter brightness-0 invert">
                <p class="text-sm opacity-80">Sede Electrónica oficial de la Entidad.</p>
            </div>
            <div>
                <h4 class="font-bold mb-4">Enlaces de Interés</h4>
                <ul class="text-sm opacity-80 space-y-2">
                    <li><a href="/transparencia">Transparencia</a></li>
                    <li><a href="/normatividad">Normatividad</a></li>
                </ul>
            </div>
            <div>
                <h4 class="font-bold mb-4">Contacto</h4>
                <p class="text-sm opacity-80"><?= ThemeManager::get('address', 'Calle Falsa 123') ?></p>
                <p class="text-sm opacity-80"><?= ThemeManager::get('phone', '123-4567') ?></p>
            </div>
        </div>
    </footer>

</body>
</html>
