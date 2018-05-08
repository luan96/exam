<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Mon;
use App\Models\Phanloaicauhoi;
use App\Models\Kythi_de;
use App\Models\Dethi_cauhoi;
class Dethi extends Model
{
    protected $table = 'dethi';

    public function mons()
    {
    	return $this->belongsTo(Mon::class, 'mon');
    }
    public function phanloais()
    {
    	return $this->belongsTo(Phanloaicauhoi::class, 'phanloai');
    }
    public function kythi_des(){
        return $this->hasOne(Kythi_de::class);

    }
    public function dethi_cauhois(){
    	return $this->belongsTo(Dethi_cauhoi::class);

    }
}
