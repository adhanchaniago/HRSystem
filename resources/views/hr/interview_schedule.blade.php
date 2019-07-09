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
                                    <td>{{$interview->interview_date.' '.$interview->interview_time}}</td>
                                    <td>{{$interview->first_name.' '.$interview->last_name}}</td>
                                    <td>{{$interview->job_name}}</td>
                                    <td>{{$interview->interview_type_name}}</td>
                                    <td>
                                        <a href="{{url('/interview/'.$interview->interview_id)}}" class="btn btn-primary btn-xs"><i class="fa fa-eye"></i></a>
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
@endsection