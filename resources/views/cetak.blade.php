<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Pegawai</title>
</head>
<style>
   table, th, td {
  border: 1px solid black;
  border-collapse: collapse;
}
</style>
<body>
<div class="container">
        <div>
           <center>
               <h1>Laporan Data Pegawai</h1>
           </center> 
        </div><br>
        
        <div class="content">
            <table width="100%" class="table table-striped">
                <thead style="border: 1px solid black;">
                    <tr style="border: 1px solid black;">
                        <td width="5%">ID</td>
                        <td width="15%">NIP</td>
                        <td width="15%">NAMA</td>
                        <td width="15%">GOLONGAN</td>
                        <td width="15%">JABATAN</td>
                        <td width="15%">UNIT</td>                        
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
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>