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

        //Tính toán số sản phẩm để hiển thị theo trang
        // $so_du_lieu = 15;
        // $sql = "select count(*)
        //         from dienthoai
        //         where $search_str_2";
        // $sql_1 = $conn->query($sql)->fetch_array();
        // $so_trang = ceil( $sql_1[0] / $so_du_lieu );

        /* Table dongvat: ma_dv,ten_dv,ten_eng,mota,dacdiem,ma_bt_sachdovn,ma_bt_iucn,
            sinhcanh,diadiem,ma_gioi,ma_nganh,ma_lop,ma_ho,ma_bo */
        $sql_search = "select * from dongvat where $search_str_2";
        $search_result = $mysqli->query($sql_search);
    }
?>

<!-- <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tìm kiếm nâng cao</title>
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
            <form action="" method="POST" style="display: inline-block;"> 
                <input type="search" class="input_search form-control" placeholder="Nhập tên loài chim cần tìm...">
                <button type="submit" class="btn search_icon"><i class="fa-solid fa-magnifying-glass"></i></button>
            </form>
        </div> -->

        <div class="" style="padding: 40px;">
            <div class="row">
                <div class="col-3" style="padding-left: 40px;">
                    <b class="dacdiem">
                        Lọc kết quả
                    </b>
                    <span>(Chọn 1 lựa chọn)</span>
                    <br>
                    <input type="checkbox">
                    <label for=""><b>Tất cả</b></label>
                    <br>
                    <input type="checkbox">
                    <label for=""><b>Tất cả</b></label>
                    <br>
                    <input type="checkbox">
                    <label for=""><b>Tất cả</b></label>
                    <br><br>
                    <b class="dacdiem">
                        Lọc kết quả
                    </b>

                    <br>
                    <input type="checkbox">
                    <label for=""><b>Tất cả</b></label>
                    <br><br>
                    <b class="dacdiem">

                        Lọc kết quả
                    </b>
                    <br>
                    <input type="checkbox">
                    <label for=""><b>Tất cả</b></label>
                    <br>
                    <input type="checkbox">
                    <label for=""><b>Tất cả</b></label>
                    <br>
                    <input type="checkbox">
                    <label for=""><b>Tất cả</b></label>
                    <br>
                    <input type="checkbox">
                    <label for=""><b>Tất cả</b></label>
                    <br>
                    <input type="checkbox">
                    <label for=""><b>Tất cả</b></label>
                    <br><br>
                    <b class="dacdiem">

                        Lọc kết quả
                    </b>
                    <br>
                    <input type="checkbox">
                    <label for=""><b>Tất cả</b></label>
                    <br>
                    <input type="checkbox">
                    <label for=""><b>Tất cả</b></label>
                    <br>
                    <input type="checkbox">
                    <label for=""><b>Tất cả</b></label>
                    <br>
                    <input type="checkbox">
                    <label for=""><b>Tất cả</b></label>
                    <br>
                    <input type="checkbox">
                    <label for=""><b>Tất cả</b></label>
                </div>

                <!-- Result -->
                <div class="col-9" style="background-color: #CDEDED; border-radius: 5px; padding: 30px;">
                    <h3 class="dacdiem">
                        <b>
                            Kết quả tìm kiếm cho:
                        </b>
                        <i>
                            <b>
                                <?php echo $_GET['keyword']; echo "<br>";
                                echo "SQL: ".$search_str_2; ?>
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
                            while($i = $search_result->fetch_array()) {
                                $sql_image = "select ten_image from hinhanh where ma_dv='".$i['ma_dv']."' limit 1;";
                                $image_result = $mysqli->query($sql_image)->fetch_array();

                                echo "<a href='?route=chitiet&id=".$i['ma_dv']."'>
                                    <div class='oitem1'>
                                        <img src='../../img/animals/".$image_result['ten_image']."' alt=''>
                                        <div style='padding: 5px;'>
                                            <h6 class=''><b>".$i['ten_dv']."</b></h6>
                                    </div>
                                </a>";
                            }
                        ?>
                        <!-- <div class="oitem1">
                            <img src="../../img/ech.png" alt="">
                            <div style="padding: 5px;">
                                <h6 class=""><b>Squamata Oppel</b></h6>
                            </div>

                        </div>
                        <div class="oitem1">
                            <img src="../../img/ech.png" alt="">
                            <div style="padding: 5px;">
                                <h6 class=""><b>Squamata Oppel</b></h6>
                            </div>

                        </div>
                        <div class="oitem1">
                            <img src="../../img/ech.png" alt="">
                            <div style="padding: 5px;">
                                <h6 class=""><b>Squamata Oppel</b></h6>
                            </div>

                        </div>
                        <div class="oitem1">
                            <img src="../../img/ech.png" alt="">
                            <div style="padding: 5px;">
                                <h6 class=""><b>Squamata Oppel</b></h6>
                            </div> -->

                        </div>
                    </div>
                </div>
            </div>
        </div>

<!--         
        <div class="footer">
            Đây là Footers
        </div>
    </div>
</body>

</html> -->