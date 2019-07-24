@extends('.layout.dashboard_app')
@section('content')
    <style>
        textarea{
            resize: none;
        }
    </style>

    <div class="modal fade" id="rescheduleModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title text-warning"><i class="fa fa-refresh"></i> Reschedule Interview</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <!-- Modal body -->
                <form action="/interview/reschedule/{{$interview->interview_id}}" method="post">
                    {{csrf_field()}}
                    <div class="modal-body text-left">
                        <div class="row">
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label for="">Interview Date</label>
                                    <input type="date" name="new_date" value="{{$interview->interview_date}}" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">Time</label>
                                    <input type="time" name="new_time" value="{{$interview->interview_time}}" class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button class="btn btn-primary" type="submit">Reschedule</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="completeConfirm">
        <div class="modal-dialog">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title"><i class="fa fa-check"></i> Complete Interview</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <form action="{{url("/interview/completed/".$interview->interview_id)}}" method="post">
                {{csrf_field()}}
                <!-- Modal body -->
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="">Interview Score</label>
                            <input type="number" class="form-control" name="interview_score" max="100" min="0" required>
                        </div>
                    </div>
                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-success">Complete</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="acceptConfirm">
        <div class="modal-dialog">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title"><i class="fa fa-check"></i> Accept Applicant</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <form action="{{url("/interview/proceed/".$interview->interview_id)}}" method="post">
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

                <form action="{{url("/interview/reject/".$interview->interview_id)}}" method="post">
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

    <div class="row">
        <div class="col-md-5">
            <div class="ibox">
                <div class="ibox-head">
                    <div class="ibox-title">Applicant Information</div>
                    <div class="ibox-tools">
                        <a class="ibox-collapse"><i class="fa fa-minus"></i></a>
                        <a class="fullscreen-link"><i class="fa fa-expand"></i></a>
                    </div>
                </div>

                <div class="ibox-body">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="m-t-20">
                                <div class="rounded-img-lg" style="background-image: url('@if($interview->photo_url) {{$interview->photo_url}} @else /assets/img/admin-avatar.png @endif')"></div>
                            </div>
                        </div>
                        <div class="col-md-9">
                            <div class="m-t-10">
                                <h2>{{$interview->first_name.' '.$interview->last_name}}</h2>
                            </div>
                            <hr>
                            @if(Auth::user()->role_id == "ROLE001")
                                <div class="m-t-10 m-b-25">
                                    <h5 class="text-info"><i class="fa fa-clipboard"></i> Applied Job</h5>
                                    <h6><b>{{$interview->job_name}}</b></h6>
                                    <small class="text-muted">{{$interview->department_name}}</small>
                                </div>
                                @if($interview->average_score != null)
                                    <h5 class="text-info"><i class="fa fa-check-circle"></i> Technical Test Result</h5>
                                    @if(count($approg)>0)
                                        <div class="row m-b-20">
                                            @foreach($approg as $appr)
                                                <div class="col-md-12">
                                                    <div class="row m-b-5">
                                                        <div class="col-md-7">
                                                            <label for=""><b>{{$appr->progress_name}}</b></label>
                                                        </div>
                                                        <div class="col-md-5">
                                                            @php($id = 'score_'.$appr->sequence)
                                                            <h6>{{ $interview->{$id} }}</h6>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                            @if($interview->interview_score == null)
                                                <div class="col-md-9" style="border-top: solid 1px lightgrey;"></div>
                                                <div class="col-md-12">
                                                    <div class="row m-b-5 m-t-25">
                                                        <div class="col-md-7">
                                                            <h6><b>Average Score</b></h6>
                                                        </div>
                                                        <div class="col-md-5">
                                                            <h3>
                                                                @if($interview->average_score > 80)
                                                                    <span id="avgScore" class="text-success">
                                                                    {{$interview->average_score}}
                                                                </span>
                                                                @elseif($interview->average_score > 60)
                                                                    <span id="avgScore" class="text-warning">
                                                                    {{$interview->average_score}}
                                                                </span>
                                                                @else
                                                                    <span id="avgScore" class="text-danger">
                                                                    {{$interview->average_score}}
                                                                </span>
                                                                @endif
                                                            </h3>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                    @else
                                        <div class="text-center">
                                            <h6 class="text-muted">There is no technical test for this applicant</h6>
                                        </div>
                                    @endif
                                @endif
                                @if($interview->interview_score != null)
                                    <h5 class="text-info"><i class="fa fa-check-circle"></i> Interview Result</h5>
                                    <div class="row m-b-20">
                                        <div class="col-md-12">
                                            <div class="row m-b-5">
                                                <div class="col-md-7">
                                                    <label for=""><b>Interview Score</b></label>
                                                </div>
                                                <div class="col-md-5">
                                                    <h6>{{$interview->interview_score }}</h6>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @else
                                <div class="m-t-10 m-b-25">
                                    <h5>Completed Test</h5>
                                    @foreach($approg as $appr)
                                        <h6 class="text-success"><i class="fa fa-check"></i> {{$appr->progress_name}}</h6>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-7">
            <div class="ibox">
                <div class="ibox-head">
                    <div class="ibox-title">Interview Schedule</div>
                </div>
                <div class="ibox-body">
                    <div class="row m-b-30">
                        <div class="col-md-8">
                            <div class="m-b-30">
                                <h5><b><i class="fa fa-calendar-o"></i> Interview Date</b></h5>
                                <div class="m-l-25">
                                    {{$interview->interview_date.' '.$interview->interview_time}}
                                </div>
                            </div>
                            <div class="m-b-30">
                                <h5><b><i class="fa fa-user"></i> Interviewer</b></h5>
                                <div class="m-l-25">
                                    {{$interview->interviewer_first_name.' '.$interview->interviewer_last_name}}
                                </div>
                            </div>
                            @if($interview->interview_type_id != "ITY0002")
                                <div>
                                    <h5><b><i class="fa fa-building"></i> Interview Venue</b></h5>
                                    <div class="m-l-25">
                                        <textarea name="" id="" cols="100" rows="5" style="border: 0;" readonly>{{$interview->interview_venue}}</textarea>
                                    </div>
                                </div>
                            @endif
                        </div>
                        <div class="col-md-4">
                            <div class="text-center">
                                @if($interview->interview_type_id == "ITY0002")
                                    <h2 class="text-muted"><i class="fa fa-video-camera fa-3x"></i></h2>
                                @else
                                    <h2 class="text-muted"><i class="fa fa-handshake-o fa-3x"></i></h2>
                                @endif
                                    <h4><b>{{$interview->interview_type_name}}</b></h4>
                            </div>
                        </div>
                    </div>

                    @if(Auth::user()->role_id == "ROLE001")
                        @if($interview->status == "scheduled")
                            @if($interview->interview_venue == null && $interview->interview_code != null)
                                @if($now > $start_date && $now < $expired_date )
                                    <div class="alert alert-info m-b-10">
                                        <div class="row">
                                            <div class="col-md-5">
                                                <div class="p-10" style="background-color: white">
                                                    <div id="qrcode"></div>
                                                </div>
                                            </div>
                                            <div class="col-md-7">
                                                The start interview button will appear at the scheduled time. Scan this QR in case you want to start interview on another device.
                                            </div>
                                        </div>

                                        <script type="text/javascript">
                                            var url = window.location.origin;
                                            new QRCode(document.getElementById("qrcode"),
                                                {
                                                    text: url+"/interview/session/{{$interview->interview_code}}",
                                                    border: 4,
                                                    colorDark : "#000000",
                                                    colorLight : "#ffffff",
                                                    correctLevel : QRCode.CorrectLevel.H
                                                });
                                        </script>
                                        <div class="text-right">
                                            @if($now < $rescheduleMinTime)
                                                <button class="btn btn-warning" data-toggle="modal" data-target="#rescheduleModal"><i class="fa fa-refresh"></i> Reschedule</button>
                                            @endif
                                            <button class="btn btn-primary" data-toggle="modal" data-target="#scanQR"><i class="fa fa-video-camera"></i> Start Interview Session</button>
                                            <div class="modal fade" id="scanQR">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <!-- Modal Header -->
                                                        <div class="modal-header">
                                                            <h4 class="modal-title text-warning"><i class="fa fa-warning"></i> Please Pay Attention to This</h4>
                                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                        </div>
                                                        <!-- Modal body -->
                                                        <div class="modal-body text-left">
                                                            <div class="alert alert-info">
                                                                <h5>Please make sure that you:</h5>
                                                                <ul>
                                                                    <li>Has a stable internet connection.</li>
                                                                    <li>Has a good audio & video quality.</li>
                                                                    <li>Pick the perfect spot.</li>
                                                                    <li>Sit up and dress professionally.</li>
                                                                </ul>
                                                            </div>
                                                            <div class="alert alert-danger">
                                                                <h5>Please don't:</h5>
                                                                <ul>
                                                                    <li>Lose focus.</li>
                                                                    <li>Forget to research common interview questions.</li>
                                                                    <li>Forget to follow-up.</li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                        <!-- Modal footer -->
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                            <form action="/interview/session/{{$interview->interview_code}}" method="get">
                                                                {{csrf_field()}}
                                                                <button class="btn btn-primary" type="submit">Start Interview</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @elseif($now > $expired_date )
                                    <div class="alert alert-danger m-b-10">
                                        We're sorry, but your interview session has been expired. Please reschedule to complete this interview.
                                        <div class="text-right m-b-10">
                                            <button class="btn btn-warning" data-toggle="modal" data-target="#rescheduleModal"><i class="fa fa-refresh"></i> Reschedule</button>
                                        </div>
                                    </div>
                                @elseif($now < $start_date)
                                    <div class="alert alert-info m-b-10">
                                        The start interview button and interview QR Code will appear at the scheduled time. After 30 minutes from the initial time, this interview will remain to expired and need to reschedule.
                                    </div>
                                @endif
                            @else
                                <div class="text-right m-b-10">
                                    <button class="btn btn-warning" data-toggle="modal" data-target="#rescheduleModal"><i class="fa fa-refresh"></i> Reschedule</button>
                                    <button class="btn btn-primary" data-toggle="modal" data-target="#completeConfirm"><i class="fa fa-check"></i> Complete Interview</button>
                                </div>
                            @endif
                        @elseif($interview->status == "completed")
                            <div class="text-right m-b-10">
                                <button class="btn btn-success" data-toggle="modal" data-target="#acceptConfirm"><i class="fa fa-check"></i> Accept</button>
                                <button class="btn btn-danger" data-toggle="modal" data-target="#rejectConfirm"><i class="fa fa-times"></i> Reject</button>
                            </div>
                        @endif
                    @else
                        @if($interview->interview_venue == null && $interview->interview_code != null)

                            @if($now > $start_date && $now < $expired_date )
                                <div class="alert alert-info m-b-10">
                                    <div class="row">
                                        <div class="col-md-5">
                                            <div class="p-10" style="background-color: white">
                                                <div id="qrcode"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-7">
                                            Click start interview session below to start interview or you can scan the QR Code in case you want to start interview on another device.
                                        </div>
                                    </div>

                                    <script type="text/javascript">
                                        var url = window.location.origin;
                                        new QRCode(document.getElementById("qrcode"),
                                            {
                                                text: url+"/interview/session/{{$interview->interview_code}}",
                                                border: 4,
                                                colorDark : "#000000",
                                                colorLight : "#ffffff",
                                                correctLevel : QRCode.CorrectLevel.H
                                            });
                                    </script>
                                    <div class="text-right">

                                        <button class="btn btn-primary" data-toggle="modal" data-target="#scanQR"><i class="fa fa-video-camera"></i> Start Interview Session</button>

                                        <div class="modal fade" id="scanQR">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <!-- Modal Header -->
                                                    <div class="modal-header">
                                                        <h4 class="modal-title text-warning"><i class="fa fa-warning"></i> Please Pay Attention to This</h4>
                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                    </div>
                                                    <!-- Modal body -->
                                                    <div class="modal-body text-left">
                                                        <div class="alert alert-info">
                                                            <h5>Please make sure that you:</h5>
                                                            <ul>
                                                                <li>Has a stable internet connection.</li>
                                                                <li>Has a good audio & video quality.</li>
                                                                <li>Pick the perfect spot.</li>
                                                                <li>Sit up and dress professionally.</li>
                                                            </ul>
                                                        </div>
                                                        <div class="alert alert-danger">
                                                            <h5>Please don't:</h5>
                                                            <ul>
                                                                <li>Lose focus.</li>
                                                                <li>Forget to research common interview questions.</li>
                                                                <li>Forget to follow-up.</li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <!-- Modal footer -->
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                        <form action="/interview/session/{{$interview->interview_code}}" method="get">
                                                            {{csrf_field()}}
                                                            <button class="btn btn-primary" type="submit">Start Interview</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @elseif($now > $expired_date )
                                <div class="alert alert-danger m-b-10">
                                    We're sorry, but your interview session has been expired. Please ask the interviewer to reschedule interview time.
                                </div>
                            @elseif($now < $start_date)
                                <div class="alert alert-info m-b-10">
                                    The start interview button and interview QR Code will appear at the scheduled time. After 30 minutes from the initial time, this interview will remain to expired and need to reschedule.
                                </div>
                            @endif
                        @endif
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection