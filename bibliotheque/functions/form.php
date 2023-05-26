<?php
$datas = [];
$errors = [];

function getValue($key, $datas) {
    
    if( array_key_exists($key, $datas) ) {
        return $datas[$key];
    }

    return null;
}

function getErrors($key, $formErrors) {
    
    if( !array_key_exists($key, $formErrors) ) {
        return null;
    }

    $errors = $formErrors[$key];
    
    $message = "<ul>";
    foreach($errors as $error) {
        $message .= "<li>".$error."</li>";
    }
    $message .= "</ul>";

    return $message;
}