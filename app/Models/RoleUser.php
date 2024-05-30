<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoleUser extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
       'role_id','user_id'
    ];

    protected $table = 'help_role_user';

    protected $with='role';

    public function role() {
        return $this->belongsTo(Role::class, 'role_id', 'id');
    }
}
