<footer class="main-footer">
        <section class="container">
            <div class="about-footer">
                <h3>Sobre <span>GdlWebCamp</span></h3>
                <p>Aliquam ipsum ex, tempus ut quam sollicitudin, viverra feugiat mauris. Pellentesque dictum convallis ipsum, sed blandit
                tortor sodales id. Morbi gravida quam ut magna euismod, sed bibendum enim porttitor. Duis et nisl quis diam tincidunt
                iaculis. Cras congue arcu sed erat tempor feugiat.</p>
            </div>
            <div class="last-tweets">
                <h3>Últimos <span>Tweets</span></h3>
                <p>Pellentesque vel lorem tristique, suscipit urna in, sodales sem. Donec dolor velit, pulvinar vel libero quis, tempus
                interdum tellus.</p>
                <p>Pellentesque vel lorem tristique, suscipit urna in, sodales sem. Donec dolor velit, pulvinar vel libero quis, tempus
                interdum tellus.</p>
                <p>Pellentesque vel lorem tristique, suscipit urna in, sodales sem. Donec dolor velit, pulvinar vel libero quis, tempus
                interdum tellus.</p>
            </div>
            <div>
                <h3>Redes <span>Sociales</span></h3>
                <nav class="social-networks sn-footer">
                    <a href="#"><i class="fab fa-facebook-f"></i></a>
                    <a href="#"><i class="fab fa-twitter"></i></a>
                    <a href="#"><i class="fab fa-pinterest-p"></i></a>
                    <a href="#"><i class="fab fa-youtube"></i></a>
                    <a href="#"><i class="fab fa-instagram"></i></a>
                </nav>
            </div>
        </section>
        <p class="copyright">Todos los derechos Reservados GDLWEBCAMP 2020.</p>
    </footer>



    <!-- End-HTML-Code -->
    <!-- Sweetalert2 -->
    <script src="js/sweetalert2.min.js"></script>
    
    <script src="js/vendor/modernizr-3.8.0.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <script>window.jQuery || document.write('<script src="js/vendor/jquery-3.4.1.min.js"><\/script>')</script>
    <script src="js/plugins.js"></script>
    <script src="js/jquery.animateNumber.min.js"></script>
    <script src="js/jquery.countdown.min.js"></script>
    <script src="js/jquery.lettering.js"></script>
    <?php 
        $page = basename($_SERVER{'PHP_SELF'});
        if ($page == 'invitados.php' || $page == 'index.php') {
            echo '<script src="js/jquery.colorbox-min.js"></script>';
        }
        else if ($page == 'conferencia.php') {
            echo '<script src="js/lightbox.min.js"></script>';
        }
    ?>
    
    <script src="js/quotation.js"></script>
    <script src="https://unpkg.com/leaflet@1.6.0/dist/leaflet.js"></script>
    <script src="js/main.js"></script>

    <!-- Google Analytics: change UA-XXXXX-Y to be your site's ID. -->
    <script>
        window.ga = function () { ga.q.push(arguments) }; ga.q = []; ga.l = +new Date;
        ga('create', 'UA-XXXXX-Y', 'auto'); ga('set','transport','beacon'); ga('send', 'pageview')
    </script>
    <script src="https://www.google-analytics.com/analytics.js" async></script>
    <?php
        // Guarda todo el contenido a un archivo
        $fp = fopen($archivoCache, 'w');
        fwrite($fp, ob_get_contents());
        fclose($fp);
        // Enviar al navegador
        ob_end_flush();
    ?>
</body>
</html>
