<section class="<?php if($page == 'index.php') echo('section-guests '); ?>section container">
        <h2>Nuestros Invitados</h2>

        <?php 
            // link to database
            try {
                require_once('includes/functions/conection.php');
                $sql = " SELECT * FROM guests ";
                $result = $conn->query($sql);
            }
            catch (\Exeption $e) {
                echo $e->getMessage();
            }
        ?>

        <div class="guest-page">
            <ul class="guests-list">
                <?php while($guests = $result->fetch_assoc() ) { ?>
    
                    <li>
                        <div class="guest">
                            <a class="guest-info" href="#guest<?php echo $guests['id_guests']; ?>">
                                <img src="img/<?php echo $guests['url_image']; ?>" alt="<?php echo $guests['url_image']; ?>">
                                <p><?php echo $guests['guest_name'] . " " . $guests['guest_surname']; ?></p>
                            </a>
                        </div>
                    </li>
                    <div style="display:none;">
                        <div class="guest-info" id="guest<?php echo $guests['id_guests']; ?>">
                            <h2><?php echo $guests['guest_name'] . " " . $guests['guest_surname']; ?></h2>
                            <img src="img/<?php echo $guests['url_image']; ?>" alt="<?php echo $guests['url_image']; ?>">
                            <p><?php echo $guests['description']; ?></p>
                        </div>
                    </div>
                    
                <?php } ?>

            </ul><!-- .guests-list -->
        </div><!-- .guest-page -->

        <?php $conn->close(); ?>
 
    </section>