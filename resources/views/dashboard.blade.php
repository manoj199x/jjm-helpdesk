@extends('layouts.master')

@section('main-body')
    <div class="container-fluid">
        
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-6 col-xl-3">
                        <div class="card overflow-hidden rounded-2">
                            <div class="position-relative"></div>
                            <div class="card-body pt-3 p-4">
                                <h6 class="fw-semibold fs-4">Total Issue</h6>
                                <h3> {{$total_issue}}</h3>
                                <div class="d-flex align-items-center justify-content-between">

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-xl-3">
                        <div class="card overflow-hidden rounded-2">
                            <div class="position-relative"></div>
                            <div class="card-body pt-3 p-4">
                                <h6 class="fw-semibold fs-4">Pending issue</h6>
                                <h3>  {{$pending_issue}}</h3>
                                <div class="d-flex align-items-center justify-content-between">

                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6 col-xl-3">
                        <div class="card overflow-hidden rounded-2">
                            <div class="position-relative"></div>
                            <div class="card-body pt-3 p-4">
                                <h6 class="fw-semibold fs-4">Accept issue</h6>
                                <h3>  {{$accept_issue}}</h3>
                                <div class="d-flex align-items-center justify-content-between">

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-xl-3">
                        <div class="card overflow-hidden rounded-2">
                            <div class="position-relative"></div>
                            <div class="card-body pt-3 p-4">
                                <h6 class="fw-semibold fs-4">Complete Issue</h6>
                                <h3>  {{$resolved_issue}}</h3>

                            </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="card">
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif
                    <h5 class="card-title fw-semibold mb-4"> Search</h5>
                    <form method="GET" action="">
                        @csrf
                        <div class="mb-3">
                            <div class="row">
                                <div class="col-md-3">
                                    <label for="exampleInputEmail1" class="form-label">Ticket no.</label>
                                    <input class=form-control name="ticket_no" type="text" placeholder="Enter issue ticket no." />
                                </div>
                                <div class="col-md-3">
                                    <button type="submit" class="btn btn-primary mt-4">Search</button>
                                    <a href="{{route('dashboard')}}" class="btn btn-danger mt-4">
                                        Reset
                                    </a>
                                </div>
                            </div>
                        </div>
                        
    
                    </form>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <table class="table">
                        <thead>
                        <tr>
                            <th >Sl no</th>
                            <th >Issue Ticket no</th>
                            <th >Issue Related to</th>
                            <th >Issue type</th>
                            <th >Assign to</th>
                            <th >Submission Date</th>
                            <th >Status</th>
                            <th>#</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            @foreach($issue_tracking as $key=>$issue_trackings)
                                <td>{{++$key}}</td>
                                <td>{{$issue_trackings->serial_no}}</td>
                                <td>{{$issue_trackings->issue_relato_to->name}}</td>
                                <td>{{$issue_trackings->issue_types->name ?? 'NA'}}</td>
                                @foreach ($issue_trackings->assign_histroty as $history)
                                    @if($history->active==1)
                                    <td>{{ $history->assign_to->name ?? 'NA' }} </td>
                                    <td>{{ $history->sub_date ?? 'NA' }}</td>
                                    @endif
                                @endforeach
                                <td>
                                    <span class="badge bg-success"> {{$issue_trackings->issue_status_name->name ?? 'NA'}} </span>
                                </td>
                                <td>
                                @can('accept_issue')
                                    @if($issue_trackings->accept!=1 && $issue_trackings->application_status==4 )
                                         <a class="btn btn-primary m-1 w-20" href="{{route('issue_approved',$issue_trackings->id)}}" @if($issue_trackings->accept==1)  title="issue already accepted"  onclick="return acceptmsg()" @endif>  <i class="fa fa-check"></i> Accept</a>
                                    @endif
                                @endcan
                                @if($issue_trackings->accept==1)
                                    <a class="btn btn-success m-1 w-20" 
                                        @if($issue_trackings->accept!=1) href="#" onclick="return viewAlert()" title="Please approve the issue first"
                                            @else  href="{{route('get_issue_data',$issue_trackings->id)}}" title="view" 
                                        @endif>
                                         <i class="fa fa-eye"></i> View
                                    </a>
                                @endif
    
                                @can('delete_issue')
                                    <a class="btn btn-danger m-1 w-20" @if($issue_trackings->accept==1) href="#"  onclick="return alertmsg()" title=""
                                       @else href="{{route('issue_delete',Crypt::encrypt($issue_trackings->id))}}" title="Delete" onclick="return confirmDelete()" @endif><i class="fa fa-trash"></i> Delete</a>
                                @endcan
    {{--                                <a class="btn btn-success m-1"  href="{{route('get_issue_data',$issue_trackings->id)}}" title="view" ><i class="fa fa-eye"></i></a>--}}
    {{--                                <a class="btn btn-info m-1" @if($issue_trackings->accept==1) href="#" title=""--}}
    {{--                                   @else href="{{route('track_application',$issue_trackings->id)}}" title="Delete"@endif><i class="fa fa-info-circle"></i></a>--}}
                                </td>
    
    
    
                        </tr>
                        @endforeach
    
                        </tbody>
                    </table>
    
                    {{ $issue_tracking->links('pagination::bootstrap-4') }}
                </div>
            </div>



        </div>
@endsection
