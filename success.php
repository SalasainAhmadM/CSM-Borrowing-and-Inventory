<?php

require('admin/db_config.php');
require('admin/alert.php');


include_once 'config.php';

include_once 'dbconnection.php';



date_default_timezone_set("Asia/Manila");


session_start();
unset($_SESSION['ROOM']);

if (!(isset($_SESSION['login']) && $_SESSION['login'] == true)) {
    redirect('index.php');


}








//     FUNCTION REGENERATE_SESSION($UID){
//     $USER_Q=SELECT("SELECT * FROM `USER_CRED` WHERE `ID`=? LIMIT 1",[$UID],'I');
//     $USER_FETCH = MYSQLI_FETCH_ASSOC($USER_Q);

//   $_SESSION['LOGIN']=TRUE;
//     $_SESSION['UID']= $USER_FETCH['ID'];
//      $_SESSION['UNAME'] =$USER_FETCH['NAME'];
//       $_SESSION['UPHONE']= $USER_FETCH['PHONENUM'];
// } 





// if(!(isset($_SESSION['login']) && $_SESSION['login']==true)){
//     regenerate_session($slct_fetch['user_id']);
// }

if (isset($_GET['PayerID'])) {
    $upd_query = "UPDATE `booking_order` SET  `booking_status`= 'booked' WHERE `booking_id`='" . $id . "'";
    redirect('pay_status.php');


} else {
    echo "<h1>Your Payment Has beeen Failed</h1>";
}




//  $slct_res = mysqli_query($con,$slct_query);

//  if(mysqli_num_rows($slct_res)==0){
//     redirect('index.php');
//  }


//  $slct_fetch = mysqli_fetch_assoc($slct_res);

//  if(!(isset($_SESSION['login']) && $_SESSION['login']==true)){

//  }





//

// if(!empty($_GET['item_number']) && !empty($_GET['tx']) && !empty($_GET['amt']) && !empty($_GET['cc']) && !empty($_GET['st'])){
//     //Get Transaction Information from URL
//     $item_number = $_GET['item_number'];
//     $txn_id = $_GET['tx'];
//     $payment_gross = $_GET['amt'];
//     $currency_code = $_GET['cc'];
//     $payment_status = $_GET['st'];

//     //Get Product infomation from the database
//     $productResult = $db_conn->query("SELECT * FROM booking_order WHERE `order_id` = ".$item_number);
//     $productRow = $productResult->fetch_assoc();

//     //Check if transaction data exists with the same TXN ID
//     $prevPaymentResult = $db_conn->query("SELECT * FROM booking_order WHERE `txn_id` = '".$txn_id."'");

//     if($prevPaymentResult->num_rows > 0){
//         $paymentRow = $prevPaymentResult->fetch_assoc();
//         $payment_id = $paymentRow['booking_id'];
//         $payment_gross = $paymentRow['payment_gross'];
//         $payment_status = $paymentRow['payment_status'];
//     }else{
//         //Insert transaction data into the database
//         $insert = $db_conn->query("INSERT INTO booking_order(item_number,txn_id,payment_gross,currency,trans_status) VALUES('".$item_number."','".$txn_id."','".$payment_gross."','".$currency_code."','".$payment_status."')");
//         $payment_id = $db_conn->insert_id;
//     }  
// }


// 


?>