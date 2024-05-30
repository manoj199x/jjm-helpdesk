<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DivisionUser extends Model
{
    use HasFactory;

    protected $fillable=[
        'division_id',
        'user_id'
    ];
    protected $table = 'help_division_users';
    protected $with = ['division'];

//    public function users(){
//        return $this->belongsToMany(User::class);
//    }

    public function division(){
        return $this->belongsTo(Division::class,'division_id','id');
    }

}
