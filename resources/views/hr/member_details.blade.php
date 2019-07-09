@extends('.layout.dashboard_app')
@section('content')
    <style>
        textarea{
            resize: none;
        }
    </style>


    <div class="row">
        <div class="col-md-5">
            <div class="ibox">
                <div class="ibox-head">
                    <div class="ibox-title">Member Information</div>
                    <div class="ibox-tools">
                        <a class="ibox-collapse"><i class="fa fa-minus"></i></a>
                        <a class="fullscreen-link"><i class="fa fa-expand"></i></a>
                    </div>
                </div>

                <div class="ibox-body">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="m-t-20">
                                <div class="rounded-img-lg" style="background-image: url('@if($member->photo_url) {{$member->photo_url}} @else /assets/img/admin-avatar.png @endif')"></div>
                            </div>
                        </div>
                        <div class="col-md-9">
                            <div class="m-t-10">
                                <h2>{{$member->first_name.' '.$member->last_name}}</h2>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="m-b-20">
                                        <h6><i class="fa fa-envelope"></i> {{$member->email}}</h6>
                                    </div>
                                    <div class="m-b-20">
                                        <h6><i class="fa fa-phone"></i> {{$member->phone}}</h6>
                                    </div>
                                    <div class="m-b-20">
                                        <h6><i class="fa fa-home"></i> {{$member->address}}</h6>
                                    </div>
                                    <div class="m-b-20">
                                        <h6><i class="fa fa-birthday-cake"></i> {{$member->birth_place.', '.$member->birth_date}}</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade" id="composeMessage">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">

                                <!-- Modal Header -->
                                <div class="modal-header">
                                    <h4 class="modal-title"><i class="fa fa-mail"></i> Compose Message</h4>
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                </div>

                                <form action="{{url("/mailbox/new-message")}}" method="post">
                                {{csrf_field()}}

                                <!-- Modal body -->
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label for="">To</label>
                                            <input type="text" name="to" value="{{$member->email}}" class="form-control" hidden>
                                            <input type="text" placeholder="Receiver" value="{{$member->email}}" class="form-control" readonly>
                                        </div>
                                        <div class="form-group">
                                            <label for="">Subject</label>
                                            <input type="text" name="subject" placeholder="Message Subject" class="form-control" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="">Message Body</label>
                                            <textarea name="body" id="body" cols="40" rows="10" wrap="hard" class="form-control" required></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="">Attachment</label>
                                            <input type="file" name="attachment" class="form-control">
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
                    <div class="m-b-20 text-right">
                        <button class="btn btn-primary" data-toggle="modal" data-target="#composeMessage"><i class="fa fa-envelope"></i> Send Message</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-7">
            <div class="ibox">
                <div class="ibox-head">
                    <div class="ibox-title">Skills Obtained</div>
                </div>
                <div class="ibox-body">
                    @if(count($skills) > 0)
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th>Skill</th>
                                <th>Rate</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($skills as $skill)
                                <tr>
                                    <td>{{$skill->skill_name}}</td>
                                    <td>{{$skill->rate}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    @else
                        <h4 class="text-muted">This applicant has no skills.</h4>
                    @endif
                </div>
            </div>

            <div class="ibox">
                <div class="ibox-head">
                    <div class="ibox-title">Work Experience</div>
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