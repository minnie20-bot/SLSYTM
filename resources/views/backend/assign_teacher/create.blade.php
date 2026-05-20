@extends('backend.layouts.app')

@section('content')

<!-- START BREADCRUMB -->
<ul class="breadcrumb">
    <li><a href="#">Home</a></li>
    <li class="active">Create Assign Teacher</li>
</ul>
<!-- END BREADCRUMB -->

<!-- PAGE TITLE -->
<div class="page-title">
    <h2><span class="fa fa-arrow-circle-o-left"></span>Create Assign Teacher</h2>
</div>
<!-- END PAGE TITLE -->

<!-- PAGE CONTENT WRAPPER -->
<div class="page-content-wrap">

    <div class="page-content-wrap">

        <div class="row">
            <div class="col-md-12">

                <form class="form-horizontal" action="{{ url('panel/assign-teacher/create') }}" method="post" enctype="multipart/form-data">
                        {{ csrf_field() }}
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title">Create Assign Teacher</h3>

                        </div>
                        <div class="panel-body form-group-separated">

                            <div class="form-group">
                                <label class="col-md-3 col-xs-12 control-label">Class <span class="required">*</span></label>
                                <div class="col-md-6 col-xs-12">
                                    

                                    <select class="form-control" id="class_id" required name="class_id">
                                        <option value="">Select Class</option>
                                        @foreach($getClass as $class)
                                            <option value="{{ $class->id }}">{{ $class->name }}</option>
                                        @endforeach
                                    </select>    
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 col-xs-12 control-label">Teacher <span class="required">*</span></label>
                                <div class="col-md-6 col-xs-12">
                                        @foreach($getTeacher as $teacher)
                                            <label style="display: block; margin-bottom: 7px;"><input type="checkbox" value="{{ $teacher->id }}" name="teacher_id[]"> {{ $teacher->name }} {{ $teacher->last_name }}</label>
                                        @endforeach
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 col-xs-12 control-label">Subject <span class="required">*</span></label>
                                <div class="col-md-6 col-xs-12">
                                    <select class="form-control" id="subject_select" required name="subject_id">
                                        <option value="">Select Subject (Choose Class First)</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 col-xs-12 control-label">Status <span class="required">*</span></label>
                                <div class="col-md-6 col-xs-12">
                                    <select class="form-control" required name="status">
                                        <option value="1">Active</option>
                                        <option value="0">Inactive</option>
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

@section('script')
<script>
$(document).ready(function() {
    $('#class_id').on('change', function() {
        var class_id = $(this).val();
        if(class_id) {
            $.ajax({
                url: '{{ url("panel/get-subject-by-class") }}/' + class_id,
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    var options = '<option value="">Select Subject</option>';
                    $.each(data, function(key, value) {
                        options += '<option value="' + value.id + '">' + value.subject_name + '</option>';
                    });
                    $('#subject_select').html(options);
                }
            });
        } else {
            $('#subject_select').html('<option value="">Select Subject</option>');
        }
    });
});
</script>
@endsection

