<div class="bg-blue-50 py-12">
    <div class="container mx-auto px-4 text-center">
        <h1 class="text-3xl font-bold text-gray-800"><?= $title ?></h1>
        <p class="text-gray-600 mt-2">En cumplimiento de la Ley 1712 de 2014, ponemos a su disposición esta sección.</p>
    </div>
</div>

<div class="container mx-auto px-4 py-12">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <?php foreach ($categories as $cat): ?>
            <a href="<?= $cat['url'] ?>" class="flex items-center justify-between p-6 bg-white rounded-xl shadow-sm border border-gray-100 hover:shadow-md transition-shadow group">
                <span class="font-semibold text-gray-700 group-hover:text-blue-600"><?= $cat['title'] ?></span>
                <i class="fa-solid fa-chevron-right text-gray-400 group-hover:text-blue-600"></i>
            </a>
        <?php endforeach; ?>
    </div>
</div>
