<?php
include("./config.php");
include("./autoload.php");
session_start();

if(isset($_GET['anh']) && isset($_GET['id'])) {
    $anh = $_GET['anh'];
    $id = $_GET['id'];
}
else {
    $anh = "Underfine";
    $id = "Underfine";
}



?>