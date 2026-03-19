<div class="row">
    <!-- Empresas -->
    <div class="col-md-12">
        <div class="card card-outline card-primary">
            <div class="card-header">
                <h3 class="card-title"><i class="fas fa-building mr-2"></i> Empresas Registradas</h3>
                <div class="card-tools">
                    <a href="/master/empresas/crear" class="btn btn-primary btn-sm"><i class="fas fa-plus mr-1"></i> Añadir Empresa</a>
                </div>
            </div>
            <div class="card-body p-0">
                <table class="table table-striped table-hover m-0">
                    <thead>
                        <tr>
                            <th>Nombre de Empresa</th>
                            <th>NIT / Identificación</th>
                            <th>Email de Contacto</th>
                            <th class="text-right">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($empresas)): ?>
                            <tr><td colspan="4" class="text-center py-4 text-muted">No hay empresas registradas aún.</td></tr>
                        <?php else: ?>
                            <?php foreach ($empresas as $empresa): ?>
                                <tr>
                                    <td><strong><?= htmlspecialchars($empresa['nombre']) ?></strong></td>
                                    <td><code><?= htmlspecialchars($empresa['nit']) ?></code></td>
                                    <td><?= htmlspecialchars($empresa['email_contacto']) ?></td>
                                    <td class="text-right">
                                        <a href="/master/licencias/crear?empresa_id=<?= $empresa['id'] ?>" class="btn btn-outline-primary btn-xs">Generar Licencia</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Licencias -->
    <div class="col-md-12 mt-4">
        <div class="card card-outline card-info">
            <div class="card-header">
                <h3 class="card-title"><i class="fas fa-key mr-2"></i> Licencias Activas</h3>
            </div>
            <div class="card-body p-0">
                <table class="table table-striped table-hover m-0">
                    <thead>
                        <tr>
                            <th>Dominio / Empresa</th>
                            <th>Código Maestro</th>
                            <th>Vencimiento</th>
                            <th>Plan</th>
                            <th class="text-center">Estado</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            $db = \App\Core\Database::getInstance();
                            $licencias = $db->query("SELECT l.*, e.nombre as empresa FROM licencias l JOIN empresas e ON l.empresa_id = e.id ORDER BY l.created_at DESC");
                        ?>
                        <?php if (empty($licencias)): ?>
                            <tr><td colspan="5" class="text-center py-4 text-muted">No hay licencias generadas aún.</td></tr>
                        <?php else: ?>
                            <?php foreach ($licencias as $lic): ?>
                                <tr>
                                    <td><strong><?= htmlspecialchars($lic['dominio']) ?></strong><br><small class="text-muted"><?= htmlspecialchars($lic['empresa']) ?></small></td>
                                    <td><code><?= htmlspecialchars($lic['codigo_licencia']) ?></code></td>
                                    <td><?= htmlspecialchars($lic['fecha_vencimiento']) ?></td>
                                    <td><span class="badge badge-info"><?= htmlspecialchars($lic['plan_nombre']) ?></span></td>
                                    <td class="text-center">
                                        <span class="badge badge-<?= $lic['status'] == 1 ? 'success' : 'danger' ?>">
                                            <?= $lic['status'] == 1 ? 'Activa' : 'Inactiva' ?>
                                        </span>
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
