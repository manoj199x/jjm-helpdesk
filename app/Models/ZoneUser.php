<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ZoneUser extends Model
{
    use HasFactory;
    protected $table = 'help_zone_users';
    protected $fillable=[
        'zone_id',
        'user_id'
    ];
}
