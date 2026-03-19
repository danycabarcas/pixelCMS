<div class="row">
    <div class="col-md-10 mx-auto">
        <div class="card card-outline card-primary shadow-sm">
            <div class="card-header">
                <h3 class="card-title text-primary"><i class="fas fa-building mr-2"></i> Editar Empresa Maestro</h3>
            </div>
            <form action="/master/empresas/editar/<?= $empresa['id'] ?>" method="POST">
                <div class="card-body">
                    <div class="row">
                        <!-- Sección 1: Datos de Identidad -->
                        <div class="col-md-6">
                            <h5 class="text-muted border-bottom pb-2 mb-3"><i class="fas fa-id-card mr-1"></i> Identidad Corporativa</h5>
                            <div class="form-group">
                                <label for="nombre">Nombre de la Empresa / Cargo Orga</label>
                                <input type="text" name="nombre" class="form-control" id="nombre" value="<?= htmlspecialchars($empresa['nombre']) ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="nit">NIT (con dígito de verificación)</label>
                                <input type="text" name="nit" class="form-control" id="nit" value="<?= htmlspecialchars($empresa['nit']) ?>" required>
                            </div>
                            <div class="form-group border-top pt-3">
                                <label for="dominio_autorizado" class="text-primary fw-bold text-uppercase"><i class="fas fa-globe mr-1"></i> Dominio Autorizado</label>
                                <input type="text" name="dominio_autorizado" class="form-control" id="dominio_autorizado" value="<?= htmlspecialchars($empresa['dominio_autorizado'] ?? '') ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="direccion">Dirección Física</label>
                                <input type="text" name="direccion" class="form-control" id="direccion" value="<?= htmlspecialchars($empresa['direccion'] ?? '') ?>">
                            </div>
                        </div>

                        <!-- Sección 2: Contacto Principal -->
                        <div class="col-md-6">
                            <h5 class="text-muted border-bottom pb-2 mb-3"><i class="fas fa-user-tie mr-1"></i> Contacto de Gerencia</h5>
                            <div class="form-group">
                                <label for="responsable">Nombre del Responsable</label>
                                <input type="text" name="responsable" class="form-control" id="responsable" value="<?= htmlspecialchars($empresa['responsable'] ?? '') ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="whatsapp">Teléfono Principal / WhatsApp</label>
                                <div class="input-group">
                                    <div class="input-group-prepend"><span class="input-group-text"><i class="fab fa-whatsapp"></i></span></div>
                                    <input type="text" name="whatsapp" class="form-control" id="whatsapp" value="<?= htmlspecialchars($empresa['whatsapp'] ?? '') ?>" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="email_contacto">Correo Administrativo</label>
                                <input type="email" name="email_contacto" class="form-control" id="email_contacto" value="<?= htmlspecialchars($empresa['email_contacto'] ?? '') ?>" required>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-4">
                        <!-- Sección 3: Contactos Especializados -->
                        <div class="col-md-6">
                            <h5 class="text-muted border-bottom pb-2 mb-3"><i class="fas fa-file-invoice-dollar mr-1"></i> Contacto Facturación</h5>
                            <div class="form-group">
                                <input type="text" name="contacto_facturacion" class="form-control" id="contacto_facturacion" value="<?= htmlspecialchars($empresa['contacto_facturacion'] ?? '') ?>">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <h5 class="text-muted border-bottom pb-2 mb-3"><i class="fas fa-cogs mr-1"></i> Contacto Técnico</h5>
                            <div class="form-group">
                                <input type="text" name="contacto_tecnico" class="form-control" id="contacto_tecnico" value="<?= htmlspecialchars($empresa['contacto_tecnico'] ?? '') ?>">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-footer bg-white text-right">
                    <a href="/master" class="btn btn-default mr-2">Cancelar</a>
                    <button type="submit" class="btn btn-primary px-5"><i class="fas fa-save mr-1"></i> Actualizar Empresa</button>
                </div>
            </form>
        </div>
    </div>
</div>
