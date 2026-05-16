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
    <h2><span class="fa fa-arrow-circle-o-left"></span>Edit Student</h2>
</div>
<!-- END PAGE TITLE -->

<!-- PAGE CONTENT WRAPPER -->
<div class="page-content-wrap">

    <div class="page-content-wrap">

        <div class="row">
            <div class="col-md-12">

                <form class="form-horizontal" action="" method="post" enctype="multipart/form-data">
                        {{ csrf_field() }}
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title">Edit Student</h3>

                        </div>
                        <div class="panel-body">


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
                                <label class="col-md-5 col-xs-12 control-label">Admission Number <span class="required">*</span></label>
                                <div class="col-md-6 col-xs-12">
                                    <div class="input-group">
                                        <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                        <input type="text" required name="admission_number" value="{{ old('admission_number', $getRecord->admission_number) }}" class="form-control" />
                                    </div>
                                    <div class="required">{{ $errors->first('admission_number') }}</div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-5 col-xs-12 control-label">Roll Number <span class="required">*</span></label>
                                <div class="col-md-6 col-xs-12">
                                    <div class="input-group">
                                        <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                        <input type="text" required name="roll_number" value="{{ old('roll_number', $getRecord->roll_number) }}" class="form-control" />
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
                                            <option {{ ($class->id == $getRecord->class_id) ? 'selected' : '' }} value="{{ $class->id }}">{{ $class->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-5 col-xs-12 control-label">Gender <span class="required">*</span></label>
                                <div class="col-md-6 col-xs-12">
                                    <select class="form-control" required name="gender">
                                        <option value="">Select</option>
                                        <option {{ (old('gender', $getRecord->gender) == 'Male') ? 'selected' : '' }} value="Male">Male</option>
                                        <option {{ (old('gender', $getRecord->gender) == 'Female') ? 'selected' : '' }} value="Female">Female</option>
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
                                <label class="col-md-5 col-xs-12 control-label">Religion <span class="required">*</span></label>
                                <div class="col-md-6 col-xs-12">
                                    <div class="input-group">
                                        <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                        <input type="text" required name="religion" value="{{ old('religion', $getRecord->religion) }}" class="form-control" />
                                    </div>
                                    <div class="required">{{ $errors->first('religion') }}</div>
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
                                <label class="col-md-5 col-xs-12 control-label">Admission Date <span class="required">*</span></label>
                                <div class="col-md-6 col-xs-12">
                                    <div class="input-group">
                                        <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                        <input type="date" required name="admission_date" value="{{ old('admission_date', $getRecord->admission_date) }}" class="form-control" />
                                    </div>
                                    <div class="required">{{ $errors->first('admission_date') }}</div>
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
                                <label class="col-md-5 col-xs-12 control-label">Blood Type <span class="required"></span></label>
                                <div class="col-md-6 col-xs-12">
                                    <div class="input-group">
                                        <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                        <input type="text" required name="blood_type" value="{{ old('blood_type', $getRecord->blood_type) }}" class="form-control" />
                                    </div>
                                    <div class="required">{{ $errors->first('blood_type') }}</div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-5 col-xs-12 control-label">Height <span class="required"></span></label>
                                <div class="col-md-6 col-xs-12">
                                    <div class="input-group">
                                        <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                        <input type="text" required name="height" value="{{ old('height', $getRecord->height) }}" class="form-control" />
                                    </div>
                                    <div class="required">{{ $errors->first('height') }}</div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-5 col-xs-12 control-label">Weight <span class="required"></span></label>
                                <div class="col-md-6 col-xs-12">
                                    <div class="input-group">
                                        <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                        <input type="text" required name="weight" value="{{ old('weight', $getRecord->weight) }}" class="form-control" />
                                    </div>
                                    <div class="required">{{ $errors->first('weight') }}</div>
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
                                        <option value="1" {{ old('status', $getRecord->status) == 1 ? 'selected' : '' }}>Active</option>
                                        <option value="0" {{ old('status', $getRecord->status) == 0 ? 'selected' : '' }}>Inactive</option>
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

