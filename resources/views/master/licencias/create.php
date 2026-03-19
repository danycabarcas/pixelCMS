<h1>Generar Nueva Licencia</h1>

<div class="card" style="max-width: 600px;">
    <form action="/master/licencias/crear" method="POST">
        <div style="margin-bottom: 1rem;">
            <label style="display:block; margin-bottom: 0.5rem; color: var(--text-muted);">Empresa</label>
            <select name="empresa_id" required style="width:100%; padding:0.75rem; border-radius:0.5rem; border:1px solid var(--border-color); background:var(--bg-color); color:white;">
                <?php foreach ($empresas as $empresa): ?>
                    <option value="<?= $empresa['id'] ?>" <?= (isset($_GET['empresa_id']) && $_GET['empresa_id'] == $empresa['id']) ? 'selected' : '' ?>>
                        <?= htmlspecialchars($empresa['nombre']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        
        <div style="margin-bottom: 1rem;">
            <label style="display:block; margin-bottom: 0.5rem; color: var(--text-muted);">Dominio (Ej: salud.gov.co)</label>
            <input type="text" name="dominio" required style="width:100%; padding:0.75rem; border-radius:0.5rem; border:1px solid var(--border-color); background:var(--bg-color); color:white;">
        </div>

        <div style="margin-bottom: 1rem;">
            <label style="display:block; margin-bottom: 0.5rem; color: var(--text-muted);">Fecha de Vencimiento</label>
            <input type="date" name="fecha_vencimiento" required style="width:100%; padding:0.75rem; border-radius:0.5rem; border:1px solid var(--border-color); background:var(--bg-color); color:white;">
        </div>

        <div style="margin-bottom: 1rem;">
            <label style="display:block; margin-bottom: 0.5rem; color: var(--text-muted);">Plan</label>
            <select name="plan_nombre" style="width:100%; padding:0.75rem; border-radius:0.5rem; border:1px solid var(--border-color); background:var(--bg-color); color:white;">
                <option value="Básico">Básico</option>
                <option value="Pro">Pro</option>
                <option value="Gobierno Premium">Gobierno Premium</option>
            </select>
        </div>

        <div style="margin-bottom: 1rem;">
            <label style="display:block; margin-bottom: 0.5rem; color: var(--text-muted);">Cuentas de Correo</label>
            <input type="number" name="cuentas_correo" value="5" style="width:100%; padding:0.75rem; border-radius:0.5rem; border:1px solid var(--border-color); background:var(--bg-color); color:white;">
        </div>

        <div style="margin-bottom: 1.5rem;">
            <label style="display:block; margin-bottom: 0.5rem; color: var(--text-muted);">Módulos Habilitados</label>
            <div style="display:grid; grid-template-columns: 1fr 1fr; gap:0.5rem;">
                <label><input type="checkbox" name="modulos[]" value="transparencia" checked> Transparencia</label>
                <label><input type="checkbox" name="modulos[]" value="noticias" checked> Noticias</label>
                <label><input type="checkbox" name="modulos[]" value="pqrs" checked> PQRS</label>
                <label><input type="checkbox" name="modulos[]" value="grapesjs" checked> Page Builder</label>
                <label><input type="checkbox" name="modulos[]" value="chat"> Chat en Línea</label>
            </div>
        </div>

        <div style="display:flex; gap:1rem;">
            <button type="submit" class="btn btn-primary">Generar Licencia</button>
            <a href="/master" class="btn btn-secondary">Cancelar</a>
        </div>
    </form>
</div>
