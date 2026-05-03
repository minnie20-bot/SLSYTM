@extends('backend.layouts.app')

@section('content')

<!-- START BREADCRUMB -->
<ul class="breadcrumb">
    <li><a href="#">Home</a></li>
    <li class="active">Subject</li>
</ul>
<!-- END BREADCRUMB -->

<!-- PAGE TITLE -->
<div class="page-title">
    <h2><span class="fa fa-arrow-circle-o-left"></span>Edit Subject</h2>
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
                            <h3 class="panel-title">Edit Subject</h3>

                        </div>
                        <div class="panel-body form-group-separated">

                            <div class="form-group">
                        
                                <label class="col-md-3 col-xs-12 control-label">Subject Name <span class="required">*</span></label>
                                <div class="col-md-6 col-xs-12">
                                    <div class="input-group">
                                        <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                        <input type="text" name="name" value="{{ old('name', $getRecord->name) }}" class="form-control" />
                                    </div>
                                    <div class="required">{{ $errors->first('name') }}</div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 col-xs-12 control-label">Type <span class="required">*</span></label>
                                <div class="col-md-6 col-xs-12">
                                    <select class="form-control" required name="type">
                                        <option value="">Select</option>
                                        <option {{ ($getRecord->type == 'Theory') ? 'selected' : '' }} value="Theory">Theory</option>
                                        <option {{ ($getRecord->type == 'Practical') ? 'selected' : '' }} value="Practical">Practical</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 col-xs-12 control-label">Status <span class="required">*</span></label>
                                <div class="col-md-6 col-xs-12">
                                    <select class="form-control" name="status">
                                       <option value="1" {{ ($getRecord->status == 1) ? 'selected' : '' }}>Active</option>
                                        <option value="0" {{ ($getRecord->status == 0)? 'selected' : '' }}>Inactive</option>
                                    </select>
                                </div>
                            </div>

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



