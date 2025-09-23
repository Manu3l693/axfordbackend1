<?php

session_start();

// Destroy all session data
$_SESSION = [];
session_unset();
session_destroy();

header("Access-Control-Allow-Origin: http://localhost:3000");
header("Access-Control-Allow-Credentials: true");
header("Access-Control-Allow-Headers: Content-Type");
header("Access-Control-Allow-Methods: POST, OPTIONS");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
   echo json_encode(['success' => true, 'message' => 'You have successfully logged out from Axford!']);
}

?>