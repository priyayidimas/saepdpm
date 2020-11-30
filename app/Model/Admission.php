<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Admission extends Model
{
    protected $table = 'api';
    protected $casts = array(
        'UnivRating' => "float",
        'SOP' => "float",
        'LOR' => "float",
        'CGPA' => "float",
        'RES' => "integer",
        'AdmChance' => "float"
    );
}
