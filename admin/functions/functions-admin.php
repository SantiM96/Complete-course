<?php
function currentlyPage() {
    $serverName = basename($_SERVER['PHP_SELF']);
    $pageName = str_replace(".php", "", $serverName);

    return $pageName;
}
function get_difference($total) {
    return (float)substr(strstr(strstr($total, ')', true), 'o'), 2);
}
function get_total($total) {
    return (float)strstr($total, ' ', true);
}
function count_gift($id_gift) {
    include_once dirname(dirname( __DIR__ )) . "includes/functions/conection.php";
    //$gift_all = $conn->query("SELECT * FROM registers WHERE gift = $id_gift")->fetch_assoc();
    $total_paid = 0;
    

    return dirname(dirname( __DIR__ ));
}




