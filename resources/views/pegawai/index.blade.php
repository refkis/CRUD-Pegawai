@extends('layouts.dashboard.index')
@section('content')
<?php

$unit = DB::table('tb_unit')->pluck('nama_unit', 'id_unit');
$jabatan = DB::table('tb_jabatan')->pluck('nama_jabatan', 'id_jabatan');
$golongan = DB::table('tb_golongan')
    ->selectRaw('CONCAT(romawi,"", ruang) as golongan, id_golongan')
    ->pluck('golongan', 'id_golongan')
    ->toArray();
?>
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">TABEL DATA PEGAWAI</h1>
    <div class="btn-toolbar mb-2 mb-md-0">
        <div class="btn-group me-2">
            @if(auth()->user()->level =='administrator')
            <button type="button" class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#modalTambah">Tambah</button>
            @endif
            <a href="/pegawai/cetak" target="_blank" type="button" class="btn btn-sm btn-outline-success">Cetak</a>
        </div>
    </div>
</div>
<h5>Digunakan untuk mengelola data pegawai</h5>
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
                @if(auth()->user()->level =='administrator')
                <th width="20%">ACTION</th>
                @endif
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
                @if(auth()->user()->level =='administrator')
                <td>
                    <button class="btnEdit btn btn-warning btn-sm" data-id_pegawai="{{ $p->id_pegawai }}"  style="width:60px;height:30px;"> EDIT </button>
                    <button class="btnDelete btn btn-sm btn-danger" data-id_pegawai="{{ $p->id_pegawai }}" style="width:60px;height:30px;"> HAPUS </button>

                </td>
                @endif
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
<!-- ALERT SUKSES -->
<div class="mb-3"></div>
		@if ($errors->any())
		<div class="alert alert-danger alert-dismissible fade show ">
			<ul>
				@foreach ($errors->all() as $error)
				<li class="">{{ $error }}</li>
				@endforeach
			</ul>
		</div>
		@endif
		</div>
@if(Session::has('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>Success!</strong> {{ Session::get('message', '')}}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif
@endsection

@section('modal')

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
                    {!! Form::select('id_golongan', $golongan,null,['id' => 'id_golongan']) !!}
                </div>
                <div class="mb-3">
                    <label for="unit" class="form-label">JABATAN</label><br>
                    {!! Form::select('id_jabatan', $jabatan,null,['id' => 'id_jabatan']) !!}
                </div>
                <div class="mb-3">
                    <label for="unit" class="form-label">UNIT KERJA</label><br>
                    {!! Form::select('id_unit', $unit,null,['id' => 'id_unit']) !!}
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
                <h5 class="modal-title" id="modalEditLabel">Edit Data User</h5>
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
                    <label for="id_golongan" class="form-label">GOLONGAN</label><br>
                    {!! Form::select('id_golongan', $golongan,null,['id'=>'id_golongan']) !!}
                </div>
                <div class="mb-3">
                    <label for="id_jabatan" class="form-label">JABATAN</label><br>
                    {!! Form::select('id_jabatan', $jabatan,null,['id'=>'id_jabatan']) !!}
                </div>
                <div class="mb-3">
                    <label for="id_unit" class="form-label">UNIT KERJA</label><br>
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

@endsection
@section('javascript')

<!-- SCRIPT JAVASCRIPT -->
<script src="{{url('js/jquery351.js')}}"></script>
<script src="{{url('js/datatables.js')}}"></script>
<script src="{{url('js/sweetalert.js')}}"></script>
<script src="{{url('js/bootstrap513.js')}}"></script>


<script>
    $(document).ready(function() {
        $('#datatable').DataTable();
        $('#modalTambah').on('show.bs.modal', function() {
            $('#id_golongan').val("");
            $('#id_jabatan').val("");
            $('#id_unit').val("");
        })
        $('.btnEdit').on('click', function() {
            var id = $(this).data('id_pegawai');
            $('#modalEdit').modal('show')
            $.get('pegawai/' + id, function(data) {

                console.log('id golongan = '+data.data.id_golongan)
                console.log(data.data.nama_pegawai)
                $('#id_pegawai').val(data.data.id_pegawai);
                $('#nip_pegawai').val(data.data.nip_pegawai);
                $('#nama_pegawai').val(data.data.nama_pegawai);

                $('#modalEdit #id_golongan').val(data.data.id_golongan);
                $('#modalEdit #id_jabatan').val(data.data.id_jabatan);
                $('#modalEdit #id_unit').val(data.data.id_unit);
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
@endsection