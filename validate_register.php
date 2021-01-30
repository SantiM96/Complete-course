<?php if(isset($_POST['submit'])):
    $name = $_POST['name'];
    $surname = $_POST['surname'];
    $email = $_POST['email'];
    $register_event = $_POST['register'];
    $gift = $_POST['gift'];
    $date = date('y-m-d // H:i:s');
    $total_amount = $_POST['total_amount'];
    if($gift == "pulsera") $id_gift = 1;
    if($gift == "etiqueta") $id_gift = 2;
    if($gift == "pluma") $id_gift = 3;
    //Register
    include_once 'includes/functions/functions.php';
    $order = $_POST['number-order'];
    $shirts = $_POST['shirts'];
    $labels = $_POST['labels'];
    $json_order = product_json($order, $shirts, $labels);
    $json_events = events_json($register_event);
    try {
        require_once('includes/functions/conection.php');
        $stmt = $conn->prepare("INSERT INTO registers (name_user, surname_user, email_user, date_register, articles_pass, packs_register, gift, total_amount) VALUES (?,?,?,?,?,?,?,?)");
        $stmt->bind_param("ssssssis", $name, $surname, $email, $date, $json_order, $json_events, $id_gift, $total_amount);
        $stmt->execute();
        $stmt->close();
        $conn->close();
        header("Location: validate_register.php?success=1");
    }
    catch (\Exeption $e) {
        echo $e->getMessage();
    }
endif; ?>
<?php include_once 'includes/templates/header.php'; ?>
<section class="section container">
    <h2>Resumen Registro</h2>

    <?php if(isset($_GET['success'])) { 
        if($_GET['success'] == "1") { ?>
            <p class="total-validate">Registro Exitoso</p>
        <?php }
    } ?>

    <?php /*
    <pre style="font-size: 1.3rem">
        <?php var_dump($_POST); ?>
    </pre>
    */ ?>
</section>

<?php include_once 'includes/templates/footer.php'; ?>