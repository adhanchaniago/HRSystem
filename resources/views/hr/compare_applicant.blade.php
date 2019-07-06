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
                            <div>
                                <b>Current Progress : </b><br>
                                <span class="text-primary">
                                @if($member->current_step == "apply")
                                    <i class="fa fa-file-o"></i>&nbsp;
                                @elseif($member->current_step == "technical_test")
                                    <i class="fa fa-edit"></i>&nbsp;
                                @elseif($member->current_step == "interview")
                                    <i class="fa fa-users"></i>&nbsp;
                                @else
                                    <i class="fa fa-flag-checkered"></i>&nbsp;
                                @endif
                                {{ucwords(str_replace('_', ' ', $member->current_step))}}
                                </span>
                            </div>
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

                            @if($member->current_step == "apply")
                                <div class="modal fade" id="proceedConfirm">
                                    <div class="modal-dialog">
                                        <div class="modal-content">

                                            <!-- Modal Header -->
                                            <div class="modal-header">
                                                <h4 class="modal-title"><i class="fa fa-check"></i> Proceed Applicant</h4>
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            </div>

                                            <form action="{{url("/applicant/proceed/".$member->applicant_id)}}" method="post">
                                            {{csrf_field()}}
                                            <!-- Modal body -->
                                                <div class="modal-body">
                                                    Are you sure want to proceed this applicant to next step?
                                                </div>

                                                <!-- Modal footer -->
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                                    <button type="submit" class="btn btn-success">Proceed</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                                <div class="modal fade" id="rejectConfirm">
                                    <div class="modal-dialog">
                                        <div class="modal-content">

                                            <!-- Modal Header -->
                                            <div class="modal-header">
                                                <h4 class="modal-title"><i class="fa fa-times"></i> Reject Applicant</h4>
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            </div>

                                            <form action="{{url("/applicant/reject/".$member->applicant_id)}}" method="post">
                                            {{csrf_field()}}
                                            <!-- Modal body -->
                                                <div class="modal-body">
                                                    Are you sure want to reject this applicant?
                                                </div>

                                                <!-- Modal footer -->
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                                    <button type="submit" class="btn btn-danger">Reject</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                                <div class="text-center m-b-10">
                                    <button class="btn btn-success" data-toggle="modal" data-target="#proceedConfirm"><i class="fa fa-check"></i> Proceed</button>
                                    <button class="btn btn-danger" data-toggle="modal" data-target="#rejectConfirm"><i class="fa fa-times"></i> Reject</button>
                                </div>
                            @elseif($member->current_step == "technical_test")
                                <div class="modal fade" id="interviewConfirm">
                                    <div class="modal-dialog">
                                        <div class="modal-content">

                                            <!-- Modal Header -->
                                            <div class="modal-header">
                                                <h4 class="modal-title"><i class="fa fa-calendar-o"></i> Set Interview Schedule</h4>
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            </div>

                                            <form action="{{url("/technical-test/proceed/".$member->technical_test_id)}}" method="post">
                                            {{csrf_field()}}
                                            <!-- Modal body -->
                                                <div class="modal-body">
                                                    <div class="form-group">
                                                        <label for="">Interviewer</label>
                                                        <select name="interviewer" id="interviewer" class="form-control" required>
                                                            <option value="">Select Inteviewer</option>
                                                            @foreach($interviewer as $intv)
                                                                <option value="{{$intv->user_id}}">{{$intv->first_name.' '.$intv->last_name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="">Interview Date & Time</label>
                                                        <input type="datetime-local" name="interview_datetime" class="form-control" required>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="">Interview Method</label>
                                                        <select name="interview_type" id="interview_type" class="form-control" required>
                                                            <option value="">Select Inteview Method</option>
                                                            @foreach($intvMethod as $intvMet)
                                                                <option value="{{$intvMet->interview_type_id}}">{{$intvMet->interview_type_name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="form-group" id="venue">
                                                        <label for="">Interview Venue</label>
                                                        <textarea name="interview_venue" id="interview_venue" cols="30" rows="5" wrap="hard" class="form-control"></textarea>
                                                    </div>

                                                    <div class="alert alert-info" id="alertCode">
                                                        <i class="fa fa-info-circle"></i> Interview session code will be generated for online interview method.
                                                    </div>

                                                </div>
                                                <!-- Modal footer -->
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                                    <button type="submit" class="btn btn-success">Proceed</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                                <div class="modal fade" id="rejectConfirm">
                                    <div class="modal-dialog">
                                        <div class="modal-content">

                                            <!-- Modal Header -->
                                            <div class="modal-header">
                                                <h4 class="modal-title"><i class="fa fa-times"></i> Reject Applicant</h4>
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            </div>

                                            <form action="{{url("/technical-test/reject/".$member->technical_test_id)}}" method="post">
                                            {{csrf_field()}}
                                            <!-- Modal body -->
                                                <div class="modal-body">
                                                    Are you sure want to reject this applicant?
                                                </div>

                                                <!-- Modal footer -->
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                                    <button type="submit" class="btn btn-danger">Reject</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                                @if($member->average_score != null)
                                    <div class="text-center m-b-10">
                                        <button class="btn btn-primary" data-toggle="modal" data-target="#interviewConfirm"><i class="fa fa-calendar-o"></i> Set Interview Schedule</button>
                                        <button class="btn btn-danger" data-toggle="modal" data-target="#rejectConfirm"><i class="fa fa-times"></i> Reject</button>
                                    </div>
                                @else
                                    <div class="alert alert-warning">
                                        <i class="fa fa-warning"></i> You must submit technical test score to proceed this <br> applicant to interview phase.
                                        <a href="{{url('/technical-test/'.$member->technical_test_id)}}">Submit Score Here</a>
                                    </div>
                                @endif
                            @elseif($member->current_step == "interview")
                                @if($member->interview_status == "scheduled")
                                    <div class="alert alert-warning">
                                        <i class="fa fa-warning"></i> This applicant already has an interview schedule <br>
                                        Set interview to complete to accept or reject this applicant <br>
                                        <a href="{{url('/interview/'.$member->interview_id)}}">View Interview Details</a>
                                    </div>
                                @endif
                            @else
                                <div class="modal fade" id="acceptConfirm">
                                    <div class="modal-dialog">
                                        <div class="modal-content">

                                            <!-- Modal Header -->
                                            <div class="modal-header">
                                                <h4 class="modal-title"><i class="fa fa-check"></i> Accept Applicant</h4>
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            </div>

                                            <form action="{{url("/interview/proceed/".$member->interview_id)}}" method="post">
                                            {{csrf_field()}}
                                            <!-- Modal body -->
                                                <div class="modal-body">
                                                    Are you sure want to accept this applicant as a new employee?
                                                </div>
                                                <!-- Modal footer -->
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                                    <button type="submit" class="btn btn-success">Accept</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                                <div class="modal fade" id="rejectConfirm">
                                    <div class="modal-dialog">
                                        <div class="modal-content">

                                            <!-- Modal Header -->
                                            <div class="modal-header">
                                                <h4 class="modal-title"><i class="fa fa-times"></i> Reject Applicant</h4>
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            </div>

                                            <form action="{{url("/interview/reject/".$member->interview_id)}}" method="post">
                                            {{csrf_field()}}
                                            <!-- Modal body -->
                                                <div class="modal-body">
                                                    Are you sure want to reject this applicant?
                                                </div>

                                                <!-- Modal footer -->
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                                    <button type="submit" class="btn btn-danger">Reject</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <div class="text-center m-b-10">
                                    <button class="btn btn-success" data-toggle="modal" data-target="#acceptConfirm"><i class="fa fa-check"></i> Accept</button>
                                    <button class="btn btn-danger" data-toggle="modal" data-target="#rejectConfirm"><i class="fa fa-times"></i> Reject</button>
                                </div>
                            @endif

                        </div>
                    </div>
                </div>
            @endforeach
        </div>

    </div>

@endsection