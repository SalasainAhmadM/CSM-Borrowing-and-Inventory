<?php

require("alert.php");
require("db.php");
adminLogin();
// session_regenerate_id(true);

?>



<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <link href="./csmlogo.png" rel="icon">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>CSM - DASHBOARD</title>
  <!-- CSS only -->
  <link rel="stylesheet" href="dash.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">




  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">


</head>

<body class="bg-light">


  <?php require('header.php');



  $is_shutdown = mysqli_fetch_assoc(mysqli_query($con, "SELECT `shutdown` FROM `settings`"));

  $current_bookings = mysqli_fetch_assoc(mysqli_query($con, "SELECT COUNT(CASE WHEN booking_status='booked' AND arrival=0 THEN 1 END) AS `new_bookings`, COUNT(CASE WHEN booking_status='cancelled' AND refund=0 then 1 END) AS `refund_bookings` FROM `booking_order`"));

  $unread_queries = mysqli_fetch_assoc(mysqli_query($con, "SELECT COUNT(sr_no) AS `count` FROM `user_queries` WHERE `seen`=0"));

  $unread_reviews = mysqli_fetch_assoc(mysqli_query($con, "SELECT COUNT(sr_no) AS `count` FROM `rating_review` WHERE `seen`=0"));


  $current_user = mysqli_fetch_assoc(mysqli_query($con, "SELECT COUNT(id) AS `total`, COUNT(CASE WHEN `status`=1 THEN 1 END) AS `active`, COUNT(CASE WHEN `status`=0  then 1 END) AS `inactive`, COUNT(CASE WHEN `is_verified`=0  then 1 END) AS `unverified` FROM `user_cred`"));


  $username = "root";
  $password = "";
  $database = "klc";

  try {
    $pdo = new PDO("mysql:host=localhost;database=$database", $username, $password);

    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  } catch (PDOException $e) {
    die("ERROR: Could not connect" . $e->getMessage());
  }





  ?>










  <div class="container-fluid" id="main-content">
    <div class="row">
      <div class="col-lg-10 ms-auto p-4 overflow-hidden">
        <div class="d-flex align-items-center justify-content-between mb-4">
          <h3><i class="bi bi-people"></i> Dashboard</h3>
          <?php
          if ($is_shutdown['shutdown']) {
            echo <<<data
              <h6 class="badge bg-danger py-2 px-3">Shutdown Mode is Active!</h6>
              data;
          }
          ?>

        </div>







        <?php

        try {
          $sql = "SELECT bo.*, bd.*  FROM csm.booking_order bo INNER JOIN csm.booking_details bd ON bo.booking_id = bd.booking_id";
          $result = $pdo->query($sql);
          if ($result->rowCount() > 0) {

            $dateArray = [];
            while ($row = $result->fetch()) {
              $dateArray[] = $row["datentime"];
              $amountArray[] = $row["total_pay"];

            }

            unset($result);
          } else {
            echo "No Records Found";
          }
        } catch (PDOException $e) {
          die("ERROR: Could not able to execute query" . $e->getMessage());
        }

        unset($pdo);








        ?>








        <div class="d-flex align-items-center justify-content-between mb-3">
          <h5><i class="bi bi-journals"></i> Breakage Analytics</h5>
          <select class="form-select shadow-none bg-light w-auto" onchange="booking_analytics(this.value)">
            <option value="1">1st Sem</option>
            <option value="2">2nd Sem</option>
            <option value="4">All Time</option>
          </select>
        </div>


        <div class="col-md-3 mb-4">
          <div class="card text-center p-3 text-primary ">
            <a href="breakage.php" class="text-decoration-none">
              <h6><i class="bi bi-x-square"></i> All Breakage Record of Apparatus</h6>
            </a>
            <h1 class="mt-2 mb-0" id="cancelled_bookings">0</h1>

          </div>
        </div>
      </div>





      <!-- JavaScript Bundle with Popper -->
      <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa"
        crossorigin="anonymous"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js"
        integrity="sha512-STof4xm1wgkfm7heWqFJVn58Hm3EtS31XFaagaa8VMReCXAkQnJZ+jEy8PCC/iT18dFy95WcExNHFTqLyp72eQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
      <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>





      <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/chart.js"></script>
      <script src="https://cdn.jsdelivr.net/npm/chart.js/dist/chart.min.js"></script>
      <script
        src="https://cdn.jsdelivr.net/npm/chartjs-adapter-date-fns/dist/chartjs-adapter-date-fns.bundle.min.js"></script>






      <script>




        function booking_analytics(period = 1) {

          let xhr = new XMLHttpRequest();
          xhr.open("POST", "./dashboard/dashboard_ajax.php", true);
          xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

          xhr.onload = function () {
            let data = JSON.parse(this.responseText);


            document.getElementById('cancelled_bookings').textContent = data.cancelled_bookings;

          }
          xhr.send('booking_analytics&period=' + period);

        }




        // function user_analytics(period=1){

        //         let xhr = new XMLHttpRequest();
        //             xhr.open("POST","dashboard/dashboard_ajax.php",true);
        //             xhr.setRequestHeader('Content-Type','application/x-www-form-urlencoded');

        //             xhr.onload = function(){
        //                 let data = JSON.parse(this.responseText);
        //                 document.getElementById('total_new_reg').textContent = data.total_new_reg;


        //                 document.getElementById('total_queries').textContent = data.total_queries;


        //                 document.getElementById('total_review').textContent = data.total_review;

        //             }
        //             xhr.send('user_analytics&period='+period);

        //     }




        window.onload = function () {
          booking_analytics();
          // user_analytics();
        }







      </script>











</body>

</html>