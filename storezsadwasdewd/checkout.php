<?php

require 'start.php';

if(!isset($_POST["item"]) || !isset($_POST["price"])){
	die("Define Prodcuts");
}

$itemx = strval($_POST["item"]);
$price = intval($_POST["price"]);

$payer = new \PayPal\Api\Payer();
$payer->setPaymentMethod('paypal');

$item = new \PayPal\Api\Item();
$item->setName($itemx)->setCurrency('USD')->setQuantity(1)->setPrice($price);

$itemList = new \PayPal\Api\ItemList();
$itemList->setItems([$item]);

// $details = new \PayPal\Api\Details();
// $details->setSubtotal($price);

$amount = new \PayPal\Api\Amount();
$amount->setTotal($price);
$amount->setCurrency('USD');

$transaction = new \PayPal\Api\Transaction();
$transaction->setAmount($amount)->setItemList($itemList)->setDescription("Test For Pay")->setInvoiceNumber(uniqid());

$redirectUrls = new \PayPal\Api\RedirectUrls();
$redirectUrls->setReturnUrl("https://panel.q-z.us/store/pay?success=true")
    ->setCancelUrl("https://panel.q-z.us/store/pay?success=false");

$payment = new \PayPal\Api\Payment();
$payment->setIntent('sale')
    ->setPayer($payer)
    ->setTransactions(array($transaction))
    ->setRedirectUrls($redirectUrls);
	

try {
	$payment->create($apiContext);
}catch(Exception $e){
	die($e);
}
	
$approvalurl = $payment->getApprovalLink();
header("Location: $approvalurl");

?>