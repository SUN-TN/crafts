<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\AdminPost;
use Illuminate\Support\Facades\Auth;

class AdminController extends MasterController
{

    //修改密码界面
    public function passwordForm(){
        return view('admin.passwordForm');
    }

    //修改密码
    public function changePassword(AdminPost $request){
        $model=Auth::guard('admin')->user();
        $model->password = bcrypt($request['password']);
        $model->save();
        Auth::guard('admin')->logout();
        return redirect('/admin/login')->with('note','密码已修改请重新登录');

    }
}
