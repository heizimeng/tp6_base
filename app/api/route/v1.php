<?php


use think\facade\Config;
use think\facade\Route;
use think\Response;


Route::group(function (){

    Route::post('index','v1.Index/index');

});


Route::miss(function (){
    if (app()->request->isOptions()) {
        $header = Config::get('cookie.header');
        $header['Access-Control-Allow-Origin'] = app()->request->header('origin');
        return Response::create('ok')->code(200)->header($header);
    } else{
        return Response::create()->code(404);
    }

});