<?php

namespace App\Controllers;

use App\Libraries\Mailer;

class Services extends BaseController
{    

    public function index()
    {
        return view('unauthorized_access');
    }

    // public function testMail() {
    //     $mailer = new Mailer();
    //     $res = $mailer->sendMail('suranju@yahoo.com', 'Welcome Message', 'Hello! How are you?');
    //     echo $res;
    // }
}
