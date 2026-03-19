<style>
    :root {
        --login-primary: <?= $empresa ? '#0943b5' : '#007bff' ?>;
    }
    .login-logo a { color: var(--login-primary) !important; font-weight: 300; }
    .login-logo b { color: var(--login-primary) !important; font-weight: 700; }
    .card-primary.card-outline { border-top: 3px solid var(--login-primary); }
    .btn-primary { background-color: var(--login-primary); border-color: var(--login-primary); }
    .btn-primary:hover { background-color: #063184; opacity: 0.9; }
</style>

<div class="login-box mx-auto mt-5">
    <div class="login-logo mb-4">
        <?php if ($empresa): ?>
            <img src="https://cdn.www.gov.co/assets/images/logoGovCO.png" alt="Gov.co" style="height: 35px;" class="mb-2"><br>
            <a href="/">Portal <b><?= explode(' ', $empresa['nombre'])[0] ?></b></a>
        <?php else: ?>
            <a href="/">Pixel <b>CMS</b></a>
        <?php endif; ?>
    </div>

    <div class="card card-outline card-primary shadow-sm">
        <div class="card-body login-card-body rounded">
            <p class="login-box-msg font-weight-bold text-muted">
                <?= $empresa ? 'Gestión de Entidad Pública' : 'Administración Central SaaS' ?>
            </p>

            <?php if(isset($error)): ?>
                <div class="alert alert-danger alert-dismissible py-2 mb-3">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <small><i class="icon fas fa-ban mr-1"></i> <?= $error ?></small>
                </div>
            <?php endif; ?>

            <form action="/login" method="post">
                <div class="input-group mb-3">
                    <input type="text" name="username" class="form-control" placeholder="Nombre de usuario" required>
                    <div class="input-group-append">
                        <div class="input-group-text"><span class="fas fa-user"></span></div>
                    </div>
                </div>
                <div class="input-group mb-4">
                    <input type="password" name="password" class="form-control" placeholder="Contraseña" required>
                    <div class="input-group-append">
                        <div class="input-group-text"><span class="fas fa-lock"></span></div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary btn-block btn-flat font-weight-bold p-2">
                             ACCEDER AL PANEL <i class="fas fa-arrow-right ml-1"></i>
                        </button>
                    </div>
                </div>
            </form>

            <div class="social-auth-links text-center mb-3 mt-4 border-top pt-3">
                <small class="text-muted d-block mb-1">© <?= date('Y') ?> Pixel CMS Platform</small>
                <a href="https://pixelapp.com.co" target="_blank" class="text-xs text-secondary">
                    Desarrollado por Pixel App
                </a>
            </div>
        </div>
    </div>
</div>
