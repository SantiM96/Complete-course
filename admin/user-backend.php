<?php

if(isset($_POST['action'])) {
    $action = $_POST['action'];

    require_once '../includes/functions/conection.php';
    date_default_timezone_set('America/Montevideo');
    $date = date('Y-m-d H:i:s');


    if($action === "create") {
        $name_user = $_POST['name_user'];
        $surname_user = $_POST['surname_user'];
        $email_user = $_POST['email_user'];
        $articles = $_POST['articles'];
        $events = $_POST['events'];
        $gift = (int)$_POST['gift'];
        $total = $_POST['total'];
        $payed = 0;

        try {
            $stmt = $conn->prepare("INSERT INTO registers (name_user, surname_user, email_user, date_register, articles_pass, packs_register, gift, total_amount, payed) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param('ssssssisi', $name_user, $surname_user, $email_user, $date, $articles, $events, $gift, $total, $payed);
            $stmt->execute();

            if($stmt->affected_rows > 0) {
                $answer = array(
                    'answer' => 'success',
                    'name_user' => $name_user,
                    'surname_user' => $surname_user,
                    'email_user' => $email_user,
                    'articles' => $articles,
                    'events' => $events,
                    'total' => $total
                );
            }
            else {
                $answer = array(
                    'answer' => 'error'
                );
            }

            $stmt->close();
            $conn->close();
        }
        catch (Exception $e) {
            $answer = array(
                'answer' => 'error',
                'error' => $e->getMessage()
            );
        }

        echo json_encode($answer);
    }

    if($action === "edit") {
        $id_user = (int)$_POST['idUser'];
        $name_user = $_POST['nameUser'];
        $surname_user = $_POST['surnameUser'];
        $email_user = $_POST['emailUser'];
        $articles = $_POST['passUserJson'];
        $events = $_POST['eventsUserJson'];
        $gift = (int)$_POST['gift'];
        $total = $_POST['price'];
        $difference = $_POST['difference'];
        $payed = 0;
        $mark_payed = $_POST['markPayed'];
        $mark_unpayed = $_POST['markUnpayed'];

        $payed_bd = $conn->query("SELECT registers.payed, registers.total_amount FROM registers WHERE id_user = $id_user")->fetch_assoc();


        if ($mark_unpayed != "true") {
            if ($mark_payed != "true") {
                //Calculate new amount and reformat the string with the difference if is necesary
                if ($payed_bd['total_amount'] == $total) $total = $payed_bd['total_amount'];
                else if ($payed_bd['payed'] == 1 && !strstr($payed_bd['total_amount'], 'debe')) {
                    $total = $total . " (debe sólo " . $difference . ")";
                    if ($difference <= 0) $payed = 1;
                }
                else if(strstr($payed_bd['total_amount'], 'debe')) {
                    $difference_old = substr(strstr(strstr($payed_bd['total_amount'], ')', true), 'o'), 2);
                    $difference = (float)$difference_old + (float)$difference;
                    if ($difference != 0) $total = $total . " (debe sólo " . $difference . ")";
                    if ($difference <= 0) $payed = 1;
                }
            }
            else {
                $payed = 1;
            }
        }

        try {
            $stmt = $conn->prepare("UPDATE registers SET name_user = ?, surname_user = ?, email_user = ?, articles_pass = ?, packs_register = ?, gift = ?, total_amount = ?, payed = ? WHERE id_user = ?");
            $stmt->bind_param('sssssisii', $name_user, $surname_user, $email_user, $articles, $events, $gift, $total, $payed, $id_user);
            $stmt->execute();

            if($stmt->affected_rows > 0) {
                $answer = array(
                    'answer' => 'success',
                    'name_user' => $name_user,
                    'surname_user' => $surname_user,
                    'email_user' => $email_user,
                    'articles' => $articles,
                    'events' => $events,
                    'gift' => $gift,
                    'total' => $total,
                    'difference' => $difference,
                    'mark_payed' => $mark_payed,
                    'mark_unpayed' => $mark_unpayed
                );
            }
            else {
                $answer = array(
                    'answer' => 'error'
                );
            }
        }
        catch (Exception $e) {
            $answer = array(
                'answer' => 'error',
                'error' => $e->getMessage()
            );
        }


        echo json_encode($answer);
    }

    if($action === "delete") {
        $id = (int)$_POST['id'];

        $user = $conn->query("SELECT * FROM registers WHERE id_user = $id")->fetch_assoc();

        $total = $user['total_amount'];

        $answer = array(
            'answer' => 'not_payed'
        );

        if ($user['payed'] == 0){
            if(strstr($total, 'debe')){
                $answer = array(
                    'answer' => 'error',
                    'error' => 'something_paid'
                );
            }
            else {
                $stmt = $conn->prepare("DELETE FROM registers WHERE id_user = ?");
                $stmt->bind_param('i', $id);
                $stmt->execute();

                if($stmt->affected_rows > 0) {
                    $answer = array(
                        'answer' => 'success',
                        'name' => $user['name_user'] . " " . $user['surname_user']
                    );
                }
                else {
                    $answer = array(
                        'answer' => 'error',
                        'error' => 'could_not_modify_DB'
                    );
                }

                $stmt->close();
                $conn->close();
            }
        }
        else {
            $answer = array(
                'answer' => 'error',
                'error' => 'something_paid'
            );
        }
        

        echo json_encode($answer);
    }
}
else {
    die("Error!");
}