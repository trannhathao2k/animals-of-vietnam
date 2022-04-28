<?php
    $_SESSION['ma_dv_sua'] = $ma_dv = $_GET["id"];
    
    $chitiet_dv = $mysqli->query("select * from dongvat where ma_dv='$ma_dv' limit 1");
    $chitiet_dv_result = $chitiet_dv->fetch_array();
    
    //Lấy ảnh
    $get_ten_image = $mysqli->query("select ten_image from hinhanh where ma_dv='$ma_dv';");

    $count_image = mysqli_num_rows($get_ten_image);            

    switch ($count_image) {
        case 1: {
            $i = 1;
            while ($array_ten_image = $get_ten_image->fetch_array()) {
                ${"ten_image_$i"} = "animals/".$array_ten_image[0];
                $i++;
            }

            $ten_image_2 = "add.png";
            $ten_image_3 = "add.png";
            break;
        }
        case 2: {
            $i = 1;
            while ($array_ten_image = $get_ten_image->fetch_array()) {
                ${"ten_image_$i"} = "animals/".$array_ten_image[0];
                $i++;
            }
            
            $ten_image_3 = "add.png";
            break;
        }
        case 3: {
            $i = 1;
            while ($array_ten_image = $get_ten_image->fetch_array()) {
                ${"ten_image_$i"} = "animals/".$array_ten_image[0];
                $i++;
            }
            break;
        }

        default: {
            $ten_image_1 = "add.png";
            $ten_image_2 = "add.png";
            $ten_image_3 = "add.png";
        }
    }
    //

    if (isset($_SESSION['no_reload'])) unset($_SESSION['no_reload']);
    else {
        //Đưa các tọa độ vào bảng temp
        $sqlGetToaDo = $mysqli->query("select * from toado where ma_dv='$ma_dv'");

        if (mysqli_num_rows($sqlGetToaDo)!=0) {
            //làm sạch temp trước
            $mysqli->query("delete from temp;");

            while ($getToaDoArr=$sqlGetToaDo->fetch_array()) {
                $toaDo = $getToaDoArr['ten_toado'];
                $mysqli->query("insert into temp value(null,'$toaDo')");
            }
            
        }
    }
    

?>

<form action="function/update/action_sua.php" method="POST" enctype="multipart/form-data">

    <div class="row" style="width: 100%">

        <div class="col-sm-1"></div>
        <div class="col-7" style="padding: 20px; background-color: #CDEDED; margin-top: 20px;margin-bottom: 20px; border-radius: 5px;">
            <h4 class="dacdiem">
                <b>
                    Tên Tiếng Việt
                    <span><b style="color: red;">(*)</b></span>
                </b>
            </h4>
            <input type="text" class="form-control" name="ten_dv" value="<?php echo $chitiet_dv_result['ten_dv']; ?>">
            <br>
            <h4 class="dacdiem">
                <b>
                    Tên khoa học
                    <span><b style="color: red;">(*)</b></span>
                </b>
            </h4>
            <input type="text" class="form-control" name="ten_eng" value="<?php echo $chitiet_dv_result['ten_eng']; ?>">
            <br>
            <h4 class="dacdiem">
                <b>
                    Mô tả
                    <span><b style="color: red;">(*)</b></span>
                </b>
            </h4>
            <textarea class="form-control" name="mota" id="" cols="30" rows="10"><?php echo $chitiet_dv_result['mota']; ?></textarea>
            <br>
            <h4 class="dacdiem">
                <b>
                    Đặc điểm sinh thái
                    <span><b style="color: red;">(*)</b></span>
                </b>
            </h4>
            <textarea class="form-control" name="dacdiem" id="" cols="30" rows="7"><?php echo $chitiet_dv_result['dacdiem']; ?></textarea>
            <br>
            <h4 class="dacdiem">
                <b>
                    Tình trạng bảo tồn theo sách đỏ Việt Nam
                    <span><b style="color: red;">(*)</b></span>
                </b>
            </h4>
            <select name="bt_sachdovn" id="" class="cb">
                <?php
                    //ma_bt_sachdovn,ten_bt_sachdovn
                    $bt_sachdovn_result = $mysqli->query("select * from baoton_sachdovn order by ma_bt_sachdovn desc");

                    $ma_bt_sachdovn_selected = $chitiet_dv_result['ma_bt_sachdovn'];

                    $lua_chon="";

                    while($bt_sachdovn_result_array=$bt_sachdovn_result->fetch_array()) {
                        $ten_bt_sachdovn = $bt_sachdovn_result_array['ten_bt_sachdovn'];
                        $ma_bt_sachdovn = $bt_sachdovn_result_array['ma_bt_sachdovn'];

                        if($ma_bt_sachdovn==$ma_bt_sachdovn_selected) {
                            $lua_chon = "selected";
                        }

                        echo "<option value='$ma_bt_sachdovn' $lua_chon>$ten_bt_sachdovn</option>";
                        $_SESSION['ma_bt_sachdovn'] = $ma_bt_sachdovn;
                        $lua_chon="";
                    }
                ?>
            </select>
            <br>
            <h4 class="dacdiem" style="margin-top: 20px;">
                <b>
                    Tình trạng bảo tồn IUCN
                    <span><b style="color: red;">(*)</b></span>
                </b>
            </h4>
            <select name="bt_iucn" id="" class="cb">
                <?php
                    //ma_bt_iucn,ten_bt_iucn
                    $bt_iucn_result = $mysqli->query("select * from baoton_iucn order by ma_bt_iucn desc");

                    $ma_bt_iucn_selected = $chitiet_dv_result['ma_bt_iucn'];
                    $lua_chon="";

                    while($bt_iucn_result_array=$bt_iucn_result->fetch_array()) {
                        $ten_bt_iucn = $bt_iucn_result_array['ten_bt_iucn'];
                        $ma_bt_iucn = $bt_iucn_result_array['ma_bt_iucn'];

                        if($ma_bt_iucn==$ma_bt_iucn_selected) {
                            $lua_chon = "selected";
                        }

                        echo "<option value='$ma_bt_iucn' $lua_chon>$ten_bt_iucn</option>";
                        $_SESSION['ma_bt_iucn'] = $ma_bt_iucn;
                        $lua_chon="";
                    }
                ?>
            </select>
            <br>
            <h4 class="dacdiem" style="margin-top: 20px;">
                <b>
                    Sinh cảnh
                    <span><b style="color: red;">(*)</b></span>
                </b>
            </h4>
            <input type="text" class="form-control" name="sinhcanh" value="<?php echo $chitiet_dv_result['sinhcanh']; ?>">
            <br>
            <h4 class="dacdiem">
                <b>
                    Địa điểm
                    <span><b style="color: red;">(*)</b></span>
                </b>
            </h4>
            <input type="text" class="form-control" name="diadiem" value="<?php echo $chitiet_dv_result['diadiem']; ?>">
            <br>
            <input type="submit" name="Sua_dv" value="Sửa" style="border: none; width: 100%; background-color: #006089; color: white; padding: 7px;">
        </div>
        <div class="col-3" style="margin-top: 20px">
            
            <div style="margin-left: 10px;">
                <div class="d-flex flex-wrap justify-content-around anhnho" style="background-color: #CDEDED; padding:10px;
                ">
                    <label for="file-input_1">
                        <img id="review_1" src="./img/<?php echo $ten_image_1; ?>" alt="">
                    </label>
                    <input id="file-input_1" name="hinh_anh_1" type="file" accept="image/*" onchange="loadFile_1(event)" style="display: none;" />
                    <input type="hidden" name="old_image_1" value="<?php echo $ten_image_1; ?>">

                    <label for="file-input_2">
                        <img id="review_2" src="./img/<?php echo $ten_image_2; ?>" alt="">
                    </label>
                    <input id="file-input_2" name="hinh_anh_2" type="file" accept="image/*" onchange="loadFile_2(event)" style="display: none;" />
                    <input type="hidden" name="old_image_2" value="<?php echo $ten_image_2; ?>">

                    <label for="file-input_3">
                        <img id="review_3" src="./img/<?php echo $ten_image_3; ?>" alt="">
                    </label>
                    <input id="file-input_3" name="hinh_anh_3" type="file" accept="image/*" onchange="loadFile_3(event)" style="display: none;" />
                    <input type="hidden" name="old_image_3" value="<?php echo $ten_image_3; ?>">
                </div>

            <!-- Giup review anh tai len -->
                <script>
                    var loadFile_1 = function(event) {
                        var review_1 = document.getElementById('review_1');
                        review_1.src = URL.createObjectURL(event.target.files[0]);
                        review_1.onload = function() {
                            URL.revokeObjectURL(review_1.src) // free memory
                        }
                    };

                    var loadFile_2 = function(event) {
                        var review_2 = document.getElementById('review_2');
                        review_2.src = URL.createObjectURL(event.target.files[0]);
                        review_2.onload = function() {
                            URL.revokeObjectURL(review_2.src) // free memory
                        }
                    };
                    var loadFile_3 = function(event) {
                        var review_3 = document.getElementById('review_3');
                        review_3.src = URL.createObjectURL(event.target.files[0]);
                        review_3.onload = function() {
                            URL.revokeObjectURL(review_3.src) // free memory
                        }
                    };
                </script>
            </div>
            
            <div style="margin: 20px 0 0 10px">
                <div class="table-responsive">
                    <table class="table table-boderless thongtinphanloai">
                        <tr>
                            <th>
                                Giới:<span><b style="color: red;">(*)</b></span>
                            </th>
                            <td>
                                <select name="gioi" id="" class="cb">
                                    <?php
                                        //ma_gioi,ten_gioi
                                        $gioi_result = $mysqli->query("select * from gioi order by ma_gioi");

                                        $ma_gioi_selected = $chitiet_dv_result['ma_gioi'];
                                        $lua_chon="";

                                        while($gioi_result_array=$gioi_result->fetch_array()) {
                                            $ten_gioi = $gioi_result_array['ten_gioi'];
                                            $ma_gioi = $gioi_result_array['ma_gioi'];

                                            if($ma_gioi==$ma_gioi_selected) {
                                                $lua_chon = "selected";
                                            }

                                            echo "<option value='$ma_gioi' $lua_chon>$ten_gioi</option>";
                                            $_SESSION['ma_gioi'] = $ma_gioi;
                                            $lua_chon="";
                                        }
                                    ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <th>
                                Ngành:<span><b style="color: red;">(*)</b></span>
                            </th>
                            <td>
                                <select name="nganh" id="" class="cb">
                                    <?php
                                        //ma_nganh,ten_nganh
                                        $nganh_result = $mysqli->query("select * from nganh order by ma_nganh");

                                        $ma_nganh_selected = $chitiet_dv_result['ma_nganh'];
                                        $lua_chon="";

                                        while($nganh_result_array=$nganh_result->fetch_array()) {
                                            $ten_nganh = $nganh_result_array['ten_nganh'];
                                            $ma_nganh = $nganh_result_array['ma_nganh'];

                                            if($ma_nganh==$ma_nganh_selected) {
                                                $lua_chon = "selected";
                                            }

                                            echo "<option value='$ma_nganh' $lua_chon>$ten_nganh</option>";
                                            $_SESSION['ma_nganh'] = $ma_nganh;
                                            $lua_chon="";
                                        }
                                    ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <th>
                                Lớp:<span><b style="color: red;">(*)</b></span>
                            </th>
                            <td>
                                <select name="lop" id="" class="cb">
                                    <?php
                                        //ma_lop,ten_lop
                                        $lop_result = $mysqli->query("select * from lop order by ma_lop");

                                        $ma_lop_selected = $chitiet_dv_result['ma_lop'];
                                        $lua_chon="";

                                        while($lop_result_array=$lop_result->fetch_array()) {
                                            $ten_lop = $lop_result_array['ten_lop'];
                                            $ma_lop = $lop_result_array['ma_lop'];

                                            if($ma_lop==$ma_lop_selected) {
                                                $lua_chon = "selected";
                                            }

                                            echo "<option value='$ma_lop' $lua_chon>$ten_lop</option>";
                                            $_SESSION['ma_lop'] = $ma_lop;
                                            $lua_chon="";
                                        }
                                    ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <th>
                                Họ:<span><b style="color: red;">(*)</b></span>
                            </th>
                            <td>
                                <select name="ho" id="" class="cb">
                                    <?php
                                        //ma_ho,ten_ho
                                        $ho_result = $mysqli->query("select * from ho order by ma_ho");

                                        $ma_ho_selected = $chitiet_dv_result['ma_ho'];
                                        $lua_chon="";

                                        while($ho_result_array=$ho_result->fetch_array()) {
                                            $ten_ho = $ho_result_array['ten_ho'];
                                            $ma_ho = $ho_result_array['ma_ho'];

                                            if($ma_ho==$ma_ho_selected) {
                                                $lua_chon = "selected";
                                            }

                                            echo "<option value='$ma_ho' $lua_chon>$ten_ho</option>";
                                            $_SESSION['ma_ho'] = $ma_ho;
                                            $lua_chon="";
                                        }
                                    ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <th>
                                Bộ:<span><b style="color: red;">(*)</b></span>
                            </th>
                            <td>
                                <select name="bo" id="" class="cb">
                                    <?php
                                        //ma_bo,ten_bo
                                        $bo_result = $mysqli->query("select * from bo order by ma_bo");

                                        $ma_bo_selected = $chitiet_dv_result['ma_bo'];
                                        $lua_chon="";

                                        while($bo_result_array=$bo_result->fetch_array()) {
                                            $ten_bo = $bo_result_array['ten_bo'];
                                            $ma_bo = $bo_result_array['ma_bo'];

                                            if($ma_bo=$ma_bo_selected) {
                                                $lua_chon = "selected";
                                            }

                                            echo "<option value='$ma_bo' $lua_chon>$ten_bo</option>";
                                            $_SESSION['ma_bo'] = $ma_bo;
                                            $lua_chon="";
                                        }
                                    ?>
                                </select>
                            </td>
                        </tr>
                    </table>
                </div>

                    <!-- render map -->
                    <h2 class="dacdiem" style="margin-top: 20px;">
                        <b>Phân bố</b><span><b style="color: red;">(*)</b></span>
                    </h2>
                    <div>
                        <?php
                            //Tính toán số dữ liệu để hiển thị theo trang
                            $numOfData = 1; //Số dữ liệu hiển thị trong 1 trang
                            $sql = "select count(*) from temp";
                            $sql_1 = $mysqli->query($sql)->fetch_array();
                            $numOfPages = ceil( $sql_1[0] / $numOfData );

                            if( !isset($_GET['page']) ) {
                                //Vị trí bắt đầu
                                $vtbd = 0;
                            }
                            else {
                                $vtbd = ($_GET['page']-1) * $numOfData;
                            }

                            $sql_td = "SELECT * FROM temp order by ma_temp asc
                            limit $vtbd,$numOfData";
                            $queue_td = mysqli_query($mysqli, $sql_td);
                            $row_td = mysqli_fetch_array($queue_td);
                        ?>

                        <?php
                            if ($numOfPages != 0) {
                                echo $row_td['ten_temp'];
                            }
                            else {
                                echo "";
                            }
                        ?>
                    </div>
                    <div style="text-align:center">
                        <div style="display: inline-block;">
                            <ul class="pagination">
                                <?php
                                    for($i=1; $i<=$numOfPages; $i++) {
                                        $link = $_SERVER['REQUEST_URI']."&page=".$i;
                                        echo "<li class='page-item active'>
                                            <a class='page-link' href='$link'>$i</a>
                                        </li>";
                                    }
                                ?>
                            </ul>
                        </div>                    
                    </div>
                    </form>
                    
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <tr>
                                <th>Thao tác</th>
                                <th>Page</th>
                            </tr>                            
                                <?php
                                    $i = 1;
                                    $sql_toado = "SELECT * FROM temp";
                                    $queue_toado = mysqli_query($mysqli, $sql_toado);
                                    while($row_toado = mysqli_fetch_array($queue_toado)){
                                        ?>
                                        <tr>
                                            <td>
                                                <form method="POST" action="function/add/action_xoa_toado.php">
                                                    <input type="hidden" name="xoa_toado" value="<?php echo $row_toado['ma_temp']; ?>">
                                                    <button type="submit" class="btn-danger">Xóa</button>
                                                </form>
                                            </td>
                                            <td>
                                                <?php
                                                    echo $i;
                                                    $i++;
                                                ?>
                                            </td>
                                        </tr>
                                        <?php
                                    }
                                ?>                            
                        </table>
                    </div>
                    <br>
                    <form action="function/add/action_them_toado.php" method="POST">                            
                        <input type="text" class="form-control" name="toado" placeholder="Nhập tọa độ cần thêm">
                        <div class="text-end" style="margin-top: 5px;">
                            <input type="hidden" name="stt" value="<?php echo $i; ?>">
                            <button class="btn text-white btn-info" style="border: none; background-color: #006089;">
                                Thêm tọa độ
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
        <div class="col-sm-1"></div>
    </div>

<!-- Loại bỏ xác nhận gửi lại biểu mẫu -->
<script>
    if (window.history.replaceState) {
        window.history.replaceState(null, null, window.location.href);
    }
</script>