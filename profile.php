

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
    <title>Profile</title>
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

if(isset($_SESSION['login']) && $_SESSION['login']==true){
  

    $u_exits = select("SELECT * FROM `user_cred` WHERE `id`=? LIMIT 1",[$_SESSION['uId']],'s');

    if(mysqli_num_rows($u_exits)==0){
       
    }
  }
  $u_fetch = mysqli_fetch_assoc($u_exits);

?>





    <nav class="navbar navbar-expand-lg bg-white px-lg-3 py-lg-2 shadow-sm sticky-top">
      <div class="container-fluid">
        <a class="navbar-brand me-5 fw-bold fs-3" href="index.php"><i class="bi bi-house-fill"></i><?php echo $home_r['site_title']?></a>
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
            <!--<li class="nav-item">
              <a class="nav-link me-3 fw-bold" href="about.php">About Us</a>
            </li>
            <li class="nav-item">
              <a class="nav-link me-3 fw-bold" href="contact.php">Contact Us</a>
            </li>-->
    
          </ul>
          <div class="d-flex">
          <?php 
          
          if(isset($_SESSION['login']) && $_SESSION['login']==true){
            echo<<<data
            
            <div class="btn-group">
            <button type="button" class="btn btn-outline-dark dropdown-toggle shadow-none" data-bs-toggle="dropdown" data-bs-display="static" aria-expanded="false">
                
                $_SESSION[uName]
                </button>
                <ul class="dropdown-menu dropdown-menu-lg-end">
                  <li><a class="dropdown-item" href="bookings.php">Your Barrowing Item</a></li>
                  <li><a class="dropdown-item" href="bookings_chemical.php">Your Chemical Item</a></li>
                  <li><a class="dropdown-item" href="profile.php">Your Chemical Item</a></li>
                  <li><a class="dropdown-item" href="logout.php">Logout</a></li>
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
            
    <div class="col-12 my-5 px-4">
        <div class="h2 fw-bold text-center">Student Profile</div>
        <div class="h-line bg-dark"></div>
        <div style="font-size:15px;">
        <a href="index.php" class="text-secondary text-decoration-none">Home</a>
        <span class="text-secondary"> > </span>
        <a href="#" class="text-secondary text-decoration-none">Profile</a>
    </div>
    </div>


    <div class="col-12 mb-5 px-4">
        <div class="bg-white p-3 p-md-4 rounded shadow-sm">
            <form id="info-form">  
                <h5 class="mb-3 fw-bold">Student Information</h5>
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Name</label>
                        <input type="text" name="name" value="<?php echo $u_fetch['name']?>" class="form-control shadow-none">
                    </div>
                    <div class="col-md-4 mb-3">
                    <label class="form-label">Student ID</label>
                    <input type="text" class="form-control shadow-none" value="<?php echo $u_fetch['student_id']?>" name="student_id">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Wmsu Email</label>
                        <input type="email" class="form-control shadow-none" value="<?php echo $u_fetch['email']?>"  name="email">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Phone Number</label>
                        <input type="number" class="form-control shadow-none" value="<?php echo $u_fetch['phonenum']?>"  required name="phonenum">
                    </div>
                    <div class="col-md-2 mb-3">
                        <label class="form-label">Course </label>
                        <input type="text" name="course" value="<?php echo $u_fetch['course']?>" class="form-control shadow-none mb-2">
                    </div>
                      <div class="col-md-2 mb-3">
                        <label class="form-label">Year </label>
                        <select class="form-select shadow-none" aria-label="Default select example" id="year_input" name="year" required>
  <option disabled selected value="">Select Year...</option> <!-- placeholder option -->
  <option value="1st" <?php if ($u_fetch['year'] == '1st') { echo 'selected'; } ?>>1st</option>
  <option value="2nd" <?php if ($u_fetch['year'] == '2nd') { echo 'selected'; } ?>>2nd</option>
  <option value="3rd" <?php if ($u_fetch['year'] == '3rd') { echo 'selected'; } ?>>3rd</option>
  <option value="4th" <?php if ($u_fetch['year'] == '4th') { echo 'selected'; } ?>>4th</option>
  <option value="5th" <?php if ($u_fetch['year'] == '5th') { echo 'selected'; } ?>>5th</option>
</select>

                    </div>
                </div>
                <button type="submit" class="btn btn-success shadow-none">Save Changes</button>
            </form> 
        </div>
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

    <!-- Rate Review Modal -->
 <div class="modal fade" id="reviewModal"  data-bs-backdrop="static" data-bs-keyboard= "true" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" >
          <div class="modal-content">
            <form id="review-form" method="POST">
            <div class="modal-header">
              <h5 class="modal-title d-flex align-items-center"><i class="bi bi-clipboard2-pulse"></i> Rate & Review </h5>
              <button type="reset" class="btn-close shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <div class="mb-3">
                <label class="form-label">Rating Room </label>
                
                  <select class="form-select shadow-none" name="rating">
                    
                  <option value="5">Excellent</option>
                  <option value="4">Good</option>
                  <option value="3">Okay</option>
                  <option value="2">Poor</option>
                  <option value="1">Bad</option>

                  </select>
                      

                </div>

                <div class="mb-4">

                <label class="form-label">Review</label>
                <textarea  class="form-control shadow-none mb-2" row="3" name="review" required ></textarea>
                </div>
                  <input type="hidden" name="booking_id">
                  <input type="hidden" name="room_id">
                
                  <div class="text-end text-center">
                    <button type="submit" class="btn btn-success shadow-none">Submit</button>
                  </div>
               
             
              </div>
            </form>
          </div>
        </div>
      </div>







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


  

 
  function cancel_booking(id){
    if(confirm('Are you sure you want to cancel this booking?')){
      let data = new FormData();
      data.append('booking_id',id);
      data.append('cancel_booking','');
      let xhr = new XMLHttpRequest();
    xhr.open("POST","ajax/cancel_bookings.php",true);
    xhr.setRequestHeader('Content-Type','application/x-www-form-urlencoded');

    xhr.onload = function(){
    
        if(this.responseText==1){
          window.location.href="bookings.php?cancel_status=true";
        }else{
          Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Cancellation Failed!',
                })
        }

    }

    xhr.send('cancel_booking&id='+id);
    }
  }




  let review_form = document.getElementById('review-form');

  function review_room(bid,rid){
    review_form.elements['booking_id'].value = bid;
    review_form.elements['room_id'].value = rid;
  }


  review_form.addEventListener('submit', function(e){
    e.preventDefault();

    let data = new FormData();

    data.append('review_form','');
    data.append('rating',review_form.elements['rating'].value);
    data.append('review',review_form.elements['review'].value);
    data.append('booking_id',review_form.elements['booking_id'].value);
    data.append('room_id',review_form.elements['room_id'].value);

    let xhr = new XMLHttpRequest();
    xhr.open("POST","ajax/review_room.php",true);

    xhr.onload = function(){
        
      if(this.responseText == 1){
        window.location.href='bookings.php?review_status=true';
      }else{
        var myModal = document.getElementById('reviewModal');
        var modal = bootstrap.Modal.getInstance(myModal);
        modal.hide();

      alert('error',"Rating & Review Failed");
      }
 
    }


    xhr.send(data);

  });
  

  let info_form = document.getElementById('info-form');

info_form.addEventListener('submit', function(e){
    let data = new FormData();

    data.append('info_form','');
    data.append('year', document.getElementById('year_input').value); // Use the updated value of the 'year' input

    let xhr = new XMLHttpRequest();
    xhr.open("POST","ajax/profile.php",true);
  
    xhr.onload = function(){
    
        if(this.responseText=='phone_already'){
            
            alert('error',"Phone already exists");
        }else if(this.responseText== 0){
            Swal.fire(
                'Error',
                'No Changes were made',
                'success'
              );
        }else{
            Swal.fire(
                'Successfully Changed Profile',
                'Confirm Changes were made',
                'success'
              );
        }
    }

    xhr.send(data);

    e.preventDefault(); // Prevent the default form submission behavior
});





    

     

      </script>




</body>
</html>
