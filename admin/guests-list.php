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
                    <h1>Invitados</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="admin-area.php">Inicio</a></li>
                        <li class="breadcrumb-item active">Ver Invitados</li>
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
                            <h3 class="card-title">Modificar o borrar invitados</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="registers" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Nombre</th>
                                        <th>Biografía</th>
                                        <th>Imagen</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        require_once '../includes/functions/conection.php';
                                        try {
                                            $guests = $conn->query("SELECT * FROM guests");
                                        }
                                        catch(Exception $e) {
                                            echo $e->getMessage();
                                        }
                                    
                                        /*echo "<pre>";
                                            var_dump($guests->fetch_assoc());
                                        echo "</pre>";*/
                                        while($guest = $guests->fetch_assoc()) {  ?>

                                            <tr>
                                                <td class="fullname"><?php echo $guest['guest_name'] . " " . $guest['guest_surname']; ?></td>
                                                <td><?php echo $guest['description']; ?></td>
                                                <td><img src="../img/guests/<?php echo $guest['url_image']; ?>" alt="Imagen Invitado"></td>
                                                <td class="action">
                                                    <a href="guests-edit.php?id=<?php echo $guest['id_guests']; ?>" class="btn bg-orange margin btn-action">
                                                        <i class="fa fa-pencil"></i>
                                                    </a>
                                                    <a href="#" id="<?php echo $guest['id_guests']; ?>" data-type="guest" class="btn bg-maroon margin delete-register btn-action">
                                                        <i class="fa fa-trash"></i>
                                                    </a>
                                                </td>
                                                
                                            </tr>

                                        <?php } 
                                    ?>        
                                </tbody>
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