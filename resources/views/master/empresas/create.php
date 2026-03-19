<h1>Añadir Nueva Empresa</h1>

<div class="card" style="max-width: 600px;">
    <form action="/master/empresas/crear" method="POST">
        <div style="margin-bottom: 1rem;">
            <label style="display:block; margin-bottom: 0.5rem; color: var(--text-muted);">Nombre de la Empresa</label>
            <input type="text" name="nombre" required style="width:100%; padding:0.75rem; border-radius:0.5rem; border:1px solid var(--border-color); background:var(--bg-color); color:white;">
        </div>
        
        <div style="margin-bottom: 1rem;">
            <label style="display:block; margin-bottom: 0.5rem; color: var(--text-muted);">NIT</label>
            <input type="text" name="nit" style="width:100%; padding:0.75rem; border-radius:0.5rem; border:1px solid var(--border-color); background:var(--bg-color); color:white;">
        </div>

        <div style="margin-bottom: 1rem;">
            <label style="display:block; margin-bottom: 0.5rem; color: var(--text-muted);">Email de Contacto</label>
            <input type="email" name="email_contacto" required style="width:100%; padding:0.75rem; border-radius:0.5rem; border:1px solid var(--border-color); background:var(--bg-color); color:white;">
        </div>

        <div style="margin-bottom: 1rem;">
            <label style="display:block; margin-bottom: 0.5rem; color: var(--text-muted);">Teléfono</label>
            <input type="text" name="telefono" style="width:100%; padding:0.75rem; border-radius:0.5rem; border:1px solid var(--border-color); background:var(--bg-color); color:white;">
        </div>

        <div style="margin-bottom: 1.5rem;">
            <label style="display:block; margin-bottom: 0.5rem; color: var(--text-muted);">Dirección</label>
            <textarea name="direccion" style="width:100%; padding:0.75rem; border-radius:0.5rem; border:1px solid var(--border-color); background:var(--bg-color); color:white;"></textarea>
        </div>

        <div style="display:flex; gap:1rem;">
            <button type="submit" class="btn btn-primary">Guardar Empresa</button>
            <a href="/master" class="btn btn-secondary">Cancelar</a>
        </div>
    </form>
</div>
