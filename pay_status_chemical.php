

<?php 

require('admin/db.php');
require('admin/alert.php');

include_once 'config.php';

include_once 'dbconnection.php';

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CSM - Borrowing Status</title>
    <link rel = "stylesheet" href="main.css" type="text/css"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
 <link rel="icon" href="img/logo.jpg">
    <!-- Link Swiper's CSS -->
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.css"
    />
  <!-- CSS only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
<script src="https://www.paypal.com/sdk/js?client-id=ATCuaMwZvvLQw_uUsfFXHMjrMA0S99bUGeEOy2l8LxLDTrTErChioDQ2KPsINWzRiUpKCD0pWxgsyLtY"></script>

</head>

<body class="bg-light">
<?php 
session_start();
date_default_timezone_set("Asia/Manila");

$home_q = "SELECT * FROM `settings` WHERE `sr_no`=?";
$values = [1];
$home_r = mysqli_fetch_assoc(select($home_q, $values,'i'));


if($home_r['shutdown']==1){
  echo<<<alertbar
  <div class='bg-secondary text-center p-2 fw-bold text-white'>
  <i class='bi bi-exclamation-triangle'></i> Reservations are temporarily closed because there are no available rooms!
  </div>
  alertbar;
}

?>



    <nav class="navbar navbar-expand-lg bg-white px-lg-3 py-lg-2 shadow-sm sticky-top">
      <div class="container-fluid">
        <a class="navbar-brand me-5 fw-bold fs-3" href="index.php"><?php echo $home_r['site_title']?></a>
        <button class="navbar-toggler shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link active me-3 fw-bold" aria-current="page" href="index.php">Home</a>
            </li>
            <li class="nav-item"> 
              <a class="nav-link me-3 fw-bold" href="rooms.php">Apparatus</a>
            </li>
            <li class="nav-item"> 
              <a class="nav-link me-3 fw-bold" href="chemical.php">Chemical</a>
            </li>
          
    
          </ul>
          <div class="d-flex">
          <?php 
          
          if(isset($_SESSION['login']) && $_SESSION['login']==true){
            echo<<<data
            
            <div class="btn-group">
            <button type="button" class="btn btn-outline-dark dropdown-toggle shadow-none" data-bs-toggle="dropdown" data-bs-display="static" aria-expanded="false">
                
                $_SESSION[uName]
                </button>
                <ul class="dropdown-menu dropdown-menu-lg-end ">

                    <li><a class="dropdown-item" href="bookings.php">Your Apparatus Item</a></li>
                    <li><a class="dropdown-item" href="bookings_chemical.php">Your Chemical Item</a></li>
                    <li><a class="dropdown-item" href="profile.php">Student Profile</a></li>
                    <li><a class="btn btn-success dropdown-item" href="logout.php">Logout</a></li>
                  </ul>
              </div>


            data;
          }else{
            echo<<<data

            <button type="button" class="btn btn-outline-dark shadow-none me-lg-2 me-3"  data-bs-toggle="modal" data-bs-target="#loginModal">
            Login
            </button>

            data;
          }
          
          
          ?>
          </div>
        </div>
      </div>
    </nav>


    


    <div class="container">
        <div class="row">
            
    <div class="col-12 my-5 mb-3 px-4">
    <?php
           
           //  $frm_data = filteration($_GET);
 
           //  if(!(isset($_SESSION['login']) && $_SESSION['login']==true)){
           //   redirect('index.php');
           // }
 
 
           // $booking_q = "SELECT  bo.*, bd.* FROM  `booking_order` bo INNER JOIN `bookin_details` bd ON bo.booking_id = bd.booking_id WHERE bo.order_id=? AND bo.user_id=? AND bo.booking_status!=?";
 
           // $booking_res = select($booking_q,[$frm_data['order'],$_SESSION['uId'],'booked'],'sis');
 
           // if(mysqli_num_rows($booking_res)==0){
           //   redirect('index.php');
           // };
 
           // $booking_fetch = mysqli_fetch_assoc($booking_res);
 
           // if($booking_fetch['booking_status']=="TXN_SUCCESS"){
             echo<<<data
             <div class="col-12 px-4">
             <p class="fw-bold alert alert-success text-center">
             <i class="bi bi-check-circle-fill"></i>
              Borrowing Succesfully
             <br><br>
             <a href='chemical.php'>Go to Chemical</a> 
             </div>
           data;
           // }
    
            
            ?>
  
    </div>


  
 

  
    
      


   
   </div>
  </div>

  <?php 

$contact_q = "SELECT * FROM `contact_details` WHERE `sr_no`=?";
$values = [1];
$contact_r = mysqli_fetch_assoc(select($contact_q, $values,'i'));
// print_r($contact_r);
?>


  

  <h6 class="text-center bg-dark text-white p-3m m-0">Develop by reuel mendoza</h6>
<!-- Login Modal -->
<div class="modal fade" id="loginModal"  data-bs-backdrop="static" data-bs-keyboard= "true" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" >
          <div class="modal-content">
            <form id="login-form" method="POST">
            <div class="modal-header">
              <h5 class="modal-title d-flex align-items-center"><i class="bi bi-person-check-fill fs-3 me-2"></i>User login</h5>
              <button type="reset" class="btn-close shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <div class="mb-3">
                <label class="form-label">Email/PhoneNumber</label>
                <input type="text" class="form-control shadow-none" required name="email_mob" >
                </div>
                <div class="mb-4">
                <label class="form-label">Password</label>
                <input type="password" class="form-control shadow-none" required name="loginpass" >
                </div>

                <div class="mb-4"><button type="submit" class="btn btn-success mb-2 w-100 ">Login</button></div>
                <div class="mb-2 text-center text-decoration-none">
                  <a href="#" class="text-decoration-none" data-bs-toggle="modal" data-bs-target="#forgotModal" >Forgot Password?</a>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success " style="margin-right:120px;"  data-bs-toggle="modal" data-bs-target="#registerModal">Create New Account</button>
                 </div>
             
              </div>
            </form>
          </div>
        </div>
      </div>


          
      <!---Forgot modal -->
 <div class="modal fade" id="forgotModal"  data-bs-backdrop="static" data-bs-keyboard= "true" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" >
          <div class="modal-content">
            <form id="forgot-form">
            <div class="modal-header">
              <h5 class="modal-title d-flex align-items-center"><i class="bi bi-shield-exclamation"></i> Forgot Password</h5>
              <button type="reset" class="btn-close shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <div class="mb-4">
              <span class="badge rounded-pill bg-light text-dark mb-3 text-wrap lh-base">
                Note: A link will be send to your email to reset your password!
              </span>
                <input type="email" class="form-control shadow-none" required name="email" placeholder="Email....">
                </div>
                <div class="mb-4"><button type="submit" class="btn btn-success mb-2 w-100 ">Get Reset link</button></div>
              </div>
            </form>
          </div>
        </div>
      </div>

            <!---recovery password modal -->
 <div class="modal fade" id="recoveryModal"  data-bs-backdrop="static" data-bs-keyboard= "true" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" >
          <div class="modal-content">
            <form id="recovery-form">
            <div class="modal-header">
              <h5 class="modal-title d-flex align-items-center"><i class="bi bi-shield-plus"></i>Set New Password</h5>
              <button type="reset" class="btn-close shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <div class="mb-4">
                <input type="password" class="form-control shadow-none" required name="pass" placeholder="New Password..">
                <input type="hidden" name="email">
                <input type="hidden" name="token">
                </div>
                <div class="mb-4"><button type="submit" class="btn btn-success mb-2 w-100 ">Submit</button></div>
              </div>
            </form>
          </div>
        </div>
      </div>
            



  

        <div class="modal fade" id="registerModal" data-bs-backdrop="static" data-bs-keyboard= "true" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <form id="register-form" method="POST">
                    <div class="modal-content">
                    <div class="modal-header">
              <h5 class="modal-title d-flex align-items-center"><i class="bi bi-person-plus-fill fs-3 me-2"></i></i>User Registration</h5>
              <button type="reset" class="btn-close shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <div class="text-center">
              <span class="badge rounded-pill bg-light text-dark mb-3 text-wrap lh-base ">
                Note: Your Details must match with your ID that will be required  during check-in.
              </span>
              </div>
              <div class="container-fluid">
                <div class="row">
                  <div class="col-md-6 ps-0 mb-3">
                    <label class="form-label">Name</label>
                    <input type="text" class="form-control shadow-none" required name="name">
                  </div>
                  <div class="col-md-6 p-0 mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" class="form-control shadow-none" required name="email">
                  </div>
                  <div class="col-md-6 ps-0 mb-3">
                    <label class="form-label">Phone Number</label>
                    <input type="number" class="form-control shadow-none" required name="phonenum">
                  </div>
                  <div class="col-md-6 ps-0 mb-3">
                    <label class="form-label">Address</label>
                    <input type="text" class="form-control shadow-none" required name="address">
                   <!-- <textarea class="form-control shadow-none" name="address" rows="3" style="resize: none;" required></textarea>-->
                  </div>
                  <div class="col-md-6 ps-0 mb-3">
                    <label class="form-label">Password<span class="badge rounded-pill bg-light text-dark text-wrap lh-base ">
                    (8 characters minimum)
              </span></label>
                    <input type="password" class="form-control shadow-none" required name="pass" minlength="8">
                  </div>
                  <div class="col-md-6 p-0 mb-3">
                    <label class="form-label">Confirm Password  <span class="badge rounded-pill bg-light text-dark text-wrap lh-base ">
                    (8 characters minimum)
              </span></label>
                    <input type="password" class="form-control shadow-none" required name="cpass" minlength="8">
                  </div>
                </div>
                <div class="text-center my-1">
                  <button type="submit" class="btn btn-success shadow-none w-100">Register</button>
                </div>
              </div>
                    </div>
                </form>
            </div>
        </div>


    

    
 
<?php

if(isset($_GET['account_recovery'])){
  $data = filteration($_GET);

  $t_date = date("Y-m-d");

  $query = select("SELECT * FROM `user_cred` WHERE `email`=? AND `token`=? AND `t_expire`=? LIMIT 1",[$data['email'],$data['token'],$t_date],'sss');


  if(mysqli_num_rows($query)==1){
    echo <<<showModal
      <script>
    var myModal = document.getElementById('recoveryModal')

    myModal.querySelector("input[name='email']").value = '$data[email]';
    myModal.querySelector("input[name='token']").value = '$data[token]';

    var modal = bootstrap.Modal.getOrCreateInstance(myModal) // Returns a Bootstrap modal instanceof
    modal.show();
    </script>
    showModal;
  }else{
    echo '<script>alert("Invalid Link")</script>';
  }

}

?>

 



    
<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
  <!-- Swiper JS -->
<script src="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.js"></script>

<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        paypal.Buttons().render('#paypal-button-container');
    </script>




      <script>


 let register_form = document.getElementById('register-form');


register_form.addEventListener('submit',function(e){
 e.preventDefault();
 add_User();

});


 function add_User(){

          let data = new FormData();
          data.append('name',register_form.elements['name'].value);
          data.append('email',register_form.elements['email'].value);
          data.append('phonenum',register_form.elements['phonenum'].value);
          data.append('address',register_form.elements['address'].value);
          data.append('pass',register_form.elements['pass'].value);
          data.append('cpass',register_form.elements['cpass'].value);
          data.append('register','');

          // var myModalEl = document.getElementById('registerModal')
          //     var modal = bootstrap.Modal.getInstance(myModalEl) // Returns a Bootstrap modal instanceof
          //     modal.hide();

        let xhr = new XMLHttpRequest();
        xhr.open("POST","./ajax/login_register.php",true);

        var myModalEl = document.getElementById('registerModal')
            var modal = bootstrap.Modal.getInstance(myModalEl) // Returns a Bootstrap modal instanceof
            modal.hide();


       xhr.onload = function(){
              if(this.responseText == 'password_mismatch'){
                alert('Password Mismatch');
              }
              else if(this.responseText == 'email_already'){
                alert('Email Already Exist');
              }
              else if(this.responseText == 'phone_already'){
                alert('Phone Number Already Use');
              }
              else if(this.responseText == 'mail_failed'){
                alert('Cannot send confirmation email');
              }
              else if(this.responseText == 'ins_failed'){
                alert('Registration Failed');
              }
              else{
                Swal.fire(
                'Successfully Registered ',
                'Confirmation link send to your email',
                'success'
              );
                register_form.reset();
              }
            }

            xhr.send(data);

 }

 
 let login_form = document.getElementById('login-form');
login_form.addEventListener('submit',function(e){
 e.preventDefault();
 login_User();

});

 function login_User(){
          let data = new FormData();
          data.append('email_mob',login_form.elements['email_mob'].value);
          data.append('loginpass',login_form.elements['loginpass'].value);
          data.append('login','');

        let xhr = new XMLHttpRequest();
        xhr.open("POST","./ajax/login_register.php",true);

        var myModalEl = document.getElementById('loginModal')
            var modal = bootstrap.Modal.getInstance(myModalEl) // Returns a Bootstrap modal instanceof
            modal.hide();
       xhr.onload = function(){
              if(this.responseText == 'inv_email_mob'){
                alert('Invalid Email or Phone Number');
              }
              else if(this.responseText == 'not_verified'){
                alert('Email is not verified');
              }
              else if(this.responseText == 'inactive'){
                alert('Account Suspended Please contact the Admin');
              }
              else if(this.responseText == 'invalid_pass'){
                alert('Incorrect Password');
              }
              else{
                let fileurl = window.location.href.split('/').pop().split('?').shift();
                if(fileurl == 'room_details.php'){
                  window.location = window.location.href;
                }else{
                  window.location = window.location.pathname;
                }
              }
            }
            xhr.send(data);
 }




 let forgot_form = document.getElementById('forgot-form');
forgot_form.addEventListener('submit',function(e){
 e.preventDefault();
 forgot_pass();

});

function forgot_pass(){
  let data = new FormData();
  data.append('email',forgot_form.elements['email'].value);
  data.append('forgot','');

        let xhr = new XMLHttpRequest();
        xhr.open("POST","./ajax/login_register.php",true);

            var myModalEl = document.getElementById('forgotModal')
            var modal = bootstrap.Modal.getInstance(myModalEl) // Returns a Bootstrap modal instanceof
            modal.hide();

         
            xhr.onload = function(){
              if(this.responseText == 'inv_email'){
                alert('Password Mismatch');
              }
              else if(this.responseText == 'not_verified'){
                alert('Email is not verified Please contact the administrator');
              }
              else if(this.responseText == 'inactive'){
                alert('Account is inactive Please contact the administrator');
              }
              else if(this.responseText == 'email_failed'){
                alert('Cannot send email');
              }else if(this.responseText == 'upd_failed'){
                alert('Account recovery failed')
              }
              else{
                Swal.fire(
                'Successfully Send Link ',
                'Reset Password link Send To Your Email',
                'success'
              );
              forgot_form.reset();
               
              }
            }
            xhr.send(data);
  
}


let recovery_form = document.getElementById('recovery-form');

recovery_form.addEventListener('submit',function(e){
 e.preventDefault();
 recovery_pass();

});

function recovery_pass(){
   let data = new FormData();

   data.append('email',recovery_form.elements['email'].value);
   data.append('token',recovery_form.elements['token'].value);
   data.append('pass',recovery_form.elements['pass'].value);
   data.append('recovery_pass','');

   let xhr = new XMLHttpRequest();
  xhr.open("POST","./ajax/login_register.php",true);

            var myModalEl = document.getElementById('recoveryModal')
            var modal = bootstrap.Modal.getInstance(myModalEl) // Returns a Bootstrap modal instanceof
            modal.hide();

            xhr.onload = function(){
              if(this.responseText == 'failed'){
                alert('Recovery Email Failed');
              }
              else{
                Swal.fire(
                'Successfully Reset Password ',
                'Your Password Has Been Reset',
                'success'
              );
             recovery_form.reset();
               
              }
            }
            xhr.send(data);
  

}













// let login_form = document.getElementById('login-form');

//  login_form.addEventListener('submit', (e)=>{
//   e.preventDefault();
//   let data = new FormData();
//   data.append('email_mob',login_form.elements['email_mob'].value);
//   data.append('pass',login_form.elements['pass'].value);
//   data.append('login','');

//   var myModalEl = document.getElementById('loginModal')
//   var modal = bootstrap.Modal.getInstance(myModalEl) // Returns a Bootstrap modal instanceof
//   modal.hide();

//   let xhr = new XMLHttpRequest();
//   xhr.open("POST",".ajax/login_register.php",true);

  
//   xhr.onload = function(){
//               if(this.responseText == 'inv_email_mob'){
//                 alert('Invalid Email or Phone Number');
//               }
//               else if(this.responseText == 'not_verified'){
//                 alert('Email is not verified');
//               }
//               else if(this.responseText == 'inactive'){
//                 alert('Account Suspended Please contact the Admin');
//               }
//               else if(this.responseText == 'invalid_pass'){
//                 alert('Incorrect Password');
//               }
//               else{
//                 window.location = window.location.pathname;
//                login_form.reset();
//               }
//             }
//        xhr.send(data);

// });




function checkLoginToBook(status,room_id){
  if(status){
    window.location.href='confirm_booking.php?id='+room_id;
  }
  else{
    Swal.fire({
  position: 'top-end',
  icon: 'warning',
  title: 'Please Login First to Reserve Room',
  showConfirmButton: false,
  timer: 1500,
  
});
  }
};


let booking_form = document.getElementById('booking_form');
let info_loader = document.getElementById('info_loader');
let pay_info = document.getElementById('pay_info');

function check_availability(){
   let checkin_val = booking_form.elements['checkin'].value;
   let checkout_val = booking_form.elements['checkout'].value;

   booking_form.elements['pay_now'].setAttribute('disabled',true);

   if(checkin_val!='' && checkout_val!=''){

      pay_info.classList.add('d-none');
      pay_info.classList.replace('text-dark', 'text-danger');
      info_loader.classList.remove('d-none');


      let data  = new FormData();

      data.append('check_availability','');
      data.append('check_in',checkin_val);
      data.append('check_out',checkout_val);
      let xhr = new XMLHttpRequest();
      xhr.open("POST","./ajax/confirm_booking.php",true);

         

            xhr.onload = function(){
              let data = JSON.parse(this.responseText);
              if(data.status == 'check_in_out_equal'){
                pay_info.innerText == "You cannot check-out on the same day!";
              }
              else if(data.status == 'check_out_earlier'){
                pay_info.innerText == "Check-out is earlier than check-in date!";
              }
              else if(data.status == 'check_in_earlier'){
                pay_info.innerText == "Check-in date is earlier thatn today's date!";
              }
              else if(data.status == 'unavailable'){
                pay_info.innerText == "Room not available for this check-in date!";
              }
              else{
                pay_info.innerHTML = "No. of Days: "+data.days+"<br>Total Amount To Pay: ₱"+data.payment;
                pay_info.classList.replace('text-danger', 'text-dark');
                booking_form.elements['pay_now'].removeAttribute('disabled');
              }

              pay_info.classList.remove('d-none');
              info_loader.classList.add('d-none');
            }
            xhr.send(data);
   }


}
 


    

     

      </script>




</body>
</html>
