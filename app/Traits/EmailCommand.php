<?php


namespace App\Traits;


trait EmailCommand
{


    public function sendEmail($to,$message,$subject)
    {
        $headers = "From: Zhanbolat Academy <support@zhanbolat.academy>\r\nContent-type: text/html; charset=utf-8 \r\n";
        if(mail ($to, $subject, $message, $headers)) return true;
        return false;
    }

    public function generatePassword($length = 8)
    {
        $chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        $count = mb_strlen($chars);

        for ($i = 0, $result = ''; $i < $length; $i++) {
            $index = rand(0, $count - 1);
            $result .= mb_substr($chars, $index, 1);
        }

        return $result;
    }
}
