<div class="row pt-5">
    <div class="col-md-9 mx-auto">
        <div class="text-center mb-5">
            <h1 style="color: var(--gov-blue-dark); font-weight: 700; font-size: 32px; border-bottom: 2px solid #ddd; padding-bottom: 10px;">Bienvenidos al Portal Ciudadano</h1>
            <p class="lead text-muted">A través de este sitio oficial, usted puede gestionar trámites, conocer noticias y participar en las decisiones de la entidad.</p>
        </div>

        <!-- Módulos Activos (Traídos del Maestro) -->
        <h4 class="mb-4 text-secondary text-uppercase font-weight-bold" style="font-size: 15px;">Nuestros Servicios</h4>
        <div class="row">
            <?php 
                // Filtramos módulos según la licencia del maestro
                $idModuloS = $empresa['modulos'] ?? []; 
                if (in_array('noticias', $idModuloS)): 
            ?>
                <div class="col-md-4 mb-3">
                    <div class="card h-100 shadow-sm border-0 bg-light p-3 text-center">
                        <i class="fas fa-newspaper fa-3x text-info mb-2"></i>
                        <h6>Noticias Oficiales</h6>
                        <small class="text-muted">Infórmese sobre las últimas gestiones de la entidad.</small>
                    </div>
                </div>
            <?php endif; ?>

            <?php if (in_array('pqrs', $idModuloS) || in_array('pqrsd', $idModuloS)): ?>
                <div class="col-md-4 mb-3">
                    <div class="card h-100 shadow-sm border-0 bg-light p-3 text-center">
                        <i class="fas fa-comments fa-3x text-success mb-2"></i>
                        <h6>P.Q.R.S.D</h6>
                        <small class="text-muted">Peticiones, Quejas, Reclamos y Sugerencias.</small>
                    </div>
                </div>
            <?php endif; ?>

            <?php if (in_array('transparencia', $idModuloS)): ?>
                <div class="col-md-4 mb-3">
                    <div class="card h-100 shadow-sm border-0 bg-light p-3 text-center">
                        <i class="fas fa-eye fa-3x text-primary mb-2"></i>
                        <h6>Transparencia</h6>
                        <small class="text-muted">Acceso a la información pública oficial.</small>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>
