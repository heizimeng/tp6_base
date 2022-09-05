<?php
// +----------------------------------------------------------------------
// | JuZi [ 🍊橘子科技🍊 ]
// +----------------------------------------------------------------------
// | Copyright (c) 2022~2022  All rights reserved.
// +----------------------------------------------------------------------
// | Author: JuZi Team 
// +----------------------------------------------------------------------
namespace app\manage\controller;

use jz\basic\BaseController;
use think\App;

class Login extends AuthController
{

    public function __construct(App $app)
    {
        parent::__construct($app);
    }


    public function login(){

        var_dump(time());
    }

}