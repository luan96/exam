<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\Kythi;
use App\Models\Dethi;

class Kythi_de extends Model
{
    protected $table = 'kythi_de';

    public function kythis()
    {
    	return $this->belongsTo(Kythi::class, 'makythi');
    }
    public function dethis()
    {
    	return $this->belongsTo(Dethi::class, 'madethi');
    }
}
