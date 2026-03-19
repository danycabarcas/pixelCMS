<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editor de Página - <?= $page['title'] ?></title>
    <link href="https://unpkg.com/grapesjs/dist/css/grapes.min.css" rel="stylesheet">
    <script src="https://unpkg.com/grapesjs"></script>
    <style>
        body, html { margin: 0; height: 100%; overflow: hidden; }
        #gjs { height: 100vh !important; }
        .gjs-logo-version { display: none !important; }
        .save-btn {
            position: fixed;
            top: 10px;
            right: 10px;
            z-index: 1000;
            background: #38bdf8;
            color: white;
            padding: 10px 20px;
            border-radius: 5px;
            border: none;
            cursor: pointer;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <button class="save-btn" onclick="saveContent()">Guardar Cambios</button>
    <div id="gjs">
        <?= $page['content_html'] ?>
    </div>
    <style><?= $page['content_css'] ?></style>

    <script>
        const editor = grapesjs.init({
            container: '#gjs',
            fromElement: true,
            storageManager: false,
            blockManager: {
                appendTo: '#blocks',
                blocks: [
                    { id: 'section', label: '<b>Sección</b>', attributes: { class: 'gjs-block-section' }, content: '<section style="padding: 50px 0;"><h1>Nueva Sección</h1></p>Contenido aquí...</p></section>' },
                    { id: 'text', label: 'Texto', content: '<div data-gjs-type="text">Inserta tu texto aquí...</div>' },
                    { id: 'image', label: 'Imagen', select: true, content: { type: 'image' }, activate: true },
                ]
            }
        });

        function saveContent() {
            const html = editor.getHtml();
            const css = editor.getCss();
            
            fetch('/admin/pages/save/<?= $page['id'] ?>', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ html, css })
            })
            .then(res => res.json())
            .then(data => {
                if(data.success) alert('Página guardada exitosamente');
            });
        }
    </script>
</body>
</html>
