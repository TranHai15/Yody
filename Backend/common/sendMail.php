<?php


require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

function sendMail($to, $subject, $content)
{


    $mail = new PHPMailer(true);

    try {
        // Server settings
        $mail->SMTPDebug = SMTP::DEBUG_SERVER; // Hiển thị lỗi chi tiết
        $mail->isSMTP(); // Gửi email qua SMTP
        $mail->Host       = 'smtp.gmail.com'; // Máy chủ SMTP Gmail
        $mail->SMTPAuth   = true; // Bật xác thực SMTP
        $mail->Username   = 'hai@gmail.com'; // Địa chỉ email đúng
        $mail->Password   = 'lltynteajmyehvfp'; // Mật khẩu ứng dụng
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->Port       = 465;

        // Recipients
        $mail->setFrom('hairobet15092005@gmail.com', 'Hai'); // Email và tên hiển thị
        $mail->addAddress($to); // Email người nhận

        // Content
        $mail->isHTML(true); // Gửi email định dạng HTML
        $mail->Subject = $subject;
        $mail->Body    = $content;

        $mail->send();
        echo 'Gửi thành công';
    } catch (Exception $e) {
        echo "Gửi email thất bại. Lỗi: {$mail->ErrorInfo}";
    }
}
// sendMail('recipient@example.com', 'Tiêu đề kiểm tra', 'Đây là nội dung thử nghiệm!');