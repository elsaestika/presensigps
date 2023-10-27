<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengajuanizin;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;


class IzinsakitController extends Controller
{
    public function create()
    {
        return view('sakit.create');
    }

    public function store(Request $request)
    {
        $nik = Auth::guard('karyawan')->user()->nik;
        $tgl_izin_dari = $request->tgl_izin_dari;
        $tgl_izin_sampai = $request->tgl_izin_sampai;
        $status = "s";
        $keterangan = $request->keterangan;

        $bulan = date("m", strtotime($tgl_izin_dari));
        $tahun = date("Y", strtotime($tgl_izin_dari));
        // dd($tahun);
        $thn = substr($tahun, 2, 2);
        $lastizin = DB::table('pengajuan_izin')
            ->whereRaw('MONTH(tgl_izin_dari)="' .$bulan. '"')
            ->whereRaw('YEAR(tgl_izin_dari)="' .$tahun. '"')
            ->orderBy('kode_izin', 'desc')
            ->first();
        $lastkodeizin = $lastizin != null ? $lastizin->kode_izin : "";
        $format = "IZ" . $bulan . $thn ;
        $kode_izin = buatkode($lastkodeizin, $format, 3);
        // dd($kode_izin);
        if ($request->hasFile('sid')) {
            $sid = $kode_izin . "." . $request->file('sid')->getClientOriginalExtension();
        } else {
            $sid = null;
        }
        $data = [
            'kode_izin' => $kode_izin,
            'nik' => $nik,
            'tgl_izin_dari' => $tgl_izin_dari,
            'tgl_izin_sampai' => $tgl_izin_sampai,
            'status' => $status,
            'keterangan' => $keterangan,
            'doc_sid' => $sid
        ];

        $simpan = DB::table('pengajuan_izin')->insert($data);

        if($simpan){
            if ($request->hasFile('sid')) {
                $sid = $kode_izin . "." . $request->file('sid')->getClientOriginalExtension();
                $folderPath = "public/uploads/sid/";
                $request->file('sid')->storeAs($folderPath, $sid);
            }
            return redirect('/presensi/izin')->with(['success'=>'Data Berhasil Disimpan']);
        } else {
            return redirect('/presensi/izin')->with(['error'=>'Data Gagal Disimpan']);
        }
    }
    public function edit($kode_izin)
    {
        $dataizin = DB::table('pengajuan_izin')->where('kode_izin',$kode_izin)->first();
        return view('sakit.edit', compact('dataizin'));
    }

    public function update($kode_izin, Request $request)
    {

        $tgl_izin_dari = $request->tgl_izin_dari;
        $tgl_izin_sampai = $request->tgl_izin_sampai;

        $keterangan = $request->keterangan;


        // dd($kode_izin);
        if ($request->hasFile('sid')) {
            $sid = $kode_izin . "." . $request->file('sid')->getClientOriginalExtension();
        } else {
            $sid = null;
        }
        $data = [
            'tgl_izin_dari' => $tgl_izin_dari,
            'tgl_izin_sampai' => $tgl_izin_sampai,
            'keterangan' => $keterangan,
            'doc_sid' => $sid
        ];
        try {
        DB::table('pengajuan_izin')
            ->where('kode_izin', $kode_izin)
            ->update($data);
            if ($request->hasFile('sid')) {
                $sid = $kode_izin . "." . $request->file('sid')->getClientOriginalExtension();
                $folderPath = "public/uploads/sid/";
                $request->file('sid')->storeAs($folderPath, $sid);
            }
            return redirect('/presensi/izin')->with(['success'=>'Data Berhasil Diupdate']);
        } catch (\Exception $e) {
            return redirect('/presensi/izin')->with(['error'=>'Data Gagal Diupdate']);
        }

        if($simpan){
            if ($request->hasFile('sid')) {
                $sid = $kode_izin . "." . $request->file('sid')->getClientOriginalExtension();
                $folderPath = "public/uploads/sid/";
                $request->file('sid')->storeAs($folderPath, $sid);
            }

        }
    }

    // public function sakit(Request $request)
    // {
    //     $query = Pengajuanizin::query();
    //     $query->select('kode_izin', 'tgl_izin_dari', 'tgl_izin_sampai', 'pengajuan_izin.nik', 'nama_lengkap', 'jabatan',
    //     'karyawan.kode_dept', 'karyawan.kode_cabang', 'status_approved', 'keterangan', 'doc_sid', 'status');
    //     $query->join('karyawan', 'pengajuan_izin.nik', '=', 'karyawan.nik');
    //     $query->join('departemen', 'karyawan.kode_dept', '=', 'departemen.kode_dept');
    //     $query->join('cabang', 'karyawan.kode_cabang', '=', 'cabang.kode_cabang');
    //     if(!empty($request->dari) && !empty($request->sampai)){
    //         $query->whereBetween('tgl_izin_dari', [$request->dari, $request->sampai]);
    //     }

    //     if(!empty($request->nik)) {
    //         $query->where('pengajuan_izin.nik' , $request->nik);
    //     }

    //     if(!empty($request->nama_lengkap)) {
    //         $query->where('nama_lengkap' , 'like', '%'. $request->nama_lengkap. '%');
    //     }

    //     if($request->status_approved === '0' || $request->status_approved === '1' || $request->status_approved === '2') {
    //         $query->where('status_approved', $request->status_approved);
    //     }
    //     $query->orderBy('tgl_izin_dari', 'desc');
    //     $izinsakit = $query->paginate(2);
    //     $izinsakit->appends($request->all());
    //     // return $izinsakit;
    //     return view('izin.index', compact('izinsakit'));
    // }

    // public function approvesakit(Request $request)
    // {
    //     $status_approved = $request->status_approved;
    //     $id_izinsakit_form = $request->id_izinsakit_form;
    //     $update = DB::table('pengajuan_izin')->where('kode_izin', $kode_izin_index_form)->update([
    //         'status_approved' => $status_approved
    //     ]);
    //     if($update) {
    //         return Redirect::back()->with(['success' => 'Data Berhasil Diupdate']);
    //     }else{
    //         return Redirect::back()->with(['warning' => 'Data Gagal Diupdate']);
    //     }
    // }

    // public function batalkansakit($id)
    // {
    //     $update = DB::table('pengajuan_izin')->where('kode_izin', $kode_izin)->update([
    //         'status_approved' => 0
    //     ]);
    //     if($update) {
    //         return Redirect::back()->with(['success' => 'Data Berhasil Diupdate']);
    //     }else{
    //         return Redirect::back()->with(['warning' => 'Data Gagal Diupdate']);
    //     }
    // }
}
