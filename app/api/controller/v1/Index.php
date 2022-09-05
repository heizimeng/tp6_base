<?php
namespace app\api\controller\v1;

use think\facade\Db;

class Index{


    public function index(){


        Db::name('user')->select();
        return 1;
    }



}