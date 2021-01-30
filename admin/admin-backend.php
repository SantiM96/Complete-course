<?php

if(isset($_POST['action'])) {
    $action = $_POST['action'];

    require_once '../includes/functions/conection.php';


    if($action === "create") {
        $admin = $_POST['user'];
        $name = $_POST['name'];
        $password = $_POST['password'];
        if($_POST['permission'] === 'true') $permission = 1;
        else $permission = 0;
        if(isset($_POST['owner'])) $permission = 2;

        $options = array(
            'cost' => 12
        );
        $password = password_hash($password, PASSWORD_BCRYPT, $options);


        try {
            $stmt = $conn->prepare("INSERT INTO admins (admin, name, password, level) VALUES (?, ?, ?, ?)");
            $stmt->bind_param('sssi', $admin, $name, $password, $permission);
            $stmt->execute();
    
            if($stmt->affected_rows) {
                $answer = array(
                    'answer' => 'success',
                    'new_admin_user' => $admin,
                    'new_admin_name' => $name,
                    'permission' => $permission
                );
            }
            $stmt->close();
            $conn->close();
        }
        catch(Exception $e) {
            $answer = array(
                'answer' => 'error',
                'error' => $e->getMessage()
            );
        }
        echo json_encode($answer);
    }
    
    if($action === "login") {
        $user = $_POST['user'];
        $password = $_POST['password'];

        try {
            $stmt = $conn->prepare("SELECT * FROM admins WHERE admin = ?");
            $stmt->bind_param('s', $user);
            $stmt->execute();
            $stmt->bind_result($id_admin, $admin, $name, $password_DB, $level);

            $exist = $stmt->fetch();
            if($exist && password_verify($password, $password_DB)) {
                session_start();
                $_SESSION['id_admin'] = $id_admin;
                $_SESSION['user_admin'] = $admin;
                $_SESSION['name_admin'] = $name;
                $_SESSION['level'] = $level;

                $answer = array(
                    'answer' => 'success',
                    'name_admin' => $name
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
        catch(Exception $e) {
            $answer = array(
                'answer' => 'error_catch',
                'error' => $e->getMessage()
            );
        }
        echo json_encode($answer);
    }

    if($action === "edit") {
        session_start();
        $id = (int)$_POST['id'];
        $admin = $_POST['user'];
        $name = $_POST['name'];
        $password = $_POST['password'];
        $level_currently_admin = $_SESSION['level'];
        if($_POST['permission'] === 'true') $permission = 1;
        else $permission = 0;
        if(isset($_POST['owner'])) $permission = 2;

        $admin_sql = ($conn->query("SELECT * FROM admins WHERE id_admin = $id"))->fetch_assoc();
        $admin_db = array(
            'id_admin_db' => $admin_sql['id_admin'],
            'admin_db' => $admin_sql['admin'],
            'name_db' => $admin_sql['name'],
            'level_db' => $admin_sql['level']
        );

        if ($level_currently_admin >= $admin_db['level_db']) {
            if($admin === $admin_db['admin_db'] && $name === $admin_db['name_db'] && $password === "" && $permission === $admin_db['level_db']) {
                $answer = array(
                    'answer' => 'no_changes'
                );
            }
            else {
                if($password !== "") {

                    $options = array(
                        'cost' => 12
                    );
                    $password = password_hash($password, PASSWORD_BCRYPT, $options);

                    try {
                        $stmt = $conn->prepare("UPDATE admins SET admin = ?, name = ?, password = ?, level = ? WHERE id_admin = ?");
                        $stmt->bind_param('sssii', $admin, $name, $password, $permission, $id);
                        $stmt->execute();

                        if($stmt->affected_rows) {
                            $answer = array(
                                'answer' => 'success',
                                'id_currently_admin' => $_SESSION['id_admin'],
                                'level_currently_admin' => $level_currently_admin,
                                'id' => $id,
                                'new_admin' => $admin,
                                'new_name' => $name,
                                'new_permission' => $permission,
                                'password' => 'updated'
                            );
                        }

                        $stmt->close();
                        $conn->close();
                    }
                    catch(Exception $e) {
                        $answer = array(
                            'answer' => 'error',
                            'error' => $e->getMessage()
                        );
                    }
                }
                else {
                    try {
                        $stmt = $conn->prepare("UPDATE admins SET admin = ?, name = ?, level = ? WHERE id_admin = ?");
                        $stmt->bind_param('ssii', $admin, $name, $permission, $id);
                        $stmt->execute();

                        if($stmt->affected_rows) {
                            $answer = array(
                                'answer' => 'success',
                                'id_currently_admin' => $_SESSION['id_admin'],
                                'level_currently_admin' => $level_currently_admin,
                                'id' => $id,
                                'new_admin' => $admin,
                                'new_name' => $name,
                                'new_permission' => $permission
                            );
                        }
                        else {
                            $answer = array(
                                'answer' => 'no_changes',
                                'id' => $id,
                                'new_admin' => $admin,
                                'new_name' => $name,
                                'new_permission' => $permission
                            );
                        }

                        $stmt->close();
                        $conn->close();
                    }
                    catch(Exception $e) {
                        $answer = array(
                            'answer' => 'error',
                            'error' => $e->getMessage()
                        );
                    }

                }
            }
        }
        else {
            $answer = array(
                'answer' => 'error',
                'error' => 'insufficient_permissions'
            );
        }
        echo json_encode($answer);
    }

    if($action === "delete") {
        session_start();
        $id_delete = (int)$_POST['id'];
        $level_delete = (int)$conn->query("SELECT level FROM admins WHERE id_admin = $id_delete")->fetch_assoc()['level'];
        $id_currently_admin = $_SESSION['id_admin'];
        $level_currently_admin = (int)$conn->query("SELECT level FROM admins WHERE id_admin = $id_currently_admin")->fetch_assoc()['level'];


        if($level_currently_admin >= $level_delete) {

            try {
                $stmt = $conn->prepare("DELETE FROM admins WHERE id_admin = ?");
                $stmt->bind_param('i', $id_delete);
                $stmt->execute();

                if($stmt->affected_rows) {
                    $answer = array(
                        'answer' => 'success',
                        'id_deleted' => $id_delete,
                        'level_deleted' => $level_delete,
                        'currently_admin' => $id_currently_admin,
                        'level_currently_admin' => $level_currently_admin
                    );
                }

                $stmt->close();
                $conn->close();
            }
            catch(Exception $e) {
                $answer = array(
                    'answer' => 'error',
                    'error' => $e->getMessage()
                );
            }
        }
        else {
            $answer = array(
                'answer' => 'error',
                'error' => 'insufficient_permissions'
            );
        }
        echo json_encode($answer);
    }

}
else {
    die("error");
}





