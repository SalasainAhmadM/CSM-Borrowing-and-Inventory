<?php 


// require("alert.php");
// require("db.php");

require('function.php');

// adminLogin();

$conn = dbConnections();

$message = $_POST['email-message'];


$fetch_users_sql= "SELECT * FROM user_cred";
$fetch_result = mysqli_query($con,$fetch_users_sql);

while($user = mysqli_fetch_assoc($fetch_result)){
    sendEmails($user['email'],$user['name'],$message);
}




?>