<?php
// +----------------------------------------------------------------------
// | JuZi [ 🍊橘子科技🍊 ]
// +----------------------------------------------------------------------
// | Copyright (c) 2022~2022  All rights reserved.
// +----------------------------------------------------------------------
// | Author: JuZi Team 
// +----------------------------------------------------------------------
namespace app\services;

abstract class BaseServices
{

    //模型注入
    protected $dao;



    public function __call($name, $arguments)
    {
        return call_user_func_array([$this->dao, $name], $arguments);
    }
}