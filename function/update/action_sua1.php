<?php
    include("../../config.php");
    include("../../autoload.php");
    session_start();

    //Thêm thông tin động vật
    if (isset($_POST['Sua_dv'])) {
        echo $_FILES['hinh_anh_1']['name'];   
        echo $_POST['review_1'];
        
        
    } 
?>