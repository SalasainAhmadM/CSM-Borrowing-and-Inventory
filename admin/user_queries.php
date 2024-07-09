<?php 

require("alert.php");
require("db.php");

adminLogin();
// session_regenerate_id(true);


if(isset($_GET['seen'])){
    $frm_data =filteration($_GET);

    if($frm_data['seen']=='all'){
        $q = "UPDATE `user_queries` SET `seen`=?";
        $values= [1];
        if(update($q,$values,'i')){
            alert('success','Mark all as read');
        } 
    }
    else{
        $q = "UPDATE `user_queries` SET `seen`=? WHERE `sr_no`=?";
        $values= [1,$frm_data['seen']];
        if(update($q,$values,'ii')){
            alert('success','Mark as read');
        } 
    }
}


if(isset($_GET['del'])){
    $frm_data =filteration($_GET);

    if($frm_data['del']=='all'){
        // $q = "DELETE FROM `user_queries`";
        // if(mysqli_query($con,$q)){
        //     alert('success','All inquiry Deleted');
        // }
    }
    else{
        $q = "DELETE FROM `user_queries` WHERE `sr_no`=?";
        $values= [$frm_data['del']];
        if(delete($q,$values,'i')){
            alert('success','Inquiry Deleted');
        }
        
    }
}


?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hotel Reservation - User Inquiry</title>
    <!-- CSS only -->
    <link rel="stylesheet" href="dash.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
</head>

<body class="bg-light">
 

  <?php require('header.php') ?>



    <div class="container-fluid" id="main-content">
        <div class="row">
            <div class="col-lg-10 ms-auto p-4 overflow-y">
                <h3 class="mb-4"><i class="bi bi-person-lines-fill"></i> User Inquiry</h3>

                    <div class="card border-0 shadow-sm mb-4">
                        <div class="card-body">

                        <div class="text-end mb-4">
                            <a href="?seen=all" class="btn btn-warning shadow-none btn-sm">Mark All Read <i class="bi bi-check-all"></i></a>
                           
                        </div>


                           <div class="table-responsive-md" style="height:450px; overflow-y:scroll;">
                           <table class="table table-hover border">
                            <thead class="sticky-top">
                                <tr class="bg-secondary text-white">
                                <th scope="col">#</th>
                                <th scope="col">Name</th>
                                <th scope="col">Email</th>
                                <th scope="col"width="30%">Message</th>
                                <th scope="col">Date</th>
                                <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                             <?php 
                             
                             $q = "SELECT * FROM `user_queries` ORDER BY `sr_no` DESC";
                             $data = mysqli_query($con,$q);
                             $i=1;

                             while($row = mysqli_fetch_assoc($data)){
                                $date = date('d-m-Y',strtotime($row['datentime']));
                                $seen = '';
                                if($row['seen']!=1){
                                    $seen="<a href='?seen=$row[sr_no]' class='btn btn-sm  btn-success'><i class='bi bi-check-all'></i></a>";
                                }
                                $seen.="<a href='?del=$row[sr_no]' class='btn btn-sm  btn-danger ms-3'><i class='bi bi-trash'></i></a>";

                                echo<<<query

                                <tr>
                                    <td>$i</td>
                                    <td>$row[name]</td>
                                    <td>$row[email]</td>
                                    <td>$row[message]</td>
                                    <td>$date</td>
                                    <td>$seen</td>
                                </tr>


                                query;
                                $i++;
                             }

                             
                             ?>
                            </tbody>
                            </table>
                            </div>

                        </div>
                    </div>

            </div>
        </div>
    </div>












<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
</body>
</html>