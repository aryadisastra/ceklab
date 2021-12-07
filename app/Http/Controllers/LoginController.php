<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\DataLab;
use Illuminate\Support\Facades\DB;

class LoginController extends Controller
{
    public function index()
    {
        if(!session('user')){
            return view('admin.login');
        } else {
            $data = DataLab::all();
            $fetch = [];
            foreach($data as $dt)
            {
                $fetch [] = [
                    'pasien'           => ucWords($dt->pasien->nama),
                    'umur'             => $dt->pasien->umur,
                    'gender'           => $dt->pasien->jenis_kelamin == 1 ? 'Laki-Laki' : 'Perempuan',
                    'hasil'            => $dt->hasil_lab,
                    'status_angka'     => $dt->status,
                    'dokter'           => ucWords($dt->dokterVal->nama),
                    'status'           => $dt->status == 1 ? 'Belum Diproses' : ($dt->status == 2 ? 'Menunggu Konfirmasi Pasien' : 'Selesai')
                ];
            }
            return view('admin.dashboard',compact('fetch'));
        }
    }

    public function getData()
    {
        $data = DataLab::select(
                DB::raw('COUNT(*) as total'),
                DB::raw('SUM(case when status = 1 then 1 else 0 end) as belum'),
                DB::raw('SUM(case when status = 2 then 1 else 0 end) as menunggu'),
                DB::raw('SUM(case when status = 3 then 1 else 0 end) as selesai')
            )
            ->get();
        $fetch = [];
        foreach($data as $dt)
        {
            $fetch[] = [
                'total'     => $dt->total,
                'belum'     => $dt->belum,
                'menunggu'  => $dt->menunggu,
                'selesai'   => $dt->selesai,
            ];
        }
        return response()->json($fetch);
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
