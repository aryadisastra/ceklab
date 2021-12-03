<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class LoginController extends Controller
{
    public function index()
    {
        if(!session('user')){
            return view('admin.login');
        } else {
            return view('admin.dashboard');
        }
    }

    public function login(Request $r)
    {
        $username = $r->username;
        $pwd      = md5(sha1(md5($r->pwd)));
        $cekUser  = User::where('username',$username)
                    ->where('password',$pwd)
                    ->where('status',1)
                    ->first();
        if($cekUser){
            session(['user' => [
                    'Username'  => $cekUser->username,
                    'nama'      => $cekUser->nama,
                    'gender'    => $cekUser->jenis_kelamin,
                    'role'      => $cekUser->role,
                ]
            ]);
            return view('admin.dashboard');
        } else {
            return view('admin.login');
        }
    }

    public function logout(Request $r)
    {
        $r->session()->forget('user');
        return view('admin.login');
    }
}
