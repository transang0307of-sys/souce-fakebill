<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\Exception;
// require_once ($_SERVER['DOCUMENT_ROOT'].'/config/database.php');
// if (!class_exists('DatabaseConnection')) {
//     header('Location: /');
//     exit;
// }
// require $_SERVER['DOCUMENT_ROOT'].'/vendor/autoload.php';
/**
 * WsMailler
 * Telegram: @wus_team
 * Author: Ws.ThanhDieu
 */
class WsMailler 
{
    private $mail;
    private $TD;
    /**
     * __construct
     *
     * @param mixed $TD
     * @return void
     */
    public function __construct($TD) 
    {
        $this->TD = $TD;
    
        $MailUser = $this->TD->Setting('mail-user');
        $MailPass = $this->TD->Setting('mail-pass');

        if (empty($MailUser) || empty($MailPass)) {
            return;
        }
        
    
        $this->mail = new PHPMailer(true);
        $this->mail->CharSet = 'UTF-8';
        try 
        {
            $this->mail->isSMTP();
            $this->mail->Host = 'smtp.gmail.com';
            $this->mail->SMTPAuth = true;
            $this->mail->Username = $MailUser;
            $this->mail->Password = $MailPass;
            $this->mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $this->mail->Port = 587;
            $this->mail->setFrom($MailUser, $this->TD->Setting('name-site'));
            $this->mail->isHTML(true);
        }   catch (\PHPMailer\PHPMailer\Exception $e) 
        {
            return "Mailer Error: {$this->mail->ErrorInfo}";
        }
    }
    
    /**
     * SendMailler
     *
     * @param  mixed $email
     * @param  mixed $subject
     * @param  mixed $body
     * @return bool
     */
    public function SendMailler($email, $subject, $body) 
    {
    if (!$this->mail) {
        error_log("Mailer not initialized – possibly missing SMTP config.");
        return false;
    }

    try {
        $this->mail->clearAddresses();
        $this->mail->addAddress($email,'Member');
        $this->mail->Subject = $subject; 
        $this->mail->Body = $body;
        $this->mail->send();
        return true;
    } catch (\PHPMailer\PHPMailer\Exception $e) {
        error_log("Mailer error: " . $e->getMessage());
        return false;
    }
    }
    private function __getuserData() 
    {
        global $thanhdieudb;
        $WT = $thanhdieudb->query("SELECT email, hovaten FROM users WHERE email IS NOT NULL");
        $userData = [];
        while ($OoO = $WT->fetch_assoc()) 
        {
            $userData[] = $OoO;
        }
        return $userData;
    }
    /**
     * ForgotPassword
     *
     * @param  mixed $email
     * @param  mixed $link
     * @return void
     */
    public function ForgotPassword($email, $link) 
    {
        global $website_domain;
        $subject = 'Bạn đang yêu cầu khôi phục tài khoản trên '.capitalize($website_domain).'';
        ob_start();
        include $_SERVER['DOCUMENT_ROOT'].'/function/insert/mailler/forgot-email.php';
        $body = ob_get_clean();
        return $this->SendMailler($email, $subject, $body);
    }    
    /**
     * Method NotifyChangePw
     *
     * @param $email $email []
     * @param $time_change $time_change []
     * @param $ip_change $ip_change []
     * @param $device_change $device_change []
     *
     * @return void
     */
    public function NotifyChangePw($email,$time_change,$ip_change,$device_change) 
    {
        global $website_domain, $domain;
        $subject = 'Mật khẩu của bạn trên nền tảng '.capitalize($website_domain).' đã được thay đổi';
        ob_start();
        include $_SERVER['DOCUMENT_ROOT'].'/function/insert/mailler/notify-change-pw.php';
        $body = ob_get_clean();
        return $this->SendMailler($email, $subject, $body);
    }        
    /**
     * Method Confirm Email
     *
     * @param $email $email []
     * @param $link $link []
     *
     * @return void
     */
    public function ConfirmEmail($email, $link) 
    {
        global $domain,$user,$website_domain;
        $subject = 'Vui lòng xác minh địa chỉ email trên nền tảng ['.capitalize($website_domain).']';
        ob_start();
        include $_SERVER['DOCUMENT_ROOT'].'/function/insert/mailler/confirm-email.php';
        $body = ob_get_clean();
        return $this->SendMailler($email, $subject, $body);
    }    
}
$WsMailler = new WsMailler($TD);
