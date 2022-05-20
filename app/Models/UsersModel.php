<?php

namespace App\Models;

use CodeIgniter\Model;

class UsersModel extends Model {
    protected $table = 'users';

    public function getUsers($filter, $sortBy, $pageNo, $pageSize)
    {
        $result = $this->builder()->select('*')
            ->where('(1=1) ' . $filter)
            ->orderBy($sortBy)
            ->limit($pageNo, $pageSize)
            ->get()->getResult();
        return $result;
    }

    public function getUserByEmail($user_email)
    {
        $result = $this->builder()->select('*')
            ->where('user_email', $user_email)
            ->get()->getResult();
        return $result;
    }

    public function getUserByEmailMobile($user_email, $user_mobile)
    {
        $result = $this->builder()->select('*')
            ->where('user_email', $user_email)
            ->orWhere('user_mobile', $user_mobile)
            ->get()->getResult();
        return $result;
    }
}