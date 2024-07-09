<?php

require('admin/db_config.php');
require('admin/alert.php');

?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>KLC HOMES - Room-Details</title>
  <link rel="stylesheet" href="main.css" type="text/css" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
  <link rel="icon" href="img/logo.jpg">
  <!-- Link Swiper's CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.css" />
  <!-- CSS only -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">


</head>

<body class="bg-light">
  <?php
  session_start();
  date_default_timezone_set("Asia/Manila");

  $home_q = "SELECT * FROM `settings` WHERE `sr_no`=?";
  $values = [1];
  $home_r = mysqli_fetch_assoc(select($home_q, $values, 'i'));


  if ($home_r['shutdown'] == 1) {
    echo <<<alertbar
  <div class='bg-secondary text-center p-2 fw-bold text-white'>
  <i class='bi bi-exclamation-triangle'></i> Reservations are temporarily closed because there are no available rooms!
  </div>
  alertbar;
  }

  ?>


  <?php



  if (!isset($_GET['id'])) {
    redirect('rooms.php');
  }

  $data = filteration($_GET);

  $room_res = select("SELECT * FROM `rooms` WHERE `id`=? AND  `status`=? AND `removed`=?", [$data['id'], 1, 0], 'iii');

  if (mysqli_num_rows($room_res) == 0) {
    redirect('rooms.php');
  }

  $room_data = mysqli_fetch_assoc($room_res);
  ?>

  <nav class="navbar navbar-expand-lg bg-white px-lg-3 py-lg-2 shadow-sm sticky-top">
    <div class="container-fluid">
      <a class="navbar-brand me-5 fw-bold fs-3" href="index.php"><i class="bi bi-house-fill"></i>
        <?php echo $home_r['site_title'] ?>
      </a>
      <button class="navbar-toggler shadow-none" type="button" data-bs-toggle="collapse"
        data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
        aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link me-3 fw-bold" aria-current="page" href="index.php">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active me-3 fw-bold" href="rooms.php">Apparatus</a>
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

          if (isset($_SESSION['login']) && $_SESSION['login'] == true) {
            echo <<<data
            
            <div class="btn-group">
            <button type="button" class="btn btn-outline-dark dropdown-toggle shadow-none" data-bs-toggle="dropdown" data-bs-display="static" aria-expanded="false">
                
                $_SESSION[uName]
                </button>
                <ul class="dropdown-menu dropdown-menu-lg-end">
             
                  <li><a class="dropdown-item" href="bookings.php">Your Booking</a></li>
                  <li><a class="dropdown-item" href="logout.php">Logout</a></li>
                </ul>
              </div>


            data;
          } else {
            echo <<<data

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

      <div class="col-12 my-5 mb-4 px-4">
        <div class="h2 fw-bold text-center">
          <?php echo $room_data['name'] ?>
        </div>
        <div class="h-line bg-dark"></div>
        <div style="font-size:15px;">
          <a href="index.php" class="text-secondary text-decoration-none">Home</a>
          <span class="text-secondary"> > </span>
          <a href="rooms.php" class="text-secondary text-decoration-none">Apparatus</a>
        </div>
      </div>


      <div class="col-lg-7 col-md-12 px-4 ">
        <div id="roomCarousel" class="carousel slide" data-bs-ride="carousel">
          <div class="carousel-inner">
            <?php


            $room_img = ROOM_IMG_PATH . "360_F_349457338_PLFgcgC2C0NFoEajYw45kfVo6hkJDp7S.jpg";
            $img_q = mysqli_query($con, "SELECT * FROM `room_images` WHERE `room_id`='$room_data[id]'");

            if (mysqli_num_rows($img_q) > 0) {
              $active_class = 'active';


              while ($img_res = mysqli_fetch_assoc($img_q)) {
                echo " <div class='carousel-item  $active_class'>
            <img src='" . ROOM_IMG_PATH . $img_res['image'] . "' class='d-block w-100 rounded'style='width:90%' >
            </div>";
                $active_class = '';
              }

            } else {
              echo " <div class='carousel-item active'>
            <img src='$room_img' class='d-block w-100' >
            </div>";
            }


            ?>

          </div>
          <button class="carousel-control-prev" type="button" data-bs-target="#roomCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
          </button>
          <button class="carousel-control-next" type="button" data-bs-target="#roomCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
          </button>
        </div>
      </div>




      <div class="col-lg-5 col-md-12 px-4">
        <div class="card mb-4 border-0 shadow-sm rounded-3">
          <div class="card-body">
            <?php

            $book_btn = "";

            if (!$home_r['shutdown']) {
              $book_btn = "<a href='#' class='btn btn-success w-100 text-white shadow-none mb-1'>Reserve Now</a>";
            }




            $rating_q = "SELECT AVG(rating) AS `avg_rating` FROM `rating_review` WHERE `room_id`='$room_data[id]' ORDER BY `sr_no` DESC LIMIT 20";

            $rating_res = mysqli_query($con, $rating_q);
            $rating_fetch = mysqli_fetch_assoc($rating_res);

            $rating_data = "";

            if ($rating_fetch['avg_rating'] != NULL) {

              for ($i = 0; $i < $rating_fetch['avg_rating']; $i++) {
                $rating_data .= " <i class='bi bi-star-fill text-warning'></i>";
              }

            }


            echo <<<rating
                <div class="mb-3">
                    $rating_data
                </div>
              rating;

            $fac_q = mysqli_query($con, "SELECT f.name FROM `features` f INNER JOIN `room_facilities` rfac ON f.id = rfac.facilities_id WHERE rfac.room_id = '$room_data[id]'");

            $facilities_data = "";
            while ($fac_row = mysqli_fetch_assoc($fac_q)) {
              $facilities_data .= " <span class='badge rounded-pill bg-light text-dark text-wrap me-1 mb-1'>
                    $fac_row[name]
                    </span>";
            }

            echo <<<facilities
                    <div class="mb-3">
                      <h6 class="mb-1">Description</h6>
                      $room_data[description]
                    </div>
                  facilities;

            echo <<<guests
                  <div class="mb-3">
                    <h6 class="mb-1">Details</h6>
                      <span class="badge rounded-pill bg-light text-dark text-wrap">
                        $room_data[adult] Available
                      </span>
                      <span class="badge rounded-pill bg-light text-dark text-wrap">
                           $room_data[children] per Student
                     </span>
                    </div>
                  guests;

            echo <<<area
                    <div class="mb-3">
                      <h6 class="mb-1">Size</h6>
                     <span class="badge rounded-pill bg-light text-dark text-wrap">
                         $room_data[area] $facilities_data
                     </span>
                    </div>
                  area;




            if (!$home_r['shutdown']) {
              $login = 0;
              if (isset($_SESSION['login']) && $_SESSION['login'] == true) {
                $login = 1;
              }
              echo <<<book
                        <button onclick='checkLoginToBook($login,$room_data[id])' class='btn btn-success w-100 text-white shadow-none mb-2'>Reserve Now</button>
                    book;

            }








            ?>
          </div>
        </div>
      </div>







    </div>
  </div>

  <?php

  $contact_q = "SELECT * FROM `contact_details` WHERE `sr_no`=?";
  $values = [1];
  $contact_r = mysqli_fetch_assoc(select($contact_q, $values, 'i'));
  // print_r($contact_r);
  ?>


  <!----Footer--->

  <div class="container-fluid bg-white mt-5">
    <div class="row">
      <div class="col-lg-4 p-4">
        <h3 class="fw-bold fs-3 mb-4">KLC HOMES</h3>
        <p>KLC Homes
          Calle San Pedro, Zone 1
          Ayala Zamboanga City
        </p>
      </div>
      <div class="col-lg-4 p-4">
        <h5 class="mb-3">Links</h5>
        <a href="index.php" class="d-inline-block mb-2 text-decoration-none text-dark">HOME</a><br>
        <a href="rooms.php" class="d-inline-block mb-2 text-decoration-none text-dark">ROOM</a><br>
        <a href="about.php" class="d-inline-block mb-2 text-decoration-none text-dark">ABOUT US</a><br>
        <a href="contact.php" class="d-inline-block mb-2 text-decoration-none text-dark">CONTACT US</a>

      </div>
      <div class="col-lg-4 p-4">
        <h5 class="mb-3">Follow Us</h5>
        <?php
        if ($contact_r['fb'] != '') {
          echo <<<data

                        <a href="$contact_r[fb]" target="_blank" class="d-inline-block text-dark fs-5 me-2">
                          <i class="bi bi-facebook me-1"></i>
                        </a>

                        data;
        }

        ?>

        <?php
        if ($contact_r['insta'] != '') {
          echo <<<data

                        <a href="$contact_r[insta]" target="_blank" class="d-inline-block text-dark fs-5 me-2">
                          <i class="bi bi-instagram me-1"></i>
                        </a>

                        data;
        }

        ?>

        <?php
        if ($contact_r['tw'] != '') {
          echo <<<data

                        <a href="$contact_r[tw]" target="_blank" class="d-inline-block text-dark fs-5 me-2">
                          <i class="bi bi-twitter me-1"></i>
                        </a>

                        data;
        }

        ?>
      </div>
    </div>
  </div>

  <h6 class="text-center bg-dark text-white p-3m m-0">Designed and Develop by KLC HOMES TEAM</h6>
  <!-- Login Modal -->
  <div class="modal fade" id="loginModal" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <form id="login-form" method="POST">
          <div class="modal-header">
            <h5 class="modal-title d-flex align-items-center"><i class="bi bi-person-check-fill fs-3 me-2"></i>User
              login</h5>
            <button type="reset" class="btn-close shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <div class="mb-3">
              <label class="form-label">Email/PhoneNumber</label>
              <input type="text" class="form-control shadow-none" required name="email_mob">
            </div>
            <div class="mb-4">
              <label class="form-label">Password</label>
              <input type="password" class="form-control shadow-none" required name="loginpass">
            </div>

            <div class="mb-4"><button type="submit" class="btn btn-success mb-2 w-100 ">Login</button></div>
            <div class="mb-2 text-center text-decoration-none">
              <a href="#" class="text-decoration-none" data-bs-toggle="modal" data-bs-target="#forgotModal">Forgot
                Password?</a>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-success " style="margin-right:120px;" data-bs-toggle="modal"
                data-bs-target="#registerModal">Create New Account</button>
            </div>

          </div>
        </form>
      </div>
    </div>
  </div>



  <!---Forgot modal -->
  <div class="modal fade" id="forgotModal" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <form id="forgot-form">
          <div class="modal-header">
            <h5 class="modal-title d-flex align-items-center"><i class="bi bi-shield-exclamation"></i> Forgot Password
            </h5>
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
  <div class="modal fade" id="recoveryModal" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
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






  <div class="modal fade" id="registerModal" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <form id="register-form">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title d-flex align-items-center"><i class="bi bi-person-plus-fill fs-3 me-2"></i></i>User
              Registration</h5>
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
                <div class="col-md-6 p-0 mb-3">
                  <label class="form-label">Wmsu Email</label>
                  <input type="email" class="form-control shadow-none" required name="email">
                </div>
                <div class="col-md-6 ps-0 mb-3">
                  <label class="form-label">Phone Number</label>
                  <input type="number" class="form-control shadow-none" required name="phonenum">
                </div>
                <div class="col-md-6 ps-0 mb-3">
                  <label class="form-label">Course/Year</label>
                  <input type="text" class="form-control shadow-none" required name="course">
                </div>
                <div class="col-md-6 ps-0 mb-3">
                  <label class="form-label">Address</label>
                  <input type="text" class="form-control shadow-none" required name="address">
                  <!-- <textarea class="form-control shadow-none" name="address" rows="3" style="resize: none;" required></textarea>-->
                </div>
                <div class="col-md-6 ps-0 mb-3">
                  <label class="form-label">Password<span
                      class="badge rounded-pill bg-light text-dark text-wrap lh-base ">
                      (8 characters minimum)
                    </span></label>
                  <input type="password" class="form-control shadow-none mb-1" required name="pass" minlength="8"
                    required="" autocomplete="current-password" id="myInput">
                  <input type="checkbox" onclick="myFunction()"> Show
                  Password<!--<i class="far fa-eye icon-pass" required="" id="togglePassword"></i>-->
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

  if (isset($_GET['account_recovery'])) {
    $data = filteration($_GET);

    $t_date = date("Y-m-d");

    $query = select("SELECT * FROM `user_cred` WHERE `email`=? AND `token`=? AND `t_expire`=? LIMIT 1", [$data['email'], $data['token'], $t_date], 'sss');


    if (mysqli_num_rows($query) == 1) {
      echo <<<showModal
      <script>
    var myModal = document.getElementById('recoveryModal')

    myModal.querySelector("input[name='email']").value = '$data[email]';
    myModal.querySelector("input[name='token']").value = '$data[token]';

    var modal = bootstrap.Modal.getOrCreateInstance(myModal) // Returns a Bootstrap modal instanceof
    modal.show();
    </script>
    showModal;
    } else {
      echo '<script>alert("Invalid Link")</script>';
    }

  }

  ?>






  <!-- JavaScript Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa"
    crossorigin="anonymous"></script>
  <!-- Swiper JS -->
  <!-- Swiper JS -->
  <script src="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.js"></script>


  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>





  <script>


    let register_form = document.getElementById('register-form');


    register_form.addEventListener('submit', function (e) {
      e.preventDefault();
      add_User();

    });


    function add_User() {

      let data = new FormData();
      data.append('name', register_form.elements['name'].value);
      data.append('email', register_form.elements['email'].value);
      data.append('phonenum', register_form.elements['phonenum'].value);
      data.append('address', register_form.elements['address'].value);
      data.append('pass', register_form.elements['pass'].value);
      data.append('cpass', register_form.elements['cpass'].value);
      data.append('register', '');

      // var myModalEl = document.getElementById('registerModal')
      //     var modal = bootstrap.Modal.getInstance(myModalEl) // Returns a Bootstrap modal instanceof
      //     modal.hide();

      let xhr = new XMLHttpRequest();
      xhr.open("POST", "./ajax/login_register.php", true);

      var myModalEl = document.getElementById('registerModal')
      var modal = bootstrap.Modal.getInstance(myModalEl) // Returns a Bootstrap modal instanceof
      modal.hide();


      xhr.onload = function () {
        if (this.responseText == 'password_mismatch') {
          alert('Password Mismatch');
        }
        else if (this.responseText == 'email_already') {
          alert('Email Already Exist');
        }
        else if (this.responseText == 'phone_already') {
          alert('Phone Number Already Use');
        }
        else if (this.responseText == 'mail_failed') {
          alert('Cannot send confirmation email');
        }
        else if (this.responseText == 'ins_failed') {
          alert('Registration Failed');
        }
        else {
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
    login_form.addEventListener('submit', function (e) {
      e.preventDefault();
      login_User();

    });

    function login_User() {
      let data = new FormData();
      data.append('email_mob', login_form.elements['email_mob'].value);
      data.append('loginpass', login_form.elements['loginpass'].value);
      data.append('login', '');

      let xhr = new XMLHttpRequest();
      xhr.open("POST", "./ajax/login_register.php", true);

      var myModalEl = document.getElementById('loginModal')
      var modal = bootstrap.Modal.getInstance(myModalEl) // Returns a Bootstrap modal instanceof
      modal.hide();
      xhr.onload = function () {
        if (this.responseText == 'inv_email_mob') {
          alert('Invalid Email or Phone Number');
        }
        else if (this.responseText == 'not_verified') {
          alert('Email is not verified');
        }
        else if (this.responseText == 'inactive') {
          alert('Account Suspended Please contact the Admin');
        }
        else if (this.responseText == 'invalid_pass') {
          alert('Incorrect Password');
        }
        else {
          let fileurl = window.location.href.split('/').pop().split('?').shift();
          if (fileurl == 'room_details.php') {
            window.location = window.location.href;
          } else {
            window.location = window.location.pathname;
          }
        }
      }
      xhr.send(data);
    }




    let forgot_form = document.getElementById('forgot-form');
    forgot_form.addEventListener('submit', function (e) {
      e.preventDefault();
      forgot_pass();

    });

    function forgot_pass() {
      let data = new FormData();
      data.append('email', forgot_form.elements['email'].value);
      data.append('forgot', '');

      let xhr = new XMLHttpRequest();
      xhr.open("POST", "./ajax/login_register.php", true);

      var myModalEl = document.getElementById('forgotModal')
      var modal = bootstrap.Modal.getInstance(myModalEl) // Returns a Bootstrap modal instanceof
      modal.hide();


      xhr.onload = function () {
        if (this.responseText == 'inv_email') {
          alert('Password Mismatch');
        }
        else if (this.responseText == 'not_verified') {
          alert('Email is not verified Please contact the administrator');
        }
        else if (this.responseText == 'inactive') {
          alert('Account is inactive Please contact the administrator');
        }
        else if (this.responseText == 'email_failed') {
          alert('Cannot send email');
        } else if (this.responseText == 'upd_failed') {
          alert('Account recovery failed')
        }
        else {
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

    recovery_form.addEventListener('submit', function (e) {
      e.preventDefault();
      recovery_pass();

    });

    function recovery_pass() {
      let data = new FormData();

      data.append('email', recovery_form.elements['email'].value);
      data.append('token', recovery_form.elements['token'].value);
      data.append('pass', recovery_form.elements['pass'].value);
      data.append('recovery_pass', '');

      let xhr = new XMLHttpRequest();
      xhr.open("POST", "./ajax/login_register.php", true);

      var myModalEl = document.getElementById('recoveryModal')
      var modal = bootstrap.Modal.getInstance(myModalEl) // Returns a Bootstrap modal instanceof
      modal.hide();

      xhr.onload = function () {
        if (this.responseText == 'failed') {
          alert('Recovery Email Failed');
        }
        else {
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




    function checkLoginToBook(status, room_id) {
      if (status) {
        window.location.href = 'confirm_booking.php?id=' + room_id;
      }
      else {
        Swal.fire({
          position: 'top-end',
          icon: 'warning',
          title: 'Please Login First to Reserve Room',
          showConfirmButton: false,
          timer: 1500,

        });
      }
    }






  </script>




</body>

</html>