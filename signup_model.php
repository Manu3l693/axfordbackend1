<?php

function username_exist($db, $username){
    //prepare sql statement

    $sql = "SELECT username FROM users WHERE username = :username";
    $stmt = $db->prepare($sql);
    $stmt->bindParam(':username', $username);
    $stmt-> execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result;
}

function email_exist($db, $email){
    //prepare sql statement

    $sql = "SELECT email FROM users WHERE email = :email";
    $stmt = $db->prepare($sql);
    $stmt->bindParam(':email', $email);
    $stmt-> execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result;
}

function set_user($db, $username, $email, $password){
    //PREPARE SQL STATEMENT

    $sql = "INSERT INTO users(username, email, password) VALUES(:username, :email, :password)";
    $hash_password = password_hash($password, PASSWORD_BCRYPT);
    $stmt = $db->prepare($sql);
    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':password', $hash_password);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result;
}


?>