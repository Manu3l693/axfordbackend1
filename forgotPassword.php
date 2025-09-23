<?php
header("Access-Control-Allow-Origin: http://localhost:3000");
header("Access-Control-Allow-Credentials: true");
header("Access-Control-Allow-Headers: Content-Type");
header("Access-Control-Allow-Methods: POST, OPTIONS");

if ($_SERVER['REQUEST_METHOD'] === 'POST'){
   require_once 'db_connect.php';
      $email = $data['email'];

      //prepare sql statement to see if email exist in the database
      $sql = "SELECT * FROM users WHERE email = :email";
      $stmt = $db->prepare($sql);
      $stmt -> bindParam(':email', $email);
      $stmt-> execute();

      $result = $stmt -> fetch(PDO::FETCH_ASSOC);

      if($result){
         
         $token = bin2hex(random_bytes(50));
         $expiring =  date('Y-m-d H:i:s', strtotime('+1 hour'));

         //updating table
         $sqli = "UPDATE users SET reset_token = :token, token_expiring =:expiring WHERE email =:email";
         $stmt1 = $db->prepare();
         $stmt1 -> bindParam(':token', $token);
         $stmt1 -> bindParam(':token_expiring', $expiring);
         $stmt1 -> bindParam(':email', $email);
         $stmt1->execute();
         $reset_link = 'localhost/axfordbackend/reset_pswd.php?token=' . $token;
      }
         // Load Composer's autoloader
         // require 'vendor/autoload.php';

         $mail = new PHPMailer(true);

         try {
            // Server settings
            $mail->isSMTP();                                            
            $mail->Host       = 'smtp.titan.email';                     // Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   
            $mail->Username   = 'cynthia@digitaltor.com.ng'; // Your Gmail
            $mail->Password   = 'Cynthia@1'; // Use Gmail App Password, not your login password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         
            $mail->Port       = 587; 

            // Recipients
            $mail->setFrom('cynthia@digitaltor.com.ng', 'AXFORD');
            $mail->addAddress($email);  

             // Content
            $mail->isHTML(true);                                  
            $mail->Subject = 'Password Reset';
            $mail->Body    = 'Hello! Please click the link below to reset your password
                              Click this link to reset your password: <a href='{$reset_link}'>$reset_link</a>';
            // $mail->AltBody = 'Hello! This is a test email using PHPMailer.';

            $mail->SMTPOptions = [
               'ssl' => [
                  'verify_peer' => false,
                  'verify_peer_name' => false,
                  'allow_self_signed' => true,
               ],
            ];
    

            $mail->send();
            echo json_encode(['message' => 'Message sent successfully!']);
            
            
         } catch (PDOException $err) {
            echo json_encode(['error' => 'Something went wrong: ' . $err->getMessage()]);
         }
} else{
   echo json_encode(['error' => 'Something went wrong']);
}


?>