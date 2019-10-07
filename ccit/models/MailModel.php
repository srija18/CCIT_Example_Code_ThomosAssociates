<?php

class MailModel extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->SmtpServer = "127.0.0.1";
        $this->SmtpPort = "25";
        $this->newLine = "\r\n";
    }

    private function noReplyCredentials() {
        $this->from = "accounts@ccitinc.com";
        $this->SmtpUser = base64_encode("accounts@ccitinc.com");
        $this->SmtpPass = base64_encode("Dollarhills1600");
    }

    public  function SendMail($to, $subject, $body, $reply = '') {

        $this->noReplyCredentials();
        $this->to = $to;
        $this->subject = $subject;
        $this->body = $body;

        if ($this->SmtpPort == "") {
            $this->PortSMTP = 25;
        } else {
            $this->PortSMTP = $this->SmtpPort;
        }

        // echo $this->from.'---'.$this->SmtpServer.'---'.$this->PortSMTP; 

        if ($SMTPIN = fsockopen($this->SmtpServer, $this->PortSMTP)) {
            fputs($SMTPIN, "EHLO " . $this->SmtpServer . $this->newLine);
            $talk["hello"] = fgets($SMTPIN, 1024);

            fputs($SMTPIN, "auth login". $this->newLine);
            $talk["res"] = fgets($SMTPIN, 1024);

            fputs($SMTPIN, $this->SmtpUser . $this->newLine);
            $talk["user"] = fgets($SMTPIN, 1024);

            fputs($SMTPIN, $this->SmtpPass . $this->newLine);
            $talk["pass"] = fgets($SMTPIN, 256);

            fputs($SMTPIN, "MAIL FROM: <" . $this->from . ">". $this->newLine);
            $talk["From"] = fgets($SMTPIN, 1024);

            fputs($SMTPIN, "RCPT TO: <" . $this->to . ">". $this->newLine);
            $talk["To"] = fgets($SMTPIN, 1024);
            
            fputs($SMTPIN, "RCPT TO: <info@cubsvet.com>". $this->newLine);
            $talk["Bcc"] = fgets($SMTPIN, 1024);

            fputs($SMTPIN, "DATA\r\n");
            $talk["data"] = fgets($SMTPIN, 1024);

            $headers = "MIME-Version: 1.0" . $this->newLine;
            $headers .= "Content-type: text/html; charset=iso-8859-1" . $this->newLine;
            $headers .= "From: ccitinc.com <" . $this->from . ">" . $this->newLine;
            $headers .= "To: " . $this->to . " <" . $this->to . ">" . $this->newLine;
            $headers .= "Bcc: ccitinc.com <accounts@ccitinc.com>" . $this->newLine;
            $headers .= "Subject: " . $this->subject . $this->newLine;

            fputs($SMTPIN, $headers . "\r\n\r\n" . $this->body . "\r\n.\r\n");
            $talk["send"] = fgets($SMTPIN, 256);

            //CLOSE CONNECTION AND EXIT ... 

            fputs($SMTPIN, "QUIT\r\n");
            fclose($SMTPIN);
            //  
        }

        return $talk;
    }

    function forgotPassword($param) {
        $body = $this->load->view('mail/forget-password', $param, TRUE);
        $subject = "New Password for Login- ccitinc.com";
        $to = $param['to'];
        if ($this->SendMail($to, $subject, $body)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    function emailVerification($param) {
        $body = $this->load->view('mails/welcome', $param, TRUE);
        $subject = "Congratulations you have successfully registered with - Cubsvet.com";
        $to = $param['email'];
        if ($this->SendMail($to, $subject, $body)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    function sendVoucher($param) {
        $body = $this->load->view('mail/mail-voucher', $param, TRUE);
        $subject = "Your booking Invoice - ".$param['requestDetails']->transId." - ccitinc.com";
        $to = $param['requestDetails']->email;
        if ($this->SendMail($to, $subject, $body)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
    function sendNewUser($param) {
        $body = $this->load->view('mail/mail-voucher', $param, TRUE);
        $subject = "Thank you for Registering with Ushodhaya Matrimonial.Com ..Keep Secure Your Credentials - ccitinc.com";
        $to =$param['requests']['username'];
        if ($this->SendMail($to, $subject, $body)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
        function sendContactUs($param) {
        $body = $this->load->view('mail/contactus-mail', $param, TRUE);
        $subject = $param['subject'];
        $to ='accounts@ccitinc.com';
        if ($this->SendMail($to, $subject, $body)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
        function sendMessage($param) {
          
        $body = $this->load->view('mail/message-mail', $param, TRUE);
        $subject = "Thank for Contact us My Ushodaya - ccitinc.com";
        $to =$param['email'];
        if ($this->SendMail($to, $subject, $body)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

}
