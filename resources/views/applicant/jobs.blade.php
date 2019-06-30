@extends('layout.dashboard_app')
@section('content')
    <style>
        textarea{
            resize: none;
        }
    </style>
    <div class="page-content fade-in-up">
        <div class="m-b-10">
            <h3>Filters</h3>
        </div>
        <div>
            <form class="form-inline">
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Job Name" name="filter_job_name">
                </div>
                <div class="form-group m-l-10">
                    <select name="filter_department" id="filter_department" class="form-control">
                        <option value="">Filter by Department</option>
                        <option value="DPT0001">IT</option>
                    </select>
                </div>
                <div class="form-group m-l-10">
                    <input type="number" placeholder="Minimum Salary" class="form-control">
                </div>
                <div class="form-group m-l-10">
                    <button class="btn btn-primary">Apply Filters</button>
                </div>
            </form>
        </div>
        <hr>
        @if($validate_profile == false)
            <div class="alert alert-danger">
                <i class="fa fa-warning"></i> Please complete your profile about your experience, education, and skill to start applying job.
            </div>
        @endif
        <div class="row">
            @foreach($jobs as $job)
                <!-- The Modal -->
                    @if($validate_profile != false)
                        <div class="modal fade" id="applyModal{{$job->job_id}}">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">

                                    <!-- Modal Header -->
                                    <div class="modal-header">
                                        <h4 class="modal-title"><i class="fa fa-clipboard"></i> Apply Confirmation</h4>
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    </div>

                                    <form action="{{url("/job/apply-job")}}" method="post">
                                    {{csrf_field()}}

                                    <!-- Modal body -->
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <label for="">Do you know about this job from one of our employees?</label><br>
                                                <label class="ui-radio">
                                                    <input type="radio" name="know_job" value="Yes" onchange="SetReferral('offerJob{{$job->job_id}}','modalFooter{{$job->job_id}}','recruiter_id{{$job->job_id}}', this.value)">
                                                    <span class="input-span"></span>Yes
                                                </label>
                                                <label class="ui-radio">
                                                    <input type="radio" name="know_job" value="No" onchange="SetReferral('offerJob{{$job->job_id}}','modalFooter{{$job->job_id}}', 'recruiter_id{{$job->job_id}}', this.value)">
                                                    <span class="input-span"></span>No
                                                </label>
                                            </div>
                                            <div class="form-group hidden" id="offerJob{{$job->job_id}}">
                                                <label for="">Who offered you this job?</label>
                                                <select name="recruiter_id" id="recruiter_id{{$job->job_id}}" class="form-control" onchange="ShowHideFooter(this.id, 'modalFooter{{$job->job_id}}')">
                                                    <option value="">Select Employee</option>
                                                    @foreach($recruiter as $rec)
                                                        <option value="{{$rec->user_id}}">{{$rec->first_name." ".$rec->last_name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <input class="hidden" type="text" name="job_id" value="{{$job->job_id}}">
                                        </div>
                                        <!-- Modal footer -->
                                        <div class="modal-footer hidden" id="modalFooter{{$job->job_id}}">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                            <button type="submit" class="btn btn-success">Apply Now</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endif
                <div class="col-md-6">
                    <div class="ibox">
                        <div class="ibox-body">
                            <div class="row">
                                <div class="col-md-2 text-right">
                                    <span class="text-muted"><i class="fa fa-briefcase fa-3x"></i></span>
                                </div>
                                <div class="col-md-9">
                                    <h3>{{$job->job_name}}</h3>
                                    <h5 class="text-muted">{{$job->department_name}}</h5>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <small class="text-muted"><i class="fa fa-clock-o"></i> <i>Posted {{TimeSince(time() - strtotime($job->active_date))}} ago</i></small>
                                        </div>
                                        <div class="col-md-6">
                                            <small class="text-danger"><i class="fa fa-clock-o"></i> <i>Expired in {{TimeSince(strtotime($job->expired_date) - time())}}</i></small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="m-b-15">
                                <div class="row">
                                    <div class="col-md-6">
                                        <h6 class="text-primary"><b><i class="fa fa-check"></i> Required Skill</b></h6>
                                        <div class="m-l-20">
                                            @php($skills = \App\JobSkill::all()->where('job_id', '=', $job->job_id))
                                            <ul>
                                                @foreach($skills as $index=>$skill)
                                                    <li>
                                                        {{$skill->skill_name}}
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="text-success">
                                            <h6><b><i class="fa fa-dollar"></i> Salary</b></h6>
                                            <div class="m-l-20 ">
                                                Rp {{number_format($job->salary)}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="m-b-5">
                                <h6 class="text-primary"><b><i class="fa fa-check"></i> Job Description</b></h6>
                                <div class="m-l-20">
                                    <textarea class="border-0" cols="70" rows="5" wrap="hard" readonly="readonly">{{$job->description}}</textarea>
                                </div>
                            </div>
                            @if($validate_profile != false)
                                @if(!CheckAppliedJob(Auth::user()->user_id, $job->job_id))
                                    <div class="text-right">
                                        <button data-toggle="modal" data-target="#applyModal{{$job->job_id}}" class="btn btn-success">Apply Job</button>
                                    </div>
                                @else
                                    <div class="alert alert-info">
                                        <i class="fa fa-check"></i> You have applied for this job
                                    </div>
                                @endif
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

    </div>
@endsection
@section('script')
    <script>

        function SetReferral(offerId, mFooterId, referralId, radioVal){
            if(radioVal==="Yes"){
                $("#"+offerId).removeClass("hidden")
                $("#"+referralId).change();
            }else{
                $("#"+offerId).addClass("hidden")
                $("#"+mFooterId).removeClass("hidden")
            }
        }

        function ShowHideFooter(referralId, mFooter) {
            if($("#"+referralId).val() !== ""){
                $("#"+mFooter).removeClass("hidden")
            }else{
                $("#"+mFooter).addClass("hidden")
            }
        }

//        $("input[type=radio][name='know_job']").change(function(){
//            if($(this).val()==="Yes"){
//                $("#offerJob").removeClass("hidden")
//            }else{
//                $("#offerJob").addClass("hidden")
//                $("#modalFooter").removeClass("hidden")
//            }
//        });
//
//        $("#referal_id").change(function(){
//            if($(this).val() !== ""){
//                $("#modalFooter").removeClass("hidden")
//            }else{
//                $("#modalFooter").addClass("hidden")
//            }
//        });
    </script>
@endsection