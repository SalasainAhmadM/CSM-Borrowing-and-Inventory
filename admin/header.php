<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="dashie.css">
</head>

<body>


  <?php




  $home_q = "SELECT * FROM `settings` WHERE `sr_no`=?";
  $values = [1];
  $home_r = mysqli_fetch_assoc(select($home_q, $values, 'i'));





  ?>
  <div class="container-fluid admin-dash text-light p-3 d-flex align-items-center justify-content-between sticky-top">
    <h3 class="mb-0">
      <?php echo $home_r['site_title'] ?>
    </h3>
    <a href="logout.php" class="btn btn-light shadow-none me-lg-2 me-3"> <i class="bi bi-box-arrow-right"></i></a>
  </div>

  <div class="col-lg-2  border-top border-3 dashboard admin-navbar " id="dashboard">
    <nav class="navbar navbar-expand-lg navbar-dark">
      <div class="container-fluid flex-lg-column align-items-stretch">
        <h5 class="mt-2 text-center text-light" style="font-size:18px;">

          </li>
        </h5>
        <button class="navbar-toggler shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#admin"
          aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse align-items-stretch mt-2 flex-column navbar-admin overflow-auto" id="admin"
          style="height: 500px; overflow-y: auto;">
          <ul class="nav nav-pills flex-column">
            <li class="nav-item navbar-admin">
              <a class="nav-link text-white" href="dashboard.php"><i class="bi bi-people"></i> Dashboard</a>
            </li>

            <li class="nav-item navbar-admin">
              <a class="nav-link " href="clearance.php"><i class="bi bi-clipboard-check"></i> Clearance</a>
            </li>

            <li class="nav-item navbar-admin">
              <button
                class="btn text-white px-3 w-100 shadow-none text-start d-flex align-items-center justify-content-between "
                type="button" data-bs-toggle="collapse" data-bs-target="#bookingLinks">
                <span><i class="bi bi-journal-check"></i> Apparatus Records</span>
                <span><i class="bi bi-caret-down-fill"></i></i></span>
              </button>

              <div class="collapse show px-3 small mb-2" id="bookingLinks">
                <ul class="nav nav-pills flex-column rounded border border-secondary mb-2">
                  <li class="nav-item">
                    <a class="nav-link text-white" href="new_bookings.php"> New Apparatatus Borrowing</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link text-white" href="refund_bookings.php"> Breakage Section</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link text-white" href="records.php"> All Apparatus Records</a>
                  </li>

                </ul>
              </div>

            </li>



            <li class="nav-item navbar-admin">
              <button
                class="btn text-white px-3 w-100 shadow-none text-start d-flex align-items-center justify-content-between "
                type="button" data-bs-toggle="collapse" data-bs-target="#chemicalLinks">
                <span><i class="bi bi-journal-check"></i> Chemical Records</span>
                <span><i class="bi bi-caret-down-fill"></i></i></span>
              </button>

              <div class="collapse show px-3 small mb-2" id="chemicalLinks">
                <ul class="nav nav-pills flex-column rounded border border-secondary mb-2">
                  <li class="nav-item">
                    <a class="nav-link text-white" href="new_bookings_chemical.php"> New Chemical Confirmation</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link text-white" href="records_chemical.php"> All Chemical Records</a>
                  </li>

                </ul>
              </div>

            </li>

            <li class="nav-item navbar-admin">
              <button
                class="btn text-white px-3 w-100 shadow-none text-start d-flex align-items-center justify-content-between "
                type="button" data-bs-toggle="collapse" data-bs-target="#equipmentLinks">
                <span><i class="bi bi-journal-check"></i> Equipment Records</span>
                <span><i class="bi bi-caret-down-fill"></i></i></span>
              </button>

              <div class="collapse show px-3 small mb-2" id="equipmentLinks">
                <ul class="nav nav-pills flex-column rounded border border-secondary mb-2">
                  <li class="nav-item">
                    <a class="nav-link text-white" href="new_bookings_equipment.php"> New Equipment Confirmation</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link text-white" href="records_equipment.php"> All Equipment Records</a>
                  </li>

                </ul>
              </div>

            </li>

            <li class="nav-item navbar-admin">
              <a class="nav-link " href="rooms.php"><i class="bi bi-clipboard-data"></i> Apparatus</a>
            </li>

            <li class="nav-item navbar-admin">
              <a class="nav-link " href="chemical.php"><i class="bi bi-clipboard2-pulse"></i> Chemical</a>
            </li>

            <li class="nav-item navbar-admin">
              <a class="nav-link " href="equipment.php"><i class="bi bi-clipboard2-pulse"></i> Equipment</a>
            </li>

            <li class="nav-item navbar-admin">
              <a class="nav-link " href="facilities.php"><i class="bi bi-house-heart-fill"></i> Size and Faculty</a>
            </li>
            <li class="nav-item navbar-admin">
              <a class="nav-link " href="breakage.php"><i class="bi bi-clipboard-x"></i> Breakage Records </a>
            </li>
            <!--<li class="nav-item navbar-admin">
            <a class="nav-link " href="rating_reviews.php"><i class="bi bi-chat-left-heart"></i> Rating & Reviews</a>
          </li>-->
            <li class="nav-item">
              <a class="nav-link  " href="users.php"><i class="bi bi-people"></i> All Users</a>
            </li>
            <!---<li class="nav-item">
            <a class="nav-link  " href="user_queries.php"><i class="bi bi-person-lines-fill"></i> Users Inquiry</a>
          </li>
            <li class="nav-item">
            <a class="nav-link  " href="carousel.php"><i class="bi bi-person-lines-fill"></i> Carousel </a>
          </li>-->
            <!--<li class="nav-item"> 
            <a class="nav-link " href="setting.php"><i class="bi bi-gear"></i> Setting</a>
          </li>-->
          </ul>
        </div>
      </div>
    </nav>
  </div>
</body>

</html>