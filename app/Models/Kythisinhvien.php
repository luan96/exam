<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\Admin_User;
use App\Models\Kythi;
use App\Models\Phongthi;
use App\Models\Mon;

class Kythisinhvien extends Model
{
    protected $table = 'kythisinhvien';

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
    public function phongthis()
    {
    	return $this->belongsTo(Phongthi::class, 'maphongthi');
    }
}
