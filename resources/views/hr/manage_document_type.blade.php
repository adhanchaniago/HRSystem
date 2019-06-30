@extends('.layout.dashboard_app')
@section('content')
    <div class="page-content fade-in-up">
        <div class="row m-25">
            <div class="col-md-6 text-left">
                <h2>Document Type</h2>
            </div>
            <div class="col-md-6 text-right">
                <button class="btn btn-success"  data-toggle="modal" data-target="#addDeptModal"><i class="fa fa-plus"></i> Add New Document Type</button>
                <div class="modal fade" id="addDeptModal">
                    <div class="modal-dialog">
                        <div class="modal-content">

                            <!-- Modal Header -->
                            <div class="modal-header">
                                <h4 class="modal-title"><i class="fa fa-plus"></i> Add New Document Type</h4>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>

                            <form action="{{url("/document/add-new-document-type")}}" method="post">
                            {{csrf_field()}}

                            <!-- Modal body -->
                                <div class="modal-body">
                                    <div class="form-group">
                                        <input type="text" name="document_type_name" placeholder="Input Document Type Name" class="form-control" required>
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
            </div>
        </div>
        <div class="row">
            @foreach($docTypes as $docType)
                <div class="col-md-4">
                    <div class="ibox">
                        <div class="ibox-body">
                            <div class="row">
                                <div class="col-md-10">
                                    <h4 class="p-t-15 p-l-15">{{$docType->document_type_name}}</h4>
                                </div>
                                <div class="col-md-2">
                                    <div>
                                        <button class="btn btn-secondary btn-xs" data-toggle="tooltip" data-placement="right" title="Edit"><i class="fa fa-pencil"></i></button>
                                    </div>
                                    <div>
                                        <button class="btn btn-danger btn-xs" data-toggle="tooltip" data-placement="right" title="Delete"><i class="fa fa-times"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection