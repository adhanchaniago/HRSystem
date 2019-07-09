@extends('layout.dashboard_app')
@section('content')

    <div class="page-content fade-in-up">
        <div class="row">
            @foreach($members as $member)
                <div class="col-md-6">
                    <div class="ibox">
                        <div class="ibox-body">
                            <div class="text-center">
                                <div class="m-20">
                                    @if($member->photo_url != null || $member->photo_url != "")
                                        <div class="rounded-img-xl" style="background-image: url('{{$member->photo_url}}')"></div>
                                    @else
                                        <div class="rounded-img-xl" style="background-image: url('/assets/img/admin-avatar.png')"></div>
                                    @endif
                                </div>
                                <h3><b>{{$member->first_name." ".$member->last_name}}</b></h3>
                                <h5>{{$member->degree.', '.$member->major}}</h5>
                                <h5 class="text-info">{{$member->university}}</h5>
                            </div>
                            <div class="row m-20">
                                <div class="col-md-6 text-center">
                                    <h6 class="text-muted"><i class="fa fa-envelope"></i>  {{$member->email}}</h6>
                                    <h6 class="text-muted"><i class="fa fa-phone"></i>  {{$member->phone}}</h6>
                                </div>
                                <div class="col-md-6 text-center">
                                    <h6 class="text-muted"><i class="fa fa-birthday-cake"></i>  {{$member->birth_place.', '.$member->birth_date}}</h6>
                                    <h6 class="text-muted"><i class="fa fa-user"></i> {{$member->gender}}</h6>
                                </div>
                            </div>

                            <div class="m-b-50 m-t-50">
                                <h5 class="text-primary"><i class="fa fa-refresh"></i> Education Background</h5>
                                <hr>
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Education Background</th>
                                            <th>Start</th>
                                            <th>End</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($educations as $edu)
                                            @if($edu->user_id == $member->user_id)
                                                <tr>
                                                    <td>{{$edu->education_name}}</td>
                                                    <td>{{$edu->period_start}}</td>
                                                    <td>{{$edu->period_end}}</td>
                                                </tr>
                                            @endif
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                            <div class="m-b-50 m-t-50">
                                <h5 class="text-primary"><i class="fa fa-briefcase"></i> Work Experience</h5>
                                <hr>
                                <table class="table table-striped">
                                    <thead>
                                    <tr>
                                        <th>Experience Name</th>
                                        <th>Start</th>
                                        <th>End</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($experiences as $exp)
                                            @if($exp->user_id == $member->user_id)
                                                <tr>
                                                    <td>{{$exp->experience_name}}</td>
                                                    <td>{{$exp->period_start}}</td>
                                                    <td>{{$exp->period_end}}</td>
                                                </tr>
                                            @endif
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                            <div class="m-b-50 m-t-50">
                                <h5 class="text-primary"><i class="fa fa-bar-chart"></i> Skills</h5>
                                <hr>
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Skill</th>
                                            <th>Rate</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($skills as $skill)
                                        @if($skill->user_id == $member->user_id)
                                            <tr>
                                                <td>{{$skill->skill_name}}</td>
                                                <td>{{$skill->rate}}</td>
                                            </tr>
                                        @endif
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>

                            <div class="modal fade" id="composeMessage{{$member->user_id}}">
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
                            <div class="text-center">
                                <button class="btn btn-primary" data-toggle="modal" data-target="#composeMessage{{$member->user_id}}"><i class="fa fa-envelope"></i> Send Message</button>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

    </div>

@endsection