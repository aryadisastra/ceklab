<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DataLab;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\CustomEnv;
use App\Models\Pasien;

class dataLabController extends Controller
{
    public function index(Request $r)
    {
        if(!session('user')){
            return view('admin.login');
        } else {
            $fetch = [];
            $dataLab = DataLab::where('dokter',session('user')['Username'])
                        ->orWhere('perawat', session('user')['Username'])
                        ->orWhere('tlm', session('user')['Username'])
                        ->get();
            foreach($dataLab as $dt)
            {
                $fetch[] = [
                    'kode'          => $dt->kode_lab,
                    'status'        => $dt->status,
                    'tanggal'       => date('d M Y', strtotime($dt->created_at)),
                    'pasien'        => $dt->pasien->nama,
                    'gender'        => $dt->pasien->jenis_kelamin == 1 ? 'Laki-Laki' : 'Perempuan',
                    'umur'          => $dt->pasien->umur,
                    'penyakit'      => $dt->pasien->penyakit,
                    'hasil'         => $dt->hasil_lab,
                    'bukti'         => $dt->bukti_lab,
                    'dokter'        => $dt->dokterVal->nama,
                ];
            }
            return view('admin.data-lab',compact('fetch'));
        }

    }

    public function detailLab($id)
    {
        if(!session('user')){
            return view('admin.login');
        } else {
            $fetch = [];
            $detail = DataLab::where('kode_lab',$id)->first();
            $fetch = [
                'kode'          => $detail->kode_lab,
                'status'        => $detail->status,
                'tanggal'       => date('d M Y', strtotime($detail->created_at)),
                'pasien'        => $detail->pasien->nama,
                'gender'        => $detail->pasien->jenis_kelamin == 1 ? 'Laki-Laki' : 'Perempuan',
                'umur'          => $detail->pasien->umur,
                'penyakit'      => $detail->pasien->penyakit,
                'hasil'         => $detail->hasil_lab,
                'bukti'         => $detail->bukti_lab,
                'dokter'        => $detail->dokterVal->nama,
            ];
            return response()->json($fetch);
        }
    }

    public function updateLab(Request $r)
    {
        if(!session('user')){
            return view('admin.login');
        } else {
            try{
                DB::beginTransaction();
                $files = $r->file('img');
                if($r->hasFile('img')){
                    foreach ($files as $file) {
                        $filename = $file->getClientOriginalName();
                        $imageExt =  $file->getClientOriginalExtension();
                        $update = DataLab::where('kode_lab',$r->kode)->first();
                        $file_name_convert = DataLab::generateNameImages();
                        $images_true = $file_name_convert.'.'.$imageExt;

                        $custom_env = new CustomEnv();
                        $pushCustomEnv = $custom_env->moveImage($file, $images_true);

                        if($pushCustomEnv !== false) {
                            $update->status      = 2;
                            $update->hasil_lab   = $r->hasil;
                            $update->bukti_lab   = $images_true;
                        }
                    }
                }
                $updatePasien = Pasien::where('id_pasien',$update->id_pasien)->first();
                $updatePasien->status = 3;
                $updatePasien->save();
                $update->save();
                DB::commit();
                return redirect('/data-lab');
            } catch(Exception $e)
            {
                DB::rollback();
                return redirect('/data-lab');
            }
        }
    }
}
