<?php

require("alert.php");
require("db.php");

adminLogin();


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link href="./csmlogo.png" rel="icon">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CSM - Clearance</title>

    <link rel="stylesheet" href="dashmain.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">

</head>

<body>

    <?php require('header.php') ?>


    <div class="container-fluid" id="main-content">
        <div class="row">
            <div class="col-lg-10 ms-auto p-4 overflow-y">
                <h3 class="mb-4"><i class="bi bi-clipboard2-check"></i> University Science Center Clearance</h3>

                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body">

                        <div class="text-end mb-4">

                            <button type="button" class="btn btn-warning btn-sm shadow-none mb-2" data-bs-toggle="modal"
                                data-bs-target="#add-clearance_2ndsem">
                                <i class="bi bi-file-plus"></i> Add
                            </button>
                            <!--<input type="text" oninput="search_chemical(this.value)" class="form-control shadow-none w-25 ms-auto" placeholder="Type to search..">-->
                        </div>
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <select id="semester-select" class="form-select shadow-none bg-light w-auto">
                                <option value="2">2nd Semester</option>
                                <option value="1">1st Semester</option>
                            </select>
                        </div>

                        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                        <script>
                            $('#semester-select').on('change', function () {
                                var selectedOption = $(this).val();
                                if (selectedOption === '1') {
                                    window.location.href = 'clearance.php';
                                } else if (selectedOption === '2') {
                                    window.location.href = 'clearance_2ndsem.php';
                                }
                            });
                        </script>

                        <div class="table-responsive-lg" style="height:450px; overflow-y:scroll;">
                            <table class="table table-hover border text-center">
                                <thead>
                                    <tr class="bg-secondary text-white">
                                        <th scope="col">Date</th>
                                        <th scope="col">CAIS</th>
                                        <th scope="col">CArch</th>
                                        <th scope="col">CCIE</th>
                                        <th scope="col">CoE</th>
                                        <th scope="col">CCS</th>
                                        <th scope="col">CFES</th>
                                        <th scope="col">CHE</th>
                                        <th scope="col">CLA</th>
                                        <th scope="col">CLaw</th>
                                        <th scope="col">CPERS</th>
                                        <th scope="col">CSM</th>
                                        <th scope="col">CSWCD</th>
                                        <th scope="col">CTE</th>
                                        <th scope="col">ESU</th>
                                        <th scope="col">Graduate</th>
                                        <th scope="col">Action</th>

                                    </tr>
                                </thead>
                                <tbody id="clearance_2ndsem_data">



                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>






            </div>
        </div>
    </div>


    <!----chemical Modal-->

    <div class="modal fade" id="add-clearance_2ndsem" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <form id="add_clearance_2ndsem_form" autocomplete="off" method="POST">
                <div class="modal-content">
                    <div class="modal-header">
                        <div class="modal-title fw-bold"><i class="bi bi-plus-square"></i> Add Clearance</div>
                    </div>
                    <div class="modal-body">

                        <div class="col-md-4 mb-3">
                            <label class="form-label fw-bold">Date</label>
                            <input type="date" name="date" class="form-control shadow-none">
                        </div>

                        <div class="row">

                            <div class="col-md-2 mb-3">
                                <label class="form-label fw-bold">CAIS</label>
                                <input type="number" min="0" name="cais" class="form-control shadow-none">
                            </div>

                            <div class="col-md-2 mb-3">
                                <label class="form-label fw-bold">CArch</label>
                                <input type="number" min="0" name="carch" class="form-control shadow-none">
                            </div>

                            <div class="col-md-2 mb-3">
                                <label class="form-label fw-bold">CCIE</label>
                                <input type="number" min="0" name="ccie" class="form-control shadow-none">
                            </div>

                            <div class="col-md-2 mb-3">
                                <label class="form-label fw-bold">CoE</label>
                                <input type="number" min="0" name="coe" class="form-control shadow-none">
                            </div>

                            <div class="col-md-2 mb-3">
                                <label class="form-label fw-bold">CCS</label>
                                <input type="number" min="0" name="ccs" class="form-control shadow-none">
                            </div>

                            <div class="col-md-2 mb-3">
                                <label class="form-label fw-bold">CFES</label>
                                <input type="number" min="0" name="cfes" class="form-control shadow-none">
                            </div>

                            <div class="col-md-2 mb-3">
                                <label class="form-label fw-bold">CHE</label>
                                <input type="number" min="0" name="che" class="form-control shadow-none">
                            </div>

                            <div class="col-md-2 mb-3">
                                <label class="form-label fw-bold">CLA</label>
                                <input type="number" min="0" name="cla" class="form-control shadow-none">
                            </div>

                            <div class="col-md-2 mb-3">
                                <label class="form-label fw-bold">CLaw</label>
                                <input type="number" min="0" name="claw" class="form-control shadow-none">
                            </div>

                            <div class="col-md-2 mb-3">
                                <label class="form-label fw-bold">CPers</label>
                                <input type="number" min="0" name="cpers" class="form-control shadow-none">
                            </div>

                            <div class="col-md-2 mb-3">
                                <label class="form-label fw-bold">CSM</label>
                                <input type="number" min="0" name="csm" class="form-control shadow-none">
                            </div>

                            <div class="col-md-2 mb-3">
                                <label class="form-label fw-bold">CSWCD</label>
                                <input type="number" min="0" name="cswcd" class="form-control shadow-none">
                            </div>

                            <div class="col-md-2 mb-3">
                                <label class="form-label fw-bold">CTE</label>
                                <input type="number" min="0" name="cte" class="form-control shadow-none">
                            </div>

                            <div class="col-md-2 mb-3">
                                <label class="form-label fw-bold">ESU</label>
                                <input type="number" min="0" name="esu" class="form-control shadow-none">
                            </div>

                            <div class="col-md-2 mb-3">
                                <label class="form-label fw-bold">Graduate</label>
                                <input type="number" min="0" name="graduate" class="form-control shadow-none">
                            </div>







                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="reset" class="btn btn-secondary shadow-none"
                            data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success shadow-none">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>


    <!----edit chemical Modal-->

    <div class="modal fade" id="edit-clearance_2ndsem" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <form id="edit_clearance_2ndsem" autocomplete="off" method="POST">
                <div class="modal-content">
                    <div class="modal-header">
                        <div class="modal-title fw-bold"><i class="bi bi-plus-square"></i> Add Clearance</div>
                    </div>
                    <div class="modal-body">

                        <div class="col-md-4 mb-3">
                            <label class="form-label fw-bold">Date</label>
                            <input type="date" name="date" class="form-control shadow-none">
                        </div>

                        <div class="row">

                            <div class="col-md-2 mb-3">
                                <label class="form-label fw-bold">CAIS</label>
                                <input type="number" min="0" name="cais" class="form-control shadow-none">
                            </div>

                            <div class="col-md-2 mb-3">
                                <label class="form-label fw-bold">CArch</label>
                                <input type="number" min="0" name="carch" class="form-control shadow-none">
                            </div>

                            <div class="col-md-2 mb-3">
                                <label class="form-label fw-bold">CCIE</label>
                                <input type="number" min="0" name="ccie" class="form-control shadow-none">
                            </div>

                            <div class="col-md-2 mb-3">
                                <label class="form-label fw-bold">CoE</label>
                                <input type="number" min="0" name="coe" class="form-control shadow-none">
                            </div>

                            <div class="col-md-2 mb-3">
                                <label class="form-label fw-bold">CCS</label>
                                <input type="number" min="0" name="ccs" class="form-control shadow-none">
                            </div>

                            <div class="col-md-2 mb-3">
                                <label class="form-label fw-bold">CFES</label>
                                <input type="number" min="0" name="cfes" class="form-control shadow-none">
                            </div>

                            <div class="col-md-2 mb-3">
                                <label class="form-label fw-bold">CHE</label>
                                <input type="number" min="0" name="che" class="form-control shadow-none">
                            </div>

                            <div class="col-md-2 mb-3">
                                <label class="form-label fw-bold">CLA</label>
                                <input type="number" min="0" name="cla" class="form-control shadow-none">
                            </div>

                            <div class="col-md-2 mb-3">
                                <label class="form-label fw-bold">CLaw</label>
                                <input type="number" min="0" name="claw" class="form-control shadow-none">
                            </div>

                            <div class="col-md-2 mb-3">
                                <label class="form-label fw-bold">CPers</label>
                                <input type="number" min="0" name="cpers" class="form-control shadow-none">
                            </div>

                            <div class="col-md-2 mb-3">
                                <label class="form-label fw-bold">CSM</label>
                                <input type="number" min="0" name="csm" class="form-control shadow-none">
                            </div>

                            <div class="col-md-2 mb-3">
                                <label class="form-label fw-bold">CSWCD</label>
                                <input type="number" min="0" name="cswcd" class="form-control shadow-none">
                            </div>

                            <div class="col-md-2 mb-3">
                                <label class="form-label fw-bold">CTE</label>
                                <input type="number" min="0" name="cte" class="form-control shadow-none">
                            </div>

                            <div class="col-md-2 mb-3">
                                <label class="form-label fw-bold">ESU</label>
                                <input type="number" min="0" name="esu" class="form-control shadow-none">
                            </div>

                            <div class="col-md-2 mb-3">
                                <label class="form-label fw-bold">Graduate</label>
                                <input type="number" min="0" name="graduate" class="form-control shadow-none">
                            </div>






                            <input type="hidden" name="clearance_2ndsem_id">

                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="reset" class="btn btn-secondary shadow-none"
                            data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success shadow-none">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>






    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa"
        crossorigin="anonymous"></script>


    <?php
    require("script.php");
    ?>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>

        let add_clearance_2ndsem_form = document.getElementById('add_clearance_2ndsem_form');



        add_clearance_2ndsem_form.addEventListener('submit', function (e) {
            e.preventDefault();
            add_clerance();
        });

        function add_clerance() {
            let data = new FormData();
            data.append('add_clearance_2ndsem', '');
            data.append('date', add_clearance_2ndsem_form.elements['date'].value);
            data.append('cais', add_clearance_2ndsem_form.elements['cais'].value);
            data.append('carch', add_clearance_2ndsem_form.elements['carch'].value);
            data.append('ccie', add_clearance_2ndsem_form.elements['ccie'].value);
            data.append('coe', add_clearance_2ndsem_form.elements['coe'].value);
            data.append('ccs', add_clearance_2ndsem_form.elements['ccs'].value);
            data.append('cfes', add_clearance_2ndsem_form.elements['cfes'].value);
            data.append('che', add_clearance_2ndsem_form.elements['che'].value);
            data.append('cla', add_clearance_2ndsem_form.elements['cla'].value);
            data.append('claw', add_clearance_2ndsem_form.elements['claw'].value);
            data.append('cpers', add_clearance_2ndsem_form.elements['cpers'].value);
            data.append('csm', add_clearance_2ndsem_form.elements['csm'].value);
            data.append('cswcd', add_clearance_2ndsem_form.elements['cswcd'].value);
            data.append('cte', add_clearance_2ndsem_form.elements['cte'].value);
            data.append('esu', add_clearance_2ndsem_form.elements['esu'].value);
            data.append('graduate', add_clearance_2ndsem_form.elements['graduate'].value);



            let xhr = new XMLHttpRequest();
            xhr.open("POST", "clearance_2ndsem_ajax.php", true);

            xhr.onload = function () {
                var myModalEl = document.getElementById('add-clearance_2ndsem')
                var modal = bootstrap.Modal.getInstance(myModalEl) // Returns a Bootstrap modal instanceof
                modal.hide();

                if (this.responseText == 1) {
                    Swal.fire(
                        'Good job!',
                        'Second Sem Clearance Added',
                        'success'
                    )
                    add_clearance_2ndsem_form.reset();
                    get_clearance_2ndsem();

                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Something went wrong!',
                    })
                }

            }
            xhr.send(data);
        }


        function get_clearance_2ndsem() {

            let xhr = new XMLHttpRequest();
            xhr.open("POST", "clearance_2ndsem_ajax.php", true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

            xhr.onload = function () {
                document.getElementById('clearance_2ndsem_data').innerHTML = this.responseText;
            }
            xhr.send('get_clearance_2ndsem');

        }




        let edit_clearance_2ndsem = document.getElementById('edit_clearance_2ndsem');

        function clearance_2ndsem_details(sr_no) {



            let xhr = new XMLHttpRequest();
            xhr.open("POST", "clearance_2ndsem_ajax.php", true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

            xhr.onload = function () {

                let data = JSON.parse(this.responseText);
                edit_clearance_2ndsem.elements['date'].value = data.clearance_2ndsemdata.date;
                edit_clearance_2ndsem.elements['cais'].value = data.clearance_2ndsemdata.cais;
                edit_clearance_2ndsem.elements['carch'].value = data.clearance_2ndsemdata.carch;
                edit_clearance_2ndsem.elements['ccie'].value = data.clearance_2ndsemdata.ccie;
                edit_clearance_2ndsem.elements['coe'].value = data.clearance_2ndsemdata.coe;
                edit_clearance_2ndsem.elements['ccs'].value = data.clearance_2ndsemdata.ccs;
                edit_clearance_2ndsem.elements['cfes'].value = data.clearance_2ndsemdata.cfes;
                edit_clearance_2ndsem.elements['che'].value = data.clearance_2ndsemdata.che;
                edit_clearance_2ndsem.elements['cla'].value = data.clearance_2ndsemdata.cla;
                edit_clearance_2ndsem.elements['claw'].value = data.clearance_2ndsemdata.claw;
                edit_clearance_2ndsem.elements['cpers'].value = data.clearance_2ndsemdata.cpers;
                edit_clearance_2ndsem.elements['csm'].value = data.clearance_2ndsemdata.csm;
                edit_clearance_2ndsem.elements['cswcd'].value = data.clearance_2ndsemdata.cswcd;
                edit_clearance_2ndsem.elements['cte'].value = data.clearance_2ndsemdata.cte;
                edit_clearance_2ndsem.elements['esu'].value = data.clearance_2ndsemdata.esu;
                edit_clearance_2ndsem.elements['graduate'].value = data.clearance_2ndsemdata.graduate;
                edit_clearance_2ndsem.elements['clearance_2ndsem_id'].value = data.clearance_2ndsemdata.sr_no;




            }
            xhr.send('edit_clearance_2ndsem=' + sr_no);
        }


        edit_clearance_2ndsem.addEventListener('submit', function (e) {
            e.preventDefault();
            submit_edit_clearance_2ndsem();
        });


        function submit_edit_clearance_2ndsem() {
            let data = new FormData();
            data.append('submit_edit_clearance_2ndsem', '');
            data.append('clearance_2ndsem_id', edit_clearance_2ndsem.elements['clearance_2ndsem_id'].value);
            data.append('date', edit_clearance_2ndsem.elements['date'].value);
            data.append('cais', edit_clearance_2ndsem.elements['cais'].value);
            data.append('carch', edit_clearance_2ndsem.elements['carch'].value);
            data.append('ccie', edit_clearance_2ndsem.elements['ccie'].value);
            data.append('coe', edit_clearance_2ndsem.elements['coe'].value);
            data.append('ccs', edit_clearance_2ndsem.elements['ccs'].value);
            data.append('cfes', edit_clearance_2ndsem.elements['cfes'].value);
            data.append('che', edit_clearance_2ndsem.elements['che'].value);
            data.append('cla', edit_clearance_2ndsem.elements['cla'].value);
            data.append('claw', edit_clearance_2ndsem.elements['claw'].value);
            data.append('cpers', edit_clearance_2ndsem.elements['cpers'].value);
            data.append('csm', edit_clearance_2ndsem.elements['csm'].value);
            data.append('cswcd', edit_clearance_2ndsem.elements['cswcd'].value);
            data.append('cte', edit_clearance_2ndsem.elements['cte'].value);
            data.append('esu', edit_clearance_2ndsem.elements['esu'].value);
            data.append('graduate', edit_clearance_2ndsem.elements['graduate'].value);





            let xhr = new XMLHttpRequest();
            xhr.open("POST", "clearance_2ndsem_ajax.php", true);

            xhr.onload = function () {
                var myModalEl = document.getElementById('edit-clearance_2ndsem')
                var modal = bootstrap.Modal.getInstance(myModalEl) // Returns a Bootstrap modal instanceof
                modal.hide();

                if (this.responseText == 1) {
                    Swal.fire(
                        'Good job!',
                        'Second Sem Clearance Edit Successfully',
                        'success'
                    )
                    edit_clearance_2ndsem.reset();
                    get_clearance_2ndsem();

                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Something went wrong!',
                    })
                }

            }
            xhr.send(data);
        }









        // function toggleStatus(id,val){

        //         let xhr = new XMLHttpRequest();
        //             xhr.open("POST","chemical_ajax.php",true);
        //             xhr.setRequestHeader('Content-Type','application/x-www-form-urlencoded');

        //             xhr.onload = function(){
        //                 if(this.responseText==1){
        //                     // alert('success','Status Active');
        //                     get_chemical();
        //                 }
        //                 else{
        //                     alert('error','Status Not Active');
        //                 }
        //             }
        //             xhr.send('toggleStatus='+id+'&value='+val);

        //     }



        //     function search_chemical(apparatusname){
        //         let xhr = new XMLHttpRequest();
        //         xhr.open("POST","chemical_ajax.php",true);
        //         xhr.setRequestHeader('Content-Type','application/x-www-form-urlencoded');

        //         xhr.onload = function(){
        //             document.getElementById('chemical_data').innerHTML = this.responseText;
        //         }
        //         xhr.send('search_chemical&name='+apparatusname);
        //     }




        window.onload = function () {
            get_clearance_2ndsem();
        }





    </script>



</body>

</html>