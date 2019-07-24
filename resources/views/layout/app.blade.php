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

    <script src="/assets/vendors/jquery/dist/jquery.min.js" type="text/javascript"></script>
    <script src="/assets/vendors/popper.js/dist/umd/popper.min.js" type="text/javascript"></script>
    <script src="/assets/vendors/bootstrap/dist/js/bootstrap.min.js" type="text/javascript"></script>
</head>
<body>
<nav class="navbar fixed-top navbar-expand-lg navbar-dark scrolling-navbar">
    <a class="navbar-brand" href="/"><strong>Talent Finder</strong></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="#tab-1" data-toggle="tab">Solutions <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#tab-2" data-toggle="tab">Product</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#tab-3" data-toggle="tab">About Us</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#tab-4" data-toggle="tab">Contact Us</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#tab-5" data-toggle="tab">Career</a>
            </li>
        </ul>
    </div>
</nav>

@yield('content')

</body>
</html>