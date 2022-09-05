<?php



use think\facade\Route;


Route::group(function (){

    Route::get('index','v1.Index/index');

});