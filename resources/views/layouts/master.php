<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title><?= $title ?? 'Pixel CMS Master' ?></title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style> 
        :root { --accent: #3b82f6; } 
        body { background: #0f172a; color: #f8fafc; font-family: 'Outfit', sans-serif; margin: 0; min-height: 100vh; } 
        .sidebar-link.active { background: #1e293b; color: #3b82f6; border-left: 4px solid #3b82f6; }
    </style>
</head>
<body class="flex">
    <aside class="w-64 h-screen bg-slate-900 p-6 border-r border-slate-800">
        <h1 class="text-xl font-bold text-blue-500 mb-8">Pixel CMS <span class="text-xs text-white">SaaS</span></h1>
        <nav class="space-y-4">
            <a href="/master" class="block p-3 hover:bg-slate-800 rounded-lg"><i class="fa-solid fa-building mr-2"></i> Gestión de Empresas</a>
            <a href="/admin/pages" class="block p-3 hover:bg-slate-800 rounded-lg"><i class="fa-solid fa-file-lines mr-2"></i> Páginas del CMS</a>
        </nav>
    </aside>
    <main class="flex-1 p-10 overflow-auto">
        {{content}}
    </main>
</body>
</html>
