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
                        <!-- FILA 1: Título y Resumen -->
                        <div class="col-md-12">
                            <div class="form-group mb-3">
                                <label for="titulo" class="h6 font-weight-bold">Título de la Noticia <span class="text-danger">*</span></label>
                                <input type="text" name="titulo" class="form-control form-control-lg border-primary shadow-none" id="titulo" placeholder="ej: Gran Inauguración del Centro de Salud" required>
                            </div>
                            <div class="form-group mb-4">
                                <label for="resumen" class="h6 font-weight-bold">Resumen / Entradilla (Lead)</label>
                                <textarea name="resumen" class="form-control shadow-none" id="resumen" rows="2" placeholder="Un pequeño resumen que enganche al ciudadano..."></textarea>
                            </div>
                        </div>

                        <!-- FILA 2: EL CONSTRUCTOR FULL WIDTH -->
                        <div class="col-md-12 mb-5">
                            <label class="text-primary font-weight-bold mb-2"><i class="fas fa-magic"></i> DISEÑADOR VISUAL PRO</label>
                            <div class="row no-gutters border rounded bg-white shadow-sm overflow-hidden">
                                <div class="col-md-9 border-right">
                                    <div id="gjs" style="height: 600px; background: #fff;"></div>
                                </div>
                                <div class="col-md-3 bg-light" style="height: 600px; overflow-y: auto;">
                                    <div class="p-2 border-bottom text-center bg-dark text-white text-xs font-weight-bold">
                                        BLOQUES DISPONIBLES
                                    </div>
                                    <div id="blocks"></div>
                                </div>
                            </div>
                            <input type="hidden" name="contenido" id="contenido_html">
                        </div>

                        <!-- FILA 3: CONFIGURACIÓN SEO (Debajo del lienzo) -->
                        <div class="col-md-12">
                            <div class="card card-outline card-secondary shadow-sm">
                                <div class="card-header">
                                    <h3 class="card-title text-muted"><i class="fas fa-search mr-1"></i> Optimización SEO y Redes Sociales</h3>
                                </div>
                                <div class="card-body bg-light">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Categoría <span class="text-danger">*</span></label>
                                                <select name="categoria_id" class="form-control border-info" required>
                                                    <option value="">-- Seleccionar --</option>
                                                    <?php foreach($categorias as $cat): ?>
                                                        <option value="<?= $cat['id'] ?>"><?= $cat['nombre'] ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label>Etiquetas</label>
                                                <input type="text" name="tags" class="form-control border-info" id="tags_input" placeholder="salud, prevencion">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Slug (URL SEO)</label>
                                                <input type="text" name="slug" class="form-control border-warning" placeholder="auto-generado si queda vacío">
                                            </div>
                                            <div class="form-group">
                                                <label>Meta Title</label>
                                                <input type="text" name="meta_title" class="form-control border-success">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Meta Description</label>
                                                <textarea name="meta_description" class="form-control border-success" rows="4"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
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
    // Inicializar GrapesJS Senior (CM Mode 2.0)
    const editor = grapesjs.init({
        container: '#gjs',
        fromElement: true,
        height: '600px',
        storageManager: false,
        blockManager: {
            appendTo: '#blocks'
        },
        i18n: {
            locale: 'es',
            messages: {
                es: {
                    blockManager: { labels: { 'text': 'Texto', 'image': 'Imagen', 'column1': '1 Columna', 'column2': '2 Columnas' } },
                    styleManager: { sectors: { 'general': 'General', 'dimension': 'Dimensión', 'typography': 'Tipografía' } }
                }
            }
        },
        styleManager: {
            sectors: [{
                name: 'Estilos de Texto',
                open: true,
                buildProps: ['font-size', 'color', 'text-align', 'font-family']
            }]
        }
    });

    const bm = editor.BlockManager;

    // BLOQUES PRE-ARMADOS (Proyectos Senior)
    bm.add('seccion-noticia', {
        label: '<div class="gjs-block-label">Sección con Foto</div>',
        content: `<div style="display: flex; flex-wrap: wrap; padding: 20px;">
                    <div style="flex: 1; min-width: 300px;"><h2>Título Seccion</h2><p>Texto aquí...</p></div>
                    <div style="flex: 1; min-width: 300px;"><img src="https://via.placeholder.com/500x300" style="width: 100%;"></div>
                  </div>`,
        category: 'Maquetación'
    });

    bm.add('txt-basico', { label: 'Texto Simple', content: '<p>Escriba su contenido aquí...</p>', category: 'Básicos' });
    bm.add('img-full', { label: 'Imagen Full', content: '<img src="https://via.placeholder.com/800x400" style="width: 100%;">', category: 'Básicos' });
    bm.add('2-cols', { label: '2 Columnas', content: '<div style="display:flex"><div style="flex:1;padding:10px">Col 1</div><div style="flex:1;padding:10px">Col 2</div></div>', category: 'Maquetación' });

    document.getElementById('news-form').onsubmit = function() {
        document.getElementById('contenido_html').value = `<style>${editor.getCss()}</style>${editor.getHtml()}`;
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
