<?php

require("db.php");
require("alert.php");
adminLogin();


if (isset($_POST['add_rooms'])) {
    $features = filteration(json_decode($_POST['features']));

    $frm_data = filteration($_POST);
    $flag = 0;

    $q1 = "INSERT INTO `rooms`(`name`, `area`, `brand`, `quantity`, `adult`, `children` ,`month`,`day`,`year` ) VALUES (?,?,?,?,?,?,?,?,?)";
    $values = [$frm_data['name'], $frm_data['area'], $frm_data['brand'], $frm_data['quantity'], $frm_data['adult'], $frm_data['children'], $frm_data['month'], $frm_data['day'], $frm_data['year']];


    if (insert($q1, $values, 'sisiiisss')) {
        $flag = 1;
    }

    $room_id = mysqli_insert_id($con);

    $q2 = "INSERT INTO `room_facilities`(`room_id`, `facilities_id`) VALUES (?,?)";

    if ($stmt = mysqli_prepare($con, $q2)) { {
            foreach ($features as $f) {
                mysqli_stmt_bind_param($stmt, 'ii', $room_id, $f);
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

if (isset($_POST['get_rooms'])) {
    $res = select("SELECT * FROM `rooms` WHERE `removed`=?", [0], 'i');
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
                    <td>$row[brand] </td>
                    <td><span class='badge rounded-pill bg-light text-dark'>Available: $row[adult]</span><br><span class='badge rounded-pill bg-light text-dark'>per Student: $row[children]</span></td>
                    
                    <td>$row[quantity]</td>
                    <td>$row[month] $row[day] $row[year]</td>
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


if (isset($_POST['edit_get_room'])) {
    $frm_data = filteration($_POST);

    $res1 = select("SELECT * FROM `rooms` WHERE `id`=?", [$frm_data['edit_get_room']], 'i');
    $res2 = select("SELECT * FROM `room_facilities` WHERE `room_id`=?", [$frm_data['edit_get_room']], 'i');

    $roomdata = mysqli_fetch_assoc($res1);
    $features = [];

    if (mysqli_num_rows($res2) > 0) {
        while ($row = mysqli_fetch_assoc($res2)) {
            array_push($features, $row['facilities_id']);
        }
    }


    $data = ["roomdata" => $roomdata, "features" => $features];

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
    $features = filteration(json_decode($_POST['features']));

    $frm_data = filteration($_POST);
    $flag = 0;

    $q1 = "UPDATE `rooms` SET `name`=?,`area`=?,`brand`=?,`quantity`=?,`adult`=?,`children`=?,`month`=?, `day`=?, `year`=? WHERE `id`=?";
    $values = [$frm_data['name'], $frm_data['area'], $frm_data['brand'], $frm_data['quantity'], $frm_data['adult'], $frm_data['children'], $frm_data['month'], $frm_data['day'], $frm_data['year'], $frm_data['room_id']];

    if (update($q1, $values, 'sisiiisssi')) {
        $flag = 1;
    }

    $del_features = delete("DELETE FROM `room_facilities` WHERE `room_id`=?", [$frm_data['room_id']], 'i');

    if (!($del_features)) {
        $flag = 0;
    }


    $q2 = "INSERT INTO `room_facilities`(`room_id`, `facilities_id`) VALUES (?,?)";

    if ($stmt = mysqli_prepare($con, $q2)) { {
            foreach ($features as $f) {
                mysqli_stmt_bind_param($stmt, 'ii', $frm_data['room_id'], $f);
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

















if (isset($_POST['add_image'])) {
    $frm_data = filteration($_POST);

    $img_r = uploadImage($_FILES['image'], ROOM_FOLDER);

    if ($img_r == 'inv_img') {
        echo $img_r;
    } else if ($img_r == 'inv_size') {
        echo $img_r;
    } else if ($img_r == 'upd_failed') {
        echo $img_r;
    } else {
        $q = "INSERT INTO `room_images`(`room_id`, `image`) VALUES (?,?)";
        $values = [$frm_data['room_id'], $img_r];
        $res = insert($q, $values, 'is');
        echo $res;
    }
}

if (isset($_POST['get_room_image'])) {
    $frm_data = filteration($_POST);
    $res = select("SELECT * FROM `room_images` WHERE `room_id`=?", [$frm_data['get_room_image']], 'i');

    $path = ROOM_IMG_PATH;

    while ($row = mysqli_fetch_assoc($res)) {

        if ($row['thumb'] == 1) {
            $thumb = "<i class='bi bi-check-lg text-light bg-success px-2 py-1 rounded fs-5'></i>";
        } else {
            $thumb = "<button type='button' onclick='thumb_image($row[sr_no],$row[room_id])' class='btn btn-warning btn-sm shadow-none'><i class='i bi-check-lg'></i></button>";
        }


        echo <<<data
               <tr class='align-middle'>
               <td><img src='$path$row[image]'class='img-fluid'></td>
               <td>$thumb</i></td>
               <td>
               <button type='button' onclick='rem_image($row[sr_no],$row[room_id])' class='btn btn-danger btn-sm shadow-none'>Delete<i class='i bi-trash'></i></button>             
               </td>
                </tr>
            data;



    }

}

if (isset($_POST['rem_image'])) {
    $frm_data = filteration($_POST);

    $values = [$frm_data['image_id'], $frm_data['room_id']];

    $pre_q = "SELECT * FROM `room_images` WHERE `sr_no`=? AND `room_id`=?";
    $res = select($pre_q, $values, 'ii');
    $img = mysqli_fetch_assoc($res);

    if (deleteImage($img['image'], ROOM_FOLDER)) {
        $q = "DELETE FROM `room_images` WHERE `sr_no`=? AND `room_id`=?";
        $res = delete($q, $values, 'ii');
        echo $res;
    } else {
        echo 0;
    }

}

if (isset($_POST['thumb_image'])) {
    $frm_data = filteration($_POST);

    $pre_q = "UPDATE `room_images` SET `thumb`=? WHERE `room_id`=?";
    $pre_v = [0, $frm_data['room_id']];
    $pre_res = update($pre_q, $pre_v, 'ii');

    $q = "UPDATE `room_images` SET `thumb`=? WHERE `sr_no`=? AND `room_id`=?";
    $v = [1, $frm_data['image_id'], $frm_data['room_id']];
    $res = update($q, $v, 'iii');

    echo $res;

}

if (isset($_POST['remove_room'])) {
    $frm_data = filteration($_POST);

    $res1 = select("SELECT * FROM `room_images` WHERE `room_id`=?", [$frm_data['room_id']], 'i');

    while ($row = mysqli_fetch_assoc($res1)) {
        deleteImage($row['image'], ROOM_FOLDER);
    }

    $res2 = delete("DELETE FROM `room_images` WHERE `room_id`=?", [$frm_data['room_id']], 'i');
    $res3 = delete("DELETE FROM `room_facilities` WHERE `room_id`=?", [$frm_data['room_id']], 'i');
    $res4 = update("UPDATE `rooms` SET `removed`=? WHERE `id`=?", [1, $frm_data['room_id']], 'ii');

    if ($res2 || $res3 || $res4) {
        echo 1;
    } else {
        echo 0;
    }

}

if (isset($_POST['search_apparatus'])) {
    $frm_data = filteration($_POST);
    $query = "SELECT * FROM  `rooms` WHERE `name` LIKE?";
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
                    <td>$row[brand] </td>
                    <td><span class='badge rounded-pill bg-light text-dark'>Available: $row[adult]</span><br><span class='badge rounded-pill bg-light text-dark'>per Student: $row[children]</span></td>
                    <td>$row[quantity]</td>
                    <td>$row[month] $row[day] $row[year]</td>
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