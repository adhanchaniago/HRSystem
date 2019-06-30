@extends('layout.dashboard_app')
@section('content')
    <div class="page-heading">
        <h1 class="page-title">All Applicant Documents</h1>
    </div>
    <div class="page-content fade-in-up">
        <div class="ibox">
            <div class="ibox-body">
                @if(count($docs) > 0)
                <table class="table table-striped table-hover" id="applicantDocument" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>Document Name</th>
                            <th>Type</th>
                            <th>Uploaded By</th>
                            <th>Uploaded At</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($docs as $doc)
                            <tr>
                                <td><i class="fa fa-file-o"></i> {{$doc->document_name}}</td>
                                <td>{{$doc->document_type_id}}</td>
                                <td>{{$doc->first_name.' '.$doc->last_name}}</td>
                                <td>{{$doc->created_at}}</td>
                                <td class="text-center">
                                    <a href="{{$doc->document_url}}" class="btn btn-info btn-xs" target="_blank"><i class="fa fa-download"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                @else
                    <div class="text-center">
                        <h3>There is no document by applicant yet</h3>
                    </div>
                @endif
            </div>
        </div>
    </div>
    <script>
        $(function() {
            $('#applicantDocument').DataTable();
        })
    </script>
@endsection