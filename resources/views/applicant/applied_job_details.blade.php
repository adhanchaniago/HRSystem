@extends('layout.dashboard_app')
@section('content')
    <div class="page-content fade-in-up">
        <div class="ibox">
            <div class="ibox-body">
                <div class="m-20">
                    <h2>{{$applicants->job_name}}</h2>
                    <h6 class="text-muted">{{$applicants->department_name}}</h6>
                </div>
                <hr>
                <div class="row text-center text-muted">
                    @if($applicants->current_step == "apply")
                        @if($applicants->status == "waiting")
                            <div class="col-md-3 step-item text-primary">
                                <div class="m-b-10">
                                    <i class="fa fa-file-o fa-5x"></i>
                                </div>
                                <h5>1. Apply Job</h5>
                            </div>
                        @elseif($applicants->status == "rejected")
                            <div class="col-md-3 step-item step-fail">
                                <div class="m-b-10">
                                    <i class="fa fa-file-o fa-5x"></i>
                                </div>
                                <h5>1. Apply Job</h5>
                            </div>
                        @endif
                        <div class="col-md-3 step-item" data-href="/technical-test/{{$applicants->technical_test_id}}/print">
                            <div class="m-b-10">
                                <i class="fa fa-edit fa-5x"></i>
                            </div>
                            <h5>2. Technical Test</h5>
                        </div>
                        <div class="col-md-3 step-item" data-href="/interview/{{$applicants->interview_id}}/print">
                            <div class="m-b-10">
                                <i class="fa fa-users fa-5x"></i>
                            </div>
                            <h5>3. Interview</h5>
                        </div>
                        <div class="col-md-3 step-item" data-href="/final/{{$applicants->interview_id}}/print">
                            <div class="m-b-10">
                                <i class="fa fa-flag-checkered fa-5x"></i>
                            </div>
                            <h5>4. Final Results</h5>
                        </div>
                    @elseif($applicants->current_step == "technical_test")
                        <div class="col-md-3 step-item step-pass">
                            <div class="m-b-10">
                                <i class="fa fa-file-o fa-5x"></i>
                            </div>
                            <h5>1. Apply Job</h5>
                        </div>
                        @if($applicants->status == "waiting")
                            <div class="col-md-3 step-item" data-href="/technical-test/{{$applicants->technical_test_id}}/print">
                                <div class="m-b-10">
                                    <i class="fa fa-edit fa-5x"></i>
                                </div>
                                <h5>2. Technical Test</h5>
                            </div>
                        @elseif($applicants->status == "rejected")
                            <div class="col-md-3 step-item step-fail" data-href="/technical-test/{{$applicants->technical_test_id}}/print">
                                <div class="m-b-10">
                                    <i class="fa fa-edit fa-5x"></i>
                                </div>
                                <h5>2. Technical Test</h5>
                            </div>
                        @endif
                        <div class="col-md-3 step-item" data-href="/interview/{{$applicants->interview_id}}/print">
                            <div class="m-b-10">
                                <i class="fa fa-users fa-5x"></i>
                            </div>
                            <h5>3. Interview</h5>
                        </div>
                        <div class="col-md-3 step-item" data-href="/final/{{$applicants->interview_id}}/print">
                            <div class="m-b-10">
                                <i class="fa fa-flag-checkered fa-5x"></i>
                            </div>
                            <h5>4. Final Results</h5>
                        </div>

                    @elseif($applicants->current_step == "interview")
                        <div class="col-md-3 step-item step-pass">
                            <div class="m-b-10">
                                <i class="fa fa-file-o fa-5x"></i>
                            </div>
                            <h5>1. Apply Job</h5>
                        </div>
                        <div class="col-md-3 step-item step-pass" data-href="/technical-test/{{$applicants->technical_test_id}}/print">
                            <div class="m-b-10">
                                <i class="fa fa-edit fa-5x"></i>
                            </div>
                            <h5>2. Technical Test</h5>
                        </div>
                        @if($applicants->status == "waiting")
                            <div class="col-md-3 step-item" data-href="/interview/{{$applicants->interview_id}}/print">
                                <div class="m-b-10">
                                    <i class="fa fa-users fa-5x"></i>
                                </div>
                                <h5>3. Interview</h5>
                            </div>
                        @elseif($applicants->status == "rejected")
                            <div class="col-md-3 step-item step-fail" data-href="/interview/{{$applicants->interview_id}}/print">
                                <div class="m-b-10">
                                    <i class="fa fa-users fa-5x"></i>
                                </div>
                                <h5>3. Interview</h5>
                            </div>
                        @endif
                        <div class="col-md-3 step-item" data-href="/final/{{$applicants->interview_id}}/print">
                            <div class="m-b-10">
                                <i class="fa fa-flag-checkered fa-5x"></i>
                            </div>
                            <h5>4. Final Results</h5>
                        </div>
                    @elseif($applicants->current_step == "final")
                        <div class="col-md-3 step-item step-pass">
                            <div class="m-b-10">
                                <i class="fa fa-file-o fa-5x"></i>
                            </div>
                            <h5>1. Apply Job</h5>
                        </div>
                        <div class="col-md-3 step-item step-pass" data-href="/technical-test/{{$applicants->technical_test_id}}/print">
                            <div class="m-b-10">
                                <i class="fa fa-edit fa-5x"></i>
                            </div>
                            <h5>2. Technical Test</h5>
                        </div>
                        <div class="col-md-3 step-item step-pass" data-href="/interview/{{$applicants->interview_id}}/print">
                            <div class="m-b-10">
                                <i class="fa fa-users fa-5x"></i>
                            </div>
                            <h5>3. Interview</h5>
                        </div>
                        @if($applicants->status == "waiting")
                            <div class="col-md-3 step-item" data-href="/final/{{$applicants->interview_id}}/print">
                                <div class="m-b-10">
                                    <i class="fa fa-flag-checkered fa-5x"></i>
                                </div>
                                <h5>4. Final Results</h5>
                            </div>
                        @elseif($applicants->status == "accepted")
                            <div class="col-md-3 step-item step-pass" data-href="/final/{{$applicants->interview_id}}/print">
                                <div class="m-b-10">
                                    <i class="fa fa-flag-checkered fa-5x"></i>
                                </div>
                                <h5>4. Final Results</h5>
                            </div>
                        @elseif($applicants->status == "rejected")
                            <div class="col-md-3 step-item step-fail" data-href="/final/{{$applicants->interview_id}}/print">
                                <div class="m-b-10">
                                    <i class="fa fa-flag-checkered fa-5x"></i>
                                </div>
                                <h5>4. Final Results</h5>
                            </div>
                        @else
                            <div class="col-md-3 step-item step-pass" data-href="/final/{{$applicants->interview_id}}/print">
                                <div class="m-b-10">
                                    <i class="fa fa-flag-checkered fa-5x"></i>
                                </div>
                                <h5>4. Final Results</h5>
                            </div>
                        @endif
                    @endif
                </div>
                <hr>
                <div class="m-t-20">
                    @if($applicants->current_step == "apply")
                        @if($applicants->status == "waiting")
                            <div class="alert alert-success">
                                <h6><i class="fa fa-check"></i> There is nothing to do. Just sit tight and wait for next announcement.</h6>
                            </div>
                        @elseif($applicants->status == "rejected")
                            <div class="alert alert-danger">
                                <h6><i class="fa fa-times"></i> We're sorry, but you're not quilifed to this job. Please try again later or try to apply another job.
                                    <a href="{{url('/job')}}" class="btn btn-info">See Another Open Jobs</a></h6>
                            </div>
                        @endif
                    @elseif($applicants->current_step == "technical_test")
                        @if($applicants->status == "waiting")
                            <h3>Technical Test</h3>
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Test Name</th>
                                        <th class="text-center">Download Questions</th>
                                        <th class="text-center">Upload Answers</th>
                                        <th class="text-center">Last Upload</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($progress as $idx=>$prog)
                                        @php($uploadDoc = DB::table('document')->where([['regarding_id', '=', $applicants->applicant_id], ['document_name', '=', $applicants->applicant_id.$prog->application_progress_id.str_replace(' ', '', $prog->progress_name)]])->first())
                                        <div class="modal fade" id="uploadAnswer">
                                            <div class="modal-dialog">
                                                <div class="modal-content">

                                                    <!-- Modal Header -->
                                                    <div class="modal-header">
                                                        <h4 class="modal-title"><i class="fa fa-upload"></i> Upload {{$prog->progress_name}} Answers</h4>
                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                    </div>

                                                    <form action="{{url("/technical-test/upload-answer/".$applicants->applicant_id)}}" method="post" enctype="multipart/form-data">
                                                        {{csrf_field()}}

                                                        <!-- Modal body -->
                                                        <div class="modal-body">
                                                            <input type="text" class="form-control" name="document_name" value="{{$applicants->applicant_id.$prog->application_progress_id.str_replace(' ', '', $prog->progress_name)}}" hidden>
                                                            <div class="form-group">
                                                                <label for="">{{$prog->progress_name}} Answer</label>
                                                                <input type="file" class="form-control" name="answerFile">
                                                            </div>
                                                            <div>
                                                                <small><i><span style="color: red;">*</span>If any, the existing file will be replaced.</i></small>
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
                                        <tr>
                                            <td>{{$idx+1}}</td>
                                            <td>{{$prog->progress_name}}</td>
                                            <td class="text-center">
                                                @if($prog->document_url != null || $prog->document_url != "")
                                                    <a href="{{$prog->document_url}}" download="{{$prog->progress_name}}" class="btn btn-success btn-sm"><i class="fa fa-download"></i></a>
                                                @else
                                                    <a href="#" class="btn btn-default btn-sm disabled"><i class="fa fa-download"></i></a>
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                <a href="#" data-toggle="modal" data-target="#uploadAnswer" class="btn btn-primary btn-sm"><i class="fa fa-upload"></i></a>
                                            </td>
                                            <td class="text-center">
                                                @if($uploadDoc)
                                                    {{$uploadDoc->created_at}}&nbsp;&nbsp;<a href="{{$uploadDoc->document_url}}" download="{{$uploadDoc->document_name}}" class="btn btn-success btn-sm"><i class="fa fa-download"></i></a>
                                                @else
                                                    <a href="#" class="btn btn-default disabled btn-sm"><i class="fa fa-download"></i></a>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @elseif($applicants->status == "rejected")
                            <div class="alert alert-danger">
                                <h6><i class="fa fa-times"></i> We're sorry, you already tried so hard but God has a better plan for you.
                                    <br><br>Please try again later or try to apply another job.
                                    <a href="{{url('/job')}}" class="btn btn-info btn-sm">See Another Open Jobs</a></h6>
                            </div>
                        @endif
                    @elseif($applicants->current_step == "interview")
                        @if($applicants->status == "waiting")
                            <div class="alert alert-success">
                                <h6><i class="fa fa-check"></i> Please attend the interview, and wait for next information about interview results.</h6>
                            </div>
                        @elseif($applicants->status == "rejected")
                            <div class="alert alert-danger">
                                <h6><i class="fa fa-times"></i> We're sorry, you already tried so hard but God has a better plan for you.
                                    <br><br>Please try again later or try to apply another job.
                                    <a href="{{url('/job')}}" class="btn btn-info btn-sm">See Another Open Jobs</a></h6>
                            </div>
                        @endif
                    @else
                        @if($applicants->status == "waiting")
                            <div class="alert alert-success">
                                <h6><i class="fa fa-check"></i> There is nothing more to do. Just sit tight and wait for next announcement.</h6>
                            </div>
                        @elseif($applicants->status == "accepted")
                            <div class="alert alert-success">
                                <h6><i class="fa fa-check"></i> Congratulation! You've been accepted as a new employee for job {{$applicants->job_name}}.</h6>
                            </div>
                        @elseif($applicants->status == "rejected")
                            <div class="alert alert-danger">
                                <h6><i class="fa fa-times"></i> We're sorry, you already tried so hard but God has a better plan for you.
                                    <br><br>Please try again later or try to apply another job.
                                    <a href="{{url('/job')}}" class="btn btn-info btn-sm">See Another Open Jobs</a></h6>
                            </div>
                        @endif
                    @endif
                </div>
            </div>
        </div>
    </div>

    <script>

        $(".step-item").each(function(idx){
            var text = $(this).children("h5").text();
            if($(this).hasClass("step-pass"))
            {
                $(this).addClass("text-success");
                $(this).children("h5").html(text+" <i class='fa fa-check-circle-o'></i>")
                if(idx!==0){
                    $(this).append("<a href='"+$(this).attr("data-href")+"' target='_blank' class='btn btn-primary'>View Report</a>");
                }

                if($(this).hasClass("text-primary")){
                    $(this).removeClass("text-primary");
                }
                $(this).next().addClass("text-primary");
            }
            else if($(this).hasClass("step-fail"))
            {
                $(this).addClass("text-danger");
                $(this).children("h5").html(text+" <i class='fa fa-times-circle-o'></i>")
                if(idx!==0){
                    $(this).append("<a href='"+$(this).attr("data-href")+"' target='_blank' class='btn btn-primary'>View Report</a>");
                }
            }
        });

    </script>
@endsection