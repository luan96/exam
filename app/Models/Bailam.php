<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Admin_User;
use App\Models\Kythi;
use App\Models\Dethi;
use App\Models\Cauhoi;
use App\Models\Mon;

class Bailam extends Model
{
    protected $table = 'bailam';

    public function users()
    {
    	return $this->belongsTo(Admin_User::class, 'user_id');
    }
    public function kythis()
    {
    	return $this->belongsTo(Kythi::class, 'makythi');
    }
    public function mons()
    {
    	return $this->belongsTo(Mon::class, 'mamon');
    }
    public function dethis()
    {
        return $this->belongsTo(Dethi::class, 'madethi');
    }
    public function cauhois()
    {
        return $this->belongsTo(Cauhoi::class, 'macauhoi');
    }
}
