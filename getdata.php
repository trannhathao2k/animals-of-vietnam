<?php
include("../config.php");
include("../autoload.php");
session_start();


$sql = "select * from ".$_GET['bang'];
$data = (new Database)->query($sql);
if(count($data)>0){
    print_r($data);//In ra kết quả trả về
}else{
    echo "Không có kết quả phù hợp";
}

?>