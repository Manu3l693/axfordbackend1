<?php
header("Access-Control-Allow-Origin: http://localhost:3000");
header("Access-Control-Allow-Credentials: true");
header("Access-Control-Allow-Headers: Content-Type");
header("Access-Control-Allow-Methods: POST, OPTIONS");

    require_once 'session.php';
    
    if (isset($_SESSION['user_id'])) {
       echo json_encode(['success' => true,  'authenticated' => true, 'message' => 'Hello world']);
    }


?>