<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Talent Finder</title>
        <link rel="stylesheet" href="/assets/css/style.css">
        <link href="/assets/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet" />
        <link href="/assets/css/animate.css" rel="stylesheet" />
        <link href="/assets/css/main.min.css" rel="stylesheet" />

        <script src="/assets/vendors/jquery/dist/jquery.min.js" type="text/javascript"></script>
        <script src="/assets/vendors/popper.js/dist/umd/popper.min.js" type="text/javascript"></script>
        <script src="/assets/vendors/bootstrap/dist/js/bootstrap.min.js" type="text/javascript"></script>
        <style>
            .image-rotate{
                -webkit-animation:spin 4s linear infinite;
                -moz-animation:spin 4s linear infinite;
                animation:spin 4s linear infinite;
            }
            @-moz-keyframes spin { 100% { -moz-transform: rotate(360deg); } }
            @-webkit-keyframes spin { 100% { -webkit-transform: rotate(360deg); } }
            @keyframes spin { 100% { -webkit-transform: rotate(360deg); transform:rotate(360deg); } }

            .landing{
                position: absolute;
                color: white;
                z-index: 100;
            }
            .landing-home{
                top:25%;
                left:32%;
            }
            .landing-career{
                top:15%;
                left:10%;
                right:10%;
                color: black;
            }
            .tab-item{
                display: none !important;
            }
            .active{
                display: block !important;
            }

            .box-transparent-scroll{
                overflow:auto;
                height:450px;
                padding: 20px;
            }

            .job-item{
                background-color: rgba(134, 202, 253,0.3);
                color: white;
                border-radius: 10px;
                height: 80px;
            }
            .p-t-15{
                padding-top: 15px;
            }
            .p-t-23{
                padding-top: 23px;
            }
            .p-t-24{
                padding-top: 24px;
            }
            .p-t-25{
                padding-top: 25px;
            }
            .p-t-26{
                padding-top: 26px;
            }
            .p-t-27{
                padding-top: 27px;
            }

        </style>
    </head>
    <body>

        <nav class="navbar fixed-top navbar-expand-lg navbar-dark scrolling-navbar">
            <a class="navbar-brand" href="/"><strong><img src="/assets/img/tfinder-lg.png" width="60px" alt=""></strong></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="#tab-1" >Solutions</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#tab-2">Product</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#tab-3">About Us</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#tab-4">Contact Us</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#tab-5">Career</a>
                    </li>
                </ul>
            </div>
        </nav>

        <div class="tab-list">
            <div class="tab-item active" id="tab-0">
                <div class="landing landing-home">
                    {{--<img src="/assets/img/tfinder.png" alt="">--}}
                    <div class="animated fadeInDown">
                        <h1 style="font-size: 68pt">
                            <img class="image-rotate" src="/assets/img/tfinder-lg.png" width="60px" alt=""><br>
                            Talent <span style="color: lime">Finder</span></h1>
                    </div>
                </div>
            </div>
            <div class="tab-item" id="tab-1">
                <div class="landing landing-career">
                    <div class="animated">

                    </div>
                </div>
            </div>
            <div class="tab-item" id="tab-2">
                <div class="landing landing-career">
                    <div class="animated">

                    </div>
                </div>
            </div>
            <div class="tab-item" id="tab-3">
                <div class="landing landing-career">
                    <div class="animated">

                    </div>
                </div>
            </div>
            <div class="tab-item" id="tab-4">
                <div class="landing landing-career">
                    <div class="animated">

                    </div>
                </div>
            </div>
            <div class="tab-item" id="tab-5">
                <div class="landing landing-career">
                    <div class="box-transparent-scroll animated">
                        @if(count($jobs)>0)
                            @foreach($jobs as $job)
                                <div class="row" style="padding: 10px">
                                    <div class="col-md-12 job-item">
                                        <div class="row">
                                            <div class="col-md-3 text-center p-t-27">
                                                {{$job->job_name}}
                                            </div>
                                            <div class="col-md-4 p-t-15">
                                                {{$job->description}}
                                            </div>
                                            <div class="col-md-3 p-t-27">
                                                @foreach($jobSkills as $js)
                                                    @if($js->job_id == $job->job_id)
                                                        {{ucfirst($js->skill_name).', '}}
                                                    @endif
                                                @endforeach
                                            </div>
                                            <div class="col-md-2 text-center p-t-24">
                                                <a href="{{url('/register')}}" class="btn btn-primary">Apply Now</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>

        {{--particle JS for background--}}
        <div id="particles-js"></div>
        <script type="text/javascript" src="/assets/vendors/particlejs/particles.js"></script>
        <script type="text/javascript" src="/assets/vendors/particlejs/app.js"></script>
        <script>
            $(".nav-link").click(function () {

                $(".nav-item").each(function () {
                    $(this).removeClass("active");
                });
                $(this).parent().addClass("active");

                var targetTab = $(this).attr('href');
                var currTab = "";
                var entranceAnimation = "fadeInLeft";
                var exitAnimation = "fadeOutDown";

                $(".tab-item").each(function () {
                    if($(this).hasClass("active")){
                        currTab = "#"+$(this).attr("id");
                    }
                });

                $(currTab+">div>div").removeClass(entranceAnimation);
                $(currTab+">div>div").addClass(exitAnimation);
                $(targetTab+">div>div").addClass(entranceAnimation)
                $(targetTab+">div>div").removeClass(exitAnimation)
                setTimeout(function () {
                    $(currTab).removeClass("active");
                    $(targetTab).addClass("active")
                }, 500);
            });
        </script>
    </body>
</html>