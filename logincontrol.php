<?php

function is_input_empty($email, $password){
    if(empty($email) || empty($password)){
        return true;
    } else{
        return false;
    }
}

function if_email_exist($result){
    if(!$result){
        return true;
    } else{
        return false;
    }
}

function is_password_correct($password, $hash_password){
    if (!password_verify($password, $hash_password)) {
        return true;
    } else{
        return false;
    }
}

?>