<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function login(){
        return view('admin.login');
    }

    public function check(Request $request){
        $this->validate($request,[
            'email'=>'required|email|exists:admins,email',
            'password'=>'required|min:5|max:30',
        ]);


        $creds = $request->only('email', 'password');

        if(Auth::guard('admin')->attempt($creds)){
            return redirect()->route('admin.dashboard');
        } else {
            return redirect()->back()->with('fail', __('notifications.ERROR.Check your email and password'));
        }
    }

    public function dashboard(){
        return view('admin.dashboard');
    }
}
