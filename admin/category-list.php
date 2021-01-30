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
                    <h1>Categorías</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="admin-area.php">Inicio</a></li>
                        <li class="breadcrumb-item active">Ver Categorías</li>
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
                            <h3 class="card-title">Modificar o borrar categorías</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="registers" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Nombre</th>
                                        <th>Ícono</th>
                                        <th>Código</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        require_once '../includes/functions/conection.php';
                                        try {
                                            $categories = $conn->query("SELECT * FROM category_event");
                                        }
                                        catch(Exception $e) {
                                            echo $e->getMessage();
                                        }
                                    
                                        
                                        while($category = $categories->fetch_assoc()) {  ?>

                                            <tr>
                                                <td><?php echo $category['category']; ?></td>
                                                <td><i class="<?php echo $category['icon']; ?>"></i></td>
                                                <td><?php echo $category['icon']; ?></td>
                                                <td class="action">
                                                    <a href="category-edit.php?id=<?php echo $category['id_category']; ?>" class="btn bg-orange margin btn-action">
                                                        <i class="fa fa-pencil"></i>
                                                    </a>
                                                    <a href="#" id="<?php echo $category['id_category']; ?>" class="btn bg-maroon margin delete-register btn-action">
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