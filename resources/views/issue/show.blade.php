@extends('layouts.master')

@section('main-body')
 @if(session('success'))
            <div class="alert alert-success" role="alert">
                {{ session('success') }}
            </div>
        @endif

    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title fw-semibold mb-4">Issue Details</h5>
                <table class="table">
                <thead>

                </thead>
                <tbody>
                <tr>
                    <th>Issue Ticket No.</th>
                    <td>{{$issue_tracking->serial_no}}</td>
                    <th>Issue Related to</th>
                    <td>{{$issue_tracking->issue_relato_to->name}}</td>
                    <th>Issue type</th>
                    <td>{{$issue_tracking->issue_types->name}}</td>

                </tr>
                <tr>
                    
                    
                        @foreach ($issue_tracking->assign_histroty as $history)
                            @if($history->active==1)
                            <th>Status</th>
                                <td>{{ $history->status_name->name ?? 'NA' }} </td>
                            <th>Status Updated</th>
                                <td>{{ $history->status_updated_at ?? 'NA' }}</td>
                            @endif
                        @endforeach

                </tr>
                <tr>
                    <th>Description</th>
                    <td>{{$issue_tracking->description ?? 'NA'}}</td>
                </tr>

                </tbody>
                </table>
            </div>
        </div>
        @php
            $issueId=$issue_tracking->id;

        @endphp

        <div class="card">
            <div class="card-body">
                <h5 class="card-title fw-semibold mb-4">Issue History</h5>
                <table class="table table-bordered">
                    <thead>
                        <th>By</th>
                        <th>Assign to </th>
                        <th>Action by Assignee</th>
                        <th>from remarks</th>
                        <th>to remarks</th>
                    </thead>
                    
                    <tbody>
                        @foreach ($issue_tracking->assign_histroty as $history)
                        
                            <tr>
                                <td> {{ $history->assigned_by->name }}</td>                               
                                <td> {{ $history->assign_to->name  }}</td>
                                <td> {{ $history->status_name->name }} </td>
                                <td> {{ $history->from_remarks }}</td>
                                <td> {{ $history->to_remarks }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title fw-semibold mb-4">Related Documents</h5>
                        <table class="table">
                            <thead>
                            <th>#</th>
                            <th>Document type</th>
                            <th>Action</th>
                            @foreach($documents as $key=>$document)
                                <tr>
                                    <td>{{++$key}}</td>
                                    <td>{{$document->document_types->title}}</td>
                
                                    <td>
                                        <a class="button small green --jb-modal" data-target="sample-modal-2"
                                           href="{{ Storage::url( $document->image_path) }}"
                                           type="button" target="_blank">
                                            <i class="fa fa-eye" style="font-size:20px "></i>
                                        </a>
                                    </td>
                
                                </tr>
                            @endforeach
                            </thead>
                            <tbody>
                
                
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-md-6">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title fw-semibold mb-4"> Created By </h5>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <td>{{$issue_created_by->user_id}}</td>
                                </tr>
                                <tr>
                                    <th>Email (from SMT Portal)</th>
                                    <td>{{$issue_created_by->email ?? 'N/A' }}</td>
                                </tr>
                                <tr>
                                    <th>Contact Number (from SMT Portal)</th>
                                    <td>{{$issue_created_by->phone ?? 'N/A'}}</td>
                                </tr>

                                <tr>
                                    <th>Email</th>
                                    <td>{{$issue_tracking->email ?? 'N/A' }}</td>
                                </tr>
                                <tr>
                                    <th>Contact Number</th>
                                    <td>{{$issue_tracking->phone_number ?? 'N/A'}}</td>
                                </tr>
                            
                            </thead>
                            <tbody>

                
                
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        {{--    <livewire:issue-status-update wire:props="['issueId' => $issueId]" wire:key="issue-status-update-{{$issueId}}"/>--}}
        @if($issue_tracking->application_status != 3)
            @foreach ($issue_tracking->assign_histroty as $history)
                @if($history->active==1 && $history->to_user_id == ( Auth::check() ? Auth::user()->id : Session::get('id') ) )
                        @livewire('issue-status-update',['issueId'=>$issueId])
                @endif
            @endforeach
        @endif
    </div>
@endsection
@section('main-script')
    @include('issue.js')
@endsection
