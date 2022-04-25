
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
?>

<div class="container-fluid p4">
    <div style="padding: 20px; background-color: #CDEDED; margin: 20px 30px 20px 30px; border-radius: 5px;">
        <div class="row">
            <div class="col-sm-5 canhgiua">
                <img src="./img/116051595_116558240147817_8993678454444835442_n.jpg" alt="Ảnh đại diện"
                    class="img-thumbnail"
                    style="height: 300px; width: 300px;border: 4px;border-color: white;">
            </div>
            <div class="col-sm-7 thongtin">
                <div style="margin-left: 30px;">
                <?php
                    $ma_ctv = $_SESSION['tt_dangnhap']['ma_ctv'];
                    $sql_profile = "SELECT * FROM obvervation WHERE ma_ctv = '$ma_ctv'";
                    $query_profile = mysqli_query($mysqli, $sql_profile);
                    while($row_profile = mysqli_fetch_array($query_profile)){
                        ?>
                            <h1 class="tieude" style="margin-top: 20px;">
                                <?php
                                    echo $row_profile['hoten_ctv'];
                                ?>
                            </h1>
                            <br>
                            <p><b>Email:</b> <?php echo $row_profile['email_ctv'] ?></p>
                            <p><b>SDT:</b> <?php echo $row_profile['sdt'] ?></p>
                            <p>Đã thêm <b style="color: red"><?php
                                $sql_sodv = "SELECT count(ma_dv) sodv FROM themdongvat WHERE ma_ctv = '$ma_ctv'";
                                $query_sodv = mysqli_query($mysqli, $sql_sodv);
                                $row_sodv = mysqli_fetch_array($query_sodv);
                                echo $row_sodv['sodv'];
                            ?></b> loài động vật</p>
                        <?php
                    }
                ?>
                </div>
                
            </div>
        </div>
    </div>
</div>

<div style="padding: 40px; background-color: #FFFFFF;">
    <div class="table-responsive" style="overflow-x:auto;
    ">
        <div><a href='?route=themthongtin' target='_blank'><button type="button" class="btn btn-primary">Thêm thông tin động vật</button></a></div>
        <br>
        <div>
        <table class="table table-hover table-striped" style="border: 2px solid #000000;">
            <tr style="background-color: #47c1f5;text-align:center; color: #024461">
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
                    Thao tác
                </th>
            </tr>

            <?php
            $maCTV = $_SESSION['tt_dangnhap']['ma_ctv'];

            //Table dongvat: ma_dv,ten_dv,ten_eng,mota,dacdiem,ma_bt_sachdovn,ma_bt_iucn,sinhcanh,diadiem,ma_gioi,ma_nganh,ma_lop,ma_ho,ma_bo
            $delete_render_query = $mysqli->query("select * from dongvat,themdongvat where dongvat.ma_dv=themdongvat.ma_dv and themdongvat.ma_ctv='$maCTV';");
            
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
                    
                    /*Get phanvo
                    $sql_phanbo = "select noiphanbo from phanbo where ma_dv='".$delete_render['ma_dv']."';";
                    $phanbo_result = $mysqli->query($sql_phanbo);

                    if (mysqli_num_rows($phanbo_result)==0) {
                        $str_phanbo = "Chưa cập nhật..";
                    } else {
                        $phanbo_result_array = $phanbo_result->fetch_array();
                        $str_phanbo = $phanbo_result_array[0];
                    }*/

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
                    //$str_phanbo         = strip_tags($str_phanbo);


                    // if (strlen($str_mota) > 200) {
                    //     // truncate string
                    //     $stringCut = substr($str_mota, 0, 200); $endPoint = strrpos($stringCut, ' ');

                    //     //if the string doesn't contain any space then it will cut without word basis.
                    //     $str_mota = $endPoint ? substr($stringCut, 0, $endPoint) : substr($stringCut, 0);
                    //     $str_mota .= '... <a href="?route=chitiet&id='.$MA_DV.'">Read More</a>';
                    // }
                    // if (strlen($str_dacdiem) > 200) {
                    //     $stringCut = substr($str_dacdiem, 0, 200); $endPoint = strrpos($stringCut, ' ');
                    //     $str_dacdiem = $endPoint ? substr($stringCut, 0, $endPoint) : substr($stringCut, 0);
                    //     $str_dacdiem .= '... <a href="?route=chitiet&id='.$MA_DV.'">Read More</a>';
                    // }
                    // if (strlen($str_phanbo) > 200) {
                    //     $stringCut = substr($str_phanbo, 0, 200); $endPoint = strrpos($stringCut, ' ');
                    //     $str_phanbo = $endPoint ? substr($stringCut, 0, $endPoint) : substr($stringCut, 0);
                    //     $str_phanbo .= '... <a href="?route=chitiet&id='.$MA_DV.'">Read More</a>';
                    //}

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
                    <td style='font-size: smaller;'>
                        $str_mota
                    </td>
                    <td style='font-size: smaller;'>
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
                        <a href='?route=suathongtin&id=$MA_DV' target='_blank;'><button  class=\"btn btn-success\">Sửa</button></a>
                        <br><br>
                        <form method='POST' action='function/update/action_xoa.php' onSubmit=\"if(!confirm('Xác nhận xóa thông tin động vật?')){return false;}\">
                            <input type='hidden' name='xoa_MA_DV' value='$MA_DV'>
                            <input type='hidden' name='xoa_TEN_DV' value='$str_ten_dv'>
                            <button type='submit' class=\"btn btn-danger\">Xóa</button>
                        </form>
                    </td>
                </tr>";
                }
            }
            ?>
        </table>
        </div>
    </div>
</div>

<!-- Loại bỏ xác nhận gửi lại biểu mẫu -->
<script>
    if (window.history.replaceState) {
        window.history.replaceState(null, null, window.location.href);
    }
</script>