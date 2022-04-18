<?php
include("./config.php");
include("./autoload.php");
session_start();

if(isset($_GET['bang'])) {
    $bang = $_GET['bang'];
}
else {
    $bang = "bo";
}

if($bang){
        switch($bang){
        case "gioi":
            $sql_pl = "SELECT ten_gioi FROM gioi";
            break;
        case "nganh":
            $sql_pl = "SELECT ten_nganh FROM nganh";
            break;
        case "lop":
            $sql_pl = "SELECT ten_lop FROM lop";
            break;
        case "bo":
            $sql_pl = "SELECT ten_bo FROM bo";
            break;
        case "ho":
            $sql_pl = "SELECT ten_ho FROM ho";
            break;
    }

    $query_pl = mysqli_query($mysqli,$sql_pl);
    while($row_pl = mysqli_fetch_array($query_pl)) {
        echo 
        '
        <a href="?phanloai=<?php echo '.$row_pl["ma_".$bang].' ?>&loai='.$bang.'" class="text-decoration-none">
            <div class="oitem" style="display: inline-block;" >
                <h5 class="tenloai">
                    '.$row_pl["ten_".$bang].'
                </h5>       
            </div>
        </a>
        ';
        
    }
}
else {
    echo '<p style="color:red; font-weight: bold;">Vui lòng chọn phân loại</p>';
}



?>