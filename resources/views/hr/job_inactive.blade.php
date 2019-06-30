@extends('.layout.dashboard_app')
@section('content')
    <div class="page-content fade-in-up">
        <div class="ibox">
            <div class="ibox-head">
                <div class="ibox-title">Inactive Jobs</div>
            </div>
            @if ($errors->any())
                <div class="form-group">
                    <div class="alert alert-danger">
                        {{ $errors->first() }}
                    </div>
                </div>
            @elseif(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            <div class="ibox-body">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Job Position</th>
                            <th>Department</th>
                            <th>Active Date</th>
                            <th>Expired Date</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(count($inactive_jobs) > 0)
                            @foreach($inactive_jobs as $index => $job)
                                <!-- The Modal -->
                                <div class="modal fade" id="reactiveJobModal{{$job->job_id}}">
                                    <div class="modal-dialog">
                                        <div class="modal-content">

                                            <!-- Modal Header -->
                                            <div class="modal-header">
                                                <h4 class="modal-title"><i class="fa fa-refresh"></i> Reactive Job</h4>
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            </div>

                                            <form action="{{url("/job/reactive-job/".$job->job_id)}}" method="post">
                                            {{csrf_field()}}

                                            <!-- Modal body -->
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="">Active Date</label>
                                                                <input type="date" name="active_date" class="form-control">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="">Expired Date</label>
                                                                <input type="date" name="expired_date" class="form-control">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Modal footer -->
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary">Reactive</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <tr>
                                    <td>
                                        {{$index+1}}
                                    </td>
                                    <td>{{$job->job_name}}</td>
                                    <td>{{$job->department_name}}</td>
                                    <td>{{$job->active_date}}</td>
                                    <td>{{$job->expired_date}}</td>
                                    <td>
                                        <button class="btn btn-success btn-xs" data-toggle="modal" data-target="#reactiveJobModal{{$job->job_id}}" ><i class="fa fa-refresh"></i></button>
                                        <a href="{{url('/job/delete-job/'.$job->job_id)}}" class="btn btn-danger btn-xs" data-toggle="tooltip" data-original-title="Delete"><i class="fa fa-times font-14"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="6" class="text-center">Job list is empty</td>
                            </tr>
                        @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection