<?php
header("Access-Control-Allow-Origin: http://localhost:3000");
header("Access-Control-Allow-Credentials: true");
header("Access-Control-Allow-Headers: Content-Type");
header("Access-Control-Allow-Methods: POST, OPTIONS");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
   try {
      require_once 'db_connect.php';
      $email = $data['email'];

      //prepare sql statement to see if email exist in the database
      $sql = "SELECT * FROM users WHERE email = :email";
      $stmt = $db->prepare($sql);
      $stmt -> bindParam(':email', $email);
      $stmt-> execute();

      $result = $stmt -> fetch(PDO::FETCH_ASSOC);

      if($result){
         echo json_encode(['message' => 'user found']);
      }
      

   } catch (PDOException $e) {
      echo json_encode(['error' => 'something went wrong: ' . $e->getMessage()]);
   }
} else{
    echo json_encode(['error' => 'Invalid Login format']);
}


?>