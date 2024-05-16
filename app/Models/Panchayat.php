<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Panchayat extends Model
{
    use HasFactory;
    protected $table = 'panchayat_master';
    protected $fillable=[
        'panchayat_name',
        'block_id'
    ];
    protected $with = ['block_master'];

//    public function users(){
//        return $this->belongsToMany(User::class);
//    }

    public function block(){
        return $this->belongsTo(Block::class,'block_id','id');
    }

}
