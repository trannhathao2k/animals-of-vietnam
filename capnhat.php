<style>
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
</style>


<?php
    if (isset($_POST['xoa_MA_DV']) and isset($_POST['xoa_TEN_DV'])) {
        //echo "xác nhận xóa".."?";

        echo "<div class='alert'>
            <span class='closebtn' onclick='this.parentElement.style.display='none';'>&times;</span> 
            <div><strong>Lưu ý!</strong> Xác nhận xóa thông tin của ".$_POST['xoa_TEN_DV']."?</div>

            
        </div>";
        unset($_POST['xoa_MA_DV']); unset($_POST['xoa_TEN_DV']);        
    }
?>
<!-- <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Xóa cá thể</title>
    <link rel="stylesheet" href="./bootstrap/css/bootstrap.min.css">
    <script src="./bootstrap/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="./fontawesome/css/all.min.css">
    <link rel="stylesheet" href="./main.css">
</head>

<body>
    <div class="container-fluid root">
        <div class="header container-fluid">
            <a href="" class="text-decoration-none text-white link">My observation</a>
            <img id="logo" src="./img/logo.png" alt="Logo">
            <img id="thuonghieu" src="./img/thuonghieu.png" alt="Thương hiệu">&#160;&#160;
        </div>
         -->
        <div style="padding: 40px;background-color: #CDEDED;">
            <div class="table-responsive" style="overflow-x:auto;">
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
                    $delete_render_query = $mysqli->query("select * from dongvat;");
                    
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
                            $str_ma_bt_sachdovn = $delete_render['ma_bt_sachdovn'];
                            $str_ma_bt_iucn     = $delete_render['ma_bt_iucn'];
                            $str_sinhcanh       = $delete_render['sinhcanh'];
                            $str_diadiem        = $delete_render['diadiem'];
                            $MA_DV = $delete_render['ma_dv'];

                            // strip tags to avoid breaking any html
                            //$string = strip_tags($string);
                            $str_ten_dv         = strip_tags($str_ten_dv);
                            $str_ten_eng        = strip_tags($str_ten_eng);
                            $str_mota           = strip_tags($str_mota);
                            $str_dacdiem        = strip_tags($str_dacdiem);
                            $str_ma_bt_sachdovn = strip_tags($str_ma_bt_sachdovn);
                            $str_ma_bt_iucn     = strip_tags($str_ma_bt_iucn);
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
                                <img src='./img/$image_name' alt='' style='width: 50px; height: 50px'>
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
                                $str_ma_bt_sachdovn
                            </td>
                            <td>
                                $str_ma_bt_iucn
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
                                <a href='?route=suathongtin' target='_blank;'><button>Sửa</button></a>
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

        <!-- <div class="footer">
            Đây là Footers
        </div>
    </div>
</body>

</html> -->

<!-- Loại bỏ xác nhận gửi lại biểu mẫu -->
<script>
    if (window.history.replaceState) {
        window.history.replaceState(null, null, window.location.href);
    }
</script>