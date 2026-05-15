@extends('backend.layouts.app')

@section('content')

<!-- START BREADCRUMB -->
<ul class="breadcrumb">
    <li><a href="#">Home</a></li>
    <li class="active">Student</li>
</ul>
<!-- END BREADCRUMB -->

<!-- PAGE TITLE -->
<div class="page-title">
    <h2><span class="fa fa-arrow-circle-o-left"></span>Create Student</h2>
</div>
<!-- END PAGE TITLE -->

<!-- PAGE CONTENT WRAPPER -->
<div class="page-content-wrap">

    <div class="page-content-wrap">

        <div class="row">
            <div class="col-md-12">

                <form class="form-horizontal" action="{{ url('panel/student/create') }}" method="post" enctype="multipart/form-data">
                        {{ csrf_field() }}
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title">Create Student</h3>

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
                                <label class="col-md-5 col-xs-12 control-label">Admission Number <span class="required">*</span></label>
                                <div class="col-md-6 col-xs-12">
                                    <div class="input-group">
                                        <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                        <input type="text" required name="admission_number" value="{{ old('admission_number') }}" class="form-control" />
                                    </div>
                                    <div class="required">{{ $errors->first('admission_number') }}</div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-5 col-xs-12 control-label">Roll Number <span class="required">*</span></label>
                                <div class="col-md-6 col-xs-12">
                                    <div class="input-group">
                                        <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                        <input type="text" required name="roll_number" value="{{ old('roll_number') }}" class="form-control" />
                                    </div>
                                    <div class="required">{{ $errors->first('roll_number') }}</div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-5 col-xs-12 control-label">Class <span class="required">*</span></label>
                                <div class="col-md-6 col-xs-12">
                                    <select class="form-control" required name="class_id">
                                        <option value="">Select</option>
                                        @foreach($getClass as $class)
                                            <option value="{{ $class->id }}">{{ $class->name }}</option>
                                        @endforeach
                                    </select>
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
                                <label class="col-md-5 col-xs-12 control-label">Religion <span class="required">*</span></label>
                                <div class="col-md-6 col-xs-12">
                                    <div class="input-group">
                                        <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                        <input type="text" required name="religion" value="{{ old('religion') }}" class="form-control" />
                                    </div>
                                    <div class="required">{{ $errors->first('religion') }}</div>
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
                                <label class="col-md-5 col-xs-12 control-label">Admission Date <span class="required">*</span></label>
                                <div class="col-md-6 col-xs-12">
                                    <div class="input-group">
                                        <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                        <input type="date" required name="admission_date" value="{{ old('admission_date') }}" class="form-control" />
                                    </div>
                                    <div class="required">{{ $errors->first('admission_date') }}</div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-5 col-xs-12 control-label">Profile Pic</label>
                                <div class="col-md-6 col-xs-12">
                                    <input style="padding: 5px;" type="file" name="profile_pic" class="form-control" />
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-5 col-xs-12 control-label">Blood Type <span class="required"></span></label>
                                <div class="col-md-6 col-xs-12">
                                    <div class="input-group">
                                        <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                        <input type="text" required name="blood_type" value="{{ old('blood_type') }}" class="form-control" />
                                    </div>
                                    <div class="required">{{ $errors->first('mobile_number') }}</div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-5 col-xs-12 control-label">Height <span class="required"></span></label>
                                <div class="col-md-6 col-xs-12">
                                    <div class="input-group">
                                        <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                        <input type="text" required name="height" value="{{ old('height') }}" class="form-control" />
                                    </div>
                                    <div class="required">{{ $errors->first('mobile_number') }}</div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-5 col-xs-12 control-label">Weight <span class="required"></span></label>
                                <div class="col-md-6 col-xs-12">
                                    <div class="input-group">
                                        <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                        <input type="text" required name="weight" value="{{ old('weight') }}" class="form-control" />
                                    </div>
                                    <div class="required">{{ $errors->first('mobile_number') }}</div>
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

