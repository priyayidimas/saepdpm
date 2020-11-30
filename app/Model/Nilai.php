<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Nilai extends Model
{
    protected $table = 'form_kegiatan';

    protected $guarded = [];

    public function form()
    {
        return $this->belongsTo('App\Model\Indikator', 'form_id');
    }

    public function kegiatan()
    {
        return $this->belongsTo('App\Model\Kegiatan', 'kegiatan_id');
    }
}
