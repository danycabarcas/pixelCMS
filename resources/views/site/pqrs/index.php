<div class="bg-gov-blue-bg text-white py-12">
    <div class="container mx-auto px-4">
        <h1 class="text-3xl font-bold">Peticiones, Quejas, Reclamos y Sugerencias (PQRS)</h1>
        <p class="opacity-80 mt-2">Su opinión es muy importante para nosotros.</p>
    </div>
</div>

<div class="container mx-auto px-4 py-16">
    <div class="max-w-2xl mx-auto bg-white p-8 rounded-2xl shadow-sm border border-gray-100">
        <form action="/pqrs/enviar" method="POST">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Nombre Completo</label>
                    <input type="text" name="nombre" required class="w-full p-3 border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none">
                </div>
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Correo Electrónico</label>
                    <input type="email" name="email" required class="w-full p-3 border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none">
                </div>
            </div>

            <div class="mb-6">
                <label class="block text-sm font-bold text-gray-700 mb-2">Tipo de Solicitud</label>
                <select name="tipo" class="w-full p-3 border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none">
                    <option value="Petición">Petición</option>
                    <option value="Queja">Queja</option>
                    <option value="Reclamo">Reclamo</option>
                    <option value="Sugerencia">Sugerencia</option>
                </select>
            </div>

            <div class="mb-6">
                <label class="block text-sm font-bold text-gray-700 mb-2">Asunto</label>
                <input type="text" name="asunto" required class="w-full p-3 border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none">
            </div>

            <div class="mb-8">
                <label class="block text-sm font-bold text-gray-700 mb-2">Mensaje</label>
                <textarea name="mensaje" rows="5" required class="w-full p-3 border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none"></textarea>
            </div>

            <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-4 rounded-lg transition-colors">
                Enviar Solicitud
            </button>
        </form>
    </div>
</div>
