<?php

require("db.php");
require("alert.php");
adminLogin();


if (isset($_POST['add_clearance_2ndsem'])) {
    // $features = filteration(json_decode($_POST['features']));

    $frm_data = filteration($_POST);
    $flag = 0;

    $q1 = "INSERT INTO `clearance_2ndsem`(`date`, `cais`, `carch`, `ccie`, `coe`, `ccs`, `cfes`, `che`, `cla`, `claw`, `cpers`, `csm`, `cswcd`,`cte`, `esu`, `graduate`) 
        VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
    $values = [
        $frm_data['date'], $frm_data['cais'], $frm_data['carch'], $frm_data['ccie']
        , $frm_data['coe'], $frm_data['ccs'], $frm_data['cfes'], $frm_data['che'], $frm_data['cla']
        , $frm_data['claw'], $frm_data['cpers'], $frm_data['csm'], $frm_data['cswcd'], $frm_data['cte'], $frm_data['esu'], $frm_data['graduate']
    ];


    if (insert($q1, $values, 'siiiiiiiiiiiiiii')) {
        $flag = 1;
    }


    if ($flag) {
        echo 1;
    } else {
        echo 0;
    }


}

if (isset($_POST['get_clearance_2ndsem'])) {
    $res = selectAll('clearance_2ndsem');
    $i = 0;

    $data = "";

    while ($row = mysqli_fetch_array($res)) {


        $data .= "
                <tr class='align-middle'>
                    <td>$row[date]</td>
                    <td>$row[cais]</td>
                    <td>$row[carch]</td>
                    <td>$row[ccie]</td>
                    <td>$row[coe]</td>
                    <td>$row[ccs]</td>
                    <td>$row[cfes]</td>
                    <td>$row[che]</td>
                    <td>$row[cla]</td>
                    <td>$row[claw]</td>
                    <td>$row[cpers]</td>
                    <td>$row[csm]</td>
                    <td>$row[cswcd]</td>
                    <td>$row[cte]</td>
                    <td>$row[esu]</td>
                    <td>$row[graduate]</td>

                    <td>
         

                    <button type='button' onclick='clearance_2ndsem_details($row[sr_no])' class='btn btn-warning btn-sm shadow-none me-3' data-bs-toggle='modal' data-bs-target='#edit-clearance_2ndsem'>
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

if (isset($_POST['edit_clearance_2ndsem'])) {
    $frm_data = filteration($_POST);

    $res1 = select("SELECT * FROM `clearance_2ndsem` WHERE  `sr_no`=?", [$frm_data['edit_clearance_2ndsem']], 'i');



    $clearance_2ndsemdata = mysqli_fetch_assoc($res1);


    // if(mysqli_num_rows($res2)>0){
    //      while($row = mysqli_fetch_assoc($res2)){
    //         array_push($features,$row['facilities_id']);
    //      }
    // }

    $data = ["clearance_2ndsemdata" => $clearance_2ndsemdata];


    $data = json_encode($data);

    echo $data;
}



if (isset($_POST['submit_edit_clearance_2ndsem'])) {

    $frm_data = filteration($_POST);

    $flag = 0;

    // check if clearance_2ndsem_id is present
    if (isset($frm_data['clearance_2ndsem_id'])) {

        $q1 = "UPDATE `clearance_2ndsem` SET `date`=?,`cais`=?,`carch`=?,`ccie`=?,`coe`=?,`ccs`=?,`cfes`=?,`che`=?,`cla`=?,`claw`=?,`cpers`=?,`csm`=?,`cswcd`=?,`cte`=?,`esu`=?,`graduate`=? WHERE `sr_no`=?";
        $values = [
            $frm_data['date'], $frm_data['cais'], $frm_data['carch'], $frm_data['ccie']
            , $frm_data['coe'], $frm_data['ccs'], $frm_data['cfes'], $frm_data['che'], $frm_data['cla']
            , $frm_data['claw'], $frm_data['cpers'], $frm_data['csm'], $frm_data['cswcd'], $frm_data['cte'], $frm_data['esu'], $frm_data['graduate'], $frm_data['clearance_2ndsem_id']
        ];

        if (update($q1, $values, 'siiiiiiiiiiiiiiii')) {
            $flag = 1;
        }
    } else {
        // display an error message or redirect the user
        echo "Error: clearance_2ndsem_id is not defined";
    }

    if ($flag) {
        echo 1;
    } else {
        echo 0;
    }
}

// if(isset($_POST['submit_edit_clearance_2ndsem'])){

//     $frm_data = filteration($_POST);

//     // Check the values of the $frm_data array
//     print_r($frm_data);

//     // $flag = 0;

//     // // Verify that the clearance_2ndsem_id key is present in the $frm_data array
//     // if (!isset($frm_data['clearance_2ndsem_id'])) {
//     //     die('clearance_2ndsem_id key not found in $frm_data array');
//     // }

//     // $q1 = "UPDATE `clearance_2ndsem` SET `date`=?,`cais`=?,`carch`=?,`ccie`=?,`coe`=?,`ccs`=?,`cfes`=?,`che`=?,`cla`=?,`claw`=?,`cpers`=?,`csm`=?,`cswcd`=?,`cte`=?,`esu`=?,`graduate`=? WHERE `sr_no`=?";
//     // $values = [$frm_data['date'],$frm_data['cais'],$frm_data['carch'],$frm_data['ccie']
//     // ,$frm_data['coe'],$frm_data['ccs'],$frm_data['cfes'],$frm_data['che'],$frm_data['cla']
//     // ,$frm_data['claw'],$frm_data['cpers'],$frm_data['csm'],$frm_data['cswcd'],$frm_data['cte'],$frm_data['esu'],$frm_data['graduate'],$frm_data['clearance_2ndsem_id']];

//     // // Debug the query
//     // echo "Query: $q1<br>";
//     // echo "Values: ";
//     // print_r($values);

//     // if(update($q1,$values,'siiiiiiiiiiiiiiii')){
//     //     $flag=1;
//     // }else{
//     //     $flag = 0;
//     //     die('query cannot be prepared - insert ');
//     // }

//     // if($flag){
//     //     echo 1;
//     // }else{
//     //     echo 0;
//     // }
// }




?>