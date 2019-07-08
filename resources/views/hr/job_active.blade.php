@extends('.layout.dashboard_app')
@section('content')
    <div class="page-content fade-in-up">
        <div class="ibox">
            <div class="ibox-head">
                <div class="ibox-title">Active Jobs</div>
                <div class="text-right">
                    <button class="btn btn-success"  data-toggle="modal" data-target="#postJobModal"><i class="fa fa-plus"></i> Post New Job</button>
                </div>

                <!-- The Modal -->
                <div class="modal fade" id="postJobModal">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">

                            <!-- Modal Header -->
                            <div class="modal-header">
                                <h4 class="modal-title"><i class="fa fa-plus"></i> Post New Job</h4>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>

                            <form action="{{url("/job/add-new-job")}}" method="post">
                                {{csrf_field()}}

                                <!-- Modal body -->
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label for="">Department</label>
                                        <select name="job_department" id="job_department" class="form-control" required>
                                            <option value="">--Select--</option>
                                            @foreach($department as $dept)
                                                <option value="{{$dept->department_id}}">{{$dept->department_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Job Name</label>
                                        <input type="text" name="job_name" placeholder="Input Job Name" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Salary</label>
                                        <input type="number" name="salary" placeholder="Salary" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Job Description</label>
                                        <textarea name="job_desc" id="job_desc" cols="40" rows="5" wrap="hard" class="form-control" required></textarea>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">Minimum Age</label>
                                                <input type="number" name="min_age" placeholder="Minimum Age" class="form-control" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">Minimum Experience</label>
                                                <input type="number" name="min_exp" placeholder="Minimum Experience" class="form-control" required>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="">Priority Skill</label>
                                        <div class="input_fields_wrap">
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
                                                    <button class="add_field_button btn btn-success"><i class="fa fa-plus"></i> Add More</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-lg-6">
                                            <label for="">Active Date</label>
                                            <input type="date" name="active_date" class="form-control" required>
                                        </div>
                                        <div class="form-group col-lg-6">
                                            <label for="">Expired Date</label>
                                            <input type="date" name="expired_date" class="form-control" required>
                                        </div>

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
            </div>
            @if ($errors->any())
                <div class="form-group">
                    <div class="alert alert-danger">
                        {{ $errors->first() }}
                    </div>
                </div>
            @elseif(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            <div class="ibox-body">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Job Position</th>
                                <th>Department</th>
                                <th>Active Date</th>
                                <th>Expired Date</th>
                                <th class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(count($active_jobs) > 0)
                                @foreach($active_jobs as $index => $job)
                                    <tr>
                                        <td>
                                            {{$index+1}}
                                        </td>
                                        <td>{{$job->job_name}}</td>
                                        <td>{{$job->department_name}}</td>
                                        <td>{{$job->active_date}}</td>
                                        <td>{{$job->expired_date}}</td>
                                        <td class="text-center">
                                            <a href="{{url('/job/details/'.$job->job_id)}}" class="btn btn-primary btn-xs m-r-5" data-toggle="tooltip" data-original-title="View Detail"><i class="fa fa-eye font-14"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="6" class="text-center">Job list is empty</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            var max_fields      = 4; //maximum input boxes allowed
            var wrapper   		= $(".input_fields_wrap"); //Fields wrapper
            var add_button      = $(".add_field_button"); //Add button ID

            var x = 1; //initlal text box count
            $(add_button).click(function(e){ //on add input button click
                e.preventDefault();
                if(x < max_fields){ //max input box allowed
                    x++; //text box increment
                    $(wrapper).append('<div class="row m-b-15"><div class="col-md-9"><div class="row"><div class="col-md-8"><input type="text" name="skill[]" placeholder="Skill" class="form-control" required></div><div class="col-md-4"><input type="number" name="skillRate[]" placeholder="Rate" min="0" max="100" class="form-control" required></div></div></div><div class="col-md-3"><button class="remove_field btn btn-danger"><i class="fa fa-times"></i> Remove</button></div></div>'); //add input box
                }
            });

            $(wrapper).on("click",".remove_field", function(e){ //user click on remove text
                e.preventDefault(); $(this).parent().parent().remove(); x--;
            })
        });
    </script>
@endsection