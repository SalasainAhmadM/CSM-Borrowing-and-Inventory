<?php 

require("alert.php");
require("db.php");

adminLogin();

$con= mysqli_connect("localhost","root","","klc");


if(isset($_POST['upload'])){
    $file = $_FILES['image']['name'];

    $query = "INSERT INTO carousel(image) VALUES('$file')";

    $res = mysqli_query($con,$query);

    if($res){
        move_uploaded_file($_FILES['image']['tmp_name'],"$file");
    }
}


?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KLC HOMES - Rooms</title>
    <!-- CSS only -->
    <link rel="stylesheet" href="room.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
</head>

<body class="bg-light">
 

  <?php require('header.php') ?>



    <div class="container-fluid" id="main-content">
        <div class="row">
            <div class="col-lg-10 ms-auto p-4 overflow-y">
                <h3 class="mb-4"><i class="bi bi-house-door"></i> Rooms</h3>

                    <div class="card border-0 shadow-sm mb-4">
                        <div class="card-body">
                            <h5 id="errorMs" class="text-danger"></h5>
                        <form action="upload.php" id="form" method="post" enctype="multipart/form-data">
                <label class="form-label fw-bold">Add Image</label>
                <input type="file" id="image" accept=".jpg, .png, .webp, .jpeg" class="form-control shadow-none mb-3" required>
                <button type="submit" id="submit" name="submit" class="btn btn-success shadow-none">Add</button>
                 </form>
                    <br>
                 <div class="gallery">
                        <img src="uploads/no image.jpg" width="50%" id="preImg" alt="">
                 </div>
       
            </div>

                        </div>
                    </div>
                    

                    
                    


            </div>
        </div>
    </div>

   



<!-- JavaScript Bundle with Popper -->

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>



<script>
    $(document).ready(function(){
        $("#submit").click(function(e){
            e.preventDefault();

            let form_data =  new FormData();

            let img= $("#image")[0].files;
            if(img.length > 0 ){
                form_data.append('my_image',img[0]);

                $.ajax({
                    url:'upload.php',
                    type:'post',
                    data:form_data,
                    contentType:false,
                    processData:false,
                    success:function(res){
                       const data = JSON.parse(res);
                       if(data.error !=1){
                        let path = "uploads/"+data.src;
                        $("#preImg").attr("src",path)
                        $("#preImg").fadeOut(1).fadeIn(1000);
                       }else{
                         $("#errorMs").text(data.em)
                       }
                    }
                })
            }else{
                $("#errorMs").text("Please select an Image");
            }
        });
    });
</script>











</body>
</html>