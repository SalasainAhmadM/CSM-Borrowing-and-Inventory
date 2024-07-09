<?php
use PayPal\Api\Payment;
use PayPal\Api\PaymentExecution;

require 'config.php';

if (empty($_GET['paymentId']) || empty($_GET['PayerID'])) {
    throw new Exception('The response is missing the paymentId and PayerID');
}

$paymentId = $_GET['paymentId'];
$payment = Payment::get($paymentId, $apiContext);

$execution = new PaymentExecution();
$execution->setPayerId($_GET['PayerID']);

try {
    // Take the payment
    $payment->execute($execution, $apiContext);

    try {
        $db = new mysqli($dbConfig['localhost'], $dbConfig['root'], $dbConfig[''], $dbConfig['klc']);

        $payment = Payment::get($paymentId, $apiContext);

        $data = [
            'room_id' => $payment->transactions[0]->item_list->items[0]->sku,
            'trans_id' => $payment->getId(),
            'trans_amt' => $payment->transactions[0]->amount->total,
            'currency' => $payment->transactions[0]->amount->currency,
            'trans_status' => $payment->getState(),
            // 'invoice_id' => $payment->transactions[0]->invoice_number,
            'user_id' => $payment->transactions[0]->item_list->items[0]->name,
			'description' => $payment->transactions[0]->description,
        ];
        if (addPayment($data) !== false && $data['trans_status'] === 'approved') {
            // Payment successfully added, redirect to the payment complete page.
			$inserids =$db->insert_id;
            header("location:http://localhost/klc/PaypalSuccess.php?payid=$inserids");
            exit(1);
        } else {
            // Payment failed
			header("location:http://localhost/klc/PaypalFailed.php");
             exit(1);
        }

    } catch (Exception $e) {
        // Failed to retrieve payment from PayPal

    }

} catch (Exception $e) {
    // Failed to take payment

}

/**
 * Add payment to database
 *
 * @param array $data Payment data
 * @return int|bool ID of new payment or false if failed
 */
function addPayment($data)
{
    global $db;

    if (is_array($data)) {
		//'isdsssss' --- i - integer, d - double, s - string, b - BLOB
        $stmt = $db->prepare('INSERT INTO `booking_order` (product_id,transaction_id, payment_amount,currency_code, payment_status, invoice_id, product_name, createdtime) VALUES(?, ?, ?, ?, ?, ?, ?, ?)');
        $stmt->bind_param(
            'isdsssss',
            $data['product_id'],
            $data['transaction_id'],
            $data['payment_amount'],
            $data['currency_code'],
            $data['payment_status'],
            $data['invoice_id'],
            $data['product_name'],
            date('Y-m-d H:i:s')
        );
        $stmt->execute();
        $stmt->close();
		
        return $db->insert_id;
    }

    return false;
}