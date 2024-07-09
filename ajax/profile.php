<?php

require('../admin/db_config.php');
require('../admin/alert.php');


date_default_timezone_set("Asia/Manila");

if (isset($_POST['info_form'])) {
    $frm_data = filteration($_POST);
    session_start();

    $u_exist = select("SELECT * FROM `user_cred` WHERE `phonenum`=? AND `id`!=? LIMIT 1", [$frm_data['phonenum'], $_SESSION['uId']], "ss");

    if (mysqli_num_rows($u_exist) != 0) {
        echo 'phone_already';

        exit;
    }

    // Update the 'year' value in the database
    $query = "UPDATE `user_cred` SET `year`=? WHERE `id`=?";
    $values = [$frm_data['year'], $_SESSION['uId']];

    if (update($query, $values, 'ss')) {
        // Update the 'year' value in the session variable
        $_SESSION['year'] = $frm_data['year'];
        echo 1;
    } else {
        echo 0;
    }
}



?>