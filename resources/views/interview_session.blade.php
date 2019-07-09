<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width initial-scale=1.0">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Admincast | Interview</title>
        <!-- GLOBAL MAINLY STYLES-->
        <link href="/assets/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet" />
        <link href="/assets/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet" />
        <link href="/assets/vendors/themify-icons/css/themify-icons.css" rel="stylesheet" />
        <!-- PLUGINS STYLES-->
        <link href="/assets/vendors/jvectormap/jquery-jvectormap-2.0.3.css" rel="stylesheet" />
        <link href="/assets/vendors/DataTables/datatables.min.css" rel="stylesheet" />

        <!-- THEME STYLES-->
        <link href="/assets/css/main.min.css" rel="stylesheet" />
        <link href="/assets/css/hover-min.css" rel="stylesheet" />
        <!-- PAGE LEVEL STYLES-->

        <script src="/assets/vendors/jquery/dist/jquery.min.js" type="text/javascript"></script>
        <script src="/assets/vendors/popper.js/dist/umd/popper.min.js" type="text/javascript"></script>
        <script src="/assets/vendors/bootstrap/dist/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="/assets/vendors/metisMenu/dist/metisMenu.min.js" type="text/javascript"></script>
        <script src="/assets/vendors/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
        <!-- PAGE LEVEL PLUGINS-->
        <script src="/assets/vendors/chart.js/dist/Chart.min.js" type="text/javascript"></script>
        <script src="/assets/vendors/jvectormap/jquery-jvectormap-2.0.3.min.js" type="text/javascript"></script>
        <script src="/assets/vendors/jvectormap/jquery-jvectormap-world-mill-en.js" type="text/javascript"></script>
        <script src="/assets/vendors/jvectormap/jquery-jvectormap-us-aea-en.js" type="text/javascript"></script>
        <script src="/assets/vendors/DataTables/datatables.min.js" type="text/javascript"></script>
        <script src="/assets/vendors/qrcodejs/qrcode.min.js" type="text/javascript"></script>
        <script src="/assets/js/scripts/instascan.min.js"></script>

        <!-- CORE SCRIPTS-->
        <script src="/assets/js/app.min.js" type="text/javascript"></script>
        <!-- PAGE LEVEL SCRIPTS-->
    </head>

    <body class="fixed-navbar">
        <div class="page-wrapper">
            <div id="myembed"></div>
        </div>

        <script>
            var clientId = "demo";

            var tag = document.createElement("script");
            tag.src = "https://securecall.videola.io/embed-api/";
            var firstScriptTag = document.getElementsByTagName("script")[0];
            firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

            var embed;
            function onVideolaEmbedAPIReady() {
                embed = new Videola.Embed("myembed", {
                    responsive: 1,
                    embedParams: {
                        clientid: clientId,
                        color: "63b2de"
                    }
                });

                embed
                    .on("error", onEmbedError)
                    .on("requestToSignApiAuthToken", onEmbedRequestToSignApiAuthToken)
                    .on("ready", onEmbedReady)
                    .on("stateChange", onEmbedStateChange);
            }

            function onEmbedError(e) {
                console.error("Received error " + e.error + ".");
            }

            function onEmbedRequestToSignApiAuthToken(e) {
                // The below assumes that you have a server-side signer endpoint at /signer,
                // where you pass e.token in the body of a POST request.

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    type: "POST",
                    url: "/interview/signer",
                    data: {token: e.token},
                    success: function (data) {
                        embed.authorize(data);
                    }
                })
            }

            function onEmbedReady(e) {
                embed.call("demo123", true);
            }

            function onEmbedStateChange(e) {
                if (e.state == "call") {
                    setTimeout(function() {
                        console.log("10 seconds have passed");
                    }, 10000);
                }
            }
        </script>
    </body>
</html>