<?php

function checking_email($db, $email){
    //preparing sql statement

    $sql = "SELECT * FROM users WHERE email = :email";
    $stmt = $db->prepare($sql);
    $stmt->bindParam(':email', $email);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result;
}


?>