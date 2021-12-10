<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pasien;
use App\Models\User;
use App\Models\DataLab;
use App\Http\Controllers\Helper;

class dataPasienController extends Controller
{
    public function index(Request $r)
    {
        if(!session('user')){
            return view('admin.login');
        } else {
            $dokter = User::where('role',1)->where('status',1)->get();
            $perawat = User::where('role',2)->where('status',1)->get();
            $tlm = User::where('role',3)->where('status',1)->get();
            $dataPasien = Pasien::all();
            return view('admin.data-pasien',compact('dataPasien','dokter','perawat','tlm'));
        }
        
    }

    public function add(Request $r)
    {
        if(!session('user')){
            return view('admin.login');
        } else {
            $insert = Pasien::insert([
                'nama'              => $r->nama,
                'jenis_kelamin'     => $r->gender,
                'umur'              => $r->umur,
                'penyakit'          => $r->penyakit,
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
            $detail = Pasien::where('id_pasien',$id)->first();
            return response()->json($detail);
        }
    }

    public function update(Request $r)
    {
        if(!session('user')){
            return view('admin.login');
        } else {
            $get    = Pasien::where('id_pasien',$r->id)->first();
            $update = Pasien::where('id_pasien',$r->id)->update([
                'nama'          => $r->nama,
                'jenis_kelamin' => $r->gender == 0 ? $get->jenis_kelamin : $r->gender,
                'umur'          => $r->umur,
                'penyakit'      => $r->penyakit
            ]);
    
            return response()->json($update == 1 ? True : False);
        }
    }

    public function cekLab($id)
    {
        if(!session('user')){
            return view('admin.login');
        } else {
            $detail = Pasien::where('id_pasien',$id)->first();
            return response()->json($detail);
        }
    }

    public function addceklab(Request $r)
    {
        if(!session('user')){
            return view('admin.login');
        } else {
            $update = Pasien::where('id_pasien',$r->pasien)->update(['status'=>2]);
            $insert = DataLab::insert([
                'kode_lab'      => 'CL-'.Helper::randomString(),
                'id_pasien'     => $r->pasien,
                'dokter'        => $r->dokter,
                'status'        => 1,
                'creator'       => session('user')['Username'],
                'created_at'    => date('Y-m-d H:i:s'),
                'updated_at'    => date('Y-m-d H:i:s'),
            ]);
    
            return response()->json($insert);
        }
    }
}
