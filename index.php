<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>USSD Simulator</title>
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u"
              crossorigin="anonymous">
        <!-- Optional theme -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp"
              crossorigin="anonymous">
    </head>
    <body>
        <div class="container">
            <div class='panel panel-primary'>
                <div class="panel-heading">
                    <h1>USSD Simulator</h1>
                </div>
                <div class="panel-body">
                    <div class='container'>
                        <div class="row">
                            <div class="col-md-12">
                                <form class="inline-form" role="form" id="ussd-form" method='GET' action=''>
                                    <fieldset>
                                        <div id="status-div" class="info info-warning"></div>
                                        <legend>USSD Simulator</legend>
                                        <div class="form-group">
                                            <label class="" for="MSISDN">My Phone Number:</label>
                                            <input type="phone" name="MSISDN" id="MSISDN" placeholder="MSISDN" class="form-control" value="2348064620491" required />
                                        </div>
                                        <div class="form-group">
                                            <input type="hidden" name="serviceCode" id="serviceCode" placeholder="serviceCode" class="form-control"
                                                   value="7sfs7f6s4g6s4g6s4fg6s4gsd5" />
                                        </div>
                                        <div class="form-group">
                                            <label class="">Enter Option:</label>
                                            <input name="text" id="text" placeholder="Enter Option" class="form-control" value="" required />
                                        </div>
                                    </fieldset>
                                    <button class="btn btn-danger btn-block" name="runCode" id="runCode">Run Code</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.1.1.min.js" integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8="
        crossorigin="anonymous"></script>
        <!-- Latest compiled and minified JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa"
        crossorigin="anonymous"></script>
        <script>
            $(document).ready(function () {
                getRequest({});
                let ussdVal = '';
                // if ($('#text').val() !== "" || ussdVal !== "") {
                if (ussdVal !== "") {
                    ussdVal = $('#text').val() + "*";
                    $('#text').val() = '';
                            alert(ussdVal);
                }
                $('#runCode').click(function (e) {
                    e.preventDefault();
                    $('#status-div').text('Sending...');
                    let messageData = $('#ussd-form').serialize();
                    getRequest(messageData);
                });
            });
            function getRequest(messageData, endPoint = 'http://127.0.0.1/nairaplus/') {
                $.ajax({
                    type: 'GET',
                    url: endPoint,
                    data: messageData,
                    success: function (responseData, textStatus, jqXHR) {
                        // $('#text').val() = "";
                        console.log(responseData);
                        $('#status-div').text(responseData);
                    },
                    error: function (responseData, textStatus, errorThrown) {
                        //$('#text').val() = "";
                        console.log(responseData);
                        var resp = JSON.parse(responseData);
                        $('#status-div').html(resp);
                        alert('POST failed.');
                    }
                });
            }
        </script>
    </body>
</html>