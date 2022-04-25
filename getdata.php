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

if($bang && $bang != "all"){
        switch($bang){
        case "gioi":
            $sql_pl = "SELECT * FROM gioi";
            break;
        case "nganh":
            $sql_pl = "SELECT * FROM nganh";
            break;
        case "lop":
            $sql_pl = "SELECT * FROM lop";
            break;
        case "bo":
            $sql_pl = "SELECT * FROM bo";
            break;
        case "ho":
            $sql_pl = "SELECT * FROM ho";
            break;            
    }

    $query_pl = mysqli_query($mysqli,$sql_pl);
    while($row_pl = mysqli_fetch_array($query_pl)) {
        echo 
        '
            <div class="oitem tenloai" onclick="showdv(\''.$bang.'\','.$row_pl["ma_$bang"].')" style="display: inline-block;" >
                <input type="radio" id="'.$row_pl["ma_$bang"].'" name="oitem" value="'.$row_pl["ma_$bang"].'" style="opacity: 0">
                <label for="'.$row_pl["ma_$bang"].'">
                    <h5 class="tenloai">'.$row_pl["ten_$bang"].'</h5>
                </label>       
            </div>
        ';
        
    }
}
else {
    echo '<div class="oitem" onclick="showdv(\'all\',\'all\')" style="display: inline-block;" >
            <input type="radio" id="all" name="oitem" value="all" style="opacity: 0">
            <label for="all">
                <h5 class="tenloai">Tất cả</h5>
            </label>       
        </div>';
}



?>