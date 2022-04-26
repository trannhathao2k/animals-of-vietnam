<?php

$conn = mysqli_connect("localhost", "root", "", "animalsofvietnam02") or die ('Không thể kết nối tới database');
include("../config.php");
session_start();


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách CTV</title>
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <script src="../bootstrap/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="../fontawesome/css/all.min.css">
    <link rel="stylesheet" href="../main.css">
</head>

<body>
    <div class="container-fluid root">
        <div class="header container-fluid">
            <a href="../index.php">
                <img id="logo" src="../img/logo.png" alt="Logo">
                <img id="thuonghieu" src="../img/thuonghieu.png" alt="Thương hiệu">&#160;&#160;
            </a>
            
            <a href="./dangxuat-admin.php" class="text-decoration-none text-white link">Đăng xuất</a>
                <b class="dacdiem" style="font-size: 30px; ">
                    <b>
                        ADMIN
                    </b>
                </b>
        </div>
        <div style="background-color: #CDEDED; padding: 20px;">
            <div class="mx-auto" style="width: 60%">
            <div class="table-responsive">
                <table class="table table-hover">
                    <tr>
                        <th style="width:30%;">
                            Mã CTV
                        </th>
                        <th>
                            Tên CTV
                        </th>
                        <th>

                        </th>
                    </tr>
                    <?php
                        $sql = "select ma_ctv, hoten_ctv from obvervation";
                        $data = mysqli_fetch_all(mysqli_query($conn, $sql), MYSQLI_ASSOC);
                        if(!is_null($data)&&!empty($data)){
                            foreach($data as $x){
                                echo '<tr>';
                                echo
                                '
                                <td>
                                '.$x["ma_ctv"].'
                                </td>
                                <td>
                                '.$x["hoten_ctv"].'
                                </td>
                                <td>
                                    <a class="btn btn-danger" href="xoactv.php?id='.$x["ma_ctv"].'" >Xóa</a>
                                </td>
                                ';
                                echo '</tr>';
                            }
                        }
                    ?>
                </table>
            </div>
            </div>
        </div>
        <div class="footer">
        <pre>
            ©2022. Đường 3/2, phường Xuân Khánh, quận Ninh Kiều, thành phố Cần Thơ.
            Email: haob1805856@student.ctu.edu.vn. SDT: 0968892700.
           </pre>
        </div>
    </div>
</body>

</html>