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
    <h2><span class="fa fa-arrow-circle-o-left"></span> Student</h2>
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
                    <h3 class="panel-title">Student Search</h3>
                </div>
                <div class="panel-body">
                    <form action="" method="get">
                        <div class="col-md-2">
                            <label>ID</label>
                            <input type="text" class="form-control" value="{{ Request::get('id') }}" placeholder="ID" name="id">
                        </div>

                        <div class="col-md-2">
                            <label>First Name</label>
                            <input type="text" class="form-control" value="{{ Request::get('name') }}" placeholder="First Name" name="name">
                        </div>

                        <div class="col-md-2">
                            <label>Last Name</label>
                            <input type="text" class="form-control" value="{{ Request::get('last_name') }}" placeholder="Last Name" name="last_name">
                        </div>

                        <div class="col-md-2">
                            <label>Email</label>
                            <input type="text" class="form-control" value="{{ Request::get('email') }}" placeholder="Email" name="email">
                        </div>

                        <div class="col-md-2">
                            <label>Gender</label>
                            <select class="form-control" name="gender">
                                <option value="">Select</option>
                                <option {{ Request::get('gender') == 'Male' ? 'selected' : '' }} value="Male">Male</option>
                                <option {{ Request::get('gender') == 'Female' ? 'selected' : '' }} value="Female">Female</option>
                            </select>
                        </div>

                        
                        <div class="col-md-2">
                            <label>Status</label>
                            <select class="form-control" name="status">
                                <option value="">Select</option>
                                <option {{ Request::get('status') == '1' ? 'selected' : '' }} value="1">Active</option>
                                <option {{ Request::get('status') == '100' ? 'selected' : '' }} value="100">Inactive</option>
                            </select>
                        </div>

                        <div style="clear: both;"></div>
                        <br>
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-primary">Search</button>
                            <a href="{{ url('panel/student') }}" class="btn btn-success">Reset</a>
                        </div>
                    </form>
                </div>
            </div>

            <div class="panel panel-default">

                <div class="panel-heading">
                    <h3 class="panel-title">Student List</h3>
                    <a class="btn btn-primary pull-right" href="{{ url('panel/student/create') }}">Create Student</a>
                </div>

                <div class="panel-body panel-body-table">

                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-actions">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    @if(Auth::user()->is_admin == 1 || Auth::user()->is_admin == 2)
                                    <th>School Name</th>
                                    @endif
                                    <th>Profile</th>
                                    <th>Admission Number</th>
                                    <th>Roll Number</th>
                                    <th>First Name</th>
                                    <th>Last Name</th>
                                    <th>Email</th>
                                    <th>Gender</th>
                                    <th>Date of Birth</th>
                                    <th>Admission Date </th>
                                    <th>Mobile Number</th>
                                    <th>Class</th>
                                    <th>Address</th>
                                    <th>Status</th>
                                    <th>Created Date</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($getRecord as $value)
                                <tr>
                                    <td>{{ $value->id }}</td>
                                    @if(Auth::user()->is_admin == 1 || Auth::user()->is_admin == 2)
                                        <td>
                                            @if(!empty($value->getCreatedBy))
                                                {{ $value->getCreatedBy->name }}
                                            @endif
                                        </td>
                                    @endif
                                    <td>
                                        @if(!empty($value->getProfile()))
                                        <img style="width: 50px;height: 50px;border-radius: 50%;" src="{{ $value->getProfile() }}">
                                        @endif
                                    </td>
                                    <td>{{ $value->admission_number }}</td>
                                    <td>{{ $value->roll_number }}</td>
                                    <td>{{ $value->name }}</td> 
                                    <td>{{ $value->last_name }}</td>
                                    <td>{{ $value->email }}</td>
                                    <td>{{ $value->gender }}</td>
                                    <td>
                                        {{ date('d-m-Y', strtotime($value->date_of_birth)) }}
                                    </td> 
                                    <td>
                                        {{ date('d-m-Y', strtotime($value->admission_date)) }}
                                    </td>  
                                    <td>{{ $value->mobile_number }}</td>
                                    <td>{{ optional($value->getClass)->name }}</td>
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
                                        <a href="{{ url('panel/student/edit/'.$value->id) }}" class="btn btn-default btn-rounded btn-sm"><span class="fa fa-pencil"></span></a>

                                        <a href="{{ url('panel/student/delete/'.$value->id) }}" onclick="return confirm('Are ou sure you want to delete?');" class="btn btn-danger btn-rounded btn-sm"><span class="fa fa-times"></span></a>
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
    <!-- END RESPONSIVE TABLES -->

    <!-- END PAGE CONTENT WRAPPER -->
</div>

@endsection

@section('script')

@endsection