<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login()
    {
        return view('login_admin');
    }
    public function check(Request $request)
    {
        $this->validate($request , [
            'email'=>'required | email',
            'password'=>'required | min:8'
        ]);

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
