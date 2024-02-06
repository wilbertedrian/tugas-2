<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;

use App\Models\Stok;
use App\Models\Admin;

class StokController extends Controller
{
    public function index(Request $request)
    {

        // Variable Pencarian
        $cari_judul = $request->cari_judul;
        $cari_nama_admin = $request->cari_nama_admin;

        $tipe_sort = 'desc';
        $var_sort = 'created_at';

        // Prepare Model
        $data_stok = Stok::query();

        // Kondisi Pencarian
        if ($request->filled('cari_judul')) {
            $data_stok = $data_stok->where('nama_barang', 'LIKE', '%' . $cari_judul . '%');
        }

        if ($request->filled('cari_nama_admin')) {
            $data_stok = $data_stok->whereHas('admin', function (Builder $query) use ($cari_nama_admin) {
                $query->where('nama', 'LIKE', '%' . $cari_nama_admin . '%');
            });
        }

        // Kondisi Sorting
        if( $request->has('tipe_sort') || $request->has('var_sort') ) {
            $tipe_sort = $request->tipe_sort;
            $var_sort = $request->var_sort;

            $data_stok = $data_stok->orderBy($var_sort, $tipe_sort);
        }

        // Kondisi Paginate

        $set_pagination = $request->set_pagination;

        if ($request->filled('set_pagination')) {
            $data_stok = $data_stok
                        ->orderBy($var_sort, $tipe_sort)
                        ->paginate($set_pagination);
        } else {
            $data_stok = $data_stok
                        ->orderBy($var_sort, $tipe_sort)
                        ->paginate(5);
        }

        // Append Query String to Pagination
        $data_stok = $data_stok->withQueryString();


        // Return View dengan Data
        return view('stok.index', compact(
            'data_stok',
            'cari_judul',
            'cari_nama_admin',

            'tipe_sort',
            'var_sort',

            'set_pagination'
        ));


    }

    public function tambah()
    {
        $data_admin = Admin::all();

        return view('stok.create', compact('data_admin'));
    }


    public function proses_tambah(Request $request)
    {

        // Aturan Validasi
        $rule_validasi = [
            'nama_barang'         => 'required|min:3',
            'jumlah_stok'      => 'required|numeric',
            'admin_ke'   => 'required',
        ];

        // Custom Message
        $pesan_validasi = [
            'nama_barang.required'        => 'Nama Barang Harus di Isi !',
            'nama_barang.min'             => 'Nama Barang Minimal 3 Karakter !',

            'jumlah_stok.required'     => 'Jumlah Stok Harus di Isi',
            'jumlah_stok.numeric'      => 'Jumlah Stok Harus Berupa Angka',
            'admin_ke.required'  => 'Admin Harus di Isi',
        ];

        // Lakukan Validasi
        $request->validate($rule_validasi, $pesan_validasi);

        // Mapping All Request
        $data_to_save               = new Stok();
        $data_to_save->nama_barang        = $request->nama_barang;
        $data_to_save->jumlah_stok     = $request->jumlah_stok;
        $data_to_save->admin_id  = $request->admin_id;

        // Save to DB
        $data_to_save->save();

        // Kembali dengan Flash Session Data
        return back()->with('status', 'Data Telah Disimpan !');
    }

    public function detail($id)
    {
        $detail_stok = Stok::findOrFail($id);

        return view('stok.detail', compact('detail_stok'));
    }

    public function hapus($id)
    {
        $detail_stok = Stok::findOrFail($id);

        $detail_stok->delete();

        return back()->with('status', 'Data Berhasil di Hapus !');
    }

    public function ubah($id)
    {
        $detail_stok = Stok::findOrFail($id);
        $data_admin = Admin::all();

        return view('stok.edit', compact('detail_stok', 'data_admin'));
    }

    public function proses_ubah(Request $request, $id)
    {

        // Aturan Validasi
        $rule_validasi = [
            'barang'         => 'required|min:3',
            'stok'      => 'required|numeric',
            'admin_ke'   => 'required',
        ];

        // Custom Message
        $pesan_validasi = [
            'barang.required'        => 'Nama Barang Harus di Isi !',
            'barang.min'             => 'Nama Barang Minimal 3 Karakter !',

            'stok.required'     => 'Jumlah Stok Harus di Isi',
            'stok.numeric'      => 'Jumlah Stok Harus Berupa Angka',
            'admin_ke.required'  => 'Admin Harus di Isi',
        ];

        // Lakukan Validasi
        $request->validate($rule_validasi, $pesan_validasi);

        // Mapping All Request
        $data_to_save               = Stok::findOrFail($id);
        $data_to_save->nama_barang        = $request->nama_barang;
        $data_to_save->jumlah_stok     = $request->jumlah_stok;
        $data_to_save->admin_id  = $request->admin_id;

        // Save to DB
        $data_to_save->save();

        // Kembali dengan Flash Session Data
        return back()->with('status', 'Update Data Berhasil !');
    }

}
