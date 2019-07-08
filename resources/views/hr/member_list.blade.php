@extends('layout.dashboard_app')
@section('content')
    <div class="page-content fade-in-up">
        <div class="m-25">
            <div class="row">
                <div class="col-md-6 text-left">
                    <h2>All Member List</h2>
                </div>
                <div class="col-md-6 text-right">
                    <button class="btn btn-primary" data-toggle="modal" data-target="#selectMemberModal"><i class="fa fa-exchange"></i> Compare Member</button>
                </div>
            </div>
        </div>

        <div class="modal fade" id="selectMemberModal">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">

                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title"><i class="fa fa-exchange"></i> Compare Member</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <!-- Modal body -->
                    <form action="{{url('/member/compare')}}" method="post">
                        {{csrf_field()}}
                        <div class="modal-body">
                            <table class="table table-striped toDataTable">
                                <thead>
                                    <tr>
                                        <th>Member Name</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($members as $member)
                                        <tr>
                                            <td>{{$member->first_name.' '.$member->last_name}}</td>
                                            <td><input type="checkbox" class="select-member" name="member[]" value="{{$member->user_id}}"></td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- Modal footer -->
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-success">Compare</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        @if(count($members) > 0)
            <div class="row">
                @foreach($members as $app)
                    <div class="col-md-4">
                        <a href="{{url('/member/'.$app->user_id)}}" style="text-decoration: none; color: inherit;">
                            <div class="ibox hvr-grow">
                                <div class="ibox-body">
                                    <div class="row">
                                        <div class="col-md-3">
                                            @if($app->photo_url != null || $app->photo_url != "")
                                                <div class="rounded-img-md" style="background-image: url('{{$app->photo_url}}')"></div>
                                            @else
                                                <div class="rounded-img-md" style="background-image: url('/assets/img/admin-avatar.png')"></div>
                                            @endif
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
                @endforeach
            </div>
        @else
            <div class="text-center">
                <h3>There is no applicant yet</h3>
            </div>
        @endif
    </div>
    <script>
        var limit = 4;
        $('input[class="select-member"]').change(function() {
            if($('input[class="select-member"]:checked').length >= limit+1) {
                this.checked = false;
            }
            console.log($('input[class="select-member"]:checked').length);
            console.log(limit);
        });

        $(".toDataTable").DataTable();
    </script>
@endsection