<?php
session_start();
$conn = mysqli_connect("localhost", "root", "", "animalsofvietnam02") or die ('Không thể kết nối tới database');
if(isset($_GET["id"])){
    $id = $_GET["id"];
    mysqli_query($conn, "delete from obvervation where ma_ctv='$id'");
    mysqli_query($conn, "delete from themdongvat where ma_ctv='$id'");
header("location:dsctv.php");
}

?>