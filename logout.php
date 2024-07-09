<?php 

require("admin/alert.php");


session_start();
session_destroy();
redirect('index.php');


?>