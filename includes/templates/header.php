<!doctype html>
<html class="no-js" lang="">

<head>
    <meta charset="utf-8">
    <title></title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="/css/mi_estilo.css?v=<?php echo(rand()); ?>" />
    <script src="/js/mi_script.js?v=<?php echo(rand()); ?>"></script>

    <link rel="manifest" href="site.webmanifest">
    <link rel="apple-touch-icon" href="icon.png">
    <!-- Place favicon.ico in the root directory -->

    <script src="https://kit.fontawesome.com/ff57233ed3.js" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,600;0,700;0,800;1,300;1,400;1,600;1,700&family=Oswald:wght@200;300;400;500;600;700&family=PT+Sans:ital,wght@0,400;0,700;1,400;1,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.6.0/dist/leaflet.css" />
    <?php 
        $page = basename($_SERVER{'PHP_SELF'});
        if ($page == 'invitados.php' || $page == 'index.php') {
            echo '<link rel="stylesheet" href="css/colorbox.css">';
        }
        else if ($page == 'conferencia.php') {
            echo '<link rel="stylesheet" href="css/lightbox.css">';
        }
    ?>
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/main.css">

    <meta name="theme-color" content="#fafafa">
</head>

<body class="<?php echo (str_replace('.php', '', $page)); ?>">

    <header class="site-header">
        <div class="hero">
            <div class="header-content">
                <nav class="social-networks">
                    <a href="#"><i class="fab fa-facebook-f"></i></a>
                    <a href="#"><i class="fab fa-twitter"></i></a>
                    <a href="#"><i class="fab fa-pinterest-p"></i></a>
                    <a href="#"><i class="fab fa-youtube"></i></a>
                    <a href="#"><i class="fab fa-instagram"></i></a>
                </nav>
                <div class="hero-text">
                    <div class="event-info">
                        <p class="date"><i class="far fa-calendar-alt"></i> 10-12 Dic</p>
                        <p class="city"><i class="fas fa-map-marker-alt"></i> Montevideo, UYU</p>
                    </div>
                    <h1>GdlWebCamp</h1>
                    <p class="slogan">La mejor conferencia de <span>diseño web</span></p>
                </div>
            </div><!-- .header-content -->
        </div><!-- .hero -->
    </header>

    <div class="bar clearfix">
        <div class="container flex-bar">
            <div class="logo-bar">
                <a href="index.php">
                    <img src="img/logo.svg" alt="Logo GdlWebCamp">
                </a>
            </div>
            <div class="mobile-menu">
                <span></span>
                <span></span>
                <span></span>
            </div>
            <nav class="main-nav">
                <a href="conferencia.php">Conferencia</a>
                <a href="calendario.php">Calendario</a>
                <a href="invitados.php">Invitados</a>
                <a href="registro.php">Reservaciones</a>
            </nav>
        </div><!-- .container .flex-bar -->
    </div><!-- .bar -->