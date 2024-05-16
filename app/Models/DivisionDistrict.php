<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DivisionDistrict extends Model
{
    use HasFactory;
    protected $fillable=[
        'division_id',
        'district_id',
    ];
    protected $with = ['division_master','district_master'];


    public function division()
    {
        return $this->hasOne(Division::class,  'id','division_id');
    }
    public function district()
    {
        return $this->hasOne(District::class,  'id','district_id');
    }

}
