<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class IssueType extends Model
{
    use HasFactory;
    use SoftDeletes;
    
    protected $table = 'help_issue_types';

    public function sub_issue_type(){
        return $this->belongsTo(SubIssueType::class,'issue_type_id','id');
    }
}
