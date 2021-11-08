<?php
    include_once 'app.php';
    $app = new App();
    if(!empty($_GET['id'])){
        $id = (int) $_GET['id'];
        header('Content-type:application/json; charset=utf-8');
        echo json_encode($app->getSensor($id),JSON_PRETTY_PRINT);
        exit();
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Favicons -->
    <link href="assets/logo-trudas.png" rel="icon">
    <title>TRUDAS - Sensors</title>
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/fontawesome/css/all.min.css" rel="stylesheet">
    <?php
        $updated = null;
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $updated = $app->updateSensor($_POST);
        }
        $sensors = $app->getSensors();
    ?>
</head>
<body>
    <?php include 'assets/navbar.php';?>
    <div class="container mt-5">
        <div class="d-flex justify-content-between align-items-center">
            <h1 class="h2 text-dark border-bottom border-3 pr-3 pb-3 border-info d-inline-block">Sensors</h1>
        </div>
       <?php if($updated):?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Success!</strong> Sensors was updated!.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
       <?php elseif($updated === false):?>
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong>Error!</strong> Failed update sensor!.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
       <?php endif?>
        <table class="table table-hovered table-boreded">
            <thead>
                <th>No</th>
                <th>Sensor Code</th>
                <th>Unit</th>
                <th>Formula</th>
                <th></th>
            </thead>
            <tbody>
                <?php $i=1; foreach($sensors as $sensor):?>
                    <tr>
                        <td><?=$i?></td>
                        <td><?=$sensor['sensor_code']?></td>
                        <td><?=$sensor['unit']?></td>
                        <td><?=$sensor['formula']?></td>
                        <td class="text-center">
                            <button data-id="<?=$sensor['id']?>" class="btn btn-sm btn-info btn-edit text-white">
                                <i class="fas fa-pen"></i> Edit
                            </button>
                        </td>
                    </tr>
                <?php $i++; endforeach;?>
            </tbody>
        </table>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="edit-sensor" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="edit-sensorLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="edit-sensorLabel">Edit Sensor</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="" method="POST" id="form-edit">
                    <div class="mb-3">
                        <label>Sensor Code</label>
                        <input type="hidden" name="id">
                        <input type="text" name="sensor_code" placeholder="Sensor Code" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label>Unit</label>
                        <input type="text" name="unit" placeholder="Unit" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label>Formula</label>
                        <input type="text" name="formula" placeholder="Formula" class="form-control" required>
                    </div>
                    <div class="d-flex justify-content-between">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    </div>

<script src="assets/js/bootstrap.bundle.min.js"></script>
<script src="assets/js/jquery-3.6.0.min.js"></script>
<script src="assets/fontawesome/js/all.min.js"></script>
<script>
    $(document).ready(function(){
        $('.btn-edit').click(function(){
            const id = $(this).data('id');
            const form = $('#form-edit');
            $.ajax({
                url : `sensors.php`,
                type : 'get',
                dataType : 'json',
                data : {id},
                success : function(data){
                    form.find('input[name=id]').val(data?.id);
                    form.find('input[name=sensor_code]').val(data?.sensor_code);
                    form.find('input[name=unit]').val(data?.unit);
                    form.find('input[name=formula]').val(data?.formula);

                    $('#edit-sensor').modal('show');
                },
                error : function(xhr, status, err){
                    
                }
            })
        });
    })
</script>
</body>
</html>