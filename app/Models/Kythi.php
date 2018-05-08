<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\Kythi_de;

class Kythi extends Model
{
    protected $table = 'kythi';

    public function kythi_des(){
    	return $this->hasOne(Kythi_de::class);
    }
}
