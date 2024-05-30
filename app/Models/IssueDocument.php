<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IssueDocument extends Model
{
    use HasFactory;
    
    protected $table = 'help_issue_documents';

    protected $guarded = [
        'id',
    ];
    protected $with=['document_types'];

    public function issue()
    {
        return $this->belongsTo(IssueTracking::class,'id','issue_id');
    }

    public function document_types()
    {
        return $this->belongsTo(Document::class,'document_type','id');
    }
}
