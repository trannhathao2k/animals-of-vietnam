<?php
include("config.php");
include("autoload.php");
session_start();

if(isset($_POST["ten"])&&isset($_POST["mk"])){
    $data = (new obvervation)->ktDangNhap($_POST["ten"], $_POST["mk"]);
    if(
        $data == false
    ) $_SESSION["err"] = "Tên tài khoản hoặc mật khẩu sai";
    else{
        $_SESSION["tt_dangnhap"] = $data;//Đây là biến lưu tất cả thông tin khi đăng nhập thành công
        //điều hướng đến trang nào mình muốn
        header("location:index.php?route=capnhatthongtin");
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

            <a href="./admin/dangnhap-admin.php" class="text-decoration-none text-white link">Đăng nhập với vai trò Admin</a>
            
                <b class="dacdiem" style="font-size: 30px; ">
                    <b>
                        MY OBSERVATION
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
                    <div style="width: 500px; border-radius: 5px; background-color: white; padding: 20px 40px;">
                        <form action="" method="post">
                            <div style="height: 200px; text-align: center;">
                                <h3 class="dacdiem" style="line-height: 200px;">
                                    <b style="font-size: 30px;">
                                        MY OBSERVATION
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
                            <input type="submit" value="Đăng nhập" style="border: none; width: 100%; background-color: #006089; color: white; padding: 7px;">
                            <div class="text-end pt-1">
                                <a href="quenmatkhau.php">
                                    Quên mật khẩu?
                                </a>
                            </div>
                            <img src="./img/trothanhcongsu.png" id="trothanhcongsu" alt="">
                            <div class="text-center">
                                <a href="dangky.php" class="text-decoration-none text-danger">
                                    Đăng ký
                                </a>
                            </div>
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