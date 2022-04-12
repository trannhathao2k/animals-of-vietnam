<!-- <style>
    .alert {
    padding: 20px;
    background-color: #F44336;
    color: white;
    }

    .closebtn {
    margin-left: 15px;
    color: white;
    font-weight: bold;
    float: right;
    font-size: 22px;
    line-height: 20px;
    cursor: pointer;
    transition: 0.3s;
    }

    .closebtn:hover {
    color: black;
    }
</style> -->


<?php
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
        

        $sql_xoa_phanbo = "delete from phanbo where ma_dv='".$_POST['xoa_MA_DV']."';";
            $mysqli->query($sql_xoa_phanbo);
        
        $sql_xoa_hinh_anh = "delete from hinhanh where ma_dv='".$_POST['xoa_MA_DV']."';";
            $mysqli->query($sql_xoa_hinh_anh);
        $sql_xoa_dongvat = "delete from dongvat where ma_dv='".$_POST['xoa_MA_DV']."';";
            $mysqli->query($sql_xoa_dongvat);

        unset($_POST['xoa_MA_DV']); unset($_POST['xoa_TEN_DV']); 
    }

    // Xac nhan lan 2
    // if (isset($_POST['xoa_MA_DV']) and isset($_POST['xoa_TEN_DV']) and isset($_POST['xac_nhan_xoa'])) {
    //     $sql_xoa = "delete from dongvat where Ma_dv='".$_POST['xoa_MA_DV']."';";
    //     $mysqli->query($sql_xoa);
    //     echo "Xac nhan xoa";
    //     unset($_POST['xoa_MA_DV']); unset($_POST['xoa_TEN_DV']); unset($_POST['xac_nhan_xoa']);
    // } else if (isset($_POST['xoa_MA_DV']) and isset($_POST['xoa_TEN_DV']) and isset($_POST['khong_xac_nhan'])) {
    //     echo "Ko xac nhan";
    //     unset($_POST['xoa_MA_DV']); unset($_POST['xoa_TEN_DV']); unset($_POST['xac_nhan_xoa']);
    // }
    
    // if (isset($_POST['xoa_MA_DV']) and isset($_POST['xoa_TEN_DV'])) {
    //     $Ten_dv_xoa = $_POST['xoa_TEN_DV'];

    //     echo "<form method='POST'><div class='alert'>
    //         <span class='closebtn' type='submit' name='khong_xac_nhan' onclick=\"this.parentElement.style.display='none';\">&times;</span> 
            
    //             <strong>Lưu ý: Việc xóa là không thể hoàn tác!</strong> Xác nhận xóa thông tin của: $Ten_dv_xoa ?
    //             <button type='submit' name='xac_nhan_xoa'>Xóa</button>
            
    //     </div></form>";

    //     unset($_POST['xoa_MA_DV']); unset($_POST['xoa_TEN_DV']);        
    // }
?>

<div style="padding: 40px;background-color: #CDEDED;">
    <div class="table-responsive" style="overflow-x:auto;">
        <div><a href='?route=themthongtin' target='_blank'><button>Thêm thông tin động vật</button></a></div>
        <table class="table table-hover" style="border: 2px solid #000000;">
            <tr>
                <th>
                    Ảnh
                </th>
                <th>
                    Tên Tiếng Việt
                </th>
                <th>
                    Tên Khoa học
                </th>
                <th>
                    Mô tả
                </th>
                <th>
                    Đặc điểm sinh thái
                </th>
                <th>
                    Tình trạng bảo tồn theo sách đỏ Việt Nam
                </th>
                <th>
                    Tình trạng bảo tồn theo ICUN
                </th>
                <th>
                    Sinh cảnh
                </th>
                <th>
                    Địa điểm
                </th>
                <th>
                    Phân bố
                </th>
                <th>
                    Thao tác
                </th>
            </tr>

            <?php
            //Table dongvat: ma_dv,ten_dv,ten_eng,mota,dacdiem,ma_bt_sachdovn,ma_bt_iucn,sinhcanh,diadiem,ma_gioi,ma_nganh,ma_lop,ma_ho,ma_bo
            $delete_render_query = $mysqli->query("select * from dongvat,themdongvat where dongvat.ma_dv=themdongvat.ma_dv;");
            
            if (mysqli_num_rows($delete_render_query)!=0) {
                while ($delete_render=$delete_render_query->fetch_array()) {
                    //Get image
                    $sql_image = "select ten_image from hinhanh where ma_dv='".$delete_render['ma_dv']."' limit 1;";
                    $image_result = $mysqli->query($sql_image);
                    
                    if (mysqli_num_rows($image_result)==0) {
                        $image_name = "add.png";
                    } else {
                        $image_result_array = $image_result->fetch_array();
                        $image_name = "animals/".$image_result_array['ten_image'];
                    }

                    //Get tinh trang bao ton
                    $sql_bt_sachdovn = "select ten_bt_sachdovn from baoton_sachdovn where ma_bt_sachdovn='".$delete_render['ma_bt_sachdovn']."';";
                    $bt_sachdovn_result = $mysqli->query($sql_bt_sachdovn);

                    if (mysqli_num_rows($bt_sachdovn_result)==0) {
                        $bt_sachdovn_name = "Chưa cập nhật..";
                    } else {
                        $bt_sachdovn_result_array = $bt_sachdovn_result->fetch_array();
                        $bt_sachdovn_name = $bt_sachdovn_result_array[0];
                    }

                    $sql_bt_iucn = "select ten_bt_iucn from baoton_iucn where ma_bt_iucn='".$delete_render['ma_bt_iucn']."';";
                    $bt_iucn_result = $mysqli->query($sql_bt_iucn);

                    if (mysqli_num_rows($bt_iucn_result)==0) {
                        $bt_iucn_name = "Chưa cập nhật..";
                    } else {
                        $bt_iucn_result_array = $bt_iucn_result->fetch_array();
                        $bt_iucn_name = $bt_iucn_result_array[0];
                    }
                    
                    //Get phanvo
                    $sql_phanbo = "select noiphanbo from phanbo where ma_dv='".$delete_render['ma_dv']."';";
                    $phanbo_result = $mysqli->query($sql_phanbo);

                    if (mysqli_num_rows($phanbo_result)==0) {
                        $str_phanbo = "Chưa cập nhật..";
                    } else {
                        $phanbo_result_array = $phanbo_result->fetch_array();
                        $str_phanbo = $phanbo_result_array[0];
                    }

                    //Phan giup noi dung hien thi ngan hon
                    //Set name
                    $str_ten_dv         = $delete_render['ten_dv'];
                    $str_ten_eng        = $delete_render['ten_eng'];
                    $str_mota           = $delete_render['mota'];
                    $str_dacdiem        = $delete_render['dacdiem'];
                    $str_bt_sachdovn = $bt_sachdovn_name;
                    $str_bt_iucn     = $bt_iucn_name;
                    $str_sinhcanh       = $delete_render['sinhcanh'];
                    $str_diadiem        = $delete_render['diadiem'];
                    $MA_DV = $delete_render['ma_dv'];

                    // strip tags to avoid breaking any html
                    //$string = strip_tags($string);
                    $str_ten_dv         = strip_tags($str_ten_dv);
                    $str_ten_eng        = strip_tags($str_ten_eng);
                    $str_mota           = strip_tags($str_mota);
                    $str_dacdiem        = strip_tags($str_dacdiem);
                    $str_bt_sachdovn    = strip_tags($str_bt_sachdovn);
                    $str_bt_iucn        = strip_tags($str_bt_iucn);
                    $str_sinhcanh       = strip_tags($str_sinhcanh);
                    $str_diadiem        = strip_tags($str_diadiem);
                    $str_phanbo         = strip_tags($str_phanbo);


                    if (strlen($str_mota) > 200) {
                        // truncate string
                        $stringCut = substr($str_mota, 0, 200); $endPoint = strrpos($stringCut, ' ');

                        //if the string doesn't contain any space then it will cut without word basis.
                        $str_mota = $endPoint ? substr($stringCut, 0, $endPoint) : substr($stringCut, 0);
                        $str_mota .= '... <a href="?route=chitiet&id='.$MA_DV.'">Read More</a>';
                    }
                    if (strlen($str_dacdiem) > 200) {
                        $stringCut = substr($str_dacdiem, 0, 200); $endPoint = strrpos($stringCut, ' ');
                        $str_dacdiem = $endPoint ? substr($stringCut, 0, $endPoint) : substr($stringCut, 0);
                        $str_dacdiem .= '... <a href="?route=chitiet&id='.$MA_DV.'">Read More</a>';
                    }
                    if (strlen($str_phanbo) > 200) {
                        $stringCut = substr($str_phanbo, 0, 200); $endPoint = strrpos($stringCut, ' ');
                        $str_phanbo = $endPoint ? substr($stringCut, 0, $endPoint) : substr($stringCut, 0);
                        $str_phanbo .= '... <a href="?route=chitiet&id='.$MA_DV.'">Read More</a>';
                    }

                    echo "<tr>
                    <td>
                        <a href=\"?route=chitiet&id=$MA_DV\"><img src='./img/$image_name' alt='' style='width: 50px; height: 50px'></a>
                    </td>
                    <td>
                        $str_ten_dv
                    </td>
                    <td>
                        $str_ten_eng
                    </td>
                    <td>
                        $str_mota
                    </td>
                    <td>
                        $str_dacdiem
                    </td>
                    <td>
                        $str_bt_sachdovn
                    </td>
                    <td>
                        $str_bt_iucn
                    </td>
                    <td>
                        $str_sinhcanh
                    </td>
                    <td>
                        $str_diadiem
                    </td>
                    <td>
                        $str_phanbo
                    </td>
                    <td>    
                        <a href='?route=suathongtin&id=$MA_DV' target='_blank;'><button>Sửa</button></a>
                        <br><br>
                        <form method='POST' onSubmit=\"if(!confirm('Xác nhận xóa thông tin động vật?')){return false;}\">
                            <input type='hidden' name='xoa_MA_DV' value='$MA_DV'>
                            <input type='hidden' name='xoa_TEN_DV' value='$str_ten_dv'>
                            <button type='submit'>Xóa</button>
                        </form>
                    </td>
                </tr>";
                }
            }
            ?>
        </table>
    </div>
</div>

<!-- Loại bỏ xác nhận gửi lại biểu mẫu -->
<script>
    if (window.history.replaceState) {
        window.history.replaceState(null, null, window.location.href);
    }
</script>