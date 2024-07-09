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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CSM- Setting</title>
    <!-- CSS only -->
    <link rel="stylesheet" href="dash.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
</head>
<body class="bg-light">
 

  <?php require('header.php') ?>

  
    <div class="container-fluid" id="main-content">
      <div class="row">
        <div class="col-lg-10 ms-auto p-4 overflow-hidden">
          <h3 class="mb-4"><i class="bi bi-gear"></i> Settings</h3>

          <!---- Settings section -------------------->
 

        <div class="card border-0 shadow-sm ">
          <div class="card-body">
            <div class="d-flex align-items-center justify-content-between mb-3">
              <h5 class="card-title m-0">General Settings</h5>
              <button type="button" class="btn btn-warning shadow-none btn-sm fw-bold " data-bs-toggle="modal" data-bs-target="#setting">
              <i class="bi bi-pencil-square"></i> Edit
          </button>
            </div>
            <h6 class="card-subtitle mb-1 fw-bold">Site Title</h6>
            <p class="card-text" id="site_title"></p>
            <!--<h6 class="card-subtitle mb-1 fw-bold">About Us</h6>-->
            <!--<p class="card-text" id="site_about"></p>
          </div>
          

    <!-- Setting Modal -->
    
        <div class="modal fade" id="setting" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
          <div class="modal-dialog">
            <form id="general_s_form">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title"><i class="bi bi-pencil-square"></i> General Settings</h5>
              </div>
              <div class="modal-body">
                <div class="mb-3">
                  <label class="form-label fw-bold">Site Title</label>
                  <input type="text" name="site_title" id="site_title_input" class="form-control shadow-none" required>
                </div>
                <div class="mb-3">
                  <label class="form-label fw-bold">About</label>
                <textarea name="site_about" id="site_about_input" class="form-control shadow-none" rows="5" required></textarea>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" onclick="site_title.value = general_data.site_title,site_about.value = general_data.site_about" class="btn btn-secondary shadow-none" data-bs-dismiss="modal">Cancel</button>
                <button type="submit"  class="btn btn-success shadow-none">Save</button>
              </div>
            </form>
            </div>
          </div>
        </div>
        
        
        
         
         
         
          
          
  




        

          
    <!-- Contact Modal -->
    
        <div class="modal fade" id="contact-settings" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
          <div class="modal-dialog modal-lg">
            <form id="contacts_s_form">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title"><i class="bi bi-pencil-square"></i> Contacts Settings</h5>
              </div>
              <div class="modal-body">
                  <div class="container-fluid p-0">
                    <div class="row">
                        <div class="col-md-6">
                          <div class="mb-3">
                            <label class="form-label fw-bold">Address</label>
                            <div class="input-group mb-3">
                              <span class="input-group-text"><i class="bi bi-geo-alt"></i></span>
                              <input type="text" name="address" id="address_input" class="form-control shadow-none" required>
                            </div>
                          </div>
                          <div class="mb-3">
                            <label class="form-label fw-bold">Google Map Link</label>
                            <div class="input-group mb-3">
                              <span class="input-group-text"><i class="bi bi-map"></i></span>
                              <input type="text" name="gmap" id="gmap_input" class="form-control shadow-none" required>
                            </div>
                          </div>
                          <div class="mb-3">
                            <label class="form-label fw-bold">Contact Numbers:</label>
                            <div class="input-group mb-3">
                              <span class="input-group-text"><i class="bi bi-telephone-plus"></i></span>
                              <input type="number" name="pn1" id="pn1_input" class="form-control shadow-none" required>
                            </div>
                          </div>
                          <div class="mb-3">
                            <label class="form-label fw-bold">Email</label>
                            <div class="input-group mb-3">
                              <span class="input-group-text"><i class="bi bi-map"></i></span>
                              <input type="email" name="email" id="email_input" class="form-control shadow-none" required>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="mb-3">
                              <label class="form-label fw-bold">Social Media</label>
                              <div class="input-group mb-3">
                                <span class="input-group-text"><i class="bi bi-facebook"></i></span>
                                <input type="text" name="fb" id="fb_input" class="form-control shadow-none">
                              </div>
                              <div class="input-group mb-3">
                                <span class="input-group-text"><i class="bi bi-instagram"></i></span>
                                <input type="text" name="insta" id="insta_input" class="form-control shadow-none" >
                              </div>
                              <div class="input-group mb-3">
                                <span class="input-group-text"><i class="bi bi-twitter"></i></span>
                                <input type="text" name="tw" id="tw_input" class="form-control shadow-none">
                              </div>
                              <div class="mb-3">
                         
                              <div class="input-group mb-3">
                                    <span class="input-group-text"><i class="bi bi-map"></i></span>
                                  <input type="text" name="iframe" id="iframe_input" class="form-control shadow-none">
                              </div>
                            </div>
                            </div>
                          </div>
                    </div>
                  </div>
              </div>
              <div class="modal-footer">
                <button type="button" onclick="contacts_input(contacts_data)" class="btn btn-secondary shadow-none" data-bs-dismiss="modal">Cancel</button>
                <button type="submit"  class="btn btn-success shadow-none">Save</button>
              </div>
            </form>
            </div>
          </div>
        </div>


          <!--- Shutdown settings-->

    
  <!--<div class="card border-0">
          <div class="card-body">
            <div class="d-flex align-items-center justify-content-between mb-3">
              <h5 class="card-title m-0">Full Reservations.</h5>
              <div class="form-check form-switch">
                <form>
                <div class="form-check form-switch">
                  <input onchange="upd_shutdown(this.value)" class="form-check-input shadow-none" type="checkbox" role="switch" id="shutdown" >
                </div>
                </form>
              </div>
          </button>
            </div>
            <p class="card-text" id="site_about">
            When there are no available rooms, Fully Reservation   mode is activated, and no tenants are permitted to make reservations.
            </p>
          </div>
        </div>
      </div>
    </div>-->
    


 <!-- JavaScript Bundle with Popper -->
 <?php 
require ("script.php");
?>   
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
  let general_data, contacts_data;

  let general_s_form = document.getElementById('general_s_form');
  let site_title_input =document.getElementById('site_title_input');
  let site_about_input =document.getElementById('site_about_input');
  let contacts_s_form = document.getElementById('contacts_s_form');
 

  function get_general(){
    let site_title =document.getElementById('site_title');
    let site_about  =document.getElementById('site_about');

    let shutdown = document.getElementById('shutdown'); 

    let xhr = new XMLHttpRequest();
    xhr.open("POST","settings_crud.php",true);
    xhr.setRequestHeader('Content-Type','application/x-www-form-urlencoded');

    xhr.onload = function(){
      general_data = JSON.parse(this.responseText);

      site_title.innerText = general_data.site_title;
      site_about.innerText = general_data.site_about;

      site_title_input.value = general_data.site_title;
      site_about_input.value = general_data.site_about;
     

      if(general_data.shutdown == 0){
        shutdown.checked=false;
        shutdown.value=0;
      }else{
        shutdown.checked=true;
        shutdown.value=1;
      }

    }

    xhr.send('get_general');
  }

  general_s_form.addEventListener('submit', function(e){
    e.preventDefault();
    upd_general(site_title_input.value,site_about_input.value);


  })

  function upd_general(site_title_val,site_about_val){
    let xhr = new XMLHttpRequest();
    xhr.open("POST","settings_crud.php",true);
    xhr.setRequestHeader('Content-Type','application/x-www-form-urlencoded');

    xhr.onload = function(){
      var myModalEl = document.getElementById('setting')
      var modal = bootstrap.Modal.getInstance(myModalEl) // Returns a Bootstrap modal instanceof
      modal.hide();


      if(this.responseText== 1){
        Swal.fire(
  'Good job!',
  'Sucessfully Change',
  'success'
)

        get_general();
      }
      else{
        Swal.fire({
  icon: 'error',
  title: 'Oops...',
  text: 'Nothing happen',
 
})
      }


     
    }

    xhr.send('site_title='+site_title_val+'&site_about='+site_about_val+'&upd_general');
  }

  function upd_shutdown(val){
    let xhr = new XMLHttpRequest();
    xhr.open("POST","settings_crud.php",true);
    xhr.setRequestHeader('Content-Type','application/x-www-form-urlencoded');

    xhr.onload = function(){

      if(this.responseText== 1 && general_data.shutdown==0){
        Swal.fire(
  'Activated!',
  'Shutdown mode is activated',
  'success'
)

      }
      else{
        Swal.fire(
  'Deactivated',
  'Shutdown mode is turned off',
  'success'
)
      }
      get_general();
    }

    xhr.send('upd_shutdown='+val);
  }

  function get_contacts(){
    
    let contacts_p_id = ['address','gmap','pn1','email','fb','insta','tw'];
    let iframe = document.getElementById('iframe');

    let xhr = new XMLHttpRequest();
    xhr.open("POST","settings_crud.php",true);
    xhr.setRequestHeader('Content-Type','application/x-www-form-urlencoded');

    xhr.onload = function(){

      contacts_data = JSON.parse(this.responseText);
      contacts_data = Object.values(contacts_data);
   
        for(i=0; i<contacts_p_id.length; i++){
          document.getElementById(contacts_p_id[i]).innerText = contacts_data[i+1];
        }
      
        iframe.src=contacts_data[8];
        contacts_input(contacts_data);

    }

    xhr.send('get_contacts');
  }

    function contacts_input(data){
        let contacts_input_id = ['address_input','gmap_input','pn1_input','email_input','fb_input','insta_input','tw_input','iframe_input'];
         
        for(i=0;i<contacts_input_id.length;i++){
          document.getElementById(contacts_input_id[i]).value = data[i+1];
        }
      }

      contacts_s_form.addEventListener('submit',function(e){
        e.preventDefault();
        upd_contacts();
      })


      function upd_contacts(){
        let index =  ['address','gmap','pn1','email','fb','insta','tw','iframe'];
        let contacts_input_id = ['address_input','gmap_input','pn1_input','email_input','fb_input','insta_input','tw_input','iframe_input']
        
        let data_str= "";

        for(i=0;i<index.length;i++){
          data_str += index[i] + "="+document.getElementById(contacts_input_id[i]).value + '&';
        }

      
    
        data_str += "upd_contacts";

        let xhr = new XMLHttpRequest();
        xhr.open("POST","settings_crud.php",true);
        xhr.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
        

        xhr.onload = function(){
          var myModalEl = document.getElementById('contact-settings')
          var modal = bootstrap.Modal.getInstance(myModalEl) // Returns a Bootstrap modal instanceof
          modal.hide();

          if(this.responseText== 1){
                  Swal.fire(
        'Changes',
        'Successfully Change',
        'success'
      )
        
            get_contacts();
            }
            else{
              Swal.fire({
  icon: 'error',
  title: 'Oops...',
  text: 'Nothing happen',
 
})
            }
  
        }

        xhr.send(data_str);
      }

  window.onload = function(){
    get_general();
    get_contacts();
  }
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>   

</body>
</html>