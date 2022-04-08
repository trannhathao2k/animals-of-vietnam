<?php
    include("../../config.php");
    include("../../autoload.php");
    session_start();

    if (isset($_POST['Sua_dv'])) {
        $ma_dv = $_SESSION['ma_dv_sua'];

        //Đổi ký tự ' (nếu có) thành ký tự đặc biệt của ' để tránh xung đột code
        $ten_dv = trim($_POST['ten_dv']);
        $ten_dv = str_replace("'", "&#39;", $ten_dv);

        $ten_eng = trim($_POST['ten_eng']);
        $ten_eng = str_replace("'", "&#39;", $ten_eng);

        $mota = $_POST['mota'];
        $mota = str_replace("'", "&#39;", $mota);

        $dacdiem = $_POST['dacdiem'];
        $dacdiem = str_replace("'", "&#39;", $dacdiem);

        $ma_bt_sachdovn = $_POST['bt_sachdovn'];
        $ma_bt_iucn = $_POST['bt_iucn'];

        $sinhcanh = $_POST['sinhcanh'];
        $sinhcanh = str_replace("'", "&#39;", $sinhcanh);

        $diadiem = $_POST['diadiem'];
        $diadiem = str_replace("'", "&#39;", $diadiem);

        $phanbo = $_POST['phanbo'];
        $phanbo = str_replace("'", "&#39;", $phanbo);

        $ma_gioi = $_POST['gioi'];
        $ma_nganh = $_POST['nganh'];
        $ma_lop = $_POST['lop'];
        $ma_ho = $_POST['ho'];
        $ma_bo = $_POST['bo'];

        $ten_file_anh_1 = $_FILES['hinh_anh_1']['name'];
        $ten_file_anh_2 = $_FILES['hinh_anh_2']['name'];
        $ten_file_anh_3 = $_FILES['hinh_anh_3']['name'];
        $ten_file_anh_4 = $_FILES['hinh_anh_4']['name'];

        unset($_SESSION["err"]);
        
        if ($ten_dv!="") {
            if ($ten_eng!="") {
                if ($mota!="") {
                    if ($dacdiem!="") {
                        if ($sinhcanh!="") {
                            if ($diadiem!="") {
                                if ($phanbo!="") {
                                    /* Table dongvat: ma_dv,ten_dv,ten_eng,mota,dacdiem,ma_bt_sachdovn,ma_bt_iucn,sinhcanh,diadiem,ma_gioi,ma_nganh,ma_lop,ma_ho,ma_bo */
                                    $sua_sql = "update dongvat set ten_dv='$ten_dv',ten_eng='$ten_eng',mota='$mota',dacdiem='$dacdiem',ma_bt_sachdovn='$ma_bt_sachdovn',ma_bt_iucn='$ma_bt_iucn',sinhcanh='$sinhcanh',diadiem='$diadiem',ma_gioi='$ma_gioi',ma_nganh='$ma_nganh',ma_lop='$ma_lop',ma_ho='$ma_ho',ma_bo='$ma_bo' where ma_dv='$ma_dv';";
                                    $mysqli->query($sua_sql);

                                    //table hinhanh: ma_image,ten_image,ma_dv
                                    $check_image = $mysqli->query("select * from hinhanh where ma_dv='$ma_dv';");
                                    if (mysqli_num_rows($check_image)!=0) {
                                        while ($ten_image_array=$check_image->fetch_array()) {
                                            if ($ten_file_anh_1==$ten_image_array['ten_image']) {
                                                $ten_file_anh_1="";
                                            }
                                            if ($ten_file_anh_2==$ten_image_array['ten_image']) {
                                                $ten_file_anh_2="";
                                            }
                                            if ($ten_file_anh_3==$ten_image_array['ten_image']) {
                                                $ten_file_anh_3="";
                                            }
                                            if ($ten_file_anh_4==$ten_image_array['ten_image']) {
                                                $ten_file_anh_4="";
                                            }
                                        }
                                    }

                                    if ($ten_file_anh_1!="") {
                                        $mysqli->query("insert into hinhanh value(null,'$ten_file_anh_1','$ma_dv');");

                                        //Thêm file ảnh đã tải lên
                                        $link_anh_1 = "../../img/animals/".$ten_file_anh_1;
                                        move_uploaded_file($_FILES['hinh_anh_1']['tmp_name'],$link_anh_1);
                                    }
                                    if ($ten_file_anh_2!="") {
                                        $mysqli->query("insert into hinhanh value(null,'$ten_file_anh_2','$ma_dv');");

                                        //Thêm file ảnh đã tải lên
                                        $link_anh_2 = "../../img/animals/".$ten_file_anh_2;
                                        move_uploaded_file($_FILES['hinh_anh_2']['tmp_name'],$link_anh_2);
                                    }
                                    if ($ten_file_anh_3!="") {
                                        $mysqli->query("insert into hinhanh value(null,'$ten_file_anh_3','$ma_dv');");

                                        //Thêm file ảnh đã tải lên
                                        $link_anh_3 = "../../img/animals/".$ten_file_anh_3;
                                        move_uploaded_file($_FILES['hinh_anh_3']['tmp_name'],$link_anh_3);
                                    }
                                    if ($ten_file_anh_4!="") {
                                        $mysqli->query("insert into hinhanh value(null,'$ten_file_anh_4','$ma_dv');");

                                        //Thêm file ảnh đã tải lên
                                        $link_anh_4 = "../../img/animals/".$ten_file_anh_4;
                                        move_uploaded_file($_FILES['hinh_anh_4']['tmp_name'],$link_anh_4);
                                    }

                                    //Table phanbo: ma_pb,noiphanbo,ma_dv
                                    $check_phanbo = $mysqli->query("select * from phanbo where ma_dv='$ma_dv';");

                                    if (mysqli_num_rows($check_phanbo)!=0) {
                                        $mysqli->query("update phanbo set noiphanbo='$phanbo' where ma_dv='$ma_dv');");
                                    } else {
                                        $mysqli->query("insert into phanbo value(null,'$phanbo','$ma_dv');");
                                    }                                        
                                    (new obvervation)->NotificationAndGoto("Đã sửa, cảm ơn bạn đã đóng góp!","../../index.php?route=capnhatthongtin");
                                
                                } else {$_SESSION["err"] = "Chưa nhập phân bố!";}
                            } else {$_SESSION["err"] = "Chưa nhập địa điểm!";}
                        } else {$_SESSION["err"] = "Chưa nhập sinh cảnh!";}
                    } else {$_SESSION["err"] = "Chưa nhập đặc điểm!";}
                } else {$_SESSION["err"] = "Chưa nhập mô tả!";}
            } else {$_SESSION["err"] = "Chưa nhập tên khoa học!";}
        } else {$_SESSION["err"] = "Chưa nhập tên động vật!";}

        if(isset($_SESSION["err"])) {
            $notification = $_SESSION["err"]; unset($_SESSION["err"]);
            //echo $notification;
            (new obvervation)->NotificationAndGoback($notification);
        }   
    }
?>