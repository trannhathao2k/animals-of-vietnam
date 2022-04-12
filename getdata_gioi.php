<?php
include("./config.php");
include("./autoload.php");
session_start();

if(isset($_GET['gioi'])) {
    $gioi = $_GET['gioi'];
}
else {
    $gioi = "Underfined";
}

$sql_sl_gioi = "SELECT * From nganh where ma_gioi = '$gioi'";

?>