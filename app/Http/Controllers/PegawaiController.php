<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;

use DB;
use Datatables;
use PDF;

class PegawaiController extends Controller
{

    private $data_pegawai;
    public function __construct()
    {
        $this->data_pegawai = DB::select(
            'SELECT 
                p.id_pegawai, 
                p.nip_pegawai,
                p.nama_pegawai, 
                g.pangkat,
                g.romawi,
                g.ruang,
                j.nama_jabatan, 
                u.nama_unit 
            FROM 
                tb_pegawai AS p, 
                tb_golongan AS g,
                tb_jabatan AS j, 
                tb_unit AS u 
            WHERE 
                j.id_jabatan = p.id_jabatan AND
                g.id_golongan = p.id_golongan AND
                u.id_unit = p.id_unit
            ORDER BY
                p.id_pegawai'
        );
    }

    function index()
    {
        $pegawai =  $this->data_pegawai;
        return view('pegawai.index', compact('pegawai'));
    }

    function insert(Request $r)
    {
        $data = array(
            'nip_pegawai' => $r->nip_pegawai,
            'nama_pegawai' => $r->nama_pegawai,
            'id_jabatan' => $r->id_jabatan,
            'id_golongan' => $r->id_golongan,
            'id_unit' => $r->id_unit
        );
        DB::table('tb_pegawai')->insert($data);
        return redirect('/pegawai')->with('success', true)->with('message', 'Data Berhasil Disimpan');
    }

    function get($id)
    {
        $pegawai = DB::table('tb_pegawai')->where('id_pegawai', $id)->first();

        return response()->json([
            'data' => $pegawai
        ]);
    }

    function update(Request $r)
    {
        $data = array(
            'nip_pegawai' => $r->nip_pegawai,
            'nama_pegawai' => $r->nama_pegawai,
            'id_jabatan' => $r->id_jabatan,
            'id_golongan' => $r->id_golongan,
            'id_unit' => $r->id_unit
        );
        DB::table('tb_pegawai')->where('id_pegawai', $r->id_pegawai)->update($data);
        return redirect('/pegawai')->with('success', true)->with('message', 'Data Berhasil Di Update');
    }

    function delete($id)
    {
        DB::table('tb_pegawai')->where('id_pegawai', $id)->delete();
        return redirect('/pegawai')->with('success', true)->with('message', 'Data Berhasil Di Hapus');
    }

    function datatable()
    {
        $pegawai =  $this->data_pegawai;
        return Datatables::of($pegawai)->make(true);
    }
    
    function cetak()
    {
        $pegawai =  $this->data_pegawai;
        $pdf = PDF::loadview('cetak', ['pegawai'=>$pegawai]);
        return $pdf->stream('laporan-pegawai.pdf');
      
    }
}
