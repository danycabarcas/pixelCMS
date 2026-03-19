<div class="row">
    <div class="col-md-8 mx-auto">
        <div class="card card-outline card-success shadow-sm">
            <div class="card-header">
                <h3 class="card-title text-success"><i class="fas fa-cube mr-2"></i> Crear Nuevo Módulo Maestro</h3>
            </div>
            <form action="/master/modulos/crear" method="POST">
                <div class="card-body">
                    <div class="form-group">
                        <label for="nombre">Nombre Comercial del Módulo</label>
                        <input type="text" name="nombre" class="form-control" id="nombre" placeholder="Ej: Blog Avanzado" required>
                    </div>
                    <div class="form-group border-bottom pb-4">
                        <label for="slug">Slug Interno (ID)</label>
                        <div class="input-group">
                            <div class="input-group-prepend"><span class="input-group-text"><i class="fas fa-terminal"></i></span></div>
                            <input type="text" name="slug" class="form-control" id="slug" placeholder="blog_avanzado" required>
                        </div>
                        <small class="text-muted">Debe ser único, sin espacios ni caracteres especiales.</small>
                    </div>
                    <div class="form-group border-bottom pb-4 mt-3">
                        <label for="descripcion">Descripción Funcional</label>
                        <textarea name="descripcion" id="descripcion" rows="3" class="form-control" placeholder="Describe qué hace este módulo..." required></textarea>
                    </div>
                    <div class="form-group pt-2">
                        <label for="icono">Icono (Clase de FontAwesome)</label>
                        <div class="input-group">
                            <div class="input-group-prepend"><span class="input-group-text"><i class="fab fa-font-awesome-flag"></i></span></div>
                            <input type="text" name="icono" class="form-control" id="icono" placeholder="fa-newspaper" value="fa-cube">
                        </div>
                    </div>
                </div>
                <div class="card-footer bg-white text-right">
                    <a href="/master/modulos" class="btn btn-default mr-2">Cancelar</a>
                    <button type="submit" class="btn btn-success px-5"><i class="fas fa-check mr-1"></i> Guardar Módulo</button>
                </div>
            </form>
        </div>
    </div>
</div>
