<?php

if(isset($_POST['action'])) {
    $action = $_POST['action'];

    require_once '../includes/functions/conection.php';

    if($action === "create") {
        $event_name = $_POST['eventName'];
        $event_date = date('Y-m-d', strtotime($_POST['eventDate']));
        $event_time = $_POST['eventTime'];
        $event_category = (int)$_POST['eventCategory'];
        $event_guest = (int)$_POST['eventGuest'];
        $pass = "";

        try{
            $stmt = $conn->prepare("INSERT INTO events (event_name, event_date, event_time, id_cat_event, id_guest, pass) VALUES (?, ?, ?, ?, ?, ?)");
            $stmt->bind_param('sssiis', $event_name, $event_date, $event_time, $event_category, $event_guest, $pass);
            $stmt->execute();
            if($stmt->affected_rows > 0) {
                $answer = array(
                    'answer' => 'success',
                    'eventName' => $event_name,
                    'eventDate' => $event_date,
                    'eventTime' => $event_time,
                    'eventCategory' => $event_category,
                    'eventGuest' => $event_guest
                );
            }
            else {
                $answer = array(
                    'answer' => 'error',
                    'error' => 'no_charge'
                );
            }
            $conn->close();
            $stmt->close(); 
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
        $id_event = (int)$_POST['idEvent'];
        $event_name = $_POST['newName'];
        $event_date = date('Y-m-d', strtotime($_POST['newDate']));
        $event_time = $_POST['newTime'];
        $event_category = (int)$_POST['newCategory'];
        $event_guest = (int)$_POST['newGuest'];
        
        try {
            $stmt = $conn->prepare(" UPDATE events SET event_name=?, event_date=?, event_time=?, id_cat_event=?, id_guest=? WHERE id_event=? ");
            $stmt->bind_param('sssiii', $event_name, $event_date, $event_time, $event_category, $event_guest, $id_event);
            $stmt->execute();

            if($stmt->affected_rows > 0) {
                $answer = array(
                    'answer' => 'success',
                    'id_event' => $id_event,
                    'new_event_name' => $event_name,
                    'new_event_date' => $event_date,
                    'new_event_time' => $event_time,
                    'new_event_category' => $event_category,
                    'new_event_guest' => $event_guest
                );
            }
            else {
                $answer = array(
                    'answer' => 'error',
                    'error' => 'no_charge'
                );
            }
            $conn->close();
            $stmt->close(); 
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
        $id_delete = (int)$_POST['idToDelete'];


        try {
            $stmt = $conn->prepare("DELETE FROM events WHERE id_event = ?");
            $stmt->bind_param('i', $id_delete);
            $stmt->execute();

            if($stmt->affected_rows > 0) {
                $answer = array(
                    'answer' => 'success',
                    'id_deleted' => $id_delete
                );
            }
            else {
                $answer = array(
                    'answer' => 'error',
                );
            }
            $conn->close();
            $stmt->close(); 
        }
        catch (Exception $e) {
            $answer = array(
                'answer' => 'error',
                'error' => $e->getMessage()
            );
        }








        echo json_encode($answer);
    }
}
