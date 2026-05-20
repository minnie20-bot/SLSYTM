@extends('backend.layouts.app')

@section('content')

<!-- START BREADCRUMB -->
<ul class="breadcrumb">
    <li><a href="#">Home</a></li>
    <li class="active">Edit Assign Teacher</li>
</ul>
<!-- END BREADCRUMB -->

<!-- PAGE TITLE -->
<div class="page-title">
    <h2><span class="fa fa-arrow-circle-o-left"></span>Edit Assign Teacher</h2>
</div>
<!-- END PAGE TITLE -->

<!-- PAGE CONTENT WRAPPER -->
<div class="page-content-wrap">

    <div class="page-content-wrap">

        <div class="row">
            <div class="col-md-12">

                <form class="form-horizontal" action="{{ url('panel/assign-teacher/edit/'.$getRecord->id) }}" method="post" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title">Edit Assign Teacher</h3>

                        </div>
                        <div class="panel-body form-group-separated">

                            <div class="form-group">
                                <label class="col-md-3 col-xs-12 control-label">Class <span class="required">*</span></label>
                                <div class="col-md-6 col-xs-12">


                                    <select class="form-control" required name="class_id">
                                        <option value="">Select Class</option>
                                        @foreach($getClass as $class)
                                        <option value="{{ $class->id }}"
                                            {{ $getRecord->class_id == $class->id ? 'selected' : '' }}>{{ $class->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 col-xs-12 control-label">Teacher <span class="required">*</span></label>
                                <div class="col-md-6 col-xs-12">
                                    @foreach($getTeacher as $teacher)
                                    @php
                                    $checked = "";
                                    @endphp

                                    @foreach($getSelectedTeacher as $tea)

                                    @if($tea->teacher_id == $teacher->id)
                                    @php
                                    $checked = "checked";
                                    @endphp
                                    @endif
                                    @endforeach

                                    <label style="display: block; margin-bottom: 7px;"><input {{ $checked }} type="checkbox" value="{{ $teacher->id }}" name="teacher_id[]"> {{ $teacher->name }} {{ $teacher->last_name }}</label>
                                    @endforeach
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 col-xs-12 control-label">Subject <span class="required">*</span></label>
                                <div class="col-md-6 col-xs-12">
                                    <select class="form-control" required name="subject_id">
                                        <option value="">Select Subject</option>
                                        @foreach($getSubject as $subject)
                                        <option value="{{ $subject->id }}"
                                            {{ $getRecord->subject_class_id == $subject->id ? 'selected' : '' }}>{{ $subject->subject_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 col-xs-12 control-label">Status <span class="required">*</span></label>
                                <div class="col-md-6 col-xs-12">
                                    <select class="form-control" required name="status">
                                        <option {{ $getRecord->status == 1 ? 'selected' : '' }} value="1">Active</option>
                                        <option {{ $getRecord->status == 0 ? 'selected' : '' }} value="0">Inactive</option>
                                    </select>
                                </div>
                            </div>

                        </div>
                        <div class="panel-footer">
                            <button type="submit" class="btn btn-primary pull-right">Submit</button>
                        </div>
                    </div>
                </form>

            </div>
        </div>

    </div>
</div>

@endsection