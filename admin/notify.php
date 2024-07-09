<?php

require('.././db_config.php');
require('.././alert.php');

// Check for chemicals with expired dates
$q = "SELECT * FROM `chemical` WHERE `date_exp` <= NOW()";
$results = select($q);

foreach ($results as $result) {
    // Send a notification to the website
    send_alert("The chemical with code " . $result['code'] . " has expired.");

    // You can also perform other actions here, such as deleting the chemical from the database or marking it as expired.
}