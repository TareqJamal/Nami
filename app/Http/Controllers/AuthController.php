<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login()
    {
        return view('login_admin');
    }
    public function check(AuthRequest $request)
    {
        if(Auth::guard('admin')->attempt(['email' => $request->email , 'password' => $request->password ]))
        {
            return redirect('/admins');
        }
        else
        {
            return redirect()->back();
        }

    }
}
