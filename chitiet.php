<?php
$sql_chitiet = "SELECT * FROM dongvat WHERE dongvat.ma_dv='".$_GET["id"]."' LIMIT 1";
$query_chitiet = mysqli_query($mysqli, $sql_chitiet);
while ($row_chitiet = mysqli_fetch_array($query_chitiet)) {
?>

<div class="container-fluid p-4">
    <div class="row">
        <div class="col-4">
            <div class="anhconvat">
                <?php
                    if(isset($_GET['anh'])) {
                        $anh = $_GET['anh'];
                    }
                    else {
                        $sql_anh_dv = "SELECT * FROM hinhanh WHERE ma_dv = '.$_GET[id].' LIMIT 1";
                        $query_anh_dv = mysqli_query($mysqli, $sql_anh_dv);
                        $row_anh_dv = mysqli_fetch_array($query_anh_dv);
                        $anh = $row_anh_dv['ten_image'];
                    }
                ?>
                <img src="./img/animals/<?php echo $anh ?>"
                    alt="anhdongvat" id="image" style="width: 400px; height: 400px; display: block; margin: 20px 0 20px 10px; border-radius: 10px">
            </div>
            <div class="d-flex flex-wrap justify-content-around anhnho"
                style="background-color: #CDEDED; margin:10px 10px 0 10px; padding:10px;">
                <?php
                    $sql_anh = "SELECT ten_image FROM hinhanh WHERE ma_dv='".$_GET["id"]."'";
                    $query_anh = mysqli_query($mysqli, $sql_anh);
                    if (mysqli_num_rows($query_anh)==0) {
                        ?>
                            <img src="./img/add.png" alt="anhdongvat">
                        <?php
                    }
                    else{
                        
                        while($row_anh = mysqli_fetch_array($query_anh)){
                            ?>
                            <!-- <button onclick="myFunction(<?php //echo $row_anh['ten_image'] ?>)">
                            </button> -->
                                <a href="?route=chitiet&id=<?php echo $row_chitiet['ma_dv']?>&anh=<?php echo $row_anh['ten_image'] ?>">
                                    <img src="./img/animals/<?php echo $row_anh['ten_image'] ?>" alt="anhdongvat" style="border: 2px solod white">
                                </a>
                                
                            <?php
                        }
                    }
                ?>
            </div>
            <div style="background-color: #E9FEFE; margin: 0px 10px 10px 10px; padding: 5px;" class="text-center">
                Ảnh được thêm bởi <a href="">&#169;
                    <?php
                        $sql_ctv = "SELECT * FROM themdongvat, obvervation
                        WHERE themdongvat.ma_ctv = obvervation.ma_ctv AND ma_dv = '".$_GET["id"]."'";
                        $query_ctv = mysqli_query($mysqli, $sql_ctv);
                        $row_ctv = mysqli_fetch_array($query_ctv);
                        echo $row_ctv['hoten_ctv'];
                    ?>
                </a>
            </div>
        </div>
        <div class="col-5" style="padding: 20px; background-color: #CDEDED; margin-top: 20px; border-radius: 5px;">
            <h1 class="tieude">
                <?php echo $row_chitiet['ten_dv'] ?>
            </h1>
            <i class="phude">
                <?php echo $row_chitiet['ten_eng'] ?>
            </i>
            <br>
            <br>
            <h4 class="dacdiem">
                <b>Mô tả:</b>
            </h4>
            <p>
                <?php echo $row_chitiet['mota'] ?>
            </p>
            <h4 class="dacdiem">
                <b>Đặc điểm sinh thái:</b>
            </h4>
            <p>
                <?php echo $row_chitiet['dacdiem'] ?>
            </p>
            <h4 class="dacdiem">
                <b>Tình trạng bảo tồn theo sách Đỏ Việt Nam</b>
            </h4>
            <p>
                <?php
                    $sql_baoton_sachdovn = "SELECT * FROM dongvat, baoton_sachdovn
                            WHERE dongvat.ma_bt_sachdovn = baoton_sachdovn.ma_bt_sachdovn and dongvat.ma_dv='$_GET[id]'";
                    $query_bt_sachdovn = mysqli_query($mysqli, $sql_baoton_sachdovn);
                    $row_bt_sachdovn = mysqli_fetch_array($query_bt_sachdovn);
                    echo $row_bt_sachdovn['ten_bt_sachdovn'];
                    ?>
            </p>
            <h4 class="dacdiem">
                <b>Tình trạng bảo tồn theo ICUN</b>
            </h4>
            <p>
                <?php
                    $sql_baoton_iucn = "SELECT * FROM dongvat, baoton_iucn
                            WHERE dongvat.ma_bt_iucn = baoton_iucn.ma_bt_iucn and dongvat.ma_dv='$_GET[id]'";
                    $query_bt_iucn = mysqli_query($mysqli, $sql_baoton_iucn);
                    $row_bt_iucn = mysqli_fetch_array($query_bt_iucn);
                    echo $row_bt_iucn['ten_bt_iucn'];
                    ?>
            </p>
            <h4 class="dacdiem">
                <b>Sinh cảnh</b>
            </h4>
            <p>
                <?php echo $row_chitiet['sinhcanh'] ?>
            </p>
            <h4 class="dacdiem">
                <b>Địa điểm</b>
            </h4>
            <p>
                <?php echo $row_chitiet['diadiem'] ?>
            </p>
        </div>
        <div class="col-3" style="margin-top: 20px; padding-left: 30px;">
            <div class="table-responsive">
                <table class="table table-boderless thongtinphanloai">
                    <tr>
                        <th>
                            Giới:
                        </th>
                        <td>
                            <?php
                                $sql_gioi = "SELECT * FROM dongvat, gioi
                                        WHERE dongvat.ma_gioi = gioi.ma_gioi and dongvat.ma_dv='$_GET[id]'";
                                $query_gioi = mysqli_query($mysqli, $sql_gioi);
                                $row_gioi = mysqli_fetch_array($query_gioi);
                                echo $row_gioi['ten_gioi'];
                                ?>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Ngành:
                        </th>
                        <td>
                            <?php
                                $sql_nganh = "SELECT * FROM dongvat, nganh
                                        WHERE dongvat.ma_nganh = nganh.ma_nganh and dongvat.ma_dv='$_GET[id]'";
                                $query_nganh = mysqli_query($mysqli, $sql_nganh);
                                $row_nganh = mysqli_fetch_array($query_nganh);
                                echo $row_nganh['ten_nganh'];
                                ?>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Lớp:
                        </th>
                        <td>
                            <?php
                                $sql_lop = "SELECT * FROM dongvat, lop
                                        WHERE dongvat.ma_lop = lop.ma_lop and dongvat.ma_dv='$_GET[id]'";
                                $query_lop = mysqli_query($mysqli, $sql_lop);
                                $row_lop = mysqli_fetch_array($query_lop);
                                echo $row_lop['ten_lop'];
                                ?>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Bộ:
                        </th>
                        <td>
                            <?php
                                $sql_bo = "SELECT * FROM dongvat, bo
                                        WHERE dongvat.ma_bo = bo.ma_bo and dongvat.ma_dv='$_GET[id]'";
                                $query_bo = mysqli_query($mysqli, $sql_bo);
                                $row_bo = mysqli_fetch_array($query_bo);
                                echo $row_bo['ten_bo'];
                                ?>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Họ:
                        </th>
                        <td>
                            <?php
                                $sql_ho = "SELECT * FROM dongvat, ho
                                        WHERE dongvat.ma_ho = ho.ma_ho and dongvat.ma_dv='$_GET[id]'";
                                $query_ho = mysqli_query($mysqli, $sql_ho);
                                $row_ho = mysqli_fetch_array($query_ho);
                                echo $row_ho['ten_ho'];
                                ?>
                        </td>
                    </tr>

                </table>
            </div>
            <!-- <h2 class="dacdiem" style="margin-top: 20px;">
                <b>Phân bố</b>
            </h2>
            <div>
                <iframe src="<?php
                    // $sql_toado = "SELECT * FROM toado WHERE ma_dv = '$_GET[id]'";
                    // $query_toado = mysqli_query($mysqli, $sql_toado);
                    // $row_toado = mysqli_fetch_array($query_toado);
                    // echo $row_toado['ten_toado'];          
                ?>" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div> -->
            <h2 class="dacdiem" style="margin-top: 20px;">
                        <b>Phân bố</b>
                    </h2>
                    <div>
                        <?php
                            //Tính toán số dữ liệu để hiển thị theo trang
                            $numOfData = 1; //Số dữ liệu hiển thị trong 1 trang
                            $sql = "select count(*) from toado where ma_dv='$_GET[id]'";
                            $sql_1 = $mysqli->query($sql)->fetch_array();
                            $numOfPages = ceil( $sql_1[0] / $numOfData );

                            if( !isset($_GET['page']) ) {
                                //Vị trí bắt đầu
                                $vtbd = 0;
                            }
                            else {
                                $vtbd = ($_GET['page']-1) * $numOfData;
                            }

                            $sql_td = "SELECT * FROM toado where ma_dv='$_GET[id]' order by ma_toado asc limit $vtbd,$numOfData;";
                            $queue_td = mysqli_query($mysqli, $sql_td);
                            $row_td = mysqli_fetch_array($queue_td);
                        ?>

                        <iframe src="<?php echo $row_td['ten_toado'] ?>" width="300" height="450" style="border:0;" allowfullscreen loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
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
                                    <th>Page</th>
                                    <th>Tọa độ</th>
                                </tr>                            
                                    <?php
                                        $i = 1;
                                        $sql_toado = "SELECT * FROM toado where ma_dv='$_GET[id]'";
                                        $queue_toado = mysqli_query($mysqli, $sql_toado);
                                        while($row_toado = mysqli_fetch_array($queue_toado)){
                                            ?>
                                            <tr>
                                                <td>
                                                    <?php
                                                        echo $i;
                                                        $i++;
                                                    ?>
                                                </td>
                                                <td>
                                                    <?php echo $row_toado['ten_toado'] ?>
                                                </td>
                                            </tr>
                                            <?php
                                        }
                                    ?>                            
                            </table>
                        </div>
                        <br>
        </div>
    </div>
</div>
<div class="" style="background-color: #CDEDED; margin: 20px; padding: 10px;">
    <h5 class="dacdiem">
        <b>
            Động vật có cùng Bộ với:
        </b>
        <i>
            <?php
                echo $row_chitiet['ten_dv'];
            ?>
        </i>
    </h5>
    <br>

    <div class="container-fluid d-flex justify-content-start flex-wrap align-item-start">
        
            <!-- <img src="./img/" alt="">
            <div style="padding: 5px;">
                <h6 class=""><b>Squamata Oppel</b></h6>
            </div> -->
            <?php
                $ma_bo = $row_chitiet['ma_bo'];
                $sql_dvcungbo = "SELECT * FROM dongvat, hinhanh_index WHERE dongvat.ma_dv = hinhanh_index.ma_dv AND ma_bo = '$ma_bo'";
                $query_dvcungbo = mysqli_query($mysqli, $sql_dvcungbo);
                
                while ($row_dvcungbo = mysqli_fetch_array($query_dvcungbo)){
                    ?>
                    <div class="oitem1">
                    <img class="anh-index" src="./img/animals/<?php echo $row_dvcungbo['ten_image_index'] ?>" alt="anhdongvat">
                    <div style="padding: 5px;">
                        <h6 class=""><b>
                            <?php
                                echo $row_dvcungbo['ten_dv'];
                            ?>
                        </b></h6>
                    </div>
                </div>
                <?php
                }
            ?>

        
        
    </div>
</div>
<?php
}
?>