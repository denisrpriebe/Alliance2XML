<[extends file="../../layout/app.tpl"]>

<[block name="page-title"]><[Config::application('name')]> : : Dashboard<[/block]>

<[block name="page-script"]>
    <script>

        batchTimer = '<[$settings->batch_countdown]>';

        $(document).ready(function () {

            var allianceInFilesTable = $('#allianceInFilesTable').DataTable({
                "ajax": {
                    "url": '<[Route::to('get-batch-files')]>',
                    "method": "post",
                    "dataSrc": "files",
                    "timeout": 5000,
                    error: function (xhr, status, error) {
                        console.log(">>> Alliance In Fetch Error: " + error);
                        location.reload();
                    }
                },
                "aLengthMenu": [5, 10, 15],
                "order": [0, "asc"],
                "pagingType": "simple",
                "language": {
                    "lengthMenu": "Display _MENU_ files per page",
                    "zeroRecords": "No files found.",
                    "info": "Showing page _PAGE_ of _PAGES_",
                    "infoFiltered": "(filtered from _MAX_ total records)",
                    searchPlaceholder: "..."
                }
            });

            batchRefreshTimer = setInterval(function () {
                allianceInFilesTable.ajax.reload();
            }, 5000);

            var batchHistoryTable = $('#batchHistoryTable').DataTable({
                "ajax": {
                    "url": '<[Route::to('get-batch-history')]>',
                    "method": "post",
                    "dataSrc": "history",
                    "timeout": 5000,
                    error: function (xhr, status, error) {
                        console.log(">>> Batch History Fetch Error: " + error);
                        location.reload();
                    }
                },
                "aLengthMenu": [5, 10, 15],
                "order": [1, "desc"],
                "pagingType": "simple",
                "language": {
                    "lengthMenu": "Display _MENU_ entries per page",
                    "zeroRecords": "No history found.",
                    "info": "Showing page _PAGE_ of _PAGES_",
                    "infoFiltered": "(filtered from _MAX_ total records)",
                    searchPlaceholder: "..."
                }
            });

            batchHistoryRefreshTimer = setInterval(function () {
                batchHistoryTable.ajax.reload();
            }, 5000);


            $('#orderblankHistoryTable').DataTable({
                "aLengthMenu": [5, 10, 15],
                "order": [2, "asc"],
                "pagingType": "simple",
                "language": {
                    "lengthMenu": "Display _MENU_ files per page",
                    "zeroRecords": "No files found.",
                    "info": "Showing page _PAGE_ of _PAGES_",
                    "infoFiltered": "(filtered from _MAX_ total records)",
                    searchPlaceholder: "..."
                }
            });

            // Start the batch timer on page load.
            initTimer();

        });

        /**
         *
         * @returns {undefined}
         */
        function initTimer() {

            $('#timer').timer({
                duration: batchTimer,
                countdown: true,
                callback: function () {
                    run();
                }
            });
            start();
        }

        /**
         *
         * @returns {undefined}
         */
        function start() {
            console.log("Orderblank Server Status: STARTED.");
            $('#status').html('<span class="label label-success">ON</span>');
            $('#timer').timer('resume');
        }

        /**
         *
         * @returns {undefined}
         */
        function stop() {
            console.log("Orderblank Server Status: STOPPED.");
            $('#status').html('<span class="label label-danger">OFF</span>');
            $('#timer').timer('pause');
        }

        function reset() {
            $('#status').html('<span class="label label-success">ON</span>');
            $('#timer').timer('reset');
        }

        /**
         * 
         * @returns {undefined}
         */
        function run() {

            stop();

            console.log(">>> Processing Batch...");

            $('#status').html('<span class="label label-primary">PROCESSING...</span>');

            $.ajax({
                method: 'POST',
                url: '<[Route::to('process-batch')]>',
                timeout: 540000, // 9 min
                dataType: 'json',
                success: function (serverData, status, xhr) {
                    if (serverData.status === 'success') {
                        reset();
                    }
                    if (serverData.status === 'failed') {
                        console.log(serverData.message);
                        reset();
                        stop();
                    }
                },
                error: function (xhr, status, error) {
                    console.log(">>> Batch Process Error: " + error);
                },
                complete: function (xhr, status) {
                    console.log(">>> Batch Processing Finished.");
                }
            });
        }


    </script>
<[/block]>

<[block name="page-content"]>

    <div class="animsition">

        <[include file="../layout/partials/navbar.tpl"]>

        <div class="container clear-nav">

            <[include file="../layout/partials/alerts.tpl"]>

            <div class="row">
                <div class="col-md-12">
                    <div class="jumbotron">
                        <h1>Dashboard</h1>                        
                        <fieldset>
                            <legend>Overview:</legend>
                            <table class="equal-table table table-bordered text-center">
                                <tr>
                                    <td>
                                        <h2>Current Status: <small id="status"></small></h2>
                                    </td>
                                    <td>
                                        <h2>Next Batch: <small id="timer"></small></h2>
                                    </td>
                                </tr>
                            </table>
                        </fieldset>
                        <fieldset>
                            <legend>Controls:</legend>
                            <div class="well">
                                <button onclick="run();" type="button" class="btn btn-primary"><span class="glyphicon glyphicon-refresh"></span> Run Now</button>
                                <button onclick="start();" type="button" class="btn btn-success" style="margin-left: 20px"><span class="glyphicon glyphicon-play"></span> Start</button>
                                <button onclick="stop();" type="button" class="btn btn-danger"><span class="glyphicon glyphicon-stop"></span> Stop</button>
                            </div>
                        </fieldset>
                    </div>
                </div>
            </div>

            <div class="row">

                <div class="col-md-6">
                    <div class="panel panel-primary">
                        <div class="panel-heading"><span class="glyphicon glyphicon-arrow-right"></span> Next Batch</div>
                        <div class="panel-body">
                            <table id="allianceInFilesTable" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th>File Name</th>
                                        <th>Size</th>
                                        <th>Date Modified</th>
                                    </tr>
                                </thead>
                                <tbody style="font-size: .8em">

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="panel panel-primary">
                        <div class="panel-heading"><span class="glyphicon glyphicon-book"></span> Batch History Log</div>
                        <div class="panel-body">
                            <table id="batchHistoryTable" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th>Status</th>
                                        <th>Run At</th>
                                        <th>Message</th>
                                    </tr>
                                </thead>
                                <tbody style="font-size: .8em">

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

<[/block]>

