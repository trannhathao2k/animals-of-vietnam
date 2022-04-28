<?php
    include("../../config.php");
    include("../../autoload.php");
    session_start();

    //Sửa thông tin động vật
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

        //get toado
        $sqlToaDo = $mysqli->query("select * from temp");
        
        $i = 0;     //Đồng thởi là biến kiểm tra tồn tại tọa độ, $i==0 ~ ko có tọa độ
        if (mysqli_num_rows($sqlToaDo)!=0) {
            while ($toaDoArr=$sqlToaDo->fetch_array()) {
                $i++;
                ${"toaDo".$i} = $toaDoArr['ten_temp'];
            }

            //Xóa bảng temp
            $mysqli->query("delete from temp;");
        }
        //

        $ma_gioi = $_POST['gioi'];
        $ma_nganh = $_POST['nganh'];
        $ma_lop = $_POST['lop'];
        $ma_ho = $_POST['ho'];
        $ma_bo = $_POST['bo'];

        $ten_file_anh_1 = $_FILES['hinh_anh_1']['name'];
        $ten_file_anh_2 = $_FILES['hinh_anh_2']['name'];
        $ten_file_anh_3 = $_FILES['hinh_anh_3']['name'];

        //lấy phần sau của tên (bỏ phần animals/)
        $old_image_1 = explode('/', $_POST['old_image_1']); 
        $old_image_1 = array_pop($old_image_1);
        
        $old_image_2 = explode('/', $_POST['old_image_2']); 
        $old_image_2 = array_pop($old_image_2);
        
        $old_image_3 = explode('/', $_POST['old_image_3']); 
        $old_image_3 = array_pop($old_image_3);
        //

        unset($_SESSION["err"]);
        
        if ($ten_dv!="") {
            if ($ten_eng!="") {
                if ($mota!="") {
                    if ($dacdiem!="") {
                        if ($sinhcanh!="") {
                            if ($diadiem!="") {
                                if ($i!=0) {
                                    /* Table dongvat: ma_dv,ten_dv,ten_eng,mota,dacdiem,ma_bt_sachdovn,ma_bt_iucn,sinhcanh,diadiem,ma_gioi,ma_nganh,ma_lop,ma_ho,ma_bo */
                                    $sua_sql = "update dongvat set ten_dv='$ten_dv',ten_eng='$ten_eng',mota='$mota',dacdiem='$dacdiem',ma_bt_sachdovn='$ma_bt_sachdovn',ma_bt_iucn='$ma_bt_iucn',sinhcanh='$sinhcanh',diadiem='$diadiem',ma_gioi='$ma_gioi',ma_nganh='$ma_nganh',ma_lop='$ma_lop',ma_ho='$ma_ho',ma_bo='$ma_bo' where ma_dv='$ma_dv';";
                                    $mysqli->query($sua_sql);

                                    //table hinhanh: ma_image,ten_image,ma_dv
                                    $check_image = $mysqli->query("select * from hinhanh where ma_dv='$ma_dv';");

                                    //Nếu ảnh trùng -> bỏ qua, ko thêm
                                    if (mysqli_num_rows($check_image)!=0) {
                                        while ($ten_image_array=$check_image->fetch_array()) {
                                            if ($ten_file_anh_1==$ten_image_array['ten_image']) {
                                                $ten_file_anh_1="";
                                                (new obvervation)->NotificationAndGoback("Ảnh thứ 1 bị trùng!"); //dev only
                                            }
                                            if ($ten_file_anh_2==$ten_image_array['ten_image']) {
                                                $ten_file_anh_2="";
                                                (new obvervation)->NotificationAndGoback("Ảnh thứ 2 bị trùng!");
                                            }
                                            if ($ten_file_anh_3==$ten_image_array['ten_image']) {
                                                $ten_file_anh_3="";
                                                (new obvervation)->NotificationAndGoback("Ảnh thứ 3 bị trùng!");
                                            }
                                        }
                                    }

                                    //Nếu đổi ảnh -> xóa ảnh cũ để thêm ảnh mới
                                    if ($ten_file_anh_1!="" and $ten_file_anh_1!=$old_image_1) {
                                        //(new obvervation)->Notification("Đổi ảnh 1! ".$old_image_1." -> ".$ten_file_anh_1);
                                        $mysqli->query("delete from hinhanh where ma_dv='$ma_dv' and ten_image='$old_image_1'");
                                        //unlink
                                        $path = '../../img/animals/'.$old_image_1;

                                        chown($path, 666);

                                        if (unlink($path)) {
                                            //(new obvervation)->NotificationAndGoback("Xóa ảnh 1! ".$old_image_1);
                                        } else {
                                            //(new obvervation)->NotificationAndGoback("Ko xóa ảnh 1! ".$old_image_1);
                                        }
                                    }
                                    if ($ten_file_anh_2!="" and $ten_file_anh_2!=$old_image_2) {
                                        //(new obvervation)->Notification("Đổi ảnh 2! ".$old_image_2." -> ".$ten_file_anh_2);
                                        $mysqli->query("delete from hinhanh where ma_dv='$ma_dv' and ten_image='$old_image_2'");
                                        //unlink
                                        $path = '../../img/animals/'.$old_image_2;

                                        chown($path, 666);

                                        if (unlink($path)) {
                                            //(new obvervation)->NotificationAndGoback("Xóa ảnh 2! ".$old_image_2);
                                        } else {
                                            //(new obvervation)->NotificationAndGoback("Ko xóa ảnh 2! ".$old_image_2);
                                        }
                                    }
                                    if ($ten_file_anh_3!="" and $ten_file_anh_3!=$old_image_3) {
                                        //(new obvervation)->Notification("Đổi ảnh 3! ".$old_image_3." -> ".$ten_file_anh_3);
                                        $mysqli->query("delete from hinhanh where ma_dv='$ma_dv' and ten_image='$old_image_3'");
                                        //unlink
                                        $path = '../../img/animals/'.$old_image_3;

                                        chown($path, 666);

                                        if (unlink($path)) {
                                            //(new obvervation)->NotificationAndGoback("Xóa ảnh 3! ".$old_image_3);
                                        } else {
                                            //(new obvervation)->NotificationAndGoback("Ko xóa ảnh 3! ".$old_image_3);
                                        }
                                    }

                                    //Thêm ảnh
                                    if ($ten_file_anh_1!="") {
                                        $mysqli->query("insert into hinhanh value(null,'$ten_file_anh_1',1,'$ma_dv');");

                                        //Thêm file ảnh đã tải lên
                                        $link_anh_1 = "../../img/animals/".$ten_file_anh_1;
                                        move_uploaded_file($_FILES['hinh_anh_1']['tmp_name'],$link_anh_1);
                                    }
                                    if ($ten_file_anh_2!="") {
                                        $mysqli->query("insert into hinhanh value(null,'$ten_file_anh_2',0,'$ma_dv');");

                                        //Thêm file ảnh đã tải lên
                                        $link_anh_2 = "../../img/animals/".$ten_file_anh_2;
                                        move_uploaded_file($_FILES['hinh_anh_2']['tmp_name'],$link_anh_2);
                                    }
                                    if ($ten_file_anh_3!="") {
                                        $mysqli->query("insert into hinhanh value(null,'$ten_file_anh_3',0,'$ma_dv');");

                                        //Thêm file ảnh đã tải lên
                                        $link_anh_3 = "../../img/animals/".$ten_file_anh_3;
                                        move_uploaded_file($_FILES['hinh_anh_3']['tmp_name'],$link_anh_3);
                                    }//

                                    //Table toado: ma_toado,ten_toado,ma_dv
                                    if ($i!=0) {
                                        //Làm sạch tọa độ cũ
                                        $mysqli->query("delete from toado where ma_dv='$ma_dv'");
                                        //Thêm tọa độ mới
                                        for ($j=1; $j<=$i; $j++) {
                                            $tenToaDo = ${"toaDo".$j};
                                            $mysqli->query("insert into toado value(null,'$tenToaDo','$ma_dv');");
                                        }
                                    }

                                    //??? có cần fix lại ngày thêm của CTV ???
                                    
                                    (new obvervation)->NotificationAndGoto("Đã sửa, cảm ơn bạn đã đóng góp!","../../index.php?route=capnhatthongtin");
                                
                                } else {$_SESSION["err"] = "Chưa nhập tọa độ!";}
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