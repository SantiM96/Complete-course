<?php

if(isset($_POST['action'])) {
    $action = $_POST['action'];

    require_once '../includes/functions/conection.php';
    /*date_default_timezone_set('America/Montevideo');
    $date = date("d-m-Y // G:i:s");*/


    /*if($action === "create") {

    }*/

    /*if($action === "edit") {

    }*/

    /*if($action === "delete") {

    }*/
}
else {
    die("Error!");
}