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
  <title>CSM</title>
  <link rel="stylesheet" href="main.css" type="text/css" />
  <link rel="icon" href="img/logo.jpg">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">

  <!-- Link Swiper's CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@simonwep/pickr/dist/themes/classic.min.css" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.css" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">


</head>

<body class="bg-light">

  <?php

  require("./header/header.php")

    ?>

  <div class="container-fluid px-lg-4 mt-2">
    <div class="swiper swiper-container">
      <div class="swiper-wrapper">
        <div class="swiper-slide">
          <img src="./img/csm1.jpg" class="h-50 w-100 d-block" />
        </div>

      </div>
    </div>


    <h6 class="text-center bg-dark text-white p-3m m-0">Develop by reuel mendoza</h6>




    <!-- JavaScript Bundle with Popper -->
    <script src="admin/color.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@simonwep/pickr/dist/pickr.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa"
      crossorigin="anonymous"></script>
    <!-- Swiper JS -->
    <script src="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.js"></script>



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
                <label class="form-label">Email </label>
                <input type="text" class="form-control shadow-none" required name="email_mob">
              </div>
              <div class="mb-4">



              </div>

              <div class="mb-4"><button type="submit" class="btn btn-success mb-2 w-100 ">Login</button></div>

              <div class="modal-footer">
                <button type="button" class="btn btn-success " style="margin-right:120px;" data-bs-toggle="modal"
                  data-bs-target="#registerModal">Create New Account</button>
              </div>

            </div>
          </form>
        </div>
      </div>
    </div>






    <div class="modal fade" id="registerModal" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1"
      aria-labelledby="staticBackdropLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <form id="register-form" method="POST">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title d-flex align-items-center"><i
                  class="bi bi-person-plus-fill fs-3 me-2"></i></i>Student Registration</h5>
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







    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>




      <?php

      require("./js/login_register.js")
        ?>





    </script>







</body>

</html>