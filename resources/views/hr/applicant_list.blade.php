@extends('layout.dashboard_app')
@section('content')

    <div class="page-content fade-in-up">
        <div class="m-25">
            <div class="row">
                <div class="col-md-6 text-left">
                    <h3>{{$job_detail->job_name}}'s Applicants</h3>
                </div>
                <div class="col-md-6">
                    <div class="text-right">
                        <button class="btn btn-primary" data-toggle="modal" data-target="#compareSelect"><i class="fa fa-exchange"></i> Compare Applicant</button>
                    </div>
                    <div class="modal fade" id="compareSelect">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <!-- Modal Header -->
                                <div class="modal-header">
                                    <h4 class="modal-title"><i class="fa fa-exchange"></i> Compare Applicant</h4>
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                </div>
                                <!-- Modal body -->
                                <form action="{{url('/applicant/compare/'.$job_detail->job_id)}}" method="post">
                                    {{csrf_field()}}
                                    <div class="modal-body">
                                        <table class="table table-striped toDataTable">
                                            <thead>
                                                <tr>
                                                    <th>Applicant Name</th>
                                                    <th>Last Education</th>
                                                    <th>Instance Name</th>
                                                    <th>Major</th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($allapplicants as $all)
                                                <tr>
                                                    <td>{{$all->first_name.' '.$all->last_name}}</td>
                                                    <td>{{$all->degree}}</td>
                                                    <td>{{$all->university}}</td>
                                                    <td>{{$all->major}}</td>
                                                    <td>
                                                        <div class="form-group">
                                                            <label class="ui-checkbox">
                                                                <input type="checkbox" name="compare[]" value="{{$all->applicant_id}}" class="form-control">
                                                                <span class="input-span"></span>
                                                            </label>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                            </tbody>

                                        </table>
                                    </div>
                                    <!-- Modal footer -->
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button class="btn btn-primary" type="submit">Compare</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-3 p-l-15 p-r-15">
                <div>
                    <h5 class="text-muted"><b><i class="fa fa-clock-o"></i> Waiting for Action</b></h5>
                    <hr>
                </div>
                @if(count($applicants) > 0)
                        @foreach($applicants as $app)
                            <div class="row">
                                <div class="col-md-12">
                                    <a href="{{url('/applicant/'.$app->applicant_id)}}" style="text-decoration: none; color: inherit;">
                                        <div class="ibox hvr-grow-shadow" style="width: 100%">
                                            <div class="ibox-body">
                                                <div class="row">
                                                    <div class="col-md-3">
                                                        <div class="rounded-img-md" style="background-image: url('@if(isset($app->photo_url)) {{$app->photo_url}} @else /assets/img/admin-avatar.png @endif')"></div>
                                                    </div>
                                                    <div class="col-md-9">
                                                        <h6><b>{{$app->first_name." ".$app->last_name}}</b></h6>
                                                        <small>{{$app->degree.', '.$app->major}}</small>
                                                        <br>
                                                        <small class="text-info">{{$app->university}}</small>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        @endforeach
                @else
                    <div class="text-center">
                        <p>There is no one reach this step yet</p>
                    </div>
                @endif
            </div>

            <div class="col-md-3 p-l-15 p-r-15">
                <div>
                    <h5 class="text-info"><b><i class="fa fa-clipboard"></i> Technical Test</b></h5>
                    <hr>
                </div>
                @if(count($technical_test) > 0)
                    @foreach($technical_test as $tech)
                        <div class="row">
                            <div class="col-md-12">
                                <a href="{{url('/technical-test/'.$tech->technical_test_id)}}" style="text-decoration: none; color: inherit;">
                                    <div class="ibox hvr-grow-shadow" style="width: 100%">
                                        <div class="ibox-body">
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <div class="rounded-img-md" style="background-image: url('@if(isset($tech->photo_url)) {{$tech->photo_url}} @else /assets/img/admin-avatar.png @endif')"></div>
                                                </div>
                                                <div class="col-md-9">
                                                    <h6><b>{{$tech->first_name." ".$tech->last_name}}</b></h6>
                                                    <small>{{$tech->degree.', '.$tech->major}}</small>
                                                    <br>
                                                    <small class="text-info">{{$tech->university}}</small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="text-center">
                        <p>There is no one reach this step yet</p>
                    </div>
                @endif
            </div>

            <div class="col-md-3 p-l-15 p-r-15">
                <div>
                    <h5 class="text-warning"><b><i class="fa fa-users"></i> Interview</b></h5>
                    <hr>
                </div>
                @if(count($interviews) > 0)
                    @foreach($interviews as $intv)
                        <div class="row">
                            <div class="col-md-12">
                                <a href="{{url('/interview/'.$intv->interview_id)}}" style="text-decoration: none; color: inherit;">
                                    <div class="ibox hvr-grow-shadow" style="width: 100%">
                                        <div class="ibox-body">
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <div class="rounded-img-md" style="background-image: url('@if(isset($app->photo_url)) {{$app->photo_url}} @else /assets/img/admin-avatar.png @endif')"></div>
                                                </div>
                                                <div class="col-md-9">
                                                    <h6><b>{{$intv->first_name." ".$intv->last_name}}</b></h6>
                                                    <small>{{$intv->degree.', '.$intv->major}}</small>
                                                    <br>
                                                    <small class="text-info">{{$intv->university}}</small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="text-center">
                        <p>There is no one reach this step yet</p>
                    </div>
                @endif
            </div>

            <div class="col-md-3 p-l-15 p-r-15">
                <div>
                    <h5 class="text-success"><b><i class="fa fa-check-square-o"></i> Final Result</b></h5>
                    <hr>
                </div>
                @if(count($finals) > 0)
                    @foreach($finals as $fin)
                        <div class="row">
                            <div class="col-md-12">
                                <a href="{{url('/interview/'.$fin->interview_id)}}" style="text-decoration: none; color: inherit;">
                                    <div class="ibox hvr-grow-shadow" style="width: 100%">
                                        <div class="ibox-body">
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <div class="rounded-img-md" style="background-image: url('@if(isset($app->photo_url)) {{$app->photo_url}} @else /assets/img/admin-avatar.png @endif')"></div>
                                                </div>
                                                <div class="col-md-9">
                                                    <h6><b>{{$fin->first_name." ".$fin->last_name}}</b></h6>
                                                    <small>{{$fin->degree.', '.$fin->major}}</small>
                                                    <br>
                                                    <small class="text-info">{{$fin->university}}</small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="text-center">
                        <p>There is no one reach this step yet</p>
                    </div>
                @endif
            </div>
        </div>


    </div>
    <script>
        $(".toDataTable").DataTable();
    </script>
@endsection