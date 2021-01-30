<?php include_once 'includes/templates/header.php'; ?>

    <section class="container section add-top">
        <h2>La mejor conferencia de diseño web en español</h2>
        <p>Mauris fringilla faucibus nunc ut tristique. Interdum et malesuada fames ac ante ipsum primis in faucibus. Integer nulla
        massa, pellentesque nec erat at, tincidunt tincidunt diam. Aliquam lacinia ante nisi, sed pretium lacus blandit in.
        Nulla malesuada efficitur sem, sit amet commodo eros venenatis vitae.</p>
    </section>

    <section class="program">
        <div class="video-container">
            <video autoplay loop poster="img/bg-talleres.jpg">
                <source src="video/video.mp4" type="video/mp4">
                <source src="video/video.ogv" type="video/ogv">
                <source src="video/video.webm" type="video/webm">
            </video>
        </div><!-- .video-container -->
        <div class="program-content">
            <div class="container">
                <div class="program-event">
                    <h2>Programa del Evento</h2>
                    <?php 
                        require_once('includes/functions/conection.php');
                        try {
                            $categories = $conn->query("SELECT * FROM category_event LIMIT 3");
                        }
                        catch (Exception $e) {
                            echo $e->getMessage();
                        } 
                    ?>
                    <nav class="program-menu"> 
                        <?php while ($category = $categories->fetch_assoc()) { ?>
                            <a><i class="<?php echo $category['icon']; ?>"></i><?php echo $category['category']; ?></a>
                        <?php } ?>
                    </nav>

                    <?php 
                    try {
                        $sql = " SELECT `id_event`, `event_name`, `event_time`, `event_date`, `guest_name`, `guest_surname` FROM events ";
                        $sql .= " INNER JOIN guests ON events.id_guest = guests.id_guests ";
                        $sql .= " AND id_cat_event = 1 LIMIT 2 ";
                        $result = $conn->query($sql);
                    }
                    catch (Exception $e) {
                        echo $e->getMessage();
                    } ?>

                    <div id="talleres" class="info-course">
                        <?php $i = 0;
                        while($events = $result->fetch_assoc() ) { ?>

                                <div class="details-event <?php if($i == 0) echo("bord-bot"); ?>">
                                    <h3><?php echo($events['event_name']); ?></h3>
                                    <p><i class="far fa-clock"></i><?php echo($events['event_time']); ?> hrs</p>
                                    <p><i class="far fa-calendar-alt"></i><?php echo($events['event_date']); ?></p>
                                    <p><i class="fas fa-user"></i><?php echo($events['guest_name'] . " " . $events['guest_surname']); ?></p>
                                </div>
                            
                            <?php $i++; ?>
                        <?php } ?>
                    </div>
                    
                    <?php 
                    try {
                        $sql = " SELECT `id_event`, `event_name`, `event_time`, `event_date`, `guest_name`, `guest_surname` FROM events ";
                        $sql .= " INNER JOIN guests ON events.id_guest = guests.id_guests ";
                        $sql .= " AND id_cat_event = 2 LIMIT 2 ";
                        $result = $conn->query($sql);
                    }
                    catch (Exception $e) {
                        echo $e->getMessage();
                    } ?>

                    
                    <div id="conferencias" class="info-course">
                        <?php
                        while($events = $result->fetch_assoc() ) { ?>

                                <div class="details-event <?php if($i == 0) echo("bord-bot"); ?>">
                                    <h3><?php echo($events['event_name']); ?></h3>
                                    <p><i class="far fa-clock"></i><?php echo($events['event_time']); ?> hrs</p>
                                    <p><i class="far fa-calendar-alt"></i><?php echo($events['event_date']); ?></p>
                                    <p><i class="fas fa-user"></i><?php echo($events['guest_name'] . " " . $events['guest_surname']); ?></p>
                                </div>
                        
                            <?php $i++; ?>
                        <?php } ?>
                    </div>

                    
                    <?php 
                    try {
                        $sql = " SELECT `id_event`, `event_name`, `event_time`, `event_date`, `guest_name`, `guest_surname` FROM events ";
                        $sql .= " INNER JOIN category_event ON events.id_cat_event = category_event.id_category ";
                        $sql .= " INNER JOIN guests ON events.id_guest = guests.id_guests ";
                        $sql .= " AND id_cat_event = 3 LIMIT 2 ";
                        $result = $conn->query($sql);
                    }
                    catch (Exception $e) {
                        echo $e->getMessage();
                    } ?>


                    <div id="seminarios" class="info-course">
                        <?php $i = 0;
                        while($events = $result->fetch_assoc() ) { ?>

                                <div class="details-event <?php if($i == 0) echo("bord-bot"); ?>">
                                    <h3><?php echo($events['event_name']); ?></h3>
                                    <p><i class="far fa-clock"></i><?php echo($events['event_time']); ?> hrs</p>
                                    <p><i class="far fa-calendar-alt"></i><?php echo($events['event_date']); ?></p>
                                    <p><i class="fas fa-user"></i><?php echo($events['guest_name'] . " " . $events['guest_surname']); ?></p>
                                </div>

                            <?php $i++; ?>
                        <?php } ?>
                    </div>

                    <div class="button-event">
                        <a href="calendario.php" class="button">Ver Todos</a>
                    </div>

                    

                </div><!-- .program-event -->
            </div><!-- .container -->
        </div><!-- .program-content -->
    </section><!-- .program -->

    <?php include_once 'includes/templates/guests.php'; ?>
    
    <section class="accountant parallax">
        <div class="container">
            <ul class="summary-event">
                <li><p class="number">6</p> Invitados</li>
                <li><p class="number">15</p> Talleres</li>
                <li><p class="number">3</p> Días</li>
                <li><p class="number">9</p> Conferencias</li>
            </ul>
        </div>
    </section>

    <section class="price section container">
        <h2>Precios</h2>

        <ul class="price-list container">
            <li>
                <div class="price-table">
                    <h3>Pase por Día</h3>
                    <p class="number">$30</p>
                    <ul class="ticks">
                        <li>Bocadillos Gratis</li>
                        <li>Todas las Conferencias</li>
                        <li>Todos los Talleres</li>
                    </ul>
                    <a href="#" class="button button-price hollow">Comprar</a>
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
                    <a href="#" class="button button-price">Comprar</a>
                </div>
            </li>

            <li>
                <div class="price-table">
                    <h3>Pase por 2 Días</h3>
                    <p class="number">$45</p>
                    <ul class="ticks">
                        <li>Bocadillos Gratis</li>
                        <li>Todas las Conferencias</li>
                        <li>Todos los Talleres</li>
                    </ul>
                    <a href="#" class="button button-price hollow">Comprar</a>
                </div>
            </li>
        </ul><!-- .price-list .container -->
    </section>

    <div class="map">
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3272.037334385111!2d-56.187031685041866!3d-34.90551258103525!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zMzTCsDU0JzE5LjkiUyA1NsKwMTEnMDUuNCJX!5e0!3m2!1ses!2suy!4v1600965156908!5m2!1ses!2suy" title="Mapa GdlWebCamp" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
    </div>
    

    <section class="section container">
        <h2>Testimoniales</h2>

        <div class="testimonial-grid">
            <div class="testimonial t1">
                <blockquote>
                    <header class="clearfix">
                        <img src="img/testimonial.jpg" alt="Imagen Testimonial">
                        <cite>Oswaldo Aponte Escobedo <span>Diseñador de Oprisma</span></cite>
                    </header>
                    <p>Nunc sagittis vitae ex et accumsan. Integer accumsan nec felis ac pulvinar. Phasellus eget posuere ipsum, sed gravida
                    est. Proin condimentum, nec finibus lacus arcu vel neque.</p>
                </bl    ockquote>
            </div><!-- .testimonial -->

            <div class="testimonial t2">
                <blockquote>
                    <header class="clearfix">
                        <img src="img/testimonial.jpg" alt="Imagen Testimonial">
                        <cite>Oswaldo Aponte Escobedo <span>Diseñador de Oprisma</span></cite>
                    </header>
                    <p>Nunc sagittis vitae ex et accumsan. Integer accumsan nec felis ac pulvinar. Phasellus eget posuere ipsum, sed gravida
                    est. Proin condimentum, nec finibus lacus arcu vel neque.</p>
                </blockquote>
            </div><!-- .testimonial -->

            <div class="testimonial t3">
                <blockquote>
                    <header class="clearfix">
                        <img src="img/testimonial.jpg" alt="Imagen Testimonial">
                        <cite>Oswaldo Aponte Escobedo <span>Diseñador de Oprisma</span></cite>
                    </header>
                    <p>Nunc sagittis vitae ex et accumsan. Integer accumsan nec felis ac pulvinar. Phasellus eget posuere ipsum, sed gravida
                    est. Proin condimentum, nec finibus lacus arcu vel neque.</p>  
                </blockquote>
            </div><!-- .testimonial -->
        </div><!-- .testimonial-grid -->
    </section>

    <section class="newsletter parallax">
        <div class="content-news container section">
            <p>Registrate al Newsletter</p>
            <h3>GdlWebCamp</h3>
            <a href="" class="button transparent">Registro</a>
        </div>
    </section>

    <section class="countdown container section">
        <h2>Faltan</h2>
        <ul>
            <li><p id="days" class="number"></p>Días</li>
            <li><p id="hours" class="number"></p>Horas</li>
            <li><p id="minutes" class="number"></p>Minutos</li>
            <li><p id="seconds" class="number"></p>Segundos</li>
        </ul>
    </section>

<?php include_once 'includes/templates/footer.php'; ?>