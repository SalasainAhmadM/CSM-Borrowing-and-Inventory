<?php 

require('db.php');
require('alert.php');

  session_start();

// require('/vendor/autoload.php');
if(!(isset($_SESSION['login']) && $_SESSION['login']==true)){
  redirect('index.php');
}


adminLogin();


if(isset($_GET['gen_pdf']) && isset($_GET['id'])){
    $frm_data = filteration($_GET);
    $query = "SELECT bo.*, bd.*, uc.email FROM `booking_order` bo INNER JOIN `booking_details` bd ON bo.booking_id = bd.booking_id INNER JOIN `user_cred` uc ON bo.user_id = uc.id WHERE  ( (bo.booking_status ='booked'  AND bo.arrival=1) OR (bo.booking_status='cancelled' AND bo.arrival=0) OR (bo.booking_status='payment failed')) AND bo.booking_id = '$frm_data[id]'";
    $res = mysqli_query($con,$query);
    $total_rows= mysqli_num_rows($res);

    if($total_rows==0){
       header('location:index.php');   
        exit;
      }

      $data = mysqli_fetch_array($res); 

      $date = date("d-m-Y",strtotime($data['datentime']));
            
      $checkin= date("d-m-Y",strtotime($data['check_in']));
                  
      $checkout= date("d-m-Y",strtotime($data['check_out']));

      $table_data = "
        <h2>Reservation Reciept</h2>
        
        <h4>Reserve ID: $data[order_id]</h4>
        <h4>Reservation Date: $date</h4>
 
        <h4>Status: $data[booking_status]</h4>
   
        <h4>Name: $data[user_name]</h4>
        <h4>Email: $data[email]</h4>
        <h4>Phone Number: $data[phonenum]</h4>
        <h4>Address: $data[address]</h4>
  
        <h4>Room Name: $data[room_name]</h4>
        <h4>Cost: $data[price] per day</h4>
        <h4>Total Amount: $data[total_pay]</h4>
   
        <h4>Check-in: $checkin</h4>
        <h4>Check-out: $checkout</h4>
      ";


      echo $table_data;

 
      // $mpdf = new \Mpdf\Mpdf();

      // $mpdf->Bookmark('Start of the document');
      // $mpdf->WriteHTML('<div>Section 1 text</div>');
      
      // $mpdf->Output();

}
else{
    header('location:index.php');
}


?>