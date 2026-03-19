<div class="row">
    <div class="col-md-12">
        <div class="card card-outline card-primary">
            <div class="card-header">
                <h3 class="card-title"><i class="fas fa-file-alt mr-2"></i> Listado de Páginas</h3>
                <div class="card-tools">
                    <a href="/admin/pages/create" class="btn btn-primary btn-sm"><i class="fas fa-plus mr-1"></i> Crear Nueva Página</a>
                </div>
            </div>
            <div class="card-body p-0">
                <table class="table table-striped table-hover m-0">
                    <thead>
                        <tr>
                            <th>Título de Página</th>
                            <th>Ruta (Slug)</th>
                            <th class="text-center">Estado</th>
                            <th class="text-right">Operaciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($pages)): ?>
                            <tr><td colspan="4" class="text-center py-4 text-muted">No existen páginas configuradas aún.</td></tr>
                        <?php else: ?>
                            <?php foreach ($pages as $p): ?>
                                <tr>
                                    <td><strong><?= htmlspecialchars($p['titulo']) ?></strong></td>
                                    <td><code>/<?= htmlspecialchars($p['slug']) ?></code></td>
                                    <td class="text-center">
                                        <span class="badge badge-<?= $p['status'] == 1 ? 'success' : 'warning' ?>">
                                            <?= $p['status'] == 1 ? 'Publicada' : 'Borrador' ?>
                                        </span>
                                    </td>
                                    <td class="text-right">
                                        <div class="btn-group">
                                            <a href="/admin/pages/edit/<?= $p['id'] ?>" class="btn btn-default btn-xs"><i class="fas fa-edit mr-1"></i> Editar</a>
                                            <a href="/<?= $p['slug'] ?>" target="_blank" class="btn btn-default btn-xs"><i class="fas fa-eye mr-1"></i> Ver</a>
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
</div>
