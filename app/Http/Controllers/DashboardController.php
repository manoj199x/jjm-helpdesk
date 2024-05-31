<?php

namespace App\Http\Controllers;

use App\Models\IssueTracking;
use App\Models\Role;
use App\Models\RoleUser;
use App\Models\userType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    //
    public function index(Request $request)
    {


        if(Auth::check()) {
            $user = Auth::user();
            $roleuser=RoleUser::where('user_id',$user->id)->first();
            if ($user->hasAnyRole(['TO-IT']) || $user->hasAnyRole(['SPS'])){

                $my_issues = \App\Models\AssignHistory::where('to_user_id',auth()->user()->id)->where('active',1)->get();
                $pending_issue = $my_issues->where('status',1)-> count();
                $resolved_issue = $my_issues->where('status',3)-> count();
                $accept_issue = $my_issues->where('status',4)-> count();

                $issue_tracking = IssueTracking::with('issue_relato_to', 'issue_types', 'assign_histroty')
                ->whereHas('assign_histroty', function ($query) {
                    $query->where('to_user_id', Auth::user()->id);
                });

            } else {
                $my_issues = \App\Models\IssueTracking::where('users_id',auth()->user()->id)->get();
                $pending_issue = $my_issues->where('application_status',1)->where('users_id',auth()->user()->id)-> count();
                $resolved_issue = $my_issues->where('application_status',3)->where('users_id',auth()->user()->id)-> count();
                $accept_issue = $my_issues->where('application_status',4)->where('users_id',auth()->user()->id)-> count();

                $issue_tracking = IssueTracking::with('issue_relato_to', 'issue_types', 'assign_histroty')
                ->whereHas('assign_histroty', function ($query) {
                    $query->where('to_user_id', Auth::user()->id);
                });

            }

            $issue_tracking = $issue_tracking->when(request("issue_type"), function ($query) {
                $query->where('issue_type', request("issue_type"));

            })->when(request("status"), function ($query) {
                $query->where('application_status', request("status"));

            })->when(request('ticket_no'), function ($query) {
                $query->where('serial_no', 'like' ,'%'.request("ticket_no").'%' );
            
            })->orderBy('id','desc')->paginate(10);
        } 

        $total_issue = $my_issues->count();

        //     if(session()->has('id')) {
        //         $user_id = Session::get('id');
        //         $user_type = Session::get('user_type');
        //         $my_issues = \App\Models\IssueTracking::where('users_id',Session::get('id'))->get();
        //         $pending_issue = $my_issues->where('application_status',1)->where('users_id',$user_id)-> count();
        //         $resolved_issue = $my_issues->where('application_status',3)->where('users_id',$user_id)-> count();
        //         $accept_issue = $my_issues->where('application_status',4)->where('users_id',$user_id)-> count();

        //         $issue_tracking = IssueTracking::with('issue_relato_to', 'issue_types', 'assign_histroty', 'assign_histroty')
        //         ->whereHas('assign_histroty', function ($query) {
        //             $query->where('from_user_id', session()->get('id'));
        //         });

        //         $issue_tracking = $issue_tracking->when(request("issue_type"), function ($query) {
        //             $query->where('issue_type', request("issue_type"));
    
        //         })->when(request("status"), function ($query) {
        //             $query->where('application_status', request("status"));
                
        //         })->when(request('ticket_no'), function ($query) {
        //             $query->where('serial_no', 'like' ,'%'.request("ticket_no").'%' );
    
        //         })->orderBy('id','desc')->paginate(10);
        //     }
        

        return view('dashboard',compact('issue_tracking', 'total_issue','pending_issue','resolved_issue','accept_issue') );
    }
}
