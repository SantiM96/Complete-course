<?php 
    $name = $_POST['name'];
    $surname = $_POST['surname'];
    $email = $_POST['email'];
    $register_event = $_POST['register'];
    $gift = $_POST['gift'];
    $date = date('y-m-d // H:i:s');
    $total_amount = $_POST['total_amount'];
    if($gift == "pulsera") $gift = 1;
    if($gift == "etiqueta") $gift = 2;
    if($gift == "pluma") $gift = 3;
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
        $stmt->bind_param("ssssssis", $name, $surname, $email, $date, $json_order, $json_events, $gift, $total_amount);
        $stmt->execute();
        $stmt->close();
        $conn->close();
        header("Location: validate_register.php");
    }
    catch (\Exeption $e) {
        echo $e->getMessage();
    }
?>
<?php include_once 'includes/templates/header.php'; ?>
<section class="section container">
    <h2>Resumen Registro</h2>

    
    <?php /*if(isset($_GET['success'])) { 
        if($_GET['success'] == "1") { ?>
            <p>Registro Exitoso</p>
        <?php }
    } */?>


    <?php /*
    <div class="consult-dates">
        <ul>
            <li>Nombre: <span><?php echo $name; ?></span></li>
            <li>Apellido: <span><?php echo $surname; ?></span></li>
            <li>Email: <span><?php echo $email; ?></span></li>
            <li>Camisas: <span><?php echo $shirts; ?></span></li>
            <li>Etiquetas: <span><?php echo $labels; ?></span></li>
            <li>ID_Regalo: <span><?php echo $gift; ?></span></li>
            <li>Fecha: <span><?php echo $date; ?></span></li>
            <li>Total: <span class="total-validate"><?php echo $total_amount; ?></span></li>
        </ul>
    </div>
    */ ?>

    <?php /*
    <pre style="font-size: 1.3rem">
        <?php var_dump($_POST); ?>
    </pre>
    */ ?>
</section>

<?php include_once 'includes/templates/footer.php'; ?>