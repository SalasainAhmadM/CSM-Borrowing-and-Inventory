<?php 

require("alert.php");
require("db.php");

adminLogin();
// session_regenerate_id(true);


// if(isset($_GET['seen'])){
//     $frm_data =filteration($_GET);

//     if($frm_data['seen']=='all'){
//         $q = "UPDATE `user_queries` SET `seen`=?";
//         $values= [1];
//         if(update($q,$values,'i')){
//             alert('success','Mark all as read');
//         } 
//     }
//     else{
//         $q = "UPDATE `user_queries` SET `seen`=? WHERE `sr_no`=?";
//         $values= [1,$frm_data['seen']];
//         if(update($q,$values,'ii')){
//             alert('success','Mark as read');
//         } 
//     }
// }


// if(isset($_GET['del'])){
//     $frm_data =filteration($_GET);

//     if($frm_data['del']=='all'){
//         // $q = "DELETE FROM `user_queries`";
//         // if(mysqli_query($con,$q)){
//         //     alert('success','All inquiry Deleted');
//         // }
//     }
//     else{
//         $q = "DELETE FROM `user_queries` WHERE `sr_no`=?";
//         $values= [$frm_data['del']];
//         if(delete($q,$values,'i')){
//             alert('success','Inquiry Deleted');
//         }
        
//     }
// }


?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KLC HOMES - Walk-in User</title>
    <!-- CSS only -->
    <link rel="stylesheet" href="room.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
</head>

<body class="bg-light">


<?php 

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



$checkin_default="";
$checkout_default="";
$adult_default="";
$children_default="";

if(isset($_GET['check_availability'])){
  $frm_data = filteration($_GET);

  $checkin_default=$frm_data['checkin'];
  $checkout_default=$frm_data['checkout'];
  $adult_default=$frm_data['adult'];
  $children_default=$frm_data['children'];
}


?>
 

  <?php require('header.php') ?>



    <div class="container-fluid" id="main-content">
        <div class="row">
            <div class="col-lg-10 ms-auto p-4 overflow-y">
                <h3 class="mb-4"><i class="bi bi-house-door"></i> Walk in Customer</h3>

                <div class="my-5 px-4">
        <div class="h2 fw-bold text-center">Our Rooms Available</div>
        <div class="h-line bg-dark"></div>
    </div>


    <div class="container">
        <div class="row">
     <div class="col-lg-3 col-mb-12 mb-lg-0 ps-4 ">
   <nav class="navbar navbar-expand-lg navbar-light bg-white rounded shadow shadow-sm">
  <div class="container-fluid flex-lg-column align-items-stretch">
  <h5 class="mb-3 text-center fw-bold" style="font-size:18px;"><span>Check Availability</span>

          <button  id="chk_avail_btn"  onclick="chk_avail_clear()" class="btn btn-sm text-secondary ms-3 d-none bg-success text-white shadow-none">Reset</button>
</h5>
    <button class="navbar-toggler shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#filter" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse align-items-stretch mt-2 flex-column" id="filter">
      <div class="border bg-light p-3 rounded mb-3 mt-2">
     
        <label class="form-label">Check-in</label>
        <input type="date" class="form-control shadow-none mb-3" id="checkin" value="<?php echo $checkin_default ?>" onchange="chk_avail_filter()">
        <label class="form-label">Check-out</label>
        <input type="date" class="form-control shadow-none" id="checkout"  value="<?php echo  $checkout_default ?>"  onchange="chk_avail_filter()">
      </div>
      <div class="border bg-light p-3 rounded mb-3 mt-2" >
        <h5 class="mb-3 text-center fw-bold" style="font-size:18px;"><span>Guest</span>

        <button  id="guests_btn"  onclick="guests_clear()" class="btn btn-sm text-secondary ms-3 d-none bg-success text-white shadow-none mb-4">Reset</button>
        </h5>
        <div class="d-flex">
        <div class="me-3">
          <label class="form-label">Adults</label>
          <input type="number" class="form-control shadow-none" id="adults" value="<?php echo $adult_default ?>" min="1" oninput="guests_filter()">
        </div>
        <div>
          <label class="form-label">Children</label>
          <input type="number" class="form-control shadow-none" id="children" value="<?php echo $children_default ?>" min="1" oninput="guests_filter()">
        </div>
        </div>
      </div>
    </div>
  </div>
</nav>
  </div>

    <div class="col-lg-9 col-mb-12 px-4" id="rooms-data">
      

  

    </div>
   </div>
  </div>
                    

                    
                    


            </div>
        </div>
    </div>

        
     


 <?php 
require ("script.php");
?> 
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>

function checkLoginToBook(status,room_id){
  if(status){
    window.location.href='confirm_booking.php?id='+room_id;
  }
  else{
    Swal.fire({
  position: 'top-end',
  icon: 'warning',
  title: 'Please Login First to Reserve Room',
  showConfirmButton: false,
  timer: 1500,
  
});
  }
}

let rooms_data = document.getElementById('rooms-data');
  let checkin = document.getElementById('checkin');
  let checkout = document.getElementById('checkout');
  let chk_avail_btn = document.getElementById('chk_avail_btn');
  let adults = document.getElementById('adults');
  let children = document.getElementById('children');
  let guests_btn = document.getElementById('guests_btn');


  function fetch_rooms(){

    let chk_avail = JSON.stringify({
        checkin: checkin.value,
        checkout: checkout.value
    });

    let guests = JSON.stringify({
      adults:adults.value,
      children:children.value
    });

    let xhr = new XMLHttpRequest();
    xhr.open("GET","room_fetch.php?fetch_rooms&chk_avail="+chk_avail+"&guests="+guests,true);

    xhr.onprogress = function(){
      rooms_data.innerHTML = ` <div class="spinner-border text-info mb-3 d-block mx-auto" id="info" role="status">
                      <span class="visually-hidden">Loading...</span>
                    </div>`;
    }

    xhr.onload = function(){
        rooms_data.innerHTML = this.responseText;
    }

    xhr.send();
  }
  
  function chk_avail_filter(){
    if(checkin.value!='' && checkout.value !=''){
      fetch_rooms();
      chk_avail_btn.classList.remove('d-none');

    }
  }

  function chk_avail_clear(){
    checkin.value='';
    checkout.value='';
    chk_avail_btn.classList.add('d-none');
    fetch_rooms();

  }


  function guests_filter(){
      if(adults.value>0 || children.value>0){
        fetch_rooms();
        guests_btn.classList.remove('d-none');
      }
  }

  
  function guests_clear(){
    adults.value='';
    children.value='';
    guests_btn.classList.add('d-none');
    fetch_rooms();
  }


  window.onload= function(){
    fetch_rooms();
  }




</script>



<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
</body>
</html>