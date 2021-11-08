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
    <title>TRUDAS - Configurations</title>
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <?php
        $updated = null;
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $updated = $app->updateConfig($_POST);
        }
        $config = $app->getConfigs();
    ?>
</head>
<body>
    <?php include 'assets/navbar.php';?>
    <div class="container mt-5">
        <h1 class="h2 text-dark border-bottom border-3 pr-3 pb-3 border-info d-inline-block">Configuration</h1>
       <?php if($updated):?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Success!</strong> Configuration was updated!.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
       <?php elseif($updated === false):?>
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong>Error!</strong> Failed update configuration!.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
       <?php endif?>
        <div class="row">
            <form action="" method="POST">
                <div class="mb-3">
                    <label>Server IP</label>
                    <input type="text" name="server_ip" value="<?=$config['server_ip']?>" class="form-control" placeholder="Server IP">
                </div>
                <div class="mb-3">
                    <label>Analyzer IP</label>
                    <input type="text" name="analyzer_ip" value="<?=$config['analyzer_ip']?>"  class="form-control" placeholder="Analyzer IP">
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <div class="mb-3">
                            <label>Analyzer Port</label>
                            <input type="text" name="analyzer_port" value="<?=$config['analyzer_port']?>"  class="form-control" placeholder="Analyzer Port">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="mb-3">
                            <label>Unit ID</label>
                            <input type="text" name="unit_id" value="<?=$config['unit_id']?>"  class="form-control" placeholder="Unit ID">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="mb-3">
                            <label>Start Address</label>
                            <input type="text" name="start_addr" value="<?=$config['start_addr']?>"  placeholder="Start Address" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-3">
                    <div class="mb-3">
                            <label>Address Num</label>
                            <input type="text" name="addr_num" value="<?=$config['addr_num']?>"  placeholder="Address Num" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="mb-3 d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary">
                        Save Changes
                    </button>
                </div>
            </form>
        </div>
    </div>

<script src="assets/js/bootstrap.bundle.min.js"></script>
<script src="assets/js/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function(){

    });
</script>
</body>
</html>