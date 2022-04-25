<?php
    if(isset($_GET['route'])) {
        $route = $_GET['route'];
    }
    else {
        $route = "";
    }

    //Cần refresh lại trang để title hiển thị đúng

    switch($route) {
        case "timkiem":
            $_SESSION['Title'] = "Tìm kiếm";
            include("timkiem.php"); 
            break;

        case "chitiet":
            $_SESSION['Title'] = "Chi tiết";
            include("chitiet.php");            
            break;

        case "capnhatthongtin":
            $_SESSION['Title'] = "Cập nhật thông tin";
            include("capnhat.php");            
            break;

        case "suathongtin":
            $_SESSION['Title'] = "Sửa thông tin";
            include("function/update/sua.php");            
            break;

        case "themthongtin":
            $_SESSION['Title'] = "Thêm thông tin";
            include("function/add/them.php");            
            break;

        case "testcode":
            $_SESSION['Title'] = "Test Code";
            include("testcode.php");            
            break;

        case "trangchu":
            $_SESSION['Title'] = "Trang chủ";
            include("trangchu.php");            
            break;

        default:
            $_SESSION['Title'] = "Animals of VietNam - Trang tìm hiểu động vật Việt Nam";
            include("trangchu.php");            
    }
?>