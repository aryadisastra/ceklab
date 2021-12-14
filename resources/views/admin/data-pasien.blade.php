
@include('admin.header')    
<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Data Pasien</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Data Pasien</li>
        </ol>
        <div class="row mb-4">
            <div class="col-xl-3 col-md-6">
                <button type="button" class="btn btn-primary text-white" data-bs-toggle="modal" data-bs-target="#addModal">Tambah Data</button>
            </div>
        </div>
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                Daftar Pasien
            </div>
            <div class="card-body">
                <div class="table table-striped table-hover table-responsive">
                    <table class="table table-striped table-hover" id="datatablesSimple">
                        <thead>
                            <tr>
                                <th>Tanggal Masuk</th>
                                <th>Nama</th>
                                <th>Jenis Kelamin</th>
                                <th>Umur</th>
                                <th>Penyakit</th>
                                <th>Status</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($dataPasien as $dt)
                                <tr>
                                    <td>{{date('l, d M Y',strtotime($dt->created_at))}}</td>
                                    <td>{{ucWords($dt->nama)}}</td>
                                    <td>{{$dt->jenis_kelamin == 1 ? 'Laki-Laki' : 'Perempuan'}}</td>
                                    <td>{{$dt->umur}}</td>
                                    <td>{{$dt->penyakit}}</td>
                                    <td>{{$dt->status == 1 ? 'Dirawat' : ($dt->status == 2 ? 'Di Test Lab' : 'Selesai/Pulang')}}</td>
                                    <td class="text-center">
                                        @if ($dt->status == 1)
                                            <button type="button" class="btn btn-info btn-sm form-modal " onclick="detailPasien('{{ $dt->id_pasien }}')"><i class="fa fa-file-text fa-fw"></i></button>
                                            <button type="button" class="btn btn-secondary btn-sm form-modal " onclick="cekLab('{{ $dt->id_pasien }}')"><i class="fas fa-flask fa-fw"></i></i></button>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-plus"></i> TAMBAH DATA</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="form-Pasien">
                    <div class="form-group row mb-2">
                        <label class="col-3 col-form-label">Nama</label>
                        <div class="col-9">
                            <input type="text" class="form-control" id="addNama">
                        </div>
                    </div>
                    <label class="col-3 col-form-label">Jenis Kelamin</label>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="gender" id="lakilaki" value="1">
                        <label class="form-check-label" for="lakilaki">Laki-Laki</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="gender" id="perempuan" value="2">
                        <label class="form-check-label" for="perempuan">Perempuan</label>
                    </div>
                    <div class="form-group row mb-2">
                        <label class="col-3 col-form-label">Umur</label>
                        <div class="col-9">
                            <input type="number" class="form-control" id="addUmur">
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label class="col-3 col-form-label">Keluhan/Penyakit</label>
                        <div class="col-9">
                            <textarea class="form-control" id="addPenyakit" name="penyakit"cols="9" rows="5"></textarea>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                <button type="button" class="btn btn-primary" onclick="addPasien()">Simpan</button>
            </div>
            </div>
        </div>
    </div>

    <!-- MODAL EDIT -->
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-pencil-square"></i> EDIT DATA</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="form-Pasien">
                    <div class="form-group row mb-2">
                        <label class="col-3 col-form-label">Nama</label>
                        <div class="col-9">
                            <input type="hidden" class="form-control" id="editId">
                            <input type="text" class="form-control" id="editNama">
                        </div>
                    </div>
                    <label class="col-3 col-form-label">Jenis Kelamin</label>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input value-gender" type="radio" name="editgender" id="lakilaki" value="1">
                        <label class="form-check-label" for="lakilaki">Laki-Laki</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input value-gender" type="radio" name="editgender" id="perempuan" value="2">
                        <label class="form-check-label" for="perempuan">Perempuan</label>
                    </div>
                    <div class="form-group row mb-2">
                        <label class="col-3 col-form-label">Umur</label>
                        <div class="col-9">
                            <input type="number" class="form-control" id="editUmur">
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label class="col-3 col-form-label">Keluhan/Penyakit</label>
                        <div class="col-9">
                            <textarea class="form-control" id="editPenyakit" name="penyakit"cols="9" rows="5"></textarea>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                <button type="button" class="btn btn-primary" onclick="editPasien()">Ubah</button>
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
                <form id="form-Pasien">
                    <div class="form-group row mb-2">
                        <input type="hidden" class="form-control" id="labPasien" disabled>
                        <label class="col-3 col-form-label">Nama</label>
                        <div class="col-9">
                            <input type="text" class="form-control" id="labNama" disabled>
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label class="col-3 col-form-label">Dokter</label>
                        <div class="col-9">
                            <select name="dokter" class="form-select col-9" id="labDokter">
                                <option value="0">-----</option>
                                @foreach ($dokter as $dt)
                                    <option value="{{$dt->username}}">{{ucWords($dt->nama)}}</option> 
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label class="col-3 col-form-label">Perawat</label>
                        <div class="col-9">
                            <select name="perawat" class="form-select col-9" id="labPerawat">
                                <option value="0">-----</option>
                                @foreach ($perawat as $dt)
                                    <option value="{{$dt->username}}">{{ucWords($dt->nama)}}</option> 
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label class="col-3 col-form-label">TLM</label>
                        <div class="col-9">
                            <select name="rlm" class="form-select col-9" id="labTlm">
                                <option value="0">-----</option>
                                @foreach ($tlm as $dt)
                                    <option value="{{$dt->username}}">{{ucWords($dt->nama)}}</option> 
                                @endforeach
                            </select>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                <button type="button" class="btn btn-primary" onclick="addLab()">Masukan Ke Data Lab</button>
            </div>
            </div>
        </div>
    </div>
</main>

<script>
    let dokterval       = 0;
    let value_gender    = 0;
    let value_perawat   = 0;
    let value_tlm       = 0;
    $('#labDokter').on('change',function(){
        dokterval = $(this).val()
    })
    $('#labPerawat').on('change',function(){
        perawatval = $(this).val()
    })
    $('#labTlm').on('change',function(){
        tlmval = $(this).val()
    })
    $('.value-gender').on('click',function(){
        value_gender = $(this).val()
    })
    const addPasien = () => {
        $(".overlay").addClass('show')
        const data = {
            _token: "{{ csrf_token() }}",
            nama: $('#addNama').val(),
            umur: $('#addUmur').val(),
            gender: $("input[name='gender']").val(),
            penyakit: $('#addPenyakit').val()
        }
               
        $.ajax({
            type: 'POST',
            url: '/data-pasien',
            data: data,
            success: function(res) {
                if(res == true) {
                    $(".overlay").removeClass('show')
                    location.reload();

                    return;
                }

                alert("Terjadi kesalahan! Silahkan coba lagi", "error");

                return;
            },
            error: function(jqXHR, textStatus, error) {
                $(".overlay").removeClass('show');

                alert("Data kurang lengkap! Silahkan coba lagi", "error");

                return;
            }
        })
    }

    const detailPasien = (id) => {
        $(".overlay").addClass('show')
        $.ajax({
            type: 'GET',
            url: '/data-pasien/'+id,
            success: function(res) {
                
                $(".overlay").removeClass('show')
                if(res != null || res != undefined) {
                    $('#editId').val(res.id_pasien)
                    $('#editNama').val(res.nama)
                    $('#editUmur').val(res.umur)
                    $('#editPenyakit').val(res.penyakit)

                    $("#editModal").modal('show');

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

    const editPasien = () => {
        $(".overlay").addClass('show')
        
        const data = {
            _token: "{{ csrf_token() }}",
            id: $('#editId').val(),
            nama: $('#editNama').val(),
            umur: $('#editUmur').val(),
            penyakit: $('#editPenyakit').val(),
            gender: value_gender,
        }

        $.ajax({
            type: 'PUT',
            url: '/data-pasien',
            data: data,
            success: (res) => {
                $(".overlay").removeClass('show')

                if(res == true) {
                    location.reload()

                    return
                }
                
                alert("Terjadi kesalahan internal! Silahkan coba lagi", "error")

                return
            },
            error: (jqXHR, textStatus, error) => {
                $(".overlay").removeClass('show')

                alert("Terjadi kesalahan indternal! Silahkan coba lagi", "error")

                return
            }
        })
    }

    const cekLab = (id) => {
        $(".overlay").addClass('show')
        $.ajax({
            type: 'GET',
            url: '/data-pasien/ceklab/'+id,
            success: function(res) {
                
                $(".overlay").removeClass('show')
                if(res != null || res != undefined) {
                    $('#labNama').val(ucWords(res.nama))
                    $('#labPasien').val(res.id_pasien)

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
        $(".overlay").addClass('show')
        const data = {
            _token: "{{ csrf_token() }}",
            pasien: $('#labPasien').val(),
            dokter: dokterval,
            perawat: perawatval,
            tlm: tlmval,
        }
               
        $.ajax({
            type: 'POST',
            url: '/data-pasien/ceklab',
            data: data,
            success: function(res) {
                if(res == true) {
                    $(".overlay").removeClass('show')
                    location.reload();

                    return;
                }

                alert("Terjadi kesalahan! Silahkan coba lagi", "error");

                return;
            },
            error: function(jqXHR, textStatus, error) {
                $(".overlay").removeClass('show');

                alert("Data kurang lengkap! Silahkan coba lagi", "error");

                return;
            }
        })
    }
</script>
@include('admin.footer')
