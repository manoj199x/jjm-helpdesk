<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CircleUser extends Model
{
    use HasFactory;
    
    protected $table = 'help_circle_users';

    protected $guarded = [
        'id'
    ];
}
