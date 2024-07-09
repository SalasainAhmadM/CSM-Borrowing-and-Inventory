<?php 


// require("alert.php");
// require("db.php");
// adminLogin();


//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


require_once('./PHPMailer/src/PHPMailer.php');
require_once('./PHPMailer/src/SMTP.php');
require_once('./PHPMailer/src/Exception.php');



function dbConnections(){
    $con = mysqli_connect('localhost','root','','klc');

    if(mysqli_errno($con)>0){
        die('No Connection');
    }

    return $con;
}


function sendEmails($recipient_email,$recipient_fullname,$message){

    $mail = new PHPMailer(true);

    try {
        //Server settings
        $mail->SMTPDebug = 2;                      //Enable verbose debug output
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host = 'smtp.gmail.com';             //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = 'reuelmendoza29@gmail.com';                     //SMTP username
        $mail->Password   = 'jprfkcovspuoebsw';                               //SMTP password
        $mail->SMTPSecure ="tls";            //Enable implicit TLS encryption
        $mail->Port       = 587;   
        
        //Recipients
        $mail->setFrom('bg201802024@wmsu.edu.ph', 'KLC HOMES');
    
    
        $mail->addAddress($recipient_email, $recipient_fullname);     //Add a recipient
        // $mail->addAddress('ellen@example.com');               //Name is optional
        // $mail->addReplyTo('info@example.com', 'Information');
        // $mail->addCC('cc@example.com');
        // $mail->addBCC('bcc@example.com');
    
        //Attachments
        // $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
        // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name
    
        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = 'test';
        $mail->Body    = $message;
        // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
    
        $mail->send();
        echo 'Message has been sent';
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
    
}



?>