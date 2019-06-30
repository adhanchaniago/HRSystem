@extends('layout.dashboard_app')
@section('content')

    <div class="page-content fade-in-up">
        <div class="m-25">
            <div class="text-left">
                <h2>Recruiter Documents</h2>
            </div>
        </div>
        @if(count($docs) > 0)
            <div class="row">
                @foreach($docs as $doc)
                    <div class="col-md-3">
                        <a href="{{$doc->document_url}}" target="_blank" style="text-decoration: none; color: inherit;">
                            <div class="ibox">
                                <div class="ibox-body">
                                    <div class="text-center">
                                        <div class="m-20">
                                            <i class="fa fa-file-o fa-5x"></i>
                                            <h5 class="m-t-10"><b>{{$doc->document_name}}</b></h5>
                                            <h6 class="text-muted">Uploaded by {{$doc->first_name.' '.$doc->last_name}}</h6>
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
                <h3>There is no document by Recruiter yet</h3>
            </div>
        @endif
    </div>

@endsection