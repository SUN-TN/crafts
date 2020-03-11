<?php
Route::group(['prefix' => 'admin','namespace' => 'Admin'], function () {
    //后台登录界面
    Route::get('/login','LoginController@loginForm');
    //后台登录
    Route::post('/login','LoginController@login');
    //后台界面
    Route::get('/index','LoginController@index');
    //退出登录
    Route::get('/logout','LoginController@logout');

    //修改密码界面
    Route::get('/changePassword','AdminController@passwordForm');
    //修改密码
    Route::post('/changePassword','AdminController@changePassword');

    //商品管理-商品信息管理
    //以get方式时此路由时 访问控制器中的index方法
    //以post方式时此路由时 访问控制器中的store方法
    //  /goods/create/  访问控制器中create方法



    Route::resource('/goods','GoodsController');

    Route::resource('/genres','GenresController');

});



