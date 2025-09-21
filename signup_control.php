<?php

function is_input_empty($username, $email, $password){
    if (empty($username) || empty($email) || empty($password)) {
        return true;
    } else{
        return false;
    }
}

function is_username_taken($db, $username){
    if (username_exist($db, $username)) {
        return true;
    } else{
        return false;
    }
}

function is_email_registered($db, $email){
    if (email_exist($db, $email)) {
        return true;
    } else{
        return false;
    }
}

function is_email_valid($email){
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return true;
    } else{
        return false;
    }
}

function create_user($db, $username, $email, $password){
    set_user($db, $username, $email, $password);
}



?>