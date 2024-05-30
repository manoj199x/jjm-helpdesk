<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IssueType extends Model
{
    use HasFactory;
    
    protected $table = 'help_issue_types';

    public function sub_issue_type(){
        return $this->belongsTo(SubIssueType::class,'issue_type_id','id');
    }
}
