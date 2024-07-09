<?php



require('.././db_config.php');
require('.././alert.php');
adminLogin();



if (isset($_POST['add_rooms'])) {
    // $features = filteration(json_decode($_POST['features']));

    $frm_data = filteration($_POST);
    $flag = 0;

    $q1 = "INSERT INTO `rooms`(`name`, `brand`,`size`,`unit`,`quantity_added`,`quantity`, `date`, `shelf`) VALUES (?,?,?,?,?,?,?,?)";
    $values = [$frm_data['name'], $frm_data['brand'], $frm_data['size'], $frm_data['unit'], $frm_data['quantity_added'], $frm_data['quantity'], $frm_data['date'], $frm_data['shelf']];


    if (insert($q1, $values, 'ssisiiss')) {
        $flag = 1;
    }


    if ($flag) {
        echo 1;
    } else {
        echo 0;
    }
}

if (isset($_POST['get_rooms'])) {
    $res = select("SELECT * FROM `rooms` WHERE `removed`=? ORDER BY `name` ASC, `date` ASC", [0], 'i');
    $i = 1;
    $data = "";
    while ($row = mysqli_fetch_array($res)) {
        $date = date('F j Y', strtotime($row['date']));
        if ($row['status'] == 1) {
            $status = "<button  onclick='toggleStatus($row[id],0)'class='btn btn-success btn-sm shadow-none'>Active</button>";
        } else {
            $status = "<button onclick='toggleStatus($row[id],1)' class='btn btn-danger btn-sm shadow-none'>Not active</button>";
        }
        // Check if the quantity is less than or equal to 100 units
        if ($row['quantity'] <= $row['quantity_added'] * 0.3) {
            $quantity_notice = "<span class='badge rounded-pill bg-danger'>Critical Stock!</span>";
        } else {
            $quantity_notice = "";
        }

        $data .= "
            <tr class='align-middle'>
                <td>$i</td>
                <td>$row[name]</td>
                <td><span class='badge rounded-pill bg-light text-dark'>$row[brand]</span></td>
                <td>$row[size]</td>
                <td>$row[unit]</td>
                <td>$row[quantity_added]</td>
                <td>$row[quantity]<br> $quantity_notice</td>
                <td>$date</td>
                <td>$row[shelf]</td>
                <td>$status</td>
                <td>
                    <button type='button' onclick='edit_details($row[id])' class='btn btn-warning btn-sm shadow-none me-3' data-bs-toggle='modal' data-bs-target='#edit-room'>
                        <i class='i bi-pencil-square'></i>
                    </button>
                </td>
            </tr>
        ";
        $i++;
    }
    echo $data;
}


if (isset($_POST['edit_get_room'])) {
    $frm_data = filteration($_POST);

    $res1 = select("SELECT * FROM `rooms` WHERE `id`=?", [$frm_data['edit_get_room']], 'i');
    $res2 = select("SELECT * FROM `room_facilities` WHERE `room_id`=?", [$frm_data['edit_get_room']], 'i');

    $roomdata = mysqli_fetch_assoc($res1);
    // $features = [];

    // if(mysqli_num_rows($res2)>0){
//     while($row = mysqli_fetch_assoc($res2)){
//         array_push($features,$row['facilities_id']);
//     }
// }


    $data = ["roomdata" => $roomdata];

    $data = json_encode($data);

    echo $data;
}




if (isset($_POST['toggleStatus'])) {
    $frm_data = filteration($_POST);

    $q = "UPDATE `rooms` SET `status`=? WHERE `id`=?";
    $v = [$frm_data['value'], $frm_data['toggleStatus']];

    if (update($q, $v, 'ii')) {
        echo 1;
    } else {
        echo 0;
    }

}


if (isset($_POST['edit_rooms'])) {


    $frm_data = filteration($_POST);
    $flag = 0;

    $q1 = "UPDATE `rooms` SET `name`=?,`brand`=?,`size`=?,`unit`=?, `quantity_added`=? ,`quantity`=? , `date`=? , `shelf`=? WHERE `id`=?";
    $values = [$frm_data['name'], $frm_data['brand'], $frm_data['size'], $frm_data['unit'], $frm_data['quantity_added'], $frm_data['quantity'], $frm_data['date'], $frm_data['shelf'], $frm_data['room_id']];

    if (update($q1, $values, 'ssisiissi')) {
        $flag = 1;
    }




    if ($flag) {
        echo 1;
    } else {
        echo 0;
    }
}







if (isset($_POST['search_apparatus'])) {
    $frm_data = filteration($_POST);
    $query = "SELECT * FROM rooms WHERE name LIKE ? OR brand LIKE ?";
    $res = select($query, ["%$frm_data[name]%", "%$frm_data[name]%"], 'ss');
    $i = 1;
    $data = "";
    while ($row = mysqli_fetch_array($res)) {
        $date = date('F j Y', strtotime($row['date']));
        if ($row['status'] == 1) {


            $status = "<button  onclick='toggleStatus($row[id],0)'class='btn btn-success btn-sm shadow-none'>Active</button>";

        } else {

            $status = "<button onclick='toggleStatus($row[id],1)' class='btn btn-danger btn-sm shadow-none'>Not active</button>";

        }



        $data .= "
        <tr class='align-middle'>
        <td>$i</td>
        <td>$row[name]</td>
        <td><span class='badge rounded-pill bg-light text-dark'>$row[brand]</span></td>
        <td>$row[size]</td>
        <td>$row[unit]</td>
        <td>$row[quantity_added]</td>
        <td>$row[quantity]</td>
        <td>$date</td>
        <td>$row[shelf]</td>
        <td>$status</td>
        <td>
          
    
            <button type='button' onclick='edit_details($row[id])' class='btn btn-warning btn-sm shadow-none me-3' data-bs-toggle='modal' data-bs-target='#edit-room'>
            <i class='i bi-pencil-square'></i>
            </button>
          
            </button>
        </td>
    </tr>
        ";
        $i++;

        //  <button type='button' onclick='remove_room($row[id])' class='btn btn-danger btn-sm shadow-none'>

    }
    echo $data;
}


?>