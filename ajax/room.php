<?php


require('../admin/db_config.php');
require('../admin/alert.php');


date_default_timezone_set("Asia/Manila");
session_start();


if (isset($_GET['fetch_rooms'])) {


  $count_rooms = 0;
  $output = "";

  //fetching settings table to check website is shutdown or not 
  $home_q = "SELECT * FROM `settings` WHERE `sr_no`=1";
  $home_r = mysqli_fetch_assoc(mysqli_query($con, $home_q));

  //query for rooms with guests data

  $room_res = select("SELECT * FROM `rooms` WHERE  `status`=? AND `removed`=?", [1, 0], 'ii');

  while ($room_data = mysqli_fetch_assoc($room_res)) {





    //get Facilities room

    $fac_q = mysqli_query($con, "SELECT f.name FROM `features` f INNER JOIN `room_facilities` rfac ON f.id = rfac.facilities_id WHERE rfac.room_id = '$room_data[id]'");

    $facilities_data = "";
    while ($fac_row = mysqli_fetch_assoc($fac_q)) {
      $facilities_data .= " <span class='badge rounded-pill bg-light text-dark text-wrap me-1 mb-1'>
            $fac_row[name]
            </span>";
    }



    $book_btn = "";

    if (!$home_r['shutdown']) {
      $login = 0;
      if (isset($_SESSION['login']) && $_SESSION['login'] == true) {
        $login = 1;
      }
      $book_btn = "  <button onclick='checkLoginToBook($login,$room_data[id])' class='btn btn-success w-100 text-white shadow-none mb-2'>Borrowing Now</button>";
    }



    $output .= "


            <div class='col-lg-3 col-md-3 my-4 p-4'>
            <div class='card border-0 shadow' style='width: 18rem;'>
            <div class='card-body'>
              <h5 class='card-title text-center'>$room_data[name]</h5>
              <b><p class='card-text mb-2'>$room_data[area] $facilities_data</p></b>
              <div class='guests mb-2'>
                <h6 class='mb-1'>Details</h6>
                <span class='badge rounded-pill bg-light text-dark text-wrap'>$room_data[adult] Available</span>
                <span class='badge rounded-pill bg-light text-dark text-wrap mb-2'>$room_data[children] per Student</span>
              </div>
              $book_btn
            </div>
          </div>
        </div>
        </div>
        
    
          ";
    $count_rooms++;



  }

  if ($count_rooms > 0) {
    echo $output;
  } else {
    echo "<h3 class='text-center text-danger'>No Stock available</h3>";
  }

}


if (isset($_POST['search_room'])) {
  $frm_data = filteration($_POST);
  $query = "SELECT * FROM `rooms` WHERE `name` LIKE ?";
  $res = select($query, ["%$frm_data[name]%"], 's');




  //  //guest data decode

  //  $guests = json_decode($_GET['guests'],true);
  //  $adults = ($guests['adults']!='') ? $guests['adults'] : 0;
  //  $children = ($guests['children']!='') ? $guests['children'] : 0;





  //count no of rooms and out variables to store rooms cards
  $count_rooms = 0;
  $output = "";

  //fetching settings table to check website is shutdown or not 
  $home_q = "SELECT * FROM `settings` WHERE `sr_no`=1";
  $home_r = mysqli_fetch_assoc(mysqli_query($con, $home_q));

  //query for rooms with guests data

  //  $room_res = select("SELECT * FROM `rooms` WHERE `adult`>=? AND `children`>=? AND `status`=? AND `removed`=?",[$adults,$children,1,0],'iiii');

  while ($room_data = mysqli_fetch_assoc($res)) {


    //  //check availability of room data 
    //  if($chk_avail['checkin']!='' && $chk_avail['checkout']!=''){

    //    $tb_query = "SELECT COUNT(*) AS `total_bookings` FROM `booking_order` WHERE booking_status=? AND room_id=? AND check_out > ? AND check_in < ?";

    //    $values = ['booked',$room_data['id'],$chk_avail['checkin'],$chk_avail['checkout']];
    //    $tb_fetch = mysqli_fetch_assoc(select($tb_query,$values,'siss'));


    //    if(($room_data['quantity']-$tb_fetch['total_bookings'])==0){
    //        continue;
    //    }

    //  }




    //  //get Facilities room

    $fac_q = mysqli_query($con, "SELECT f.name FROM `features` f INNER JOIN `room_facilities` rfac ON f.id = rfac.facilities_id WHERE rfac.room_id = '$room_data[id]'");

    $facilities_data = "";
    while ($fac_row = mysqli_fetch_assoc($fac_q)) {
      $facilities_data .= " <span class='badge rounded-pill bg-light text-dark text-wrap me-1 mb-1'>
             $fac_row[name]
             </span>";
    }


    //get Images room

    $room_thumb = ROOM_IMG_PATH . "360_F_349457338_PLFgcgC2C0NFoEajYw45kfVo6hkJDp7S.jpg";
    $thumb_q = mysqli_query($con, "SELECT * FROM `room_images` WHERE `room_id`='$room_data[id]' AND `thumb`='1'");

    if (mysqli_num_rows($thumb_q) > 0) {
      $thumb_res = mysqli_fetch_assoc($thumb_q);
      $room_thumb = ROOM_IMG_PATH . $thumb_res['image'];
    }

    $book_btn = "";

    if (!$home_r['shutdown']) {
      $login = 0;
      if (isset($_SESSION['login']) && $_SESSION['login'] == true) {
        $login = 1;
      }
      $book_btn = "  <button onclick='checkLoginToBook($login,$room_data[id])' class='btn btn-success w-100 text-white shadow-none mb-2'>Barrowing Now</button>";
    }



    $output .= "
             
          
 

             <div class='col-lg-3 col-md-3 my-4 p-4'>
             <div class='card border-0 shadow' style='width: 18rem;'>
             <div class='card-body'>
               <h5 class='card-title text-center'>$room_data[name]</h5>
               <b><p class='card-text mb-2'>$room_data[area] $facilities_data</p></b>
               <div class='guests mb-2'>
                 <h6 class='mb-1'>Details</h6>
                 <span class='badge rounded-pill bg-light text-dark text-wrap'>$room_data[adult] Available</span>
                 <span class='badge rounded-pill bg-light text-dark text-wrap mb-2'>$room_data[children] per Student</span>
               </div>
               $book_btn
             </div>
           </div>
         </div>
         </div>
     

           ";
    $count_rooms++;



  }

  if ($count_rooms > 0) {
    echo $output;
  } else {
    echo "<h3 class='text-center text-danger'>No Stock available</h3>";
  }

}


?>