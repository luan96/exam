<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\Phanloaicauhoi;
use App\Models\Mon;
use App\Models\Dethi_cauhoi;

class Cauhoi extends Model
{
    protected $table = 'cauhoi';

    public function phanloais()
    {
    	return $this->belongsTo(Phanloaicauhoi::class, 'maphanloai');
    }
    public function mons()
    {
    	return $this->belongsTo(Mon::class, 'mamon');
    }
    public function dethi_cauhois()
    {
    	return $this->belongsTo(Dethi_cauhoi::class);
    }
}
