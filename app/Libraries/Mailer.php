<?php

namespace App\Libraries;

class Mailer
{
    public function sendMail($toAddress, $subject, $message)
    {
        $config['protocol'] = 'smtp';
        $config['SMTPHost'] = 'mail.knoxxbox.in';
        $config['SMTPPort'] = '587';
        $config['SMTPUser'] = 'netfin@knoxxbox.in';
        $config['SMTPPass'] = '8Zaf68BudJam';
        $config['mailType'] = 'html';
        $config['charset'] = 'utf-8';
        $config['wordwrap'] = TRUE;
        $config['CRLF'] = "\r\n";

        $email = \Config\Services::email();
        $email->setFrom('netfin@knoxxbox.in', 'Knoxxbox');
        $email->setTo($toAddress);
        $email->setSubject($subject);
        $email->setMessage($message);
        $sent = $email->send();
        if ($sent)
            return 'SUCCESS';
        else
            return $email->printDebugger(['headers']);
    }
}
