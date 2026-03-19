<div class="row">
    <div class="col-md-6 mx-auto">
        <div class="card card-outline card-primary shadow-sm">
            <div class="card-header">
                <h3 class="card-title text-primary"><i class="fas fa-user-circle mr-2"></i> Mi Perfil Administrativo</h3>
            </div>
            <div class="card-body">
                <div class="text-center mb-4">
                    <img src="https://ui-avatars.com/api/?name=<?= urlencode($user['nombre'] ?? 'Admin') ?>&background=0943b5&color=fff" class="img-circle elevation-2" alt="Admin Avatar" style="width: 100px;">
                    <h4 class="mt-3"><?= htmlspecialchars($user['nombre'] ?? 'Administrador') ?></h4>
                    <span class="badge badge-primary font-weight-normal"><?= strtoupper(str_replace('_', ' ', $user['role'])) ?></span>
                </div>
                
                <ul class="list-group list-group-unbordered mb-3">
                    <li class="list-group-item">
                        <b>Nombre de Usuario</b> <a class="float-right text-muted"><?= htmlspecialchars($user['username']) ?></a>
                    </li>
                    <li class="list-group-item">
                        <b>Miembro desde</b> <a class="float-right text-muted"><?= date('d M, Y', strtotime($user['created_at'])) ?></a>
                    </li>
                </ul>

                <div class="alert alert-info py-2 mt-4 text-xs">
                    <i class="fas fa-info-circle mr-1"></i> La gestión de su contraseña se habilitará próximamente.
                </div>
            </div>
            <div class="card-footer text-center bg-white">
                <a href="/admin/dashboard" class="btn btn-default"><i class="fas fa-arrow-left"></i> Volver al Dashboard</a>
            </div>
        </div>
    </div>
</div>
