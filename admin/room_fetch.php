<?php

require("alert.php");
require("db.php");

date_default_timezone_set("Asia/Manila"); 


if(isset($_GET['fetch_rooms'])){

    // check availability data decode
    $chk_avail= json_decode($_GET['chk_avail'],true);
    //checkin check out validations
    if($chk_avail['checkin']!='' && $chk_avail['checkout']!=''){
      
        $today_date = new DateTime(date("Y-m-d"));
        $checkin_date = new DateTime($chk_avail['checkin']);
        $checkout_date= new DateTime($chk_avail['checkout']);

        if($checkin_date == $checkout_date){
          echo "<h3 class='text-center text-danger'>Invalid Check-in / Check-out</h3>";
          exit;
        }
        else if($checkout_date < $checkin_date){
          echo "<h3 class='text-center text-danger'>Invalid Check-in / Check-out</h3>";
          exit;
        }
        else if($checkin_date < $today_date){
          echo "<h3 class='text-center text-danger'>Invalid Check-in / Check-out/h3>";
          exit;
        }
    }


    //guest data decode

    $guests = json_decode($_GET['guests'],true);
    $adults = ($guests['adults']!='') ? $guests['adults'] : 0;
    $children = ($guests['children']!='') ? $guests['children'] : 0;
  




      //count no of rooms and out variables to store rooms cards
      $count_rooms = 0 ; 
      $output = "";

      //fetching settings table to check website is shutdown or not 
      $home_q = "SELECT * FROM `settings` WHERE `sr_no`=1";
      $home_r = mysqli_fetch_assoc(mysqli_query($con,$home_q));
      
      //query for rooms with guests data

      $room_res = select("SELECT * FROM `rooms` WHERE `adult`>=? AND `children`>=? AND `status`=? AND `removed`=?",[$adults,$children,1,0],'iiii');

      while($room_data = mysqli_fetch_assoc($room_res)){
        

        //check availability of room data 
        if($chk_avail['checkin']!='' && $chk_avail['checkout']!=''){

          $tb_query = "SELECT COUNT(*) AS `total_bookings` FROM `booking_order` WHERE booking_status=? AND room_id=? AND check_out > ? AND check_in < ?";

          $values = ['booked',$room_data['id'],$chk_avail['checkin'],$chk_avail['checkout']];
          $tb_fetch = mysqli_fetch_assoc(select($tb_query,$values,'siss'));
 
  
          if(($room_data['quantity']-$tb_fetch['total_bookings'])==0){
              continue;
          }
  
        }




        //get Facilities room
  
        $fac_q = mysqli_query($con,"SELECT f.name FROM `features` f INNER JOIN `room_facilities` rfac ON f.id = rfac.facilities_id WHERE rfac.room_id = '$room_data[id]'");
  
        $facilities_data = "";
        while($fac_row = mysqli_fetch_assoc($fac_q)){
          $facilities_data.=" <span class='badge rounded-pill bg-light text-dark text-wrap me-1 mb-1'>
          $fac_row[name]
          </span>";
        }
       
  
              //get Images room
  
          $room_thumb = ROOM_IMG_PATH."360_F_349457338_PLFgcgC2C0NFoEajYw45kfVo6hkJDp7S.jpg";
          $thumb_q = mysqli_query($con,"SELECT * FROM `room_images` WHERE `room_id`='$room_data[id]' AND `thumb`='1'");
  
          if(mysqli_num_rows($thumb_q) > 0){
            $thumb_res = mysqli_fetch_assoc($thumb_q);
            $room_thumb = ROOM_IMG_PATH.$thumb_res['image'];
          }
  
          $book_btn = "";
               
          if(!$home_r['shutdown']){
            $login=0;
            if(isset($_SESSION['login']) && $_SESSION['login']==true){
              $login=1;
            }
            $book_btn = "  <button onclick='checkLoginToBook($login,$room_data[id])' class='btn btn-success w-100 text-white shadow-none mb-2'>Reserve Now</button>";
          } 
  
            
  
          $output.="
          
          <div class='card mb-4 border-0 shadow'>
            <div class='row g-0 p-3 align-items-center'>
              <div class='col-md-5 mb-lg-0 mb-md-0 mb-3'>
                 <img src='$room_thumb'class='img-fluid rounded' style='width:90%''>
              </div>
                <div class='col-md-5 px-lg-3 px-mb-3 px-0'>
                  <h4 class='mb-5 mt-2 text-center fw-bold'>$room_data[name]</h4>
                  <div class='features mb-3'>
                  <h6 class='mb-1'>Facilities</h6>
                    $facilities_data
                  </div>
                  <div class='guests'>
                    <h6 class='mb-1'>Guests</h6>
                    <span class='badge rounded-pill bg-light text-dark text-wrap'>
                      $room_data[adult] Avalable
                    </span>
                    <span class='badge rounded-pill bg-light text-dark text-wrap'>
                      $room_data[children] per Student
                    </span>
                  </div>
                </div>
                <div class='col-md-2 text-center mt-lg-0 mt-md-0 mt-4'>
                <h6 class='mb-4'>₱$room_data[price] per day</h6>
                $book_btn
                </div>
            </div>
          </div>
  
        ";
        $count_rooms++;
  
  
  
      }

      if($count_rooms>0){
          echo $output;
      }else{
          echo "<h3 class='text-center text-danger'>No rooms available</h3>";
      }
  
  }


?>

