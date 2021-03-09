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
                                            $all_events = $conn->query("SELECT id_event, event_name FROM events");
                                        }
                                        catch(Exception $e) {
                                            echo $e->getMessage();
                                        }

                                        //get full list events
                                        $all_event_list = array();
                                        while($event = $all_events->fetch_assoc()) {
                                            $all_event_list[$event['id_event']] = $event['event_name'];
                                        }
                                        
                                        while($user = $registers->fetch_assoc()) {  ?>
                                            <tr>
                                                <td class="min-width"><?php 
                                                    echo $user['name_user'] . " " . $user['surname_user']; 

                                                    $payed = $user['payed'];
                                                    if($payed)  echo '<br><span class="badge bg-green">Pago</span>';
                                                    else        echo '<br><span class="badge bg-red">No Pago</span>';
                                                ?></td>
                                                <td><?php echo $user['email_user']; ?></td>
                                                <td><?php echo $user['date_register']; ?></td>
                                                <td class="min-width"><?php 

                                                    $pass_esp_single = array(
                                                        'one_day' => 'Pase de 1 día',
                                                        'two_days' => 'Pase de 2 días',
                                                        'complete_pass' => 'Pase completo',
                                                        'shirts' => '1 camisa',
                                                        'labels' => '1 etiqueta'
                                                    );
                                                    $pass_esp_multi = array(
                                                        'shirts' => 'camisas',
                                                        'labels' => 'etiquetas'
                                                    );

                                                    $articles = json_decode($user['articles_pass']);
                                                    foreach($articles as $key => $article) {
                                                        if($article == null) $article = 0;
                                                        if($article == 1) echo $pass_esp_single[$key] . "<br>";
                                                        else              echo $article . " " . $pass_esp_multi[$key] . "<br>";
                                                    }

                                                ?></td>
                                                <td class="min-width align-center">
                                                    <?php
                                                        $str_events_names = "";
                                                        $events_user = json_decode($user['packs_register']);
                                                        foreach ($events_user as $event_user) {
                                                            foreach ($event_user as $each_id_event) {
                                                                $str_events_names .= "- " . $all_event_list[$each_id_event] . "<br>";
                                                            }
                                                        }   
                                                    ?>
                                                    <button class="btn bg-green" value="<?php echo $str_events_names; ?>">Eventos del Usuario</button>
                                                </td> 
                                                <td><?php echo $user['name_gift']; ?></td>
                                                <td class="min-width"><?php 
                                                    $amount_bd = $user['total_amount'];

                                                    if (strstr($amount_bd, '(')) {

                                                        $total = (float)strstr($amount_bd, '(', true);
                                                        $difference = (float)substr(strstr(strstr($amount_bd, ')', true), 'o'), 2);

                                                        if ($difference < 0) $total = $total . " (sobra " . -$difference . ")";
                                                        else                 $total = $amount_bd;
                                                    }
                                                    else $total = $amount_bd; 
                                                
                                                    
                                                    echo $total;
                                                    
                                                    
                                                ?></td>
                                             
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