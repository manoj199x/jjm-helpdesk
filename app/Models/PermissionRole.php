<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PermissionRole extends Model
{
    use HasFactory;

    protected $table = 'help_permission_role';
    
    protected $fillable=[
        'role_id', 'permission_id'
    ];

    // public function roles(){
    //     return $this->belongsToMany(Role::class);
    // }
    // public function permissions(){ 
    //     return $this->belongsToMany(Permission::class);
    // }

}
