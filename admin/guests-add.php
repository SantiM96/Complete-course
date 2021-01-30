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
                    <h1>Agregar Invitado</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="admin-area.php">Inicio</a></li>
                        <li class="breadcrumb-item active">Agregar Invitado</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content section-create-admin">
        <?php if($_SESSION['level'] >= 0) { ?>
            <!-- Default box -->
            <!-- general form elements -->
            <div class="card card-primary section-big">
                <div class="card-header">
                    <h3 class="card-title">Agregar Nuevo Invitado</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form name="guests-create" id="guests-create" method="post" action="guests-backend.php" enctype="multipart/form-data">
                    <div class="card-body">
                        <div class="row form-group">
                            <div class="col-6">
                                <label for="guest-name">Nombre:</label>
                                <input type="text" class="form-control" id="guests-name" name="guests-name" placeholder="Nombre">
                            </div>
                            <div class="col-6">
                                <label for="guest-surname">Apellido:</label>
                                <input type="text" class="form-control" id="guests-surname" name="guests-surname" placeholder="Apellido">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="guest_biography">Biografía:</label>
                            <textarea name="guests-biography" id="biography" class="form-control" cols="30"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="guest-image">Imagen:</label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input name="guest-file" type="file" class="custom-file-input" id="guest-file">
                                    <label class="custom-file-label" for="guest-file">Seleccionar archivo</label>
                                </div>
                            </div>
                            <small class="small">solo archivos .jpg - .jpeg - .png - .gif - max(3MB)</small>
                        </div>
                        
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