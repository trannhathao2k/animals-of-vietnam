<?php
class obvervation extends DB{
    function kiemTraTenTK($ten){
        $sql = "select * from obvervation where uname='".$ten."'";
        $data = $this->query($sql);
        if(count($data)>0) return true; else return false;
    }
    function kiemTraEmail($e){
        $sql = "select * from obvervation where email_ctv='".$e."'";
        $data = $this->query($sql);
        if(count($data)>0) return true; else return false;
    }
    function them($tentk, $mk, $ten, $email, $sdt){
        $sql = "insert into obvervation(hoten_ctv, uname, passwd, email_ctv, sdt) 
                values ('$ten','$tentk','$mk','$email',$sdt)";
        $this->query($sql);
    }
    function ktDangNhap($u, $p){
        $sql = "select * from obvervation where uname='".$u."' and passwd='$p'";
        $data = $this->query($sql);
        if(count($data)>0) return $data[0]; else return false;
    }
    function datlaiMK($mk, $e){
        $sql = "update obvervation set passwd='$mk' where email_ctv='$e'";
        $this->query($sql);
    }

    function execute($sql) {
        $this->query($sql);
    }

    function NotificationAndGoto($notification_str, $goto) {
        ?>
            <html>
                <head>
                    <meta charset="utf-8">
                    <title>Thông báo</title>
                </head>

                <body>
                    <script type="text/javascript">
                        alert("<?php echo $notification_str; ?>");
                        window.location = "<?php echo $goto; ?>";
                    </script>
                </body>
            </html>
        <?php
        exit();
    }  
    function NotificationAndGoback($notification_str) {
        ?>
            <html>
                <head>
                    <meta charset="utf-8">
                    <title>Thông báo</title>
                </head>

                <body>
                    <script type="text/javascript">
                        alert("<?php echo $notification_str; ?>");
                        window.history.back();
                    </script>
                </body>
            </html>
        <?php
        exit();
    }  
}

?>