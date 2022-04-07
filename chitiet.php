<?php
$sql_chitiet = "SELECT * FROM dongvat, hinhanh WHERE dongvat.ma_dv = hinhanh.ma_dv AND dongvat.ma_dv='$_GET[id]' LIMIT 1";
$query_chitiet = mysqli_query($mysqli, $sql_chitiet);
while ($row_chitiet = mysqli_fetch_array($query_chitiet)) {
?>

<div class="container-fluid p-4">
    <div class="row">
        <div class="col-4">
            <div>
                <?php
                    if(isset($_GET['anh'])) {
                        $anh = $_GET['anh'];
                    }
                    else {
                        $anh = $row_chitiet['ten_image'];
                    }
                ?>
                <img class="anhconvat" src="./img/animals/<?php echo $anh ?>"
                    alt="anhdongvat">
            </div>
            <div class="d-flex flex-wrap justify-content-around anhnho"
                style="background-color: #CDEDED; margin:10px 10px 0 10px; padding:10px;">
                <?php
                    

                    $sql_anh = "SELECT ten_image FROM hinhanh WHERE ma_dv='$_GET[id]'";
                    $query_anh = mysqli_query($mysqli, $sql_anh);
                    if (mysqli_num_rows($query_anh)==0) {
                        ?>
                            <img src="./img/add.png" alt="anhdongvat">
                        <?php
                    }
                    else{
                        
                        while($row_anh = mysqli_fetch_array($query_anh)){
                            ?>
                                <a href="?route=chitiet&id=<?php echo $row_chitiet['ma_dv']?>&anh=<?php echo $row_anh['ten_image'] ?>">
                                    <img src="./img/animals/<?php echo $row_anh['ten_image'] ?>" alt="anhdongvat">
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
                        WHERE themdongvat.ma_ctv = obvervation.ma_ctv AND ma_dv = '$_GET[id]'";
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
            <h2 class="dacdiem" style="margin-top: 20px;">
                <b>Phân bố</b>
            </h2>
            <div>
                <img src="./img/bando.png" alt="" class="bando">
            </div>
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