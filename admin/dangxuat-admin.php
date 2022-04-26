<?php
session_start();
if(isset($_SESSION["admin"])) unset($_SESSION["admin"]);
// header("location:dangnhap.php");
header("location:../index.php");
?>