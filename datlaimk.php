<?php
include("config.php");
include("autoload.php");
session_start();
if(isset($_POST["mk"])&&isset($_POST["r_mk"])){
    if(
        $_POST["mk"] != $_POST["r_mk"]
    ) $_SESSION["err"] = "Mật khẩu nhập lại không trùng khớp";
    else{
        (new obvervation)->datlaiMK($_POST["mk"], $_SESSION["email"]);
        $_SESSION["err"] = "Cập nhật mật khẩu thành công";
        unset($_SESSION["email"]);
    }

}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đặt lại mật khẩu</title>
    <link rel="stylesheet" href="./bootstrap/css/bootstrap.min.css">
    <script src="./bootstrap/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="./fontawesome/css/all.min.css">
    <link rel="stylesheet" href="./main.css">
</head>

<body>
    <div class="container-fluid root">
        <div class="header container-fluid">
            
            <img id="logo" src="./img/logo.png" alt="Logo">
            <img id="thuonghieu" src="./img/thuonghieu.png" alt="Thương hiệu">&#160;&#160;
            <a href="" class="text-decoration-none text-white">
                <b class="dacdiem" style="font-size: 30px; ">
                    <b>
                        MY OBSERVATION
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
                                        ĐẶT LẠI MẬT KHẨU
                                    </b>
                                </h3>
                            </div>
                            <span class="text-danger">
                                
                                <?php if(isset($_SESSION["err"])) {echo $_SESSION["err"]; unset($_SESSION["err"]);} ?> 
                                
                            </span>
                            <br>
                            <input name="mk" required type="password" class="form-control" placeholder="Mật khẩu mới">
                            <br>
                            <input name="r_mk" required type="password" class="form-control" placeholder="Xác nhận mật khẩu">
                            <br>
                            <input type="submit" value="Đổi mật khẩu" style="border: none; width: 100%; background-color: #006089; color: white; padding: 7px;">
                            
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