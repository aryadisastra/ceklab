
@include('admin.header')
<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Dashboard</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Dashboard</li>
        </ol>
        <div class="row">
            <div class="col-xl-3 col-md-6">
                <div class="card bg-primary text-white mb-4">
                    <div class="card-body">Total Data : <span id="total">0</span></div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card bg-warning text-white mb-4">
                    <div class="card-body">Belum Konfirmasi Pasien : <span id="menunggu">0</span></div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card bg-success text-white mb-4">
                    <div class="card-body">Selesai Di Proses : <span id="selesai">0</span></div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card bg-danger text-white mb-4">
                    <div class="card-body">Belum Di Proses : <span id="belum">0</span></div>
                </div>
            </div>
        </div>
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                Data Lab
            </div>
            <div class="card-body">
                <table id="datatablesSimple">
                    <thead>
                        <tr>
                            <th>Pasien</th>
                            <th>Usia</th>
                            <th>Jenis Kelamin</th>
                            <th>Hasil Diagnosa</th>
                            <th>Status</th>
                            <th>Dokter Penanggung Jawab</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($fetch as $dt)
                        <tr style="background-color:{{$dt['status_angka'] == 3 ? '#74f779' : ($dt['status_angka'] == 1 ? '#fc8d8d' : '#fffc69')}}">
                            <td>{{$dt['pasien']}}</td>
                            <td>{{$dt['umur']}}</td>
                            <td>{{$dt['gender']}}</td>
                            <td>{{$dt['hasil']}}</td>
                            <td>{{$dt['status']}}</td>
                            <td>{{$dt['dokter']}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</main>
<script>
    history.replaceState({}, null, "/dashboard");
    setInterval(() => {
        $.ajax({
                type: 'GET',
                url: '/dashboard/getData',
                success: function(res) {
                    $('#total').html(res[0].total)
                    $('#menunggu').html(res[0].menunggu)
                    $('#selesai').html(res[0].selesai)
                    $('#belum').html(res[0].belum)
                    return;
                }
            });
    }, 1000);
</script>
@include('admin.footer')
