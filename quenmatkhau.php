<?php
include("config.php");
include("autoload.php");
session_start();
if(isset($_POST["email"])){
    $data = (new obvervation)->kiemTraEmail($_POST["email"]);
    if(
        $data == false
    ) $_SESSION["err"] = "Email này không đăng ký tài khoản";
    else{
        include("rand_pass.php");
        $mknn = generatePassword();
        //include("send_email.php"); gửi mã xác nhận vào mail
        $_SESSION["r_pass"] = $mknn;
        $_SESSION["email"] = $_POST["email"];
        header("location:nhapmaxacnhan.php");
    }

}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quên mật khẩu</title>
    <link rel="stylesheet" href="./bootstrap/css/bootstrap.min.css">
    <script src="./bootstrap/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="./fontawesome/css/all.min.css">
    <link rel="stylesheet" href="./main.css">
</head>

<body>
    <div class="container-fluid root">
        <div class="header container-fluid">
            <a href="./index.php">
                <img id="logo" src="./img/logo.png" alt="Logo">
                <img id="thuonghieu" src="./img/thuonghieu.png" alt="Thương hiệu">&#160;&#160;
            </a>
            <a href="./dangnhap.php" class="text-decoration-none text-white link">Dang nhap</a>
            
            <a href="" class="text-decoration-none text-white">
                <b class="dacdiem" style="font-size: 30px; ">
                    <b>
                        QUÊN MẬT KHẨU
                    </b>
                </b>
            </a>
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
                            <div style="height: 250px; text-align: center;">
                                <h3 class="dacdiem" style="line-height: 250px;">
                                    <b style="font-size: 30px;">
                                        QUÊN MẬT KHẨU
                                    </b>
                                </h3>
                            </div>
                            <span class="text-danger">
                                
                                <?php if(isset($_SESSION["err"])) {echo $_SESSION["err"]; unset($_SESSION["err"]);} ?> 
                                
                            </span>
                            <input required name="email" type="email" class="form-control" placeholder="Nhập email của bạn">
                            <br>
                            <input type="submit" value="Tiếp theo" style="border: none; width: 100%; background-color: #006089; color: white; padding: 7px;">
                            <div class="text-end pt-2">
                                <a href="">
                                    Cần trợ giúp?
                                </a>
                            </div>
                            
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer">
            Đây là Footers
        </div>
    </div>
</body>

</html>