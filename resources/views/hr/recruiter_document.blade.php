@extends('layout.dashboard_app')
@section('content')
    <div class="page-heading">
        <h1 class="page-title">All Recuiter Documents</h1>
    </div>
    <div class="page-content fade-in-up">
        <div class="ibox">
            <div class="ibox-body">
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
                        @if(count($docs) > 0)
                            @foreach($docs as $doc)
                                <tr>
                                    <td><i class="fa fa-file-o"></i> {{$doc->document_name}}</td>
                                    <td>{{$doc->document_type_name}}</td>
                                    <td>{{$doc->first_name.' '.$doc->last_name}}</td>
                                    <td>{{$doc->created_at}}</td>
                                    <td class="text-center">
                                        <a href="{{$doc->document_url}}" class="btn btn-info btn-xs" target="_blank"><i class="fa fa-download"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="5" class="text-center">There is no document by applicant yet</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script>
        $(function() {
            $('#applicantDocument').DataTable();
        })
    </script>
@endsection