<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Print Test Report</title>

    <link href="/assets/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet" />
    <script src="/assets/vendors/jquery/dist/jquery.min.js" type="text/javascript"></script>
    <script src="/assets/vendors/popper.js/dist/umd/popper.min.js" type="text/javascript"></script>
    <script src="/assets/vendors/bootstrap/dist/js/bootstrap.min.js" type="text/javascript"></script>

    <style>
        body {
            background: rgb(204,204,204);
        }
        page {
            background: white;
            display: block;
            margin: 0 auto;
            margin-bottom: 0.5cm;
            box-shadow: 0 0 0.5cm rgba(0,0,0,0.5);
        }
        page[size="A4"] {
            width: 21cm;
            height: 29.7cm;
        }
        page[size="A4"][layout="landscape"] {
            width: 29.7cm;
            height: 21cm;
        }
        page[size="A3"] {
            width: 29.7cm;
            height: 42cm;
        }
        page[size="A3"][layout="landscape"] {
            width: 42cm;
            height: 29.7cm;
        }
        page[size="A5"] {
            width: 14.8cm;
            height: 21cm;
        }
        page[size="A5"][layout="landscape"] {
            width: 21cm;
            height: 14.8cm;
        }
        @media print {
            body, page {
                margin: 0;
                box-shadow: 0;
            }
        }
        .center {
            display: block;
            margin-left: auto;
            margin-right: auto;
        }
    </style>
</head>
<body>
<page size="A4">
    <div style="padding:1cm;">
        <div class="text-center">
            <img src="/assets/img/tfinder.png" alt="logo" width="140px" class="center">
            <h4>Applicant Test Report</h4>
        </div>
        <hr style="border: solid 1px black;">
        <div style="padding:15px">
            <div class="row">
                <div class="col-md-6">
                    <table>
                        <tr>
                            <td><b>Job</b></td>
                            <td>:</td>
                            <td>{{$tech->job_name}} ({{$tech->department_name}})</td>
                        </tr>
                        <tr>
                            <td><b>Applicant Name</b></td>
                            <td>:</td>
                            <td>{{$tech->first_name.' '.$tech->last_name}}</td>
                        </tr>
                        <tr>
                            <td><b>Email</b></td>
                            <td>:</td>
                            <td>{{$tech->email}}</td>
                        </tr>
                        <tr>
                            <td><b>Phone</b></td>
                            <td>:</td>
                            <td>{{$tech->phone}}</td>
                        </tr>
                    </table>
                </div>
                <div class="col-md-6 text-right">

                    <small>Printed by <b>{{Auth::user()->first_name.' '.Auth::user()->last_name}}</b><br>{{date('l, d F Y', strtotime(now('Asia/Jakarta')))}}</small>
                </div>
            </div>
            <div style="margin-top: 20px">
                <table class="table">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Technical Test</th>
                            <th class="text-center">Score</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($progress as $idx=>$prog)
                            <tr>
                                <td>{{$idx+1}}</td>
                                <td>{{$prog->progress_name}}</td>
                                @php($id = 'score_'.$prog->sequence)
                                <td class="text-center">{{ $tech->{$id} }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        @if($reportType == "technical-test")
                            <tr>
                                <th></th>
                                <th class="text-right">Average Technical Test Score</th>
                                <th class="text-center">{{$tech->average_score}}</th>
                            </tr>
                            @if($tech->status == "rejected")
                                <tr>
                                    <td></td>
                                    <th class="text-right">Status</th>
                                    <th class="text-danger text-center">{{strtoupper($tech->status)}}</th>
                                </tr>
                            @endif
                        @elseif($reportType == "interview")
                            <tr>
                                <th></th>
                                <th class="text-right">Average Technical Test Score</th>
                                <th class="text-center">{{$tech->average_score}}</th>
                            </tr>
                            <tr>
                                <td></td>
                                <th class="text-right">Interview Score</th>
                                <th class="text-center">{{$tech->interview_score}}</th>
                            </tr>
                            @if($tech->status == "rejected")
                                <tr>
                                    <td></td>
                                    <th class="text-right">Status</th>
                                    <th class="text-danger text-center">{{strtoupper($tech->status)}}</th>
                                </tr>
                            @endif
                        @elseif($reportType == "final")
                            <tr>
                                <th></th>
                                <th class="text-right">Average Technical Test Score</th>
                                <th class="text-center">{{$tech->average_score}}</th>
                            </tr>
                            <tr>
                                <td></td>
                                <th class="text-right">Interview Score</th>
                                <th class="text-center">{{$tech->interview_score}}</th>
                            </tr>
                            <tr>
                                <td></td>
                                <th class="text-right">Status</th>
                                @if($tech->status == "accepted")
                                    <th class="text-success text-center">{{strtoupper($tech->status)}}</th>
                                @else
                                    <th class="text-danger text-center">{{strtoupper($tech->status)}}</th>
                                @endif
                            </tr>
                        @endif
                    </tfoot>
                </table>
            </div>
            @if(Auth::user()->role_id == "ROLE001")
                <div style="margin-top: 50px">
                    <div class="row">
                        <div class="col-md-8"></div>
                        <div class="col-md-4">
                            Jakarta, {{date('d F Y',strtotime(now('Asia/Jakarta')))}}
                            <br>
                            <br>
                            <br>
                            <br>
                            <br>
                            <br>
                            (........................................)
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</page>
</body>
</html>