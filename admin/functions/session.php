<?php
function authenticate_user() {
    if(!check_user()) {
        header('Location:login.php');
        exit();
    }
}
function check_user() {
    return isset($_SESSION['id_admin']);
}
session_start();
authenticate_user();