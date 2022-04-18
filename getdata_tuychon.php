<?php
include("./config.php");
include("./autoload.php");
session_start();

if(isset($_GET['tuychon'])) {
    $tuychon = $_GET['tuychon'];
}
else {
    $tuychon = "Underfined";
}

$sql_sl_gioi = "SELECT *
    FROM gioi, nganh, lop, bo, ho
    WHERE
        gioi.ma_gioi = nganh.ma_gioi AND
        nganh.ma_nganh = lop.ma_nganh AND
        lop.ma_lop = bo.ma_lop AND
        bo.ma_bo = ho.ma_bo AND
        gioi.ma_gioi = '.$gioi.'";

$query_sl_gioi = mysqli_query($mysqli,$sql_sl_gioi);

?>