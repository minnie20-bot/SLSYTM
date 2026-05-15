@extends('backend.layouts.app')

@section('content')

<!-- START BREADCRUMB -->
<ul class="breadcrumb">
    <li><a href="#">Home</a></li>
    <li class="active">Teacher</li>
</ul>
<!-- END BREADCRUMB -->

<!-- PAGE TITLE -->
<div class="page-title">
    <h2><span class="fa fa-arrow-circle-o-left"></span>Edit Teacher</h2>
</div>
<!-- END PAGE TITLE -->

<!-- PAGE CONTENT WRAPPER -->
<div class="page-content-wrap">

    <div class="page-content-wrap">

        <div class="row">
            <div class="col-md-12">

                <form class="form-horizontal" action="{{ url('panel/teacher/create') }}" method="post" enctype="multipart/form-data">
                        {{ csrf_field() }}
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title">Edit Teacher</h3>

                        </div>
                        <div class="panel-body form-group-separated">

                            <div class="form-group">
                                <label class="col-md-5 col-xs-12 control-label">First Name<span class="required">*</span></label>
                                <div class="col-md-6 col-xs-12">
                                    <div class="input-group">
                                        <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                        <input type="text" required name="name" value="{{ old('name', $getRecord->name) }}" class="form-control" />
                                    </div>
                                    <div class="required">{{ $errors->first('name') }}</div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-5 col-xs-12 control-label">Last Name <span class="required">*</span></label>
                                <div class="col-md-6 col-xs-12">
                                    <div class="input-group">
                                        <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                        <input type="text" required name="last_name" value="{{ old('last_name', $getRecord->last_name) }}" class="form-control" />
                                    </div>
                                    <div class="required">{{ $errors->first('last_name') }}</div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-5 col-xs-12 control-label">Gender <span class="required">*</span></label>
                                <div class="col-md-6 col-xs-12">
                                    <select class="form-control" required name="gender">
                                        <option value="">Select</option>
                                        <option {{ $getRecord->gender == 'Male' ? 'selected' : '' }}>Male</option>
                                        <option {{ $getRecord->gender == 'Female' ? 'selected' : '' }}>female</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-5 col-xs-12 control-label">Date of Birth <span class="required">*</span></label>
                                <div class="col-md-6 col-xs-12">
                                    <div class="input-group">
                                        <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                        <input type="date" required name="date_of_birth" value="{{ old('date_of_birth', $getRecord->date_of_birth) }}" class="form-control" />
                                    </div>
                                    <div class="required">{{ $errors->first('date_of_birth') }}</div>
                                </div>
                            </div>

                             <div class="form-group">
                                <label class="col-md-5 col-xs-12 control-label">Date of Joining <span class="required">*</span></label>
                                <div class="col-md-6 col-xs-12">
                                    <div class="input-group">
                                        <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                        <input type="date" required name="date_of_joining" value="{{ old('date_of_joining', $getRecord->date_of_joining) }}" class="form-control" />
                                    </div>
                                    <div class="required">{{ $errors->first('date_of_joining') }}</div>
                                </div>
                            </div>


                            <div class="form-group">
                                <label class="col-md-5 col-xs-12 control-label">Mobile Number <span class="required">*</span></label>
                                <div class="col-md-6 col-xs-12">
                                    <div class="input-group">
                                        <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                        <input type="text" required name="mobile_number" value="{{ old('mobile_number', $getRecord->mobile_number) }}" class="form-control" />
                                    </div>
                                    <div class="required">{{ $errors->first('mobile_number') }}</div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-5 col-xs-12 control-label">Marital Status <span class="required">*</span></label>
                                <div class="col-md-6 col-xs-12">
                                    <div class="input-group">
                                        <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                        <input type="text" required name="marital_status" value="{{ old('marital_status', $getRecord->marital_status) }}" class="form-control" />
                                    </div>
                                    <div class="required">{{ $errors->first('marital_status') }}</div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-5 col-xs-12 control-label">Profile Pic</label>
                                <div class="col-md-6 col-xs-12">
                                    <input style="padding: 5px;" type="file" name="profile_pic" class="form-control" />
                                    
                                    @if(!empty($getRecord->getProfile()))
                                        <img style="width: 50px;height: 50px;border-radius: 50%;" src="{{ $getRecord->getProfile() }}">
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-5 col-xs-12 control-label">Current Address <span class="required">*</span></label>
                                <div class="col-md-6 col-xs-12">
                                    <textarea class="form-control" style="height: 60px;" required name="address">{{ old('address', $getRecord->address) }}</textarea>
                                </div>
                            </div>

                             <div class="form-group">
                                <label class="col-md-5 col-xs-12 control-label">Permanent Address <span class="required">*</span></label>
                                <div class="col-md-6 col-xs-12">
                                    <textarea class="form-control" style="height: 60px;" required name="permanent_address">{{ old('permanent_address', $getRecord->permanent_address) }}</textarea>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-5 col-xs-12 control-label">Qualification <span class="required"></span></label>
                                <div class="col-md-6 col-xs-12">
                                    <textarea class="form-control" style="height: 60px;" name="qualification">{{ old('qualification', $getRecord->qualification) }}</textarea>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-5 col-xs-12 control-label">Work Experience <span class="required"></span></label>
                                <div class="col-md-6 col-xs-12">
                                    <textarea class="form-control" style="height: 60px;" name="work_experience">{{ old('work_experience', $getRecord->work_experience) }}</textarea>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-5 col-xs-12 control-label">Note <span class="required"></span></label>
                                <div class="col-md-6 col-xs-12">
                                    <textarea class="form-control" style="height: 60px;" name="note">{{ old('note', $getRecord->note) }}</textarea>
                                </div>
                            </div>

                            <hr>

                            <div class="form-group">
                                <label class="col-md-5 col-xs-12 control-label">Email <span class="required">*</span></label>
                                <div class="col-md-6 col-xs-12">
                                    <div class="input-group">
                                        <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                        <input type="text" required name="email" value="{{ old('email', $getRecord->email) }}" class="form-control" />
                                    </div>
                                    <div class="required">{{ $errors->first('email') }}</div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-5 col-xs-12 control-label">Password <span class="required"></span></label>
                                <div class="col-md-6 col-xs-12">
                                    <div class="input-group">
                                        <span class="input-group-addon"><span class="fa fa-unlock-alt"></span></span>
                                        <input type="text" name="password" class="form-control" />
                                    </div>
                                    (Do you want to change your password?)
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-5 col-xs-12 control-label">Status <span class="required">*</span></label>
                                <div class="col-md-6 col-xs-12">
                                    <select class="form-control" required name="status">
                                        <option value="1" {{ $getRecord->status == 1 ? 'selected' : '' }}>Active</option>
                                        <option value="0" {{ $getRecord->status == 0 ? 'selected' : '' }}>Inactive</option>
                                    </select>
                                </div>
                            </div>

                        <hr>



                        </div>
                        <div class="panel-footer">
                            <button class="btn btn-primary pull-right">Submit</button>
                        </div>
                    </div>
                </>

            </div>
        </div>

    </div>
</div>

@endsection

@section('content')

