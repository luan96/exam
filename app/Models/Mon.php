<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Cauhoi;
class Mon extends Model
{
    protected $table = 'mon';

    public function cauhois()
    {
    	return $this->belongsToMany(Cauhoi::class);
    }

}
