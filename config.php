<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js" integrity="sha512-STof4xm1wgkfm7heWqFJVn58Hm3EtS31XFaagaa8VMReCXAkQnJZ+jEy8PCC/iT18dFy95WcExNHFTqLyp72eQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<?php
/* 
PayPal Setting and Database configuration
*/



//Paypal Settings and Configuration
define('PAYPAL_ID','adminklc@business.example.com');
define('PAYPAL_SANDBOX', TRUE); //TRUE OR FALSE

// define('PAYPAL_RETURN_URL','https://generichotel.online/klc/success.php');
// define('PAYPAL_CANCEL_URL','https://generichotel.online/klc/cancel.php');
// define('PAYPAL_NOTIFY_URL','https://generichotel.online/klc/ipn.php');

define('PAYPAL_RETURN_URL','http://localhost/klc/success.php');
define('PAYPAL_CANCEL_URL','http://localhost/klc/cancel.php');
// define('PAYPAL_NOTIFY_URL','http://localhost/klc/ipn.php');
define('PAYPAL_CURRENCY','PHP');



//Database Configuration
define('DB_HOST','localhost');
define('DB_USERNAME','root');
define('DB_PASSWORD','');
define('DB_NAME','csm');

//Change Not Required
define('PAYPAL_URL', (PAYPAL_SANDBOX == true) ? "https://www.sandbox.paypal.com/cgi-bin/webscr" : "https://www.paypal.com/cgi-bin/webscr");












?>