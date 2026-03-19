<style>
    :root {
        --login-primary: <?= $empresa ? '#0943b5' : '#007bff' ?>;
    }
    .login-logo b { color: var(--login-primary); }
    .btn-primary { background-color: var(--login-primary); border-color: var(--login-primary); }
    .btn-primary:hover { background-color: #063184; }
</style>

<div class="login-box mx-auto pt-5">
    <div class="login-logo mb-4 text-center">
        <?php if ($empresa): ?>
            <img src="https://cdn.www.gov.co/assets/images/logoGovCO.png" style="height: 40px;" alt="Gov.co" class="mb-2"><br>
            <a href="/">Portal <b><?= explode(' ', $empresa['nombre'])[0] ?></b></a>
        <?php else: ?>
            <a href="/">Pixel <b>CMS</b></a>
        <?php endif; ?>
    </div>
    
    <div class="card card-outline card-primary shadow-lg border-top-0" style="border-top: 4px solid var(--login-primary) !important;">
        <div class="card-body login-card-body rounded">
            <p class="login-box-msg font-weight-bold">
                <?= $empresa ? 'Panel Administrativo de Entidad' : 'Gestión Centralizada Maestro' ?>
            </p>

            <?php if(isset($error)): ?>
                <div class="alert alert-danger py-2 text-sm text-center">
                    <i class="fas fa-exclamation-circle mr-1"></i> <?= $error ?>
                </div>
            <?php endif; ?>

            <form action="/login" method="post">
                <div class="input-group mb-3">
                    <input type="text" name="username" class="form-control" placeholder="Nombre de usuario" required>
                    <div class="input-group-append">
                        <div class="input-group-text"><span class="fas fa-user"></span></div>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <input type="password" name="password" class="form-control" placeholder="Contraseña" required>
                    <div class="input-group-append">
                        <div class="input-group-text"><span class="fas fa-lock"></span></div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary btn-block btn-lg shadow-sm">
                            <i class="fas fa-sign-in-alt mr-1"></i> Ingresar al Sistema
                        </button>
                    </div>
                </div>
            </form>

            <p class="mb-1 mt-4 text-center">
                <small class="text-muted">© <?= date('Y') ?> Pixel CMS SaaS Platform</small>
            </p>
        </div>
    </div>
</div>
