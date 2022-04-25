<?php
    include("../../config.php");
    include("../../autoload.php");
    session_start();
    
    if (isset($_POST['toado'])) {
        $toaDo = $_POST['toado'];

        if ($toaDo!="") {
            $mysqli->query("insert into temp value(null,'$toaDo');");
            (new obvervation)->GoBack();
        } else {
            (new obvervation)->NotificationAndGoback("Tọa độ vừa nhập có vấn đề!");
        } 
    }