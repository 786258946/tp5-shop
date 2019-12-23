<?php

namespace app\user\controller;

use think\Db;
// use think\Session;
use think\Config;

class LoginApi extends Base
{
    public $oauth;

    public function _initialize() {
        parent::_initialize();
        session('?users_id');
        $this->oauth = input('param.oauth/s');
        if (!$this->oauth) {
            $this->error('非法操作', url('user/Users/login'));
        }
    }

    public function login(){
        $this->error('该功能尚未开放', url('user/Users/login'));
    }

    public function callback()
    {

    }
}