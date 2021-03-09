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
                    <h1>Registrar Nuevo Usuario</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="admin-area.php">Inicio</a></li>
                        <li class="breadcrumb-item active">Agregar Usuario</li>
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
                    <h3 class="card-title">Agregar Usuario Manualmente</h3>
                </div>
                
                <div class="card-body">
                    <section class="section container">

                        <form id="register" class="register" action="event-backend.php" method="post">
                            <div id="user-date" class="user-date caja row">

                                <h3>Datos del Usuario</h3>

                                <div class="form-group col-4">
                                    <label for="name">Nombre: </label>
                                    <input type="text" name="name" id="name" class="form-control" placeholder="Tu Nombre">
                                </div><!-- .form-group .col-4 -->

                                <div class="form-group col-4">
                                    <label for="surname">Apellido: </label>
                                    <input type="text" name="surname" id="surname" class="form-control" placeholder="Tu Apellido">
                                </div><!-- .form-group .col-4 -->

                                <div class="form-group col-4">
                                    <label for="email">Email: </label>
                                    <input type="email" name="email" id="email" class="form-control" placeholder="Tu Email">
                                </div><!-- .form-group .col-4 -->

                                <p id="error"></p>
                                <p id="errorMail"></p>

                            </div><!-- #user-date .user-date .caja -->  

                            <div id="packs" class="packs">
                                <h3>Elige el número de boletos</h3>
                                <ul class="price-list container">
                                    <li>
                                        <div class="price-table">
                                            <h3>Pase por Día (Viernes)</h3>
                                            <p class="number">$30</p>
                                            <ul class="ticks">
                                                <li>Bocadillos Gratis</li>
                                                <li>Todas las Conferencias</li>
                                                <li>Todos los Talleres</li>
                                            </ul>
                                            <div class="order">
                                                <button class="button button-price">Seleccionar</button>
                                                <input type="hidden" name="order[day-pass][quantity]" id="day-pass">
                                                <input type="hidden" value="30" name="order[day-pass][price]">
                                            </div>
                                        </div>
                                    </li>
                                
                                    <li>
                                        <div class="price-table">
                                            <h3>Todos los Días</h3>
                                            <p class="number">$50</p>
                                            <ul class="ticks">
                                                <li>Bocadillos Gratis</li>
                                                <li>Todas las Conferencias</li>
                                                <li>Todos los Talleres</li>
                                            </ul>
                                            <div class="order">
                                                <button class="button button-price">Seleccionar</button>
                                                <input type="hidden" name="order[all-pass][quantity]" id="all-day-pass">
                                                <input type="hidden" value="50" name="order[all-pass][price]">
                                            </div>
                                        </div>
                                    </li>
                                
                                    <li>
                                        <div class="price-table">
                                            <h3>Pase por 2 Días (Viernes y Sábado)</h3>
                                            <p class="number">$45</p>
                                            <ul class="ticks">
                                                <li>Bocadillos Gratis</li>
                                                <li>Todas las Conferencias</li>
                                                <li>Todos los Talleres</li>
                                            </ul>
                                            <div class="order">
                                                <button class="button button-price">Seleccionar</button>
                                                <input type="hidden" name="order[two-pass][quantity]" id="two-days-pass">
                                                <input type="hidden" value="45" name="order[two-pass][price]">
                                            </div>
                                        </div>
                                    </li>
                                </ul><!-- .price-list .container -->
                            </div><!-- #packs .packs -->

                            <?php 
                                require_once('../includes/functions/conection.php');

                                try {
                                    $sql = "SELECT events.*, category_event.category, guests.guest_name, guests.guest_surname FROM events";
                                    $sql .= " JOIN category_event ON events.id_cat_event = category_event.id_category ";
                                    $sql .= " JOIN guests ON events.id_guest = guests.id_guests ";
                                    $sql .= " ORDER BY events.event_date, category_event.category, events.event_time ";
                                    $result = $conn->query($sql);
                                }
                                catch(Exception $e) {
                                    echo $e->getMessage();
                                }

                                
                                $all_events = array();

                                while ($events = $result->fetch_assoc()) {
                                    setlocale(LC_TIME, 'spanish');
                                    $date = $events['event_date'];
                                    $weekday_date = ucwords(utf8_encode(strftime("%A - %d/%m/%g", strtotime($date))));

                                    $day = array(
                                        'event_id' => $events['id_event'],
                                        'event_name' => $events['event_name'],
                                        'event_time' => $events['event_time'],
                                        'guest' => $events['guest_name'] . " " . $events['guest_surname']
                                    );

                                    $all_events[$weekday_date]["events"][$events['category']][] = $day;
                                }
                            ?>

                            <div id="eventos" class="eventos clearfix">
                                <h3>Elige sus talleres</h3>
                                <div class="caja row">

                                    <?php foreach($all_events as $day => $event) { ?>

                                        <div id="<?php echo strtolower(str_replace("á", "a", $day)); ?>" class="contenido-dia col-4">
                                            <h4><?php echo $day; ?></h4>

                                            <?php foreach ($event['events'] as $category => $data_event) { ?>

                                                <div>
                                                    <p><?php echo $category ?>:</p>

                                                    <?php foreach ($data_event as $data) { 

                                                        //format string time to remove the last ":00"
                                                        $event_time = $data['event_time']; 
                                                        $event_time = substr($event_time, 0, -3); ?>

                                                        <label>
                                                            <input type="checkbox"  name="register[]" id="<?php echo $data['event_id']; ?>" class="checkbox">
                                                            <time><?php echo $event_time; ?></time> <?php echo $data['event_name']; ?>
                                                            <span class="guest-from-event"> (<?php echo $data['guest']?>)</span>
                                                        </label>
                                    
                                                    <?php } ?>

                                                </div>

                                            <?php } ?>

                                        </div><!--#<?php echo strtolower(str_replace("á", "a", $day)); ?> .contenido-dia-->

                                    <?php } ?>
                            
                                </div><!--.caja-->
                            </div><!--#eventos-->

                            <div id="resumen" class="resumen">
                                <h3>Pagos y Extras</h3>
                                <div class="caja row">
                                    <div class="extras col-7">
                                        <div class="orden">
                                            <label for="shirts-event">Camisa del evento $10 <small>(Promoción 7% dto.)</small></label>
                                            <input type="number" name="extra[shirts][quantity]" id="shirts-event" min="0" size="10" placeholder="0">
                                            <input type="hidden" value="10" name="extra[shirts][price]">
                                        </div><!-- .orden -->
                                        <div class="orden">
                                            <label for="labels-event">Paquete de 10 etiquetas $2 <small>(HTML5, CCS3, JavaScript)</small></label>
                                            <input type="number" name="extra[labels][quantity]" id="labels-event" min="0" size="10" placeholder="0">
                                            <input type="hidden" value="2" name="extra[labels][price]">
                                        </div><!-- .orden -->
                                        <div class="orden">
                                            <label for="gift"></label>
                                            <select id="gift" name="gift" required>
                                                <option class="low-font" value="">-- Seleccione un Regalo --</option>
                                                <option value="etiqueta">Etiqueta</option>
                                                <option value="pulsera">Pulsera</option>
                                                <option value="pluma">Pluma</option>
                                            </select>
                                        </div><!-- .orden -->

                                        <input type="button" id="calculate" class="button" value="Caluclar">
                                    </div><!-- .extras -->

                                    <div class="total col-5">
                                        
                                        <p>Resumen: </p>

                                        <div id="lista-productos">
                                            
                                        </div>

                                        <p>Total: USD <span id="total-sum"></span></p>

                                        <input type="hidden" name="total_amount" id="total_amount">
                                        <input type="submit" name="submit" class="button btn-admin-pay" value="Pagar" disabled="true">
                                    </div>
                                </div>
                            </div>

                        </form>
                    </section>
                </div>
                <!-- /.card-body -->
                <div class="card-footer align-right">
                    <button type="submit" id="btnregister" class="btn btn-primary">Crear</button>
                </div>
                
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
