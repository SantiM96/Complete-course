<?php

if(isset($_POST['action'])) {
    $action = $_POST['action'];

    require_once '../includes/functions/conection.php';


    if($action === "create") {
        $category_name = $_POST['categoryName'];
        $category_icon = $_POST['categoryIcon'];


        try {
            $stmt = $conn->prepare("INSERT INTO category_event (category, icon) VALUES (?, ?)");
            $stmt->bind_param('ss', $category_name, $category_icon);
            $stmt->execute();

            if($stmt->affected_rows > 0) {
                $answer = array(
                    'answer' => 'success',
                    'category_name' => $category_name,
                    'category_icon' => $category_icon
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
        $category_name = $_POST['categoryName'];
        $category_icon = $_POST['categoryIcon'];
        $category_id = (int)$_POST['categoryId'];

        
        try {
            $stmt = $conn->prepare(" UPDATE category_event SET category=?, icon=? WHERE id_category=? ");
            $stmt->bind_param('ssi', $category_name, $category_icon, $category_id);
            $stmt->execute();

            if($stmt->affected_rows > 0) {
                $answer = array(
                    'answer' => 'success',
                    'category_name' => $category_name,
                    'category_icon' => $category_icon,
                    'id_edited' => $category_id
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

    if($action === "delete") {
        $id_delete = (int)$_POST['idToDelete'];


        try {
            $stmt = $conn->prepare("DELETE FROM category_event WHERE id_category = ?");
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
                    'error' => 'event_exist'
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


}
else {
    die("error");
}