<?php
include("config.php");
include("autoload.php");
session_start();
if(isset($_POST["tk"])&&isset($_POST["mk"])&&isset($_POST["ten"])&&isset($_POST["email"])&&isset($_POST["sdt"])){
    if(strlen($_POST["sdt"])!=10
    || !preg_match("/^[0-9]{10}$/", $_POST["sdt"])
    ) $_SESSION["err"] = "Số điện thoại phải có 10 số";
    else if(
        (new obvervation)->kiemTraTenTK($_POST["tk"])
    ){
        $_SESSION["err"] = "Tên tài khoản đã tồn tại";
    }elseif(
        (new obvervation)->kiemTraEmail($_POST["email"])
    ){
        $_SESSION["err"] = "Email đã tồn tại";
    }else{
        (new obvervation)->them($_POST["tk"],$_POST["mk"],$_POST["ten"],$_POST["email"],$_POST["sdt"]);
        //điều hướng đến trang nào mình muốn
        header("location:dangnhap.php");
       
        //header("refresh:0; url= dangnhap.php");
                        
    }

}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng ký</title>
    <link rel="stylesheet" href="./bootstrap/css/bootstrap.min.css">
    <script src="./bootstrap/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="./fontawesome/css/all.min.css">
    <link rel="stylesheet" href="./main.css">
</head>

<body>
    <div class="container-fluid root">
        <div class="header container-fluid">
            <a href="./index.php" class="text-decoration-none">
                <img id="logo" src="./img/logo.png" alt="Logo">
                <img id="thuonghieu" src="./img/thuonghieu.png" alt="Thương hiệu">&#160;&#160;
                
            </a>
            <a href="./dangnhap.php" class="text-decoration-none text-white link">Đăng nhập</a>
            
                <b class="dacdiem" style="font-size: 30px; ">
                    <b>
                        ĐĂNG KÝ CỘNG TÁC VIÊN
                    </b>
                </b>
        </div>
        <div style="background-color: #CDEDED; padding: 20px;">
            <div class="row">
                <div class="col-6 cangiuaanh">
                    <img src="./img/LogoCanhcuc.PNG" alt="" style="height: 400px; width:380px;">
                    <img src="./img/logoxanh.png" alt="">
                    <img src="./img/nentang.png" alt="">
                </div>
                <div class="col-5" style="padding-left: 70px; padding-top: 20px;">
                    <div style="width: 500px;height: 570px; border-radius: 5px; background-color: white; padding: 20px 40px;">
                        <form action="" method="post">
                            <div style="height: 130px; text-align: center;">
                                <h3 class="dacdiem" style="line-height: 150px;">
                                    <b style="font-size: 30px;">
                                        ĐĂNG KÝ
                                    </b>
                                </h3>
                            </div>
                            <span class="text-danger"><?php if(isset($_SESSION["err"])) {echo $_SESSION["err"]; unset($_SESSION["err"]);} ?> </span>
                            <br>
                            <input required name="tk" type="text" class="form-control" placeholder="Tên tài khoản">
                            <br>
                            <input required name="mk" type="password" class="form-control" placeholder="Mật khẩu">
                            <br>
                            <input required name="ten" type="text" class="form-control" placeholder="Họ và tên">
                            <br>
                            <input required name="email" type="email" class="form-control" placeholder="Email">
                            <br>
                            <input required name="sdt" type="text" class="form-control" placeholder="Số điện thoại">
                            <br>
                            <input type="submit" value="Đăng ký" style="border: none; width: 100%; background-color: #006089; color: white; padding: 7px;">
                            
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer">
        <pre>
            ©2022. Đường 3/2, phường Xuân Khánh, quận Ninh Kiều, thành phố Cần Thơ.
            Email: animalsofvietnam@gmail.com.
           </pre>
        </div>
    </div>
</body>

</html>