<div class="container-fluid body py-3 px-5">
    <div class="container-fluid p-3 ochua1" style="position: relative;">
                    <span><b>Phân loại học</b></span>&#160;
                    <select name="" class="cb" onchange="showHint(this.value)">
                        <option value="gioi">Giới</option>
                        <option value="nganh">Ngành</option>
                        <option value="lop">Lớp</option>
                        <option value="bo" selected>Bộ</option>
                        <option value="ho">Họ</option>
                    </select>
                    <script>
                        function showHint(value) {

                            var xmlhttp = new XMLHttpRequest();
                            xmlhttp.onreadystatechange = function() {
                                if (this.readyState == 4 && this.status == 200) {
                                    document.getElementById("kq").innerHTML =(this.responseText); //=>kết quả trả về thêm vào element này, có html vẫn hiện được
                                }
                            };
                            xmlhttp.open("GET", "getdata.php?bang=" + value, true);
                            xmlhttp.send();
                        }
                    </script>
                    
                <br>
                <br>
        <!-- <div class="play" >
            <a href="" style="color: black;">
                <i class="fa-solid fa-play" style="transform: translateX(9px) translateY(3px);"></i>
            </a>
        </div> -->
        <!-- class="d-flex justify-content-start flex-wrap" -->
        <div  id="kq" style="margin-right: 50px; overflow-x: auto; width: 100%; white-space: nowrap">
            <?php
                $sql_pl = "SELECT ten_bo FROM bo";
                $query_pl = mysqli_query($mysqli,$sql_pl);
                while($row_pl = mysqli_fetch_array($query_pl)) {
                    ?>
                        <div class="oitem" style="display: inline-block;" >
                            <h5 class="tenloai">
                                <?php echo $row_pl['ten_bo'] ?>
                            </h5>       
                        </div>
                    <?php
                }
            ?>
        </div>
    </div>
    <div class="container-fluid p-3 px-5 ochua2 mt-3" style="position: relative;">
                <span><b>Ưu tiên xem</b></span>&#160;
                <select class="cb" onchange="showArrange(this.value)">
                    <option value="moinhat">Mới nhất</option>
                    <option value="cunhat">Cũ nhất</option>
                    <option value="iucn">Bảo tồn IUCN</option>
                </select>
                <script>
                        function showArrange(value) {

                            var xmlhttp = new XMLHttpRequest();
                            xmlhttp.onreadystatechange = function() {
                                if (this.readyState == 4 && this.status == 200) {
                                    document.getElementById("kq-sx").innerHTML =(this.responseText); //=>kết quả trả về thêm vào element này, có html vẫn hiện được
                                }
                            };
                            xmlhttp.open("GET", "getdata-animal.php?animal=" + value, true);
                            xmlhttp.send();
                        }
                    </script>
                <br><br>
                <?php
                    $sql_count = "SELECT COUNT(ma_dv) soluong FROM hinhanh_index";
                    $query_count = mysqli_query($mysqli,$sql_count);
                    $count = mysqli_fetch_array($query_count);
                ?>
                <p style="color:red; position: absolute; top: 30px; right: 50px">
                    <b>(Có tất cả <?php echo $count['soluong'] ?> loài)</b>
                </p>
        <div id="kq-sx" class="container-fluid d-flex justify-content-start flex-wrap align-item-start">
        <?php    
            $sql_animal = "SELECT * FROM hinhanh_index, dongvat
                WHERE dongvat.ma_dv = hinhanh_index.ma_dv ORDER BY dongvat.ma_dv DESC";
            $query_animal = mysqli_query($mysqli,$sql_animal);
            while($row_animal = mysqli_fetch_array($query_animal))  {
                ?>
                    <div class="oitem1">
                        <a class="text-decoraton-none" href="?route=chitiet&id='.$row_animal['ten_dv'].'">
                            <img class="anh-index" src="./img/animals/<?php echo $row_animal['ten_image_index'] ?>" width="50px" alt="<?php echo $row_animal['ten_image_index'] ?>">
                            <div style="padding: 5px;" class="tendv">
                                <h6 class="tendv">
                                    <?php echo $row_animal['ten_dv'] ?>
                                </h6>
                            </div>
                        </a>
                    </div>
                <?php
                    }
                ?>
        </div>
    </div>
</div>