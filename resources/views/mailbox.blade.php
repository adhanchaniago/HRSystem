@extends('.layout.dashboard_app')
@section('content')

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
                <a class="btn btn-info btn-block" href="mail_compose.html"><i class="fa fa-edit"></i> Compose</a><br>
                <h6 class="m-t-10 m-b-10">FOLDERS</h6>
                <ul class="list-group list-group-divider inbox-list">
                    <li class="list-group-item">
                        <a href="javascript:;"><i class="fa fa-inbox"></i> Inbox ({{count($mails)}})
                            <span class="badge badge-warning badge-square pull-right">17</span>
                        </a>
                    </li>
                    <li class="list-group-item">
                        <a href="javascript:;"><i class="fa fa-envelope-o"></i> Sent</a>
                    </li>
                    <li class="list-group-item">
                        <a href="javascript:;"><i class="fa fa-star-o"></i> Important
                            <span class="badge badge-success badge-square pull-right">2</span>
                        </a>
                    </li>
                    <li class="list-group-item">
                        <a href="javascript:;"><i class="fa fa-file-text-o"></i> Drafts</a>
                    </li>
                    <li class="list-group-item">
                        <a href="javascript:;"><i class="fa fa-trash-o"></i> Trash</a>
                    </li>
                </ul>
            </div>
            <div class="col-lg-9 col-md-8">
                <div class="ibox p-20" id="mailbox-container">
                    <div class="mailbox-header">
                        <div class="d-flex justify-content-between">
                            <h5 class="d-none d-lg-block inbox-title"><i class="fa fa-envelope-o m-r-5"></i> Inbox ({{count($mails)}})</h5>
                        </div>
                        <div class="d-flex justify-content-between inbox-toolbar p-t-20">
                            <div class="d-flex">
                                <label class="ui-checkbox ui-checkbox-info check-single p-t-5 m-r-20">
                                    <input type="checkbox" data-select="all">
                                    <span class="input-span"></span>
                                </label>
                                <div id="inbox-actions">
                                    <button class="btn btn-default btn-sm" data-toggle="tooltip" data-original-title="Mark as read"><i class="fa fa-eye"></i></button>
                                    <button class="btn btn-default btn-sm" data-toggle="tooltip" data-original-title="Reply"><i class="fa fa-reply"></i></button>
                                    <button class="btn btn-default btn-sm" data-toggle="tooltip" data-original-title="Delete"><i class="fa fa-trash-o"></i></button>
                                </div>
                                <span class="counter-selected m-l-5" hidden="">Selected
                                        <span class="font-strong text-warning counter-count">3</span>
                                    </span>
                            </div>
                        </div>
                    </div>
                    <div class="mailbox clf">
                        <table class="table table-hover table-inbox" id="table-inbox">
                            <tbody class="rowlinkx" data-link="row">
                            @if(count($mails) > 0)
                                @foreach($mails as $mail)
                                    <tr data-id="1">
                                        <td class="check-cell rowlink-skip">
                                            <label class="ui-checkbox ui-checkbox-info check-single">
                                                <input class="mail-check" type="checkbox">
                                                <span class="input-span"></span>
                                            </label>
                                        </td>
                                        <td>
                                            <a href="{{url('/mail/'.$mail->message_id)}}">{{$mail->from}}</a>
                                        </td>
                                        <td class="mail-message">{{$mail->subject}}</td>
                                        <td class="hidden-xs"></td>
                                        <td class="mail-label hidden-xs"><i class="fa fa-circle text-success"></i></td>
                                        <td class="text-right">{{$mail->created_at}}</td>
                                    </tr>
                                @endforeach
                            @else
                                <tr style="background-color: lightgrey" class="text-center">
                                    <td colspan="6">Your mailbox is empty</td>
                                </tr>
                            @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection