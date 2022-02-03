<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class ApiController extends Controller
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
    function get_data()
    {
        // $pegawai =  $this->data_pegawai;

        // $respon = array(
        //     'status' => true,
        //     'data' => $pegawai,
        // );

        // $response = new Response(json_encode($respon));
        // $response->headers->set('Content-Type', 'application/json');
        // return $response;

        
        $sql =
            'SELECT 
                p.id_pegawai, 
                p.nip_pegawai,
                p.nama_pegawai, 
                g.pangkat,
                g.id_golongan as valueGolongan,
                CONCAT(g.romawi,"", g.ruang) as labelGolongan, 
                j.id_jabatan as valueJabatan, 
                j.nama_jabatan as labelJabatan, 
                u.id_unit as valueUnit,
                u.nama_unit as labelUnit
            FROM 
                tb_pegawai AS p, 
                tb_golongan AS g,
                tb_jabatan AS j, 
                tb_unit AS u 
            WHERE 
                j.id_jabatan = p.id_jabatan AND
                g.id_golongan = p.id_golongan AND
                u.id_unit = p.id_unit ';

        $data = DB::table(DB::raw("($sql ) as x"))
            ->get();

        $respon = array(
            'status' => true,
            'data' => $data

        );

        $response = new Response(json_encode($respon));
        $response->headers->set('Content-Type', 'application/json');
        return $response;
    }
    

    function get_id(Request $r)
    {

        $id =  $r->idPegawai;
        $sql =
            'SELECT 
                p.id_pegawai, 
                p.nip_pegawai,
                p.nama_pegawai, 
                g.pangkat,
                g.id_golongan as valueGolongan,
                CONCAT(g.romawi,"", g.ruang) as labelGolongan, 
                j.id_jabatan as valueJabatan, 
                j.nama_jabatan as labelJabatan, 
                u.id_unit as valueUnit,
                u.nama_unit as labelUnit
            FROM 
                tb_pegawai AS p, 
                tb_golongan AS g,
                tb_jabatan AS j, 
                tb_unit AS u 
            WHERE 
                j.id_jabatan = p.id_jabatan AND
                g.id_golongan = p.id_golongan AND
                u.id_unit = p.id_unit ';

        $data = DB::table(DB::raw("($sql ) as x"))
            ->where('id_pegawai', $id)
            ->first();

        $respon = array(
            'status' => true,
            'data' => $data

        );

        $response = new Response(json_encode($respon));
        $response->headers->set('Content-Type', 'application/json');
        return $response;
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
        $respon = array(
            'success' => true,
            'message' => 'Data Berhasil Disimpan',
        );
        $response = new Response(json_encode($respon));
        $response->headers->set('Content-Type', 'application/json');
        return $response;
    }
    function get_list(Request $r)
    {

        $golongan = DB::table('tb_golongan')
            ->selectRaw('CONCAT(romawi,"", ruang) as label, id_golongan as value')
            ->get();

        $unit = DB::select('select nama_unit as label, id_unit as value from tb_unit');
        // ->pluck('nama_unit as label', 'id_unit as value');

        $jabatan = DB::select('select nama_jabatan as label, id_jabatan as value from tb_jabatan');
        // ->pluck('nama_jabatan', 'id_jabatan');


        $respon = array(
            'success' => true,
            'golongan' => $golongan,
            'unit' => $unit,
            'jabatan' => $jabatan,
        );
        $response = new Response(json_encode($respon));
        $response->headers->set('Content-Type', 'application/json');
        return $response;
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
}
