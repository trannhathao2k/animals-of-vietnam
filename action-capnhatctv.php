<?php
    include("./config.php");
    include("./autoload.php");
    session_start();

    if (isset($_POST['luu-ctv'])) {
        $ten_ctv = trim($_POST['ten-ctv']);
        $ten_ctv = str_replace("'", "&#39;", $ten_ctv);
    }

?>