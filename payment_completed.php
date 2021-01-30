<?php include_once 'includes/templates/header.php'; ?>

<section class="section container">

    <h2>Pago Finalizado</h2>

    <?php

        $result = $_GET['success'];
        if($result == "true") $paymentId = $_GET['paymentId'];
        $id_user = (int)$_GET['id_user'];
        $payed = 1;

        if($result == "true") {
            echo "<div class='result success'>";
            echo    "<p>El pago se realizó correctamente <br>";
            echo    "ID: {$paymentId}</p>";
            echo "</div>";
            
            try {
                require_once('includes/functions/conection.php');
                $stmt = $conn->prepare("UPDATE registers SET payed = ? WHERE id_user = ?");
                $stmt->bind_param('ii', $payed, $id_user);
                $stmt->execute();
                $stmt->close();
                $conn->close();
            }
            catch(Exception $e) {
                echo $e->getMessage();
            }
        }
        else {
            echo "<div class='result error'>";
            echo    "<p>El pago no se realizó</p>";
            echo "</div>";
        }

    ?>

</section>

<?php include_once 'includes/templates/footer.php'; ?>
