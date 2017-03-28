<?php

class Mailer
{

    private static $adminEmail = 'aka.shams@gmail.com';


    public static function messageMail($from, $subject, $message, $date) {

        $to = self::$adminEmail;

        $messageSubject = 'New message added! From: ' . $from;

        $messageBody = '<h3><b>' . $subject .'</b></h3><p>' . $message . '</p><p>Added at:' . $date . '</p>' ;

        $mail = mail($to, $messageSubject, $messageBody );

        return $mail;
    }


//    public static function commentMail($from, $subject, $message, $date) {
//
//        $to = self::$adminEmail;
//
//        $commentSubject = 'New comment added! From: ' . $from;
//
//        $commentBody = '<h3><b>' . $subject .'</b></h3><p>' . $message . '</p><p>Added at:' . $date . '</p>' ;
//
//        $mail = mail($to, $commentSubject, $commentBody );
//
//        return $mail;
//    }

}