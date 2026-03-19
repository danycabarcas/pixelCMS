<?php $this->title = 'Gestión de Categorías'; ?>

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark"><i class="fas fa-tags mr-2 text-warning"></i>Categorías de Noticias</h1>
            </div>
            <div class="col-sm-6 text-right">
                <button type="button" class="btn btn-warning shadow-sm" data-toggle="modal" data-target="#modal-nueva-cat">
                    <i class="fas fa-plus mr-1"></i> Nueva Categoría
                </button>
            </div>
        </div>
    </div>
</div>

<section class="content">
    <div class="container-fluid">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-white">
                <h3 class="card-title text-muted small uppercase font-weight-bold">Listado de Categorías (Tenant: <?= $_SESSION['empresa_nombre'] ?? 'Empresa' ?>)</h3>
            </div>
            <div class="card-body p-0">
                <table class="table table-hover mb-0">
                    <thead class="bg-light border-top-0">
                        <tr>
                            <th style="width: 10px">ID</th>
                            <th>Nombre</th>
                            <th>Segmento URL (Slug)</th>
                            <th class="text-center">Noticias Relacionadas</th>
                            <th class="text-right">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(empty($categorias)): ?>
                            <tr><td colspan="5" class="p-5 text-center text-muted">Aún no has creado categorías para tus noticias.</td></tr>
                        <?php endif; ?>
                        <?php foreach($categorias as $cat): ?>
                            <tr>
                                <td><?= $cat['id'] ?></td>
                                <td class="font-weight-bold"><?= $cat['nombre'] ?></td>
                                <td><code>/categoria/<?= $cat['slug'] ?></code></td>
                                <td class="text-center">
                                    <span class="badge badge-info shadow-none"><?= $cat['total_noticias'] ?> noticias</span>
                                </td>
                                <td class="text-right">
                                    <form action="/admin/categorias/eliminar" method="POST" onsubmit="return confirm('¿Seguro? Si tiene noticias vinculadas podría causar errores de visualización.')" class="d-inline">
                                        <input type="hidden" name="id" value="<?= $cat['id'] ?>">
                                        <button type="submit" class="btn btn-outline-danger btn-xs" <?= $cat['total_noticias'] > 0 ? 'disabled title="No se puede eliminar con noticias"' : '' ?>>
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>

<!-- MODAL NUEVA CATEGORIA -->
<div class="modal fade" id="modal-nueva-cat" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content border-0 shadow-lg">
            <div class="modal-header bg-warning">
                <h5 class="modal-title font-weight-bold"><i class="fas fa-tag mr-1"></i> Crear Nueva Categoría</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <form action="/admin/categorias/guardar" method="POST">
                <div class="modal-body py-4">
                    <div class="form-group">
                        <label>Nombre de Categoría</label>
                        <input type="text" name="nombre" class="form-control form-control-lg shadow-none" placeholder="ej: Convocatorias, Comunicados..." required autofocus>
                        <small class="text-muted">Esto definirá cómo se organiza el menú público.</small>
                    </div>
                </div>
                <div class="modal-footer bg-light">
                    <button type="button" class="btn btn-link text-muted" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-warning px-4 shadow-sm font-weight-bold">Guardar Categoría</button>
                </div>
            </form>
        </div>
    </div>
</div>
