    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- GrapesJS Styles & Scripts -->
    <link rel="stylesheet" href="https://unpkg.com/grapesjs/dist/css/grapes.min.css">
    <script src="https://unpkg.com/grapesjs"></script>
    <script src="https://unpkg.com/grapesjs-preset-webpage"></script>

    <div class="col-md-12 mx-auto">
        <form action="/admin/noticias/crear" method="POST" enctype="multipart/form-data" id="news-form">
            <div class="card card-outline card-primary shadow-sm bg-white p-3">
                <div class="card-header bg-white border-bottom-0">
                    <h3 class="card-title text-primary"><i class="fas fa-magic mr-2"></i> Diseñador de Noticia Visual</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <!-- Columna de Contenido (GrapesJS) -->
                        <div class="col-md-9 border-right">
                            <div class="form-group mb-4">
                                <label for="titulo" class="h5">Título Impactante <span class="text-danger">*</span></label>
                                <input type="text" name="titulo" class="form-control form-control-lg p-3 shadow-none border" id="titulo" placeholder="ej: Gran Inauguración del Centro de Salud" required>
                            </div>

                            <div class="form-group mb-4">
                                <label for="resumen" class="font-weight-bold"><i class="fas fa-align-left mr-1"></i> Resumen / Lead (Breve y SEO)</label>
                                <textarea name="resumen" class="form-control p-3 shadow-none border" id="resumen" rows="2" placeholder="Un pequeño resumen que enganche al ciudadano..."></textarea>
                                <small class="text-muted">Este texto aparecerá en los listados y redes sociales.</small>
                            </div>
                            
                            <!-- El Constructor Visual Simplificado -->
                            <div class="form-group">
                                <label class="text-primary font-weight-bold mb-2"><i class="fas fa-magic"></i> Diseñador Visual (Arrastre bloques pre-armados)</label>
                                <div id="gjs" style="height: 500px; border: 1px solid #ddd; overflow: hidden; border-radius: 5px;">
                                    <!-- Contenido por defecto -->
                                    <div class="container" style="padding: 20px;">
                                        <h2>Inicie aquí el cuerpo de su noticia...</h2>
                                        <p>Puede arrastrar imágenes, crear columnas y tablas desde el panel derecho.</p>
                                    </div>
                                </div>
                                <input type="hidden" name="contenido" id="contenido_html">
                            </div>
                        </div>

                        <!-- Columna de Configuración y SEO -->
                        <div class="col-md-3">
                            <h5 class="text-muted border-bottom pb-2 mb-3"><i class="fas fa-cog mr-1"></i> Organización</h5>
                            
                            <div class="form-group mb-4">
                                <label for="categoria_id">Categoría <span class="text-danger">*</span></label>
                                <select name="categoria_id" class="form-control border-info" required>
                                    <option value="">-- Seleccionar Categoría --</option>
                                    <?php foreach($categorias as $cat): ?>
                                        <option value="<?= $cat['id'] ?>"><?= $cat['nombre'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <small class="text-muted">Ayuda a organizar su sitio.</small>
                            </div>

                            <div class="form-group mb-4">
                                <label for="tags_input">Etiquetas (Separadas por coma)</label>
                                <input type="text" name="tags" class="form-control border-primary" id="tags_input" placeholder="salud, prevencion, noticias">
                                
                                <div class="mt-2" id="popular-tags-cloud">
                                    <small class="text-muted d-block mb-1">Tags más usados (clic para añadir):</small>
                                    <?php foreach($popularTags as $ptag): ?>
                                        <span class="badge badge-light border p-1 px-2 mb-1" style="cursor: pointer;" onclick="addTag('<?= $ptag ?>')">
                                            <i class="fas fa-plus-circle text-xs mr-1"></i> <?= $ptag ?>
                                        </span>
                                    <?php endforeach; ?>
                                </div>
                            </div>

                            <h5 class="text-muted border-bottom pb-2 mb-3 mt-4"><i class="fas fa-search mr-1"></i> SEO Metatags</h5>
                            
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

<script>
    // Inicializar GrapesJS Simplificado (CM Mode)
    const editor = grapesjs.init({
        container: '#gjs',
        fromElement: true,
        height: '500px',
        storageManager: false,
        plugins: ['gjs-preset-webpage'],
        blockManager: {
            appendTo: '#blocks',
            blocks: [
                {
                    id: 'section-img-right',
                    label: '<b>Sección con Foto a la Derecha</b>',
                    content: `<div style="display: flex; align-items: center; padding: 20px;">
                                <div style="flex: 1; padding-right: 20px;"><h2>Título de la sección</h2><p>Texto descriptivo...</p></div>
                                <div style="flex: 1;"><img src="https://via.placeholder.com/400x300" style="max-width: 100%; border-radius: 8px;"></div>
                              </div>`,
                    category: 'Composición'
                },
                {
                    id: 'simple-image',
                    label: '<b>Imagen Grande con Pie</b>',
                    content: `<figure style="text-align: center;"><img src="https://via.placeholder.com/800x400" style="max-width: 100%;"><figcaption>Pie de foto aquí...</figcaption></figure>`,
                    category: 'Multimedia'
                },
                {
                    id: 'quote-block',
                    label: '<b>Cita Destacada</b>',
                    content: `<blockquote style="border-left: 5px solid #0943b5; padding: 15px; background: #f9f9f9; font-style: italic;">"Frase célebre de la noticia..."</blockquote>`,
                    category: 'Elementos'
                }
            ]
        },
        styleManager: {
            clearProperties: 1, // Limpiar propiedades complejas
            sectors: [{
                name: 'Básico',
                open: true,
                buildProps: ['font-size', 'color', 'background-color', 'text-align']
            }]
        }
    });

    // Antes de enviar el formulario, capturamos el HTML
    document.getElementById('news-form').onsubmit = function() {
        const html = editor.getHtml();
        const css = editor.getCss();
        document.getElementById('contenido_html').value = `<style>${css}</style>${html}`;
    };

    function addTag(tag) {
        const input = document.getElementById('tags_input');
        if (input.value === '') {
            input.value = tag;
        } else {
            const tags = input.value.split(',').map(t => t.trim());
            if (!tags.includes(tag)) {
                tags.push(tag);
                input.value = tags.join(', ');
            }
        }
    }
</script>
