<div class="" style="padding: 40px;">
    <div class="row">
        <div class="col-3" style="padding-left: 40px;">
            <b class="dacdiem">
                Lọc kết quả
                <?php $extra_search_str = ""; ?>
            </b>
            <span>(Chọn 1 lựa chọn)</span>
            <br>
            <label >
                <input type="checkbox">
                    <b>Tất cả</b>
            </label>
            <br><hr>

            <b class="dacdiem">
                Theo giới
            </b>
            <br>
            <?php 
                //table gioi: ma_gioi,ten_gioi
                $sql_gioi = $mysqli->query("select * from gioi");
                
                while ($result_gioi=$sql_gioi->fetch_array()) {
                    echo "<label>
                            <input type='checkbox' name='theo_gioi[]'>
                                <b>". $result_gioi['ten_gioi'] ."</b>
                          </label>
                        <br>";
                ?>         
                    <!-- Script get checked values -->
                    <script>
                        if (document.getElementByName("theo_gioi[]").checked) {
                            <?php echo $result_gioi['ten_gioi']."checked"; ?>
                        }
                    </script>
                <?php
                }
            ?>
            <hr>

            <b class="dacdiem">
                Theo ngành
            </b>
            <br>
            <?php 
                //table nganh: ma_nganh,ten_nganh
                $sql_nganh = $mysqli->query("select * from nganh");
                
                while ($result_nganh=$sql_nganh->fetch_array()) {
                    echo "<label>
                            <input type='checkbox' name='theo_nganh[]'>
                                <b>". $result_nganh['ten_nganh'] ."</b>
                          </label>
                        <br>";
                }
            ?>
            <hr>

            <b class="dacdiem">
                Theo lớp
            </b>
            <br>
            <?php 
                //table lop: ma_lop,ten_lop
                $sql_lop = $mysqli->query("select * from lop");
                
                while ($result_lop=$sql_lop->fetch_array()) {
                    echo "<label>
                            <input type='checkbox' name='theo_lop[]'>
                                <b>". $result_lop['ten_lop'] ."</b>
                          </label>
                        <br>";
                }
            ?>
            <hr>

            <b class="dacdiem">
                Theo bộ
            </b>
            <br>
            <?php 
                //table bo: ma_bo,ten_bo
                $sql_bo = $mysqli->query("select * from bo");
                
                while ($result_bo=$sql_bo->fetch_array()) {
                    echo "<label>
                            <input type='checkbox' name='theo_bo[]'>
                            <b>". $result_bo['ten_bo'] ."</b>
                          </label>
                        <br>";
                }
            ?>
            <hr>

            <b class="dacdiem">
                Theo họ
            </b>
            <br>
            <?php 
                //table ho: ma_ho,ten_ho
                $sql_ho = $mysqli->query("select * from ho");
                
                while ($result_ho=$sql_ho->fetch_array()) {
                    echo "<label>
                            <input type='checkbox' name='theo_ho[]'>
                                <b>". $result_ho['ten_ho'] ."</b>
                          </label>
                        <br>";
                }
            ?>
            <hr>
        </div>

        <script>
            var <?php $checked_gioi ?> = $('input[name=theo_gioi]:checked');
            
        </script>

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

            <?php $count_result = $mysqli->query("select count(*) from dongvat where $search_str_2")->fetch_array(); ?>

            <b style="color: red;">
                (Tìm được <?php echo $count_result[0]; ?> kết quả)
            </b>
            <br>
            <div class="container-fluid d-flex justify-content-start flex-wrap align-item-start"
                style="padding: 20px;">

                <?php
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
                                <a href='?route=chitiet&id=".$i['ma_dv']."'>
                                    <img src='img/$image_name' alt=''>
                                    <div style='padding: 5px;'>
                                        <h6 class=''><b>".$i['ten_dv']."</b></h6>
                                    </div>
                                </a>
                            </div>";
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