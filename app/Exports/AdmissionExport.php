<?php

namespace App\Exports;

use App\Model\DPM\Admission;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Support\Facades\Schema;
use Maatwebsite\Excel\Concerns\WithStrictNullComparison;

class AdmissionExport implements FromCollection,WithHeadings, WithStrictNullComparison
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Admission::all();
    }

    public function headings(): array
    {

        return Schema::connection('dpm')->getColumnListing('api');
        // return Schema::getColumnListing('api');
    }
}
