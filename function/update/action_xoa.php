<?php
    include("../../config.php");
    include("../../autoload.php");
    session_start();

    if (isset($_POST['xoa_MA_DV']) and isset($_POST['xoa_TEN_DV'])) {
        $sql_xoa_ctv = "delete from themdongvat where ma_dv='".$_POST['xoa_MA_DV']."';";
            $mysqli->query($sql_xoa_ctv);

        $sql_get_ten_image = "select ten_image from hinhanh where ma_dv='".$_POST['xoa_MA_DV']."';";
        $ten_image_query = $mysqli->query($sql_get_ten_image);
        if (mysqli_num_rows($ten_image_query)!=0) {
            $ten_image_query_result = $ten_image_query->fetch_array();
            $ten_file_image = "../../img/animals/".$ten_image_query_result[0];
            if (file_exists($ten_file_image)) {
                unlink($ten_file_image);
            }
        }
        

        $sql_xoa_toado = "delete from toado where ma_dv='".$_POST['xoa_MA_DV']."';";
        $mysqli->query($sql_xoa_toado);
        
        $sql_xoa_hinh_anh = "delete from hinhanh where ma_dv='".$_POST['xoa_MA_DV']."';";
            $mysqli->query($sql_xoa_hinh_anh);
        $sql_xoa_dongvat = "delete from dongvat where ma_dv='".$_POST['xoa_MA_DV']."';";
            $mysqli->query($sql_xoa_dongvat);

        unset($_POST['xoa_MA_DV']); unset($_POST['xoa_TEN_DV']); 
        (new obvervation)->Goback();
    }
?>

