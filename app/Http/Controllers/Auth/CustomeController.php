<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomeController extends Controller
{
    public function adualt(){
        return view('customeAuth.index');
    }

    public function site(){
        return view('site');
    }

    public function admin(){
        return view('admina');
    }

    public function adminLogin(){
        return view('auth.adminLogin');
    }

    public function checkAdminLogin(Request $request){
        $this->validate($request, [
            'email'   => 'required|email',
            'password' => 'required|min:6'
        ]);
        if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password])) {

            return redirect()->intended('/admina');
        }
        return back()->withInput($request->only('email'));
    }
}
