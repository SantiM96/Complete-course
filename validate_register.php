<?php include_once 'includes/templates/header.php'; ?>

<section class="section container">
    <h2>Resumen Registro</h2>
    <?php if(isset($_GET['success'])) { 
        if($_GET['success'] == "1") { ?>
            <p class="total-validate">Registro Exitoso</p>
        <?php }
    } ?>
</section>

<?php include_once 'includes/templates/footer.php'; ?>