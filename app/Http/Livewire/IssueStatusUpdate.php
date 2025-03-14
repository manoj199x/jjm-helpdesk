<?php

namespace App\Http\Livewire;

use App\Helper\FCMHelpers;
use App\Models\AssignHistory;
use App\Models\Circle;
use App\Models\CircleUser;
use App\Models\Division;
use App\Models\DivisionUser;
use App\Models\IssueTracking;
use App\Models\IssueType;
use App\Models\Status;
use App\Models\SubIssueType;
use App\Models\User;
use App\Models\ZoneMappingWithTO;
use App\Models\ZoneUser;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class IssueStatusUpdate extends Component
{
    public $status;
    public $issueId;
    public $issue_status;
    public $remarks;
    public $description;
    public $issue_id;
    public $forward_to;
    public function submitForm()
    {

        $this->validate([
            'status' => 'required',
            'remarks' => 'required',
        ]);
        if($this->status==2)
        {

            $assign_history=AssignHistory::where('issue_id',$this->issueId)->where('active',1)->first();
            AssignHistory::where('issue_id',$this->issueId)->update(['active'=>0]);
            
            $data=[
                'issue_id'=>$this->issueId,
                'from_user_id'=>  Auth::user()->id,
                'to_user_id'=>$this->forward_to,
                'active'=>1,
                'sub_date'=>$assign_history->sub_date,
                'status'=>$this->status,
                'from_remarks' => $this->remarks,
                'status_updated_at'=>Carbon::now(),
            ];
            AssignHistory::create($data);
            IssueTracking::where('id',$this->issueId)->update(['application_status'=>$this->status]);
        }

        if($this->status==3)
        {
            
            AssignHistory::where('issue_id',$this->issueId)
                ->where('active',1)
                ->update([
                    'status'=>$this->status,
                    'to_remarks'=>$this->remarks,
                ]);
                
            IssueTracking::where('id',$this->issueId)->update(
                ['application_status'=>$this->status,
                'is_closed' => 1
                ]
            );
        }
        $issue = IssueTracking::where('id', $this->issueId)->first();

        if ($issue && $issue->fcm_token) {
            FCMHelpers::sendNotification(
                $issue->fcm_token,
                "Status Updated for Ticket '{$issue->serial_no}' ",
                "Issue: '{$issue->description}'"
            );
        }
        return redirect()->route('get_issue_data',$this->issueId)->with('success', 'Issue Updated successfully!');

    }
    public function render()
    {
        $issue_types = IssueType::get();
        $sub_issueTypes = SubIssueType::get();
        $status_name=Status::get();
        $role = User::whereHas('role_user', function ($query) {
            $query->whereHas('role', function($query) {
                $query->where('title', 'SPS');
            }); 
        })->get();
        
        $issue_tracking=IssueTracking::with('issue_relato_to','issue_types')
            ->where('id',$this->issueId)->first();
        

        return view(
            'livewire.issue-status-update',
            [  
                'issue_types' => $issue_types,
                'sub_issueTypes'=>$sub_issueTypes,
                'status_name'=>$status_name,
                'role'=>$role,
                'issueId'=>$this->issueId,
                'issue_tracking'=>$issue_tracking,
            ]
        );
    }
}
