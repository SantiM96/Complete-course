<?php include_once 'includes/templates/header.php'; ?>


    <section class="section container">
        <h2>Calendario de Eventos</h2>

        <?php 
            try {
                require_once('includes/functions/conection.php');
                $sql = " SELECT id_event, event_name, event_date, event_time, category, icon, guest_name, guest_surname FROM events ";
                $sql .= " INNER JOIN category_event ON events.id_cat_event = category_event.id_category ";
                $sql .= " INNER JOIN guests ON events.id_guest = guests.id_guests ";
                $sql .= " ORDER BY id_event ";
                $result = $conn->query($sql);
            }
            catch (\Exception $e) {
                echo $e->getMessage();
            }
        ?>


        <div class="calendar">

            <?php

                $calendar = array();
                
                while( $events = $result->fetch_assoc() ) {
                    
                    $date = $events['event_date'];

                    $event = array(
                        'title' => $events['event_name'],
                        'date' => $events['event_date'],
                        'time' => $events['event_time'],
                        'category' => $events['category'],
                        'icon' => $events['icon'],
                        'guest' => $events['guest_name'] . " " . $events['guest_surname']
                    );


                    // Order by $date in arrays
                    $calendar[$date][] = $event;
                    
                } //while fetch_assoc
            ?>

            <?php
                //print all the events
                foreach($calendar as $day => $event_list) { ?>

                    <h3>
                        <i class="fa fa-calendar"></i>
                        <?php 
                            setlocale(LC_TIME, 'spanish');
                            echo str_replace("De", "de", ucwords(utf8_encode(strftime("%A, %d de %B del %Y", strtotime($day)))));
                        ?>
                    </h3>
                    <div class="flex-day">
                        <?php foreach($event_list as $event) { ?>
                            <div class="day">
                                <p class="title"><?php echo $event['title']; ?></p>
                                <p class="time">
                                    <i class="fa fa-clock-o" aria-hidden="true"></i>
                                    <?php echo $event['date'] . " " . $event['time']; ?>
                                </p>
                                <p>
                                    <i class="fa <?php echo $event['icon']; ?>" aria-hidden="true"></i>
                                    <?php echo $event['category']; ?>
                                </p>
                                <p>
                                    <i class="fa fa-user" aria-hidden="true"></i>
                                    <?php echo $event['guest']; ?>
                                </p>
                            </div>
                        <?php } ?>
                    </div>
            <?php } ?>
                
        </div><!-- .calendar -->

        <?php $conn->close(); ?>
 
    </section>


<?php include_once 'includes/templates/footer.php'; ?>
