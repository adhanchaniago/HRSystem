@extends('.layout.dashboard_app')
@section('content')
    <div class="page-content fade-in-up">
        <div class="row m-25">
            <div class="col-md-6 text-left">
                <h2>Department</h2>
            </div>
            <div class="col-md-6 text-right">
                <button class="btn btn-success"  data-toggle="modal" data-target="#addDeptModal"><i class="fa fa-plus"></i> Add New Department</button>
                <div class="modal fade" id="addDeptModal">
                    <div class="modal-dialog modal-sm">
                        <div class="modal-content">

                            <!-- Modal Header -->
                            <div class="modal-header">
                                <h4 class="modal-title"><i class="fa fa-plus"></i> Add New Department</h4>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>

                            <form action="{{url("/department/add-new-department")}}" method="post">
                                {{csrf_field()}}

                            <!-- Modal body -->
                                <div class="modal-body">
                                    <div class="form-group">
                                        <input type="text" name="department_name" placeholder="Input Department Name" class="form-control" required>
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
            </div>
        </div>
        <div class="row">
            @foreach($dept as $dep)
                <div class="modal fade" id="updateDeptModal{{$dep->department_id}}">
                    <div class="modal-dialog modal-sm">
                        <div class="modal-content">

                            <!-- Modal Header -->
                            <div class="modal-header">
                                <h4 class="modal-title"><i class="fa fa-edit"></i> Update Department</h4>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>

                            <form action="{{url("/department/update/".$dep->department_id)}}" method="post">
                            {{csrf_field()}}

                            <!-- Modal body -->
                                <div class="modal-body">
                                    <div class="form-group">
                                        <input type="text" name="department_name" value="{{$dep->department_name}}" placeholder="Input Department Name" class="form-control" required>
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

                <div class="modal fade" id="deleteModal{{$dep->department_id}}">
                    <div class="modal-dialog">
                        <div class="modal-content">

                            <!-- Modal Header -->
                            <div class="modal-header">
                                <h4 class="modal-title"><i class="fa fa-trash"></i> Delete Department</h4>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>

                            <!-- Modal body -->
                            <div class="modal-body">
                                <h6>Are you sure want to delete department {{$dep->department_name}} ?</h6>
                            </div>

                            <!-- Modal footer -->
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                <a href="/department/delete/{{$dep->department_id}}" type="submit" class="btn btn-success">Delete</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="ibox">
                        <div class="ibox-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <h4 class="p-t-15 p-l-15">{{$dep->department_name}}</h4>
                                </div>
                                <div class="col-md-4">
                                    <div class="text-center">
                                        <h5>{{\App\Job::all()->where('department_id', '=', $dep->department_id)->count()}}</h5>
                                        <small>Active Jobs</small>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div>
                                        <button class="btn btn-secondary btn-xs" data-toggle="modal" data-target="#updateDeptModal{{$dep->department_id}}"><i class="fa fa-pencil"></i></button>
                                    </div>
                                    <div>
                                        <button class="btn btn-danger btn-xs" data-toggle="modal" data-target="#deleteModal{{$dep->department_id}}"><i class="fa fa-times"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection