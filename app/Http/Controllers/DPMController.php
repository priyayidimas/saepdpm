<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\BAP;
use Illuminate\Support\Facades\DB;
use App\Model\Admission;

class DPMController extends Controller
{
    public function index()
    {
        DB::beginTransaction();
        $a = BAP::find(1);
        DB::commit();
        echo $a->variabel;
    }
}
