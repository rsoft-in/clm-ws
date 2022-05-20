<?php

namespace App\Libraries;

class Mailer
{
    public function sendMail($toAddress, $subject, $message)
    {
        $config['protocol'] = 'smtp';
        $config['SMTPHost'] = 'mail.knoxxbox.in';
        $config['SMTPPort'] = '587';
        $config['SMTPUser'] = 'sales@knoxxbox.in';
        $config['SMTPPass'] = 'Godzilla0410';
        $config['mailType'] = 'html';
        $config['charset'] = 'utf-8';
        $config['wordwrap'] = TRUE;
        $config['CRLF'] = "\r\n";

        $email = \Config\Services::email();
        $email->setFrom('sales@knoxxbox.in', 'Knoxxbox');
        $email->setTo($toAddress);
        $email->setSubject($subject);
        $email->setMessage($message);
        $email->send();
        return $email->printDebugger(['headers']);
    }
}
