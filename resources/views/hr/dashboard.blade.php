@extends('layout.dashboard_app')
@section('content')
    <!-- START PAGE CONTENT-->
    <div class="page-content fade-in-up">
        @if(Auth::user()->role_id == "ROLE001")
            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <div class="ibox bg-success color-white widget-stat">
                        <div class="ibox-body">
                            <h2 class="m-b-5 font-strong">{{$members}}</h2>
                            <div class="m-b-5">REGISTERED MEMBER</div><i class="ti-pencil-alt widget-stat-icon"></i>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="ibox bg-info color-white widget-stat">
                        <div class="ibox-body">
                            <h2 class="m-b-5 font-strong">{{$applicants}}</h2>
                            <div class="m-b-5">APPLICANTS</div><i class="ti-user widget-stat-icon"></i>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="ibox bg-warning color-white widget-stat">
                        <div class="ibox-body">
                            <h2 class="m-b-5 font-strong">{{$accepted}}</h2>
                            <div class="m-b-5">APPLICANT ACCEPTED</div><i class="ti-check-box widget-stat-icon"></i>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="ibox bg-danger color-white widget-stat">
                        <div class="ibox-body">
                            <h2 class="m-b-5 font-strong">{{$rejected}}</h2>
                            <div class="m-b-5">APPLICANT REJECTED</div><i class="ti-close widget-stat-icon"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-8">
                    <div class="ibox">
                        <div class="ibox-head">
                            <div class="ibox-title">My Referrals</div>
                            <div class="ibox-tools">
                                <a class="ibox-collapse"><i class="fa fa-minus"></i></a>
                                <a href="#">View All</a>
                            </div>
                        </div>
                        <div class="ibox-body">
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Job</th>
                                    <th>Department</th>
                                    <th>Status</th>
                                    <th>Applied Date</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @if(count($referals)>0)
                                        @foreach($referals as $ref)
                                            <tr>
                                                <td>{{$ref->first_name." ".$ref->last_name}}</td>
                                                <td>{{$ref->job_name}}</td>
                                                <td>{{$ref->department_name}}</td>
                                                <td>
                                                    <span class="badge badge-primary">{{$ref->status}}</span>
                                                </td>
                                                <td>{{$ref->applied_date}}</td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="5">There is no applicant refer to you</td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="modal fade" id="taskModal">
                        <div class="modal-dialog">
                            <div class="modal-content">

                                <!-- Modal Header -->
                                <div class="modal-header">
                                    <h4 class="modal-title"><i class="fa fa-plus"></i> Add New Task</h4>
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                </div>

                                <form action="{{url("/add-task")}}" method="post">
                                {{csrf_field()}}

                                <!-- Modal body -->
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label for="">Task</label>
                                            <input type="text" name="task_desc" placeholder="Task" class="form-control" required>
                                        </div>

                                        <div class="form-group">
                                            <label for="">Task Due Date</label>
                                            <input type="date" name="task_date" class="form-control" required>
                                        </div>
                                    </div>

                                    <!-- Modal footer -->
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-success">Submit</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="ibox">
                        <div class="ibox-head">
                            <div class="ibox-title">Tasks</div>
                            <div>
                                <a class="btn btn-info btn-sm" href="#" data-toggle="modal" data-target="#taskModal"><i class="fa fa-plus"></i> New Task</a>
                            </div>
                        </div>
                        <div class="ibox-body">
                            @if(count($tasks)>0)
                                <ul class="list-group list-group-divider list-group-full tasks-list">
                                    @foreach($tasks as $task)
                                        <li class="list-group-item task-item">
                                            <div>
                                                <label class="ui-checkbox ui-checkbox-gray ui-checkbox-success">
                                                    <input type="checkbox" id="task-check" name="task-check" value="{{$task->task_id}}">
                                                    <span class="input-span"></span>
                                                    <span class="task-title">{{$task->task_description}}</span>
                                                </label>
                                            </div>
                                            <div class="task-data"><small class="text-muted">{{$task->task_date}}</small></div>
                                            <div class="task-actions">
                                                <a href="javascript:;"><i class="fa fa-edit text-muted m-r-10"></i></a>
                                                <a href="javascript:;"><i class="fa fa-trash text-muted"></i></a>
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                            @else
                                <div class="alert alert-info">
                                    There is no task.
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @else
            <div class="m-b-20">
                <h5>Recently Posted Job</h5>
            </div>
            <div class="row">
                @foreach($jobs as $job)
                    <div class="col-lg-3 col-md-6">
                        <div class="ibox">
                            <div class="ibox-body">
                                <div class="row">
                                    <div class="col-md-8">
                                        <h4 class="m-b-5 text-success">{{$job->job_name}}</h4>
                                        <div class="m-b-5">{{$job->department_name}}</div>
                                    </div>
                                    <div class="col-md-4 text-center">
                                        <i class="ti-write" style="font-size: 40px"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="row">
                <div class="col-lg-8">
                    <div class="ibox">
                        <div class="ibox-head">
                            <div class="ibox-title">My Application</div>
                            <div class="ibox-tools">
                                <a class="ibox-collapse"><i class="fa fa-minus"></i></a>
                                <a href="#">View All</a>
                            </div>
                        </div>
                        <div class="ibox-body">
                            <table class="table table-striped toDataTable">
                                <thead>
                                <tr>
                                    <th>Job</th>
                                    <th>Department</th>
                                    <th>Status</th>
                                    <th>Applied Date</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($applications as $app)
                                    <tr>
                                        <td>{{$app->job_name}}</td>
                                        <td>{{$app->department_name}}</td>
                                        <td><span class="badge badge-primary">{{$app->status}}</span></td>
                                        <td>{{$app->applied_date}}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="ibox">
                        <div class="ibox-head">
                            <div class="ibox-title">Messages</div>
                            <div>
                                <a class="btn btn-info btn-sm" href="javascript:;">New Task</a>
                            </div>
                        </div>
                        <div class="ibox-body">
                            <ul class="list-group list-group-divider list-group-full tasks-list">
                                <li class="list-group-item task-item">
                                    <div>
                                        <label class="ui-checkbox ui-checkbox-gray ui-checkbox-success">
                                            <input type="checkbox">
                                            <span class="input-span"></span>
                                            <span class="task-title">Meeting with Eliza</span>
                                        </label>
                                    </div>
                                    <div class="task-data"><small class="text-muted">10 July 2018</small></div>
                                    <div class="task-actions">
                                        <a href="javascript:;"><i class="fa fa-edit text-muted m-r-10"></i></a>
                                        <a href="javascript:;"><i class="fa fa-trash text-muted"></i></a>
                                    </div>
                                </li>
                                <li class="list-group-item task-item">
                                    <div>
                                        <label class="ui-checkbox ui-checkbox-gray ui-checkbox-success">
                                            <input type="checkbox" checked="">
                                            <span class="input-span"></span>
                                            <span class="task-title">Check your inbox</span>
                                        </label>
                                    </div>
                                    <div class="task-data"><small class="text-muted">22 May 2018</small></div>
                                    <div class="task-actions">
                                        <a href="javascript:;"><i class="fa fa-edit text-muted m-r-10"></i></a>
                                        <a href="javascript:;"><i class="fa fa-trash text-muted"></i></a>
                                    </div>
                                </li>
                                <li class="list-group-item task-item">
                                    <div>
                                        <label class="ui-checkbox ui-checkbox-gray ui-checkbox-success">
                                            <input type="checkbox">
                                            <span class="input-span"></span>
                                            <span class="task-title">Create Financial Report</span>
                                        </label>
                                        <span class="badge badge-danger m-l-5"><i class="ti-alarm-clock"></i> 1 hrs</span>
                                    </div>
                                    <div class="task-data"><small class="text-muted">No due date</small></div>
                                    <div class="task-actions">
                                        <a href="javascript:;"><i class="fa fa-edit text-muted m-r-10"></i></a>
                                        <a href="javascript:;"><i class="fa fa-trash text-muted"></i></a>
                                    </div>
                                </li>
                                <li class="list-group-item task-item">
                                    <div>
                                        <label class="ui-checkbox ui-checkbox-gray ui-checkbox-success">
                                            <input type="checkbox" checked="">
                                            <span class="input-span"></span>
                                            <span class="task-title">Send message to Mick</span>
                                        </label>
                                    </div>
                                    <div class="task-data"><small class="text-muted">04 Apr 2018</small></div>
                                    <div class="task-actions">
                                        <a href="javascript:;"><i class="fa fa-edit text-muted m-r-10"></i></a>
                                        <a href="javascript:;"><i class="fa fa-trash text-muted"></i></a>
                                    </div>
                                </li>
                                <li class="list-group-item task-item">
                                    <div>
                                        <label class="ui-checkbox ui-checkbox-gray ui-checkbox-success">
                                            <input type="checkbox">
                                            <span class="input-span"></span>
                                            <span class="task-title">Create new page</span>
                                        </label>
                                        <span class="badge badge-success m-l-5">2 Days</span>
                                    </div>
                                    <div class="task-data"><small class="text-muted">07 Dec 2018</small></div>
                                    <div class="task-actions">
                                        <a href="javascript:;"><i class="fa fa-edit text-muted m-r-10"></i></a>
                                        <a href="javascript:;"><i class="fa fa-trash text-muted"></i></a>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        @endif
        <style>
            .visitors-table tbody tr td:last-child {
                display: flex;
                align-items: center;
            }

            .visitors-table .progress {
                flex: 1;
            }

            .visitors-table .progress-parcent {
                text-align: right;
                margin-left: 10px;
            }
        </style>

            <script>
                $(".toDataTable").DataTable();
            </script>

    </div>
    <!-- END PAGE CONTENT-->
@endsection