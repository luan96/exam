<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\Dethi;
use App\Models\Cauhoi;

class Dethi_cauhoi extends Model
{
    protected $table = 'dethi_cauhoi';

    public function dethis()
    {
    	return $this->belongsTo(Dethi::class, 'madethi');
    }
    public function cauhois()
    {
    	return $this->belongsTo(Cauhoi::class, 'macauhoi');
    }
}
