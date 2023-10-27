<?php

namespace App\Http\Controllers;

use App\Models\Karyawan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;



class KaryawanController extends Controller
{
    public function index(Request $request)
    {
        $query = Karyawan::query();
        $query->select('karyawan.*','nama_dept');
        $query->join('departemen','karyawan.kode_dept','=','departemen.kode_dept');
        $query ->orderBy('nik');
        // if(!empty($request->nama_lengkap)){
        //     $query->where('nama_lengkap','like','%'.$request->nama_lengkap . '%');
        // }

        if(!empty($request->kode_dept)){
            $query->where('karyawan.kode_dept',$request->kode_dept);
        }
        $karyawan = $query->paginate();

        $departemen = DB::table('departemen')->get();
        $cabang = DB::table('cabang')->orderBy('kode_cabang')->get();
        return view ('karyawan.index', compact('karyawan','departemen','cabang'));
    }

    public function store(Request $request)
    {
        $nik = $request->nik;
        $nama_lengkap = $request->nama_lengkap;
        $jabatan = $request->jabatan;
        $no_hp = $request->no_hp;
        $kode_dept = $request->kode_dept;
        $password = Hash::make('12345');
        $kode_cabang = $request->kode_cabang;
        $waktu_kerja = $request->waktu_kerja;
        
        if($request->hasFile('foto')) {
            $foto = $nik.".".$request->file('foto')->getClientOriginalExtension();
        }else{
            $foto = null;
        }

        try{
            $data = [
                'nik' => $nik,
                'nama_lengkap' => $nama_lengkap,
                'jabatan' => $jabatan,
                'no_hp' => $no_hp,
                'kode_dept' => $kode_dept,
                'foto' => $foto,
                'password' => $password,
                'kode_cabang' => $kode_cabang,
                'waktu_kerja' => $waktu_kerja
            ];
            $simpan = DB::table('karyawan')->insert($data);
            if ($simpan) {
                if ($request->hasFile('foto')){
                    $folderPath = "public/uploads/karyawan/";
                    $request->file('foto')->storeAs($folderPath, $foto);
                }
                return Redirect::back()->with(['success' => 'Data Berhasil Disimpan']); 
            }
        } catch (\Exception $e) {
            if ($e->getCode() == 23000 ) {
                $message = " Data dengan Nik " .  $nik  . " Sudah Ada ";
            }else{
                $message = " Hubungi IT";
            }
            // dd($e->message);
            return Redirect::back()->with(['warning' => ' Data Gagal Disimpan ' . $message]); 
        }
    }

    public function edit(Request $request)
    {
        $nik = $request->nik;
        $departemen = DB::table('departemen')->get();
        $cabang = DB::table('cabang')->orderBy('kode_cabang')->get();
        $karyawan = DB::table('karyawan')->where('nik',$nik)->first();

        return view('karyawan.edit',compact('departemen','karyawan', 'cabang'));
    }

    public function update($nik, Request $request)
    {
        $karyawan = DB::table('karyawan')->where('nik',$request->nik)->first();
        $old_foto = $karyawan->foto;

        $nik = $request->nik;
        $nama_lengkap = $request->nama_lengkap;
        $jabatan = $request->jabatan;
        $no_hp = $request->no_hp;
        $kode_dept = $request->kode_dept;
        $kode_cabang = $request->kode_cabang;
        $waktu_kerja = $request->waktu_kerja;
        $password = Hash::make('12345');
        
        if($request->hasFile('foto')) {
            $foto = $nik.".".$request->file('foto')->getClientOriginalExtension();
        }else{
            $foto = $old_foto;
        }

        try{
            $data = [
                'nama_lengkap' => $nama_lengkap,
                'jabatan' => $jabatan,
                'no_hp' => $no_hp,
                'kode_dept' => $kode_dept,
                'foto' => $foto,
                'password' => $password,
                'kode_cabang' => $kode_cabang,
                'waktu_kerja' => $waktu_kerja,
            ];
            $update = DB::table('karyawan')->where('nik', $nik)->update($data);
            if ($update) {
                if ($request->hasFile('foto')){
                    $folderPath = "public/uploads/karyawan/";
                    $folderPathOld = "public/uploads/karyawan/" . $old_foto;
                    Storage::delete($folderPathOld);
                    $request->file('foto')->storeAs($folderPath, $foto);
                }
                return Redirect::back()->with(['success' => 'Data Berhasil Di Update']); 
            }
        } catch (\Exception $e) {
            // dd($e->message);
            return Redirect::back()->with(['warning' => 'Data Gagal Di Update']); 
        }
    }

    public function delete($nik)
    {
        $delete = DB::table('karyawan')->where('nik', $nik)->delete();
        if($delete){
            return Redirect::back()->with(['success'=>'Data Berhasil Dihapus']);
        }else{
            return Redirect::back()->with(['warning'=>'Data Gagal Dihapus']);
        }
    }

    public function resetpassword($nik)
    {
        $password_default = Hash::make('12345');
        try {
            DB::table('karyawan')->where('nik', $nik)->update(['password' => $password_default]);
            return Redirect::back()->with(['success' => 'Password Berhasil di Reset']);
        } catch (\Exception $e) {
            return Redirect::back()->with(['warning' => 'Password Gagal di Reset']);
        }
    }
}
