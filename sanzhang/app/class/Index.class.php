<?php
Class Index
{
    public function test()
    {
        echo 123;
    }

    public function testSmtp()
    {
        require_once LIB_DIR . "Helper/smtp.php";
        //使用163邮箱服务器
        $smtpserver = "smtp.qq.com";
        //163邮箱服务器端口 
        $smtpserverport = 465;
        //你的163服务器邮箱账号
        $smtpusermail = "435800667@qq.com";
        //收件人邮箱
        $smtpemailto = "frankz@eyebuydirect.com";
        //你的邮箱账号(去掉@163.com)
        $smtpuser = "435800667";//SMTP服务器的用户帐号 
        //你的邮箱密码
        $smtppass = "gpxxpijoknmpcbcc"; //SMTP服务器的用户密码 
        //邮件主题 
        $mailsubject = "测试邮件发送";
        //邮件内容 
        $mailbody = "PHP+MySQL";
        //邮件格式（HTML/TXT）,TXT为文本邮件 
        $mailtype = "TXT";
        //这里面的一个true是表示使用身份验证,否则不使用身份验证. 
        $smtp = new smtp($smtpserver,$smtpserverport,false,$smtpuser,$smtppass);
        //是否显示发送的调试信息 
        $smtp->debug = TRUE;
        //发送邮件
        $smtp->sendmail($smtpemailto, $smtpusermail, $mailsubject, $mailbody, $mailtype);
        exit;
    }
}
?>