<?php

namespace App\Http\Controllers\Entry;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ResetPasswordController extends Controller
{
    public function resetPasswordForm()
    {
        return view('entry.resetPassword');
    }

    public function resetPassword(Request $request)
    {

    }
}
