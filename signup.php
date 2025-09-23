<?php
header("Access-Control-Allow-Origin: http://localhost:3000");
header("Access-Control-Allow-Credentials: true");
header("Access-Control-Allow-Headers: Content-Type");
header("Access-Control-Allow-Methods: POST, OPTIONS");

if ($_SERVER["REQUEST_METHOD"] === 'POST') {

   try {
      require_once 'db_connect.php';
      require_once 'signup_model.php';
      require_once 'signup_control.php';

      $username = $data['username'];
      $email = $data['email'];
      $password = $data['password'];

      // GETTING ERROR MESSAGES

      $errors = [];

      if(is_input_empty($username, $email, $password)){
         $errors[] = 'All fields are required!';
      }

      if(is_email_valid($email)){
         $errors[] = 'The email you entered is invalid!';
      }

      if(is_username_taken($db, $username)){
         $errors[] = 'The username you entered has been used!';
      }

      if(is_email_registered($db, $email)){
         $errors[] = 'The email you entered has been registered!';
      }

      if(!empty($errors)){
         echo json_encode(["errors" => $errors]);
         exit;
      }

      create_user($db, $username, $email, $password);
      echo json_encode(["success" => true, 'message' => 'Sign up successful, redirecting...']);
      exit;
      

   } catch (PDOException $err) {
     echo json_encode(['message' => 'Something went wrong: ' . $err->getMessage()]);
   }
   
}else{
   echo json_encode(['message' => 'Invalid signup request']);
}


?>