<?php
    include_once 'app.php';
    $app = new App();
    $sensorValues = $app->getSensorValues();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Favicons -->
    <link href="assets/logo-trudas.png" rel="icon">
    <title>TRUDAS</title>
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    
</head>
<body>
    <?php include 'assets/navbar.php';?>
    <div class="container mt-5">
        <h1 class="h2 text-dark border-bottom border-3 pr-3 pb-3 border-info d-inline-block">Data Acquisition System</h1>
        <div class="row">
            <?php foreach($sensorValues as $value):?>
                <div class="col-md-4">
                    <div class="card my-2">
                        <div class="card-body border bg-info rounded rounded-3 text-light">
                            <div class="d-flex justify-content-between align-items-center sensor">
                                <h1 class="h4"><?=$value['sensor_code']?></h1>
                                <p><span class="h1" data-id="<?=$value['sensor_id']?>"><?=$value['data']?></span> <small class="text-muted"><?=$value['unit']?></small></p>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
			
			<div class="col-md-4">
				<div class="card my-2">
					<div class="card-body border bg-info rounded rounded-3 text-light">
						<div class="d-flex justify-content-between align-items-center sensor">
							<h1 class="h4">Date Time</h1>
							<p><span class="h1" id="datetime"><?=date("d/m/Y H:i:s");?></span></p>
						</div>
					</div>
				</div>
			</div>
			
        </div>
    </div>

<script src="assets/js/bootstrap.bundle.min.js"></script>
<script src="assets/js/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function(){
        setInterval(() => {
            $.ajax({
                url : `api.php`,
                type : 'get',
                dataType : 'json',
                data : $(this).serialize(),
                success : function(data){
                    if(data?.success){
                        const sensorValue = data?.data;
                        sensorValue.map(function(value,index){
                            let el = $(document).find(`span[data-id=${value?.sensor_id}]`);
                            el.html(value?.data);
                        })
                        return;
                    }
                    console.error(data?.message);
                },
                error : function(xhr, status, err){
                    console.error(err);
                }
            })
        }, 1000);
    });
	
	
	
	function clock_tick() {
        let now = new Date();
        $("#datetime").html(("00" + now.getDate()).slice(-2) + "/" + ("00" + (now.getMonth() + 1)).slice(-2) + "/" + ("00" + now.getFullYear()).slice(-2) + " " + ("00" + now.getHours()).slice(-2) + ":" + ("00" + now.getMinutes()).slice(-2) + ":" + ("00" + now.getSeconds()).slice(-2));
        setTimeout(function() {
            clock_tick();
        }, 1000);
    }
    clock_tick();
</script>
</body>
</html>