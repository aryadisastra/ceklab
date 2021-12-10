<html>
 <head>
  <title> Laboratorium Result Check</title>
 </head>

 <body bgcolor="white">
  <font face="Arial" color="black"> <p align="center"> PEMERINTAH KOTA CIMAHI </p></font>
  <font face="Arial" color="blue"> <p align="center"> DINAS KESEHATAN </p></font>
  <font face="Arial" color="green"> <p align="center"> UNIVERSITAS JENDERAL ACHMAD YANI </p></font>
  <font face="Arial" color="black" size="3"> <p align="center"> JL. TERUSAN JEND SUDIRMAN Telp.(022) 6631622 </p></font>
  <hr>

  <font face="Arial" color="red" size="6"> <p align="center"> <u> <b> SURAT KETERANGAN HASIL LAB </b></u></font><br>
  <!-- <font face="Arial" color="red" size="4"> Nomer: 8021/SMKN1/2015 </p></font> -->






  <p align="center">
   Berdasarkan Hasil Pengujian Lab Dan Fakta Yang kami Periksa, Maka kami Menuliskan
   Hasil Seperti Yang Tertera Dibawah:
  </p>


    <pre>
    Nama  : {{$data->pasien->nama}}


    Penyakit/Keluhan  :  {{$data->pasien->penyakit}}


    Hasil Lab : {{$data->hasil_lab}}


    Bukti Lab  : <img style="width:100px" src="{{asset('img/app/'.$data->bukti_lab)}}">
    </pre>



  <p align="center"><font face="Arial">
   Telah Melakukan Pemeriksaan Di Klinik Kami tanggal<font color="red"> {{Date('d M Y', strtotime($data->updated_at))}}</font>
  </font></p>
 </body>
</html>
