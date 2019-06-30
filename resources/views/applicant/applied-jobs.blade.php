@extends('layout.dashboard_app')
@section('content')
    <div class="page-content fade-in-up">
        @foreach($applicant as $idx=>$app)
            <div class="ibox">
                <div class="ibox-body">
                    <div>
                        <h3>{{$app->job_name}}</h3>
                        <h5 class="text-muted">{{$app->department_name}}</h5>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <b>Progress</b>
                            <div class="progress m-t-15">
                                <div class="progress-bar progress-bar-success" role="progressbar" style="width: 50%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100">50%</div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <b>Applied Date</b>
                            <div class="m-t-15 m-b-10">
                                <i>{{TimeSince(strtotime('now') - strtotime($app->applied_date))}} ago</i>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <b>Status</b>
                            <div class="m-t-15 m-b-10">
                                <span class="badge badge-primary">{{$app->status}}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

@endsection