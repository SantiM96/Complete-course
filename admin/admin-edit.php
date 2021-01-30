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
                    <h1>Editar Administrador</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="admin-area.php">Inicio</a></li>
                        <li class="breadcrumb-item active">Editar Administrador</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <?php if(!filter_var($id, FILTER_VALIDATE_INT)) die("Error ID!!"); ?>

    <!-- Main content -->
    <section class="content section-create-admin section-small">
        <?php if($_SESSION['level'] > 0) { ?>
            <!-- Default box -->
            <!-- general form elements -->
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Editar <?php if($_SESSION['id_admin'] === (int)$_GET['id']) echo "Mi"; ?> Administrador</h3>
                </div>
                <!-- /.card-header -->
                <?php 
                    require_once '../includes/functions/conection.php';
                    $admin = ($conn->query("SELECT * FROM admins WHERE id_admin = $id"))->fetch_assoc();
                ?>
                <!-- form start -->
                <form name="admin-edit" id="admin-edit" method="post" action="admin-backend.php">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="usuario">Usuario:</label>
                            <input type="text" class="form-control" id="user" name="user" placeholder="Usuario" value="<?php echo $admin['admin']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="name">Nombre:</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Ingresa tu Nombre Completo" value="<?php echo $admin['name']; ?>">
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
                        <label class="permission" for=""><input type="checkbox" id="permission" value="<?php echo $admin['level']; ?>"> Dar permisos de administrador </label>
                        <?php if($_SESSION['level'] > 1) { ?>
                            <label class="permission owner" for=""><input type="checkbox" id="owner" value="<?php echo $admin['level']; ?>"> Dar permisos de dueño </label>
                        <?php } ?>
                        <input type="hidden" name="admin-edit" id="id-user" value="<?php echo $admin['id_admin']; ?>">
                    </div>
                    <!-- /.card-body -->

                    <div class="card-footer align-right">
                        <button type="submit" class="btn btn-primary">Guardar</button>
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