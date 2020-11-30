<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Indikator extends Model
{
    protected $table = 'form_format';

    public function nilai()
    {
        return $this->hasMany('App\Model\Nilai', 'form_id');
    }
}
