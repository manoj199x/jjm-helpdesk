<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class AssignHistory extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'help_assign_histories';

    protected $guarded = [
        'id'
    ];
    public function assign_to(){
        return $this->belongsTo(User::class,'to_user_id','id');
    }
    public function assigned_by(){
        return $this->belongsTo(User::class,'from_user_id','id');
    }

    public function status_name(){
        return $this->belongsTo(Status::class,'status','id');
    }
}
