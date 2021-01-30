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
                    <h1>Eventos</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="admin-area.php">Inicio</a></li>
                        <li class="breadcrumb-item active">Ver Eventos</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Modificar o borrar eventos</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="registers" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Nombre</th>
                                        <th>Fecha</th>
                                        <th>Hora</th>
                                        <th>Categoría</th>
                                        <th>Invitado</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        require_once '../includes/functions/conection.php';
                                        try {
                                            $sql = "SELECT id_event, event_name, event_date, event_time, category, guest_name, guest_surname FROM events";
                                            $sql .= " INNER JOIN category_event ON events.id_cat_event=category_event.id_category ";
                                            $sql .= " INNER JOIN guests ON events.id_guest=guests.id_guests ";
                                            $sql .= " ORDER BY id_event ";
                                            $events = $conn->query($sql);
                                        }
                                        catch(Exception $e) {
                                            echo $e->getMessage();
                                        }
                                    
                                        /*echo "<pre>";
                                            var_dump($events->fetch_assoc());
                                        echo "</pre>";*/
                                        while($event = $events->fetch_assoc()) { 
                                            $originalDate = $event['event_date'];
                                            $newDate = date("d-m-Y", strtotime($originalDate)); ?>

                                            <tr>
                                                <td><?php echo $event['event_name']; ?></td>
                                                <td><?php echo $newDate ?></td>
                                                <td><?php echo $event['event_time']; ?></td>
                                                <td><?php echo $event['category']; ?></td>
                                                <td><?php echo $event['guest_name'] . " " .  $event['guest_surname']; ?></td>
                                                <td class="action">
                                                    <a href="event-edit.php?id=<?php echo $event['id_event']; ?>" class="btn bg-orange margin btn-action">
                                                        <i class="fa fa-pencil"></i>
                                                    </a>
                                                    <a href="#" id="<?php echo $event['id_event']; ?>" data-type="event" class="btn bg-maroon margin delete-register btn-action">
                                                        <i class="fa fa-trash"></i>
                                                    </a>
                                                </td>
                                                
                                            </tr>

                                        <?php } 
                                    ?>        
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Nombre</th>
                                        <th>Fecha</th>
                                        <th>Hora</th>
                                        <th>Categoría</th>
                                        <th>Invitado</th>
                                        <th>Acciones</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
</div>
<!-- /.content-wrapper -->


<?php 
    include 'templates/footer.php';
?>