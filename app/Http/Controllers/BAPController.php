<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB as DB;
use App\Model\BAP;
use App\Model\Kegiatan;
use App\Model\Nilai;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use PDO;
use Barryvdh\DomPDF\Facade as PDF;


class BAPController extends Controller
{
    public function index()
    {
        $kegiatan = Kegiatan::whereNotNull('pengawas_ttd')->orderBy('updated_at','desc')->get();
        return view('bap.index',compact('kegiatan'));
    }

    public function createBAPProker($proker)
    {
        $kegiatan = Kegiatan::findOrFail($proker);
        if($kegiatan->pengawas_ttd){
            return view('bap.form-edit-proker',compact('kegiatan'));
        }else{
            return view('bap.form-isi-proker',compact('kegiatan'));
        }
    }

    public function insertBAPProker(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'pengawas_nama' => 'required',
            'pengawas_nim' => 'required',
            'form' => 'required',
            'evaluasi' => 'required',
            'rekomendasi' => 'required'
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput($request->input());
        }

        $kegiatan = Kegiatan::find($request->kegiatan_id);

        $oldttd = $kegiatan->pengawas_ttd;

        $kegiatan->pengawas_nama = $request->pengawas_nama;
        $kegiatan->pengawas_nim = $request->pengawas_nim;
        $kegiatan->evaluasi = nl2br($request->evaluasi);
        $kegiatan->rekomendasi = nl2br($request->rekomendasi);

        foreach ($request->form as $id => $value) {
            $nilai = new Nilai;
            $nilai->kegiatan_id = $kegiatan->id;
            $nilai->form_id = $id;
            $nilai->nilai = $value;
            $nilai->save();
        }

        if (preg_match('/^data:image\/(\w+);base64,/', $request->pengawas_ttd, $type)) {
            $random = rand(100000,999999);
            $img = substr($request->pengawas_ttd, strpos($request->pengawas_ttd, ',') + 1);
            $type = strtolower($type[1]); // jpg, png, gif

            if (!in_array($type, [ 'jpg', 'jpeg', 'gif', 'png' ])) {
                throw new \Exception('invalid image type');
            }
            $img = str_replace( ' ', '+', $img );
            $img = base64_decode($img);

            if ($img === false) {
                throw new \Exception('base64_decode failed');
            }
            $path = 'ttd_pengawas/'.date("YmdHis").'_'.$random.'.'.$type;
            Storage::disk('public')->put($path, $img);
            if($oldttd){
                Storage::delete('public/ttd_pengawas/'.$oldttd);
            }
            $kegiatan->pengawas_ttd = 'storage/'.$path;
        } else {
            throw new \Exception('did not match data URI with image data');
        }

        $kegiatan->save();
        return redirect(route('kegiatan'))->with(['color' => 'success', 'msg' => 'Berhasil Menilai Proker']);
    }

    public function updateBAPProker(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'pengawas_nama' => 'required',
            'pengawas_nim' => 'required',
            'form' => 'required',
            'evaluasi' => 'required',
            'rekomendasi' => 'required'
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput($request->input());
        }

        $kegiatan = Kegiatan::find($request->kegiatan_id);

        $oldttd = str_replace("storage/ttd_pengawas/",'',$kegiatan->pengawas_ttd);

        $kegiatan->pengawas_nama = $request->pengawas_nama;
        $kegiatan->pengawas_nim = $request->pengawas_nim;
        $kegiatan->evaluasi = nl2br($request->evaluasi);
        $kegiatan->rekomendasi = nl2br($request->rekomendasi);

        foreach ($request->form as $id => $value) {
            $nilai = Nilai::updateOrCreate(['form_id' => $id, 'kegiatan_id' => $kegiatan->id], ['nilai' => $value]);
        }

        if (preg_match('/^data:image\/(\w+);base64,/', $request->pengawas_ttd, $type)) {
            $random = rand(100000,999999);
            $img = substr($request->pengawas_ttd, strpos($request->pengawas_ttd, ',') + 1);
            $type = strtolower($type[1]); // jpg, png, gif

            if (!in_array($type, [ 'jpg', 'jpeg', 'gif', 'png' ])) {
                throw new \Exception('invalid image type');
            }
            $img = str_replace( ' ', '+', $img );
            $img = base64_decode($img);

            if ($img === false) {
                throw new \Exception('base64_decode failed');
            }
            $path = 'ttd_pengawas/'.date("YmdHis").'_'.$random.'.'.$type;
            Storage::disk('public')->put($path, $img);
            if($oldttd != NULL){
                Storage::disk('public')->delete('ttd_pengawas/'.$oldttd);
            }
            $kegiatan->pengawas_ttd = 'storage/'.$path;
        } else {
            throw new \Exception('did not match data URI with image data');
        }

        $kegiatan->save();
        return redirect(route('kegiatan'))->with(['color' => 'success', 'msg' => 'Berhasil Menilai Proker']);
    }

    public function printBAP($id){
        $kegiatan = Kegiatan::find($id);
        $ketua = [
            "nim" => DB::table('config')->where('id','ketua_nim')->first()->value,
            "nama" => DB::table('config')->where('id','ketua_nama')->first()->value,
            "ttd" => DB::table('config')->where('id','ketua_ttd')->first()->value
        ];

        $pdf = PDF::loadView('bap.print',compact('kegiatan','ketua'));
        return $pdf->download('BAP '.$kegiatan->nama.'.pdf');
    }

}
