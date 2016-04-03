<?php

/**
 * Created by PhpStorm.
 * User: alexey
 * Date: 11.02.14
 * Time: 11:08
 */
class Mailer
{
    /**
     * @param $emails
     * @param $subject
     * @param $content
     * @param null $files
     * @return bool
     * @throws CException
     * @throws Exception
     * @throws phpmailerException
     */
    public static function send($emails, $subject, $content, $files = null)
    {
        set_time_limit(0);

        $mail = new PHPMailer();

        $mail->Host = $_ENV['MAIL_HOST'];
        $mail->Port = $_ENV['MAIL_PORT'];

        $mail->CharSet = 'utf-8';
        $mail->Subject = $subject;
        $mail->AltBody = '';

        $mail->IsSMTP();
        $mail->SMTPOptions = array(
            'ssl' => array(
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true
            )
        );
        $mail->SetLanguage('ru');
        $mail->SetFrom('info@penzaremeslo.ru', Yii::app()->name);
        $mail->MsgHTML($content);

        if ($files and is_array($files)) {
            foreach ($files as $path => $name) {
                $mail->AddAttachment($path, $name);
            }
        }

        foreach ($emails as $email) {
            $mail->ClearAddresses();

            $email = trim($email);
            $mail->AddAddress($email);

            if (!$mail->Send()) {
                $mail->ErrorInfo;
                return false;
            }
        }

        return true;
    }
} 