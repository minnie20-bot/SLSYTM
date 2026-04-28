@extends('backend.layouts.app')

@section('content')

<!-- START BREADCRUMB -->
<ul class="breadcrumb">
    <li><a href="#">Home</a></li>
    <li class="active">School</li>
</ul>
<!-- END BREADCRUMB -->

<!-- PAGE TITLE -->
<div class="page-title">
    <h2><span class="fa fa-arrow-circle-o-left"></span> School</h2>
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
                    <h3 class="panel-title">School List</h3>
                    <a class="btn btn-primary pull-right" href="{{ url('panel/school/create') }}">Create School</a>
                </div>

                <div class="panel-body panel-body-table">

                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-actions">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Profile</th>
                                    <th>School Name</th>
                                    <th>Email</th>
                                    <th>Address</th>
                                    <th>Status</th>
                                    <th>Created Date</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($getSchool as $value)
                                <tr>
                                    <td>{{ $value->id }}</td>
                                    <td>
                                        @if(!empty($value->getProfile()))
                                            <img style="width: 50px;height: 50px;border-radius: 50%;" src="{{ $value->getProfile() }}">
                                        @endif
                                    </td>
                                    <td>{{ $value->name }}</td>
                                    <td>{{ $value->email }}</td>
                                    <td>{{ $value->address }}</td>
                                    <td>

                                        @if($value->status == 1)
                                            <span class="label label-success">Active</span>
                                        @else
                                            <span class="label label-danger">Inactive</span>
                                        @endif
                                    </td>
                                    <td>
                                        {{ date('d-m-Y H:i A', strtotime($value->created_at)) }}
                                    </td>
                                    <td>
                                        <a href="{{ url('panel/school/edit/'.$value->id) }}" class="btn btn-default btn-rounded btn-sm"><span class="fa fa-pencil"></span></a>

                                        <a href="{{ url('panel/school/delete/'.$value->id) }}" onclick="return confirm('Are ou sure you want to delete?');" class="btn btn-danger btn-rounded btn-sm"><span class="fa fa-times"></span></a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>

        </div>
    </div>
    <!-- END RESPONSIVE TABLES -->

    <!-- END PAGE CONTENT WRAPPER -->
</div>

@endsection
