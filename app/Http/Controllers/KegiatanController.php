<?php

namespace App\Http\Controllers;

use App\Model\Kegiatan;
use App\Model\Divisi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class KegiatanController extends Controller
{
    public function index()
    {
        $divisi = Divisi::all();
        $kegiatan = Kegiatan::all();
        return view('kegiatan.kegiatan',compact('kegiatan','divisi'));
    }

    public function insertKegiatan(Request $request)
    {
        try {
            $kegiatan = new Kegiatan;
            $kegiatan->fill($request->all());
            $kegiatan->save();
            return back()->with(['color' => 'success', 'msg' => 'Berhasil Memasukkan Proker']);
        } catch (\Throwable $th) {
            return back()->with(['color' => 'error', 'msg' => 'Gagal Memasukkan Proker']);
        }
    }

    public function editKegiatan($id)
    {
        $kegiatan = Kegiatan::find($id);
        $divisi = Divisi::all();
        return view('kegiatan.kegiatan-edit', compact('kegiatan','divisi'));
    }

    public function updateKegiatan(Request $request)
    {
        try {
            $kegiatan = Kegiatan::find($request->id);
            $kegiatan->fill($request->all());
            $kegiatan->save();
            return back()->with(['color' => 'success', 'msg' => 'Berhasil Mengubah Proker']);
        } catch (\Throwable $th) {
            return back()->with(['color' => 'error', 'msg' => 'Gagal Mengubah Proker']);
        }
    }

    public function deleteKegiatan(Request $request)
    {
        try {
            $kegiatan = Kegiatan::find($request->id);

            $ttd = str_replace(url('')."/storage/ttd_pengawas/",'',$kegiatan->pengawas_ttd);

            Storage::disk('public')->delete('ttd_pengawas/'.$ttd);

            $kegiatan->delete();
            return back()->with(['color' => 'success', 'msg' => 'Berhasil Menghapus Proker']);
        } catch (\Throwable $th) {
            return back()->with(['color' => 'error', 'msg' => 'Gagal Menghapus Proker']);
        }
    }
}
