<?php
require "PHPMailer-master/src/PHPMailer.php"; 
require "PHPMailer-master/src/SMTP.php"; 
require 'PHPMailer-master/src/Exception.php'; 
$mail = new PHPMailer\PHPMailer\PHPMailer(true);//true:enables exceptions
try {
    $mail->SMTPDebug = 0; //0,1,2: chế độ debug
    $mail->isSMTP();  
    $mail->CharSet  = "utf-8";
    $mail->Host = 'smtp.gmail.com';  //SMTP servers
    $mail->SMTPAuth = true; // Enable authentication
    $mail->Username = 'phamhonglinh001@gmail.com'; // SMTP username
    $mail->Password = 'password';   // SMTP password
    $mail->SMTPSecure = 'ssl';  // encryption TLS/SSL 
    $mail->Port = 465;  // port to connect to                
    $mail->setFrom('phamhonglinh001@gmail.com', 'Admin' ); 
    $mail->addAddress($_POST["email"], 'Người dùng'); 
    $mail->isHTML(true);  // Set email format to HTML
    $mail->Subject = 'Mã xác nhận reset mật khẩu';
    $noidungthu = 'Hãy nhập mã xác nhận: '.$mknn.' để tạo lại mật khẩu'; 
    $mail->Body = $noidungthu;
    $mail->smtpConnect( array(
        "ssl" => array(
            "verify_peer" => false,
            "verify_peer_name" => false,
            "allow_self_signed" => true
        )
    ));
    $mail->send();
} catch (Exception $e) {
    echo 'Error: ', $mail->ErrorInfo;
}

?>