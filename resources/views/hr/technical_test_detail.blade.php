@extends('.layout.dashboard_app')
@section('content')
    <style>
        textarea{
            resize: none;
        }
    </style>

    <div class="modal fade" id="interviewConfirm">
        <div class="modal-dialog">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title"><i class="fa fa-calendar-o"></i> Set Interview Schedule</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <form action="{{url("/technical-test/proceed/".$technical->technical_test_id)}}" method="post">
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

                <form action="{{url("/technical-test/reject/".$technical->technical_test_id)}}" method="post">
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
                                <div class="rounded-img-lg" style="background-image: url('@if($technical->photo_url) {{$technical->photo_url}} @else /assets/img/admin-avatar.png @endif')"></div>
                            </div>
                        </div>
                        <div class="col-md-9">
                            <div class="m-t-10">
                                <h2>{{$technical->first_name.' '.$technical->last_name}}</h2>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="m-b-20">
                                        <h6><i class="fa fa-envelope"></i> {{$technical->email}}</h6>
                                    </div>
                                    <div class="m-b-20">
                                        <h6><i class="fa fa-phone"></i> {{$technical->phone}}</h6>
                                    </div>
                                    <div class="m-b-20">
                                        <h6><i class="fa fa-home"></i> {{$technical->address}}</h6>
                                    </div>
                                    <div class="m-b-20">
                                        <h6><i class="fa fa-birthday-cake"></i> {{$technical->birth_place.', '.$technical->birth_date}}</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @if($technical->average_score != null)
                        <div class="text-right m-b-10">
                            <button class="btn btn-primary" data-toggle="modal" data-target="#interviewConfirm"><i class="fa fa-calendar-o"></i> Set Interview Schedule</button>
                            <button class="btn btn-danger" data-toggle="modal" data-target="#rejectConfirm"><i class="fa fa-times"></i> Reject</button>
                        </div>
                    @else
                        <div class="alert alert-warning">
                            <i class="fa fa-warning"></i> You must submit score to proceed this applicant to interview phase.
                        </div>
                    @endif
                </div>
            </div>
            <div class="ibox">
                <div class="ibox-head">
                    <div class="ibox-title text-info">Applicant Test Scoring</div>
                    <div class="ibox-tools">
                        <a class="ibox-collapse"><i class="fa fa-minus"></i></a>
                    </div>
                </div>
                <div class="ibox-body">
                    @if($technical->average_score == null)
                        @if(count($approg)>0)
                            <form action="{{url('/technical-test/update/'.$technical->technical_test_id)}}" method="post">
                                {{csrf_field()}}
                                <div class="row">
                                    @foreach($approg as $appr)
                                        <div class="col-md-12">
                                            <div class="row m-b-5">
                                                <div class="col-md-4">
                                                    <label for=""><b>{{$appr->progress_name}}</b></label>
                                                </div>
                                                <div class="col-md-8">
                                                    <input type="text" name="sequence[]" value="{{$appr->sequence}}" hidden>
                                                    <input type="number" name="score[]" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <div class="text-right">
                                    <button class="btn btn-success">Submit Score</button>
                                </div>
                            </form>
                        @else
                            <div class="text-center">
                                <h6 class="text-muted">There is no technical test for this applicant</h6>
                            </div>
                        @endif
                    @else
                        @if(count($approg)>0)
                            <div class="row">
                                @foreach($approg as $appr)
                                    <div class="col-md-12">
                                        <div class="row m-b-5">
                                            <div class="col-md-4">
                                                <label for=""><b>{{$appr->progress_name}}</b></label>
                                            </div>
                                            <div class="col-md-8">
                                                @php($id = 'score_'.$appr->sequence)
                                                <h6>{{ $technical->{$id} }}</h6>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <div class="text-right m-20">
                                <h6><b>Average Score</b></h6>
                                <h3>
                                    @if($technical->average_score > 80)
                                        <span id="avgScore" class="text-success">
                                            {{$technical->average_score}}
                                        </span>
                                    @elseif($technical->average_score > 60)
                                        <span id="avgScore" class="text-warning">
                                            {{$technical->average_score}}
                                        </span>
                                    @else
                                        <span id="avgScore" class="text-danger">
                                            {{$technical->average_score}}
                                        </span>
                                    @endif
                                </h3>
                            </div>
                            <div class="text-right">
                                <a href="{{url('/technical-test/'.$technical->technical_test_id.'/print')}}" target="_blank" class="btn btn-info">Print Test Report</a>
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
        <div class="col-md-7">
            <div class="ibox">
                <div class="ibox-head">
                    <div class="ibox-title">Test Result Document</div>
                </div>
                <div class="ibox-body">
                    @if(count($documents) > 0)
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th>Document Name</th>
                                <th>Document Type</th>
                                <th>Upload Time</th>
                                <th class="text-center">####</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($documents as $doc)
                                <tr>
                                    <td>{{$doc->document_name}}</td>
                                    <td>{{$doc->document_type_name}}</td>
                                    <td><small>{{TimeSince( strtotime('now') - strtotime($doc->created_at))}} ago</small></td>
                                    <td class="text-center"><a href="{{$doc->document_url}}" target="_blank"><i class="fa fa-download"></i></a></td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    @else
                        <h6 class="text-muted">This applicant has no document.</h6>
                    @endif
                </div>
            </div>
        </div>

    </div>

    <script>
        $(document).ready(function () {
            $("#venue").hide()
            $("#interview_type").change(function () {
                if($(this).val() === "ITY0001"){
                    $("#venue").show()
                }else{
                    $("#venue").hide()
                }
            });
        });
    </script>
@endsection