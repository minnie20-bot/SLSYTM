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
    <h2><span class="fa fa-arrow-circle-o-left"></span>Create Teacher</h2>
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
                            <h3 class="panel-title">Create Teacher</h3>

                        </div>
                        <div class="panel-body">

                        @if(Auth::user()->is_admin == 1 || Auth::user()->is_admin == 2)
                         <div class="form-group">
                                <label class="col-md-5 col-xs-12 control-label">School Name <span class="required">*</span></label>
                                <div class="col-md-6 col-xs-12">
                                    <select class="form-control" required name="school_id">
                                        <option value="">Select</option>
                                        @foreach($getSchool as $school)
                                            <option value="{{ $school->id }}">{{ $school->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            @endif

                            <div class="form-group">
                                <label class="col-md-5 col-xs-12 control-label">First Name<span class="required">*</span></label>
                                <div class="col-md-6 col-xs-12">
                                    <div class="input-group">
                                        <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                        <input type="text" required name="name" value="{{ old('name') }}" class="form-control" />
                                    </div>
                                    <div class="required">{{ $errors->first('name') }}</div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-5 col-xs-12 control-label">Last Name <span class="required">*</span></label>
                                <div class="col-md-6 col-xs-12">
                                    <div class="input-group">
                                        <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                        <input type="text" required name="last_name" value="{{ old('last_name') }}" class="form-control" />
                                    </div>
                                    <div class="required">{{ $errors->first('last_name') }}</div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-5 col-xs-12 control-label">Gender <span class="required">*</span></label>
                                <div class="col-md-6 col-xs-12">
                                    <select class="form-control" required name="gender">
                                        <option value="">Select</option>
                                        <option value="Male">Male</option>
                                        <option value="Female">female</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-5 col-xs-12 control-label">Date of Birth <span class="required">*</span></label>
                                <div class="col-md-6 col-xs-12">
                                    <div class="input-group">
                                        <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                        <input type="date" required name="date_of_birth" value="{{ old('date_of_birth') }}" class="form-control" />
                                    </div>
                                    <div class="required">{{ $errors->first('date_of_birth') }}</div>
                                </div>
                            </div>

                             <div class="form-group">
                                <label class="col-md-5 col-xs-12 control-label">Date of Joining <span class="required">*</span></label>
                                <div class="col-md-6 col-xs-12">
                                    <div class="input-group">
                                        <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                        <input type="date" required name="date_of_joining" value="{{ old('date_of_joining') }}" class="form-control" />
                                    </div>
                                    <div class="required">{{ $errors->first('date_of_joining') }}</div>
                                </div>
                            </div>


                            <div class="form-group">
                                <label class="col-md-5 col-xs-12 control-label">Mobile Number <span class="required">*</span></label>
                                <div class="col-md-6 col-xs-12">
                                    <div class="input-group">
                                        <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                        <input type="text" required name="mobile_number" value="{{ old('mobile_number') }}" class="form-control" />
                                    </div>
                                    <div class="required">{{ $errors->first('mobile_number') }}</div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-5 col-xs-12 control-label">Marital Status <span class="required">*</span></label>
                                <div class="col-md-6 col-xs-12">
                                    <div class="input-group">
                                        <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                        <input type="text" required name="marital_status" value="{{ old('marital_status') }}" class="form-control" />
                                    </div>
                                    <div class="required">{{ $errors->first('marital_status') }}</div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-5 col-xs-12 control-label">Profile Pic</label>
                                <div class="col-md-6 col-xs-12">
                                    <input style="padding: 5px;" type="file" name="profile_pic" class="form-control" />
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-5 col-xs-12 control-label">Current Address <span class="required">*</span></label>
                                <div class="col-md-6 col-xs-12">
                                    <textarea class="form-control" required name="address" value="{{ old('address') }}"></textarea>
                                </div>
                            </div>

                             <div class="form-group">
                                <label class="col-md-5 col-xs-12 control-label">Permanent Address <span class="required">*</span></label>
                                <div class="col-md-6 col-xs-12">
                                    <textarea class="form-control" required name="permanent_address" value="{{ old('permanent_address') }}"></textarea>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-5 col-xs-12 control-label">Qualification <span class="required"></span></label>
                                <div class="col-md-6 col-xs-12">
                                    <textarea class="form-control" name="qualification" value="{{ old('qualification') }}"></textarea>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-5 col-xs-12 control-label">Work Experience <span class="required"></span></label>
                                <div class="col-md-6 col-xs-12">
                                    <textarea class="form-control" name="work_experience" value="{{ old('work_experience') }}"></textarea>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-5 col-xs-12 control-label">Note <span class="required"></span></label>
                                <div class="col-md-6 col-xs-12">
                                    <textarea class="form-control" name="note" value="{{ old('note') }}"></textarea>
                                </div>
                            </div>

                            <hr>

                            <div class="form-group">
                                <label class="col-md-5 col-xs-12 control-label">Email <span class="required">*</span></label>
                                <div class="col-md-6 col-xs-12">
                                    <div class="input-group">
                                        <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                        <input type="text" required name="email" value="{{ old('email') }}" class="form-control" />
                                    </div>
                                    <div class="required">{{ $errors->first('email') }}</div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-5 col-xs-12 control-label">Password <span class="required">*</span></label>
                                <div class="col-md-6 col-xs-12">
                                    <div class="input-group">
                                        <span class="input-group-addon"><span class="fa fa-unlock-alt"></span></span>
                                        <input type="password" required name="password" required class="form-control" />
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-5 col-xs-12 control-label">Status <span class="required">*</span></label>
                                <div class="col-md-6 col-xs-12">
                                    <select class="form-control" required name="status">
                                        <option value="1">Active</option>
                                        <option value="0">Inactive</option>
                                    </select>
                                </div>
                            </div>

                        <hr>



                        </div>
                        <div class="panel-footer">
                            <button class="btn btn-primary pull-right">Submit</button>
                        </div>
                    </div>
                </form>

            </div>
        </div>

    </div>
</div>

@endsection

@section('content')

