<?php

namespace App\Http\Controllers;

use App\Exports\AdmissionExport;
use App\Http\Controllers\Controller;
use App\Model\Admission;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel as Excel;
use Illuminate\Support\Facades\Schema;
class AdmissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $admissions = Admission::orderBy('id','desc')->get();
        return response()->json(["data" => $admissions],200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $admission = new Admission();
        $admission->name = $request->name;
        $admission->GREScore = $request->GREScore;
        $admission->TOEFLScore = $request->TOEFLScore;
        $admission->UnivRating = $request->UnivRating;
        $admission->SOP = $request->SOP;
        $admission->LOR = $request->LOR;
        $admission->CGPA = $request->CGPA;
        $admission->RES = $request->RES;
        $admission->AdmChance = $request->AdmChance;
        $admission->save();

        return response()->json(['msg' => "INSERT_OK"],200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\DPM\Admission  $admission
     * @return \Illuminate\Http\Response
     */
    public function show(Admission $admission)
    {
        return response()->json(["data" => $admission],200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\DPM\Admission  $admission
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Admission $admission)
    {
        $admission->name = $request->name;
        $admission->GREScore = $request->GREScore;
        $admission->TOEFLScore = $request->TOEFLScore;
        $admission->UnivRating = $request->UnivRating;
        $admission->SOP = $request->SOP;
        $admission->LOR = $request->LOR;
        $admission->CGPA = $request->CGPA;
        $admission->RES = $request->RES;
        $admission->AdmChance = $request->AdmChance;
        $admission->save();

        return response()->json(['msg' => "UPDATE_OK"],200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\DPM\Admission  $admission
     * @return \Illuminate\Http\Response
     */
    public function destroy(Admission $admission)
    {
        $admission->delete();
        return response()->json(['msg' => "DELETE_OK"],200);
    }

    public function save_csv()
    {
        return Excel::download(new AdmissionExport,'student-admission.csv');
    }

}
