
@include('admin.header')    
<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Data Teknik Labolatorium Medis</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Data Teknik Labolatorium Medis</li>
        </ol>
        <div class="row mb-4">
            <div class="col-xl-3 col-md-6">
                <button type="button" class="btn btn-primary text-white" data-bs-toggle="modal" data-bs-target="#addModal">Tambah Data</button>
            </div>
        </div>
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                Daftar Teknik Labolatorium Medis
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="datatablesSimple">
                        <thead>
                            <tr>
                                <th>Nama</th>
                                <th>Username</th>
                                <th>Jenis Kelamin</th>
                                <th>No.hp</th>
                                <th>Status</th>
                                <th>
                                    @if (session('user')['role'] != 2)
                                    Aksi
                                    @endif
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($dataUser as $dt)
                                <tr style="{{$dt->username == session('user')['Username'] ? 'background-color: #c7ffbf' : ''}}">
                                    <td>{{ucWords($dt->nama)}}</td>
                                    <td>{{$dt->username}}</td>
                                    <td>{{$dt->jenis_kelamin == 1 ? 'Laki-Laki' : 'Perempuan'}}</td>
                                    <td>{{$dt->no_hp}}</td>
                                    <td>{{$dt->status == 1 ? 'Aktif' : 'Non-Aktif'}}</td>
                                    <td>
                                        @if ($dt->username == session('user')['Username'] || session('user')['role'] == 4)  
                                        <button  type="button" class="btn btn-info btn-sm form-modal" onclick="detailDokter('{{ $dt->username }}')"><i class="fa fa-file-text fa-fw"></i></button>
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
                <form id="form-dokter">
                    <div class="form-group row mb-2">
                        <label class="col-3 col-form-label">Nama</label>
                        <div class="col-9">
                            <input type="text" class="form-control" id="addNama">
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label class="col-3 col-form-label">Username</label>
                        <div class="col-9">
                            <input type="text" class="form-control" id="addUsername">
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label class="col-3 col-form-label">Password</label>
                        <div class="col-9">
                            <input type="password" class="form-control" id="addPassword">
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
                        <label class="col-3 col-form-label">Nomor Hp</label>
                        <div class="col-9">
                            <input type="text" class="form-control" id="addNo">
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                <button type="button" class="btn btn-primary" onclick="addDokter()">Simpan</button>
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
                <form id="form-dokter">
                    <div class="form-group row mb-2">
                        <label class="col-3 col-form-label">Nama</label>
                        <div class="col-9">
                            <input type="text" class="form-control" id="editNama">
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label class="col-3 col-form-label">Username</label>
                        <div class="col-9">
                            <input type="text" class="form-control" id="editUsername">
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label class="col-3 col-form-label">Password</label>
                        <div class="col-9">
                            <input type="password" class="form-control" id="editPassword">
                        </div>
                    </div>
                    <label class="col-3 col-form-label">Jenis Kelamin</label>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input editGender" type="radio" name="editgender" id="lakilaki" value="1">
                        <label class="form-check-label" for="lakilaki">Laki-Laki</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input editGender" type="radio" name="editgender" id="perempuan" value="2">
                        <label class="form-check-label" for="perempuan">Perempuan</label>
                    </div>
                    <div class="form-group row mb-2">
                        <label class="col-3 col-form-label">Nomor Hp</label>
                        <div class="col-9">
                            <input type="text" class="form-control" id="editNo">
                        </div>
                    </div>
                    <label class="col-3 col-form-label">Status</label>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input editStatus" type="radio" name="editStatus" id="aktif" value="1">
                        <label class="form-check-label" for="aktif">Aktif</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input editStatus" type="radio" name="editStatus" id="nonaktif" value="2">
                        <label class="form-check-label" for="nonaktif">Nonaktif</label>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                <button type="button" class="btn btn-primary" onclick="editDokter()">Ubah</button>
            </div>
            </div>
        </div>
    </div>
</main>

<script>
    let value_status = 0;
    let value_gender = 0;
    $('.editStatus').on('change',function(){
        value_status = $(this).val()
    })
    $('.editGender').on('change',function(){
        value_gender = $(this).val()
    })
    const addDokter = () => {
        
        $(".overlay").addClass('show')
        const data = {
            _token: "{{ csrf_token() }}",
            nama: $('#addNama').val(),
            username: $('#addUsername').val(),
            password: $('#addPassword').val(),
            gender: $("input[name='gender']").val(),
            nohp: $('#addNo').val()
        }
               
        $.ajax({
            type: 'POST',
            url: '/data-tlm',
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

    
    const detailDokter = (id) => {
        $(".overlay").addClass('show')
        $.ajax({
            type: 'GET',
            url: '/data-tlm/'+id,
            success: function(res) {
                
                $(".overlay").removeClass('show')
                if(res != null || res != undefined) {
                    $('#editNama').val(res.nama)
                    $('#editUsername').val(res.username)
                    $('#editPassword').val('')
                    $('#editNo').val(res.no_hp)

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

    const editDokter = () => {
        $(".overlay").addClass('show')
        
        const data = {
            _token: "{{ csrf_token() }}",
            nama: $('#editNama').val(),
            username: $('#editUsername').val(),
            password: $('#editPassword').val(),
            gender: value_gender,
            nohp: $('#editNo').val(),
            status: value_status,
        }

        $.ajax({
            type: 'PUT',
            url: '/data-tlm',
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
</script>
@include('admin.footer')
