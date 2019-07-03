@extends('.layout.dashboard_app')
@section('content')
    <div class="page-content fade-in-up">
        <div class="ibox">
            <div class="ibox-head">
                <div class="ibox-title">All Technical Test</div>
            </div>
            <div class="ibox-body">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>#</th>
                            @if(Auth::user()->role_id == 'ROLE001')
                                <th>Applicant Name</th>
                            @else
                                <th>Interviewer Name</th>
                            @endif
                            <th>Applied Job</th>
                            <th>Apply Date</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(count($technical) > 0)
                            @foreach($technical as $idx=>$tech)
                                <tr>
                                    <td>{{$idx+1}}</td>
                                    <td>{{$tech->first_name.' '.$tech->last_name}}</td>
                                    <td>{{$tech->job_name}}</td>
                                    <td>{{$tech->applied_date}}</td>
                                    <td>
                                        <a href="{{url('/technical-test/'.$tech->technical_test_id)}}" class="btn btn-primary btn-xs"><i class="fa fa-eye"></i></a>
                                        <button class="btn btn-danger btn-xs"><i class="fa fa-times"></i></button>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="6" class="text-center">Technical Test is empty</td>
                            </tr>
                        @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection