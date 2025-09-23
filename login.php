<?php
header("Access-Control-Allow-Origin: http://localhost:3000");
header("Access-Control-Allow-Credentials: true");
header("Access-Control-Allow-Headers: Content-Type");
header("Access-Control-Allow-Methods: POST, OPTIONS");

if ($_SERVER["REQUEST_METHOD"] === 'POST') {
   
   try {

   require_once 'db_connect.php';
   require_once 'loginmodel.php';
   require_once 'logincontrol.php';

   $email = $data['email'];
   $password = $data['password'];

   $errors = [];

   if(is_input_empty($email, $password)){
      $errors[] = 'All fields are required!';
   }

   $result =  checking_email($db, $email);

   if(if_email_exist($result)){
      $errors[] = 'The email you entered does not exist!';
   }

   if(!if_email_exist($result) && is_password_correct($password, $result['password'])){
      $errors[] = 'The password you entered is incorrect!';
   }
  

   if(!empty($errors)){
      echo json_encode(['error' => $errors]);
      exit;
   } else{
      echo json_encode(['success' => true, 'message' => 'Welcome back ' . $result['username']]);
      exit;
   }

   require_once 'session.php';

   $_SESSION['user_id'] = $result['id'];



   } catch (PDOException $errr) {
      echo json_encode(['errorMessage' => 'Something went wrong: '. $errr->getMessage()]);
   }

} else{
    echo json_encode(['errorMessage' => 'Invalid Login format!']);
}





?>