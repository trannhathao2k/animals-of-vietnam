<?php
    if(isset($_GET['route'])) {
        $route = $_GET['route'];
    }
    else {
        $route = "";
    }

    switch($route) {
        case "timkiem":
            include("function/search/timkiem.php");
            break;

        case "chitiet":
            include("function/detail/chitiet.php");
            break;

        case "trangchu":
            include("trangchu.php");

        default:
            include("trangchu.php");
    }
?>