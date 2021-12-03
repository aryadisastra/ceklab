
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
                    <div class="card-body">Total Data : 2</div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card bg-warning text-white mb-4">
                    <div class="card-body">Belum Konfirmasi Pasien : 1</div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card bg-success text-white mb-4">
                    <div class="card-body">Selesai Di Proses : 1</div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card bg-danger text-white mb-4">
                    <div class="card-body">Belum Di Proses : 0</div>
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
                        <tr>
                            <td>Agus</td>
                            <td>18</td>
                            <td>Laki-Laki</td>
                            <td>Paru-Paru Kering</td>
                            <td>Menunggu Confirm</td>
                            <td>Robert</td>
                        </tr>
                        <tr style="background-color: #c7ffbf">
                            <td>Hendar</td>
                            <td>45</td>
                            <td>Laki-Laki</td>
                            <td>Tulang Kering Basah</td>
                            <td>Selesai</td>
                            <td>John</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</main>
@include('admin.footer')
