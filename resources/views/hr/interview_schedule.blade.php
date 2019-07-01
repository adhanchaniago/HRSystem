@extends('.layout.dashboard_app')
@section('content')
    <div class="page-content fade-in-up">
        <div class="ibox">
            <div class="ibox-head">
                <div class="ibox-title">My Interview Schedule</div>
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
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Interview Date</th>
                            @if(Auth::user()->role_id == 'ROLE001')
                                <th>Applicant Name</th>
                            @else
                                <th>Interviewer Name</th>
                            @endif
                            <th>Applied Job</th>
                            <th>Interview Method</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(count($interviews) > 0)
                            @foreach($interviews as $idx=>$interview)
                                <tr>
                                    <td>{{$idx+1}}</td>
                                    <td>{{$interview->interview_datetime}}</td>
                                    <td>{{$interview->first_name.' '.$interview->last_name}}</td>
                                    <td>{{$interview->job_name}}</td>
                                    <td>{{$interview->interview_type_name}}</td>
                                    <td>
                                        <a href="{{url('/interview/'.$interview->interview_id)}}" class="btn btn-primary btn-xs"><i class="fa fa-eye"></i></a>
                                        <button class="btn btn-danger btn-xs"><i class="fa fa-times"></i></button>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="6" class="text-center">Interview schedule is empty</td>
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