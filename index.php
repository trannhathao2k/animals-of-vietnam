<?php
    include("config.php");
    include("autoload.php");
    session_start();
    //$mysqli = new mysqli("localhost","root","","animalsofvietnam");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Title thay đổi theo chức năng (Hiện tại cần refresh lại trang để hiển thị đúng) -->
    <title><?php echo $_SESSION['Title']; ?></title>
    
    <link rel="stylesheet" href="./bootstrap/css/bootstrap.min.css">
    <script src="./bootstrap/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="./fontawesome/css/all.min.css">
    <link rel="stylesheet" href="./main.css">
    <script src="//code.jquery.com/jquery-1.11.2.min.js"></script>
    <script src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
    <script src="ajax.js" type="text/javascript"></script>

    <link href="https://transloadit.edgly.net/releases/uppy/v1.6.0/uppy.min.css" rel="stylesheet">
    <script src="https://transloadit.edgly.net/releases/uppy/v1.6.0/uppy.min.js"></script>
</head>

<body>
    <!-- Header -->
    <div class="container-fluid root">
        <div class="header container-fluid">
            <!-- Logo -->
            <a class='text-decoration-none' href="?trangchu">
               <img id="logo" src="./img/logo.png" alt="Logo">
                <img id="thuonghieu" src="./img/thuonghieu.png" alt="Thương hiệu">&#160;&#160; 
            </a>
            
            <!-- Tìm kiếm -->
            <form style="display: inline-block;">
                <input type="hidden" name="route" value="timkiem">
                <input type="search" class="input_search form-control" name="keyword" placeholder="Nhập tên loài chim cần tìm...">
                <button type="submit" class="btn search_icon"><i class="fa-solid fa-magnifying-glass"></i></button>
            </form>

            <!-- Đăng nhập CTV -->
            <div style="display: inline-block;">
                <?php
                    if (!isset($_SESSION['tt_dangnhap'])) {
                        echo "<div class='dropdown position-absolute'><a href='./dangnhap.php' class='text-decoration-none text-white link'>My Observation</a></div>";
                    } else {
                        echo "<div class='dropdown position-absolute'>
                            <button class='btn text-white dropdown-toggle' type='button' id='dropdownMenuButton1' data-bs-toggle='dropdown' aria-expanded='false'>
                            CTV: ".$_SESSION['tt_dangnhap']['hoten_ctv']."
                            </button>
                            <ul class='dropdown-menu' aria-labelledby='dropdownMenuButton1'>
                                <li><a class='dropdown-item' href='?route=capnhatthongtin'>Cập nhật thông tin động vật</a></li>
                                <li><hr class='dropdown-divider'></li>
                                <li><a class='dropdown-item' href='dangxuat.php'>Đăng xuất</a></li>
                            </ul>
                        </div>";
                    }
                ?>
                
            </div>
        </div>

        <!-- Router - Chuyển hướng đến các chức năng -->
        <?php include("router.php"); ?>

        <!-- Footer -->
        <div class="footer">
           <pre>
            ©2022. Đường 3/2, phường Xuân Khánh, quận Ninh Kiều, thành phố Cần Thơ.
            Email: haob1805856@student.ctu.edu.vn. SDT: 0968892700.
           </pre> 
        </div>
    </div>
</body>

</html>