<?php
    include 'functions/session.php';
    include 'functions/functions-admin.php';
    include 'templates/header.php';
    include 'templates/bar.php';
    include 'templates/navegation.php';
    require_once '../includes/functions/conection.php';
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6 dashboard-title">
                    <h2>Dashboard</h2>
                    <small>Resumen de datos del proyecto</small>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="admin-area.php">Inicio</a></li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="card">
            <div class="card-body">
                <div class="row">

                    <div class="col-lg-4 col-6">
                        <?php $registers = $conn->query("SELECT COUNT(id_user) AS register FROM registers")->fetch_assoc(); ?>
                        <!-- small card -->
                        <div class="small-box bg-info">
                            <div class="inner">
                                <h3><?php echo $registers['register']; ?></h3>

                                <p>Registrados</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-shopping-cart"></i>
                            </div>
                            <a href="user-list.php" class="small-box-footer"> Más Información <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <!-- ./col -->

                    <div class="col-lg-4 col-6">
                        <?php $registers = $conn->query("SELECT COUNT(id_user) AS register FROM registers WHERE payed = 1")->fetch_assoc(); ?>
                        <!-- small card -->
                        <div class="small-box bg-green">
                            <div class="inner">
                                <h3><?php echo $registers['register']; ?></h3>

                                <p>Registrados Pagos</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-money-bill-wave-alt"></i>                            </div>
                            <a href="user-list.php" class="small-box-footer"> Más Información <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <!-- ./col -->

                    <div class="col-lg-4 col-6">
                        <?php $registers = $conn->query("SELECT COUNT(id_user) AS register FROM registers WHERE payed = 0")->fetch_assoc(); ?>
                        <!-- small card -->
                        <div class="small-box bg-red">
                            <div class="inner">
                                <h3><?php echo $registers['register']; ?></h3>

                                <p>Registrados Deudores</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-credit-card"></i>
                            </div>
                            <a href="user-list.php" class="small-box-footer"> Más Información <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <!-- ./col -->

                    <div class="col-lg-4 col-6">
                        <?php 
                            $registers = $conn->query("SELECT * FROM registers");
                            $total_orders = 0;

                            while ($user = $registers->fetch_assoc()) {
                                $total_string = $user['total_amount'];

                                if (!strstr($total_string, 'debe')) $total_orders += (float)$total_string;
                                else $total_orders += get_total($total_string);

                            }
                        ?>
                        <!-- small card -->
                        <div class="small-box bg-info">
                            <div class="inner">
                                <h3>$<?php echo $total_orders; ?></h3>

                                <p>Total en Órdenes</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-dollar-sign"></i>
                            </div>
                            <a href="user-list.php" class="small-box-footer"> Más Información <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <!-- ./col -->

                    <div class="col-lg-4 col-6">
                        <?php 
                            $registers = $conn->query("SELECT * FROM registers");
                            $total_paid = 0;
                        
                            while ($user = $registers->fetch_assoc()) {
                                $total_string = $user['total_amount'];

                                if ($user['payed'] == "1") {
                                    if(!strstr($total_string, 'debe'))      $total_paid += (float)$total_string;
                                    else                                    $total_paid += get_total($total_string);
                                }
                                else if (strstr($total_string, 'debe')) $total_paid += get_total($total_string) - get_difference($total_string);
                            }
                        ?>
                        <!-- small card -->
                        <div class="small-box bg-green">
                            <div class="inner">
                                <h3>$<?php echo $total_paid; ?></h3>

                                <p>Total Pagado</p>
                            </div>
                            <div class="icon">
                            <i class="fas fa-money-bill-wave"></i>
                            </div>
                            <a href="user-list.php" class="small-box-footer"> Más Información <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <!-- ./col -->

                    <div class="col-lg-4 col-6">
                        <!-- small card -->
                        <div class="small-box bg-red">
                            <div class="inner">
                                <h3>$<?php echo $total_orders - $total_paid; ?></h3>

                                <p>Total en deudas</p>
                            </div>
                            <div class="icon">
                                <i class="far fa-credit-card"></i>                            </div>
                            <a href="user-list.php" class="small-box-footer"> Más Información <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <!-- ./col -->

                    <h2>Regalos</h2>

                    <div class="col-lg-4 col-6">
                        <?php
                            $users = $conn->query("SELECT * FROM registers WHERE gift = 3");

                            $gift_paid = 0;
                            while ($user = $users->fetch_assoc()) {
                                if ($user['payed'] == "1" || strstr($user['total_amount'], 'debe')) $gift_paid += 1;
                            } 
                        ?>
                        <!-- small card -->
                        <div class="small-box bg-indigo">
                            <div class="inner">
                                <h3><?php echo $gift_paid; ?></h3>

                                <p>Plumas</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-gift"></i>
                            </div>
                            <a href="user-list.php" class="small-box-footer"> Más Información <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <!-- ./col -->

                    <div class="col-lg-4 col-6">
                        <?php
                            $users = $conn->query("SELECT * FROM registers WHERE gift = 1");

                            $gift_paid = 0;
                            while ($user = $users->fetch_assoc()) {
                                if ($user['payed'] == "1" || strstr($user['total_amount'], 'debe')) $gift_paid += 1;
                            } 
                        ?>
                        <!-- small card -->
                        <div class="small-box bg-blue">
                            <div class="inner">
                                <h3><?php echo $gift_paid; ?></h3>

                                <p>Pulseras</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-gift"></i>
                            </div>
                            <a href="user-list.php" class="small-box-footer"> Más Información <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <!-- ./col -->

                    <div class="col-lg-4 col-6">
                        <?php
                            $users = $conn->query("SELECT * FROM registers WHERE gift = 2");

                            $gift_paid = 0;
                            while ($user = $users->fetch_assoc()) {
                                if ($user['payed'] == "1" || strstr($user['total_amount'], 'debe')) $gift_paid += 1;
                            } 
                        ?>
                        <!-- small card -->
                        <div class="small-box bg-teal">
                            <div class="inner">
                                <h3><?php echo $gift_paid; ?></h3>

                                <p>Etiquetas</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-gift"></i>
                            </div>
                            <a href="user-list.php" class="small-box-footer"> Más Información <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <!-- ./col -->

                </div>
                <!-- ./row -->
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->

    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->


<?php
    $conn->close();
    include 'templates/footer.php';
?>