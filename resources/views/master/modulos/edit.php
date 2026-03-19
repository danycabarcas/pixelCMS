<div class="row">
    <div class="col-md-8 mx-auto">
        <div class="card card-outline card-success shadow-sm">
            <div class="card-header">
                <h3 class="card-title text-success"><i class="fas fa-cube mr-2"></i> Editar Módulo Maestro</h3>
            </div>
            <form action="/master/modulos/editar/<?= $modulo['id'] ?>" method="POST">
                <div class="card-body">
                    <div class="form-group">
                        <label for="nombre">Nombre Comercial del Módulo</label>
                        <input type="text" name="nombre" class="form-control" id="nombre" value="<?= htmlspecialchars($modulo['nombre']) ?>" required>
                    </div>
                    <div class="form-group border-bottom pb-4">
                        <label for="slug">Slug Interno (ID)</label>
                        <div class="input-group">
                            <div class="input-group-prepend"><span class="input-group-text"><i class="fas fa-terminal"></i></span></div>
                            <input type="text" name="slug" class="form-control" id="slug" value="<?= htmlspecialchars($modulo['slug']) ?>" required>
                        </div>
                    </div>
                    <div class="form-group border-bottom pb-4 mt-3">
                        <label for="descripcion">Descripción Funcional</label>
                        <textarea name="descripcion" id="descripcion" rows="3" class="form-control" required><?= htmlspecialchars($modulo['descripcion']) ?></textarea>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group pt-2">
                                <label for="icono">Icono (Clase de FontAwesome)</label>
                                <div class="input-group">
                                    <div class="input-group-prepend"><span class="input-group-text"><i class="fab fa-font-awesome-flag"></i></span></div>
                                    <input type="text" name="icono" class="form-control" id="icono" value="<?= htmlspecialchars($modulo['icono']) ?>">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group pt-2">
                                <label for="status">Estado del Módulo</label>
                                <select name="status" id="status" class="form-control">
                                    <option value="1" <?= $modulo['status'] == 1 ? 'selected' : '' ?>>Activo</option>
                                    <option value="0" <?= $modulo['status'] == 0 ? 'selected' : '' ?>>Inactivo</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer bg-white text-right">
                    <a href="/master/modulos" class="btn btn-default mr-2">Cancelar</a>
                    <button type="submit" class="btn btn-success px-5"><i class="fas fa-save mr-1"></i> Actualizar Módulo</button>
                </div>
            </form>
        </div>
    </div>
</div>
