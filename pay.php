<?php

if(!isset($_POST['submit'])) exit("Hubo un error");





use PayPal\Api\Payer;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Details;
use PayPal\Api\Amount;
use PayPal\Api\Transaction;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Payment;


require "includes/paypal.php";


$name = $_POST['name'];
$surname = $_POST['surname'];
$email = $_POST['email'];
$register_event = $_POST['register'];
$gift = $_POST['gift'];
$payed = 0;
$date = date('y-m-d // H:i:s');
$total_amount = $_POST['total_amount'];
if($gift == "pulsera") $id_gift = 1;
if($gift == "etiqueta") $id_gift = 2;
if($gift == "pluma") $id_gift = 3;
//Register
include_once 'includes/functions/functions.php';
$order = $_POST['order'];
$register = $_POST['register'];
$extra = $_POST['extra'];
$shirts = $extra['shirts'];
$labels = $extra['labels'];

$json_order = product_json($order, $shirts, $labels);
$json_events = events_json($register_event);


try {
    require_once('includes/functions/conection.php');
    $stmt = $conn->prepare("INSERT INTO registers (name_user, surname_user, email_user, date_register, articles_pass, packs_register, gift, total_amount, payed) VALUES (?,?,?,?,?,?,?,?,?)");
    $stmt->bind_param("ssssssisi", $name, $surname, $email, $date, $json_order, $json_events, $id_gift, $total_amount, $payed);
    $stmt->execute();
    $id_return = $stmt->insert_id;
    $stmt->close();
    $conn->close();
    //header("Location: validate_register.php?success=1");
}
catch (\Exception $e) {
    echo $e->getMessage();
}


$payer = new Payer();
$payer->setPaymentMethod("paypal");



$i = 0;
$itemListProducts = array();
foreach($order as $key => $value) {
    if((int)$value['quantity'] > 0) {

        ${"item$i"} = new Item();
        $itemListProducts[] = ${"item$i"};
        ${"item$i"}->setName('Pass: ' . $key)
                    ->setCurrency('USD')
                    ->setQuantity((int)$value['quantity'])
                    ->setPrice((int)$value['price']);


        
        /*
        echo ${"item$i"}->getName() . "  ";
        echo ${"item$i"}->getQuantity() . "  ";
        echo ${"item$i"}->getPrice() . "  ";
        echo "<hr>";*/
        $i++;
    }
}

foreach($extra as $key => $value) {
    if((int)$value['quantity'] > 0) {

        if($key == "shirts")    $price = (float)$value['price'] * .93;
        else                    $price = (int)$value['price'];


        ${"item$i"} = new Item();
        $itemListProducts[] = ${"item$i"};
        ${"item$i"}->setName('Extra: ' . $key)
                    ->setCurrency('USD')
                    ->setQuantity((int)$value['quantity'])
                    ->setPrice($price);
        
        /*
        echo ${"item$i"}->getName() . "  ";
        echo ${"item$i"}->getQuantity() . "  ";
        echo ${"item$i"}->getPrice() . "  ";
        echo "<hr>";*/
        $i++;
    }
}


$itemList = new ItemList();
$itemList->setItems($itemListProducts);


$amount = new Amount();
$amount->setCurrency('USD')
       ->setTotal($total_amount);


//echo "Amount" . "<hr>";
//echo $amount->getCurrency() . "-----";
//echo $amount->getTotal() . "-----";
//echo $amount->getDetails() . "<hr>";


$transaction = new Transaction();
$transaction->setAmount($amount)
            ->setItemList($itemList)
            ->setDescription('Pago ')
            ->setInvoiceNumber($id_return);


//echo "Transaction" . "<hr>";
//echo $transaction->getAmount() . "-----";
//echo $transaction->getItemList() . "-----";
//echo $transaction->getDescription() . "-----";
//echo $transaction->getInvoiceNumber() . "<hr>";


$redirect = new RedirectUrls();
$redirect->setReturnUrl(URL_SITE . "/payment_completed.php?success=true&id_user={$id_return}")
        ->setCancelUrl(URL_SITE . "/payment_completed.php?success=false&id_user={$id_return}");


//echo "RedirectUrls" . "<hr>";
//echo $redirect->getReturnUrl() . "-----";
//echo $redirect->getCancelUrl() . "<hr>";

$payment = new Payment();
$payment->setIntent("sale")
        ->setPayer($payer)
        ->setRedirectUrls($redirect)
        ->setTransactions(array($transaction));

//echo $payment->getTransactions();


try {
    $payment->create($apiContext);
}
catch(PayPal\Exception\PayPalConnectionException $pce) {
    echo "Hubo un problema al crear la conexión";
    echo "<pre>";
        print_r(json_decode($pce->getData()));
        exit;
    echo "</pre>";
}



$success = $payment->getApprovalLink();
header("Location: {$success}");
