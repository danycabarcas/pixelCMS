<div class="row">
    <div class="col-md-6 mx-auto">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Crear Nueva Página</h3>
            </div>
            <form action="/admin/pages/create" method="POST">
                <div class="card-body">
                    <div class="form-group">
                        <label for="titulo">Título de la Página</label>
                        <input type="text" name="titulo" class="form-control" id="titulo" placeholder="Ej: Nosotros" required>
                    </div>
                    <div class="form-group">
                        <label for="slug">Ruta (Slug)</label>
                        <div class="input-group">
                            <div class="input-group-prepend"><span class="input-group-text">/</span></div>
                            <input type="text" name="slug" class="form-control" id="slug" placeholder="nosotros" required>
                        </div>
                        <small class="text-muted">La ruta URL amigable (sin espacios ni acentos).</small>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Crear Página</button>
                    <a href="/admin/pages" class="btn btn-default float-right">Cancelar</a>
                </div>
            </form>
        </div>
    </div>
</div>
