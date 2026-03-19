<div class="row">
    <div class="col-lg-3 col-6">
        <div class="small-box bg-info">
            <div class="inner">
                <h3>0</h3>
                <p>Noticias Publicadas</p>
            </div>
            <div class="icon"><i class="fas fa-newspaper"></i></div>
            <a href="/admin/noticias" class="small-box-footer">Gestionar <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    
    <div class="col-lg-3 col-6">
        <div class="small-box bg-success">
            <div class="inner">
                <h3>0</h3>
                <p>P.Q.R.S.D Pendientes</p>
            </div>
            <div class="icon"><i class="fas fa-envelope"></i></div>
            <a href="/admin/pqrs" class="small-box-footer">Ver todas <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>

    <div class="col-12 mt-4">
        <div class="card card-outline card-primary shadow-sm bg-white p-4">
            <div class="text-center py-5">
                <i class="fas fa-hospital-alt fa-5x text-primary mb-4"></i>
                <h1 class="display-4">¡Bienvenidos al Control del Portal!</h1>
                <p class="lead">Usted está administrando el sitio oficial de <b><?= $empresa['nombre'] ?></b></p>
                <p class="text-muted">Desde aquí podrá gestionar su contenido, responder trámites y personalizar su sitio web.</p>
                <hr class="my-4 w-50">
                <div class="btn-group">
                    <a href="/" target="_blank" class="btn btn-outline-primary"><i class="fas fa-external-link-alt"></i> Ver Sitio Público</a>
                    <a href="/admin/perfil" class="btn btn-primary"><i class="fas fa-user-edit"></i> Configurar mi Perfil</a>
                </div>
            </div>
        </div>
    </div>
</div>
