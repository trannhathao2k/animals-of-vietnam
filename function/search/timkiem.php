

<div class="" style="padding: 40px;">
    <div class="row">
        <div class="col-3" style="padding-left: 40px;">
            <h3 class="dacdiem">
                Lọc kết quả
            </h3>

            <h5 style="margin-top: 40px; color: #1E90FF">Giới</h5>
            <select name="" class="cb" onchange="showHintGioi(this.value)">
                <option value="all">Tất cả</option>
                <?php
                    $sql_gioi = "SELECT * FROM gioi";
                    $queue_gioi = mysqli_query( $mysqli, $sql_gioi);
                    while ($row_gioi = mysqli_fetch_array($queue_gioi)) {
                        ?>
                        <option value="<?php echo $row_gioi['ma_gioi'] ?>"><?php echo $row_gioi['ten_gioi'] ?></option>
                        <?php
                    }
                ?>
            </select>
            <script>
                function showHintGioi(value) {

                    var xmlhttp = new XMLHttpRequest();
                    xmlhttp.onreadystatechange = function() {
                        if (this.readyState == 4 && this.status == 200) {
                            document.getElementById("kq-gioi").innerHTML =(this.responseText); //=>kết quả trả về thêm vào element này, có html vẫn hiện được
                        }
                    };
                    xmlhttp.open("GET", "getdata_gioi.php?gioi=" + value, true);
                    xmlhttp.send();
                }
            </script>

            <h5 style="margin-top: 20px; color: #1E90FF">Ngành</h5>
            <select name="" class="cb" onchange="showHintNganh(this.value)">
                <option value="all">Tất cả</option>
                <?php
                    $sql_nganh = "SELECT * FROM nganh";
                    $queue_nganh = mysqli_query( $mysqli, $sql_nganh);
                    while ($row_nganh = mysqli_fetch_array($queue_nganh)) {
                        ?>
                        <option value="<?php echo $row_nganh['ma_nganh'] ?>"><?php echo $row_nganh['ten_nganh'] ?></option>
                        <?php
                    }
                ?>
            </select>
            <script>
                function showHintNganh(value) {

                    var xmlhttp = new XMLHttpRequest();
                    xmlhttp.onreadystatechange = function() {
                        if (this.readyState == 4 && this.status == 200) {
                            document.getElementById("kq-nganh").innerHTML =(this.responseText); //=>kết quả trả về thêm vào element này, có html vẫn hiện được
                        }
                    };
                    xmlhttp.open("GET", "getdata_nganh.php?nganh=" + value, true);
                    xmlhttp.send();
                }
            </script>

            <h5 style="margin-top: 20px; color: #1E90FF">Lớp</h5>
            <select name="" class="cb" onchange="showHintLop(this.value)">
                <option value="all">Tất cả</option>
                <?php
                    $sql_lop = "SELECT * FROM lop";
                    $queue_lop = mysqli_query( $mysqli, $sql_lop);
                    while ($row_lop = mysqli_fetch_array($queue_lop)) {
                        ?>
                        <option value="<?php echo $row_lop['ma_lop'] ?>"><?php echo $row_lop['ten_lop'] ?></option>
                        <?php
                    }
                ?>
            </select>

            <h5 style="margin-top: 20px; color: #1E90FF">Bộ</h5>
            <select name="" class="cb" onchange="showHintBo(this.value)">
                <option value="all">Tất cả</option>
                <?php
                    $sql_bo = "SELECT * FROM bo";
                    $queue_bo = mysqli_query( $mysqli, $sql_bo);
                    while ($row_bo = mysqli_fetch_array($queue_bo)) {
                        ?>
                        <option value="<?php echo $row_bo['ma_bo'] ?>"><?php echo $row_bo['ten_bo'] ?></option>
                        <?php
                    }
                ?>
            </select>

            <h5 style="margin-top: 20px; color: #1E90FF">Họ</h5>
            <select name="" class="cb">
                <option value="all">Tất cả</option>
                <?php
                    $sql_ho = "SELECT * FROM ho";
                    $queue_ho = mysqli_query( $mysqli, $sql_ho);
                    while ($row_ho = mysqli_fetch_array($queue_ho)) {
                        ?>
                        <option value="<?php echo $row_ho['ma_ho'] ?>"><?php echo $row_ho['ten_ho'] ?></option>
                        <?php
                    }
                ?>
            </select>



        <!-- Result -->
        <?php
            if (trim($_GET['keyword'])!="") {
                $m = explode(" ",$_GET['keyword']); 
                $search_str = "";

                for($i=0; $i<count($m); $i++) {
                    $word = trim($m[$i]);
                    if($word!="") {
                        $search_str = $search_str." ten_dv like '%".$word."%' or ten_eng like '%".$word."%' or";
                    }
                }

                //$search_str sẽ thừa 'or' ở cuối, nên ta ghép lại chuỗi và bỏ từ cuối (là từ 'or' bị thừa)
                $m_2 = explode(" ",$search_str);
                $search_str_2 = "";
                
                //count($m_2)-1 --> bỏ từ "or" ở cuối
                for($i=0; $i<count($m_2)-1; $i++) {
                    $search_str_2 = $search_str_2.$m_2[$i]." ";
                }

                /* Table dongvat: ma_dv,ten_dv,ten_eng,mota,dacdiem,ma_bt_sachdovn,ma_bt_iucn,
                    sinhcanh,diadiem,ma_gioi,ma_nganh,ma_lop,ma_ho,ma_bo */
                $sql_search = "select * from dongvat where $search_str_2";
                $search_result = $mysqli->query($sql_search);
            } else {
                $search_str_2 = "ten_dv ='@@@@'";  //Cho từ sai để ko tìm được

                /* Table dongvat: ma_dv,ten_dv,ten_eng,mota,dacdiem,ma_bt_sachdovn,ma_bt_iucn,
                    sinhcanh,diadiem,ma_gioi,ma_nganh,ma_lop,ma_ho,ma_bo */
                $sql_search = "select * from dongvat where $search_str_2";
                $search_result = $mysqli->query($sql_search);
        }
        ?>

        <div class="col-9" style="background-color: #CDEDED; border-radius: 5px; padding: 30px;">
            <h3 class="dacdiem">
                <b>
                    Kết quả tìm kiếm cho:
                </b>
                <i>
                    <b>
                        <?php echo $_GET['keyword']; echo "<br>"; 
                        //echo "SQL: ".$search_str_2; ?>
                    </b>
                </i>
            </h3>

            <b style="color: red;">
                <?php 
                    $count_result = $mysqli->query("select count(*) from dongvat where $search_str_2")->fetch_array();
                    if ($count_result[0]==0) {
                        echo "(Không tìm được kết quả phù hợp!)";
                    } else {
                        echo "(Tìm được ".$count_result[0]." kết quả)";
                    }
                ?>
            </b>
            <br>
            <div class="container-fluid d-flex justify-content-start flex-wrap align-item-start"
                style="padding: 20px;">

                <?php
                    if (mysqli_num_rows($search_result)!=0) {
                        while ($i = $search_result->fetch_array()) {
                            $sql_image = "select ten_image from hinhanh where ma_dv='".$i['ma_dv']."' limit 1;";
                            $image_result = $mysqli->query($sql_image);
    
                            if (mysqli_num_rows($image_result)==0) {
                                $image_name = "add.png";
                            }
                            else{
                                $image_result_array = $image_result->fetch_array();
                                $image_name = "animals/".$image_result_array['ten_image'];
                            }
    
                            echo "<div class='oitem1'>
                                    <a class='text-decoration-none' style='color: black;' href='?route=chitiet&id=".$i['ma_dv']."'>
                                        <img style='width: 110px; height: 95px' src='img/$image_name' alt=''>
                                        <div style='padding: 5px;'>
                                            <h6 style='font-size: 13px; text-align: center;'><b>".$i['ten_dv']."</b></h6>
                                        </div>
                                    </a>
                                </div>";
                        }
                    } 
                    
                ?>
            </div>
        </div>
    </div>
</div>


<!-- Xử lý checkbox chỉ chọn 1 -->
<script>
    $('input[type="checkbox"]').on('change', function() {
        $('input[name="' + this.name + '"]').not(this).prop('checked', false);
    });
</script>