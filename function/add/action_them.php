<?php
    include("../../config.php");
    include("../../autoload.php");
    session_start();

    if (isset($_POST['Them_dv'])) {
        //Thông tin CTV thêm dữ liệu
        $ma_ctv = $_SESSION['tt_dangnhap']['ma_ctv'];

        //Đổi ký tự ' (nếu có) thành ký tự đặc biệt của ' để tránh xung đột code
        $ten_dv = $_POST['ten_dv'];
        $ten_dv = str_replace("'", "&#39;", $ten_dv);

        $ten_eng = $_POST['ten_eng'];
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

        unset($_SESSION["err"]);

        if ($ten_dv!="") {
            if ($ten_eng!="") {
                if ($mota!="") {
                    if ($dacdiem!="") {
                        if ($sinhcanh!="") {
                            if ($diadiem!="") {
                                if ($phanbo!="") {
                                    //Kiểm tra trùng tên
                                    $duplicate_sql = "select * from dongvat where ten_dv='$ten_dv' or ten_eng='$ten_eng';";
                                    $duplicate_check = $mysqli->query($duplicate_sql);

                                    if (mysqli_num_rows($duplicate_check)==0) {
                                        /* Table dongvat: ma_dv,ten_dv,ten_eng,mota,dacdiem,ma_bt_sachdovn,ma_bt_iucn,sinhcanh,diadiem,ma_gioi,ma_nganh,ma_lop,ma_ho,ma_bo */
                                        $add_sql = "insert into dongvat value(null,'$ten_dv','$ten_eng','$mota','$dacdiem','$ma_bt_sachdovn','$ma_bt_iucn','$sinhcanh','$diadiem','$ma_gioi','$ma_nganh','$ma_lop','$ma_ho','$ma_bo');";
                                        $mysqli->query($add_sql);

                                        //Thêm ảnh
                                        $get_ma_dv = $mysqli->query("select ma_dv from dongvat order by ma_dv desc;")->fetch_array();
                                        $get_ma_dv_result = $get_ma_dv[0];

                                        //table hinhanh: ma_image,ten_image,ma_dv,hinhanh_index
                                        if ($ten_file_anh_1!="") {
                                            $mysqli->query("insert into hinhanh value(null,'$ten_file_anh_1','$get_ma_dv_result',1);");

                                            //Thêm file ảnh đã tải lên
                                            $link_anh_1 = "../../img/animals/".$ten_file_anh_1;
                                            move_uploaded_file($_FILES['hinh_anh_1']['tmp_name'],$link_anh_1);
                                        }
                                        if ($ten_file_anh_2!="") {
                                            $mysqli->query("insert into hinhanh value(null,'$ten_file_anh_2','$get_ma_dv_result',0);");

                                            //Thêm file ảnh đã tải lên
                                            $link_anh_2 = "../../img/animals/".$ten_file_anh_2;
                                            move_uploaded_file($_FILES['hinh_anh_2']['tmp_name'],$link_anh_2);
                                        }
                                        if ($ten_file_anh_3!="") {
                                            $mysqli->query("insert into hinhanh value(null,'$ten_file_anh_3','$get_ma_dv_result',0);");

                                            //Thêm file ảnh đã tải lên
                                            $link_anh_3 = "../../img/animals/".$ten_file_anh_3;
                                            move_uploaded_file($_FILES['hinh_anh_3']['tmp_name'],$link_anh_3);
                                        }

                                        //Table phanbo: ma_pb,noiphanbo,ma_dv
                                        $mysqli->query("insert into phanbo value(null,'$phanbo','$get_ma_dv_result');");

                                        //Ghi nhận vào bảng themdongvat
                                        //table themdongvat: ma_ctv,ma_dv
                                        $mysqli->query("insert into themdongvat value('$ma_ctv','$get_ma_dv_result');");

                                        (new obvervation)->NotificationAndGoto("Đã thêm, cảm ơn bạn đã đóng góp!","../../index.php?route=capnhatthongtin");
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
            //echo $notification;
            (new obvervation)->NotificationAndGoback($notification);
        }       
    }
?>