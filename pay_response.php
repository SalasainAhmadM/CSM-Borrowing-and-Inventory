<?php

require('admin/db.php');
require('admin/alert.php');
require('return.php');


require 'config.php';

include_once 'dbconnection.php';

date_default_timezone_set("Asia/Manila");


session_start();
unset($_SESSION['room']);


$isValidChecksum = "FALSE";


$paramList = $_POST;

$paytmChecksum = isset($_POST["CHECKSUMHASH"]) ? $_POST["CHECKSUMHASH"] : ""; 

$isValidChecksum = verifychecksum_e($paramList, PAYPAL_ID, $paytmChecksum); //will return TRUE or FALSE string.


if($isValidChecksum == "TRUE") {
    
    $slct_query = "SELECT `booking_id` , `user_id` FROM `booking_order` WHERE  `order_id`='$_POST[ORDERID]'";


	if ($_POST["STATUS"] == "TXN_SUCCESS") {
		echo "<b>Transaction status is success</b>" . "<br/>";
		//Process your transaction here as success transaction.
		//Verify amount & order id received from Payment gateway with your application's order id and amount.
	}
	else {
		echo "<b>Transaction status is failure</b>" . "<br/>";
	}

	if (isset($_POST) && count($_POST)>0 )
	{ 
		foreach($_POST as $paramName => $paramValue) {
				echo "<br/>" . $paramName . " = " . $paramValue;
		}
	}
	

}
else {
	redirect('index.php');
	//Process transaction as suspicious.
}





?>

