<?php



require('../admin/db_config.php');
require('../admin/alert.php');


date_default_timezone_set("Asia/Manila");
session_start();


if (isset($_GET['fetch_chemical'])) {

  //count no of rooms and out variables to store rooms cards
  $count_chemical = 0;
  $output = "";

  //fetching settings table to check website is shutdown or not 
  $home_q = "SELECT * FROM `settings` WHERE `sr_no`=1";
  $home_r = mysqli_fetch_assoc(mysqli_query($con, $home_q));


  $chemical_res = select("SELECT * FROM `chemical` WHERE  `status`=?", [1], 'i');

  while ($chemical_data = mysqli_fetch_assoc($chemical_res)) {
    $fea_q = mysqli_query($con, "SELECT f.name FROM `features` f INNER JOIN `chemical_facilities` rfac ON f.id = rfac.facilities_id WHERE rfac.chemical_id ='$chemical_data[id]'");

    $facilities_data = "";
    while ($fea_row = mysqli_fetch_assoc($fea_q)) {
      $facilities_data .= "<span class='badge rounded-pill bg-light text-dark text-wrap'>$fea_row[name]</span>";


    }

    $chemical_btn = "";

    if (!$home_r['shutdown']) {
      $login = 0;
      if (isset($_SESSION['login']) && $_SESSION['login'] == true) {
        $login = 1;
      }
      $chemical_btn = "  <button onclick='checkLoginToBook($login,$chemical_data[id])' class='btn btn-success w-100 text-white shadow-none mb-2'>Borrowing Now</button>";
    }

    $output .= "


        <div class='col-lg-3 col-md-3 my-4 p-4'>
        <div class='card border-0 shadow' style='width: 18rem;'>
        <div class='card-body'>
          <h5 class='card-title text-center'>$chemical_data[name]</h5>
          <b><p class='card-text mb-2'>$chemical_data[area] $facilities_data</p></b>
          <div class='guests mb-2'>
            <h6 class='mb-1'>Details</h6>
            <span class='badge rounded-pill bg-light text-dark text-wrap'>$chemical_data[avail] Available</span>
            <span class='badge rounded-pill bg-light text-dark text-wrap mb-2'>$chemical_data[student] per Student</span>
            <h6 class='mt-2'>Expiration Date</h6>
            <span class='badge rounded-pill bg-light text-dark text-wrap mb-2'>
            $chemical_data[months] $chemical_data[day] $chemical_data[year]
          </span
          </div>
          $chemical_btn
        </div>
      </div>
    </div>
    </div>

        ";
    $count_chemical++;
  }

  if ($count_chemical > 0) {
    echo $output;
  } else {
    echo "<h3 class='text-center text-danger'>No Stock available</h3>";
  }


}


if (isset($_POST['search_chemical'])) {

  $frm_data = filteration($_POST);
  $query = "SELECT * FROM `chemical` WHERE `name` LIKE ?";
  $res = select($query, ["%$frm_data[name]%"], 's');

  //count no of rooms and out variables to store rooms cards
  $count_chemical = 0;
  $output = "";

  //fetching settings table to check website is shutdown or not 
  $home_q = "SELECT * FROM `settings` WHERE `sr_no`=1";
  $home_r = mysqli_fetch_assoc(mysqli_query($con, $home_q));


  //  $chemical_res =  select("SELECT * FROM `chemical` WHERE  `status`=?", [1],'i');

  while ($chemical_data = mysqli_fetch_assoc($res)) {
    $fea_q = mysqli_query($con, "SELECT f.name FROM `features` f INNER JOIN `chemical_facilities` rfac ON f.id = rfac.facilities_id WHERE rfac.chemical_id ='$chemical_data[id]'");

    $facilities_data = "";
    while ($fea_row = mysqli_fetch_assoc($fea_q)) {
      $facilities_data .= "<span class='badge rounded-pill bg-light text-dark text-wrap'>$fea_row[name]</span>";


    }

    $chemical_btn = "";

    if (!$home_r['shutdown']) {
      $login = 0;
      if (isset($_SESSION['login']) && $_SESSION['login'] == true) {
        $login = 1;
      }
      $chemical_btn = "  <button onclick='checkLoginToBook($login,$chemical_data[id])' class='btn btn-success w-100 text-white shadow-none mb-2'>Borrowing Now</button>";
    }

    $output .= "
 
 
         <div class='col-lg-3 col-md-3 my-4 p-4'>
         <div class='card border-0 shadow' style='width: 18rem;'>
         <div class='card-body'>
           <h5 class='card-title text-center'>$chemical_data[name]</h5>
           <b><p class='card-text mb-2'>$chemical_data[area] $facilities_data</p></b>
           <div class='guests mb-2'>
             <h6 class='mb-1'>Details</h6>
             <span class='badge rounded-pill bg-light text-dark text-wrap'>$chemical_data[avail] Available</span>
             <span class='badge rounded-pill bg-light text-dark text-wrap mb-2'>$chemical_data[student] per Student</span>
             <h6 class='mt-2'>Expiration Date</h6>
             <span class='badge rounded-pill bg-light text-dark text-wrap mb-2'>
             $chemical_data[months] $chemical_data[day] $chemical_data[year]
           </span
           </div>
           $chemical_btn
         </div>
       </div>
     </div>
     </div>
 
         ";
    $count_chemical++;
  }

  if ($count_chemical > 0) {
    echo $output;
  } else {
    echo "<h3 class='text-center text-danger'>No Stock available</h3>";
  }

}

?>