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

echo '
<p>Tên cộng tác viên: 
<textarea name="ten-ctv" class="form-control" cols="10" rows="1">'.$row_mactv['hoten_ctv'].'</textarea>
</p>
<p>Email: 
<textarea name="email-ctv" class="form-control" cols="10" rows="1">'.$row_mactv['email_ctv'].'</textarea>
</p>
<p>SDT: 
<textarea name="sdt-ctv" class="form-control" cols="10" rows="1">'.$row_mactv['sdt'].'</textarea>
</p>
<input type="submit" name="luu-ctv" value="Lưu" class="btn btn-primary" style="margin-left: 300px">
';

?>

