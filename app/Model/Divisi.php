<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Divisi extends Model
{
    protected $table = 'divisi';

    public function kegiatan()
    {
        return $this->hasMany('App\Model\Kegiatan', 'divisi_id');
    }
}
