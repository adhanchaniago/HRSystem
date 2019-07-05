@extends('layout.dashboard_app')
@section('content')
    <div class="page-content fade-in-up">
        <div class="row">
            @foreach($applicant as $idx=>$app)
                <div class="col-md-4">
                    <a href="{{url('/job/applied-jobs/'.$app->applicant_id)}}" style="text-decoration: none; color: inherit;">
                        <div class="ibox hvr-underline-from-center">
                            <div class="ibox-body">
                                <div class="row">
                                    <div class="col-md-9">
                                        <h3 class="text-info">{{$app->job_name}}</h3>
                                        <h5 class="text-muted">{{$app->department_name}}</h5>
                                    </div>
                                    <div class="col-md-3">
                                        <img src="/assets/img/tfinder.PNG" alt="" width="200px">
                                    </div>

                                </div>
                                <div class="row m-t-15">
                                    <div class="col-md-7">
                                        <b>Current Progress</b>
                                        <div class="m-b-10">
                                            <b class="text-warning">{{ucwords(str_replace('_', ' ', $app->current_step))}}</b>
                                        </div>
                                        <small><i>Click to view progress</i></small>
                                    </div>
                                    <div class="col-md-5">
                                        <b>Applied Date</b>
                                        <div class="m-b-10">
                                            <i>{{TimeSince(strtotime(now('Asia/Jakarta')) - strtotime($app->applied_date))}} ago</i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>

@endsection