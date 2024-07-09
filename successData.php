<?php

require('admin/db_config.php');
require('admin/alert.php');


include_once 'config.php';

include_once 'dbconnection.php';


$amount = $_GET['amt'];

$insert = $db_conn->query("INSERT INTO booking_order (trans_amt)  VALUES ('" . $amount . "')  ");
$last_id = $db_conn->insert_id;

$_SESSION['booking_id'] = $last_id;





?>