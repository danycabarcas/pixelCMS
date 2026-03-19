<div class="row">
    <div class="col-md-12 mx-auto">
        <form action="/admin/noticias/crear" method="POST" enctype="multipart/form-data">
            <div class="card card-outline card-primary shadow-sm bg-white p-3">
                <div class="card-header bg-white border-bottom-0">
                    <h3 class="card-title text-primary"><i class="fas fa-edit mr-2"></i> Redactar Nueva Noticia para el Portal</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <!-- Columna de Contenido -->
                        <div class="col-md-8 border-right">
                            <div class="form-group mb-4">
                                <label for="titulo" class="h5">Título de la Noticia <span class="text-danger">*</span></label>
                                <input type="text" name="titulo" class="form-control form-control-lg p-3 shadow-none border" id="titulo" placeholder="ej: Gran Jornada de Vacunación en Algarrobo" required>
                                <small class="text-muted"><i class="fas fa-info-circle mr-1"></i> El título debe ser impactante y contener la palabra clave principal.</small>
                            </div>
                            
                            <div class="form-group mb-4">
                                <label for="resumen">Resumen Corto (Lead)</label>
                                <textarea name="resumen" class="form-control p-3 shadow-none border" id="resumen" rows="3" placeholder="Breve introducción de la noticia..."></textarea>
                                <small class="text-muted">Este texto se usará para el listado público y redes sociales.</small>
                            </div>

                            <div class="form-group">
                                <label for="contenido">Cuerpo de la Noticia (Cuerpo Pro)</label>
                                <textarea name="contenido" id="editor_pro" class="form-control" rows="15" placeholder="Escriba aquí el contenido completo..."></textarea>
                            </div>
                        </div>

                        <!-- Columna de Configuración y SEO -->
                        <div class="col-md-4 px-3">
                            <h5 class="text-muted border-bottom pb-2 mb-3"><i class="fas fa-search mr-1"></i> Configuración SEO y Metatags</h5>
                            
                            <div class="form-group">
                                <label for="slug">Slug (URL Amigable)</label>
                                <input type="text" name="slug" class="form-control border-warning shadow-none" id="slug" placeholder="noticia-url-seo">
                                <small class="text-warning"><i class="fas fa-exclamation-triangle"></i> Deje en blanco para auto-generar del título.</small>
                            </div>

                            <div class="form-group mt-4">
                                <label for="meta_title" class="text-success"><i class="fas fa-check-circle"></i> Meta Title para Google</label>
                                <input type="text" name="meta_title" class="form-control border-success shadow-none" id="meta_title" placeholder="Título SEO optimizado">
                                <small class="text-muted">Recomendado: Máximo 60 caracteres.</small>
                            </div>

                            <div class="form-group">
                                <label for="meta_description" class="text-success"><i class="fas fa-check-circle"></i> Meta Description</label>
                                <textarea name="meta_description" class="form-control border-success shadow-none font-weight-light" id="meta_description" rows="4" placeholder="Descripción resumida para buscadores..."></textarea>
                                <small class="text-muted">Máx: 160 caracteres. Resuma el valor de su noticia.</small>
                            </div>

                            <div class="form-group mt-4">
                                <label>Imagen Principal (Portada)</label>
                                <div class="custom-file shadow-none">
                                    <input type="file" name="imagen_portada" class="custom-file-input" id="imagen_portada">
                                    <label class="custom-file-label" for="imagen_portada">Elegir archivo...</label>
                                </div>
                                <small class="text-muted">Use una imagen horizontal (ej: 1200x630px).</small>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer bg-light text-right p-4 border-top-0 rounded">
                    <a href="/admin/noticias" class="btn btn-default btn-lg mr-2"><i class="fas fa-times mr-1"></i> Cancelar y Volver</a>
                    <button type="submit" class="btn btn-primary btn-lg px-5 shadow-sm"><i class="fas fa-save mr-1"></i> Publicar Noticia Oficial</button>
                </div>
            </div>
        </form>
    </div>
</div>
