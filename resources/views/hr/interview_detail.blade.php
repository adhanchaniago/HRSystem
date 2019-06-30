@extends('.layout.dashboard_app')
@section('content')
    <style>
        textarea{
            resize: none;
        }
    </style>

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
                            <div class="m-t-10 m-b-25">
                                <h5 class="text-info"><i class="fa fa-clipboard"></i> Applied Job</h5>
                                <h6><b>{{$interview->job_name}}</b></h6>
                                <small class="text-muted">{{$interview->department_name}}</small>
                            </div>
                            @if($interview->average_score != null)
                                <h5 class="text-info"><i class="fa fa-check-circle"></i> Technical Test Result</h5>
                                @if(count($approg)>0)
                                    <div class="row">
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
                                    </div>
                                @else
                                    <div class="text-center">
                                        <h6 class="text-muted">There is no technical test for this applicant</h6>
                                    </div>
                                @endif
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
                                    {{$interview->interview_datetime}}
                                </div>
                            </div>
                            <div>
                                <h5><b><i class="fa fa-user"></i> Interviewer</b></h5>
                                <div class="m-l-25">
                                    {{$interview->interviewer_first_name.' '.$interview->interviewer_last_name}}
                                </div>
                            </div>
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
                    @if($interview->status == "scheduled")
                        @if($interview->interview_venue == null)
                            <div class="alert alert-info m-b-10">
                                The start interview button will appear at the scheduled time. Don't worry, we will notify you on 1 day before interview time.
                                <br>
                                <div class="text-right">
                                    <button class="btn btn-success" data-toggle="modal" data-target="#viewQR"><i class="fa fa-qrcode"></i> View Interview Code</button>
                                </div>
                                <div class="modal fade" id="viewQR">
                                    <div class="modal-dialog modal-sm">
                                        <div class="modal-content">

                                            <!-- Modal Header -->
                                            <div class="modal-header">
                                                <h4 class="modal-title"><i class="fa fa-qrcode"></i> Interview QR Code</h4>
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            </div>
                                            <!-- Modal body -->
                                            <div class="modal-body">
                                                <img src="\assets\img\frame.png" width="100%" alt="QRCcode">
                                            </div>
                                            <!-- Modal footer -->
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @else
                            <div class="text-right m-b-10">
                                <button class="btn btn-primary" data-toggle="modal" data-target="#completeConfirm"><i class="fa fa-check"></i> Complete Interview</button>
                            </div>
                        @endif
                    @elseif($interview->status == "completed")
                        <div class="text-right m-b-10">
                            <button class="btn btn-success" data-toggle="modal" data-target="#acceptConfirm"><i class="fa fa-check"></i> Accept</button>
                            <button class="btn btn-danger" data-toggle="modal" data-target="#rejectConfirm"><i class="fa fa-times"></i> Reject</button>
                        </div>
                    @endif
                </div>
            </div>
        </div>

    </div>



@endsection