@extends('layout.dashboard_app')
@section('content')
    <div class="page-content fade-in-up">
        <div class="row">
            @foreach($jobs as $job)
                <div class="col-md-12">
                    <div class="ibox">
                        <div class="ibox-head">
                            <div class="ibox-title"><h4><i class="fa fa-briefcase"></i> &nbsp;{{$job->job_name}}</h4></div>
                            <div class="ibox-tools">
                                <a class="ibox-collapse"><i class="fa fa-minus"></i></a>
                                <a class="fullscreen-link"><i class="fa fa-expand"></i></a>
                            </div>
                        </div>
                        <div class="ibox-body">
                            <div class="row">
                                <div class="col-md-8 p-t-5">
                                    <h6><span class="text-warning"><i class="fa fa-trophy"></i></span> <span class="text-primary">Top 5 New Applicant Based on Skill</span></h6>
                                </div>
                                <div class="col-md-4">
                                    <div class="text-right">
                                        <a href="{{url('/job/'.$job->job_id.'/applicants')}}" class="btn btn-info"><i class="fa fa-eye"></i> View All Applicant</a>
                                    </div>
                                </div>
                            </div>
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Rank</th>
                                        <th>Applicant Name</th>
                                        <th>Applied Date</th>
                                        <th>Score</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php($totalJob = 0)
                                    @if(count($applicants) > 0)
                                        @foreach($applicants as $idx=>$app)
                                            @if($totalJob == 5)
                                                @break
                                            @else
                                                @if($app->job_id == $job->job_id)
                                                    @php($totalJob++)
                                                    <tr>
                                                        <td>#{{$totalJob}}</td>
                                                        <td>{{$app->first_name.' '.$app->last_name}}</td>
                                                        <td>{{$app->applied_date}}</td>
                                                        <td>{{$app->score}}</td>
                                                    </tr>
                                                @endif
                                            @endif
                                        @endforeach
                                    @endif
                                    @if($totalJob == 0)
                                        <tr>
                                            <td colspan="4">There is no applicant yet.</td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection