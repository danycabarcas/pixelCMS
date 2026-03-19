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

                        <!-- EL CONSTRUCTOR VISUAL MAESTRO (FULL WIDTH NATIVO) -->
                        <div class="col-md-12 mb-5">
                            <label class="text-primary font-weight-bold mb-2"><i class="fas fa-magic"></i> DISEÑADOR VISUAL PROFESIONAL (Todo integrado)</label>
                            <div class="border rounded bg-white shadow-sm overflow-hidden">
                                <div id="gjs" style="height: 600px; background: #fff;"></div>
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
    // Inicializar GrapesJS Master Pro (Todo integrado)
    const editor = grapesjs.init({
        container: '#gjs',
        fromElement: true,
        height: '600px',
        storageManager: false,
        i18n: { locale: 'es' },
        styleManager: {
            sectors: [
                { name: 'General', buildProps: ['float', 'display', 'position', 'top', 'right', 'left', 'bottom'] },
                { name: 'Dimensión', open: false, buildProps: ['width', 'height', 'max-width', 'min-height', 'margin', 'padding'] },
                { name: 'Tipografía', open: false, buildProps: ['font-family', 'font-size', 'font-weight', 'letter-spacing', 'color', 'line-height', 'text-align', 'text-shadow'] },
                { name: 'Decoración', open: false, buildProps: ['background-color', 'border-radius', 'border', 'box-shadow', 'background'] },
                { name: 'Extra', open: false, buildProps: ['opacity', 'transition', 'perspective', 'transform'] }
            ]
        }
    });

    const bm = editor.BlockManager;

    // BLOQUES PRE-ARMADOS INTEGRADOS
    bm.add('seccion-noticia', {
        label: '<div class="gjs-block-label"><i class="fas fa-columns"></i><br>Sección Foto</div>',
        content: `<div style="display: flex; flex-wrap: wrap; padding: 20px;">
                    <div style="flex: 1; min-width: 300px;"><h2>Título Seccion</h2><p>Texto aquí...</p></div>
                    <div style="flex: 1; min-width: 300px;"><img src="https://via.placeholder.com/500x300" style="width: 100%;"></div>
                  </div>`,
        category: 'Diseños Pre-armados'
    });

    bm.add('txt-basico', { label: '<i class="fas fa-align-justify"></i><br>Texto', content: '<p>Escriba su contenido aquí...</p>', category: 'Básicos' });
    bm.add('img-full', { label: '<i class="fas fa-image"></i><br>Imagen', content: '<img src="https://via.placeholder.com/800x400" style="width: 100%;">', category: 'Básicos' });
    bm.add('2-cols', { label: '<i class="fas fa-th-large"></i><br>2 Columnas', content: '<div style="display:flex"><div style="flex:1;padding:10px">Col 1</div><div style="flex:1;padding:10px">Col 2</div></div>', category: 'Maquetación' });
    bm.add('video-yt', { label: '<i class="fab fa-youtube"></i><br>Video', content: '<div style="padding:10px"><iframe width="560" height="315" src="https://www.youtube.com/embed/VIDEO_ID" frameborder="0" allowfullscreen></iframe></div>', category: 'Multimedia' });

    // Forzar la pestaña de bloques al inicio
    editor.on('load', () => {
        const panels = editor.Panels;
        const blocksPanel = panels.getButton('views', 'open-blocks');
        if (blocksPanel) blocksPanel.set('active', 1);
    });

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
