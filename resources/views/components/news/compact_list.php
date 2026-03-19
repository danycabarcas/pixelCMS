<section class="news-compact-list mb-5 pt-3">
    <div class="container p-0">
        <div class="card card-outline card-primary shadow-sm bg-white border-0">
            <div class="card-header bg-white border-bottom-0 d-flex align-items-center">
                <h4 class="card-title text-primary font-weight-bold m-0 h5"><i class="fas fa-bullhorn mr-2"></i> ÚLTIMAS CONVOCATORIAS / TRÁMITES</h4>
            </div>
            <div class="card-body p-0">
                <div class="list-group list-group-flush border-top">
                    <?php if (empty($noticias)): ?>
                        <div class="p-5 text-center text-muted">Aún no hay convocatorias vigentes.</div>
                    <?php else: ?>
                        <?php foreach($noticias as $noti): ?>
                            <a href="/noticia/<?= $noti['slug'] ?>" class="list-group-item list-group-item-action d-flex align-items-center py-3 border-bottom hover-bg-light transition">
                                <div class="news-icon mr-3 bg-light p-2 rounded-circle" style="width: 40px; height: 40px; display: flex; align-items: center; justify-content: center;">
                                    <i class="far fa-file-alt text-primary"></i>
                                </div>
                                <div class="news-text d-flex flex-column">
                                    <span class="text-dark font-weight-bold h6 m-0"><?= $noti['titulo'] ?></span>
                                    <small class="text-muted" style="font-size: 0.75rem;"><i class="far fa-clock mr-1"></i> Publicado: <?= date('d/m/Y', strtotime($noti['fecha_publicacion'])) ?></small>
                                </div>
                                <div class="ml-auto text-muted"> <i class="fas fa-chevron-right small"></i> </div>
                            </a>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </div>
            <div class="card-footer bg-light p-2 text-center text-xs font-weight-bold text-muted border-top">
                VER TODAS LAS CONVOCATORIAS <i class="fas fa-angle-double-right ml-1"></i>
            </div>
        </div>
    </div>
</section>
