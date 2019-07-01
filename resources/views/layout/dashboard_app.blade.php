<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width initial-scale=1.0">
    <title>Admincast | Dashboard</title>
    <!-- GLOBAL MAINLY STYLES-->
    <link href="/assets/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="/assets/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet" />
    <link href="/assets/vendors/themify-icons/css/themify-icons.css" rel="stylesheet" />
    <!-- PLUGINS STYLES-->
    <link href="/assets/vendors/jvectormap/jquery-jvectormap-2.0.3.css" rel="stylesheet" />
    <link href="/assets/vendors/DataTables/datatables.min.css" rel="stylesheet" />

    <!-- THEME STYLES-->
    <link href="/assets/css/main.min.css" rel="stylesheet" />
    <link href="/assets/css/hover-min.css" rel="stylesheet" />
    <!-- PAGE LEVEL STYLES-->

    <script src="/assets/vendors/jquery/dist/jquery.min.js" type="text/javascript"></script>
    <script src="/assets/vendors/popper.js/dist/umd/popper.min.js" type="text/javascript"></script>
    <script src="/assets/vendors/bootstrap/dist/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="/assets/vendors/metisMenu/dist/metisMenu.min.js" type="text/javascript"></script>
    <script src="/assets/vendors/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
    <!-- PAGE LEVEL PLUGINS-->
    <script src="/assets/vendors/chart.js/dist/Chart.min.js" type="text/javascript"></script>
    <script src="/assets/vendors/jvectormap/jquery-jvectormap-2.0.3.min.js" type="text/javascript"></script>
    <script src="/assets/vendors/jvectormap/jquery-jvectormap-world-mill-en.js" type="text/javascript"></script>
    <script src="/assets/vendors/jvectormap/jquery-jvectormap-us-aea-en.js" type="text/javascript"></script>
    <script src="/assets/vendors/DataTables/datatables.min.js" type="text/javascript"></script>

    <!-- CORE SCRIPTS-->
    <script src="/assets/js/app.min.js" type="text/javascript"></script>
    <!-- PAGE LEVEL SCRIPTS-->
    <script src="/assets/js/scripts/dashboard_1_demo.js" type="text/javascript"></script>

    @yield('script')
</head>

<body class="fixed-navbar">
<div class="page-wrapper">
    <!-- START HEADER-->
    <header class="header">
        <div class="page-brand">
            <a class="link" href="{{url('/dashboard')}}">
                    <span class="brand">HR
                        <span class="brand-tip">System</span>
                    </span>
                <span class="brand-mini">HRS</span>
            </a>
        </div>
        <div class="flexbox flex-1">
            <!-- START TOP-LEFT TOOLBAR-->
            <ul class="nav navbar-toolbar">
                <li>
                    <a class="nav-link sidebar-toggler js-sidebar-toggler"><i class="ti-menu"></i></a>
                </li>
                <li>
                    <form class="navbar-search" action="javascript:;">
                        <div class="rel">
                            <span class="search-icon"><i class="ti-search"></i></span>
                            <input class="form-control" placeholder="Search here...">
                        </div>
                    </form>
                </li>
            </ul>
            <!-- END TOP-LEFT TOOLBAR-->
            <!-- START TOP-RIGHT TOOLBAR-->
            <ul class="nav navbar-toolbar">
                <li class="dropdown dropdown-inbox">
                    <a class="nav-link dropdown-toggle" data-toggle="dropdown"><i class="fa fa-envelope-o"></i>
                        <span class="badge badge-primary envelope-badge">9</span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-right dropdown-menu-media">
                        <li class="dropdown-menu-header">
                            <div>
                                <span><strong>9 New</strong> Messages</span>
                                <a class="pull-right" href="mailbox.html">view all</a>
                            </div>
                        </li>
                        <li class="list-group list-group-divider scroller" data-height="240px" data-color="#71808f">
                            <div>
                                <a class="list-group-item">
                                    <div class="media">
                                        <div class="media-img">
                                            <img src="/assets/img/users/u1.jpg" />
                                        </div>
                                        <div class="media-body">
                                            <div class="font-strong"> </div>Jeanne Gonzalez<small class="text-muted float-right">Just now</small>
                                            <div class="font-13">Your proposal interested me.</div>
                                        </div>
                                    </div>
                                </a>
                                <a class="list-group-item">
                                    <div class="media">
                                        <div class="media-img">
                                            <img src="/assets/img/users/u2.jpg" />
                                        </div>
                                        <div class="media-body">
                                            <div class="font-strong"></div>Becky Brooks<small class="text-muted float-right">18 mins</small>
                                            <div class="font-13">Lorem Ipsum is simply.</div>
                                        </div>
                                    </div>
                                </a>
                                <a class="list-group-item">
                                    <div class="media">
                                        <div class="media-img">
                                            <img src="/assets/img/users/u3.jpg" />
                                        </div>
                                        <div class="media-body">
                                            <div class="font-strong"></div>Frank Cruz<small class="text-muted float-right">18 mins</small>
                                            <div class="font-13">Lorem Ipsum is simply.</div>
                                        </div>
                                    </div>
                                </a>
                                <a class="list-group-item">
                                    <div class="media">
                                        <div class="media-img">
                                            <img src="/assets/img/users/u4.jpg" />
                                        </div>
                                        <div class="media-body">
                                            <div class="font-strong"></div>Rose Pearson<small class="text-muted float-right">3 hrs</small>
                                            <div class="font-13">Lorem Ipsum is simply.</div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </li>
                    </ul>
                </li>
                <li class="dropdown dropdown-notification">
                    <a class="nav-link dropdown-toggle" data-toggle="dropdown"><i class="fa fa-bell-o rel"><span class="notify-signal"></span></i></a>
                    <ul class="dropdown-menu dropdown-menu-right dropdown-menu-media">
                        <li class="dropdown-menu-header">
                            <div>
                                <span><strong>5 New</strong> Notifications</span>
                                <a class="pull-right" href="javascript:;">view all</a>
                            </div>
                        </li>
                        <li class="list-group list-group-divider scroller" data-height="240px" data-color="#71808f">
                            <div>
                                <a class="list-group-item">
                                    <div class="media">
                                        <div class="media-img">
                                            <span class="badge badge-success badge-big"><i class="fa fa-check"></i></span>
                                        </div>
                                        <div class="media-body">
                                            <div class="font-13">4 task compiled</div><small class="text-muted">22 mins</small></div>
                                    </div>
                                </a>
                                <a class="list-group-item">
                                    <div class="media">
                                        <div class="media-img">
                                            <span class="badge badge-default badge-big"><i class="fa fa-shopping-basket"></i></span>
                                        </div>
                                        <div class="media-body">
                                            <div class="font-13">You have 12 new orders</div><small class="text-muted">40 mins</small></div>
                                    </div>
                                </a>
                                <a class="list-group-item">
                                    <div class="media">
                                        <div class="media-img">
                                            <span class="badge badge-danger badge-big"><i class="fa fa-bolt"></i></span>
                                        </div>
                                        <div class="media-body">
                                            <div class="font-13">Server #7 rebooted</div><small class="text-muted">2 hrs</small></div>
                                    </div>
                                </a>
                                <a class="list-group-item">
                                    <div class="media">
                                        <div class="media-img">
                                            <span class="badge badge-success badge-big"><i class="fa fa-user"></i></span>
                                        </div>
                                        <div class="media-body">
                                            <div class="font-13">New user registered</div><small class="text-muted">2 hrs</small></div>
                                    </div>
                                </a>
                            </div>
                        </li>
                    </ul>
                </li>
                <li class="dropdown dropdown-user">
                    <a class="nav-link dropdown-toggle link" data-toggle="dropdown">
                        <div class="rounded-img-sm" style="background-image: url('@if(Auth::user()->photo_url) {{Auth::user()->photo_url}} @else /assets/img/admin-avatar.png @endif')"></div>
                        <span></span>@if(\Auth::check()){{Auth::user()->first_name}}@endif<i class="fa fa-angle-down m-l-5"></i></a>
                    <ul class="dropdown-menu dropdown-menu-right">
                        <a class="dropdown-item" href="{{url('/profile')}}"><i class="fa fa-user"></i>Profile</a>
                        <a class="dropdown-item" href="{{url('/profile')}}"><i class="fa fa-cog"></i>Settings</a>
                        <li class="dropdown-divider"></li>
                        <a class="dropdown-item" href="{{url('/logout')}}"><i class="fa fa-power-off"></i>Logout</a>
                    </ul>
                </li>
            </ul>
            <!-- END TOP-RIGHT TOOLBAR-->
        </div>
    </header>
    <!-- END HEADER-->
    <!-- START SIDEBAR-->
    <nav class="page-sidebar" id="sidebar">
        <div id="sidebar-collapse">
            <div class="admin-block d-flex">
                <div>
                    <div class="rounded-img-md" style="background-image: url('@if(Auth::user()->photo_url) {{Auth::user()->photo_url}} @else /assets/img/admin-avatar.png @endif')"></div>
                </div>
                <div class="admin-info">
                    <div class="font-strong">
                        @if(\Auth::check())
                            {{Auth::user()->first_name." ".Auth::user()->last_name}}
                        @endif
                    </div>
                    <small>
                        @if(\Auth::check())
                            @php($role = \Illuminate\Support\Facades\DB::table('role')->where('role_id', '=', Auth::user()->role_id)->get()->first())
                            {{$role->role_name}}
                        @endif
                    </small>
                </div>
            </div>
            <ul class="side-menu metismenu">
                <li>
                    <a class="active" href="{{url('/dashboard')}}"><i class="sidebar-item-icon fa fa-th-large"></i>
                        <span class="nav-label">Dashboard</span>
                    </a>
                </li>

                @if(Auth::user()->role_id == "ROLE001")
                    <li>
                        <a href="#"><i class="sidebar-item-icon fa fa-th-large"></i>
                            <span class="nav-label">Job Dashboard</span><i class="fa fa-angle-left arrow"></i>
                        </a>
                        <ul class="nav-2-level collapse">
                            <li>
                                <a href="{{url('/job/active')}}">Active Jobs</a>
                            </li>
                            <li>
                                <a href="{{url('/job/inactive')}}">Inactive Jobs</a>
                            </li>
                            <li>
                                <a href="{{url('/department')}}">Department</a>
                            </li>
                        </ul>
                    </li>
                    <li class="heading">TALENT</li>
                    <li>
                        <a href="#"><i class="sidebar-item-icon fa fa-user"></i>
                            <span class="nav-label">Talent Pool Screening</span><i class="fa fa-angle-left arrow"></i>
                        </a>
                        <ul class="nav-2-level collapse">
                            <li>
                                <a href="{{url('/member/list')}}">Member List</a>
                            </li>
                            <li>
                                <a href="{{url('/applicant/all-job')}}">Applicant Screening</a>
                            </li>
                        </ul>
                    </li>

                    <li>
                        <a href="#"><i class="sidebar-item-icon fa fa-cogs"></i>
                            <span class="nav-label">Test Management</span><i class="fa fa-angle-left arrow"></i></a>
                        <ul class="nav-2-level collapse">
                            <li>
                                <a href="{{url('/technical-test')}}">
                                    <span class="nav-label">Technical Test</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{url('/interview/schedule')}}">
                                    <span class="nav-label">Interview Schedule</span>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li class="heading">MISCELLANEOUS</li>
                    <li>
                        <a href="#"><i class="sidebar-item-icon fa fa-bar-chart"></i>
                            <span class="nav-label">Report</span>
                        </a>
                    </li>
                    <li>
                        <a href="#"><i class="sidebar-item-icon fa fa-file-text"></i>
                            <span class="nav-label">Documents</span><i class="fa fa-angle-left arrow"></i></a>
                        <ul class="nav-2-level collapse">
                            <li>
                                <a href="{{url('/document/applicant')}}">Applicant Documents</a>
                            </li>
                            <li>
                                <a href="{{url('/document/recruiter')}}">Recruiter Documents</a>
                            </li>
                            <li>
                                <a href="{{url('/document/type')}}">Manage Document Type</a>
                            </li>
                        </ul>
                    </li>
                @else
                    <li>
                        <a href="#"><i class="sidebar-item-icon fa fa-th-large"></i>
                            <span class="nav-label">Job Dashboard</span><i class="fa fa-angle-left arrow"></i>
                        </a>
                        <ul class="nav-2-level collapse">
                            <li>
                                <a href="{{url('/job')}}">View All Job</a>
                            </li>
                            <li>
                                <a href="{{url('/job/applied-jobs')}}">My Job Application</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="#"><i class="sidebar-item-icon fa fa-cogs"></i>
                            <span class="nav-label">Test & Interview</span><i class="fa fa-angle-left arrow"></i></a>
                        <ul class="nav-2-level collapse">
                            <li>
                                <a href="{{url('/technical-test')}}">
                                    <span class="nav-label">My Technical Test</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{url('/interview/schedule')}}">
                                    <span class="nav-label">My Interview Schedule</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                @endif
            </ul>
        </div>
    </nav>
    <!-- END SIDEBAR-->
    <div class="content-wrapper">

        @yield('content')

        <footer class="page-footer">
            <div class="font-13">2018 © <b>AdminCAST</b> - All rights reserved.</div>
            <div class="to-top"><i class="fa fa-angle-up"></i></div>
        </footer>
    </div>
</div>
<!-- BEGIN THEME CONFIG PANEL-->
{{--<div class="theme-config">--}}
    {{--<div class="theme-config-toggle"><i class="fa fa-cog theme-config-show"></i><i class="ti-close theme-config-close"></i></div>--}}
    {{--<div class="theme-config-box">--}}
        {{--<div class="text-center font-18 m-b-20">SETTINGS</div>--}}
        {{--<div class="font-strong">LAYOUT OPTIONS</div>--}}
        {{--<div class="check-list m-b-20 m-t-10">--}}
            {{--<label class="ui-checkbox ui-checkbox-gray">--}}
                {{--<input id="_fixedNavbar" type="checkbox" checked>--}}
                {{--<span class="input-span"></span>Fixed navbar</label>--}}
            {{--<label class="ui-checkbox ui-checkbox-gray">--}}
                {{--<input id="_fixedlayout" type="checkbox">--}}
                {{--<span class="input-span"></span>Fixed layout</label>--}}
            {{--<label class="ui-checkbox ui-checkbox-gray">--}}
                {{--<input class="js-sidebar-toggler" type="checkbox">--}}
                {{--<span class="input-span"></span>Collapse sidebar</label>--}}
        {{--</div>--}}
        {{--<div class="font-strong">LAYOUT STYLE</div>--}}
        {{--<div class="m-t-10">--}}
            {{--<label class="ui-radio ui-radio-gray m-r-10">--}}
                {{--<input type="radio" name="layout-style" value="" checked="">--}}
                {{--<span class="input-span"></span>Fluid</label>--}}
            {{--<label class="ui-radio ui-radio-gray">--}}
                {{--<input type="radio" name="layout-style" value="1">--}}
                {{--<span class="input-span"></span>Boxed</label>--}}
        {{--</div>--}}
        {{--<div class="m-t-10 m-b-10 font-strong">THEME COLORS</div>--}}
        {{--<div class="d-flex m-b-20">--}}
            {{--<div class="color-skin-box" data-toggle="tooltip" data-original-title="Default">--}}
                {{--<label>--}}
                    {{--<input type="radio" name="setting-theme" value="default" checked="">--}}
                    {{--<span class="color-check-icon"><i class="fa fa-check"></i></span>--}}
                    {{--<div class="color bg-white"></div>--}}
                    {{--<div class="color-small bg-ebony"></div>--}}
                {{--</label>--}}
            {{--</div>--}}
            {{--<div class="color-skin-box" data-toggle="tooltip" data-original-title="Blue">--}}
                {{--<label>--}}
                    {{--<input type="radio" name="setting-theme" value="blue">--}}
                    {{--<span class="color-check-icon"><i class="fa fa-check"></i></span>--}}
                    {{--<div class="color bg-blue"></div>--}}
                    {{--<div class="color-small bg-ebony"></div>--}}
                {{--</label>--}}
            {{--</div>--}}
            {{--<div class="color-skin-box" data-toggle="tooltip" data-original-title="Green">--}}
                {{--<label>--}}
                    {{--<input type="radio" name="setting-theme" value="green">--}}
                    {{--<span class="color-check-icon"><i class="fa fa-check"></i></span>--}}
                    {{--<div class="color bg-green"></div>--}}
                    {{--<div class="color-small bg-ebony"></div>--}}
                {{--</label>--}}
            {{--</div>--}}
            {{--<div class="color-skin-box" data-toggle="tooltip" data-original-title="Purple">--}}
                {{--<label>--}}
                    {{--<input type="radio" name="setting-theme" value="purple">--}}
                    {{--<span class="color-check-icon"><i class="fa fa-check"></i></span>--}}
                    {{--<div class="color bg-purple"></div>--}}
                    {{--<div class="color-small bg-ebony"></div>--}}
                {{--</label>--}}
            {{--</div>--}}
            {{--<div class="color-skin-box" data-toggle="tooltip" data-original-title="Orange">--}}
                {{--<label>--}}
                    {{--<input type="radio" name="setting-theme" value="orange">--}}
                    {{--<span class="color-check-icon"><i class="fa fa-check"></i></span>--}}
                    {{--<div class="color bg-orange"></div>--}}
                    {{--<div class="color-small bg-ebony"></div>--}}
                {{--</label>--}}
            {{--</div>--}}
            {{--<div class="color-skin-box" data-toggle="tooltip" data-original-title="Pink">--}}
                {{--<label>--}}
                    {{--<input type="radio" name="setting-theme" value="pink">--}}
                    {{--<span class="color-check-icon"><i class="fa fa-check"></i></span>--}}
                    {{--<div class="color bg-pink"></div>--}}
                    {{--<div class="color-small bg-ebony"></div>--}}
                {{--</label>--}}
            {{--</div>--}}
        {{--</div>--}}
        {{--<div class="d-flex">--}}
            {{--<div class="color-skin-box" data-toggle="tooltip" data-original-title="White">--}}
                {{--<label>--}}
                    {{--<input type="radio" name="setting-theme" value="white">--}}
                    {{--<span class="color-check-icon"><i class="fa fa-check"></i></span>--}}
                    {{--<div class="color"></div>--}}
                    {{--<div class="color-small bg-silver-100"></div>--}}
                {{--</label>--}}
            {{--</div>--}}
            {{--<div class="color-skin-box" data-toggle="tooltip" data-original-title="Blue light">--}}
                {{--<label>--}}
                    {{--<input type="radio" name="setting-theme" value="blue-light">--}}
                    {{--<span class="color-check-icon"><i class="fa fa-check"></i></span>--}}
                    {{--<div class="color bg-blue"></div>--}}
                    {{--<div class="color-small bg-silver-100"></div>--}}
                {{--</label>--}}
            {{--</div>--}}
            {{--<div class="color-skin-box" data-toggle="tooltip" data-original-title="Green light">--}}
                {{--<label>--}}
                    {{--<input type="radio" name="setting-theme" value="green-light">--}}
                    {{--<span class="color-check-icon"><i class="fa fa-check"></i></span>--}}
                    {{--<div class="color bg-green"></div>--}}
                    {{--<div class="color-small bg-silver-100"></div>--}}
                {{--</label>--}}
            {{--</div>--}}
            {{--<div class="color-skin-box" data-toggle="tooltip" data-original-title="Purple light">--}}
                {{--<label>--}}
                    {{--<input type="radio" name="setting-theme" value="purple-light">--}}
                    {{--<span class="color-check-icon"><i class="fa fa-check"></i></span>--}}
                    {{--<div class="color bg-purple"></div>--}}
                    {{--<div class="color-small bg-silver-100"></div>--}}
                {{--</label>--}}
            {{--</div>--}}
            {{--<div class="color-skin-box" data-toggle="tooltip" data-original-title="Orange light">--}}
                {{--<label>--}}
                    {{--<input type="radio" name="setting-theme" value="orange-light">--}}
                    {{--<span class="color-check-icon"><i class="fa fa-check"></i></span>--}}
                    {{--<div class="color bg-orange"></div>--}}
                    {{--<div class="color-small bg-silver-100"></div>--}}
                {{--</label>--}}
            {{--</div>--}}
            {{--<div class="color-skin-box" data-toggle="tooltip" data-original-title="Pink light">--}}
                {{--<label>--}}
                    {{--<input type="radio" name="setting-theme" value="pink-light">--}}
                    {{--<span class="color-check-icon"><i class="fa fa-check"></i></span>--}}
                    {{--<div class="color bg-pink"></div>--}}
                    {{--<div class="color-small bg-silver-100"></div>--}}
                {{--</label>--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</div>--}}
{{--</div>--}}
<!-- END THEME CONFIG PANEL-->
<!-- BEGIN PAGA BACKDROPS-->
<div class="sidenav-backdrop backdrop"></div>
<div class="preloader-backdrop">
    <div class="page-preloader">Loading</div>
</div>
<!-- END PAGA BACKDROPS-->
<!-- CORE PLUGINS-->
</body>

</html>