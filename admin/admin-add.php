<?php
    include 'functions/session.php';
    include 'templates/header.php';
    include 'templates/bar.php';
    include 'templates/navegation.php';
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Agregar Administrador</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="admin-area.php">Inicio</a></li>
                        <li class="breadcrumb-item active">Agregar Administrador</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content section-create-admin">
        <?php if($_SESSION['level'] > 0) { ?>
            <!-- Default box -->
            <!-- general form elements -->
            <div class="card card-primary section-small">
                <div class="card-header">
                    <h3 class="card-title">Crear Nuevo Moderador</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form name="admin-create" id="admin-create" method="post" action="admin-backend.php">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="usuario">Usuario:</label>
                            <input type="text" class="form-control" id="user" name="user" placeholder="Usuario">
                        </div>
                        <div class="form-group">
                            <label for="name">Nombre:</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Ingresa tu Nombre Completo">
                        </div>
                        <div class="form-group colorPass">
                            <label for="password">Contraseña:</label>
                            <input type="password" class="form-control password" id="password" name="password" placeholder="Ingresar Contraseña para logear">
                        </div>
                        <div class="form-group colorPass">
                            <label for="password-check">Repetir Contraseña:</label>
                            <input type="password" class="form-control password" id="password-check" name="password-check" placeholder="Ingresar Contraseña para logear">
                            <span id="password-result"></span>
                        </div>
                        <label class="permission" for=""><input type="checkbox" id="permission"> Dar permisos de administrador</label>
                        <?php if($_SESSION['level'] === 2) { ?>
                            <label class="permission owner" for=""><input type="checkbox" id="owner"> Dar permisos de dueño</label> 
                        <?php } ?>
                        <input type="hidden" name="admin-add" value="1">
                    </div>
                    <!-- /.card-body -->

                    <div class="card-footer align-right">
                        <button type="submit" class="btn btn-primary">Crear</button>
                    </div>
                </form>
            </div>
            <!-- /.card -->
        <?php } 
        else { ?> 
            <!-- Default box -->
            <div class="card">
                <div class="card-body">
                    <!-- general form elements -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">No tienes los permisos necesarios para estar aquí</h3>
                        </div>
                        <!-- /.card-header -->                        
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        <?php } ?>
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->


<?php 
    include 'templates/footer.php';
?>