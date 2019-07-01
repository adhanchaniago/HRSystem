@extends('.layout.dashboard_app')
@section('content')
    <style>
        textarea{
           resize: none;
        }
    </style>

    <div class="row">
        <div class="col-md-8">
            <div class="ibox">
                <div class="ibox-head">
                    <div class="ibox-title">Job Information</div>
                    <div class="ibox-tools">
                        <a class="ibox-collapse"><i class="fa fa-minus"></i></a>
                        <a class="fullscreen-link"><i class="fa fa-expand"></i></a>
                    </div>
                </div>
                <div class="ibox-body">
                    <div>
                        <div class="m-t-10">
                            <div class="row">
                                <div class="col-md-7">
                                    <h2>{{$job->job_name}}</h2>
                                    <h5 class="text-muted">{{$job->department_name}}</h5>
                                </div>
                                <div class="col-md-5">
                                    <h6>Salary</h6>
                                    <div class="text-success">
                                        <h3>Rp {{number_format($job->salary)}}</h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-7">
                                <h5><b>Description</b></h5>
                                <div class="m-t-5">
                                    <textarea class="border-0" cols="40" rows="5" wrap="hard" readonly="readonly">{{$job->description}}</textarea>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <h5><b>Priority Skill</b></h5>
                                <div class="m-t-5">
                                    <ul>
                                        @foreach($skills as $index=>$skill)
                                            <li>{{$skill->skill_name}}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="text-right m-b-10">
                        <button class="btn btn-secondary"><i class="fa fa-pencil"></i> Edit Job</button>
                        <a class="btn btn-danger" href="{{url('/job/deactive-job/'.$job->job_id)}}"><i class="fa fa-times"></i> Deactive Job</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="ibox">
                <div class="ibox-head">
                    <div class="ibox-title">Technical Test</div>
                    <div class="ibox-tools">
                        <button class="btn btn-primary btn-xs" data-toggle="modal" data-target="#appProgressModal"><i class="fa fa-plus font-14"></i></button>
                        <div class="modal fade" id="appProgressModal">
                            <div class="modal-dialog">
                                <div class="modal-content">

                                    <!-- Modal Header -->
                                    <div class="modal-header">
                                        <h4 class="modal-title"><i class="fa fa-plus"></i> Add Progress</h4>
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    </div>

                                    <form action="{{url("/job/add-application-progress/".$job->job_id)}}" method="post">
                                    {{csrf_field()}}
                                    <!-- Modal body -->
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <label for="">Application Progress</label>
                                                <div class="row m-b-15">
                                                    <div class="col-md-8">
                                                        <input type="text" name="progress_name" placeholder="Progress Name" class="form-control" required>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <input type="number" name="sequence" placeholder="Sequence" min="0" max="6" class="form-control" required>
                                                    </div>
                                                </div>
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
                <div class="ibox-body">
                    @if(count($progress))
                        <ol>
                            @foreach($progress as $prog)
                                <li>{{$prog->progress_name}}</li>
                            @endforeach
                        </ol>
                    @endif
                </div>
            </div>
        </div>
    </div>

@endsection