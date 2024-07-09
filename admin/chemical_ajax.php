<?php

require("db.php");
require("alert.php");
adminLogin();

if (isset($_POST['add_chemical'])) {
    $features = filteration(json_decode($_POST['features']));

    $frm_data = filteration($_POST);

    $flag = 0;

    $q1 = "INSERT INTO `chemical`(`name`, `area`, `borrowed_unit`,  `avail`, `student`,`months`,`day`,`year_ended`,`month_added`,`day_added`,`year_added`) VALUES (?,?,?,?,?,?,?,?,?,?)";
    $values = [$frm_data['name'], $frm_data['area'], $frm_data['borrowed_unit'], $frm_data['avail'], $frm_data['student'], $frm_data['months'], $frm_data['day'], $frm_data['year'], $frm_data['month_added'], $frm_data['day_added'], $frm_data['year_added']];


    if (insert($q1, $values, 'siiiissssss')) {
        $flag = 1;
    }

    $chemical_id = mysqli_insert_id($con);

    $q2 = "INSERT INTO `chemical_facilities`(`chemical_id`, `facilities_id`) VALUES (?,?)";

    if ($stmt = mysqli_prepare($con, $q2)) { {
            foreach ($features as $f) {
                mysqli_stmt_bind_param($stmt, 'ii', $chemical_id, $f);
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


if (isset($_POST['get_chemical'])) {
    $res = selectAll('chemical');
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
        <td>$row[area]</td>
        <td>" . ($row['area'] - $row['borrowed_unit']) . "</td>
        <td>$row[borrowed_unit] </td>
        
        <td><span class='badge rounded-pill bg-light text-dark'>Available: $row[avail]</span><br><span class='badge rounded-pill bg-light text-dark'>per Student: $row[student]</span></td>
        <td>$row[month_added] $row[day_added] $row[year_added]</td>
        <td>$row[months] $row[day] $row[year]</td>
        <td>$status</td>
        <td>
         

            <button type='button' onclick='chemical_details($row[id])' class='btn btn-warning btn-sm shadow-none me-3' data-bs-toggle='modal' data-bs-target='#edit-chemical'>
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


if (isset($_POST['edit_chemical'])) {
    $frm_data = filteration($_POST);

    $res1 = select("SELECT * FROM `chemical` WHERE  `id`=?", [$frm_data['edit_chemical']], 'i');
    $res2 = select("SELECT * FROM `chemical_facilities` WHERE `chemical_id`=?", [$frm_data['edit_chemical']], 'i');


    $chemicaldata = mysqli_fetch_assoc($res1);
    $features = [];

    if (mysqli_num_rows($res2) > 0) {
        while ($row = mysqli_fetch_assoc($res2)) {
            array_push($features, $row['facilities_id']);
        }
    }

    $data = ["chemicaldata" => $chemicaldata, "features" => $features];


    $data = json_encode($data);

    echo $data;
}

if (isset($_POST['submit_edit_chemical'])) {
    $features = filteration(json_decode($_POST['features']));

    $frm_data = filteration($_POST);

    $flag = 0;

    $q1 = "UPDATE `chemical` SET `name`=?, `area`=?, `borrowed_unit`=?, `avail`=?,`student`=?, `months`=?, `day`=?, `year`=?,  `month_added`=?, `day_added`=?, `year_added`=? WHERE `id`=?";
    $values = [$frm_data['name'], $frm_data['area'], $frm_data['borrowed_unit'], $frm_data['avail'], $frm_data['student'], $frm_data['months'], $frm_data['day'], $frm_data['year'], $frm_data['month_added'], $frm_data['day_added'], $frm_data['year_added'], $frm_data['chemical_id']];

    if (update($q1, $values, 'siiisssssssi')) {
        $flag = 1;
    }

    $del_features = delete("DELETE FROM `chemical_facilities` WHERE `chemical_id`=?", [$frm_data['chemical_id']], 'i');

    if (!($del_features)) {
        $flag = 0;
    }

    $q2 = "INSERT INTO `chemical_facilities`(`chemical_id`, `facilities_id`) VALUES (?,?)";

    if ($stmt = mysqli_prepare($con, $q2)) { {
            foreach ($features as $f) {
                mysqli_stmt_bind_param($stmt, 'ii', $frm_data['chemical_id'], $f);
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

    $q = "UPDATE `chemical` SET `status`=? WHERE `id`=?";
    $v = [$frm_data['value'], $frm_data['toggleStatus']];

    if (update($q, $v, 'ii')) {
        echo 1;
    } else {
        echo 0;
    }

}

if (isset($_POST['search_chemical'])) {
    $frm_data = filteration($_POST);
    $query = "SELECT * FROM  `chemical` WHERE `name` LIKE?";
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
        <td>$row[area] </td>
        <td> $row[borrowed_unit] </td>
        <td><span class='badge rounded-pill bg-light text-dark'>Available: $row[avail]</span><br><span class='badge rounded-pill bg-light text-dark'>per Student: $row[student]</span></td>
        <td>$row[month_added] $row[day_added] $row[year_added]</td>
        <td>$row[months] $row[day] $row[year]</td>
        <td>$status</td>
        <td>
         

            <button type='button' onclick='chemical_details($row[id])' class='btn btn-warning btn-sm shadow-none me-3' data-bs-toggle='modal' data-bs-target='#edit-chemical'>
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