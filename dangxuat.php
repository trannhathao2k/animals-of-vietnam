<?php
if(isset($_SESSION["tt_dangnhap"])) unset($_SESSION["tt_dangnhap"]);
header("location:dangnhap.php");

?>