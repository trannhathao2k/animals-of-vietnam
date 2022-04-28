<?php
include("config.php");
include("autoload.php");
session_start();

if(isset($_GET['ma-ctv'])) {
    $mactv = $_GET['ma-ctv'];
}
else {
    $mactv = "Undefined";
}

$sql_mactv = "SELECT * FROM obvervation WHERE ma_ctv = $mactv";
$query_mactv = mysqli_query($mysqli,$sql_mactv);
$row_mactv = mysqli_fetch_array($query_mactv);
?>

<form action="./action-capnhatctv.php" method="POST" enctype="multipart/form-data">
    <!-- avatar -->           
    <div class="col-sm-5">
        <div class="canhgiua">
            <?php 
                $ma_ctv = $_SESSION['tt_dangnhap']['ma_ctv'];
                $sql_profile = "SELECT * FROM obvervation WHERE ma_ctv = '$ma_ctv'";
                $query_profile3 = mysqli_query($mysqli, $sql_profile);
                $row_profile3 = mysqli_fetch_array($query_profile3);
                $ten_image_ctv = $row_profile3['anh_ctv'];
            ?>

            <img id="review_ctv" src="./img/<?php echo $ten_image_ctv; ?>" alt="Ảnh đại diện" class="img-thumbnail" style="height: 250px; width: 250px;border: 4px;border-color: white;">
            <input id="file-input_ctv" name="hinh_anh_ctv" type="file" accept="image/*" onchange="loadFile(event)" style="display: none;"/>
            <input type="hidden" name="old_image_ctv" value="<?php echo $ten_image_ctv; ?>">
        </div>

        <!-- Giup review anh tai len -->
        <script>
            var loadFile = function(event) {
                var review_ctv = document.getElementById('review_ctv');
                review_ctv.src = URL.createObjectURL(event.target.files[0]);
                review_ctv.onload = function() {
                    URL.revokeObjectURL(review_ctv.src) // free memory
                }
            };
        </script>

        <div class="canhgiua" style="margin-top: 10px;">
            <button type="button" name="doi_avatar" class="btn btn-primary">
                <label for="file-input_ctv">Đổi ảnh đại diện</label>
            </button>        
        </div>     
    </div>
    <!-- infor -->
    <div class="col-sm-7 thongtin">
        <div style="margin-left: 30px;">
            <p>Tên cộng tác viên: 
            <input name="ten-ctv" class="form-control" cols="10" rows="1" value="<?php echo $row_mactv['hoten_ctv']; ?>"></input>
            </p>
            <p>Email: 
            <input name="email-ctv" class="form-control" cols="10" rows="1" value="<?php echo $row_mactv['email_ctv']; ?>"></input>
            </p>
            <p>SDT: 
            <input name="sdt-ctv" class="form-control" cols="10" rows="1" value="<?php echo $row_mactv['sdt']; ?>"></input>
            </p>
            <input type="submit" name="luu-ctv" value="Lưu" class="btn btn-primary" style="margin-left: 300px">
            <a href=""><button type="button" style="display: inline-block;" class="btn btn-primary" style="margin-left: 400px">Hủy</button></a>
        </div>
    </div>
</form>