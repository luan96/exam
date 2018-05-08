<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Admin_User;
use App\Models\Admin_Role;

class Admin_Role_User extends Model
{
    protected $table = 'admin_role_users';

    public function users()
    {
    	return $this->belongsTo(Admin_User::class, 'user_id');
    }	
    public function roles()
    {
    	return $this->belongsTo(Admin_Role::class, 'role_id');
    }	
}
