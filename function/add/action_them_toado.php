<?php
    include("../../config.php");
    include("../../autoload.php");
    session_start();
    
    if (isset($_POST['toado'])) {
        $toaDo = $_POST['toado'];
        $stt = $_POST['stt'];

        if ($toaDo!="") {
            $mysqli->query("insert into temp value('$stt','$toaDo');");
            (new obvervation)->NotificationAndGoback("Đã thêm tọa độ!");
        } else {
            (new obvervation)->NotificationAndGoback("Tọa độ vừa nhập có vấn đề!");
        } 
    }