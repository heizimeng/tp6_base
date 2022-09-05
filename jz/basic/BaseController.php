<?php
// +----------------------------------------------------------------------
// | JuZi [ 🍊橘子科技🍊 ]
// +----------------------------------------------------------------------
// | Copyright (c) 2022~2022  All rights reserved.
// +----------------------------------------------------------------------
// | Author: JuZi Team 
// +----------------------------------------------------------------------
namespace jz\basic;

use think\App;

abstract class BaseController
{
    /**
     * Request实例
     * @var \app\Request
     */
    protected $request;

    /**
     * 应用实例
     * @var \think\App
     */
    protected $app;

    public function __construct(App $app)
    {
        $this->app     = $app;
        $this->request = app('request');
        $this->initialize();
    }


    abstract protected function initialize();

}