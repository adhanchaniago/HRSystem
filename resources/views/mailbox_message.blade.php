@extends('.layout.dashboard_app')
@section('content')

    <div class="modal fade" id="replyMessage">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title"><i class="fa fa-mail"></i> Reply Message</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                @php($user = \App\User::find($message->from))
                <form action="{{url("/mailbox/new-message")}}" method="post">
                {{csrf_field()}}
                <!-- Modal body -->
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="">To</label>
                            <input type="text" name="to" value="{{$user->email}}" class="form-control" hidden>
                            <input type="text" placeholder="Receiver" value="{{$user->email}}" class="form-control" readonly>
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

    <div class="ibox p-20" id="mailbox-container">
        <div class="m-b-20">
            <a href="{{url('/mailbox')}}"><i class="fa fa-arrow-left"></i>&nbsp;All Mail</a>
        </div>
        <div class="mailbox-header d-flex justify-content-between" style="border-bottom: 1px solid #e8e8e8;">
            <div>
                <h3 class="inbox-title">@if($message->is_important == "yes")<span class="text-warning"><i class="fa fa-star"></i></span> &nbsp;&nbsp;@endif{{$message->subject}}</h3>
                <div class="m-t-5 font-13">
                    <span class="font-strong">{{$message->first_name.' '.$message->last_name}}</span>
                </div>
                <div class="p-r-10 font-13">{{$message->created_at}}</div>
            </div>
            <div class="inbox-toolbar m-l-20">
                <button class="btn btn-default btn-sm" data-toggle="modal" data-target="#replyMessage"><i class="fa fa-reply"></i></button>
                <button class="btn btn-default btn-sm" data-toggle="tooltip" data-original-title="Delete"><i class="fa fa-trash-o"></i></button>
                <button class="btn btn-default btn-sm" data-toggle="tooltip" data-original-title="Mark as important"><i class="fa fa-star-o"></i></button>
            </div>
        </div>
        <div class="mailbox-body">
            <div class="m-t-15">
                <textarea name="body" id="body" style="width: 100%; border: none; max-height: 240px;min-height: 240px;" readonly="readonly">{{$message->body}}</textarea>
            </div>
        </div>
    </div>

@endsection