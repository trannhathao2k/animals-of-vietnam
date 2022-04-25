<?php
include("config.php");
include("autoload.php");
session_start();

if(isset($_GET['phanloai']) && isset($_GET['loai'])) {
    $phanloai = $_GET['phanloai'];
    $loai = $_GET['loai'];
}
else {
    $phanloai = "bo";
    $loai = "2";
}

switch($phanloai) {
    case "gioi":
        $sql_pl = "SELECT * FROM hinhanh, dongvat
        WHERE dongvat.ma_dv = hinhanh.ma_dv AND hinhanh.image_index = 1 AND ma_gioi = $loai";
        break;
    case "nganh":
        $sql_pl = "SELECT * FROM hinhanh, dongvat
        WHERE dongvat.ma_dv = hinhanh.ma_dv AND hinhanh.image_index = 1 AND ma_nganh = $loai";
        break;
    case "lop":
        $sql_pl = "SELECT * FROM hinhanh, dongvat
        WHERE dongvat.ma_dv = hinhanh.ma_dv AND hinhanh.image_index = 1 AND ma_lop = $loai";
        break;
    case "bo":
        $sql_pl = "SELECT * FROM hinhanh, dongvat
        WHERE dongvat.ma_dv = hinhanh.ma_dv AND hinhanh.image_index = 1 AND ma_bo = $loai";
        break;
    case "ho":
        $sql_pl = "SELECT * FROM hinhanh, dongvat
        WHERE dongvat.ma_dv = hinhanh.ma_dv AND hinhanh.image_index = 1 AND ma_ho = $loai";
        break;
    case "all":
        $sql_pl = "SELECT * FROM hinhanh, dongvat
        WHERE dongvat.ma_dv = hinhanh.ma_dv AND hinhanh.image_index = 1";
        break;
}

if(isset($_GET['animal'])) {
    $animal = $_GET['animal'];
}
else {
    $animal = "ten";
}

switch($animal) {
    case "moinhat":
        $sql_animal = $sql_pl.' '."ORDER BY dongvat.ma_dv DESC";
        break;
    case "cunhat":
        $sql_animal = $sql_pl.' '."ORDER BY dongvat.ma_dv ASC";
        break;
    case "iucn":
        $sql_animal = $sql_pl.' '."ORDER BY dongvat.ma_bt_iucn ASC";
        break;
    case "ten":
        $sql_animal = $sql_pl.' '."ORDER BY dongvat.ten_dv ASC";
        break;
}
/*
//Tính toán số dữ liệu để hiển thị theo trang
$numOfData = 9; //Số dữ liệu hiển thị trong 1 trang

// $sql = "select count(*) from hinhanh,dongvat
// where dongvat.ma_dv=hinhanh.ma_dv and hinhanh.image_index=1";

$sql_1 = $mysqli->query($sql_animal);
$num = mysqli_num_rows($sql_1);
$numOfPages = ceil( $num / $numOfData );

if( !isset($_GET['page']) ) {
    //Vị trí bắt đầu
    $vtbd = 0;
}
else {
    $vtbd = ($_GET['page']-1) * $numOfData;
}//
$sql_animal .=" limit $vtbd,$numOfData";*/

$query_animal = mysqli_query($mysqli,$sql_animal);
while($row_animal = mysqli_fetch_array($query_animal)) {
    echo
    '<div class="oitem1">
        <a class="text-decoration-none" href="?route=chitiet&id='.$row_animal['ma_dv'].'">
            <img class="anh-index" src="./img/animals/'.$row_animal['ten_image'].'" width="50px" alt="'.$row_animal['ten_image'].'">
            <div style="padding: 5px;" class="tendv">
                <h6 class="tendv" style="color: #006089;">
                    '.$row_animal['ten_dv'].'
                </h6>
            </div>
        </a>
    </div>';
    // ''.$sql_animal.'';
    
}
?><!-- 
<div style="text-align:center">
    <div style="display: inline-block;">
        <ul class="pagination">
            <?php
                // for($i=1; $i<=$numOfPages; $i++) {
                //     $link = "?route=trangchu&page=".$i;
                //     echo "<li class='page-item active'>
                //         <a class='page-link' href='$link'>$i</a>
                //     </li>";
                // }
            ?>
        </ul>
    </div>                    
</div>
 -->