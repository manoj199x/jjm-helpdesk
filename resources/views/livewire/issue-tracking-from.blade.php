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
                                            <select class="form-select" wire:model="selected_issue_type">

                                                <option value="">Select issue related to </option>
                                                @foreach ($this->issue_type as $issue_type)
                                                    <option value="{{ $issue_type->id }}">{{ $issue_type->name }} </option>
                                                @endforeach
                                            </select>
                                            @error('selected_issue_type')
                                                <span style="color: red">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="col-sm">
                                            <label for="exampleInputEmail1" class="form-label">Issue Type <span style="color:red" > &#42 </span></label>
                                            @if( $this->selected_issue_type !=4 )
                                                <select class="form-select" wire:model="sub_issue_type" >
                                                    @if ($this->selected_issue_type)
                                                        @foreach ($this->sub_issue_type as $sub_issue_type)
                                                            <option
                                                                    value="{{ $sub_issue_type->id }}">{{ $sub_issue_type->name }}
                                                            </option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                            @else
                                                 <input class="form-control" wire:model="sub_issue_type" type="text" placeholder="Enter issue type" value="">
                                            @endif

                                            @error('sub_issue_type')
                                                    <span style="color: red">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Description <span style="color:red" > &#42 </span></label>
                                    <textarea rows="7" wire:model="description" class="form-control" id="exampleInputPassword1"></textarea>
                                </div>
                                @error('description') 
                                    <span style="color: red">{{ $message }}</span>
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
                                                        <select name="documents_type[]" id="documents.{{$index+1}}" wire:model="documents.{{$index+1}}" class="form-select">
        
                                                            <option>Select Document type</option>
                                                            @foreach( $this->document_type as $documents)
                                                                <option value="{{$this->document_type->id}}">{{$this->document_type->title}}</option>
                                                            @endforeach
                                                        </select>
        
                                                    </div>
                                                    <div class="col-md-5">
                                                        <label for="exampleInputEmail1" class="form-label">Upload file</label>
                                                        <input class="form-control" name="path_name[]" type="file" id="files.{{$index+1}}" placeholder="e.g. Partnership opportunity"
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
                                                <input type="text" wire:model="phone_number" class="form-control" />
                                                
                                                @error('phone_number')
                                                <span  style="color: red" class="error"> {{ $message }} </span>
                                                @enderror
                                            </div>
                                            <div class="form-group mb-2">
                                                <label class="form-label">Email <span style="color:red" > &#42 </span></label>
                                                <input type="email" wire:model="email" class="form-control" />
                                                
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

