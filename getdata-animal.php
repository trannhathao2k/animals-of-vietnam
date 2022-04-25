<?php
include("./config.php");
include("./autoload.php");
session_start();

if(isset($_GET['animal'])) {
    $animal = $_GET['animal'];
}
else {
    $animal = "Underfined";
}

switch($animal) {
    case "moinhat":
        $sql_animal = "SELECT * FROM hinhanh_index, dongvat
            WHERE dongvat.ma_dv = hinhanh_index.ma_dv ORDER BY dongvat.ma_dv DESC";
            break;
    case "cunhat":
        $sql_animal = "SELECT * FROM hinhanh_index, dongvat
            WHERE dongvat.ma_dv = hinhanh_index.ma_dv ORDER BY dongvat.ma_dv ASC";
            break;
    case "iucn":
        $sql_animal = "SELECT * FROM hinhanh_index, dongvat
            WHERE dongvat.ma_dv = hinhanh_index.ma_dv ORDER BY ma_bt_iucn ASC";
            break;
    case "ten":
        $sql_animal = "SELECT * FROM hinhanh_index, dongvat
            WHERE dongvat.ma_dv = hinhanh_index.ma_dv ORDER BY dongvat.ten_dv ASC";
            break;
}

$query_animal = mysqli_query($mysqli,$sql_animal);
while($row_animal = mysqli_fetch_array($query_animal)) {
    echo
    '<div class="oitem1">
        <a class="text-decoration-none" href="?route=chitiet&id='.$row_animal['ma_dv'].'">
            <img class="anh-index" src="./img/animals/'.$row_animal['ten_image_index'].'" width="50px" alt="'.$row_animal['ten_image_index'].'">
            <div style="padding: 5px;" class="tendv">
                <h6 class="tendv" style="color: #006089;">
                    '.$row_animal['ten_dv'].'
                </h6>
            </div>
        </a>
    </div>';
}

?>