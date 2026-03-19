<section class="news-hero-wall mb-5 pt-4">
    <div class="container p-0">
        <div class="row no-gutters shadow-sm rounded overflow-hidden bg-white">
            <!-- Primera Noticia: LA GRANDE (Hero) -->
            <?php if (!empty($noticias[0])): $hero = $noticias[0]; ?>
                <div class="col-lg-8 border-right position-relative">
                    <img src="<?= $hero['imagen_portada'] ?? 'https://via.placeholder.com/800x450' ?>" class="img-fluid w-100 h-100 object-fit-cover" style="min-height: 450px;">
                    <div class="position-absolute bottom-0 left-0 w-100 p-4" style="background: linear-gradient(0deg, rgba(0,0,0,0.8) 0%, transparent 100%);">
                        <span class="badge badge-primary mb-2 text-uppercase font-weight-bold p-2"><?= $hero['categoria_nombre'] ?? 'Destacado' ?></span>
                        <h2 class="text-white font-weight-bold h1"><a href="/noticia/<?= $hero['slug'] ?>" class="text-white text-decoration-none"><?= $hero['titulo'] ?></a></h2>
                        <p class="text-white-50 lead d-none d-md-block"><?= substr($hero['resumen'], 0, 150) ?>...</p>
                    </div>
                </div>
            <?php endif; ?>

            <!-- Las Siguientes 4: Lista Lateral (Miniaturas) -->
            <div class="col-lg-4 bg-light p-0">
                <div class="p-3 border-bottom bg-white">
                    <h5 class="m-0 font-weight-bold text-dark"><i class="fas fa-list-ul mr-2 text-primary"></i> ÚLTIMAS NOTICIAS</h5>
                </div>
                <div class="news-list-small overflow-auto" style="max-height: 450px;">
                    <?php for($i = 1; $i < count($noticias); $i++): $noti = $noticias[$i]; ?>
                        <div class="noti-item p-3 border-bottom bg-white d-flex align-items-center hover-bg-light transition">
                            <div class="noti-thumb mr-3" style="width: 80px; height: 60px;">
                                <img src="<?= $noti['imagen_portada'] ?? 'https://via.placeholder.com/100x80' ?>" class="img-fluid w-100 h-100 object-fit-cover rounded border">
                            </div>
                            <div class="noti-content">
                                <small class="text-primary font-weight-bold text-uppercase" style="font-size: 0.65rem;"><?= $noti['categoria_nombre'] ?></small>
                                <h6 class="m-0 text-dark font-weight-bold" style="line-height: 1.2;">
                                    <a href="/noticia/<?= $noti['slug'] ?>" class="text-dark text-decoration-none small"><?= $noti['titulo'] ?></a>
                                </h6>
                                <small class="text-muted" style="font-size: 0.75rem;"><i class="fas fa-calendar-alt mr-1"></i> <?= date('d M', strtotime($noti['fecha_publicacion'])) ?></small>
                            </div>
                        </div>
                    <?php endfor; ?>
                </div>
            </div>
        </div>
    </div>
</section>
