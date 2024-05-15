<?php

namespace App\Http\Controllers;

use App\Models\Division;
use App\Models\IssueTracking;
use App\Models\IssueType;
use App\Models\PhysicalProgress;
use App\Models\SchemeCompletion;
use App\Models\Status;
use App\Models\userType;
use App\Models\VillagePhysicalProgress;
use Carbon\Carbon;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;

class DashboardController extends Controller
{
    //
    public function index(Request $request, $module, $user_id)
    {
        $user_tables = [
            'ebill' => 'ebill_login',
            'crs' => 'crs_users',
            'hrms' => 'hrm_users',
        ];

        $user = DB::select('select * from '.$user_tables[$module].' where id = ?', [$user_id]);

        if($module!='hrms') {
            $request->session()->put('user_name', $user[0]->name);
        }
        
        $request->session()->put('user_id', $user[0]->user_id);
        $request->session()->put('user_type', $user[0]->user_type);
        $request->session()->put('circle_zone', $user[0]->circle_zone);
        $request->session()->put('id', $user[0]->id);
        $request->session()->put('module', $module);


//        dd(isset(auth()->user()->division_users->division_id));
//        if(auth()->user()->roles()->get()->contains(2)){
//            $divisionId = auth()->user()->division_users->division_id;
//
//            $schemeCompletion = SchemeCompletion::where("created_at", '>', $sessionStart)->where("created_at", '<', $sessionEnd)->where("division_id", '=', $divisionId)->get();
//
//        } else {
//            $schemeCompletion = SchemeCompletion::where("created_at", '>', $sessionStart)->where("created_at", '<', $sessionEnd)->get();
//        }

        if(Auth::check()) {
            $user = Auth::user();
            $user_type=userType::select('name')->where('id',$user->user_type)->first();
            if ($user->hasAnyRole(['TO-IT']) || $user->hasAnyRole(['SPS'])){

                $my_issues = \App\Models\AssignHistory::where('to_user_id',auth()->user()->id)->where('active',1)->get();
                $pending_issue = $my_issues->where('status',1)-> count();
                $resolved_issue = $my_issues->where('status',3)-> count();
                $accept_issue = $my_issues->where('status',4)-> count();

            } else {
                $my_issues = \App\Models\IssueTracking::where('users_id',auth()->user()->id)->get();
                $pending_issue = $my_issues->where('application_status',1)->where('users_id',auth()->user()->id)-> count();
                $resolved_issue = $my_issues->where('application_status',3)->where('users_id',auth()->user()->id)-> count();
                $accept_issue = $my_issues->where('application_status',4)->where('users_id',auth()->user()->id)-> count();

            }
        } else {
            if(Session::get('id')!=null)
                $user_id = Session::get('id');
                $user_type = Session::get('user_type');
                $my_issues = \App\Models\IssueTracking::where('users_id',Session::get('id'))->get();
                $pending_issue = $my_issues->where('application_status',1)->where('users_id',$user_id)-> count();
                $resolved_issue = $my_issues->where('application_status',3)->where('users_id',$user_id)-> count();
                $accept_issue = $my_issues->where('application_status',4)->where('users_id',$user_id)-> count();

        }
        $total_issue = $my_issues->count();

        if(auth()->check()) {
            $user = Auth::user();
    //      if($request->description )
    //      {
            if ($user->hasAnyRole(['TO-IT']) || $user->hasAnyRole(['SPS']) ) {
                $issue_tracking = IssueTracking::with('issue_relato_to', 'issue_types', 'assign_histroty')
                    ->whereHas('assign_histroty', function ($query) {
                        $query->where('to_user_id', Auth::user()->id);
                    });
            } else {
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
        else {
            if(session()->has('id')) {
                $issue_tracking = IssueTracking::with('issue_relato_to', 'issue_types', 'assign_histroty', 'assign_histroty')
                ->whereHas('assign_histroty', function ($query) {
                    $query->where('from_user_id', session()->get('id'));
                });

                $issue_tracking = $issue_tracking->when(request("issue_type"), function ($query) {
                    $query->where('issue_type', request("issue_type"));
    
                })->when(request("status"), function ($query) {
                    $query->where('application_status', request("status"));
                
                })->when(request('ticket_no'), function ($query) {
                    $query->where('serial_no', 'like' ,'%'.request("ticket_no").'%' );
    
                })->orderBy('id','desc')->paginate(10);
            }
        }
        

        return view('dashboard',compact('issue_tracking', 'total_issue','pending_issue','resolved_issue','accept_issue','user_type') );
    }
}
