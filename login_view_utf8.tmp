<div class="min-h-screen flex items-center justify-center bg-slate-950">
    <div class="bg-slate-900 p-10 rounded-2xl border border-slate-800 w-full max-w-md shadow-2xl">
        <h1 class="text-3xl font-bold text-center text-blue-500 mb-2">Pixel CMS</h1>
        <p class="text-slate-400 text-center mb-8">Gestión Centralizada SaaS</p>
        
        <?php if(isset($error)): ?>
            <div class="bg-red-900/50 border border-red-500 text-red-200 p-3 rounded-lg mb-6 text-sm text-center">
                <?= $error ?>
            </div>
        <?php endif; ?>

        <form action="/login" method="POST" class="space-y-6">
            <div>
                <label class="block text-sm font-medium text-slate-300 mb-2">Correo Electrónico</label>
                <input type="email" name="email" required class="w-full bg-slate-800 border border-slate-700 rounded-lg p-3 text-white outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            <div>
                <label class="block text-sm font-medium text-slate-300 mb-2">Contraseña</label>
                <input type="password" name="password" required class="w-full bg-slate-800 border border-slate-700 rounded-lg p-3 text-white outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 rounded-lg transition-colors">
                Iniciar Sesión
            </button>
        </form>
    </div>
</div>
