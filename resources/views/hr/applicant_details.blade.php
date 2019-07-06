@extends('.layout.dashboard_app')
@section('content')
    <style>
        textarea{
            resize: none;
        }
    </style>

    <div class="modal fade" id="proceedConfirm">
        <div class="modal-dialog">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title"><i class="fa fa-check"></i> Proceed Applicant</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <form action="{{url("/applicant/proceed/".$applicant->applicant_id)}}" method="post">
                {{csrf_field()}}
                <!-- Modal body -->
                    <div class="modal-body">
                        Are you sure want to proceed this applicant to next step?
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

                <form action="{{url("/applicant/reject/".$applicant->applicant_id)}}" method="post">
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
                                <div class="rounded-img-lg" style="background-image: url('@if($applicant->photo_url) {{$applicant->photo_url}} @else /assets/img/admin-avatar.png @endif')"></div>
                            </div>
                        </div>
                        <div class="col-md-9">
                            <div class="m-t-10">
                                <h2>{{$applicant->first_name.' '.$applicant->last_name}}</h2>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="m-b-20">
                                        <h6><i class="fa fa-envelope"></i> {{$applicant->email}}</h6>
                                    </div>
                                    <div class="m-b-20">
                                        <h6><i class="fa fa-phone"></i> {{$applicant->phone}}</h6>
                                    </div>
                                    <div class="m-b-20">
                                        <h6><i class="fa fa-home"></i> {{$applicant->address}}</h6>
                                    </div>
                                    <div class="m-b-20">
                                        <h6><i class="fa fa-birthday-cake"></i> {{$applicant->birth_place.', '.$applicant->birth_date}}</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="text-right m-b-10">
                        <button class="btn btn-success" data-toggle="modal" data-target="#proceedConfirm"><i class="fa fa-check"></i> Proceed</button>
                        <button class="btn btn-danger" data-toggle="modal" data-target="#rejectConfirm"><i class="fa fa-times"></i> Reject</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-7">
            <div class="ibox">
                <div class="ibox-head">
                    <div class="ibox-title">Experience</div>
                </div>
                <div class="ibox-body">
                    @if(count($experiences) > 0)
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th>Experience</th>
                                <th>Start</th>
                                <th>End</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach($experiences as $exp)
                                    <tr>
                                        <td>{{$exp->experience_name}}</td>
                                        <td>{{$exp->period_start}}</td>
                                        <td>{{$exp->period_end}}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <h4 class="text-muted">This applicant has no experience.</h4>
                    @endif
                </div>
            </div>

            <div class="ibox">
                <div class="ibox-head">
                    <div class="ibox-title">Education Background</div>
                </div>
                <div class="ibox-body">
                    @if(count($educations) > 0)
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th>Education</th>
                                <th>Start</th>
                                <th>End</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($educations as $edu)
                                <tr>
                                    <td>{{$edu->education_name}}</td>
                                    <td>{{$edu->period_start}}</td>
                                    <td>{{$edu->period_end}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    @else
                        <h4 class="text-muted">This applicant has no education background.</h4>
                    @endif
                </div>
            </div>
        </div>

    </div>



@endsection