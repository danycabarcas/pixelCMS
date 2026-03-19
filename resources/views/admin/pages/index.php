<h1>Administrar Páginas</h1>

<div class="card">
    <div style="display:flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
        <h2>Todas las Páginas</h2>
        <a href="/admin/pages/create" class="btn btn-primary">Crear Nueva Página</a>
    </div>

    <table style="width:100%; border-collapse: collapse;">
        <thead>
            <tr style="text-align: left; border-bottom: 1px solid var(--border-color); color: var(--text-muted);">
                <th style="padding:1rem;">Título</th>
                <th style="padding:1rem;">Slug</th>
                <th style="padding:1rem;">Estado</th>
                <th style="padding:1rem;">Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php if (empty($pages)): ?>
                <tr><td colspan="4" style="padding:2rem; text-align:center;">No hay páginas creadas.</td></tr>
            <?php else: ?>
                <?php foreach ($pages as $p): ?>
                    <tr style="border-bottom: 1px solid var(--border-color);">
                        <td style="padding:1rem;"><?= htmlspecialchars($p['title']) ?></td>
                        <td style="padding:1rem;"><code>/<?= htmlspecialchars($p['slug']) ?></code></td>
                        <td style="padding:1rem;"><?= $p['status'] == 1 ? 'Publicada' : 'Borrador' ?></td>
                        <td style="padding:1rem;">
                            <a href="/admin/pages/edit/<?= $p['id'] ?>" style="color:var(--accent-primary); text-decoration:none; margin-right:1rem;">Editar</a>
                            <a href="/<?= $p['slug'] ?>" target="_blank" style="color:var(--text-muted); text-decoration:none;">Ver</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>
</div>
