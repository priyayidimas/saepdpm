<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB as DB;
use App\Model\Indikator;

class IndikatorController extends Controller
{
    public function index()
    {
        return view('indikator.indikator');
    }
    public function insertIndikator(Request $req)
    {
        $data = new Indikator();
        $data->variabel = $req->variabel;
        $data->indikator = $req->indikator;
        $data->keterangan = nl2br($req->keterangan);
        $data->section_id = $req->section_id;
        $data->n1 = $req->val[0];
        $data->n2 = $req->val[1];
        $data->n3 = $req->val[2];
        $data->n4 = $req->val[3];
        if($data->save()){
            return redirect(route('indikator'))->with(['msg' => 'Indikator Baru Dibuat!','color' => 'success']);
        }else{
            return redirect(route('indikator'))->with(['msg' => 'Indikator Baru Gagal!','color' => 'danger']);
        }
    }
    public function editIndikator($id)
    {
        $data = Indikator::where('id','=',$id)->first();
        return view('indikator.indikator-edit',['data' => $data]);
    }
    public function updateIndikator(Request $req)
    {
        $data = Indikator::find($req->id);
        $data->variabel = $req->variabel;
        $data->indikator = $req->indikator;
        $data->keterangan = nl2br($req->keterangan);
        $data->section_id = $req->section_id;
        $data->n1 = $req->val[0];
        $data->n2 = $req->val[1];
        $data->n3 = $req->val[2];
        $data->n4 = $req->val[3];
        if($data->save()){
            return redirect(route('indikator'))->with(['msg' => 'Indikator Diubah!','color' => 'success']);
        }else{
            return redirect(route('indikator'))->with(['msg' => 'Indikator Gagal!','color' => 'danger']);
        }
    }
    public function deleteIndikator(Request $req)
    {
        Indikator::find($req->id)->delete();
        return redirect(route('indikator'))->with(['msg' => 'Indikator Dihapus!','color' => 'success']);
    }
}
