@extends('.layout.dashboard_app')
@section('content')
    <style>
        .clickable-row{
            cursor: pointer;
        }
        .clickable-row:hover{
            background-color: darkgrey !important;
        }
    </style>
    
    <div class="page-heading">
        <h1 class="page-title">Mailbox</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="index.html"><i class="la la-home font-20"></i></a>
            </li>
        </ol>
    </div>
    <div class="page-content fade-in-up">
        <div class="row">
            <div class="col-lg-3 col-md-4">
                <button class="btn btn-info btn-block" data-toggle="modal" data-target="#composeMessage"><i class="fa fa-edit"></i> Compose</button><br>
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
                                        <input type="text" name="to" placeholder="Receiver" class="form-control" required>
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

                <h6 class="m-t-10 m-b-10">FOLDERS</h6>
                <ul class="list-group list-group-divider inbox-list">
                    <li class="list-group-item">
                        <a href="#tab-1" data-toggle="tab"><i class="fa fa-inbox"></i> Inbox @if(count($mail_not_read) > 0)({{count($mail_not_read)}})@endif
                        </a>
                    </li>
                    <li class="list-group-item">
                        <a href="#tab-2" data-toggle="tab"><i class="fa fa-paper-plane"></i> Sent</a>
                    </li>
                    <li class="list-group-item">
                        <a href="#tab-3" data-toggle="tab"><i class="fa fa-star-o"></i> Important
                        </a>
                    </li>
                    <li class="list-group-item">
                        <a href="#tab-4" data-toggle="tab"><i class="fa fa-trash-o"></i> Trash</a>
                    </li>
                </ul>
            </div>
            <div class="col-lg-9 col-md-8 tab-content">
                <div class="tab-pane fade show active" id="tab-1">
                    <div class="ibox p-20" id="mailbox-container">
                        <div class="mailbox-header">
                            <div class="d-flex justify-content-between">
                                <h5 class="d-none d-lg-block inbox-title"><i class="fa fa-envelope-o m-r-5"></i> Inbox @if(count($mail_not_read) > 0)({{count($mail_not_read)}})@endif</h5>
                            </div>
                            <div class="d-flex justify-content-between inbox-toolbar p-10">
                                <div class="d-flex">
                                    <div id="inbox-actions">
                                        <button class="btn btn-default btn-sm" data-toggle="tooltip" data-original-title="Mark all as read"><i class="fa fa-eye"></i></button>
                                        <button class="btn btn-default btn-sm" data-toggle="tooltip" data-original-title="Move all to trash"><i class="fa fa-trash-o"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="mailbox clf">
                            <table class="table table-hover table-inbox" id="table-inbox">
                                <tbody class="rowlinkx" data-link="row">
                                @if(count($inboxes) > 0)
                                    @php($counter = 0)
                                    @foreach($inboxes as $idx => $inbox)
                                        @if($inbox->status != "read")
                                            <tr data-id="{{$idx+1}}" class="clickable-row" data-href="/mailbox/{{$inbox->message_id}}" style="background-color: lightgrey">
                                        @else
                                            <tr data-id="{{$idx+1}}" class="clickable-row" data-href="/mailbox/{{$inbox->message_id}}" style="background-color: whitesmoke">
                                                @endif
                                                <td>
                                                    @if($inbox->status != "read")
                                                        <i class="fa fa-envelope"></i>
                                                    @else
                                                        <i class="fa fa-envelope-open"></i>
                                                    @endif
                                                </td>
                                                <td>{{$inbox->first_name.' '.$inbox->last_name}}</td>
                                                <td class="mail-message">{{$inbox->subject}}</td>
                                                <td class="hidden-xs"></td>
                                                <td class="mail-label hidden-xs"></td>
                                                <td class="text-right">{{$inbox->created_at}}</td>
                                            </tr>
                                            @php($counter++)
                                            @endforeach
                                            @if($counter==0)
                                                <tr style="background-color: lightgrey" class="text-center">
                                                    <td colspan="5">Your mailbox is empty</td>
                                                </tr>
                                            @endif
                                            @else
                                                <tr style="background-color: lightgrey" class="text-center">
                                                    <td colspan="5">Your mailbox is empty</td>
                                                </tr>
                                            @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                {{--SENT MAIL--}}
                <div class="tab-pane fade" id="tab-2">
                    <div class="ibox p-20" id="mailbox-container">
                        <div class="mailbox-header">
                            <div class="d-flex justify-content-between">
                                <h5 class="d-none d-lg-block inbox-title"><i class="fa fa-envelope-o m-r-5"></i> Sent</h5>
                            </div>
                            <div class="d-flex justify-content-between inbox-toolbar p-10">
                                <div class="d-flex">
                                    <div id="inbox-actions">
                                        <button class="btn btn-default btn-sm" data-toggle="tooltip" data-original-title="Move all to trash"><i class="fa fa-trash-o"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="mailbox clf">
                            <table class="table table-hover table-inbox" id="table-inbox">
                                <tbody class="rowlinkx" data-link="row">
                                @if(count($sents) > 0)
                                    @php($counter = 0)
                                    @foreach($sents as $idx => $sent)
                                        <tr data-id="{{$idx+1}}" class="clickable-row" data-href="/mailbox/{{$sent->message_id}}" style="background-color: whitesmoke">
                                            <td>
                                                <i class="fa fa-envelope-open"></i>
                                            </td>
                                            <td>{{$sent->to}}</td>
                                            <td class="mail-message">{{$sent->subject}}</td>
                                            <td class="hidden-xs"></td>
                                            <td class="mail-label hidden-xs"></td>
                                            <td class="text-right">{{$sent->created_at}}</td>
                                        </tr>
                                        @php($counter++)
                                    @endforeach
                                    @if($counter==0)
                                        <tr style="background-color: lightgrey" class="text-center">
                                            <td colspan="5">Your sent mail is empty</td>
                                        </tr>
                                    @endif
                                @else
                                    <tr style="background-color: lightgrey" class="text-center">
                                        <td colspan="5">Your sent mail is empty</td>
                                    </tr>
                                @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                {{--END SENT MAIL--}}

            </div>
        </div>
    </div>
    <script>
        jQuery(document).ready(function($) {

            $(".clickable-row").click(function() {
                window.location = $(this).data("href");
            });
        });
    </script>
@endsection