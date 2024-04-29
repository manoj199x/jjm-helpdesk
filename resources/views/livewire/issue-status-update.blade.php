<div>
    <div class="container-fluid">
        
        @if(session('success'))
            <div class="alert alert-success" role="alert">
                {{ session('success') }}
            </div>
        @endif
        @can('update_issue')
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title fw-semibold mb-4">Status Update</h5>
                    <div class="mb-3">
                        <div class="row">
                            <div class="col-sm">
                                <label for="exampleInputEmail1" class="form-label">Status</label>
                                <select name="status" id="status" wire:model="status" class="form-select">
                                    <option>Select Status</option>
                                    @foreach($status_name as $status_names)
                                        @if($status_names->id!=4 &&$status_names->id !=1)
                                            <option value="{{$status_names->id}}">{{$status_names->name}} </option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                            <input type="hidden" name="issue_id" value="{{$issueId}}" wire:model="issue_id">
                            <div class="col-sm">
                                @if($status==2)
                                    <label class="form-label">Forward To<span style="color:red">&#42;</span></label>

                                    <select name="forward_to" id="forward_to" class="form-select"
                                            wire:model="forward_to">
                                        <option>Select user</option>
                                        @foreach($role as $roles)
                                            <option value="{{$roles->id}}">{{$roles->name}} </option>
                                        @endforeach
                                    </select>

                                    @error('forward_to')
                                    <span style="color: red">{{ $message }}</span>
                                    @enderror
                                @endif

                            </div>

                        </div>
                    </div>
                    @error('status')
                    <span style="color: red">{{ $message }}</span>
                    @enderror
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Remarks</label>
                        <textarea name="description" class="form-control" name="remarks" wire:model="remarks"
                                  id="exampleInputPassword1"></textarea>
                        @error('forward_to')
                        <span style="color: red">{{ $message }}</span>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary" wire:click="submitForm">Submit</button>
                </div>
                @endcan

            </div>
    </div>
</div>