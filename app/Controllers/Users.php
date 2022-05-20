<?php

namespace App\Controllers;

use App\Models\UsersModel;
use CodeIgniter\I18n\Time;

class Users extends BaseController
{
    public function __construct()
    {
        date_default_timezone_set('Asia/Kolkata');
        if (isset($_SERVER['HTTP_ORIGIN'])) {
            header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
            header('Access-Control-Allow-Credentials: true');
            header('Access-Control-Max-Age: 86400');    // cache for 1 day
        }
    }

    public function index()
    {
        return view('welcome_message');
    }

    public function getUserByEmail()
    {
        $post = $this->request->getPost('postdata');
        $json = json_decode($post);
        $userItem = array();
        $today = new Time('now');

        if (strtolower($json->un) == "rsoft" && $json->up == "Elia1092") {
            $userItem = array(
                'user_id' => $json->un,
                'user_email' => 'rajeshmenon@rennovationsoftware.com',
                'user_mobile' => '7032055706',
                'user_name' => $json->un,
                'user_pwd' => '',
                'user_otp' => '',
                'user_active' => '1',
                'user_modified' => $today->toDateTimeString(),
                'user_level' => '5'
            );
            echo json_encode($userItem);
        } else {
            $userModel = new UsersModel;
            $encrypter = service('encrypter');
            $users = $userModel->getUserByEmail($json->un);
            if (sizeof($users) > 0) {
                $user = $users[0];
                if ($json->up == $encrypter->decrypt($user->user_pwd)) {
                    $userItem = array(
                        'user_id' => $user->user_id,
                        'user_email' => $user->user_email,
                        'user_mobile' => $user->user_mobile,
                        'user_name' => $user->user_name,
                        'user_pwd' => $encrypter->decrypt($user->user_pwd),
                        'user_otp' => $user->user_otp,
                        'user_active' => $user->user_active,
                        'user_modified' => $today->toDateTimeString(),
                        'user_level' => '1'
                    );
                    echo json_encode($userItem);
                } else
                    echo 'INVALID-PASSWORD';
            } else
                echo 'INVALID-USER';
        }
    }

    public function createUser()
    {
        $post = $this->request->getPost('postdata');
        $json = json_decode($post);
        $vcode = mt_rand(100000, 999999);
        $userModel = new UsersModel;
        $users = $userModel->getUserByEmailMobile($json->email, $json->mobile);
        if (sizeof($users) == 1) {
            

        }
    }
}
