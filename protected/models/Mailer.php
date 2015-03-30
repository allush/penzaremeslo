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

        include_once Yii::app()->basePath . '/components/phpmailer/class.phpmailer.php';

        $mail = new PHPMailer();

        $mail->CharSet = 'utf-8';
        $mail->Subject = $subject;
        $mail->AltBody = '';

        $mail->IsSMTP();
        $port = ini_get('smtp_port');
        $mail->Port = empty($port) ? 25 : (int)$port;
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

            if (!$mail->Send())
                return false;
        }

        return true;
    }
} 