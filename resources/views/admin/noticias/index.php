<div class="card card-outline card-primary shadow-sm bg-white">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h3 class="card-title text-primary font-weight-bold"><i class="fas fa-newspaper mr-2"></i> Gestión de Prensa y Noticias</h3>
        <div class="ml-auto">
            <a href="/admin/noticias/crear" class="btn btn-success btn-sm p-2 px-3 shadow-sm border-0">
                <i class="fas fa-plus-circle mr-1"></i> Redactar Nueva Noticia
            </a>
        </div>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover table-striped mb-0 text-sm align-middle">
                <thead class="bg-light">
                    <tr>
                        <th width="350">Título de la Noticia</th>
                        <th width="120">Categoría</th>
                        <th width="150" class="text-center">SEO Health</th>
                        <th width="100" class="text-center">Vistas</th>
                        <th width="150">Fecha</th>
                        <th width="120" class="text-right">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($noticias)): ?>
                        <tr>
                            <td colspan="6" class="text-center py-5">
                                <i class="fas fa-info-circle text-muted fa-3x mb-3"></i><br>
                                <span class="text-muted">Aún no hay noticias publicadas. ¡EMPIECE A INFORMAR AHORA!</span>
                            </td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($noticias as $noti): 
                            // SEO Health Logic
                            $seoScore = 1; // 1: Red, 2: Yellow, 3: Green
                            if (!empty($noti['meta_title']) && !empty($noti['meta_description'])) $seoScore = 3;
                            elseif (!empty($noti['meta_description']) || !empty($noti['meta_title'])) $seoScore = 2;
                        ?>
                            <tr>
                                <td class="font-weight-bold text-dark p-3">
                                    <?= htmlspecialchars($noti['titulo']) ?><br>
                                    <small class="text-muted"><i class="fas fa-link mr-1"></i> /noticia/<?= $noti['slug'] ?></small>
                                </td>
                                <td><span class="badge badge-info"><?= $noti['categoria_nombre'] ?? 'Sin Categoría' ?></span></td>
                                <td class="text-center">
                                    <?php if ($seoScore == 3): ?>
                                        <span class="badge badge-success p-2 px-3 shadow-sm" title="SEO Optimizado"><i class="fas fa-check-circle mr-1"></i> Salud Verde</span>
                                    <?php elseif ($seoScore == 2): ?>
                                        <span class="badge badge-warning p-2 px-3 shadow-sm" title="Faltan algunos Metas"><i class="fas fa-exclamation-triangle mr-1"></i> Salud Amarilla</span>
                                    <?php else: ?>
                                        <span class="badge badge-danger p-2 px-3 shadow-sm" title="Crítico: Sin Metas SEO"><i class="fas fa-ban mr-1"></i> Salud Roja</span>
                                    <?php endif; ?>
                                </td>
                                <td class="text-center font-weight-bold"><?= $noti['views_count'] ?? 0 ?></td>
                                <td class="text-muted"><?= date('d/m/Y', strtotime($noti['fecha_publicacion'])) ?></td>
                                <td class="text-right">
                                    <div class="btn-group shadow-sm">
                                        <a href="/admin/noticias/editar/<?= $noti['id'] ?>" class="btn btn-default btn-sm" title="Editar Contenido"><i class="fas fa-edit text-primary"></i></a>
                                        <a href="/admin/noticias/borrar/<?= $noti['id'] ?>" class="btn btn-default btn-sm" onclick="return confirm('¿Seguro que desea eliminar esta noticia?')" title="Eliminar"><i class="fas fa-trash text-danger"></i></a>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
