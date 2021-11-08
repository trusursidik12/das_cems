<?php
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $request = file_get_contents('php://input');
        $data = json_decode($request,true);
        echo json_encode(['status' => true,'response' => ['message' => 'Success!', 'data'=>$data]]);
        return;
    }
    echo json_encode(['status' => false,'response' => ['message' => 'Error']]);
?>