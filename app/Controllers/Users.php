<?php

namespace App\Controllers;

use App\Models\UsersModel;
use App\Libraries\Utility;
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

    /**
     * FOR BUSINESS LOGIN
     * @param String email Email Address
     * @return json user entity 
     */
    public function getUserByEmail()
    {
        $post = $this->request->getPost('postdata');
        $json = json_decode($post);
        $userItem = array();
        $today = new Time('now');
        $userModel = new UsersModel;
        $users = $userModel->getUserByEmail($json->email);
        if (sizeof($users) > 0) {
            $user = $users[0];
            $userItem = array(
                'user_id' => $user->user_id,
                'user_email' => $user->user_email,
                'user_mobile' => $user->user_mobile,
                'user_name' => $user->user_name,
                'user_pwd' => $user->user_pwd,
                'user_otp' => $user->user_otp,
                'user_active' => $user->user_active,
                'user_modified' => $today->toDateTimeString()
            );
            echo json_encode($userItem);
        } else {
            echo 'INVALID USER';
        }
    }
    /**
     * FOR BUSINESS CREATE USER
     * @param String email Email Address
     * @param String mobile Mobile Number
     * @param String name Full Name
     * @param String pwd Encrypted password
     */
    public function createUser()
    {
        $post = $this->request->getPost('postdata');
        $json = json_decode($post);
        $vcode = mt_rand(100000, 999999);
        $userModel = new UsersModel;
        $users = $userModel->getUserByEmail($json->email);
        if (sizeof($users) == 1) {
            echo 'USER ALREADY EXISTS';
        } else {

        }
    }
}
