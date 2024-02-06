<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;

class AdminController extends Controller
{

    public function index()
    {
        $data_admin = Admin::all();

        return view('admin.index', compact('data_admin'));
    }

    public function tambah()
    {
        return view('admin.create');
    }


    public function proses_tambah(Request $request)
    {

        // Aturan Validasi
        $rule_validasi = [
            'nama'         => 'required|min:3',
            'jabatan'       => 'required|min:3',
        ];

        // Custom Message
        $pesan_validasi = [
            'nama.required'        => 'Nama Harus di Isi !',
            'nama.min'             => 'Nama Minimal 3 Karakter !',

            'jabatan.required'        => 'Jabatan Harus di Isi !',
            'jabatan.min'             => 'Jabatan Minimal 3 Karakter !',
        ];

        // Lakukan Validasi
        $request->validate($rule_validasi, $pesan_validasi);

        // Mapping All Request
        $data_to_save               = new Admin();
        $data_to_save->nama         = $request->nama;
        $data_to_save->jabatan       = $request->jabatan;

        // Save to DB
        $data_to_save->save();

        // Kembali dengan Flash Session Data
        return back()->with('status', 'Data Telah Disimpan !');
    }

    public function detail($id)
    {
        $detail_admin = Admin::findOrFail($id);

        return view('admin.detail', compact('detail_admin'));
    }

    public function hapus($id)
    {
        $detail_admin = Admin::findOrFail($id);

        if ($detail_admin->stok()->exists()) {
            return back()->with('status', 'Tidak dapat hapus data ber-relasi !');
        }

        $detail_admin->delete();

        return back()->with('status', 'Data Berhasil di Hapus !');
    }

    public function ubah($id)
    {
        $detail_admin = Admin::findOrFail($id);

        return view('admin.edit', compact('detail_admin'));
    }

    public function proses_ubah(Request $request, $id)
    {

        // Aturan Validasi
        $rule_validasi = [
            'nama'         => 'required|min:3',
            'jabatan'       => 'required|min:3',
        ];

        // Custom Message
        $pesan_validasi = [
            'nama.required'        => 'Nama Harus di Isi !',
            'nama.min'             => 'Nama Minimal 3 Karakter !',

            'jabatan.required'        => 'Jabatan Harus di Isi !',
            'jabatan.min'             => 'Jabatan Minimal 3 Karakter !',
        ];

        // Lakukan Validasi
        $request->validate($rule_validasi, $pesan_validasi);

        // Mapping All Request
        $data_to_save               = Admin::findOrFail($id);
        $data_to_save->nama         = $request->nama;
        $data_to_save->jabatan       = $request->jabatan;

        // Save to DB
        $data_to_save->save();

        // Kembali dengan Flash Session Data
        return back()->with('status', 'Data Telah Disimpan !');
    }

}
