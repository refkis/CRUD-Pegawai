<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pegawai</title>
    <link rel="stylesheet" href="{{url('css/datatables.css')}}">
    <link rel="stylesheet" href="{{url('css/bootstrap513.css')}}">
</head>
<?php

$unit = DB::table('tb_unit')->pluck('nama_unit', 'id_unit');
$jabatan = DB::table('tb_jabatan')->pluck('nama_jabatan', 'id_jabatan');
$golongan = DB::table('tb_golongan')
    ->selectRaw('CONCAT(romawi,"", ruang) as golongan, id_golongan')
    ->pluck('golongan', 'id_golongan')
    ->toArray();
?>

<body>
    <header class="navbar navbar-light sticky-top bg-light flex-md-nowrap p-0 shadow">
        <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3" href="#">Company name</a>
        <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <nav class="navbar navbar-expand navbar-light navbar-bg">
            <a class="sidebar-toggle">
                <i class="hamburger align-self-center"></i>
            </a>
            <div class="navbar-collapse collapse">
                <ul class="navbar-nav navbar-align">
                    <li class="nav-item dropdown">
                        <a class="nav-icon dropdown-toggle d-inline-block d-sm-none" href="#" data-bs-toggle="dropdown">
                            <img> </img>
                        </a>
                        <a class="nav-link dropdown-toggle d-none d-sm-inline-block" href="#" data-bs-toggle="dropdown">
                            <img src="https://github.com/mdo.png" alt="mdo" width="32" height="32" class="rounded-circle"> <span class="text-dark">

                            <!-- {{ Auth::user()->username }} -->

                            {{auth()->user()->username}}</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end">
                           
                            <a class="dropdown-item" href="/logout">Sign out</a>
                        </div>
                    </li>
                </ul>
            </div>
        </nav>
    </header>
    <div class="container-fluid">
        <div class="row">
            <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
                <div class="position-sticky pt-3">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="#">
                                <span data-feather="home"></span>
                                Dashboard
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <span data-feather="file"></span>
                                Orders
                            </a>
                        </li>
                    </ul>

                    <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
                        <span>Saved reports</span>
                        <a class="link-secondary" href="#" aria-label="Add a new report">
                            <span data-feather="plus-circle"></span>
                        </a>
                    </h6>
                    <ul class="nav flex-column mb-2">
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <span data-feather="file-text"></span>
                                Current month
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>

            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2">TABEL DATA PEGAWAI</h1>
                    <div class="btn-toolbar mb-2 mb-md-0">
                        <div class="btn-group me-2">
                            <button type="button" class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#modalTambah">Tambah</button>
                            <a href="/pegawai/cetak" target="_blank" type="button" class="btn btn-sm btn-outline-success">Export</a>
                        </div>
                    </div>
                </div>
                <i>Digunakan untuk mengelola data pegawai</i>
                <div class="table-responsive">
                    <table class="table table-striped table-sm " id="datatable">
                        <thead>
                            <tr>
                                <th width="5%">ID</th>
                                <th width="15%">NIP</th>
                                <th width="15%">NAMA</th>
                                <th width="15%">GOLONGAN</th>
                                <th width="15%">JABATAN</th>
                                <th width="15%">UNIT</th>
                                <th width="20%">ACTION</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pegawai as $p )
                            <tr>
                                <td>{{$p->id_pegawai}}</td>
                                <td>{{$p->nip_pegawai}}</td>
                                <td>{{$p->nama_pegawai}}</td>
                                <td>{{$p->romawi}}/{{ $p->ruang }}</td>
                                <td>{{$p->nama_jabatan}}</td>
                                <td>{{$p->nama_unit}}</td>
                                <td>
                                    <button class="btnEdit btn btn-warning btn-sm" data-id="{{ $p->id_pegawai }}" data-bs-target="#modalEdit" data-bs-toggle="modal" style="width:60px;height:30px;"> EDIT </button>
                                    <button class="btnDelete btn btn-sm btn-danger" data-id_pegawai="{{ $p->id_pegawai }}" style="width:60px;height:30px;"> HAPUS </button>

                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </main>
        </div>
    </div>


    <!-- ALERT SUKSES -->
    @if(Session::has('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Success!</strong> {{ Session::get('message', '')}}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <!-- MODAL TAMBAH -->
    {!! Form::open(['url' => 'pegawai/insert']) !!}
    <div class="modal fade" id="modalTambah" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTambahLabel">Tambah Data User</h5>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="nip_pegawai" class="form-label">NIP</label>
                        <input type="text" class="form-control" name="nip_pegawai">
                    </div>
                    <div class="mb-3">
                        <label for="nama_pegawai" class="form-label">NAMA LENGKAP</label>
                        <input type="text" class="form-control" name="nama_pegawai">
                    </div>
                    <div class="mb-3">
                        <label for="golongan" class="form-label">GOLONGAN</label><br>
                        {!! Form::select('id_golongan', $golongan) !!}
                    </div>
                    <div class="mb-3">
                        <label for="unit" class="form-label">JABATAN</label><br>
                        {!! Form::select('id_jabatan', $jabatan) !!}
                    </div>
                    <div class="mb-3">
                        <label for="unit" class="form-label">UNIT KERJA</label><br>
                        {!! Form::select('id_unit', $unit) !!}
                    </div>
                    <div class="form-group">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>

                </div>
            </div>
        </div>
    </div>
    {!! Form::close() !!}

    <!-- MODAL EDIT -->
    {!! Form::open(array('url' => 'pegawai/update','method'=>'POST', 'id' => 'formEdit')) !!}
    <div class="modal fade" id="modalEdit" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalEditLabel">Tambah Data User</h5>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="nip_pegawai" class="form-label">NIP</label>
                        {!! Form::text('nip_pegawai',null,['id'=>'nip_pegawai','class' => 'form-control']) !!}
                    </div>
                    <div class="mb-3">
                        <label for="nama_pegawai" class="form-label">NAMA LENGKAP</label>
                        {!! Form::text('nama_pegawai',null,['id'=>'nama_pegawai','class' => 'form-control']) !!}
                    </div>
                    <div class="mb-3">
                        <label for="golongan" class="form-label">GOLONGAN</label><br>
                        {!! Form::select('id_golongan', $golongan,null,['id'=>'id_golongan']) !!}
                    </div>
                    <div class="mb-3">
                        <label for="unit" class="form-label">JABATAN</label><br>
                        {!! Form::select('id_jabatan', $jabatan,null,['id'=>'id_jabatan']) !!}
                    </div>
                    <div class="mb-3">
                        <label for="unit" class="form-label">UNIT KERJA</label><br>
                        {!! Form::select('id_unit', $unit,null,['id'=>'id_unit']) !!}
                    </div>
                    {!! Form::hidden('id_pegawai',null,['id'=>'id_pegawai','class' => 'form-control']) !!}
                    <div class="form-group">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {!! Form::close() !!}

    <!-- MODAL DELETE -->
    {!! Form::open(['url' => 'pegawai/delete/{$id}']) !!}
    {!! Form::hidden('id_pegawai',null,['id'=>'id_pegawai','class' => 'form-control']) !!}
    {!! Form::close() !!}

    <!-- SCRIPT JAVASCRIPT -->
    <script src="{{url('js/jquery351.js')}}"></script>
    <script src="{{url('js/datatables.js')}}"></script>
    <script src="{{url('js/sweetalert.js')}}"></script>
    <script src="{{url('js/bootstrap513.js')}}"></script>


    <script>
        $(document).ready(function() {
            $('#datatable').DataTable();
            $('.btnEdit').on('click', function() {

                var id = $(this).data('id');
                console.log(id)
                $.get('pegawai/' + id, function(data) {
                    console.log(data.data.nama_pegawai)
                    $('#id_pegawai').val(data.data.id_pegawai);
                    $('#nip_pegawai').val(data.data.nip_pegawai);
                    $('#nama_pegawai').val(data.data.nama_pegawai);
                    $('#id_golongan').val(data.data.id_golongan);
                    $('#id_jabatan').val(data.data.id_jabatan);
                    $('#id_unit').val(data.data.id_unit);
                })
            });

            $('.btnDelete').on('click', function() {

                var id_pegawai = $(this).data('id_pegawai');
                swal({
                        title: "Apakah anda yakin?",
                        text: "Pegawai dengan  ID " + id_pegawai + " akan dihapus?",
                        icon: "warning",
                        buttons: true,
                        dangerMode: true,
                    })
                    .then((willDelete) => {
                        if (willDelete) {
                            window.location = "/pegawai/delete/" + id_pegawai + "";
                        }
                    });

            });
        });
    </script>
</body>

</html>