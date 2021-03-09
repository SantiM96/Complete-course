<?php include_once 'includes/templates/header.php'; ?>


    <section class="section container">
        <h2>Registro de Usuario</h2>
        <form id="register" class="register" action="pay.php" method="post">
            <div id="user-date" class="user-date caja clearfix">

                <div class="camp">
                    <label for="name">Nombre: </label>
                    <input type="text" name="name" id="name" placeholder="Tu Nombre">
                </div><!-- .camp -->

                <div class="camp">
                    <label for="surname">Apellido: </label>
                    <input type="text" name="surname" id="surname" placeholder="Tu Apellido">
                </div><!-- .camp -->

                <div class="camp">
                    <label for="email">Email: </label>
                    <input type="email" name="email" id="email" placeholder="Tu Email">
                </div><!-- .camp -->

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
                                <input type="hidden" name="order[day-pass][quantity]" id="day-pass" value="0">
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
                                <input type="hidden" name="order[all-pass][quantity]" id="all-day-pass" value="0">
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
                                <input type="hidden" name="order[two-pass][quantity]" id="two-days-pass" value="0">
                                <input type="hidden" value="45" name="order[two-pass][price]">
                            </div>
                        </div>
                    </li>
                </ul><!-- .price-list .container -->
            </div><!-- #packs .packs -->

            <?php 
                require_once('includes/functions/conection.php');

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
                <h3>Elige tus talleres</h3>
                <div class="caja clearfix">

                    <?php foreach($all_events as $day => $event) { ?>

                        <div id="<?php echo strtolower(str_replace("á", "a", $day)); ?>" class="contenido-dia clearfix">
                            <h4><?php echo $day; ?></h4>

                            <?php foreach ($event['events'] as $category => $data_event) { ?>

                                <div>
                                    <p><?php echo $category ?>:</p>

                                    <?php foreach ($data_event as $data) { 

                                        //format string time to remove the last ":00"
                                        $event_time = $data['event_time']; 
                                        $event_time = substr($event_time, 0, -3); ?>

                                        <label>
                                            <input type="checkbox" name="register[]" id="<?php echo $data['event_id']; ?>" class="checkbox <?php echo strtolower(substr(str_replace("á", "a", $day), 0, -11) . "check"); ?>" value="<?php echo $data['event_id']; ?>">
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
                <div class="caja clearfix">
                    <div class="extras">
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

                    <div class="total">
                        
                        <p>Resumen: </p>

                        <div id="lista-productos">
                            
                        </div>

                        <p>Total: USD <span id="total-sum"></span></p>

                        <input type="hidden" name="total_amount" id="total_amount">
                        <input type="submit" name="submit" id="btnregister" class="button" value="Pagar" disabled="true">
                    </div>
                </div>
            </div>

        </form>
    </section>

<?php include_once 'includes/templates/footer.php'; ?>
