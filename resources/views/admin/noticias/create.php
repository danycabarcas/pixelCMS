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
                            <div class="border rounded bg-white shadow-sm overflow-hidden" style="min-height: 1200px;">
                                <div id="gjs" style="background: #fff;"></div>
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
                                                <label class="d-flex justify-content-between align-items-center">
                                                    Categoría <span class="text-danger">*</span>
                                                    <button type="button" class="btn btn-xs btn-link p-0 text-success" data-toggle="modal" data-target="#modal-categoria">
                                                        <i class="fas fa-plus-circle mr-1"></i> Nueva
                                                    </button>
                                                </label>
                                                <select name="categoria_id" class="form-control border-info" id="select_categoria" required>
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

    <!-- MODAL CATEGORIA EXPRESS -->
    <div class="modal fade" id="modal-categoria" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-success text-white">
                    <h5 class="modal-title"><i class="fas fa-plus-circle mr-1"></i> Nueva Categoría de Noticia</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Nombre de la Categoría</label>
                        <input type="text" id="nueva_cat_nombre" class="form-control" placeholder="ej: Convocatorias">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-success" onclick="guardarCategoriaExpress()">Guardar Categoría</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    async function guardarCategoriaExpress() {
        const nombre = document.getElementById('nueva_cat_nombre').value;
        if (!nombre) return alert('Escribe un nombre');

        try {
            const response = await fetch('/admin/noticias/categoria/crear', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ nombre })
            });
            const res = await response.json();
            
            if (res.success) {
                const select = document.getElementById('select_categoria');
                const option = new Option(nombre, res.id, true, true);
                select.add(option);
                $('#modal-categoria').modal('hide');
                document.getElementById('nueva_cat_nombre').value = '';
            } else {
                alert('Error al crear categoría: ' + res.error);
            }
        } catch (e) { console.error(e); }
    }

    // BLOQUE MAESTRO: PLANTILLA INICIAL (Lo que el usuario ve al abrir)
    const editor = grapesjs.init({
        container: '#gjs',
        fromElement: true,
        height: '1200px', // Aumento drástico de altura para mayor comodidad
        storageManager: false,
        i18n: { locale: 'es' },
        canvas: {
            styles: [
                'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css',
                'https://fonts.googleapis.com/css2?family=Source+Sans+Pro:wght@300;400;600&display=swap'
            ]
        },
        styleManager: {
            sectors: [
                { name: 'General', buildProps: ['float', 'display', 'position', 'top', 'right', 'left', 'bottom'] },
                { name: 'Dimensión', open: false, buildProps: ['width', 'height', 'max-width', 'min-height', 'margin', 'padding'] },
                { name: 'Tipografía', open: true, buildProps: ['font-family', 'font-size', 'font-weight', 'letter-spacing', 'color', 'line-height', 'text-align', 'text-shadow'] },
                { name: 'Decoración', open: false, buildProps: ['background-color', 'border-radius', 'border', 'box-shadow', 'background'] },
                { name: 'Extra', open: false, buildProps: ['opacity', 'transition', 'perspective', 'transform'] }
            ]
        }
    });

    // CARGAR PLANTILLA INICIAL
    editor.on('load', () => {
        editor.setComponents(`
            <div style="padding: 20px; font-family: 'Source Sans Pro', sans-serif;">
                <h1 style="color: #0943b5; font-weight: 600;">Título Impactante del Hospital Algarrobo</h1>
                <p style="font-size: 1.2rem; color: #555; margin-bottom: 30px;">Aquí puede escribir un pequeño párrafo de introducción que resuma la importancia de esta noticia...</p>
                
                <div style="display: flex; flex-wrap: wrap; gap: 20px; align-items: start;">
                    <div style="flex: 1; min-width: 300px;">
                        <img src="https://via.placeholder.com/600x400" style="width: 100%; border-radius: 8px; box-shadow: 0 4px 6px rgba(0,0,0,0.1);">
                    </div>
                    <div style="flex: 1; min-width: 300px;">
                        <h2 style="color: #333;">Detalles de la gestión</h2>
                        <p>Escriba aquí el cuerpo detallado de su noticia. Puede borrar estos bloques o agregar más desde el panel de la derecha.</p>
                        <ul style="padding-left: 20px; color: #444;">
                            <li>Logro 1: Atención humanizada</li>
                            <li>Logro 2: Equipos de alta tecnología</li>
                        </ul>
                    </div>
                </div>
            </div>
        `);
    });

    const bm = editor.BlockManager;

    // ARSENAL DE BLOQUES PRO (NOTICIAS SENIOR)
    bm.add('seccion-noticia', {
        label: '<div class="gjs-block-label"><i class="fas fa-columns"></i><br>Sección Foto</div>',
        content: `<div style="display: flex; flex-wrap: wrap; padding: 20px;">
                    <div style="flex: 1; min-width: 300px;"><h2>Título Seccion</h2><p>Texto aquí...</p></div>
                    <div style="flex: 1; min-width: 300px;"><img src="https://via.placeholder.com/500x300" style="width: 100%;"></div>
                  </div>`,
        category: 'Diseños Pre-armados'
    });

    // ELEMENTOS DE TEXTO PRO
    bm.add('h1-title', { label: '<i class="fas fa-heading"></i><br>Título H1', content: '<h1 style="color:#0943b5">Título Principal</h1>', category: 'Textos Magazine' });
    bm.add('h2-title', { label: '<i class="fas fa-heading"></i><br>Título H2', content: '<h2 style="color:#333">Subtítulo de Sección</h2>', category: 'Textos Magazine' });
    bm.add('quote-box', { label: '<i class="fas fa-quote-right"></i><br>Cita Pro', content: '<blockquote style="border-left:5px solid #0943b5; padding:15px; background:#f4f6f9; font-style:italic">"Frase destacada de la noticia..."</blockquote>', category: 'Textos Magazine' });
    bm.add('highlight-txt', { label: '<i class="fas fa-highlighter"></i><br>Destacado', content: '<div style="background:#fff3cd; padding:15px; border-radius:5px">Párrafo resaltado con información importante.</div>', category: 'Textos Magazine' });

    // ELEMENTOS DE DATOS Y LISTAS
    bm.add('ul-bullets', { label: '<i class="fas fa-list-ul"></i><br>Viñetas', content: '<ul><li>Elemento 1</li><li>Elemento 2</li><li>Elemento 3</li></ul>', category: 'Organización' });
    bm.add('pro-table', { label: '<i class="fas fa-table"></i><br>Tabla Pro', content: '<table style="width:100%; border-collapse:collapse; margin:20px 0;"><thead style="background:#0943b5; color:#fff;"><tr><th style="padding:10px; border:1px solid #ddd;">Concepto</th><th style="padding:10px; border:1px solid #ddd;">Valor</th></tr></thead><tbody><tr><td style="padding:10px; border:1px solid #ddd;">Dato A</td><td style="padding:10px; border:1px solid #ddd;">Ejemplo</td></tr></tbody></table>', category: 'Organización' });

    // MULTIMEDIA Y OTROS
    bm.add('img-full', { label: '<i class="fas fa-image"></i><br>Imagen', content: '<img src="https://via.placeholder.com/800x400" style="width: 100%;">', category: 'Básicos' });
    bm.add('video-yt', { label: '<i class="fab fa-youtube"></i><br>Video YT', content: '<div style="padding:10px"><iframe width="100%" height="450" src="https://www.youtube.com/embed/VIDEO_ID" frameborder="0" allowfullscreen></iframe></div>', category: 'Multimedia' });
    bm.add('custom-html', { label: '<i class="fas fa-code"></i><br>Inc. HTML', content: '<div style="padding:20px; border:2px dashed #ccc; text-align:center;">--- Pegar su código HTML aquí (Widget, Widget, etc) ---</div>', category: 'Avanzado' });

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
