<?php
ob_start();
require 'config/phphead.php';
require_once('includes/header.php');
require_once('includes/topbar.php');
require_once('includes/sidebar.php');
require 'storezsadwasdewd/start.php';

$host = "127.0.0.1";
$user = "root";
$pass = "qvaGN6vy9EaZMw5l";
$db = "Rankqz";
$con = new mysqli($host, $user, $pass, $db);
$cldbid = $client_info["client_database_id"];
$sql = "SELECT coins FROM user WHERE cldbid='$cldbid' LIMIT 1";
$res = $con->query($sql)->fetch_assoc()["coins"];
if(!empty($res)){
	$coins = $res;
}else{
	$coins = 0;
}

$x = strval(getclientip());


if(isset($_POST["500c"])){
	
	$itemx = "500 Coins";
	$price = 1;
	
	$payer = new \PayPal\Api\Payer();
	$payer->setPaymentMethod('paypal');
	$item = new \PayPal\Api\Item();
	$item->setName($itemx)->setCurrency('USD')->setQuantity(1)->setPrice($price);
	$itemList = new \PayPal\Api\ItemList();
	$itemList->setItems([$item]);
	$amount = new \PayPal\Api\Amount();
	$amount->setTotal($price);
	$amount->setCurrency('USD');
	$transaction = new \PayPal\Api\Transaction();
	$transaction->setAmount($amount)->setItemList($itemList)->setDescription("Qz - 500 Coins")->setInvoiceNumber(uniqid());
	$redirectUrls = new \PayPal\Api\RedirectUrls();
	$redirectUrls->setReturnUrl("https://panel.q-z.us/pay?success=true")
		->setCancelUrl("https://panel.q-z.us/pay?success=false");
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
	
	$payid = strval($payment->getId());
	$rank = 500;
	$buytime = time();
	$sql = "INSERT INTO store_coins (id, payment, buyer, value, buytime, ip,status) VALUES (NULL, '$payid','$dbid','$rank','$buytime','$x','0')";
	if($con->query($sql) === false){
die('<script>
           swal({title: "خطاء",text: "تعذر عملية الشراء",type: "error",allowOutsideClick: false,allowEscapeKey: false,showCloseButton: false,confirmButtonText: "حسنأ",})</script>');
	}

	
	// die("<br/><br/><br/><br/><br/><br/><br/><center> <h1> Payment Id: ".$payment->getId()." </h1> </center><br/><br/><br/><br/><br/><br/><br/>");
	$approvalurl = $payment->getApprovalLink();
	exit(header("Location: $approvalurl"));
}else if(isset($_POST["1000c"])){
	
	$itemx = "1000 Coins";
	$price = 1.5;
	
	$payer = new \PayPal\Api\Payer();
	$payer->setPaymentMethod('paypal');
	$item = new \PayPal\Api\Item();
	$item->setName($itemx)->setCurrency('USD')->setQuantity(1)->setPrice($price);
	$itemList = new \PayPal\Api\ItemList();
	$itemList->setItems([$item]);
	$amount = new \PayPal\Api\Amount();
	$amount->setTotal($price);
	$amount->setCurrency('USD');
	$transaction = new \PayPal\Api\Transaction();
	$transaction->setAmount($amount)->setItemList($itemList)->setDescription("Qz - 1000 Coins")->setInvoiceNumber(uniqid());
	$redirectUrls = new \PayPal\Api\RedirectUrls();
	$redirectUrls->setReturnUrl("https://panel.q-z.us/pay?success=true")
		->setCancelUrl("https://panel.q-z.us/pay?success=false");
	$payment = new \PayPal\Api\Payment();
	$payment->setIntent('sale')
		->setPayer($payer)
		->setTransactions(array($transaction))
		->setRedirectUrls($redirectUrls);
	try {
		$payment->create($apiContext);
	}catch(Exception $e){
			die('<script>
           swal({title: "خطاء",text: "فشل عملية الشراء",type: "error",allowOutsideClick: false,allowEscapeKey: false,showCloseButton: false,confirmButtonText: "حسنأ",})</script>');
	}
	$payid = strval($payment->getId());
	$rank = 1000;
	$buytime = time();
	$sql = "INSERT INTO store_coins (id, payment, buyer, value, buytime, ip,status) VALUES (NULL, '$payid','$dbid','$rank','$buytime','$x','0')";
	if($con->query($sql) === false){
die('<script>
           swal({title: "خطاء",text: "تعذر عملية الشراء",type: "error",allowOutsideClick: false,allowEscapeKey: false,showCloseButton: false,confirmButtonText: "حسنأ",})</script>');
	}
	
	$approvalurl = $payment->getApprovalLink();
	exit(header("Location: $approvalurl"));
}else if(isset($_POST["2000c"])){
	
	$itemx = "2000 Coins";
	$price = 3;
	
	$payer = new \PayPal\Api\Payer();
	$payer->setPaymentMethod('paypal');
	$item = new \PayPal\Api\Item();
	$item->setName($itemx)->setCurrency('USD')->setQuantity(1)->setPrice($price);
	$itemList = new \PayPal\Api\ItemList();
	$itemList->setItems([$item]);
	$amount = new \PayPal\Api\Amount();
	$amount->setTotal($price);
	$amount->setCurrency('USD');
	$transaction = new \PayPal\Api\Transaction();
	$transaction->setAmount($amount)->setItemList($itemList)->setDescription("Qz - 2000 Coins")->setInvoiceNumber(uniqid());
	$redirectUrls = new \PayPal\Api\RedirectUrls();
	$redirectUrls->setReturnUrl("https://panel.q-z.us/pay?success=true")
		->setCancelUrl("https://panel.q-z.us/pay?success=false");
	$payment = new \PayPal\Api\Payment();
	$payment->setIntent('sale')
		->setPayer($payer)
		->setTransactions(array($transaction))
		->setRedirectUrls($redirectUrls);
	try {
		$payment->create($apiContext);
	}catch(Exception $e){
die('<script>
           swal({title: "خطاء",text: "تعذر عملية الشراء",type: "error",allowOutsideClick: false,allowEscapeKey: false,showCloseButton: false,confirmButtonText: "حسنأ",})</script>');
		   }
	$payid = strval($payment->getId());
	$rank = 2000;
	$buytime = time();
	$sql = "INSERT INTO store_coins (id, payment, buyer, value, buytime, ip,status) VALUES (NULL, '$payid','$dbid','$rank','$buytime','$x','0')";
	if($con->query($sql) === false){
die('<script>
           swal({title: "خطاء",text: "تعذر عملية الشراء",type: "error",allowOutsideClick: false,allowEscapeKey: false,showCloseButton: false,confirmButtonText: "حسنأ",})</script>');
	}

	
	$approvalurl = $payment->getApprovalLink();
	exit(header("Location: $approvalurl"));
}else if(isset($_POST["4500"])){
	
	$itemx = "4500 Coins";
	$price = 7;
	
	$payer = new \PayPal\Api\Payer();
	$payer->setPaymentMethod('paypal');
	$item = new \PayPal\Api\Item();
	$item->setName($itemx)->setCurrency('USD')->setQuantity(1)->setPrice($price);
	$itemList = new \PayPal\Api\ItemList();
	$itemList->setItems([$item]);
	$amount = new \PayPal\Api\Amount();
	$amount->setTotal($price);
	$amount->setCurrency('USD');
	$transaction = new \PayPal\Api\Transaction();
	$transaction->setAmount($amount)->setItemList($itemList)->setDescription("Qz - 4,500 Coins")->setInvoiceNumber(uniqid());
	$redirectUrls = new \PayPal\Api\RedirectUrls();
	$redirectUrls->setReturnUrl("https://panel.q-z.us/pay?success=true")
		->setCancelUrl("https://panel.q-z.us/pay?success=false");
	$payment = new \PayPal\Api\Payment();
	$payment->setIntent('sale')
		->setPayer($payer)
		->setTransactions(array($transaction))
		->setRedirectUrls($redirectUrls);
	try {
		$payment->create($apiContext);
	}catch(Exception $e){
die('<script>
           swal({title: "خطاء",text: "تعذر عملية الشراء",type: "error",allowOutsideClick: false,allowEscapeKey: false,showCloseButton: false,confirmButtonText: "حسنأ",})</script>');
	}
	
	$payid = strval($payment->getId());
	$rank = 4500;
	$buytime = time();
	$sql = "INSERT INTO store_coins (id, payment, buyer, value, buytime, ip,status) VALUES (NULL, '$payid','$dbid','$rank','$buytime','$x','0')";
	if($con->query($sql) === false){
die('<script>
           swal({title: "خطاء",text: "تعذر عملية الشراء",type: "error",allowOutsideClick: false,allowEscapeKey: false,showCloseButton: false,confirmButtonText: "حسنأ",})</script>');
	}
	$approvalurl = $payment->getApprovalLink();
	exit(header("Location: $approvalurl"));
}else if(isset($_POST["7500c"])){
	
	$itemx = "7500 Coins";
	$price = 12;
	
	$payer = new \PayPal\Api\Payer();
	$payer->setPaymentMethod('paypal');
	$item = new \PayPal\Api\Item();
	$item->setName($itemx)->setCurrency('USD')->setQuantity(1)->setPrice($price);
	$itemList = new \PayPal\Api\ItemList();
	$itemList->setItems([$item]);
	$amount = new \PayPal\Api\Amount();
	$amount->setTotal($price);
	$amount->setCurrency('USD');
	$transaction = new \PayPal\Api\Transaction();
	$transaction->setAmount($amount)->setItemList($itemList)->setDescription("Qz - 7,500 Coins")->setInvoiceNumber(uniqid());
	$redirectUrls = new \PayPal\Api\RedirectUrls();
	$redirectUrls->setReturnUrl("https://panel.q-z.us/pay?success=true")
		->setCancelUrl("https://panel.q-z.us/pay?success=false");
	$payment = new \PayPal\Api\Payment();
	$payment->setIntent('sale')
		->setPayer($payer)
		->setTransactions(array($transaction))
		->setRedirectUrls($redirectUrls);
	try {
		$payment->create($apiContext);
	}catch(Exception $e){
die('<script>
           swal({title: "خطاء",text: "تعذر عملية الشراء",type: "error",allowOutsideClick: false,allowEscapeKey: false,showCloseButton: false,confirmButtonText: "حسنأ",})</script>');
	}
	
	$payid = strval($payment->getId());
	$rank = 7500;
	$buytime = time();
	$sql = "INSERT INTO store_coins (id, payment, buyer, value, buytime, ip,status) VALUES (NULL, '$payid','$dbid','$rank','$buytime','$x','0')";
	if($con->query($sql) === false){
die('<script>
           swal({title: "خطاء",text: "تعذر عملية الشراء",type: "error",allowOutsideClick: false,allowEscapeKey: false,showCloseButton: false,confirmButtonText: "حسنأ",})</script>');
	}
	$approvalurl = $payment->getApprovalLink();
	exit(header("Location: $approvalurl"));
}

ob_end_flush();
?>
<style>
.container {
  position: relative;
  margin-top: 50px;
  width: 231px;
  height: 301px;
}

.overlay {
  position: absolute;
  top: 0;
  left: 0;
  width: 231px;
  height: 301px;
  background: rgba(0, 0, 0, 0);
  transition: background 0.5s ease;
}

.container:hover .overlay {
  display: block;
  background: rgba(0, 0, 0, .3);
}

.imgH {
  position: absolute;
  width: 231px;
  height: 301px;
  left: 0;
}


.container:hover .title {
  top: 90px;
}

.buttonHover {
  position: absolute;
  width: 230px;
  left:0;
  top: 180px;
  text-align: center;
  opacity: 0;
  transition: opacity .35s ease;
}

.buttonHover a {
  width: 200px;
  padding: 12px 48px;
  text-align: center;
  color: white;
  border: solid 2px white;
  z-index: 1;
}

.container:hover .buttonHover {
  opacity: 1;
}

.pricing-wrapper {
    width: 960px;
    margin: 40px auto 0;
}
.clearfix:after {
    content: '';
    display: block;
    height: 0;
    width: 0;
    clear: both;
}

</style>
<link href="dist/css/pages/user-card.css" rel="stylesheet">
		</br>

        <div class="page-wrapper">
        <div class="container-fluid">
					

		</br>
	<!--	<center>
<div class="alert alert-info">
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">×</span> </button>
                                            <h3 class="text-info"><i class="fa fa-exclamation-circle"></i> ملاحظة مهمة جدأ .</h3> لتحويل البنكي برجاء التواصل مع نايف او محمود بالتيم سبيك او بالتلقرام 
											<p> او قم بالتحويل علي هذا الحساب : 117608016666695  باسم نايف  و تواصل مع 
											<br>
											<p> نايف  :  https://t.me/MDLxD <p> محمود : https://t.me/Ma7mouDzz
                                        </div>			</center> 

											<center>
<div class="alert alert-danger">
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">×</span> </button>
                                            <h3 class="text-warning"><i class="fa fa-exclamation-circle"></i> خصم 50 % علي بعض الرتب بمناسبة البلاك فرايدي </h3> خصم علي رتب في اي بي قولد + في اي بي سيلفر + في اي بي برونز + الكوينز لمده 24 ساعة  
											<p> 
                                        </div>			</center> -->

				<center> <h3 class="card-title">الحزم المتوفرة</h3>
		 <div class="pricing-wrapper clearfix">

<div class="container">
  <img class="imgH" src="https://i.imgur.com/S2FpxaS.jpg" alt="" />
  <div class="overlay"></div>
  <div class="buttonHover"><a href="#"> شراء </a></div>
</div>		
<div class="container">
  <img class="imgH" src="https://i.imgur.com/S2FpxaS.jpg" alt="" />
  <div class="overlay"></div>
  <div class="buttonHover"><a href="#"> شراء </a></div>
</div>		
<div class="container">
  <img class="imgH" src="https://i.imgur.com/S2FpxaS.jpg" alt="" />
  <div class="overlay"></div>
  <div class="buttonHover"><a href="#"> شراء </a></div>
</div>		
<div class="container">
  <img class="imgH" src="https://i.imgur.com/S2FpxaS.jpg" alt="" />
  <div class="overlay"></div>
  <div class="buttonHover"><a href="#"> شراء </a></div>
</div>		

	
        </div>
        </div>
        </div>
		
<?php require_once('includes/footer.php'); ?>