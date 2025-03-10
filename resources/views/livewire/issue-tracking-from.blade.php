<div>
    <div class="container-fluid">
        <form method="post" action="{{route('issue.store')}}" enctype="multipart/form-data">
            @csrf
            <div class="container-fluid">

                <div class="card">
                    <div class="card-body">

                        <h5 class="card-title fw-semibold mb-4">Forms</h5>
                        <div class="card">
                            @if(session('success'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('success') }}
                                </div>
                            @endif
                            <div class="card-body">

                                <div class="mb-3">
                                    <div class="row">
                                        <div class="col-sm">
                                            <label for="exampleInputEmail1" class="form-label"> Issue Related to <span style="color:red" > &#42 </span></label>
                                            <select name="issue_related_to" id="issue_related_to" class="form-select" wire:model="issue_related_to">

                                                <option value="">Select issue related to </option>
                                                @foreach ($issue_types as $issue_types)
                                                    <option {{ old('issue_related_to') == $issue_types->id ? 'selected' : '' }} value="{{ $issue_types->id }}">{{ $issue_types->name }} </option>
                                                @endforeach
                                            </select>
                                            @error('issue_related_to')
                                                <span style="color: red">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="col-sm">
                                            <label for="exampleInputEmail1" class="form-label">Issue Type <span style="color:red" > &#42 </span></label>
                                            @if( $issue_related_to!=4 )
                                                <select name="sub_issue_type" id="issue_type" class="form-select">
                                                    @if ($issue_related_to )

                                                        @foreach ($sub_issueTypes as $sub_issueType)
                                                            <option
                                                                    value="{{ $sub_issueType->id }}">{{ $sub_issueType->name }}
                                                            </option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                            @else
                                                 <input class="form-control" name="sub_issue_type" type="text" placeholder="Enter issue type" value="">
                                            @endif

                                            @error('sub_issue_type')
                                                    <span style="color: red">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputPassword1" class="form-label">Description <span style="color:red" > &#42 </span></label>
                                    <textarea rows="7" name="description" class="form-control" id="exampleInputPassword1"></textarea>
                                </div>
                                @error('description') <span style="color: red">{{ $message }}</span>

                                @enderror


                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="container-fluid">

                <div class="row">
                    <div class="col-md-7">
                        <div class="card">
                            <div class="card-body">
                                <div class="mb-3">
                                    <div class="row">
                                        <div class="col-sm">
                                            
                                            <h5 class="card-title fw-semibold mb-4">
                                                <span>
                                                    <i class="ti ti-file"></i>
                                                    </span> Upload Document</h5>
                                        </div>
                                        <div class="col-sm">
                                            <button type="button" class="btn btn-primary m-1" wire:click="addDiv">Add more <i
                                                        class="fa fa-plus"></i></button>
                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-body">
                                        <div class="mb-3">
                                            <div class="row">
                                                <div class="col-md-5">
                                                    <label for="exampleInputEmail1" class="form-label"> Select Document
                                                        Type</label>
                                                    <select name="documents_type[]" id="documents" wire:model="documents.0"
                                                            class="form-select">
        
                                                        <option>Select Documernt type</option>
                                                        @foreach($document_type as $documents)
                                                            <option value="{{$documents->id}}" {{$documents->id == 1 ? 'selected' : '' }}>{{$documents->title}}</option>
                                                        @endforeach
                                                    </select>
                                                    @php
                                                        $index=0;
                                                    @endphp
                                                </div>
                                                <div class="col-md-5">
                                                    <label for="exampleInputEmail1" class="form-label">Upload file</label>
                                                    <input class="form-control" name="path_name[]" type="file"
                                                           id="files.{{ $index}}"
                                                           placeholder="e.g. Partnership opportunity"
                                                           multiple>
                                                </div>
                                                <div class="col-md-2">
                                                </div>
                                            </div>
                                        </div>
                                        @foreach ($divs as $index => $div)
                                            <div class="mb-3" wire:key="div-{{ $index }}">
                                                <div class="row">
                                                    <div class="col-md-5">
                                                        <label for="exampleInputEmail1" class="form-label"> Select Document
                                                            Type</label>
                                                        <select name="documents_type[]" id="documents.{{$index+1}}"
                                                                wire:model="documents.{{$index+1}}" class="form-select">
        
                                                            <option>Select Document type</option>
                                                            @foreach($document_type as $documents)
                                                                <option value="{{$documents->id}}">{{$documents->title}}</option>
                                                            @endforeach
                                                        </select>
        
                                                    </div>
                                                    <div class="col-md-5">
                                                        <label for="exampleInputEmail1" class="form-label">Upload file</label>
                                                        <input class="form-control" name="path_name[]" type="file"
                                                               id="files.{{$index+1}}"
                                                               placeholder="e.g. Partnership opportunity"
                                                               multiple>
        
                                                    </div>
                                                    <div class="col-md-2">
        
                                                        <button type="button" class="btn btn-danger mt-4"
                                                                wire:click="removeDiv({{ $index}})"><i class="fa fa-trash"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
        
                                        @endforeach
        
        
                                    </div>
                                </div>
                                {{--  for sattic upload--}}
        
        
                            </div>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title fw-semibold mb-4">
                                    <span>
                                        <i class="ti ti-phone"></i>
                                        </span>
                                         Add Contact Information</h5>
                                <div class="mb-3">
                                    <div class="row">
                                        <div class="col-sm">
                                            
                                            <div class="form-group mb-2">
                                                <label class="form-label">Phone number <span style="color:red" > &#42 </span></label>
                                                <input type="text" name="phone_number" class="form-control" />
                                                
                                                @error('phone_number')
                                                <span  style="color: red" class="error"> {{ $message }} </span>
                                                @enderror
                                            </div>
                                            <div class="form-group mb-2">
                                                <label class="form-label">Email <span style="color:red" > &#42 </span></label>
                                                <input type="email" name="email" class="form-control" />
                                                
                                                @error('email')
                                                    <span  style="color: red" class="error"> {{ $message }} </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>

            <div class="container-fluid">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>

        </form>
    </div>
</div>

