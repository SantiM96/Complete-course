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
                    <h1>Usuarios</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="admin-area.php">Inicio</a></li>
                        <li class="breadcrumb-item active">Ver Registrados</li>
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
                            <h3 class="card-title">Modificar o borrar usuarios registrados</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="registers" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Nombre</th>
                                        <th>Mail</th>
                                        <th>Regístro</th>
                                        <th>Pases</th>
                                        <th>Eventos</th>
                                        <th>Regalo</th>
                                        <th>Total</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        require_once '../includes/functions/conection.php';
                                        try {
                                            $sql = " SELECT registers.*, gift.name_gift FROM registers ";
                                            $sql .= " JOIN gift ";
                                            $sql .= " ON registers.gift = gift.id_gift ";

                                            $registers = $conn->query($sql);
                                        }
                                        catch(Exception $e) {
                                            echo $e->getMessage();
                                        }
                                    
                                        
                                        while($user = $registers->fetch_assoc()) {  ?>
                                            <tr>
                                                <td><?php echo $user['name_user'] . " " . $user['surname_user']; ?></td>
                                                <td><?php echo $user['email_user']; ?></td>
                                                <td><?php echo $user['date_register']; ?></td>
                                                <td><?php echo $user['articles_pass']; ?></td>
                                                <td><?php echo $user['packs_register']; ?></td>
                                                <td><?php echo $user['name_gift']; ?></td>
                                                <td><?php echo $user['total_amount']; ?></td>
                                             
                                                <td class="action">
                                                    <a href="user-edit.php?id=<?php echo $user['id_user']; ?>" class="btn bg-orange margin btn-action">
                                                        <i class="fa fa-pencil"></i>
                                                    </a>
                                                    <a href="#" id="<?php echo $user['id_user']; ?>" class="btn bg-maroon margin delete-register btn-action">
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
                                        <th>Mail</th>
                                        <th>Regístro</th>
                                        <th>Pases</th>
                                        <th>Eventos</th>
                                        <th>Regalo</th>
                                        <th>Total</th>
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