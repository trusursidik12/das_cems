<?php 
    include 'app.php';
    $app = new App();
    while (true) {
        $start = microtime(true);
        $sensorValues = $app->getSensorValues();
        echo "Preparing data to sending...";
        echo PHP_EOL;
        $req['stack_id'] = 1;
        $req['waktu'] = date('Y-m-d H:i:s');
        foreach ($sensorValues as $value) {
            $req["sensor{$value['id']}"] = (float) $value['data'];
        }
        $json =  json_encode($req,true);
        try{
            $response = $app->sendData($json);
            if(@$response['status'] == 200){
                echo "Data Sent Successfully!";
                echo PHP_EOL;
                print_r($req);
            }else{
                echo "Error sending data!";
                echo @$response['response']['message'];
            }
        }catch(Exception $e){
            echo $e->getMessage();
        }
        echo PHP_EOL;
        $timeExecuted = microtime(true) -  $start;
        echo "Execute in ".substr($timeExecuted,0,4)." milliseconds".PHP_EOL;
        sleep(1);
    }
?>