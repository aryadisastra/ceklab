<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class dataTlmController extends Controller
{
    public function index(Request $r)
    {
        if(!session('user')){
            return view('admin.login');
        } else {
            $dataUser = User::where('role',3)->get();
            return view('admin.data-tlm',compact('dataUser'));
        }
        
    }

    public function add(Request $r)
    {
        if(!session('user')){
            return view('admin.login');
        } else {
            $insert = User::insert([
                'username'          => $r->username,
                'password'          => md5(sha1(md5($r->password))),
                'nama'              => $r->nama,
                'jenis_kelamin'     => $r->gender,
                'no_hp'             => $r->nohp,
                'role'              => 3,
                'status'            => 1,
                'created_at'        => date('Y-m-d H:i:s'),
                'updated_at'        => date('Y-m-d H:i:s'),
            ]);
    
            return response()->json($insert);
        }
    }

    public function detail($id)
    {
        if(!session('user')){
            return view('admin.login');
        } else {
            $detail = User::where('username',$id)->first();
            return response()->json($detail);
        }
    }

    public function update(Request $r)
    {
        if(!session('user')){
            return view('admin.login');
        } else {
            $get    = User::where('username',$r->username)->first();
            $update = User::where('username',$r->username)->update([
                'username'          => $r->username,
                'password'          => isset($r->password) ? md5(sha1(md5($r->password))) : $get->password ,
                'nama'              => $r->nama,
                'jenis_kelamin'     => isset($r->gender) ? $r->gender : $get->jenis_kelamin,
                'no_hp'             => $r->nohp,
                'role'              => 3,
                'status'            => $r->status,
                'updated_at'        => date('Y-m-d H:i:s'),
            ]);
    
            return response()->json($update == 1 ? True : False);
        }
    }
}
