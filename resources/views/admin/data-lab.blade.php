
@include('admin.header')
<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Data Lab</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Data Lab</li>
        </ol>
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                Data Lab
            </div>
            <div class="card-body">
                <div class="table-responsive table table-striped table-hover">
                    <table class="table table-striped table-hover" id="datatablesSimple">
                        <thead>
                            <tr>
                                <th>Tanggal</th>
                                <th style="width: 100px">Kode</th>
                                <th>Pasien</th>
                                <th>Jenis Kelamin</th>
                                <th>Usia</th>
                                <th>Keluhan</th>
                                <th>Hasil Lab</th>
                                <th>Bukti Lab</th>
                                <th>Dokter Yang Bertanggung Jawab</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($fetch as $dt)
                            <tr>
                                <td>{{$dt['tanggal']}}</td>
                                <td>{{$dt['kode']}}</td>
                                <td>{{$dt['pasien']}}</td>
                                <td>{{$dt['gender']}}</td>
                                <td class="text-center">{{$dt['umur']}}</td>
                                <td>{{$dt['penyakit']}}</td>
                                <td>{{$dt['hasil']}}</td>
                                <td>
                                    @if($dt['bukti'] != null)
                                    <a target="_blank" href="img/app/{{$dt['bukti']}}"><img src="{{asset('img/app/'.$dt['bukti'])}}" style="width:100px"></a>
                                    @endif
                                </td>
                                <td class="text-center">{{$dt['dokter']}}</td>
                                <td class="text-center">
                                    <button type="button" class="btn btn-secondary btn-sm form-modal " onclick="cekLab('{{$dt['kode'] }}')"><i class="fas fa-flask fa-fw"></i></i></button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- MODAL LAB -->
    <div class="modal fade" id="labModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-pencil-square"></i>Pengecekan Lab</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="form-lab" method="post" action="/data-lab/ceklab" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group row mb-2">
                        <input type="hidden" class="form-control" id="labKode" name="kode">
                        <label class="col-3 col-form-label">Nama</label>
                        <div class="col-9">
                            <input type="text" class="form-control" id="labNama" disabled>
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label class="col-3 col-form-label">Hasil Lab</label>
                        <div class="col-9">
                            <textarea id="labHasil" cols="33" rows="5" name="hasil"></textarea>
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <input type="hidden" class="form-control" id="labPasien" disabled>
                        <label class="col-3 col-form-label">Bukti Lab:</label>
                        <div class="col-9">
                            <input class="form-control" type="file" name="img[]" id="formFile">
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                <button type="button" class="btn btn-primary" onclick="addLab()">Update Data Lab</button>
            </div>
            </div>
        </div>
    </div>
</main>
<script>
    const cekLab = (id) => {
        $(".overlay").addClass('show')
        $.ajax({
            type: 'GET',
            url: '/data-lab/ceklab/'+id,
            success: function(res) {
                console.log(res)
                $(".overlay").removeClass('show')
                if(res != null || res != undefined) {
                    $('#labNama').val(ucWords(res.pasien))
                    $('#labKode').val(res.kode)

                    $("#labModal").modal('show');

                    return;
                }

                alert("Terjadi kesalahan! Silahkan coba lagi", "error");

                return;
            },
            error: function(jqXHR, textStatus, error) {
                $(".overlay").removeClass('show')
                alert("Terjadi kesalahan internal! Silahkan coba lagi", "error");

                return;
            }
        });
    }

    const addLab = () => {
        $('#form-lab').submit()
        $(".overlay").addClass('show')
    }
</script>
@include('admin.footer')
