<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js"
    integrity="sha512-STof4xm1wgkfm7heWqFJVn58Hm3EtS31XFaagaa8VMReCXAkQnJZ+jEy8PCC/iT18dFy95WcExNHFTqLyp72eQ=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<?php

require('admin/db_config.php');
require('admin/alert.php');
require('return.php');


require 'config.php';

include_once 'dbconnection.php';


date_default_timezone_set("Asia/Manila");


session_start();

if (!(isset($_SESSION['login']) && $_SESSION['login'] == true)) {
    redirect('index.php');


}

if (isset($_POST['pay_now_chemical'])) {


    header("Pragma: no-cache");
    header("Cache-Control: no-cache");
    header("Expires: 0");

    $checkSum = "";

    $ORDER_ID = 'ORD_' . $_SESSION['uId'] . random_int(11111, 9999999);
    $CUST_ID = $_SESSION['uId'];
    // $TXN_AMOUNT = $_SESSION['chemical']['payment'];





    // $paramList = array();
    // $paramList["ORDER_ID"] = $ORDER_ID;
    // $paramList["CUST_ID"] = $ORDER_ID;
    // $paramList["TXN_AMOUNT"] = $TXN_AMOUNT;





    $frm_data = filteration($_POST);

    $query1 = "INSERT INTO `chemical_order_final` (`user_id`, `chemical_id`, `check_in`, `check_out`, `order_id`,`booking_status`) VALUES (?,?,?,?,?,'approved')";

    insert($query1, [$CUST_ID, $_SESSION['chemical']['id'], $frm_data['checkin'], $frm_data['checkout'], $ORDER_ID], 'issss');


    $chemical_id = mysqli_insert_id($con);


    $query2 = "INSERT INTO `chemical_details_final` (`booking_id`, `chemical_name`, `username`, `course`, `year`, `teacher`, `email`, `quantity`, `group_no`, `volume`, `apr_no`)
     VALUES (?,?,?,?,?,?,?,?,?,?,?)";

    insert($query2, [
        $chemical_id, $_SESSION['chemical']['name'], $frm_data['name'], $frm_data['course'], $frm_data['year'],
        $frm_data['teacher'], $frm_data['email'], $frm_data['quantity'], $frm_data['group_no'], $frm_data['volume'], $frm_data['room_no']
    ], 'issssssssss');



    redirect('pay_status_chemical.php');



}





?>