@extends('.layout.dashboard_app')
@section('content')
    <div class="page-content fade-in-up">
        <div class="ibox">
            <div class="ibox-body">
                <form class="form-inline" action="#">
                    <select class="form-control mb-2 mr-sm-2 mb-sm-0" name="joblist" id="joblist">
                        <option value="job1">Jobs 1</option>
                        <option value="job2">Jobs 2</option>
                        <option value="job3">Jobs 3</option>
                        <option value="job4">Jobs 4</option>
                    </select>
                    <input class="form-control mb-2 mr-sm-2 mb-sm-0" id="ex-email" type="text" placeholder="Email address">
                    <input class="form-control mb-2 mr-sm-2 mb-sm-0" id="ex-pass" type="password" placeholder="Password">
                    <button class="btn btn-success" type="button">Apply Filter</button>
                </form>
            </div>
        </div>
        <div class="row">
            <div class="col-md-9">
                <div class="card-deck">
                    <div class="card">
                        <img class="card-img-top" src="/assets/img/image.png" />
                        <div class="card-body">
                            <h5 class="card-title">Lola</h5>
                            <div class="text-muted card-subtitle">Director</div>
                            <div>Some quick example text to build on the card title and make up the bulk of the card's content.</div>
                        </div>
                        <div class="card-footer">
                            <a class="text-info"><i class="fa fa-star"></i> Follow</a>
                            <span class="pull-right text-muted font-13">Jan 2</span>
                        </div>
                    </div>
                    <div class="card">
                        <img class="card-img-top" src="/assets/img/image.png" />
                        <div class="card-body">
                            <h5 class="card-title">Jack</h5>
                            <div class="text-muted card-subtitle">SEO</div>
                            <div>Some quick example text to build on the card title and make up the bulk of the card's content.</div>
                        </div>
                        <div class="card-footer">
                            <a class="text-info"><i class="fa fa-star"></i> Follow</a>
                            <span class="pull-right text-muted font-13">Dec 4</span>
                        </div>
                    </div>
                    <div class="card">
                        <img class="card-img-top" src="/assets/img/image.png" />
                        <div class="card-body">
                            <h4 class="card-title">Jane</h4>
                            <div class="text-muted card-subtitle">Designer</div>
                            <div>Some quick example text to build on the card title and make up the bulk of the card's content.</div>
                        </div>
                        <div class="card-footer">
                            <a class="text-info"><i class="fa fa-star"></i> Follow</a>
                            <span class="pull-right text-muted font-13">Jan 7</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection