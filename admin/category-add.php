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
                    <h1>Agregar Categoría <i class="fab fa-500px"></i></h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="admin-area.php">Inicio</a></li>
                        <li class="breadcrumb-item active">Agregar Categoría</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <?php if($_SESSION['level'] >= 0) { ?>
            <!-- Default box -->
            <!-- general form elements -->
            <div class="card card-primary section-small">
                <div class="card-header">
                    <h3 class="card-title">Crear Nueva Categoría</h3>
                </div>
                <!-- /.card-header -->
                
                <!-- form start -->
                <form name="category-create" id="category-create" method="post" action="category-backend.php">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="usuario">Nombre:</label>
                            <input type="text" class="form-control" id="category-name" name="category-name" placeholder="Nombre de la Categoría">
                        </div>
                        <div class="form-group">
                            <label for="icon">ícono:</label>
                            <div class="input-group iconpicker-container">
                                <div class="input-group-addon">
                                    <span class="form-control">
                                        <i class="fa fa-address-book"></i> 
                                    </span>
                                </div>
                                <input data-placement="bottomRight" type="text" id="icon" class="form-control icp icp-auto iconpicker-element iconpicker-input" name="icon" placeholder="fa-icon" disabled>
                            </div>
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