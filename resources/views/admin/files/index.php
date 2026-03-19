<h1>Gestor de Archivos</h1>

<div class="card">
    <div style="margin-bottom: 2rem;">
        <form action="/admin/files/upload" method="POST" enctype="multipart/form-data" style="display:flex; gap:1rem;">
            <input type="file" name="file" required style="padding:0.5rem; background:var(--bg-color); border:1px solid var(--border-color); border-radius:0.5rem; color:white;">
            <button type="submit" class="btn btn-primary">Subir Archivo</button>
        </form>
    </div>

    <div style="display:grid; grid-template-columns: repeat(auto-fill, minmax(150px, 1fr)); gap:1.5rem;">
        <?php foreach ($files as $file): ?>
            <div style="background:var(--bg-color); padding:1rem; border-radius:0.5rem; border:1px solid var(--border-color); text-align:center;">
                <?php 
                    $ext = strtolower(pathinfo($file, PATHINFO_EXTENSION));
                    $isImage = in_array($ext, ['jpg', 'jpeg', 'png', 'gif', 'svg', 'webp']);
                ?>
                
                <?php if ($isImage): ?>
                    <img src="/uploads/<?= $file ?>" style="max-width:100%; height:80px; object-fit:cover; border-radius:4px; margin-bottom:0.5rem;">
                <?php else: ?>
                    <div style="height:80px; display:flex; align-items:center; justify-content:center; color:var(--text-muted);">
                        <i class="fa-solid fa-file-lines text-3xl"></i>
                    </div>
                <?php endif; ?>

                <div style="font-size:0.75rem; color:var(--text-muted); overflow:hidden; text-overflow:ellipsis; white-space:nowrap; margin-bottom:0.5rem;">
                    <?= htmlspecialchars($file) ?>
                </div>

                <div style="display:flex; justify-content:center; gap:0.5rem;">
                    <a href="/uploads/<?= $file ?>" target="_blank" style="color:var(--accent-primary);"><i class="fa-solid fa-eye"></i></a>
                    <a href="/admin/files/delete/<?= urlencode($file) ?>" style="color:#ef4444;"><i class="fa-solid fa-trash"></i></a>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
