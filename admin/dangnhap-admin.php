<?php

$conn = mysqli_connect("localhost", "root", "", "animalsofvietnam02") or die ('Không thể kết nối tới database');
include("../config.php");
session_start();

if(isset($_POST["ten"])&&isset($_POST["mk"])){
    
    $sql = "select ma_ad from admin where username='".$_POST["ten"]."' and password='".$_POST["mk"]."'";
    $kt = mysqli_fetch_all(mysqli_query($conn, $sql), MYSQLI_ASSOC);
    
    if(
        is_null($kt) || !isset($kt) || empty($kt)
    ) $_SESSION["err"] = "Tên tài khoản hoặc mật khẩu sai";
    else{
        $_SESSION["admin"] = $kt[0]["ma_ad"];
        header("location:./quanlydv.php");
    }

}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập</title>
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <script src="../bootstrap/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="../fontawesome/css/all.min.css">
    <link rel="stylesheet" href="../main.css">
</head>

<body>
    <div class="container-fluid root">
        <div class="header container-fluid">
            <a href="../index.php" class="text-decoration-none">
                <img id="logo" src="../img/logo.png" alt="Logo">
                <img id="thuonghieu" src="../img/thuonghieu.png" alt="Thương hiệu">&#160;&#160;
            </a>
            
                <b class="dacdiem" style="font-size: 30px; ">
                    <b>
                        ADMIN
                    </b>
                </b>
        </div>
        <div style="background-color: #CDEDED; padding: 20px;">
            <div class="row">
                <div class="col-6 cangiuaanh">
                    <img src="../img/LogoCanhcuc.PNG" alt="" style="height: 400px; width:380px;">
                    <img src="../img/logoxanh.png" alt="">
                    <img src="../img/nentang.png" alt="">
                </div>
                <div class="col-5" style="padding-left: 70px; padding-top: 20px;display: flex; align-items: center; justify-content: center;">
                    <div style="width: 500px; border-radius: 10px; background-color: white; padding: 20px 40px;">
                        <form action="" method="post">
                            <div style="height: 200px; text-align: center;">
                                <h3 class="dacdiem" style="line-height: 200px;">
                                    <b style="font-size: 30px;">
                                        ADMIN
                                    </b>
                                </h3>
                            </div>
                            <span class="text-danger">
                                <?php if(isset($_SESSION["err"])) {echo $_SESSION["err"]; unset($_SESSION["err"]);} ?> 
                            </span>
                            <input required name="ten" type="text" class="form-control" placeholder="Tên tài khoản">
                            <br>
                            <input required name="mk" type="password" class="form-control" placeholder="Mật khẩu">
                            <br>
                            <input type="submit" value="Đăng nhập" style="border: none; width: 100%; background-color: #006089; color: white; padding: 7px;margin: 30px 0 30px 0">
                        </form>
                    </div>
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