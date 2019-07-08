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
                    @if(Auth::user()->role_id == "ROLE001")
                        <div class="modal fade" id="editJobModal{{$job->job_id}}">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">

                                    <!-- Modal Header -->
                                    <div class="modal-header">
                                        <h4 class="modal-title"><i class="fa fa-edit"></i> Update Job</h4>
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    </div>

                                    <form action="{{url("/job/edit/".$job->job_id)}}" method="post" enctype="multipart/form-data">
                                    {{csrf_field()}}
                                    <!-- Modal body -->
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <label for="">Department</label>
                                                <select name="job_department" id="job_department" class="form-control" required>
                                                    <option value="">--Select--</option>
                                                    @foreach($department as $dept)
                                                        @if($dept->department_id == $job->department_id)
                                                            <option value="{{$dept->department_id}}" selected>{{$dept->department_name}}</option>
                                                        @else
                                                            <option value="{{$dept->department_id}}">{{$dept->department_name}}</option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="">Job Name</label>
                                                <input type="text" name="job_name" placeholder="Job Name" value="{{$job->job_name}}" class="form-control" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="">Salary</label>
                                                <input type="number" name="salary" value="{{$job->salary}}" placeholder="Salary" class="form-control" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="">Job Description</label>
                                                <textarea name="job_desc" id="job_desc" cols="40" rows="5" wrap="hard" class="form-control" required>{{$job->description}}</textarea>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="">Minimum Age</label>
                                                        <input type="number" name="min_age" placeholder="Minimum Age" class="form-control" value="{{$job->minimum_age}}" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="">Minimum Experience</label>
                                                        <input type="number" name="min_exp" placeholder="Minimum Experience" value="{{$job->minimum_experience}}" class="form-control" required>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="">Priority Skill</label>
                                                <div class="input_fields_wrap">
                                                    @if(count($skills) > 0)
                                                        @php($ed_idx = 0)
                                                        @foreach($skills as $skill)
                                                            @if($ed_idx == 0)
                                                                <div class="row m-b-15">
                                                                    <div class="col-md-9">
                                                                        <div class="row">
                                                                            <div class="col-md-8">
                                                                                <input type="text" name="skill[]" placeholder="Skill" value="{{$skill->skill_name}}" class="form-control" required>
                                                                            </div>
                                                                            <div class="col-md-4">
                                                                                <input type="number" name="skillRate[]" placeholder="Rate" value="{{$skill->rate}}" min="0" max="100" class="form-control" required>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-3">
                                                                        <button class="add_field_button btn btn-success" type="button"><i class="fa fa-plus"></i> Add More</button>
                                                                    </div>
                                                                </div>
                                                            @else
                                                                <div class="row m-b-15">
                                                                    <div class="col-md-9">
                                                                        <div class="row">
                                                                            <div class="col-md-8">
                                                                                <input type="text" name="skill[]" placeholder="Skill" value="{{$skill->skill_name}}" class="form-control" required>
                                                                            </div>
                                                                            <div class="col-md-4">
                                                                                <input type="number" name="skillRate[]" placeholder="Rate" value="{{$skill->rate}}" min="0" max="100" class="form-control" required>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-3">
                                                                        <button class="remove_field btn btn-danger" type="button"><i class="fa fa-trash"></i></button>
                                                                    </div>
                                                                </div>
                                                            @endif
                                                            @php($ed_idx++)
                                                        @endforeach
                                                    @else
                                                        <div class="row m-b-15">
                                                            <div class="col-md-9">
                                                                <div class="row">
                                                                    <div class="col-md-8">
                                                                        <input type="text" name="skill[]" placeholder="Skill" class="form-control" required>
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <input type="number" name="skillRate[]" placeholder="Rate" min="0" max="100" class="form-control" required>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <button class="add_field_button btn btn-success" type="button"><i class="fa fa-plus"></i> Add More</button>
                                                            </div>
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group col-lg-6">
                                                    <label for="">Active Date</label>
                                                    <input type="date" name="active_date" class="form-control" value="{{$job->active_date}}" required>
                                                </div>
                                                <div class="form-group col-lg-6">
                                                    <label for="">Expired Date</label>
                                                    <input type="date" name="expired_date" class="form-control" value="{{$job->expired_date}}" required>
                                                </div>

                                            </div>
                                        </div>
                                        <!-- Modal footer -->
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                            <button type="submit" class="btn btn-success">Save Changes</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="modal fade" id="deactiveModal{{$job->job_id}}">
                            <div class="modal-dialog">
                                <div class="modal-content">

                                    <!-- Modal Header -->
                                    <div class="modal-header">
                                        <h4 class="modal-title"><i class="fa fa-times"></i> Deactive Job</h4>
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    </div>

                                    <!-- Modal body -->
                                    <div class="modal-body">
                                        <h6>Are you sure want to deactive job {{$job->job_name}} ?</h6>
                                    </div>
                                    <!-- Modal footer -->
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                        <a href="{{url('/job/deactive-job/'.$job->job_id)}}" class="btn btn-success">Deactive</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="text-right m-b-10">
                            {{--Edit Job Button--}}
                            <button class="btn btn-default" data-toggle="modal" data-target="#editJobModal{{$job->job_id}}"><i class="fa fa-edit"></i> Edit Job</button>

                            {{--Deactive Job Button--}}
                            <button class="btn btn-danger" data-toggle="modal" data-target="#deactiveModal{{$job->job_id}}"><i class="fa fa-times"></i> Deactive Job</button>
                        </div>
                    @endif
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="ibox">
                <div class="ibox-head">
                    <div class="ibox-title">Technical Test</div>
                    <div class="ibox-tools">
                        @if(Auth::user()->role_id == "ROLE001")
                            <button class="btn btn-primary btn-xs" data-toggle="modal" data-target="#appProgressModal"><i class="fa fa-plus font-14"></i></button>
                            <div class="modal fade" id="appProgressModal">
                                <div class="modal-dialog">
                                    <div class="modal-content">

                                        <!-- Modal Header -->
                                        <div class="modal-header">
                                            <h4 class="modal-title"><i class="fa fa-plus"></i> Add Technical Test</h4>
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        </div>

                                        <form action="{{url("/job/add-application-progress/".$job->job_id)}}" method="post" enctype="multipart/form-data">
                                        {{csrf_field()}}
                                        <!-- Modal body -->
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label for="">Application Progress</label>
                                                    <div class="row m-b-10">
                                                        <div class="col-md-8">
                                                            <input type="text" name="progress_name" placeholder="Progress Name" class="form-control" required>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <input type="number" name="sequence" placeholder="Sequence" class="form-control" required>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="">Attachment</label>
                                                    <input type="file" name="attachment" placeholder="Attachment" class="form-control" required>
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
                        @endif
                    </div>
                </div>
                <div class="ibox-body">
                    @if(count($progress))
                        @foreach($progress as $prog)
                            <div class="row m-b-5">
                                <div class="col-md-2">
                                    {{$prog->sequence}}.
                                </div>
                                <div class="col-md-6">
                                    {{$prog->progress_name}}
                                </div>
                                <div class="col-md-4">
                                    @if(Auth::user()->role_id == "ROLE001")
                                        <div class="modal fade" id="appProgressAttchModal{{$prog->application_progress_id}}">
                                            <div class="modal-dialog">
                                                <div class="modal-content">

                                                    <!-- Modal Header -->
                                                    <div class="modal-header">
                                                        <h4 class="modal-title"><i class="fa fa-plus"></i> Upload Attachment for {{$prog->progress_name}}</h4>
                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                    </div>

                                                    <form action="{{url("/job/upload-progress-document/".$prog->application_progress_id)}}" method="post" enctype="multipart/form-data">
                                                    {{csrf_field()}}
                                                    <!-- Modal body -->
                                                        <div class="modal-body">
                                                            <div class="form-group">
                                                                <label for="">Attachment</label>
                                                                <input type="file" name="attachment" placeholder="Attachment" class="form-control" required>
                                                            </div>
                                                            <div class="m-t-15">
                                                                <i><span style="color:red">*</span>If any, the existing file will be replaced with the new one.</i>
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
                                        @if($prog->document_url != null || $prog->document_url != "")
                                            <a href="{{$prog->document_url}}" class="btn btn-success btn-xs" download="{{$prog->progress_name}}"><i class="fa fa-download"></i></a>
                                            <a href="#" class="btn btn-info btn-xs" data-toggle="modal" data-target="#appProgressAttchModal{{$prog->application_progress_id}}"><i class="fa fa-upload"></i></a>
                                        @else
                                            <a href="#" class="btn btn-info btn-xs" data-toggle="modal" data-target="#appProgressAttchModal{{$prog->application_progress_id}}"><i class="fa fa-upload"></i></a>
                                            <a href="#" class="btn btn-default btn-xs disabled"><i class="fa fa-download"></i></a>
                                        @endif
                                        <a href="/job/delete-progress/{{$prog->application_progress_id}}" class="btn btn-danger btn-xs"><i class="fa fa-times"></i></a>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            var max_fields      = 4 - parseInt('{{count($skills)}}'); //maximum input boxes allowed
            var wrapper   		= $(".input_fields_wrap"); //Fields wrapper
            var add_button      = $(".add_field_button"); //Add button ID

            var x = 1; //initlal text box count
            $(add_button).click(function(e){ //on add input button click
                e.preventDefault();
                if(x <= max_fields){ //max input box allowed
                    x++; //text box increment
                    $(wrapper).append('<div class="row m-b-15"><div class="col-md-9"><div class="row"><div class="col-md-8"><input type="text" name="skill[]" placeholder="Skill" class="form-control" required></div><div class="col-md-4"><input type="number" name="skillRate[]" placeholder="Rate" min="0" max="100" class="form-control" required></div></div></div><div class="col-md-3"><button class="remove_field btn btn-danger" type="button"><i class="fa fa-trash"></i></button></div></div>'); //add input box
                }
            });

            $(wrapper).on("click",".remove_field", function(e){ //user click on remove text
                e.preventDefault(); $(this).parent().parent().remove(); x--;
            })
        });
    </script>
@endsection