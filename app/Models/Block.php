<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Block extends Model
{
    use HasFactory;
    protected $fillable=[
        'block_name',
        'district_id'
    ];
    protected $table = 'block_master';
    protected $with = ['district'];

    public function district(){
        return $this->belongsTo(District::class,'district_id','id');
    }
}
