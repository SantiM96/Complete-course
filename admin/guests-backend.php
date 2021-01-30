<?php

if(isset($_POST['action'])) {
    $action = $_POST['action'];

    require_once '../includes/functions/conection.php';
    date_default_timezone_set('America/Montevideo');
    $date = date("d-m-Y // G:i:s");


    if($action === "create") {
        $name_guest = $_POST['guests-name'];
        $surname_guest = $_POST['guests-surname'];
        $biography_guest = $_POST['guests-biography'];


        $url_image_guest = $_FILES['guest-file']['name'];
        $typeFile = strtolower(pathinfo($url_image_guest, PATHINFO_EXTENSION));
        
        if($typeFile == "jpg" || $typeFile == "jpeg" || $typeFile == "png" || $typeFile == "gif") {
            //check if there is a directory
            $directory = "../img/guests/";
            if(!is_dir($directory)) {
                mkdir($directory, 0755, ture);
            }
       
            try {
                $stmt = $conn->prepare("INSERT INTO guests (guest_name, guest_surname, description, url_image, date) VALUES (?, ?, ?, ?, ?)");
                $stmt->bind_param('sssss', $name_guest, $surname_guest, $biography_guest, $url_image_guest, $date);
                $stmt->execute();
                if($stmt->affected_rows > 0) {
                    $inserted_id = $stmt->insert_id;
                    $image_name = "guest" . $inserted_id . "." . $typeFile;
                    $image_name_url = $directory . $image_name;

                    //move the file from the temporary directory, to the assigned directory and change name in BD
                    if(move_uploaded_file($_FILES['guest-file']['tmp_name'], $image_name_url)) {
                        try {
                            $stmt_two = $conn->prepare("UPDATE guests SET url_image = ? WHERE id_guests = ?");
                            $stmt_two->bind_param('si', $image_name, $inserted_id);
                            $stmt_two->execute();
                
                            if($stmt_two->affected_rows > 0) {
                                $answer = array(
                                    'answer' => 'success',
                                    'name_guest' => $name_guest,
                                    'surname_guest' => $surname_guest,
                                    'biography_guest' => $biography_guest,
                                    'id_inserted' => $inserted_id,
                                    'image_name_url' => $image_name_url,
                                    'image_name' => $image_name,
                                    'date' => $date
                                );
                            }
                            else {
                                try {
                                    $stmt_two = $conn->prepare("DELETE FROM guests WHERE id_guests = ?");
                                    $stmt_two->bind_param('i', $inserted_id);
                                    $stmt_two->execute();
                        
                                    if($stmt_two->affected_rows > 0) {
                                        $answer = array(
                                            'answer' => 'error',
                                            'error' => 'no_change_name',
                                            'error_sv' => error_get_last()
                                        );
                                    }
                                }
                                catch (Exception $e) {
                                    $answer = array(
                                        'answer' => 'error',
                                        'error' => $e->getMessage()
                                    );
                                }
                            }
                        }
                        catch (Exception $e) {
                            $answer = array(
                                'answer' => 'error',
                                'error' => $e->getMessage()
                            );
                        }  
                    }
                    else {
                        try {
                            $stmt_two = $conn->prepare("DELETE FROM guests WHERE id_guests = ?");
                            $stmt_two->bind_param('i', $inserted_id);
                            $stmt_two->execute();
                
                            if($stmt_two->affected_rows > 0) {
                                $answer = array(
                                    'answer' => 'error',
                                    'error' => 'no_move',
                                    'error_sv' => error_get_last()
                                );
                            }
                        }
                        catch (Exception $e) {
                            $answer = array(
                                'answer' => 'error',
                                'error' => $e->getMessage()
                            );
                        }
                    }   
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
        }
        else {
            $answer = array(
                'answer' => 'error',
                'error' => 'not_image',
                'type' => $typeFile
            );
        }

        echo json_encode($answer);
    }

    if($action === "edit") {
        $id_guest = (int)$_POST['idGuest'];
        $new_name_guest = $_POST['guests-name'];
        $new_surname_guest = $_POST['guests-surname'];
        $new_biography_guest = $_POST['guests-biography'];


        $url_image_guest = $_FILES['guest-file']['name'];
        if ($url_image_guest == "") {
            $typeFile = "not_image";
        }
        else {
            $typeFile = strtolower(pathinfo($url_image_guest, PATHINFO_EXTENSION));
        }
        
        if ($typeFile == "jpg" || $typeFile == "jpeg" || $typeFile == "png" || $typeFile == "gif" || $typeFile == "not_image") {
            
            $old_guest = $conn->query("SELECT * FROM guests WHERE id_guests = $id_guest")->fetch_assoc();
            
            if ($new_name_guest === $old_guest['guest_name'] && $new_surname_guest === $old_guest['guest_surname'] && $new_biography_guest === $old_guest['description'] && $typeFile === "not_image") {
                $answer = array(
                    'answer' => 'error',
                    'error' => 'no_changes'
                );
            }
            else {
                if ($typeFile === "not_image") {
                    //upload without image
                    try {
                        $stmt = $conn->prepare("UPDATE guests SET guest_name = ?, guest_surname = ?, description = ?, date = ? WHERE id_guests = ?");
                        $stmt->bind_param('ssssi', $new_name_guest, $new_surname_guest, $new_biography_guest, $date, $id_guest);
                        $stmt->execute();

                        if($stmt->affected_rows > 0) {
                            $answer = array(
                                'answer' => 'success',
                                'id_guest' => $id_guest,
                                'name_guest' => $new_name_guest,
                                'surname_guest' => $new_surname_guest,
                                'biography_guest' => $new_biography_guest,
                                'date' => $date
                            );
                        }
                        else {
                            $answer = array(
                                'answer' => 'error',
                                'error' => 'not_charge'
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
                }
                else {
                    //upload with image
                    $directory = "../img/guests/";
                    $image_name = "guest" . $id_guest . "." . $typeFile;
                    $image_name_url = $directory . $image_name;
                    $old_image_name_url = $directory . $old_guest['url_image'];

                    //delete old image
                    if (file_exists($old_image_name_url)) {
                        $success = unlink($old_image_name_url);
                        
                        if (!$success) {
                            throw new Exception("Cannot delete $old_image_name_url");
                        }
                    }
                    
                    if(move_uploaded_file($_FILES['guest-file']['tmp_name'], $image_name_url)) {
                        try {
                            $stmt = $conn->prepare("UPDATE guests SET guest_name = ?, guest_surname = ?, description = ?, url_image = ?, date = ? WHERE id_guests = ?");
                            $stmt->bind_param('sssssi', $new_name_guest, $new_surname_guest, $new_biography_guest, $image_name, $date, $id_guest);
                            $stmt->execute();

                            if($stmt->affected_rows > 0) {
                                $answer = array(
                                    'answer' => 'success',
                                    'id_guest' => $id_guest,
                                    'name_guest' => $new_name_guest,
                                    'surname_guest' => $new_surname_guest,
                                    'biography_guest' => $new_biography_guest,
                                    'image' => $image_name_url,
                                    'date' => $date
                                );
                            }
                            else {
                                $answer = array(
                                    'answer' => 'error',
                                    'error' => 'not_charge'
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
                    }
                    else {
                        $answer = array(
                            'answer' => 'error',
                            'error' => 'not_move'
                        );
                    }
                }
            }

        }
        else {
            $answer = array(
                'answer' => 'error',
                'error' => 'not_image',
                'type' => $typeFile
            );
        }

        echo json_encode($answer);
    }

    if($action === "delete") {
        $id_delete = (int)$_POST['idToDelete'];


        $old_guest = $conn->query("SELECT * FROM guests WHERE id_guests = $id_delete")->fetch_assoc();

        $directory = "../img/guests/";
        $old_image_name_url = $directory . $old_guest['url_image'];

        try {
            $stmt = $conn->prepare("DELETE FROM guests WHERE id_guests = ?");
            $stmt->bind_param('i', $id_delete);
            $stmt->execute();

            if($stmt->affected_rows > 0) {

                //delete old image
                if (file_exists($old_image_name_url)) {
                    $success = unlink($old_image_name_url);
                    
                    if (!$success) {
                        throw new Exception("Cannot delete $old_image_name_url");
                    }
                    else {
                        $answer = array(
                            'answer' => 'success',
                            'id_deleted' => $id_delete
                        );
                    }
                }
                else {
                    $answer = array(
                        'answer' => 'error',
                        'error' => 'no_delete_img',
                        'id_deleted' => $id_delete
                    );
                }       
            }
            else {
                $answer = array(
                    'answer' => 'error',
                    'error' => 'event_exist',
                    'id' => $id_delete
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
    die("Error!");
}