<h1>Panel de Control Maestro</h1>

<div class="card">
    <div style="display:flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem;">
        <h2>Empresas Registradas</h2>
        <a href="/master/empresas/crear" class="btn btn-primary">Añadir Empresa</a>
    </div>

    <table style="width: 100%; border-collapse: collapse; margin-bottom: 3rem;">
        <thead>
            <tr style="text-align: left; border-bottom: 1px solid var(--border-color); color: var(--text-muted);">
                <th style="padding: 1rem;">Empresa</th>
                <th style="padding: 1rem;">NIT</th>
                <th style="padding: 1rem;">Email</th>
                <th style="padding: 1rem;">Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php if (empty($empresas)): ?>
                <tr>
                    <td colspan="4" style="padding: 2rem; text-align: center; color: var(--text-muted);">No hay empresas registradas aún.</td>
                </tr>
            <?php else: ?>
                <?php foreach ($empresas as $empresa): ?>
                    <tr style="border-bottom: 1px solid var(--border-color);">
                        <td style="padding: 1rem;"><?= htmlspecialchars($empresa['nombre']) ?></td>
                        <td style="padding: 1rem;"><?= htmlspecialchars($empresa['nit']) ?></td>
                        <td style="padding: 1rem;"><?= htmlspecialchars($empresa['email_contacto']) ?></td>
                        <td style="padding: 1rem;">
                            <a href="/master/licencias/crear?empresa_id=<?= $empresa['id'] ?>" style="color: var(--accent-primary); text-decoration: none;">Generar Licencia</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>

    <div style="display:flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem;">
        <h2>Licencias Activas</h2>
    </div>

    <table style="width: 100%; border-collapse: collapse;">
        <thead>
            <tr style="text-align: left; border-bottom: 1px solid var(--border-color); color: var(--text-muted);">
                <th style="padding: 1rem;">Dominio</th>
                <th style="padding: 1rem;">Código</th>
                <th style="padding: 1rem;">Vencimiento</th>
                <th style="padding: 1rem;">Plan</th>
                <th style="padding: 1rem;">Status</th>
            </tr>
        </thead>
        <tbody>
            <?php 
                $db = \App\Core\Database::getInstance();
                $licencias = $db->query("SELECT l.*, e.nombre as empresa FROM licencias l JOIN empresas e ON l.empresa_id = e.id ORDER BY l.created_at DESC");
            ?>
            <?php if (empty($licencias)): ?>
                <tr>
                    <td colspan="5" style="padding: 2rem; text-align: center; color: var(--text-muted);">No hay licencias generadas aún.</td>
                </tr>
            <?php else: ?>
                <?php foreach ($licencias as $lic): ?>
                    <tr style="border-bottom: 1px solid var(--border-color);">
                        <td style="padding: 1rem;">
                            <strong><?= htmlspecialchars($lic['dominio']) ?></strong><br>
                            <small style="color:var(--text-muted)"><?= htmlspecialchars($lic['empresa']) ?></small>
                        </td>
                        <td style="padding: 1rem;"><code style="background:var(--bg-color); padding:0.2rem 0.5rem; border-radius:4px;"><?= htmlspecialchars($lic['codigo_licencia']) ?></code></td>
                        <td style="padding: 1rem;"><?= htmlspecialchars($lic['fecha_vencimiento']) ?></td>
                        <td style="padding: 1rem;"><?= htmlspecialchars($lic['plan_nombre']) ?></td>
                        <td style="padding: 1rem;">
                            <span style="padding: 0.2rem 0.5rem; border-radius: 1rem; font-size: 0.8rem; background: <?= $lic['status'] == 1 ? '#059669' : '#dc2626' ?>; color: white;">
                                <?= $lic['status'] == 1 ? 'Activa' : 'Inactiva' ?>
                            </span>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>
</div>
