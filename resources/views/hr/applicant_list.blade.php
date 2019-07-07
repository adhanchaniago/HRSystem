@extends('layout.dashboard_app')
@section('content')
    <style>
        .input-bottom-border{
            width:100%;
            border: 0;
            border-bottom: 1px solid darkgrey;
            outline: 0;
            background-color: transparent;
        }
    </style>
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
        <hr>
        <div class="row">
            <div class="col-md-3 p-l-15 p-r-15">
                <div class="row" id="waitingDefaultDiv">
                    <div class="col-md-9">
                        <h5 class="text-muted"><b><i class="fa fa-clock-o"></i> Waiting for Action</b></h5>
                    </div>
                    <div class="col-md-3">
                        <h5 class="text-muted"><a href="#" id="waitingSearchBtn" onclick="ShowHideSearch(this.id, 'waitingSearchDiv', 'waitingDefaultDiv', null)" style="text-decoration: none; color: inherit"><i class="fa fa-search"></i></a></h5>
                    </div>
                </div>
                <div class="row hidden" id="waitingSearchDiv">
                    <div class="col-md-9">
                        <input id="waitingSearch" class="input-bottom-border" placeholder="Search here...">
                    </div>
                    <div class="col-md-3">
                        <h5 class="text-muted"><a href="#" id="waitingCancelSearchBtn" onclick="ShowHideSearch(this.id, 'waitingDefaultDiv', 'waitingSearchDiv', 'waitingSearch')" style="text-decoration: none; color: inherit"><i class="fa fa-times"></i></a></h5>
                    </div>
                </div>
                <hr>
                <div id="waitingList" style="overflow-y: scroll; height:400px; max-width: 100%; overflow-x: hidden;">
                    @if(count($applicants) > 0)
                        @foreach($applicants as $app)
                            <div class="row">
                                <div class="col-md-12">
                                    <a href="{{url('/applicant/'.$app->applicant_id)}}" style="text-decoration: none; color: inherit;">
                                        <div class="ibox hvr-grow" style="width: 100%">
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
                            </div>
                        @endforeach
                    @else
                        <div class="text-center">
                            <p>There is no one reach this step yet</p>
                        </div>
                    @endif
                </div>
            </div>
            {{--<form action="/search" method="post">--}}
                {{--{{csrf_field()}}--}}
                {{--<input type="text" name="searchQuery">--}}
                {{--<input type="text" name="tableName" value="waitingList">--}}
                {{--<input type="text" name="jobId" value="{{$job_detail->job_id}}">--}}
                {{--<button type="submit">submit</button>--}}
            {{--</form>--}}
            <div class="col-md-3 p-l-15 p-r-15">
                <div class="row" id="technicalDefaultDiv">
                    <div class="col-md-9">
                        <h5 class="text-info"><b><i class="fa fa-clipboard"></i> Technical Test</b></h5>
                    </div>
                    <div class="col-md-3">
                        <h5 class="text-info"><a href="#" id="technicalSearchBtn" onclick="ShowHideSearch(this.id, 'technicalSearchDiv', 'technicalDefaultDiv', null)" style="text-decoration: none; color: inherit"><i class="fa fa-search"></i></a></h5>
                    </div>
                </div>
                <div class="row hidden" id="technicalSearchDiv">
                    <div class="col-md-9">
                        <input id="technicalSearch" class="input-bottom-border" placeholder="Search here...">
                    </div>
                    <div class="col-md-3">
                        <h5 class="text-info"><a href="#" id="technicalCancelSearchBtn" onclick="ShowHideSearch(this.id, 'technicalDefaultDiv', 'technicalSearchDiv', 'technicalSearch')" style="text-decoration: none; color: inherit"><i class="fa fa-times"></i></a></h5>
                    </div>
                </div>
                <hr>
                <div id="technicalList" style="overflow-y: scroll; height:400px; max-width: 100%; overflow-x: hidden;">

                    @if(count($technical_test) > 0)
                        @foreach($technical_test as $tech)
                            <div class="row">
                                <div class="col-md-12">
                                    <a href="{{url('/technical-test/'.$tech->technical_test_id)}}" style="text-decoration: none; color: inherit;">
                                        <div class="ibox hvr-grow" style="width: 100%">
                                            <div class="ibox-body">
                                                <div class="row">
                                                    <div class="col-md-3">
                                                        @if($tech->photo_url != null || $tech->photo_url != "")
                                                            <div class="rounded-img-md" style="background-image: url('{{$tech->photo_url}}')"></div>
                                                        @else
                                                            <div class="rounded-img-md" style="background-image: url('/assets/img/admin-avatar.png')"></div>
                                                        @endif
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
            </div>

            <div class="col-md-3 p-l-15 p-r-15">
                <div class="row" id="interviewDefaultDiv">
                    <div class="col-md-9">
                        <h5 class="text-warning"><b><i class="fa fa-users"></i> interview</b></h5>
                    </div>
                    <div class="col-md-3">
                        <h5 class="text-warning"><a href="#" id="interviewSearchBtn" onclick="ShowHideSearch(this.id, 'interviewSearchDiv', 'interviewDefaultDiv', null)" style="text-decoration: none; color: inherit"><i class="fa fa-search"></i></a></h5>
                    </div>
                </div>
                <div class="row hidden" id="interviewSearchDiv">
                    <div class="col-md-9">
                        <input id="interviewSearch" class="input-bottom-border" placeholder="Search here...">
                    </div>
                    <div class="col-md-3">
                        <h5 class="text-warning"><a href="#" id="interviewCancelSearchBtn" onclick="ShowHideSearch(this.id, 'interviewDefaultDiv', 'interviewSearchDiv', 'interviewSearch')" style="text-decoration: none; color: inherit"><i class="fa fa-times"></i></a></h5>
                    </div>
                </div>
                <hr>
                <div id="interviewList" style="overflow-y: scroll; height:400px; max-width: 100%; overflow-x: hidden;">

                    @if(count($interviews) > 0)
                        @foreach($interviews as $intv)
                            <div class="row">
                                <div class="col-md-12">
                                    <a href="{{url('/interview/'.$intv->interview_id)}}" style="text-decoration: none; color: inherit;">
                                        <div class="ibox hvr-grow" style="width: 100%">
                                            <div class="ibox-body">
                                                <div class="row">
                                                    <div class="col-md-3">
                                                        @if($intv->photo_url != null || $intv->photo_url != "")
                                                            <div class="rounded-img-md" style="background-image: url('{{$intv->photo_url}}')"></div>
                                                        @else
                                                            <div class="rounded-img-md" style="background-image: url('/assets/img/admin-avatar.png')"></div>
                                                        @endif
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
            </div>

            <div class="col-md-3 p-l-15 p-r-15">
                <div class="row" id="finalDefaultDiv">
                    <div class="col-md-9">
                        <h5 class="text-success"><b><i class="fa fa-check-square-o"></i> Final Result</b></h5>
                    </div>
                    <div class="col-md-3">
                        <h5 class="text-success"><a href="#" id="finalSearchBtn" onclick="ShowHideSearch(this.id, 'finalSearchDiv', 'finalDefaultDiv', null)" style="text-decoration: none; color: inherit"><i class="fa fa-search"></i></a></h5>
                    </div>
                </div>
                <div class="row hidden" id="finalSearchDiv">
                    <div class="col-md-9">
                        <input id="finalSearch" class="input-bottom-border" placeholder="Search here...">
                    </div>
                    <div class="col-md-3">
                        <h5 class="text-success"><a href="#" id="finalCancelSearchBtn" onclick="ShowHideSearch(this.id, 'finalDefaultDiv', 'finalSearchDiv', 'finalSearch')" style="text-decoration: none; color: inherit"><i class="fa fa-times"></i></a></h5>
                    </div>
                </div>
                <hr>
                <div id="finalList" style="overflow-y: scroll; height:400px; max-width: 100%; overflow-x: hidden;">
                    @if(count($finals) > 0)
                        @foreach($finals as $fin)
                            <div class="row">
                                <div class="col-md-12">
                                    <a href="{{url('/interview/'.$fin->interview_id)}}" style="text-decoration: none; color: inherit;">
                                        <div class="ibox hvr-grow" style="width: 100%">
                                            <div class="ibox-body">
                                                <div class="row">
                                                    <div class="col-md-3">
                                                        @if($fin->photo_url != null || $fin->photo_url != "")
                                                            <div class="rounded-img-md" style="background-image: url('{{$fin->photo_url}}')"></div>
                                                        @else
                                                            <div class="rounded-img-md" style="background-image: url('/assets/img/admin-avatar.png')"></div>
                                                        @endif
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
    </div>
    <script>
        $(".toDataTable").DataTable();

        $("#waitingSearch").on('change keyup', function(){
            SearchApplicant("waitingSearch", "waitingList");
        });

        $("#technicalSearch").on('change keyup', function(){
            SearchApplicant("technicalSearch", "technicalList");
        });

        $("#interviewSearch").on('change keyup', function(){
            SearchApplicant("interviewSearch", "interviewList");
        });

        $("#finalSearch").on('change keyup', function(){
            SearchApplicant("finalSearch", "finalList");
        });

        function ShowHideSearch(buttonId, divToShow, divToHide, searchField){
            $("#"+buttonId).click(function(){
                $("#"+divToShow).removeClass("hidden");
                $("#"+divToHide).addClass("hidden");
            });

            if(searchField !== null || searchField !== ""){
                $("#"+searchField).val(null);
                $("#"+searchField).change();
            }
        }

        function SearchApplicant(searchField, resultDiv){

            var searchQuery = $("#"+searchField).val();

//            $.post( "/search/"+resultDiv+"/"+searchQuery, function( data ) {
//                //$( ".result" ).html( data );
//                console.log(data);
//            });
//
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: "POST",
                url: "/search",
                data: {searchQuery : searchQuery, tableName  : resultDiv, jobId : "{{$job_detail->job_id}}"},
                success: function (data) {
                    var length = data.length;
                    if(length > 0){
                        var result = "";
                        var defaultPhoto = "/assets/img/admin-avatar.png";
                        for(var i = 0; i<length; i++) {
                            result += '<div class="row">' +
                                '           <div class="col-md-12">' +
                                '               <a href="/'+data[i]["link"]+'/' + data[i]["returnId"] + '" style="text-decoration: none; color: inherit;">' +
                                '                   <div class="ibox hvr-grow" style="width: 100%">' +
                                '                       <div class="ibox-body">' +
                                '                           <div class="row">' +
                                '                               <div class="col-md-3">';

                            if (data[i]["photo_url"] == null || data[i]["photo_url"] == "") {
                                result += '<div class="rounded-img-md" style="background-image: url(\'/assets/img/admin-avatar.png\')"></div>';
                            }else{
                                result += '<div class="rounded-img-md" style="background-image: url('+data[i]["photo_url"]+')"></div>';
                            }

                                result+= '                               </div>'+
                                '                               <div class="col-md-9">'+
                                '                                   <h6><b>'+data[i]["first_name"]+' '+data[i]["last_name"]+'</b></h6>'+
                                '                                   <small>'+data[i]["degree"]+", "+data[i]["major"]+'</small>'+
                                '                                   <br>'+
                                '                                   <small class="text-info">'+data[i]["university"]+'</small>'+
                                '                               </div>'+
                                '                           </div>'+
                                '                       </div>'+
                                '                   </div>'+
                                '               </a>'+
                                '           </div>'+
                                '       </div>';
                        }
                        $("#"+resultDiv).html(result);
                    }else{
                        $("#"+resultDiv).html("<div class='text-center'><p>Applicant not found</p></div>");
                    }
                }
            });

        }

    </script>
@endsection