<?php
    include 'functions/session.php';
    include 'templates/header.php';
    include 'templates/bar.php';
    include 'templates/navegation.php';
    $id = $_GET['id'];
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Editar Invitado</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="admin-area.php">Inicio</a></li>
                        <li class="breadcrumb-item active">Editar Invitado</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <?php if(!filter_var($id, FILTER_VALIDATE_INT)) die("Error ID!!"); ?>

    <!-- Main content -->
    <section class="content section-event">
        <?php if($_SESSION['level'] >= 0) { ?>
            <div class="card card-primary section-big">
                <div class="card-header">
                    <h3 class="card-title">Editar Invitado</h3>
                </div>
                <?php
                    require_once '../includes/functions/conection.php';
                    $guest = $conn->query("SELECT * FROM guests WHERE id_guests = $id")->fetch_assoc();
                ?>
                <form name="guests-create" id="guests-create" method="post" action="guests-backend.php" enctype="multipart/form-data">
                    <div class="card-body">
                        <div class="row form-group">
                            <div class="col-6">
                                <label for="guest-name">Nombre:</label>
                                <input type="text" class="form-control" id="guests-name" name="guests-name" placeholder="Nombre" value="<?php echo $guest['guest_name']; ?>">
                            </div>
                            <div class="col-6">
                                <label for="guest-surname">Apellido:</label>
                                <input type="text" class="form-control" id="guests-surname" name="guests-surname" placeholder="Apellido" value="<?php echo $guest['guest_surname']; ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="guest_biography">Biografía:</label>
                            <textarea name="guests-biography" id="biography" class="form-control" cols="30"><?php echo $guest['description']; ?></textarea>
                        </div>
                        <div class="form-group">
                            <label for="guest-image">Imagen:</label>
                            <small class="small">si no elige una nueva foto, se conservará la imagen actual</small>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input name="guest-file" type="file" class="custom-file-input" id="guest-file">
                                    <label class="custom-file-label" for="guest-file">Seleccionar archivo</label>
                                </div>
                            </div>
                            <small class="small">solo archivos .jpg - .jpeg - .png - .gif - max(3MB)</small>
                        </div>
                        <div class="currently-image-button form-group">
                            <button>Ver Imagen Actual</button>
                        </div>
                        <div class="currently-image form-group">
                            <label for="guest-image">Imagen Actual:</label>
                            <div class="align-center">
                                <img src="../img/guests/<?php echo $guest['url_image']; ?>" alt="Imagen Actual">
                            </div>
                        </div>

                        
                    </div>
                    <!-- /.card-body -->

                    <div class="card-footer align-right">
                        <button type="submit" class="btn btn-primary" value="<?php echo $id; ?>">Guardar</button>
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