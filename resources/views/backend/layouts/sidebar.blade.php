<div class="page-sidebar">
    <!-- START X-NAVIGATION -->
    <ul class="x-navigation">
        <li style="background: #e347;">
            <a style="font-size: 20px; text-align: center; font-weight: bold;" href="{{ url('panel/dashboard') }}">School</a>
            <a href="#" class="x-navigation-control"></a>
        </li>
        <li class="xn-profile">
            <a href="#" class="profile-mini">
                <img src="assets/images/users/avatar.jpg" alt="John Doe" />
            </a>
            <div class="profile">
                <div class="profile-image">
                    <img src="{{ asset('assets/images/users/avatar.jpg') }}" alt="John Doe" />
                </div>
                <div class="profile-data">
                    <div class="profile-data-name">John Doe</div>
                    <div class="profile-data-title">Web Developer/Designer</div>
                </div>
                <div class="profile-controls">
                    <a href="pages-profile.html" class="profile-control-left"><span class="fa fa-info"></span></a>
                    <a href="pages-messages.html" class="profile-control-right"><span class="fa fa-envelope"></span></a>
                </div>
            </div>
        </li>

        <li class="{{ (Request::segment(2) ==  'dashboard') ? 'active' : '' }}">
            <a href="{{ url('panel/dashboard') }}"><span class="fa fa-desktop"></span> <span class="xn-text">Dashboard</span></a>
        </li>

        @if(Auth::user()->is_admin == 1 || Auth::user()->is_admin == 2)

        <li class="{{ (Request::segment(2) == 'admin') ? 'active' : '' }}">
            <a href="{{ url('panel/admin') }}"><span class="fa fa-user"></span> <span class="xn-text">Admin</span></a>
        </li>

        <li class="{{ (Request::segment(2) == 'school') ? 'active' : '' }}">
            <a href="{{ url('panel/school') }}"><span class="fa fa-building"></span> <span class="xn-text">School</span></a>
        </li>

        @endif

        @if(Auth::user()->is_admin == 1 || Auth::user()->is_admin == 2 || Auth::user()->is_admin == 3)

        <li class="{{ (Request::segment(2) == 'school_admin') ? 'active' : '' }}">
            <a href="{{ url('panel/school_admin') }}"><span class="fa fa-user"></span> <span class="xn-text">School Admin</span></a>
        </li>

        <li class="{{ (Request::segment(2) == 'teacher') ? 'active' : '' }}">
            <a href="{{ url('panel/teacher') }}"><span class="fa fa-user"></span> <span class="xn-text">Teacher</span></a>
        </li>

        <li class="{{ (Request::segment(2) == 'student') ? 'active' : '' }}">
            <a href="{{ url('panel/student') }}"><span class="fa fa-user"></span> <span class="xn-text">Student</span></a>
        </li>

        @endif

        @if(Auth::user()->is_admin == 3)

        <li class="xn-openable {{ (Request::segment(2) == 'class' || Request::segment(2) == 'subject') ? 'active' : '' }}">
            <a href="#"><span class="fa fa-file-text-o"></span> <span class="xn-text">Academics</span></a>
            <ul>
                <li class="{{ (Request::segment(2) == 'class') ? 'active' : '' }}"><a href="{{ url('panel/class') }}"><span class="fa fa-random"></span> Class</a></li>

                <li class="{{ (Request::segment(2) == 'subject') ? 'active' : '' }}"><a href="{{ url('panel/subject') }}"><span class="fa fa-random"></span> Subject</a></li>

            </ul>
        </li>

        @endif

        <li class="xn-openable">
            <a href="#"><span class="fa fa-file-text-o"></span> <span class="xn-text">Layouts</span></a>
            <ul>
                <li><a href="{{ url('panel/layout-boxed') }}">List</a></li>
            </ul>
        </li>

    </ul>
    <!-- END X-NAVIGATION -->
</div>