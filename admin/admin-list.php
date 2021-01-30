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
                    <h1>Administradores</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="admin-area.php">Inicio</a></li>
                        <li class="breadcrumb-item active">Ver Administradores</li>
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
                            <h3 class="card-title"><?php if($_SESSION['level'] > 0) { ?>
                                                            Modificar o borrar administradores
                                                        <?php } 
                                                        else { ?>
                                                            No tienes los permisos necesarios para estar aquí
                                                        <?php } ?>
                            </h3>
                        </div>
                        <!-- /.card-header -->
                        <?php if($_SESSION['level'] > 0) { ?>
                            <div class="card-body">
                                <table id="registers" class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>Usuario</th>
                                            <th>Nombre</th>
                                            <th>Acciones</th>
                                            <th>Permisos</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            require_once '../includes/functions/conection.php';
                                            try {
                                                $admins = $conn->query("SELECT id_admin, admin, name, level FROM admins");
                                            }
                                            catch(Exception $e) {
                                                echo $e->getMessage();
                                            }
                                        
                                            while($admin = $admins->fetch_assoc()) { ?>

                                                <tr>
                                                    <td><?php echo $admin['admin']; ?></td>
                                                    <td><?php echo $admin['name']; ?></td>
                                                    <td class="action">
                                                        <a href="admin-edit.php?id=<?php echo $admin['id_admin']; ?>" class="btn bg-orange margin btn-action">
                                                            <i class="fa fa-pencil"></i>
                                                        </a>
                                                        <a href="#" id="<?php echo $admin['id_admin']; ?>" data-type="admin" class="btn bg-maroon margin delete-register btn-action">
                                                            <i class="fa fa-trash"></i>
                                                        </a>
                                                    </td>
                                                    <td>
                                                        <?php 
                                                            if ($admin['level'] === "2") echo ".Dueño";
                                                            else if ($admin['level'] === "1") echo "Administrador";
                                                            else echo "Moderador"; 
                                                        ?>
                                                    </td>
                                                </tr>

                                            <?php } 
                                        ?>        
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        <?php } ?>
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