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
                    <h3 class="panel-title">My Class & Subjects TimeTable</h3>
                    <a class="btn btn-primary pull-right" href="{{ url('panel/school/create') }}">Create School</a>
                </div>

                <div class="panel-body panel-body-table">

                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-actions">
                            <thead>
                                <tr>
                                    <th>Week Name</th>
                                    <th>Start Time</th>
                                    <th>End Time</th>
                                    <th>Room Number</th>
                                </tr>
                            </thead>
                           <tbody>
                             @foreach($getRecord as $value)
                                <tr>
                                    <td>{{ $value['week_name'] }}</td>
                                    <td>{{ $value['start_time'] }}</td>
                                    <td>{{ $value['end_time'] }}</td>
                                    <td>{{ $value['room_number'] }}</td>
                                </tr>
                            @endforeach
                           </tbody>
                        </table>

                    </div>
                </div>
            </div>
            <div class="pull-right">
            </div>
        </div>
    </div>
</div>

@endsection

@section('script')

@endsection