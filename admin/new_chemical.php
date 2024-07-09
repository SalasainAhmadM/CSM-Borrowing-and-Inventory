<?php 


require("alert.php");
require("db.php");


adminLogin();



if(isset($_POST['get_booking_chemical'])){  

    $frm_data = filteration($_POST);
    
    $query = "SELECT co.*, cd.*  FROM `chemical_order_final` co INNER JOIN `chemical_details_final` cd ON co.booking_id = cd.booking_id WHERE (co.order_id LIKE ? OR cd.course LIKE ? OR cd.username LIKE ? ) AND  (co.booking_status =?  AND co.arrival=?) ORDER BY co.booking_id DESC ";

    $res = select($query,["%$frm_data[search]%","%$frm_data[search]%","%$frm_data[search]%","approved",0],'sssss');

    $i=1;

    $table_data = "";

    if(mysqli_num_rows($res)==0){
      echo"<b>No Data Found!</b>";
      exit;
    }

    while($data = mysqli_fetch_array($res)){

        $date = date("d-m-Y",strtotime($data['datentime']));
        
        $checkin= date("d-m-Y g:i a",strtotime($data['check_in']));
                    
        $checkout= date("d-m-Y g:i a",strtotime($data['check_out']));

        $table_data .="
        
        <tr>
            <td>$i</td>
            <td>
            <span class='badge bg-warning'>
                Order ID: $data[order_id]
            </span>
            <br>
            <b>Name: </b> $data[username]
            <br>
            <b>Course: </b> $data[course]
            <br>
            <b>Year: </b> $data[year] year
            <br>
            <b>Teacher Name: </b> $data[teacher]
            <br>
            <b>Room Number: </b> $data[apr_no]
            <br>
            <b>Group No: </b> $data[group_no]
            </td>
            <td>
            <b>Item: </b> $data[chemical_name]
            <br>
            <b>Quantity: </b> $data[quantity] pcs
            <br>
            <b>Volume: </b> $data[volume] Needed
            </td>
            <td>
                <b>Start Date: </b> $checkin
                <br>
                <b>End Date: </b> $checkout
                <br>
                <b>Date: </b> $date
            </td>
            <td>
            <button type='button' onclick='assign_chemical($data[booking_id])' class='btn text-white btn-sm fw-bold bg-success shadow-none' data-bs-toggle='modal' data-bs-target='#assign-chemical'>
              <i class='bi bi-clipboard-plus'></i> Approved Chemical
            </button>
            <br>
          <br>
          
 

            
        </tr>
        
        ";

        $i++;
    }

    echo $table_data;

}


if(isset($_POST['assign_chemical'])){  
        
  $frm_data = filteration($_POST);

  $query = "UPDATE `chemical_order_final` co INNER JOIN `chemical_details_final` cd ON co.booking_id = cd.booking_id SET co.arrival = ?, cd.room_no = ? WHERE co.booking_id = ? ";

  $values = [1,$frm_data['chemical_no'],$frm_data['booking_id']];

  $res = update($query,$values,'isi');

  echo ($res==2) ? 1 : 0;  //it will update 2 rows so it will return 2 

}


?>