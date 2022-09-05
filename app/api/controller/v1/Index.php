<?php
namespace app\api\controller\v1;

use app\Request;
use think\facade\Db;

class Index{


    public function index(Request $request){

        $request->more([["name"],['age','','trim'],['pid', 0, '', 'cid']]);


        return 1;
    }



}