<?php 

//Active billing agreement created 12/7/2011 
//BILLINGAGREEMENTID ===> B-2A343947K8102981J
//12/7/2011 === B-6U1370943C441603J

$cmd = null;
if($_GET){ $cmd = $_GET['cmd']; }

include("include.php");
include("views/header.php");
include("views/main/top_nav.php");

?>

<div class="container">

	<?php 
	if($cmd == null)
	{ 
		include("views/main/do_ec_start.php");
	}

	//These are for DoExpressCheckout API
	if($cmd == "run_hardcode")
	{
		echo '<div class="section white">';
		$doec = new \PayPal\DoExpressCheckoutPayment();
		$result = $doec
	                    ->setVersion()
	                    ->setToken("EC-26A022779N349163S")
	                    ->setPayerId("9Z34DN6WF2EZE")
	                    ->setPaymentRequest(array(
		                    array(
			                    "AMT" => "1.00", 
			                    "CURRENCYCODE" => "USD",
			                    "PAYMENTACTION" => "Authorization"
			                   	)
	                   	))
	                    ->execute();

		include("views/result.php");
		echo "</div>";
	}

	?>
</div>
<?php
include("views/footer.php");
//End of index.php