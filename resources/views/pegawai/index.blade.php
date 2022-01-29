<?php

$unit = DB::table('tb_unit')->pluck('nama_unit', 'id_unit');

$jabatan = DB::table('tb_jabatan')->pluck('nama_jabatan', 'id_jabatan');

$golongan = DB::table('tb_golongan')
    ->selectRaw('CONCAT(romawi,"", ruang) as golongan, id_golongan')
    ->pluck('golongan', 'id_golongan')
    ->toArray();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pegawai</title>
    <link rel="stylesheet" href="{{url('css/bootstrap513.css')}}">
    <link rel="stylesheet" href="{{url('css/datatables.css')}}">
</head>

<body>
    <div class="container">
        <div>
            <h1>Tabel Data Pegawai</h1>
            <i>digunakan untuk mengelola data pegawai</i>
        </div><br>
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalTambah">Tambah Data</button>
        <div class="content">
            <table width="100%" class="table table-hover">
                <thead class="">
                    <tr>
                        <td width="5%">ID</td>
                        <td width="15%">NIP</td>
                        <td width="15%">NAMA</td>
                        <td width="15%">GOLONGAN</td>
                        <td width="15%">JABATAN</td>
                        <td width="15%">UNIT</td>
                        <td width="20%">ACTION</td>
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

                            <button class="btnEdit btn btn-warning btn-sm" data-bs-target="#modalEdit" data-bs-toggle="modal" data-id="{{ $p->id_pegawai }}">edit </button>

                            <button class="btnDelete btn btn-sm btn-danger" data-id_pegawai="{{ $p->id_pegawai }}">hapus </button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
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
    <script src="{{url('js/sweetalert.js')}}"></script>
    <script src="{{url('js/bootstrap513.js')}}"></script>


    <script>
        $(document).ready(function() {

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