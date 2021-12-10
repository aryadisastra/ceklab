<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDF;
use App\Models\DataLab;

class PasienLabController extends Controller
{
    public function getPdf(Request $r)
    {
        $data = DataLab::where('kode_lab',$r->kode)->first();
        if($data->status != 1)
        {
            $data->status = 3;
            $data->save();
            view()->share('data', $data);
            $pdf_doc = PDF::loadView('pdf.hasil_lab', $data);
    
            return $pdf_doc->download(DataLab::generateNameImages().'.pdf');
        } else {
            return redirect('/')->withErrors(['msg' => 'Data Yang Anda Minta Tidak Ada Atau Belum Selesai']);
        }
    }
}
