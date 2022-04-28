<?php
    include("./config.php");
    include("./autoload.php");
    session_start();

    if (isset($_POST['luu-ctv'])) {
        $ma_ctv = $_SESSION['tt_dangnhap']['ma_ctv'];

        $ten_ctv = trim($_POST['ten-ctv']);
        $ten_ctv = str_replace("'", "&#39;", $ten_ctv);

        $email = $_POST['email-ctv'];
        $sdt = $_POST['sdt-ctv'];

        $ten_file_anh_ctv = $_FILES['hinh_anh_ctv']['name'];
        $old_image_ctv = $_POST['old_image_ctv']; 

        unset($_SESSION["err"]);
        if ($ten_ctv!="") {
            if ($email!="") {
                if ($sdt!="") {
                    //table obvervation: ma_ctv,ten_ctv,uname,passwd,email_ctv,sdt,anh_ctv
                        //update thông tin                    
                    $mysqli->query("update obvervation set hoten_ctv='$ten_ctv',email_ctv='$email',sdt='$sdt' where ma_ctv='$ma_ctv';");

                    //update hình ảnh
                    $check_image = $mysqli->query("select * from obvervation where ma_ctv='$ma_ctv';");
                    //Nếu ảnh trùng -> bỏ qua, ko thêm
                    if (mysqli_num_rows($check_image)!=0) {
                        while ($ten_image_array=$check_image->fetch_array()) {
                            if ($ten_file_anh_ctv==$ten_image_array['anh_ctv']) {
                                $ten_file_anh_ctv="";
                                (new obvervation)->NotificationAndGoback("Ảnh bị trùng!"); //dev only
                            }                            
                        }
                    }
                    //Nếu đổi ảnh -> xóa ảnh cũ để thêm ảnh mới
                    if ($ten_file_anh_ctv!="" and $ten_file_anh_ctv!=$old_image_ctv) {
                        //(new obvervation)->Notification("Đổi ảnh! ".$old_image_ctv." -> ".$ten_file_anh_ctv);
                        //unlink
                        $path = './img/'.$old_image_ctv;

                        chown($path, 666);

                        if (unlink($path)) {
                            //(new obvervation)->Notification("Xóa ảnh! ".$old_image_ctv);
                        } else {
                            //(new obvervation)->Notification("Ko xóa ảnh! ".$old_image_ctv);
                        }
                    }                    
                    //Thêm ảnh
                    if ($ten_file_anh_ctv!="") {
                        $mysqli->query("update obvervation set anh_ctv='$ten_file_anh_ctv' where ma_ctv='$ma_ctv';");

                        //Thêm file ảnh đã tải lên
                        $link_anh_ctv = "./img/".$ten_file_anh_ctv;
                        move_uploaded_file($_FILES['hinh_anh_ctv']['tmp_name'],$link_anh_ctv);
                    }
                    //

                    (new obvervation)->NotificationAndGoback("Đã sửa");

                } else {$_SESSION["err"] = "Chưa nhập số điện thoại!";}
            } else {$_SESSION["err"] = "Chưa nhập email!";}
        } else {$_SESSION["err"] = "Chưa nhập tên CTV!";}

        //Hiện báo lỗi
        if(isset($_SESSION["err"])) {
            $notification = $_SESSION["err"]; unset($_SESSION["err"]);
            //echo $notification;
            (new obvervation)->NotificationAndGoback($notification);
        }   

    }

?>