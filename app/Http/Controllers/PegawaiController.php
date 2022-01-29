<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PegawaiController extends Controller
{
    function index()
    {
        $pegawai =  DB::select(
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
                tb_pegawai AS 
                p, tb_jabatan AS j, 
                tb_unit AS u, 
                tb_golongan AS g
            WHERE 
                j.id_jabatan = p.id_jabatan AND
                g.id_golongan = p.id_golongan AND
                u.id_unit = p.id_unit'
        );

        return view('pegawai.index', compact('pegawai'));
    }

    function insert (Request $r){
        $data = array(
            'nip_pegawai'=>$r->nip_pegawai,
            'nama_pegawai'=>$r->nama_pegawai,
            'id_jabatan'=>$r->id_jabatan,
            'id_golongan'=>$r->id_golongan,
            'id_unit'=>$r->id_unit
        );
        DB::table('tb_pegawai')->insert($data);
        return redirect('/pegawai')->with('success', true)->with('message','Data Berhasil Disimpan');
    }

    function get ($id){
        $pegawai = DB::table('tb_pegawai')->where('id_pegawai',$id)->first();        
       
        return response()->json([
            'data' => $pegawai
          ]);
      
    }
    function update (Request $r){       
        $data = array(            
            'nip_pegawai'=>$r->nip_pegawai,
            'nama_pegawai'=>$r->nama_pegawai,
            'id_jabatan'=>$r->id_jabatan,
            'id_golongan'=>$r->id_golongan,
            'id_unit'=>$r->id_unit
        );
        DB::table('tb_pegawai')->where('id_pegawai',$r->id_pegawai)->update($data);
        return redirect('/pegawai')->with('success', true)->with('message','That was great!');
    }

    function delete ($id){ 
        DB::table('tb_pegawai')->where('id_pegawai',$id)->delete();
        return redirect('/pegawai')->with('success', true)->with('message','Delete');
    }
}
