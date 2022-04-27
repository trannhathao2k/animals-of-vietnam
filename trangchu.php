<div class="container-fluid body py-3 px-5">
    <div class="container-fluid p-3 ochua1" style="position: relative;">
                    <span><b>Phân loại học</b></span>&#160;
                    <select id="sl-phanloai" class="cb" onchange="showHint(this.value)">
                        <option value="all">Tất cả</option>
                        <option value="gioi">Giới</option>
                        <option value="nganh">Ngành</option>
                        <option value="lop">Lớp</option>
                        <option value="bo">Bộ</option>
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
                $sql_pl2 = "SELECT * FROM bo";
                $query_pl2 = mysqli_query($mysqli,$sql_pl2);
                while($row_pl2 = mysqli_fetch_array($query_pl2)) {
                    ?>
                        <div onclick="showdv('bo', <?php echo $row_pl2['ma_bo'] ?> )" class="oitem tenloai" style="display: inline-block;" >
                            <input type="radio" id="<?php echo $row_pl2['ma_bo'] ?>" name="oitem" value="<?php echo $row_pl2['ma_bo'] ?>" style="opacity: 0">
                            <label for="<?php echo $row_pl2['ma_bo'] ?>">
                                <h5 class="tenloai"><?php echo $row_pl2['ten_bo'] ?></h5>
                            </label>       
                        </div>
                    <?php
                }
            ?>
            
        </div>
        <!-- <div>
            <p id="test"></p>
            <script>
                function showdv(phanloai, loai) {
                    document.getElementById('test').innerHTML = phanloai + " - " + loai;
                }
            </script>
        </div> -->
    </div>
    <div class="container-fluid p-3 px-5 ochua2 mt-3" style="position: relative;">
                <span><b>Ưu tiên xem</b></span>&#160;
                <select class="cb" onchange="showArrange(this.value)">
                    <option value="moinhat">Mới nhất</option>
                    <option value="cunhat">Cũ nhất</option>
                    <option value="ten">Tên</option>
                    <option value="iucn">Bảo tồn IUCN</option>
                    
                </select>
                <script>
                        function showArrange(value) {

                            var phanloai = document.getElementById("sl-phanloai").value;

                            var checkbox = document.getElementsByName("oitem");
                            for (var i=0; i < checkbox.length; i++) {
                                if (checkbox[i].checked === true) {
                                    var loai = checkbox[i].value;
                                }
                            }

                            var xmlhttp = new XMLHttpRequest();
                            xmlhttp.onreadystatechange = function() {
                                if (this.readyState == 4 && this.status == 200) {
                                    document.getElementById("kq-sx").innerHTML =(this.responseText); //=>kết quả trả về thêm vào element này, có html vẫn hiện được
                                }
                            };
                            xmlhttp.open("GET", "getdata-phanloai.php?phanloai=" + phanloai + "&loai=" + loai + "&animal=" + value, true);
                            xmlhttp.send();
                        }
                    </script>
                <br><br>
                <?php
                    $sql_count = "SELECT COUNT(ma_dv) soluong FROM hinhanh WHERE image_index = 1";
                    $query_count = mysqli_query($mysqli,$sql_count);
                    $count = mysqli_fetch_array($query_count);
                ?>
                <p style="color:red; position: absolute; top: 30px; right: 50px">
                    <b>(Có tất cả <?php echo $count['soluong'] ?> loài đã được thêm)</b>
                </p>

        <!-- render dongvat -->
        <div id="kq-sx">
            <div class="container-fluid d-flex justify-content-start flex-wrap align-item-start">
                <?php 
                    //Tính toán số dữ liệu để hiển thị theo trang
                    $numOfData = 16; //Số dữ liệu hiển thị trong 1 trang
                    $sql = "select count(*) from hinhanh,dongvat
                    where dongvat.ma_dv=hinhanh.ma_dv and hinhanh.image_index=1";
                    $sql_1 = $mysqli->query($sql)->fetch_array();
                    $numOfPages = ceil( $sql_1[0] / $numOfData );

                    if( !isset($_GET['page']) ) {
                        //Vị trí bắt đầu
                        $vtbd = 0;
                    }
                    else {
                        $vtbd = ($_GET['page']-1) * $numOfData;
                    }//
                
                    $sql_animal = "SELECT * FROM hinhanh, dongvat
                        WHERE dongvat.ma_dv = hinhanh.ma_dv AND hinhanh.image_index = 1 ORDER BY dongvat.ma_dv DESC limit $vtbd,$numOfData";
                    $query_animal = mysqli_query($mysqli,$sql_animal);
                    while($row_animal = mysqli_fetch_array($query_animal))  {
                        ?>
                            <div class="oitem1">
                                <a class="text-decoration-none" href="?route=chitiet&id=<?php echo $row_animal['ma_dv']?>">
                                    <img class="anh-index" src="./img/animals/<?php echo $row_animal['ten_image'] ?>" width="50px" alt="<?php echo $row_animal['ten_image'] ?>">
                                    <div style="padding: 5px;" class="tendv">
                                        <h6 class="tendv" style="color: #006089;">
                                            <?php echo $row_animal['ten_dv'] ?>
                                        </h6>
                                    </div>
                                </a>
                            </div>
                        <?php
                            }
                        ?>
            </div>
            <!-- phân trang -->
            <div style="text-align:center;">
                <div style="display:inline-block">
                    <ul class="pagination">
                        <?php
                            if ($numOfPages === 0) {
                                echo '';
                            }
                            else {
                                for($i=1; $i<=$numOfPages; $i++) {
                                $link = "?route=trangchu&page=".$i;
                                echo "<li class='page-item active'>
                                    <a class='page-link' href='$link'>$i</a>
                                </li>";
                                }
                            }
                            
                        ?>
                    </ul>
                </div>                    
            </div>
            <!--  -->            
        </div>
        
        
    </div>
</div>
<script>
    function showdv(phanloai, loai) {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("kq-sx").innerHTML =(this.responseText); //=>kết quả trả về thêm vào element này, có html vẫn hiện được
            }
        };
        xmlhttp.open("GET", "getdata-phanloai.php?phanloai=" + phanloai + "&loai=" + loai, true);
        xmlhttp.send();
    }
</script>