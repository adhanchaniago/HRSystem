@extends('layout.dashboard_app')
@section('content')

    <div class="page-content fade-in-up">
        <div class="m-b-30 text-center">
            <h1>{{$job->job_name}}</h1>
            <hr>
            <h5>Job Criteria</h5>
            <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-6">
                    Minimum Skill Score:&nbsp;{{$job->avg_score}}&nbsp;&nbsp;|&nbsp;&nbsp;Minimum Experience:&nbsp;{{$job->minimum_experience}}&nbsp;&nbsp;|&nbsp;&nbsp;Minimum Age:&nbsp;{{$job->minimum_age}}
                </div>
                <div class="col-md-3"></div>
            </div>
        </div>
        <div class="row">
            @foreach($members as $member)
                <div class="col-md-6">
                    <div class="ibox">
                        <div class="ibox-body">
                            <div class="text-center">
                                <div class="m-20">
                                    @if($member->photo_url != null || $member->photo_url != "")
                                        <div class="rounded-img-xl" style="background-image: url('{{$member->photo_url}}')"></div>
                                    @else
                                        <div class="rounded-img-xl" style="background-image: url('/assets/img/admin-avatar.png')"></div>
                                    @endif
                                </div>
                                <h3><b>{{$member->first_name." ".$member->last_name}}</b></h3>
                                <h5>{{$member->degree.', '.$member->major}}</h5>
                                <h5 class="text-info">{{$member->university}}</h5>
                            </div>
                            <div class="row m-20">
                                <div class="col-md-6 text-center">
                                    <h6 class="text-muted"><i class="fa fa-envelope"></i>  {{$member->email}}</h6>
                                    <h6 class="text-muted"><i class="fa fa-phone"></i>  {{$member->phone}}</h6>
                                </div>
                                <div class="col-md-6 text-center">
                                    <h6 class="text-muted"><i class="fa fa-birthday-cake"></i>  {{$member->birth_place.', '.$member->birth_date}}</h6>
                                    <h6 class="text-muted"><i class="fa fa-user"></i> {{$member->gender}}</h6>
                                </div>
                            </div>
                            @if($member->gain >= 2)

                                <div class="alert alert-success">
                                    <h6><i class="fa fa-check"></i>&nbsp;This Applicant is qualified based on this job criteria.</h6>
                                    <div class="row">
                                        <div class="col-md-3">Skill Score</div>
                                        <div class="col-md-1">:</div>
                                        <div class="col-md-8">{{$member->score}}</div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3">Experience</div>
                                        <div class="col-md-1">:</div>
                                        <div class="col-md-8">{{$member->exp}} Years</div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3">Age</div>
                                        <div class="col-md-1">:</div>
                                        <div class="col-md-8">{{$member->age}}</div>
                                    </div>
                                </div>
                            @else
                                <div class="alert alert-warning">
                                    <div class="row">
                                        <div class="col-md-3">Skill Score</div>
                                        <div class="col-md-1">:</div>
                                        <div class="col-md-8">{{$member->score}}</div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3">Experience</div>
                                        <div class="col-md-1">:</div>
                                        <div class="col-md-8">{{$member->exp}} Years</div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3">Age</div>
                                        <div class="col-md-1">:</div>
                                        <div class="col-md-8">{{$member->age}}</div>
                                    </div>
                                </div>
                            @endif
                            <div class="text-center">
                                <button class="btn btn-success"><i class="fa fa-briefcase"></i> Accept</button>
                                <button class="btn btn-danger"><i class="fa fa-briefcase"></i> Reject</button>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

    </div>

@endsection