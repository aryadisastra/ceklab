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
        $fetch = [];
        $data1 = DataLab::select(DB::raw('COUNT(*) as total'))->first();
        $data2 = DataLab::select(DB::raw('COUNT(*) as belum'))->where('status',1)->first();
        $data3 = DataLab::select(DB::raw('COUNT(*) as menunggu'))->where('status',2)->first();
        $data4 = DataLab::select(DB::raw('COUNT(*) as selesai'))->where('status',3)->first();
        $total = $data1->total;
        $belum = $data2->belum;
        $menunggu = $data3->menunggu;
        $selesai = $data4->selesai;
        $fetch[] = [
            'total'     => $total,
            'belum'     => $belum,
            'menunggu'  => $menunggu,
            'selesai'   => $selesai,
        ];
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
            return redirect('/dashboard');
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
