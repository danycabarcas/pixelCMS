<div class="row">
    <div class="col-md-10 mx-auto">
        <div class="card card-outline card-info shadow-sm">
            <div class="card-header">
                <h3 class="card-title text-info"><i class="fas fa-key mr-2"></i> Generar Licencia Empresarial</h3>
            </div>
            <form action="/master/licencias/crear" method="POST">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h5 class="text-muted border-bottom pb-2 mb-3"><i class="fas fa-building mr-1"></i> Asignación</h5>
                            <div class="form-group">
                                <label for="empresa_id">Seleccionar Empresa</label>
                                <select name="empresa_id" id="empresa_id" class="form-control" required>
                                    <option value="">-- Seleccione una Empresa --</option>
                                    <?php foreach ($empresas as $emp): ?>
                                        <option value="<?= $emp['id'] ?>" <?= (isset($_GET['empresa_id']) && $_GET['empresa_id'] == $emp['id']) ? 'selected' : '' ?>>
                                            <?= htmlspecialchars($emp['nombre']) ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="fecha_vencimiento">Fecha de Vencimiento de Licencia</label>
                                <input type="date" name="fecha_vencimiento" class="form-control" id="fecha_vencimiento" required>
                            </div>
                            <div class="form-group">
                                <label for="periodo_gracia">Periodo de Gracia (Días)</label>
                                <input type="number" name="periodo_gracia" class="form-control" id="periodo_gracia" value="7" min="0">
                                <small class="text-muted">Días adicionales antes de bloquear el sistema tras vencimiento.</small>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <h5 class="text-muted border-bottom pb-2 mb-3"><i class="fas fa-cubes mr-1"></i> Módulos Habilitados</h5>
                            
                            <div class="form-group">
                                <label>Selecciona las funciones que incluirá esta licencia:</label>
                                <div class="row mt-2">
                                    <?php if (empty($modulos)): ?>
                                        <div class="col-12 text-warning"><i class="fas fa-exclamation-triangle"></i> No hay módulos registrados en el sistema.</div>
                                    <?php else: ?>
                                        <?php foreach ($modulos as $mod): ?>
                                            <div class="col-md-6 mb-2">
                                                <div class="custom-control custom-checkbox">
                                                    <input class="custom-control-input" type="checkbox" name="modulos[]" value="<?= htmlspecialchars($mod['slug']) ?>" id="mod_<?= $mod['id'] ?>">
                                                    <label for="mod_<?= $mod['id'] ?>" class="custom-control-label fw-normal">
                                                        <i class="fas <?= htmlspecialchars($mod['icono']) ?> text-muted mr-1"></i> <?= htmlspecialchars($mod['nombre']) ?>
                                                    </label>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
                <div class="card-footer bg-white text-right">
                    <a href="/master" class="btn btn-default mr-2">Cancelar</a>
                    <button type="submit" class="btn btn-info px-5"><i class="fas fa-cogs mr-1"></i> Generar Licencia SaaS</button>
                </div>
            </form>
        </div>
    </div>
</div>
