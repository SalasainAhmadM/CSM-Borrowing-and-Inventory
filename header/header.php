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




<nav class="navbar navbar-expand-lg bg-white px-lg-3 py-lg-2 shadow-sm sticky-top nav-user">
  <div class="container-fluid">
    <a class="navbar-brand me-5 fw-bold fs-3" href="index.php">
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
          <a class="nav-link active me-3 fw-bold" aria-current="page" href="index.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link me-3 fw-bold" href="rooms.php">Apparatus</a>
        </li>
        <li class="nav-item">
          <a class="nav-link me-3 fw-bold" href="chemical.php">Chemical</a>
        </li>
        <li class="nav-item">
          <a class="nav-link me-3 fw-bold" href="equipment.php">Equipment</a>
        </li>
        <li class="nav-item">
          <a class="nav-link me-3 fw-bold" href="about.php">About</a>
        </li>

      </ul>
      <div class="d-flex">
        <?php

        if (isset($_SESSION['login']) && $_SESSION['login'] == true) {
          echo <<<data
              
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