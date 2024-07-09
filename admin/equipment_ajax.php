<?php

require("db.php");
require("alert.php");
adminLogin();

if (isset($_POST['add_equipment'])) {
    $features = filteration(json_decode($_POST['features']));

    $frm_data = filteration($_POST);

    $flag = 0;

    $q1 = "INSERT INTO `equipment`(`name`, `brand`,  `avail`, `student`, `cost`,`month_added`,`day_added`,`year_added`) VALUES (?,?,?,?,?,?,?,?)";
    $values = [$frm_data['name'], $frm_data['brand'], $frm_data['avail'], $frm_data['student'], $frm_data['cost'], $frm_data['month_added'], $frm_data['day_added'], $frm_data['year_added']];


    if (insert($q1, $values, 'ssiissss')) {
        $flag = 1;
    }

    $equipment_id = mysqli_insert_id($con);

    $q2 = "INSERT INTO `equipment_facilities`(`equipment_id`, `facilities_id`) VALUES (?,?)";

    if ($stmt = mysqli_prepare($con, $q2)) { {
            foreach ($features as $f) {
                mysqli_stmt_bind_param($stmt, 'ii', $equipment_id, $f);
                mysqli_stmt_execute($stmt);
            }
            mysqli_stmt_close($stmt);

        }
    } else {
        $flag = 0;
        die('query cannot be prepared - insert ');
    }

    if ($flag) {
        echo 1;
    } else {
        echo 0;
    }
}


if (isset($_POST['get_equipment'])) {
    $res = selectAll('equipment');
    $i = 1;

    $data = "";

    while ($row = mysqli_fetch_assoc($res)) {
        if ($row['status'] == 1) {

            $status = "<button  onclick='toggleStatus($row[id],0)'class='btn btn-success btn-sm shadow-none'>Active</button>";

        } else {

            $status = "<button onclick='toggleStatus($row[id],1)' class='btn btn-danger btn-sm shadow-none'>Not active</button>";

        }

        $data .= "
    <tr class='align-middle'>
        <td>$i</td>
        <td>$row[name]</td>
        <td>$row[brand] </td>
        <td><span class='badge rounded-pill bg-light text-dark'>Available: $row[avail]</span><br><span class='badge rounded-pill bg-light text-dark'>per Student: $row[student]</span></td>
        <td>$row[month_added] $row[day_added] $row[year_added]</td>
        <td>$row[cost]</td>
        <td>$status</td>
        <td>
         

            <button type='button' onclick='equipment_details($row[id])' class='btn btn-warning btn-sm shadow-none me-3' data-bs-toggle='modal' data-bs-target='#edit-equipment'>
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


if (isset($_POST['edit_equipment'])) {
    $frm_data = filteration($_POST);

    $res1 = select("SELECT * FROM `equipment` WHERE  `id`=?", [$frm_data['edit_equipment']], 'i');
    $res2 = select("SELECT * FROM `equipment_facilities` WHERE `equipment_id`=?", [$frm_data['edit_equipment']], 'i');


    $equipmentdata = mysqli_fetch_assoc($res1);
    $features = [];

    if (mysqli_num_rows($res2) > 0) {
        while ($row = mysqli_fetch_assoc($res2)) {
            array_push($features, $row['facilities_id']);
        }
    }

    $data = ["equipmentdata" => $equipmentdata, "features" => $features];


    $data = json_encode($data);

    echo $data;
}

if (isset($_POST['submit_edit_equipment'])) {
    $features = filteration(json_decode($_POST['features']));

    $frm_data = filteration($_POST);

    $flag = 0;

    $q1 = "UPDATE `equipment` SET `name`=?, `brand`=?,  `avail`=?,`student`=?, `cost`=?, `month_added`=?, `day_added`=?, `year_added`=? WHERE `id`=?";
    $values = [$frm_data['name'], $frm_data['brand'], $frm_data['avail'], $frm_data['student'], $frm_data['cost'], $frm_data['month_added'], $frm_data['day_added'], $frm_data['year_added'], $frm_data['equipment_id']];

    if (update($q1, $values, 'ssiissssi')) {
        $flag = 1;
    }

    $del_features = delete("DELETE FROM `equipment_facilities` WHERE `equipment_id`=?", [$frm_data['equipment_id']], 'i');

    if (!($del_features)) {
        $flag = 0;
    }

    $q2 = "INSERT INTO `equipment_facilities`(`equipment_id`, `facilities_id`) VALUES (?,?)";

    if ($stmt = mysqli_prepare($con, $q2)) { {
            foreach ($features as $f) {
                mysqli_stmt_bind_param($stmt, 'ii', $frm_data['equipment_id'], $f);
                mysqli_stmt_execute($stmt);
            }
            $flag = 1;
            mysqli_stmt_close($stmt);

        }
    } else {
        $flag = 0;
        die('query cannot be prepared - insert ');
    }

    if ($flag) {
        echo 1;
    } else {
        echo 0;
    }
}





if (isset($_POST['toggleStatus'])) {
    $frm_data = filteration($_POST);

    $q = "UPDATE `equipment` SET `status`=? WHERE `id`=?";
    $v = [$frm_data['value'], $frm_data['toggleStatus']];

    if (update($q, $v, 'ii')) {
        echo 1;
    } else {
        echo 0;
    }

}

if (isset($_POST['search_equipment'])) {
    $frm_data = filteration($_POST);
    $query = "SELECT * FROM  `equipment` WHERE `name` LIKE?";
    $res = select($query, ["%$frm_data[name]%"], 's');
    $i = 1;
    $data = "";
    while ($row = mysqli_fetch_array($res)) {

        if ($row['status'] == 1) {

            $status = "<button  onclick='toggleStatus($row[id],0)'class='btn btn-success btn-sm shadow-none'>Active</button>";

        } else {

            $status = "<button onclick='toggleStatus($row[id],1)' class='btn btn-danger btn-sm shadow-none'>Not active</button>";

        }


        $data .= "
        <tr class='align-middle'>
        <td>$i</td>
        <td>$row[name]</td>
        <td>$row[brand] </td>
        <td><span class='badge rounded-pill bg-light text-dark'>Available: $row[avail]</span><br><span class='badge rounded-pill bg-light text-dark'>per Student: $row[student]</span></td>
        <td>$row[month_added] $row[day_added] $row[year_added]</td>
        <td>$row[cost]</td>
        <td>$status</td>
        <td>
         

            <button type='button' onclick='equipment_details($row[id])' class='btn btn-warning btn-sm shadow-none me-3' data-bs-toggle='modal' data-bs-target='#edit-equipment
            
            
            
            '>
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