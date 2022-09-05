<?php
// +----------------------------------------------------------------------
// | JuZi [ 🍊橘子科技🍊 ]
// +----------------------------------------------------------------------
// | Copyright (c) 2022~2022  All rights reserved.
// +----------------------------------------------------------------------
// | Author: JuZi Team 
// +----------------------------------------------------------------------
namespace app\dao;

abstract class BaseDao
{

    /*
     * 设置当前模型
     */
    abstract protected function setModel():string;



    //获取模型
    protected function getModel(){
        return app()->make($this->setModel());
    }

}