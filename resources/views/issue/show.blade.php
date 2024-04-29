@extends('layouts.master')

@section('main-body')
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
                        <th>set as</th>
                        <th>Assign to </th>
                        <th>Remarks</th>
                    </thead>
                    
                    <tbody>
                        @foreach ($issue_tracking->assign_histroty as $history)
                            <tr>
                                <td> {{ $history->assigned_by->name }}</td>
                                <td> {{ $history->status_name->name }} </td>
                                <td> {{ $history->assign_to->name  }}</td>
                                <td> {{ $history->remarks }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

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

                    <td><a class="button small green --jb-modal" data-target="sample-modal-2"
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

<div class="card">
    <div class="card-body">
        <h5 class="card-title fw-semibold mb-4"> Created By </h5>
        <table class="table">
            <thead>
            <th>Name</th>
            <td>{{$issue_tracking->user_details->name}}</td>
            <th>Email</th>
            <td>{{$issue_tracking->user_details->email}}</td>
            <th>Contact Number</th>
            <td>{{$issue_tracking->user_details->contact_number ??'N/A'}}</td>
            </thead>
            <tbody>


            </tbody>
        </table>
    </div>
</div>


        {{--    <livewire:issue-status-update wire:props="['issueId' => $issueId]" wire:key="issue-status-update-{{$issueId}}"/>--}}
            
        @foreach ($issue_tracking->assign_histroty as $history)
            @if($history->active==1 && $history->to_user_id == Auth::user()->id )
                   
                    @livewire('issue-status-update',['issueId'=>$issueId])
            @endif
        @endforeach
    </div>
@endsection
@section('main-script')
    @include('issue.js')
@endsection
