@extends('backend.layouts.app')

@section('content')

<!-- START BREADCRUMB -->
<ul class="breadcrumb">
    <li><a href="#">Home</a></li>
    <li class="active">My Class & Subjects</li>
</ul>
<!-- END BREADCRUMB -->

<!-- PAGE TITLE -->
<div class="page-title">
    <h2><span class="fa fa-arrow-circle-o-left"></span> My Class & Subjects</h2>
</div>
<!-- END PAGE TITLE -->

<!-- PAGE CONTENT WRAPPER -->
<div class="page-content-wrap">

    <!-- START RESPONSIVE TABLES -->
    <div class="row">
        <div class="col-md-12">
            @include('message')

            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">My Class & Subjects Search</h3>
                </div>
                <div class="panel-body">
                    <form action="" method="get">
                       
                    <div class="col-md-2">
                            <label>Class Name</label>
                            <input type="text" class="form-control" value="{{ Request::get('class_name') }}" placeholder="Class Name" name="class_name">
                        </div>

                        <div class="col-md-2">
                            <label>Subject Name</label>
                            <input type="text" class="form-control" value="{{ Request::get('subject_name') }}" placeholder="Subject Name" name="subject_name">
                        </div>

                        <div style="clear: both;"></div>
                        <br>
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-primary">Search</button>
                            <a href="{{ url('teacher/my-class-subjects') }}" class="btn btn-success">Reset</a>
                        </div>
                    </form>
                </div>
            </div>

            <div class="panel panel-default">

                <div class="panel-heading">
                    <h3 class="panel-title">My Class & Subjects List</h3>
                    <a class="btn btn-primary pull-right" href="{{ url('panel/school/create') }}">Create School</a>
                </div>

                <div class="panel-body panel-body-table">

                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-actions">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Class Name</th>
                                    <th>Subject Name</th>
                                    <th>Subject Type</th>
                                    <th>My Class Timetable</th>
                                    <th>Created Date</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                           <tbody>
                                @forelse($getRecord as $value)
                                <tr>
                                    <td>{{ $value->id }}</td>
                                    <td>{{ $value->class_name }}</td>
                                    <td>{{ $value->subject_name }}</td>
                                    <td>{{ $value->subject_type }}</td>
                                    <td>

                                    </td>
                                    <td>
                                        {{ date('d-m-Y H:i A', strtotime($value->created_at)) }}
                                    </td>
                                    <td>
                                        <a href="{{ url('teacher/my-class-subjects/timetable/'.$value->class_id.'/'.$value->subject_id) }}" 
                                            class="btn btn-primary">
                                            Class Timetable
                                        </a>
                                    </td>
                                </tr>
                                @empty
                                    <tr>
                                        <td colspan="100%">Record not found.</td>
                                    </tr>
                                @endforelse

                           </tbody>
                        </table>

                    </div>
                </div>
            </div>
            <div class="pull-right">
                {{ $getRecord->appends(Illuminate\Support\Facades\Request::except('page'))->links() }}
            </div>
        </div>
    </div>
</div>

@endsection

@section('script')

@endsection