<?php
Route::group(['prefix' => 'entry','namespace' => 'Entry'], function () {
    //用户登录界面
    Route::get('/login','LoginController@loginForm');
    //用户登录
    Route::post('/login','LoginController@login');
    //退出登录
    Route::get('/logout','LoginController@logout');

    //修改密码界面
    Route::get('/resetPassword','ResetPasswordController@resetPasswordForm');
    //修改密码
    Route::post('/resetPassword','ResetPasswordController@resetPassword');


    //忘记密码界面
    Route::get('/forgotPassword','ForgotPasswordController@ForgotPasswordForm');
    //重置密码
    Route::post('/resetPassword','ForgotPasswordController@resetPassword');

    //注册界面
    Route::get('/register','RegisterController@registerForm');
    //注册
    Route::post('/register','RegisterController@register');

});



