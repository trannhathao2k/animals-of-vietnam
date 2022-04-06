<?php
    include("../../config.php");
    include("../../autoload.php");
    session_start();

    //Thông tin CTV thêm dữ liệu
    $ma_ctv = $_SESSION['tt_dangnhap']['ma_ctv'];

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

    $ma_gioi = $_SESSION['ma_gioi'];
    $ma_nganh = $_SESSION['ma_nganh'];
    $ma_lop = $_SESSION['ma_lop'];
    $ma_ho = $_SESSION['ma_ho'];
    $ma_bo = $_SESSION['ma_bo'];

    $ten_file_anh_1 = $_FILES['hinh_anh_1']['name'];
    $ten_file_anh_2 = $_FILES['hinh_anh_2']['name'];
    $ten_file_anh_3 = $_FILES['hinh_anh_3']['name'];
    $ten_file_anh_4 = $_FILES['hinh_anh_4']['name'];

    if ($ten_dv!="") {
        if ($ten_eng!="") {
            if ($mota!="") {
                if ($dacdiem!="") {
                    if ($sinhcanh!="") {
                        if ($diadiem!="") {
                            if ($phanbo!="") {
                                //Kiểm tra trùng tên
                                $duplicate_sql = "select * from dongvat where ten_dv='$ten_dv' or ten_eng='$ten_eng';";
                                $duplicate_check = $mysqli->query($duplicate_sql)->fetch_array();

                                if ($duplicate_check[0]==0 or $duplicate_check[0]==null) {
                                    /* Table dongvat: ma_dv,ten_dv,ten_eng,mota,dacdiem,ma_bt_sachdovn,ma_bt_iucn,sinhcanh,diadiem,ma_gioi,ma_nganh,ma_lop,ma_ho,ma_bo */
                                    $add_sql = "insert into dongvat value(null,'$ten_dv','$ten_eng','$mota','$dacdiem','$ma_bt_sachdovn','$ma_bt_iucn','$sinhcanh','$diadiem','$ma_gioi','$ma_nganh','$ma_lop','$ma_ho','$ma_bo');";
                                    $mysqli->query($add_sql);

                                    //Thêm ảnh
                                    $get_ma_dv = $mysqli->query("select ma_dv from dongvat order by ma_dv desc;")->fetch_array();
                                    $get_ma_dv_result = $get_ma_dv[0];

                                    //table hinhanh: ma_image,ten_image,ma_dv
                                    if ($ten_file_anh_1!="") {
                                        $mysqli->query("insert into hinhanh value(null,'$ten_file_anh_1','$get_ma_dv_result');");

                                        //Thêm file ảnh đã tải lên
                                        $link_anh_1 = "../../img/animals/".$ten_file_anh_1;
                                        move_uploaded_file($_FILES['hinh_anh_1']['tmp_name'],$link_anh_1);
                                    }
                                    if ($ten_file_anh_2!="") {
                                        $mysqli->query("insert into hinhanh value(null,'$ten_file_anh_2','$get_ma_dv_result');");

                                        //Thêm file ảnh đã tải lên
                                        $link_anh_2 = "../../img/animals/".$ten_file_anh_2;
                                        move_uploaded_file($_FILES['hinh_anh_2']['tmp_name'],$link_anh_2);
                                    }
                                    if ($ten_file_anh_3!="") {
                                        $mysqli->query("insert into hinhanh value(null,'$ten_file_anh_3','$get_ma_dv_result');");

                                        //Thêm file ảnh đã tải lên
                                        $link_anh_3 = "../../img/animals/".$ten_file_anh_3;
                                        move_uploaded_file($_FILES['hinh_anh_3']['tmp_name'],$link_anh_3);
                                    }
                                    if ($ten_file_anh_4!="") {
                                        $mysqli->query("insert into hinhanh value(null,'$ten_file_anh_4','$get_ma_dv_result');");

                                        //Thêm file ảnh đã tải lên
                                        $link_anh_4 = "../../img/animals/".$ten_file_anh_4;
                                        move_uploaded_file($_FILES['hinh_anh_4']['tmp_name'],$link_anh_4);
                                    }

                                    //Ghi nhận vào bảng themdongvat
                                    //table themdongvat: ma_ctv,ma_dv
                                    $mysqli->query("insert into themdongvat value('$ma_ctv','$get_ma_dv_result');");

                                    (new obvervation)->NotificationAndGoto("Đã thêm, quay về trang chủ!","?route=trangchu");

                                } else {$_SESSION["err"] = "Trùng tên động vật có sẵn!";}
                            } else {$_SESSION["err"] = "Chưa nhập phân bố!";}
                        } else {$_SESSION["err"] = "Chưa nhập địa điểm!";}
                    } else {$_SESSION["err"] = "Chưa nhập sinh cảnh!";}
                } else {$_SESSION["err"] = "Chưa nhập đặc điểm!";}
            } else {$_SESSION["err"] = "Chưa nhập mô tả!";}
        } else {$_SESSION["err"] = "Chưa nhập tên khoa học!";}
    } else {$_SESSION["err"] = "Chưa nhập tên động vật!";}

    if(isset($_SESSION["err"])) {
        $notification = $_SESSION["err"]; unset($_SESSION["err"]);
        (new obvervation)->NotificationAndGoback($notification);
        
    }
?>