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
                    <h1>Agregar Evento</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="admin-area.php">Inicio</a></li>
                        <li class="breadcrumb-item active">Agregar Evento</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <?php if($_SESSION['level'] >= 0) { ?>
            <!-- Default box -->
            <div class="card card-primary section-big">
                <div class="card-header">
                    <h3 class="card-title">Agregar Evento</h3>
                </div>
                <form action="event-backend.php">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <label>Nombre:</label>
                                <input type="text" id="event-name" class="form-control" placeholder="Nombre del Evento">
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <!-- Date -->
                            <div class="form-group col-6">
                                <label for="date">Fecha:</label>
                                <input type="text" id="date" class="form-control" placeholder="dd-mm-yyyy" />
                            </div>
                            <!-- /.form group -->
                            <div class="col-6">
                                <label>Hora:</label>
                                <input type="time" id="time" class="form-control" placeholder="Hora del evento">
                            </div>
                        </div>

                        <div class="row"> 
                            <div class="col-6">
                                <label>Categoría:</label>
                                <select id="create-event-category" class="form-control">
                                    <option class="select" value="">-- Seleccionar --</option>
                                    <?php 
                                        require_once '../includes/functions/conection.php';
                                        $categories = $conn->query("SELECT id_category, category FROM category_event");

                                        while ($category = $categories->fetch_assoc()) { ?>
                                            <option value="<?php echo $category['id_category']; ?>"><?php echo $category['category']; ?></option>
                                        <?php }
                                    ?>
                                </select>
                            </div>
                            <div class="col-6">
                                <label>Invitado:</label>
                                <select id="create-event-guest" class="form-control">
                                    <option class="select" value="">-- Seleccionar --</option>
                                    <?php 
                                        $guests = $conn->query("SELECT id_guests, guest_name, guest_surname FROM guests");

                                        while ($guest = $guests->fetch_assoc()) { ?>
                                            <option value="<?php echo $guest['id_guests']; ?>"><?php echo $guest['guest_name'] . " " . $guest['guest_surname']; ?></option>
                                        <?php }
                                    ?>
                                </select>
                            </div>

                        </div>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer align-right">
                        <button type="submit" class="btn btn-primary">Agregar</button>
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