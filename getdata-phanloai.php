<?php
include("./config.php");
include("./autoload.php");
session_start();

if(isset($_GET['phanloai']) && isset($_GET['loai'])) {
    $phanloai = $_GET['phanloai'];
    $loai = $_GET['loai'];
}
else {
    $phanloai = "*";
    $loai = "*";
}

switch($loai) {
    case "gioi":
        $sql
}

?>