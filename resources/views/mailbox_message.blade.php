@extends('.layout.dashboard_app')
@section('content')


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
                <button class="btn btn-default btn-sm" data-action="reply" data-toggle="tooltip" data-original-title="Reply"><i class="fa fa-reply"></i></button>
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