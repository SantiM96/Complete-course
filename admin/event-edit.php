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
                    <h1>Editar Evento</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="admin-area.php">Inicio</a></li>
                        <li class="breadcrumb-item active">Editar Evento</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <?php if(!filter_var($id, FILTER_VALIDATE_INT)) die("Error ID!!"); ?>

    <!-- Main content -->
    <section class="content section-create-admin">
        <?php if($_SESSION['level'] >= 0) { ?>
            <div class="card card-primary section-big">
                <div class="card-header">
                    <h3 class="card-title">Editar Evento</h3>
                </div>
                <form action="event-backend.php">
                    <div class="card-body">
                        <?php 
                            require_once '../includes/functions/conection.php';
                            $events = $conn->query("SELECT * FROM events WHERE id_event = $id")->fetch_assoc();
                        ?> 
                        <div class="row">
                            <div class="col-12">
                                <label>Nombre:</label>
                                <input type="text" id="event-name-edit" class="form-control" placeholder="Nombre del Evento" value="<?php echo $events['event_name']; ?>">
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <!-- Date -->
                            <div class="form-group col-6">
                                <label for="date">Fecha:</label>
                                <?php
                                    $originalDate = $events['event_date'];
                                    $newDate = date("d-m-Y", strtotime($originalDate));
                                ?>
                                <input type="text" id="date" class="form-control" placeholder="dd-mm-yyyy" value="<?php echo $newDate ?>" />
                            </div>
                            <!-- /.form group -->
                            <div class="col-6">
                                <label>Hora:</label>
                                <input type="time" id="time" class="form-control" placeholder="Hora del evento" value="<?php echo $events['event_time']; ?>">
                            </div>
                        </div>

                        <div class="row"> 
                            <div class="col-6">
                                <label>Categoría:</label>
                                <select id="edit-event-category" class="form-control">
                                    <?php 
                                        $categories = $conn->query("SELECT id_category, category FROM category_event");
        
                                        while ($category = $categories->fetch_assoc()) { ?>
                                            <option value="<?php echo $category['id_category']; ?>" <?php if($events['id_cat_event'] === $category['id_category']) echo "selected"; ?>><?php echo $category['category']; ?></option>
                                        <?php }
                                    ?>
                                </select>
                            </div>
                            <div class="col-6">
                                <label>Invitado:</label>
                                <select id="edit-event-guest" class="form-control" value="">
                                    <?php 
                                        $guests = $conn->query("SELECT id_guests, guest_name, guest_surname FROM guests");

                                        while ($guest = $guests->fetch_assoc()) { ?>
                                            <option value="<?php echo $guest['id_guests']; ?>" <?php if($events['id_guest'] === $guest['id_guests']) echo "selected"; ?>><?php echo $guest['guest_name'] . " " . $guest['guest_surname']; ?></option>
                                        <?php }
                                    ?>
                                </select>
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