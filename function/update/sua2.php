<?php
    $chitiet_dv = $mysqli->query("select * from dongvat,hinhanh where dongvat.ma_dv=hinhanh.ma_dvdongvat.ma_dv='$_GET[id]' limit 1")->fetch_array();
?>
<form action="function/add/action_them.php" method="POST" enctype="multipart/form-data">
    <div class="container-fluid p-4">
        <div class="row">
            <div class="col-4">
                    <label for="file-input_1">
                        <img id="review_1" class="anhconvat" src="./img/add.png" alt="">
                    </label>
                    <input id="file-input_1" name="hinh_anh_1" type="file" accept="image/*" onchange="loadFile_1(event)" style="display: none;"/>
                </div>
                <div class="d-flex flex-wrap justify-content-around anhnho" style="background-color: #CDEDED; margin:10px 10px 0 10px; padding:10px;
                ">
                    <label for="file-input_2">
                        <img id="review_2" src="./img/add.png" alt="">
                    </label>
                    <input id="file-input_2" name="hinh_anh_2" type="file" accept="image/*" onchange="loadFile_2(event)" style="display: none;"/>

                    <label for="file-input_3">
                        <img id="review_3" src="./img/add.png" alt="">
                    </label>
                    <input id="file-input_3" name="hinh_anh_3" type="file" accept="image/*" onchange="loadFile_3(event)" style="display: none;"/>

                    <label for="file-input_4">
                        <img id="review_4" src="./img/add.png" alt="">
                    </label>
                    <input id="file-input_4" name="hinh_anh_4" type="file" accept="image/*" onchange="loadFile_4(event)" style="display: none;"/>
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
                    var loadFile_4 = function(event) {
                        var review_4 = document.getElementById('review_4');
                        review_4.src = URL.createObjectURL(event.target.files[0]);
                        review_4.onload = function() {
                        URL.revokeObjectURL(review_4.src) // free memory
                        }
                    };
                </script>
                
                
                <!-- <div id="drag-drop-area"></div> 
                <script>
                    var uppy = Uppy.Core()
                        .use(Uppy.Dashboard, {
                        inline: true,
                        target: '#drag-drop-area'
                        })
                        .use(Uppy.Tus, {endpoint: 'https://master.tus.io/files/'}) //you can put upload URL here, where you want to upload images

                    uppy.on('complete', (result) => {
                        console.log('Upload complete! We’ve uploaded these files:', result.successful)
                    })
                </script> -->
            </div>
            <div class="col-5" style="padding: 20px; background-color: #CDEDED; margin-top: 20px; border-radius: 5px;">
                <h4 class="dacdiem">
                    <b>
                        Tên Tiếng Việt
                        <span><b style="color: red;">(*)</b></span>
                    </b>
                </h4>
                    <input type="text" class="form-control" name="ten_dv" placeholder="Nhập tên tiếng việt của loài...">
                    <br>
                <h4 class="dacdiem">
                    <b>
                        Tên khoa học
                        <span><b style="color: red;">(*)</b></span>
                    </b>
                </h4>
                    <input type="text" class="form-control" name="ten_eng" placeholder="Nhập tên khoa học của loài...">
                    <br>
                <h4 class="dacdiem">
                    <b>
                        Mô tả
                        <span><b style="color: red;">(*)</b></span>
                    </b>
                </h4>
                    <textarea class="form-control" name="mota" id="" cols="30" rows="10" placeholder="Nhập thông tin mô tả của loài..."></textarea>
                    <br>
                <h4 class="dacdiem">
                    <b>
                        Đặc điểm sinh thái
                        <span><b style="color: red;">(*)</b></span>
                    </b>
                </h4>
                    <textarea class="form-control" name="dacdiem" id="" cols="30" rows="7" placeholder="Nhập đặc điểm sinh thái của loài..."></textarea>
                    <br>
                <h4 class="dacdiem">
                    <b>
                        Tình trạng bảo tồn theo sách đỏ Việt Nam
                        <span><b style="color: red;">(*)</b></span>
                    </b>
                </h4>
                    <select name="bt_sachdovn" id="" class="cb">
                        <?php
                            if(!isset($_SESSION['ma_bt_sachdovn'])) {
                                $_SESSION['ma_bt_sachdovn']="";
                            }

                            //ma_bt_sachdovn,ten_bt_sachdovn
                            $bt_sachdovn_result = $mysqli->query("select * from baoton_sachdovn order by ma_bt_sachdovn desc");

                            $lua_chon="";

                            while($bt_sachdovn_result_array=$bt_sachdovn_result->fetch_array()) {
                                $ten_bt_sachdovn = $bt_sachdovn_result_array['ten_bt_sachdovn'];
                                $ma_bt_sachdovn = $bt_sachdovn_result_array['ma_bt_sachdovn'];

                                if($_SESSION['ma_bt_sachdovn']==$ma_bt_sachdovn) {
                                    $lua_chon = "selected";
                                }

                                echo "<option value='$ma_bt_sachdovn' $lua_chon>$ten_bt_sachdovn</option>";
                                $_SESSION['ma_bt_sachdovn'] = $ma_bt_sachdovn;
                                $lua_chon="";
                            }
                        ?>
                    </select>
                    <br>
                <h4 class="dacdiem">
                    <b>
                        Tình trạng bảo tồn IUCN
                        <span><b style="color: red;">(*)</b></span>
                    </b>
                </h4>
                    <select name="bt_iucn" id="" class="cb">
                        <?php
                            if(!isset($_SESSION['ma_bt_iucn'])) {
                                $_SESSION['ma_bt_iucn']="";
                            }

                            //ma_bt_iucn,ten_bt_iucn
                            $bt_iucn_result = $mysqli->query("select * from baoton_iucn order by ma_bt_iucn desc");

                            $lua_chon="";

                            while($bt_iucn_result_array=$bt_iucn_result->fetch_array()) {
                                $ten_bt_iucn = $bt_iucn_result_array['ten_bt_iucn'];
                                $ma_bt_iucn = $bt_iucn_result_array['ma_bt_iucn'];

                                if($_SESSION['ma_bt_iucn']==$ma_bt_iucn) {
                                    $lua_chon = "selected";
                                }

                                echo "<option value='$ma_bt_iucn' $lua_chon>$ten_bt_iucn</option>";
                                $_SESSION['ma_bt_iucn'] = $ma_bt_iucn;
                                $lua_chon="";
                            }
                        ?>
                    </select>
                    <br>
                <h4 class="dacdiem">
                    <b>
                        Sinh cảnh
                        <span><b style="color: red;">(*)</b></span>
                    </b>
                </h4>
                    <input type="text" class="form-control" name="sinhcanh" placeholder="Nhập sinh cảnh của loài...">
                    <br>
                <h4 class="dacdiem">
                    <b>
                        Địa điểm
                        <span><b style="color: red;">(*)</b></span>
                    </b>
                </h4>
                    <input type="text" class="form-control" name="diadiem" placeholder="Nhập địa điểm sống của loài...">
                    <br>
                <input type="submit" value="Thêm" style="border: none; width: 100%; background-color: #006089; color: white; padding: 7px;">
            </div>
            <div class="col-3" style="margin-top: 20px; padding-left: 30px;">
                <div class="table-responsive">
                    <table class="table table-boderless thongtinphanloai">
                        <tr>
                            <th>
                                Giới:<span><b style="color: red;">(*)</b></span> 
                            </th>
                            <td>
                                <select name="gioi" id="" class="cb">
                                    <?php
                                        if(!isset($_SESSION['ma_gioi'])) {
                                            $_SESSION['ma_gioi']="";
                                        }

                                        //ma_gioi,ten_gioi
                                        $gioi_result = $mysqli->query("select * from gioi order by ma_gioi");

                                        $lua_chon="";

                                        while($gioi_result_array=$gioi_result->fetch_array()) {
                                            $ten_gioi = $gioi_result_array['ten_gioi'];
                                            $ma_gioi = $gioi_result_array['ma_gioi'];

                                            if($_SESSION['ma_gioi']==$ma_gioi) {
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
                                        if(!isset($_SESSION['ma_nganh'])) {
                                            $_SESSION['ma_nganh']="";
                                        }

                                        //ma_nganh,ten_nganh
                                        $nganh_result = $mysqli->query("select * from nganh order by ma_nganh");

                                        $lua_chon="";

                                        while($nganh_result_array=$nganh_result->fetch_array()) {
                                            $ten_nganh = $nganh_result_array['ten_nganh'];
                                            $ma_nganh = $nganh_result_array['ma_nganh'];

                                            if($_SESSION['ma_nganh']==$ma_nganh) {
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
                                        if(!isset($_SESSION['ma_lop'])) {
                                            $_SESSION['ma_lop']="";
                                        }

                                        //ma_lop,ten_lop
                                        $lop_result = $mysqli->query("select * from lop order by ma_lop");

                                        $lua_chon="";

                                        while($lop_result_array=$lop_result->fetch_array()) {
                                            $ten_lop = $lop_result_array['ten_lop'];
                                            $ma_lop = $lop_result_array['ma_lop'];

                                            if($_SESSION['ma_lop']==$ma_lop) {
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
                                        if(!isset($_SESSION['ma_ho'])) {
                                            $_SESSION['ma_ho']="";
                                        }

                                        //ma_ho,ten_ho
                                        $ho_result = $mysqli->query("select * from ho order by ma_ho");

                                        $lua_chon="";

                                        while($ho_result_array=$ho_result->fetch_array()) {
                                            $ten_ho = $ho_result_array['ten_ho'];
                                            $ma_ho = $ho_result_array['ma_ho'];

                                            if($_SESSION['ma_ho']==$ma_ho) {
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
                                        if(!isset($_SESSION['ma_bo'])) {
                                            $_SESSION['ma_bo']="";
                                        }

                                        //ma_bo,ten_bo
                                        $bo_result = $mysqli->query("select * from bo order by ma_bo");

                                        $lua_chon="";

                                        while($bo_result_array=$bo_result->fetch_array()) {
                                            $ten_bo = $bo_result_array['ten_bo'];
                                            $ma_bo = $bo_result_array['ma_bo'];

                                            if($_SESSION['ma_bo']==$ma_bo) {
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
                <h2 class="dacdiem" style="margin-top: 20px;">
                    <b>Phân bố</b><span><b style="color: red;">(*)</b></span>
                </h2>
                <div>
                    <img src="./img/bando.png" alt="" class="bando">
                </div>
                <div>
                    <br>
                    <input type="text" class="form-control" name="phanbo" placeholder="Hoặc nhập tọa độ">
                    <br>
                    <div class="text-end">
                        <button class="btn text-white btn-info" style="border: none; background-color: #006089;">
                            Chọn
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>