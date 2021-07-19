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
ul {
    list-style-type: none;
}

a {
    color: #e95846;
    text-decoration: none;
}

.pricing-table-title {
    text-transform: uppercase;
    font-weight: 700;
    font-size: 2.6em;
    color: #FFF;
    margin-top: 15px;
    text-align: left;
    margin-bottom: 25px;
    text-shadow: 0 1px 1px rgba(0,0,0,0.4);
}

.pricing-table-title a {
    font-size: 0.6em;
}

.clearfix:after {
    content: '';
    display: block;
    height: 0;
    width: 0;
    clear: both;
}
/** ========================
 * Contenedor
 ============================*/
.pricing-wrapper {
    width: 960px;
    margin: 40px auto 0;
}

.pricing-table {
    margin: 0 10px;
    margin-bottom: 10px;
    text-align: center;
    width: 300px;
    float: left;
    -webkit-box-shadow: 0 0 15px rgba(0,0,0,0.4);
    box-shadow: 0 0 15px rgba(0,0,0,0.4);
    -webkit-transition: all 0.25s ease;
    -o-transition: all 0.25s ease;
    transition: all 0.25s ease;
}

.pricing-table:hover {
    -webkit-transform: scale(1.06);
    -ms-transform: scale(1.06);
    -o-transform: scale(1.06);
    transform: scale(1.06);
}

.pricing-title {
    color: #FFF;
    background: #36bea6;
    padding: 13px 0;
    font-size: 2em;
    text-transform: uppercase;
    text-shadow: 0 1px 1px rgba(0,0,0,0.4);
}
.pricing-titleG {
    color: #FFF;
    background: #FFA500;
    padding: 20px 0;
    font-size: 2em;
    text-transform: uppercase;
    text-shadow: 0 1px 1px rgba(0,0,0,0.4);
}

.pricing-table.recommended .pricing-title {
    background: #2db3cb;
}

.pricing-table.recommended .pricing-action {
    background: #2db3cb;
}

.pricing-table .price {
    background: #f1f1f1;
    font-size: 3.4em;
}

.pricing-table .price sup {
    font-size: 0.4em;
    position: relative;
    left: 5px;
}

.table-list {
    background: #FFF;
    color: #403d3a;
}

.table-list li {
    font-size: 1.4em;
    font-weight: 700;
    padding: 12px 8px;
}

.table-list li:before {
    content: "\f00c";
    color: #3fab91;
    display: inline-block;
    position: relative;
    right: 5px;
    font-size: 16px;
} 

.table-list li span {
    font-weight: 400;
}

.table-list li span.unlimited {
    color: #FFF;
    background: #e95846;
    font-size: 0.9em;
    padding: 5px 7px;
    display: inline-block;
    -webkit-border-radius: 38px;
    -moz-border-radius: 38px;
    border-radius: 38px;
}


.table-list li:nth-child(2n) {
    background: #F0F0F0;
}

.table-buy {
    background: #FFF;
    padding: 11px;
    text-align: left;
    overflow: hidden;
}

.table-buy p {
    float: left;
    color: #37353a;
    font-weight: 700;
    font-size: 2.4em;
}

.table-buy p sup {
    font-size: 0.5em;
    position: relative;
    left: 5px;
}

.table-buy .pricing-action {
    float: left;
    color: #FFF;
    background: #36bea6;
    padding: 10px 16px;
    -webkit-border-radius: 2px;
    -moz-border-radius: 2px;
    border-radius: 2px;
    font-weight: 300;
    font-size: 1.4em;
    text-shadow: 0 1px 1px rgba(0,0,0,0.4);
    -webkit-transition: all 0.25s ease;
    -o-transition: all 0.25s ease;
    transition: all 0.25s ease;
}

.table-buy .pricing-action:hover {
    background: #cf4f3e;
}

.recommended .table-buy .pricing-action:hover {
    background: #228799;    
}

/** ================
 * Responsive
 ===================*/
 @media only screen and (min-width: 768px) and (max-width: 959px) {
    .pricing-wrapper {
        width: 768px;
    }

    .pricing-table {
        width: 236px;
    }
    
    .table-list li {
        font-size: 1.3em;
    }

 }

 @media only screen and (max-width: 767px) {
    .pricing-wrapper {
        width: 420px;
    }

    .pricing-table {
        display: block;
        float: none;
        margin: 0 0 20px 0;
        width: 100%;
    }
 }

@media only screen and (max-width: 479px) {
    .pricing-wrapper {
        width: 300px;
    }
} 
</style>
<link href="dist/css/pages/user-card.css" rel="stylesheet">
		</br>

        <div class="page-wrapper">
        <div class="container-fluid">
					<center><div class="col-lg-3 col-md-6">
                        <div class="card">
                            <div class="d-flex flex-row">
                                <div class="p-10 bg-inverse" style =  "background-color: #36bea6;">
                                    <h3 class="text-white box m-b-0"><i class="fa fa-money"></i></h3></div>
                                <div class="align-self-center m-l-20">
                                    <h3 class="m-b-0"><?php echo ceil(intval($coins)); ?></h3>
                                    <h5 class="text-muted m-b-0">عدد نقاطك الحاليه</h5></div>
                            </div>
                        </div>
                    </div>
			</center>		

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

		 <div class="pricing-wrapper clearfix">
        <!-- Titulo -->

        <div class="pricing-table">
            <h3 class="pricing-title">10,000 كوينز</h3>
            <div class="price">$19.99<sup></sup></div>
            <div class="table-buy">
			    <center><form method="post">  <button disabled type="submit" name="" class="btn btn-success waves-effect waves-light">شراء</button> </form></center>
				</div>
        </div>
        <div class="pricing-table">
            <h3 class="pricing-title">7,500 كوينز</h3>
            <div class="price">$11,99<sup></sup></div>
            <div class="table-buy">
			    <center><form method="post">  <button type="submit" name="7500c" class="btn btn-success waves-effect waves-light">شراء</button> </form></center>
            </div>
        </div>
        <div class="pricing-table">
            <h3 class="pricing-title">4,500 كوينز</h3>
            <div class="price">$6.99<sup></sup></div>
            <div class="table-buy">
			    <center><form method="post">  <button type="submit" name="4500c" class="btn btn-success waves-effect waves-light">شراء</button> </form></center>
            </div>
        </div>
		
        <div class="pricing-table">
            <h3 class="pricing-title">2000 كوينز</h3>
            <div class="price">$2.99<sup></sup></div>
            <div class="table-buy">
			    <center><form method="post">  <button type="submit" name="2000c" class="btn btn-success waves-effect waves-light">شراء</button> </form></center>
            </div>
        </div>
		
        <div class="pricing-table">
            <h3 class="pricing-title">1000 كوينز</h3>
            <div class="price">$1.5<sup></sup></div>
            <div class="table-buy">
			    <center><form method="post">  <button type="submit" name="1000c" class="btn btn-success waves-effect waves-light">شراء</button> </form></center>
            </div>
        </div>
		
        <div class="pricing-table">
            <h3 class="pricing-title">500 كوينز</h3>
            <div class="price">$0.99<sup></sup></div>
            <div class="table-buy">
			    <center><form method="post">  <button type="submit" name="500c" class="btn btn-success waves-effect waves-light">شراء</button> </form></center>
            </div>
        </div>
        

		</div>
			
        </div>
        </div>
		
<?php require_once('includes/footer.php'); ?>