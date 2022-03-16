<?php
    include_once 'app.php';
    $app = new App();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Favicons -->
    <link href="assets/logo-trudas.png" rel="icon">
    <title>TRUDAS - Logs</title>
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="assets/DataTables/datatables.min.css"/>

</head>
<body>
    <?php include 'assets/navbar.php';?>
    <div class="container mt-5">
        <div class="d-flex justify-content-between align-items-center">
            <h1 class="h2 text-dark border-bottom border-3 pr-3 pb-3 border-info d-inline-block">DAS Logs</h1>
            <span>
                <button type="button" id="btnFilter" class="btn btn-info text-white">Filter</button>
                <button type="button" class="btn btn-warning text-white" id="btn-reset">
                    Reset Filter
                </button>
            </span>
        </div>     
        <div class="row">
            <div class="col-md-12">
                <table id="table-logs" class="table table-head-fixed text-nowrap table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Instrument</th>
                            <th>Data Status</th>
                            <th>Date</th>
                            <th>Raw Data</th>
                            <th>Correction</th>
                            <th>Parameter</th>
                            <th>Unit</th>
                            <th>SENT TO SISPEK</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>   
    </div>
    
    <div class="modal fade" id="filterModal" tabindex="-1" role="dialog" aria-labelledby="filterModalTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="filterModalTitle">Filter Logs</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="form-inline" id="formFilter">
                        <label class="sr-only">Instrument</label>
                        <select name="instrument_id" class="form-control mb-2 mr-sm-2">
                            <option value="">Select Instrument</option>
                        </select>
                            <!-- <label class="sr-only">Instrument Status</label>
                            <select name="instrument_status_id" class="form-control mb-2 mr-sm-2">
                                <option value="">Select Instrument Status</option>
                            </select> -->
                        <label class="sr-only">Data Status</label>
                        <select name="data_status_id" class="form-control mb-2 mr-sm-2">
                            <option value="">Select Data Status</option>
                        </select>
                        <label class="sr-only">Date Start</label>
                        <input type="date" name="date_start" class="form-control mb-2 mr-sm-2">
                        <label class="sr-only">Date End</label>
                        <input type="date" name="date_end" class="form-control mb-2 mr-sm-2">
                        <div class="d-flex justify-content-end">
                            
                            <button type="reset" class="d-none btn-reset">Reset</button>
                            <button type="submit" class="btn btn-primary">Filter</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/jquery-3.6.0.min.js"></script>
<script type="text/javascript" src="assets/DataTables/datatables.min.js"></script>
<script>
    $(document).ready(function(){
        $.get(`<?=$app->getServer(':8080/das_log/get_last_das_logs')?>`,
            function(data){
                $('input[name=date_start]').val(data.last_week)
                $('input[name=date_end]').val(data.last_time)
            }
        )
        $.get(`<?=$app->getServer(':8080/instrument/get_instruments')?>`,
            function(data){
                let options = `<option value=''>Select Instruments</option>`;
                data.data.forEach(instrument => {
                    options+=`<option value='${instrument.id}'>${instrument.name}</option>`;
                });
                $('select[name=instrument_id]').html(options);
            }
        )
        $.get(`<?=$app->getServer(':8080/instrument/get_data_status')?>`,
            function(data){
                let options = `<option value=''>Select Status</option>`;
                data.data.forEach(status => {
                    options+=`<option value='${status.id}'>${status.name}</option>`;
                });
                $('select[name=data_status_id]').html(options);
            }
        )
        $('#btn-reset').click(function(e){
            $('.btn-reset').trigger('click');
            $('#formFilter').trigger('submit');
        })
    })
</script>
<script>
    $(document).ready(function(){
        
        var table = $('#table-logs').DataTable({
            "ordering": false,
            "processing": true,
            "serverSide": true,
            "searching": false,
            "pageLength": 50,
            "serverMethod": "post",
            "ajax": {
                "url": "<?= $app->getServer(':8080/das_log/list') ?>",
                "data": function(data) {
                    data.instrument_id = $('select[name="instrument_id"]').val();
                    data.instrument_status_id = $('select[name="instrument_status_id').val();
                    data.data_status_id = $('select[name="data_status_id').val();
                    data.date_start = $('input[name="date_start').val();
                    data.date_end = $('#input[name="date_end').val();
                }
            },
            lengthMenu: [
                [50, 100],
                [50, 100]
            ],
            dom: '<"dt-buttons"Bf><"clear">lirtp',
            buttons: [{
                text: 'Export to Excel',
                extend: 'excel',
                className: 'btn btn-sm btn-success mb-3',
            }],
            columns : [
                {data:0},
                {data:1},
                {data:2},
                {data:3},
                {data:4},
                {data:5},
                {data:6},
                {data:7},
                {
                    data:8,
                    render : function(row){
                        let html = row.split('badge-danger').join('bg-danger');
                        html = html.split('badge-success').join('bg-success');
                        return html;
                    }
                },
            ]
        })
        var filterModal = new bootstrap.Modal(document.getElementById('filterModal'));

        $('#btnFilter').click(function(){
            filterModal.show()
        })
        $('#formFilter').submit(function(e){
            e.preventDefault();
            filterModal.hide();
            table.ajax.reload();
        })
        $('.dt-buttons > button').removeClass('dt-button buttons-excel buttons-html5');
    });
</script>
</body>
</html>