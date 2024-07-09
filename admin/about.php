
<?php 

require('admin/db.php');
require('admin/alert.php');

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CSM CHEMICAL</title>
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

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

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


    <div class="container my-5  mb-5" style="background-image: url('img/csm-bg.jpg'); background-size: cover; background-position: center;">
      <div class="row justify-content-center align-items-center">
        <div class="col-lg-4 my-3">
          <img src="img/nzro.jpg" class="bd-placeholder-img rounded-circle mx-auto d-block" width="340" height="305" alt="your image description">
          <div class="my-5 px-4">
              <div class="h1 fw-bold text-center">SIR. BUDDY</div>
              <p class="text-center">Client</p>
              <div class="h-line bg-dark"></div>
          </div>
        </div>
      </div>
    </div>



    

    <div class="container py-5">
      <div class="row featurette">
        <div class="col-md-7 my-auto">
          <h1 class="featurette-heading fw-normal lh-1"><b>ABOUT</b></h1>
          <div class="h-line bg-dark col-md-12 mb-2"></div>
          <p class="lead">WMSU College of Science and Mathematics Inventory and Borrowing System.</p>
        </div>
        <div class="col-md-5 my-auto">
          <img src="img/csmlogo.png" class="bd-placeholder-img bd-placeholder-img-lg featurette-image img-fluid mx-auto" alt="your image description">
        </div>
      </div>
    </div>

    <hr class="featurette-divider">

    <div class="container" style="margin-top:7rem;">

    <div style="background-color:#1a1a1a; color:white;">
    <h1 class="featurette-heading fw-normal lh-1 mb-1 m-auto text-center"><b>MEMBERS - BORROWING SYSTEM</b></h1>
    </div>
    <div class="h-line bg-dark" style="margin-bottom:7rem;"></div>
    
      <div class="row">
        
        <div class="col-lg-6 my-3 text-center">
          <img id="profile-pic" src="img/absar.jpg" class="rounded-circle mx-auto d-block" width="280" height="260" alt="your image description">
          <h2 class="fw-normal mt-3"><b>ABSAR U. MOHAMMAD</b></h2>
          <p class="text-center">Frontend Developer.</p>
          <p class="text-center"><a href="https://www.facebook.com/absar.mohammad"><i class="fa-brands fa-facebook fa-2xl"></i></a></p>
        </div><!-- /.col-lg-4 -->

        <div class="col-lg-6 my-3 text-center">
          <img src="your-image-file-2.jpg" class="rounded-circle mx-auto d-block" width="280" height="260" alt="your image description">
          <h2 class="fw-normal mt-3"><b>REUEL S. MENDOZA</b></h2>
          <p class="text-center">Backend Developer</p>
          <p class="text-center"><a href="https://www.facebook.com/Gordsssssssssssssssss"><i class="fa-brands fa-facebook fa-2xl"></i></a></p>
        </div><!-- /.col-lg-4 -->

        <div class="col-lg-6 my-3 text-center">
          <img src="img/tarras.jpg" class="rounded-circle mx-auto d-block" width="280" height="260" alt="your image description">
          <h2 class="fw-normal mt-3"><b>JOMARI TARRAS</b></h2>
          <p class="text-center">System Analyst/Archivist</p>
          <p class="text-center"><a href="https://www.facebook.com/jomari.tacujantaras"><i class="fa-brands fa-facebook fa-2xl"></i></a></p>
        </div><!-- /.col-lg-4 -->

        <div class="col-lg-6 my-3 text-center">
          <img src="your-image-file-3.jpg" class="rounded-circle mx-auto d-block" width="280" height="260" alt="your image description">
          <h2 class="fw-normal mt-3"><b>JESSIEKELLY EGUAC</b></h2>
          <p class="text-center">Project Manager</p>
          <p class="text-center"><a href="#"><i class="fa-brands fa-facebook fa-2xl"></i></a></p>
        </div><!-- /.col-lg-4 -->

      </div><!-- /.row -->
    </div><!-- /.container -->

    <div class="container" style="margin-top:15rem;margin-bottom:7rem;">

    <div style="background-color:#1a1a1a; color:white;">
    <h1 class="featurette-heading fw-normal lh-1 mb-1 m-auto text-center"><b>MEMBERS - INVENTORY SYSTEM</b></h1>
    </div>
    <div class="h-line bg-dark" style="margin-bottom:7rem;"></div>

      <div class="row">

        <div class="col-lg-6 my-3 text-center">
          <img src="img/sam.jpg" class="rounded-circle mx-auto d-block" width="280" height="260" alt="your image description">
          <h2 class="fw-normal mt-3"><b>AHMAD M. SALASAIN</b></h2>
          <p class="text-center">Frontend Developer</p>
          <p class="text-center"><a href="https://www.facebook.com/sam.cena.902604"><i class="fa-brands fa-facebook fa-2xl"></i></a></p>
        </div><!-- /.col-lg-4 -->

        <div class="col-lg-6 my-3 text-center">
          <img src="img/tan.jpg" class="rounded-circle mx-auto d-block" width="280" height="260" alt="your image description">
          <h2 class="fw-normal mt-3"><b>KLARENE HILARY TAN</b></h2>
          <p class="text-center">Business Analyst</p>
          <p class="text-center"><a href="https://www.facebook.com/RaeRa.KimTan"><i class="fa-brands fa-facebook fa-2xl"></i></a></p>
        </div><!-- /.col-lg-4 -->

        <div class="col-lg-6 my-3 text-center">
          <img src="img/daryl.jpg" class="rounded-circle mx-auto d-block" width="280" height="260" alt="your image description">
          <h2 class="fw-normal mt-3"><b>DARRYL FRANCISCO</b></h2>
          <p class="text-center">Backend Developer</p>
          <p class="text-center"><a href="https://www.facebook.com/darrygil.francisco"><i class="fa-brands fa-facebook fa-2xl"></i></a></p>
        </div><!-- /.col-lg-4 -->

        <div class="col-lg-6 my-3 text-center">
          <img src="img/realyn.jpg" class="rounded-circle mx-auto d-block" width="280" height="260" alt="your image description">
          <h2 class="fw-normal mt-3"><b>REALYN LUMIGAN</b></h2>
          <p class="text-center">Project Manager</p>
          <p class="text-center"><a href="https://www.facebook.com/realyn.lumigan"><i class="fa-brands fa-facebook fa-2xl"></i></a></p>
        </div><!-- /.col-lg-4 -->

      </div><!-- /.row -->
    </div><!-- /.container -->


    <div class="container" style="margin-top:16rem;margin-bottom:7rem;">
      <div class="row">

        <div class="col-lg-12 my-3 text-center">
          <h2 class="fw-normal mt-3"><b>JASON A. CATADMAN</b></h2>
          <p class="text-center">Adviser</p>
          <p class="text-center"><a href="#"><i class="fa-brands fa-facebook fa-2xl"></i></a></p>
        </div><!-- /.col-lg-4 -->


      </div><!-- /.row -->
    </div><!-- /.container -->


    

  

  <h6 class="text-center bg-dark text-white p-3m m-0">Develop by reuel mendoza</h6>
<!-- Login Modal -->

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
                <label class="form-label">Email </label>
                <input type="text" class="form-control shadow-none" required name="email_mob" >
                </div>
                <div class="mb-4">

                <!--<label class="form-label">Password</label>
                <input type="password" class="form-control shadow-none mb-2" name="loginpass" autocomplete="current-password" required="" id="id_password">
                <i class="far fa-eye icon-login" required="" id="togglePassword"></i>-->
                
                </div>

                <div class="mb-4"><button type="submit" class="btn btn-success mb-2 w-100 ">Login</button></div>
              
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
                <form id="register-form">
                    <div class="modal-content">
                    <div class="modal-header">
              <h5 class="modal-title d-flex align-items-center"><i class="bi bi-person-plus-fill fs-3 me-2"></i></i>Student Registration</h5>
              <button type="reset" class="btn-close shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <div class="text-center">
              <span class="badge rounded-pill bg-light text-dark mb-3 text-wrap lh-base ">
                Note: Your Details must match with your ID that will be required during barrowing slip.
              </span>
              </div>
              <div class="container-fluid">
                <div class="row">
                  <div class="col-md-6 ps-0 mb-3">
                    <label class="form-label">Name</label>
                    <input type="text" class="form-control shadow-none" required name="name">
                  </div>
                  <div class="col-md-6 ps-0 mb-3">
                    <label class="form-label">Student ID</label>
                    <input type="text" class="form-control shadow-none" required name="student_id">
                  </div>
                  <div class="col-md-6 ps-0 mb-3">
                    <label class="form-label">Wmsu Email</label>
                    <input type="email" class="form-control shadow-none" required name="email">
                  </div>
                  <div class="col-md-6 ps-0 mb-3">
                    <label class="form-label">Phone Number</label>
                    <input type="number" class="form-control shadow-none" required name="phonenum">
                  </div>
                  <div class="col-md-3 ps-0 mb-3">
                    <label class="form-label">Course</label>
                    <select class='form-select shadow-none' aria-label='Default select example' name='course' required>
                    <option disabled selected value="">Select course...</option> <!-- placeholder option -->
                      <option value="biology">Biology</option>
                      <option value="chemistry">Chemistry</option>
                    </select>
                  </div>
                  <div class="col-md-3 ps-0 mb-3">
                    <label class="form-label">Year</label>
                    <select class='form-select shadow-none' aria-label='Default select example' name='year' required>
                    <option disabled selected value="">Select Year...</option> <!-- placeholder option -->
                      <option value="1st">1st</option>
                      <option value="2nd">2nd</option>
                      <option value="3rd">3rd</option>
                      <option value="4th">4th</option>
                      <option value="5th">5th</option>
                    </select>
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


 let register_form = document.getElementById('register-form');


register_form.addEventListener('submit',function(e){
 e.preventDefault();
 add_User();

});


function add_User(){

let data = new FormData();
data.append('name',register_form.elements['name'].value);
data.append('student_id',register_form.elements['student_id'].value);
data.append('email',register_form.elements['email'].value);
data.append('phonenum',register_form.elements['phonenum'].value);

// data.append('pass',register_form.elements['pass'].value);
data.append('course',register_form.elements['course'].value);
data.append('year',register_form.elements['year'].value);


// data.append('cpass',register_form.elements['cpass'].value);
data.append('register','');

let xhr = new XMLHttpRequest();
xhr.open("POST","ajax/login_register.php",true);


  var myModalEl = document.getElementById('registerModal')
  var modal = bootstrap.Modal.getInstance(myModalEl) // Returns a Bootstrap modal instanceof
  modal.hide();
xhr.onload = function(){
    if(this.responseText == 'password_mismatch'){
   
      alert('Password Mismatch');
    }
    // else if(this.responseText == 'email_already'){
    //   alert('Email Already Exist');
    // }
    // else if(this.responseText == 'phone_already'){
    //   alert('Phone Number Already Use');
    // }
    // else if(this.responseText == 'mail_failed'){
    //   alert('Cannot send confirmation email');
    // }
    // else if(this.responseText == 'ins_failed'){
    //   alert('Registration Failed');
    // }
    else{
      Swal.fire(
      'Successfully Registered ',
      'Confirm Register',
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
          // data.append('loginpass',login_form.elements['loginpass'].value);
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
                window.location = window.location.pathname;
               
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


function checkLoginToBook(status,room_id){
  if(status){
    window.location.href='confirm_booking.php?id='+room_id;
  }
  else{
    Swal.fire({
  position: 'top-end',
  icon: 'warning',
  title: 'Please Login First to Barrowing Item',
  showConfirmButton: false,
  timer: 1500,
  
});
  }
}


let chemical_data = document.getElementById('chemical-data');



function fetch_chemical(){

let xhr = new XMLHttpRequest();
xhr.open("GET","ajax/chemical.php?fetch_chemical",true);

xhr.onprogress = function(){
  chemical_data.innerHTML = ` <div class="spinner-border text-info mb-3 d-block mx-auto" id="info" role="status">
                  <span class="visually-hidden">Loading...</span>
                </div>`;
}

xhr.onload = function(){
    chemical_data.innerHTML = this.responseText;
}

xhr.send();
}




function search_chemical(chemicalname){

    let xhr = new XMLHttpRequest();
    xhr.open("POST","ajax/chemical.php",true);
    xhr.setRequestHeader('Content-Type','application/x-www-form-urlencoded');

    xhr.onload = function(){
        document.getElementById('chemical-data').innerHTML = this.responseText;
    }
    xhr.send('search_chemical&name='+chemicalname);
}



window.onload= function(){
fetch_chemical();
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



function checkLoginToBook(status,chemical_id){
  if(status){
    window.location.href='chemical_booking.php?id='+chemical_id;
  }
  else{
    Swal.fire({
  position: 'top-end',
  icon: 'warning',
  title: 'Please Login First to borrowing item',
  showConfirmButton: false,
  timer: 1500,
  
});
  }
}

 
// function search_room(chemicalname){

// let xhr = new XMLHttpRequest();
// xhr.open("POST","ajax/room.php",true);
// xhr.setRequestHeader('Content-Type','application/x-www-form-urlencoded');

// xhr.onload = function(){
//     document.getElementById('rooms-data').innerHTML = this.responseText;
// }
// xhr.send('search_room&name='+chemicalname);
// }





// function search_chemical(chemicalname){

// let xhr = new XMLHttpRequest();
// xhr.open("POST","ajax/chemical.php",true);
// xhr.setRequestHeader('Content-Type','application/x-www-form-urlencoded');

// xhr.onload = function(){
//     document.getElementById('rooms-data').innerHTML = this.responseText;
// }
// xhr.send('search_room&name='+roomname);
// }



</script>




</body>
</html>