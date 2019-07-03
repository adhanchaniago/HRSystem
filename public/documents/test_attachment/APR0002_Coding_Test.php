<?php
session_start();
if(!isset($_SESSION["user_role"])){
    header("Location: index.php");
}else{

    ?>
    <!doctype html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Consultation</title>

        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>


    </head>
    <body style="padding: 60px">

    <div class="row">

        <div class="col-md-8">
            <?php //echo $_POST["id_cons"] ?>
            <div id="myembed"></div>
        </div>
        <div class="col-md-4">
            <div class="row">
                <div class="col-sm-8">
                    <h2>Files</h2>
                </div>
                <div class="col-sm-4 text-right">
                    <button id="refresh_files" class="btn btn-secondary" style="margin-top: 10px">Refresh</button>
                </div>
            </div>
            <hr>
            <iframe id="upload_files" src="upload_file.php?id_cons=<?php echo $_POST["id_cons"] ?>" style="height:400px" width="100%" frameborder="0"></iframe>
            <iframe id="buttons_file" src="input_file.php?id_cons=<?php echo $_POST["id_cons"] ?>" style="height:150px" width="100%" frameborder="0"></iframe>
        </div>

    </div>

    <div>
        <form action="invoice.php" method="post" id="invSubmit">
            <label>
                <input type="text" id="appid" name="appid" value="<?php echo $_POST['appid'];?>" hidden>
            </label>
            <button id="goToInvoice" type="submit" hidden>submit</button>
        </form>
    </div>

    <button id="showSummary" type="button" data-toggle="modal" data-target="#summaryModal" hidden>Summary</button>

    <div class="modal fade" id="summaryModal" tabindex="-1" role="dialog" aria-labelledby="summaryModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title" id="summaryModalLabel">Submit summary of this consultation</h6>
                </div>
                <form action="database/consultation_handler.php" method="post">
                    <div class="modal-body form-group">
                        <label for="summary"></label>
                        <textarea class="form-control" name="summary" id="summary" cols="30" rows="10"></textarea>
                    </div>
                    <div class="modal-footer">
                        <input type="text" name="id_cons" value="<?php echo $_POST["id_cons"]; ?>" hidden>
                        <input type="text" name="tgl_konsul" value="<?php echo $_POST["tgl_pengajuan"] ?>" hidden>

                        <button type="submit" name="req" value="input_summary" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        $("#refresh_files").click(function () {
            $('#upload_files').attr('src', $('#upload_files').attr('src'));
        });

        $("#buttons_file").on("load", function () {
            $('#upload_files').attr('src', $('#upload_files').attr('src'));
        });
    </script>
    <script>

        var clientId = "demo";
        var code = <?php echo "\"".$_POST['callcode']."\"" ?>;
        //var dur = <?php //echo $_POST['duration'] ?>;
       // var dur = 300;
        //var countToAlert = (dur-120)*1000;
       // var duration = dur*1000;

        var dur = 10;
        var countToAlert = (dur-2)*1000;
        var duration = dur*1000;
        
        var tag = document.createElement("script");
        tag.src = "https://www.gruveo.com/embed-api/";
        var firstScriptTag = document.getElementsByTagName("script")[0];
        firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

        var embed;
        function onGruveoEmbedAPIReady() {
            embed = new Gruveo.Embed("myembed", {
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
                .on("stateChange", onEmbedStateChange)
                .on("hangup", onHangUp);
        }

        function onEmbedError(e) {
            console.error("Received error " + e.error + ".");
        }

        function onEmbedRequestToSignApiAuthToken(e) {
            // The below assumes that you have a server-side signer endpoint at /signer,
            // where you pass e.token in the body of a POST request.
            fetch('database/signer.php', {
                method: 'POST',
                body: e.token
            })
                .then(function(res) {
                    if (res.status !== 200) {
                        return;
                    }
                    res.text()
                        .then(function(signature) {
                            embed.authorize(signature);
                        });
                });
        }

        function onEmbedReady(e) {
            embed.call(code, true);
        }

        function onHangUp(e){
            var user_role = "<?php echo $_SESSION["user_role"]?>";
            if(user_role==="lawyer"){
                $("#showSummary").click();
            }else{
                $("#goToInvoice").click();
            }
        }

        function onEmbedStateChange(e) {
            if (e.state == "call") {
                setTimeout(function() {
                    alert("This Connection is about to end in 2 minutes");
                }, countToAlert);

                setTimeout(function() {
                    embed.end();
                    var user_role = "<?php echo $_SESSION["user_role"]?>";
                    if(user_role==="lawyer"){
                        $("#showSummary").click();
                    }else{
                        $("#goToInvoice").click();
                    }
                }, duration);
            }
        }

        /*$(document).ready(function(){
         $('#call-btn').click();
         });*/

    </script>

    </body>
    </html>
<?php } ?>