<div class="row">
    <div class="col-md-12">
        <div class="card card-outline card-success">
            <div class="card-header">
                <h3 class="card-title"><i class="fas fa-cubes mr-2"></i> Módulos del Sistema SaaS</h3>
                <div class="card-tools">
                    <a href="/master/modulos/crear" class="btn btn-success btn-sm"><i class="fas fa-plus mr-1"></i> Añadir Módulo</a>
                </div>
            </div>
            <div class="card-body p-0">
                <table class="table table-striped table-hover m-0">
                    <thead>
                        <tr>
                            <th>Icono</th>
                            <th>Nombre del Módulo</th>
                            <th>Slug (ID Interno)</th>
                            <th>Descripción</th>
                            <th class="text-center">Estado</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($modulos)): ?>
                            <tr><td colspan="5" class="text-center py-4 text-muted">No hay módulos registrados en el sistema.</td></tr>
                        <?php else: ?>
                            <?php foreach ($modulos as $mod): ?>
                                <tr>
                                    <td class="text-center"><i class="fas <?= htmlspecialchars($mod['icono']) ?> text-success fa-lg"></i></td>
                                    <td><strong><?= htmlspecialchars($mod['nombre']) ?></strong></td>
                                    <td><code><?= htmlspecialchars($mod['slug']) ?></code></td>
                                    <td><?= htmlspecialchars($mod['descripcion']) ?></td>
                                    <td class="text-center">
                                        <span class="badge badge-<?= $mod['status'] == 1 ? 'success' : 'danger' ?>">
                                            <?= $mod['status'] == 1 ? 'Activo' : 'Inactivo' ?>
                                        </span>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
            <div class="card-footer bg-white border-top">
                <small class="text-muted"><i class="fas fa-info-circle"></i> Los módulos definen las funciones empaquetadas que estarán disponibles para los usuarios finales dentro de los planes de licencias.</small>
            </div>
        </div>
    </div>
</div>
