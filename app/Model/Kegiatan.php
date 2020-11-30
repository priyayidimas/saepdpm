<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Kegiatan extends Model
{
    protected $table = 'kegiatan';

    protected $guarded = [];

    public function nilai()
    {
        return $this->hasMany('App\Model\Nilai', 'kegiatan_id');
    }

    public function divisi()
    {
        return $this->belongsTo('App\Model\Divisi', 'divisi_id');
    }
}
