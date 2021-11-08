<?php
    include 'app.php';
    $app = new App();
    try{
        $sensorValues = $app->getSensorValues();
        echo json_encode(['success' => true,'data' => $sensorValues],JSON_PRETTY_PRINT);
    }catch(Exception $e){
        echo json_encode(['success' => false, 'message' => $e->getMessage()],JSON_PRETTY_PRINT);
    }
?>