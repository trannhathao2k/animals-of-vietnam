<?php
    include("../../config.php");
    include("../../autoload.php");
    session_start();

    if (isset($_POST['xoa_toado'])) {
        $_SESSION['no_reload'] = "yes";
        $maTemp = $_POST['xoa_toado'];

        $mysqli->query("delete from temp where ma_temp='$maTemp';");
        (new obvervation)->Goback();
    }