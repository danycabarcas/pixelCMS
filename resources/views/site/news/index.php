<div class="bg-gray-100 py-12">
    <div class="container mx-auto px-4">
        <h1 class="text-4xl font-bold text-gray-800">Noticias y Actualidad</h1>
        <p class="text-gray-600 mt-2">Manténgase informado sobre las últimas novedades de la entidad.</p>
    </div>
</div>

<div class="container mx-auto px-4 py-16">
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        <?php if (empty($noticias)): ?>
            <p class="text-center col-span-full py-12 text-gray-500">No hay noticias publicadas en este momento.</p>
        <?php else: ?>
            <?php foreach ($noticias as $news): ?>
                <div class="bg-white rounded-2xl overflow-hidden shadow-sm hover:shadow-lg transition-all border border-gray-100 group">
                    <img src="<?= $news['imagen_url'] ?: '/assets/img/placeholder.png' ?>" class="w-full h-48 object-cover group-hover:scale-105 transition-transform duration-500">
                    <div class="p-6">
                        <span class="text-xs font-bold text-blue-600 uppercase tracking-wide"><?= $news['categoria'] ?></span>
                        <h2 class="text-xl font-bold text-gray-800 mt-2 group-hover:text-blue-600">
                            <a href="/noticia/<?= $news['slug'] ?>"><?= $news['titulo'] ?></a>
                        </h2>
                        <p class="text-gray-600 mt-3 text-sm line-clamp-3"><?= $news['resumen'] ?></p>
                        <div class="mt-6 pt-4 border-t border-gray-50 flex justify-between items-center">
                            <span class="text-xs text-gray-500"><i class="fa-regular fa-calendar mr-2"></i><?= date('d/m/Y', strtotime($news['fecha_publicacion'])) ?></span>
                            <a href="/noticia/<?= $news['slug'] ?>" class="text-sm font-bold text-blue-600">Leer más &rarr;</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</div>
