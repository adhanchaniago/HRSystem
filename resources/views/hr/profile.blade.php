@extends('layout.dashboard_app')
@section('content')
    <div class="page-heading">
        <h1 class="page-title">Profile</h1>
    </div>
    <div class="page-content fade-in-up">
        <div class="row">
            <div class="col-lg-3 col-md-4">
                <div class="ibox">
                    <div class="ibox-body text-center">
                        <div class="m-t-20">
                            <div class="rounded-img-lg" style="background-image: url('@if(Auth::user()->photo_url) {{Auth::user()->photo_url}} @else /assets/img/admin-avatar.png @endif')"></div>
                        </div>
                        <h5 class="font-strong m-b-10 m-t-10">{{Auth::user()->first_name." ".Auth::user()->last_name}}</h5>
                        <div class="m-b-10 text-muted">{{Auth::user()->role}}</div>
                        <div class="profile-social m-b-20">
                            <a href="#" data-toggle="tooltip" data-placement="top" title="{{Auth::user()->email}}"><i class="fa fa-envelope"></i></a>
                            <a href="#" data-toggle="tooltip" data-placement="top" title="{{Auth::user()->phone}}"><i class="fa fa-phone"></i></a>
                            <a href="#" data-toggle="tooltip" data-placement="top" title="{{Auth::user()->birth_place.', '.Auth::user()->birth_date}}"><i class="fa fa-birthday-cake"></i></a>
                            <a href="#" data-toggle="tooltip" data-placement="top" title="{{Auth::user()->degree.', '.Auth::user()->major}}"><i class="fa fa-graduation-cap"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-9 col-md-8">
                <div class="ibox">
                    <div class="ibox-body">
                        @if(Auth::user()->role_id == 'ROLE001')
                            <ul class="nav nav-tabs tabs-line">
                                <li class="nav-item">
                                    <a class="nav-link active" href="#tab-1" data-toggle="tab"><i class="ti-bar-chart"></i> Overview</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#tab-2" data-toggle="tab"><i class="ti-settings"></i> Personal Information</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#tab-3" data-toggle="tab"><i class="ti-file"></i> Document</a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane fade show active" id="tab-1">
                                    <div class="m-t-30">
                                        <h4 class="text-info m-b-20 m-t-20"><i class="fa fa-history"></i> Interview History</h4>
                                        <table class="table table-condensed m-b-30">
                                            <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Applicant Name</th>
                                                <th>Interview Date</th>
                                                <th>Status</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>1</td>
                                                    <td>Mark Ruffalo</td>
                                                    <td>1 April 2019</td>
                                                    <td class="text-success"><i class="fa fa-check"></i> Accepted</td>
                                                </tr>
                                                <tr>
                                                    <td>2</td>
                                                    <td>Robert Downey Jr</td>
                                                    <td>3 April 2019</td>
                                                    <td class="text-info"><i class="fa fa-clock-o"></i> Waiting for Action</td>
                                                </tr>
                                                <tr>
                                                    <td>3</td>
                                                    <td>Deddy Corbuzier</td>
                                                    <td>28 March 2019</td>
                                                    <td class="text-danger"><i class="fa fa-times"></i> Rejected</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div>
                                        <h4 class="text-info m-b-20 m-t-20"><i class="fa fa-briefcase"></i> Work Experience</h4>
                                        <table class="table table-striped table-hover">
                                            <thead>
                                            <tr>
                                                <th>Company Name</th>
                                                <th>Department</th>
                                                <th>Position</th>
                                                <th>Duration</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>PT Alim Jaya Motor</td>
                                                    <td>Human Resource and Development</td>
                                                    <td>Head of Division</td>
                                                    <td>March 2015 - May 2019</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="tab-2">
                                    <form action="{{url('/profile/update-info')}}" method="post" enctype="multipart/form-data">
                                        {{csrf_field()}}

                                        <div class="row">
                                            <div class="col-md-8">
                                                <div class="row">
                                                    <div class="col-sm-6 form-group">
                                                        <label><b>First Name</b></label>
                                                        <input class="form-control" type="text" name="first_name" placeholder="First Name" value="{{Auth::user()->first_name}}" required>
                                                    </div>
                                                    <div class="col-sm-6 form-group">
                                                        <label><b>Last Name</b></label>
                                                        <input class="form-control" type="text" name="last_name" placeholder="Last Name" value="{{Auth::user()->last_name}}" required>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label><b>Email</b></label>
                                                    <input class="form-control" type="email" name="email" placeholder="Email address" value="{{Auth::user()->email}}" required>
                                                </div>
                                                <div class="form-group">
                                                    <label><b>Phone</b></label>
                                                    <input class="form-control" type="text" name="phone" placeholder="Phone Number" value="{{Auth::user()->phone}}">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <div class="square-img" id="preview_photo1" style="background-image: url('/assets/img/image.jpg')"></div>
                                                    <input type="file" class="form-control" name="photo" id="photo1" accept="image/jpeg, image/jpg, image/png">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label><b>Gender</b></label><br>
                                            <label class="ui-radio">
                                                <input type="radio" name="gender" value="Male" @if(Auth::user()->gender == "Male") checked @endif>
                                                <span class="input-span"></span>Male
                                            </label>
                                            <label class="ui-radio">
                                                <input type="radio" name="gender" value="Female" @if(Auth::user()->gender == "Female") checked @endif>
                                                <span class="input-span"></span>Female
                                            </label>
                                        </div>
                                        <div class="form-group">
                                            <label><b>Place and Date of Birth</b></label>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <input class="form-control" type="text" name="pob" placeholder="Place of Birth" value="{{Auth::user()->birth_place}}">
                                                </div>
                                                <div class="col-md-8">
                                                    <input class="form-control" type="date" name="dob" placeholder="Date of Birth" value="{{Auth::user()->birth_date}}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for=""><b>Address</b></label>
                                            <textarea class="form-control" name="address" id="address" cols="40" rows="5">{{Auth::user()->address}}</textarea>
                                        </div>
                                        <div class="m-b-30 m-t-30">
                                            <hr>
                                        </div>
                                        <div class="form-group">
                                            <label><b>New Password</b></label>
                                            <input class="form-control" name="new_password" type="password" placeholder="New Password">
                                        </div>
                                        <div class="form-group">
                                            <label><b>Confirm New Password</b></label>
                                            <input class="form-control" name="confirm_new_password" type="password" placeholder="Confirm New Password">
                                        </div>
                                        <div class="m-b-20 m-t-40">
                                            <hr>
                                        </div>
                                        <div class="form-group text-right">
                                            <button class="btn btn-success" type="submit">Save Changes</button>
                                        </div>
                                    </form>
                                </div>
                                <div class="tab-pane fade" id="tab-3">
                                    <div class="row m-t-30">
                                        <div class="col-md-5">
                                            <form action="{{url('/profile/upload-document')}}" method="post" enctype="multipart/form-data">
                                                {{csrf_field()}}
                                                <div class="form-group">
                                                    <label for="">Document Name<span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" placeholder="Document Name" name="docName" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="">Document Type<span class="text-danger">*</span></label>
                                                    <select name="docType" id="docType" class="form-control" required>
                                                        <option value="">--Select Document Type--</option>
                                                        @foreach($docType as $dType)
                                                            <option value="{{$dType->document_type_id}}">{{$dType->document_type_name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label for="">Upload Documents<span class="text-danger">*</span></label>
                                                    <input type="file" name="docs" class="form-control" accept="application/msword, application/pdf" required>
                                                </div>
                                                <div class="form-group text-right">
                                                    <button class="btn btn-success">Upload</button>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="col-md-7">
                                            <h5 class="text-info">My Documents</h5>

                                            @if(count($documents) > 0)
                                                <div class="row m-t-30 p-10" style="background-color: lightgrey">
                                                    <div class="col-md-5">
                                                        <b>Document Name</b>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <b>Uploaded at</b>
                                                    </div>
                                                    <div class="col-md-3"></div>
                                                </div>
                                                <div class="scroller" data-height="200px">
                                                    @foreach($documents as $doc)
                                                        <div class="row p-10">
                                                            <div class="col-md-5">
                                                                {{$doc->document_name}}
                                                            </div>
                                                            <div class="col-md-4">
                                                                <small>{{TimeSince(strtotime('now')-strtotime($doc->created_at)).' ago'}}</small>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <a href="{{$doc->document_url}}" target="_blank" class="btn btn-info btn-xs"><i class="fa fa-download"></i></a>
                                                                <a href="/profile/delete-document/{{$doc->document_id}}"  class="btn btn-danger btn-xs"><i class="fa fa-trash"></i></a>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            @else
                                                <div class="row p-10" style="background-color: lightgrey">
                                                    <div class="col-md-12 text-center">
                                                        There is no any document yet
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @else
                            <ul class="nav nav-tabs tabs-line">
                                <li class="nav-item">
                                    <a class="nav-link active" href="#tab-1" data-toggle="tab"><i class="ti-settings"></i> Personal Information</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#tab-3" data-toggle="tab"><i class="ti-stats-up"></i> Career Information</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#tab-4" data-toggle="tab"><i class="ti-file"></i> Document</a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane fade show active" id="tab-1">
                                    <form action="{{url('/profile/update-info')}}" method="post" enctype="multipart/form-data">
                                        {{csrf_field()}}

                                        <div class="row">
                                            <div class="col-md-8">
                                                <div class="row">
                                                    <div class="col-sm-12 form-group">
                                                        <label><b>University</b></label>
                                                        <input class="form-control" type="text" name="university" placeholder="University" value="{{Auth::user()->university}}" required>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-sm-6 form-group">
                                                        <label><b>Major</b></label>
                                                        <input class="form-control" type="text" name="major" placeholder="Major" value="{{Auth::user()->major}}" required>
                                                    </div>
                                                    <div class="col-sm-6 form-group">
                                                        <label><b>Degree</b></label>
                                                        <input class="form-control" type="text" name="degree" placeholder="Degree" value="{{Auth::user()->degree}}" required>
                                                    </div>
                                                </div>
                                                <div class="m-b-30 m-t-20">
                                                    <hr>
                                                </div>
                                                <div class="row">
                                                    <div class="col-sm-6 form-group">
                                                        <label><b>First Name</b></label>
                                                        <input class="form-control" type="text" name="first_name" placeholder="First Name" value="{{Auth::user()->first_name}}" required>
                                                    </div>
                                                    <div class="col-sm-6 form-group">
                                                        <label><b>Last Name</b></label>
                                                        <input class="form-control" type="text" name="last_name" placeholder="Last Name" value="{{Auth::user()->last_name}}" required>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label><b>Email</b></label>
                                                    <input class="form-control" type="email" name="email" placeholder="Email address" value="{{Auth::user()->email}}" required>
                                                </div>
                                                <div class="form-group">
                                                    <label><b>Phone</b></label>
                                                    <input class="form-control" type="text" name="phone" placeholder="Phone Number" value="{{Auth::user()->phone}}">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <div class="square-img" id="preview_photo" style="background-image: url('/assets/img/image.jpg')"></div>
                                                    <input type="file" class="form-control" name="photo" id="photo" accept="image/jpeg, image/jpg, image/png">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label><b>Gender</b></label><br>
                                            <label class="ui-radio">
                                                <input type="radio" name="gender" value="Male" @if(Auth::user()->gender == "Male") checked @endif>
                                                <span class="input-span"></span>Male
                                            </label>
                                            <label class="ui-radio">
                                                <input type="radio" name="gender" value="Female" @if(Auth::user()->gender == "Female") checked @endif>
                                                <span class="input-span"></span>Female
                                            </label>
                                        </div>
                                        <div class="form-group">
                                            <label><b>Place and Date of Birth</b></label>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <input class="form-control" type="text" name="pob" placeholder="Place of Birth" value="{{Auth::user()->birth_place}}">
                                                </div>
                                                <div class="col-md-8">
                                                    <input class="form-control" type="date" name="dob" placeholder="Date of Birth" value="{{Auth::user()->birth_date}}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for=""><b>Address</b></label>
                                            <textarea class="form-control" name="address" id="address" cols="40" rows="5">{{Auth::user()->address}}</textarea>
                                        </div>
                                        <div class="m-b-30 m-t-30">
                                            <hr>
                                        </div>
                                        <div class="form-group">
                                            <label><b>New Password</b></label>
                                            <input class="form-control" name="new_password" type="password" placeholder="New Password">
                                        </div>
                                        <div class="form-group">
                                            <label><b>Confirm New Password</b></label>
                                            <input class="form-control" name="confirm_new_password" type="password" placeholder="Confirm New Password">
                                        </div>
                                        <div class="m-b-20 m-t-40">
                                            <hr>
                                        </div>
                                        <div class="form-group text-right">
                                            <button class="btn btn-success" type="submit">Save Changes</button>
                                        </div>
                                    </form>
                                </div>
                                <div class="tab-pane fade" id="tab-3">
                                    <form action="{{url('/profile/update-career-info')}}" method="post">
                                        {{csrf_field()}}

                                        <div class="form-group">
                                            <label for=""><b>Education History</b></label>
                                            <div class="education_wrapper">
                                                @if(count($educations) > 0)
                                                    @php($ed_idx = 0)
                                                    @foreach($educations as $edu)
                                                        @if($ed_idx == 0)
                                                            <div class="row m-b-15">
                                                                <div class="col-md-11">
                                                                    <div class="row">
                                                                        <div class="col-md-6">
                                                                            <input type="text" name="education[]" placeholder="Education" value="{{$edu->education_name}}" class="form-control" required>
                                                                        </div>
                                                                        <div class="col-md-3">
                                                                            <input type="date" name="edPeriodStart[]" placeholder="Start" value="{{$edu->period_start}}" class="form-control" required>
                                                                        </div>
                                                                        <div class="col-md-3">
                                                                            <input type="date" name="edPeriodEnd[]" placeholder="End" value="{{$edu->period_end}}" class="form-control" required>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-1">
                                                                    <button class="add_field_education btn btn-primary" type="button"><i class="fa fa-plus"></i></button>
                                                                </div>
                                                            </div>
                                                        @else
                                                            <div class="row m-b-15">
                                                                <div class="col-md-11">
                                                                    <div class="row">
                                                                        <div class="col-md-6">
                                                                            <input type="text" name="education[]" placeholder="Education" value="{{$edu->education_name}}" class="form-control" required>
                                                                        </div>
                                                                        <div class="col-md-3">
                                                                            <input type="date" name="edPeriodStart[]" placeholder="Start" value="{{$edu->period_start}}" class="form-control" required>
                                                                        </div>
                                                                        <div class="col-md-3">
                                                                            <input type="date" name="edPeriodEnd[]" placeholder="End" value="{{$edu->period_end}}" class="form-control" required>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-1">
                                                                    <button class="remove_field btn btn-danger" type="button"><i class="fa fa-trash"></i></button>
                                                                </div>
                                                            </div>
                                                        @endif
                                                        @php($ed_idx++)
                                                    @endforeach
                                                @else
                                                    <div class="row m-b-15">
                                                        <div class="col-md-11">
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <input type="text" name="education[]" placeholder="Education" class="form-control" required>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <input type="date" name="edPeriodStart[]" placeholder="Start" class="form-control" required>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <input type="date" name="edPeriodEnd[]" placeholder="End" class="form-control" required>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-1">
                                                            <button class="add_field_education btn btn-primary" type="button"><i class="fa fa-plus"></i></button>
                                                        </div>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for=""><b>Experience History</b></label>
                                            <div class="experience_wrapper">
                                                @if(count($experiences) > 0)
                                                    @php($exp_idx = 0)
                                                    @foreach($experiences as $exp)
                                                        @if($exp_idx == 0)
                                                            <div class="row m-b-15">
                                                                <div class="col-md-11">
                                                                    <div class="row">
                                                                        <div class="col-md-6">
                                                                            <input type="text" name="experience[]" placeholder="Experience" value="{{$exp->experience_name}}" class="form-control" required>
                                                                        </div>
                                                                        <div class="col-md-3">
                                                                            <input type="date" name="exPeriodStart[]" placeholder="Start" value="{{$exp->period_start}}" class="form-control" required>
                                                                        </div>
                                                                        <div class="col-md-3">
                                                                            <input type="date" name="exPeriodEnd[]" placeholder="End" value="{{$exp->period_end}}" class="form-control" required>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-1">
                                                                    <button class="add_field_experience btn btn-primary" type="button"><i class="fa fa-plus"></i></button>
                                                                </div>
                                                            </div>
                                                        @else
                                                            <div class="row m-b-15">
                                                                <div class="col-md-11">
                                                                    <div class="row">
                                                                        <div class="col-md-6">
                                                                            <input type="text" name="experience[]" placeholder="Experience" value="{{$exp->experience_name}}" class="form-control" required>
                                                                        </div>
                                                                        <div class="col-md-3">
                                                                            <input type="date" name="exPeriodStart[]" placeholder="Start" value="{{$exp->period_start}}" class="form-control" required>
                                                                        </div>
                                                                        <div class="col-md-3">
                                                                            <input type="date" name="exPeriodEnd[]" placeholder="End" value="{{$exp->period_end}}" class="form-control" required>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-1">
                                                                    <button class="remove_field btn btn-danger" type="button"><i class="fa fa-trash"></i></button>
                                                                </div>
                                                            </div>
                                                        @endif
                                                        @php($exp_idx++)
                                                    @endforeach
                                                @else
                                                    <div class="row m-b-15">
                                                        <div class="col-md-11">
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <input type="text" name="experience[]" placeholder="Experience" class="form-control" required>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <input type="date" name="exPeriodStart[]" placeholder="Start" class="form-control" required>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <input type="date" name="exPeriodEnd[]" placeholder="End" class="form-control" required>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-1">
                                                            <button class="add_field_experience btn btn-primary" type="button"><i class="fa fa-plus"></i></button>
                                                        </div>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for=""><b>Skills</b></label>
                                            <div class="skill_wrapper">

                                            @if(count($skills) > 0)
                                                @php($sk_idx=0)
                                                @foreach($skills as $idx=>$skill)
                                                    @if($sk_idx == 0)
                                                        <div class="row m-b-15">
                                                            <div class="col-md-11">
                                                                <div class="row">
                                                                    <div class="col-md-8">
                                                                        <input type="text" name="skill[]" placeholder="Skill" value="{{$skill->skill_name}}" class="form-control" required>
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <input type="number" name="skillRate[]" placeholder="Rate" min="0" max="100" value="{{$skill->rate}}" class="form-control" required>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <button class="add_field_skills btn btn-primary" type="button"><i class="fa fa-plus"></i></button>
                                                            </div>
                                                        </div>
                                                    @else
                                                        <div class="row m-b-15">
                                                            <div class="col-md-11">
                                                                <div class="row">
                                                                    <div class="col-md-8">
                                                                        <input type="text" name="skill[]" placeholder="Skill" value="{{$skill->skill_name}}" class="form-control" required>
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <input type="number" name="skillRate[]" placeholder="Rate" min="0" max="100" value="{{$skill->rate}}" class="form-control" required>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <button class="remove_field btn btn-danger" type="button"><i class="fa fa-trash"></i></button>
                                                            </div>
                                                        </div>
                                                    @endif
                                                    @php($sk_idx++)
                                                @endforeach
                                            @else
                                                <div class="row m-b-15">
                                                    <div class="col-md-11">
                                                        <div class="row">
                                                            <div class="col-md-8">
                                                                <input type="text" name="skill[]" placeholder="Skill" class="form-control" required>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <input type="number" name="skillRate[]" placeholder="Rate" min="0" max="100" class="form-control" required>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-1">
                                                        <button class="add_field_skills btn btn-primary" type="button"><i class="fa fa-plus"></i></button>
                                                    </div>
                                                </div>
                                            @endif

                                            </div>
                                        </div>
                                        <div class="m-b-20 m-t-40">
                                            <hr>
                                        </div>
                                        <div class="form-group text-right">
                                            <button class="btn btn-success" type="submit">Save Changes</button>
                                        </div>
                                    </form>
                                </div>
                                <div class="tab-pane fade" id="tab-4">
                                    <div class="row m-t-30">
                                        <div class="col-md-5">
                                            <form action="{{url('/profile/upload-document')}}" method="post" enctype="multipart/form-data">
                                                {{csrf_field()}}
                                                <div class="form-group">
                                                    <label for="">Document Name<span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" placeholder="Document Name" name="docName" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="">Document Type<span class="text-danger">*</span></label>
                                                    <select name="docType" id="docType" class="form-control" required>
                                                        <option value="">--Select Document Type--</option>
                                                        @foreach($docType as $dType)
                                                            <option value="{{$dType->document_type_id}}">{{$dType->document_type_name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label for="">Upload Documents<span class="text-danger">*</span></label>
                                                    <input type="file" name="docs" class="form-control" accept="application/msword, application/pdf" required>
                                                </div>
                                                <div class="form-group text-right">
                                                    <button class="btn btn-success">Upload</button>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="col-md-7">
                                            <h5 class="text-info">My Documents</h5>

                                            @if(count($documents) > 0)
                                                <div class="row m-t-30 p-10" style="background-color: lightgrey">
                                                    <div class="col-md-5">
                                                        <b>Document Name</b>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <b>Uploaded at</b>
                                                    </div>
                                                    <div class="col-md-3"></div>
                                                </div>
                                                <div class="scroller" data-height="200px">
                                                    @foreach($documents as $doc)
                                                        <div class="row p-10">
                                                            <div class="col-md-5">
                                                                {{$doc->document_name}}
                                                            </div>
                                                            <div class="col-md-4">
                                                                <small>{{TimeSince(strtotime('now')-strtotime($doc->created_at)).' ago'}}</small>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <a href="{{$doc->document_url}}" target="_blank" class="btn btn-info btn-xs"><i class="fa fa-download"></i></a>
                                                                <a href="/profile/delete-document/{{$doc->document_id}}"  class="btn btn-danger btn-xs"><i class="fa fa-trash"></i></a>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            @else
                                                <div class="row p-10" style="background-color: lightgrey">
                                                    <div class="col-md-12 text-center">
                                                        There is no any document yet
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .profile-social a {
            font-size: 16px;
            margin: 0 10px;
            color: #999;
        }

        .profile-social a:hover {
            color: #485b6f;
        }

        .profile-stat-count {
            font-size: 22px
        }
    </style>
    <script>
        $(document).ready(function() {
            AddField("{{count($skills)}}",".add_field_skills", ".skill_wrapper", '<div class="row m-b-15"><div class="col-md-11"><div class="row"><div class="col-md-8"><input type="text" name="skill[]" placeholder="Skill" class="form-control" required></div><div class="col-md-4"><input type="number" name="skillRate[]" placeholder="Rate" min="0" max="100" class="form-control" required></div></div></div><div class="col-md-1"><button class="remove_field btn btn-danger"><i class="fa fa-trash"></i></button></div></div>');
            AddField("{{count($experiences)}}", ".add_field_experience", ".experience_wrapper", '<div class="row m-b-15"><div class="col-md-11"><div class="row"><div class="col-md-6"><input type="text" name="experience[]" placeholder="Experience" class="form-control" required></div><div class="col-md-3"><input type="date" name="exPeriodStart[]" placeholder="Start" class="form-control" required></div><div class="col-md-3"><input type="date" name="exPeriodEnd[]" placeholder="End" class="form-control" required></div></div></div><div class="col-md-1"><button class="remove_field btn btn-danger"><i class="fa fa-trash"></i></button></div></div>');
            AddField("{{count($educations)}}", ".add_field_education", ".education_wrapper", '<div class="row m-b-15"><div class="col-md-11"><div class="row"><div class="col-md-6"><input type="text" name="education[]" placeholder="Education" class="form-control" required></div><div class="col-md-3"><input type="date" name="edPeriodStart[]" placeholder="Start" class="form-control" required></div><div class="col-md-3"><input type="date" name="edPeriodEnd[]" placeholder="End" class="form-control" required></div></div></div><div class="col-md-1"><button class="remove_field btn btn-danger"><i class="fa fa-trash"></i></button></div></div>');
        });

        function AddField(current, addButton, wrapperClass, elAppend){
            var max_fields      = 4; //maximum input boxes allowed
            var wrapper   		= $(wrapperClass); //Fields wrapper
            var add_button      = $(addButton); //Add button ID

            var x = 0;
            var curr = parseInt(current);
            if(curr === 0){
                x = 1;
            }else{
                x = curr;
            }
            //var x = 1; //initlal text box count
            $(add_button).click(function(e){ //on add input button click
                e.preventDefault();
                if(x < max_fields){ //max input box allowed
                    x++; //text box increment
                    $(wrapper).append(elAppend); //add input box
                }
            });

            $(wrapper).on("click",".remove_field", function(e){ //user click on remove text
                e.preventDefault(); $(this).parent().parent().remove(); x--;
            })
        }
    </script>

    <script>
        function readURL(input, previewPhoto) {

            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $(previewPhoto).css('background-image', 'url('+e.target.result +')');
                    //attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

        $("#photo").change(function() {
            readURL("#photo", "#preview_photo");
        });

        $("#photo1").change(function() {
            readURL("#photo1", "#preview_photo1");
        });
    </script>
@endsection