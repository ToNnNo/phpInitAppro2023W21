<?php 
if( session_status() !== PHP_SESSION_ACTIVE ) {
    session_start();
}
const FLASH = "FLASH_MESSAGE";

function getFlashes($type) {
    if( empty($_SESSION[FLASH][$type]) ) {
        return []; // Si le message n'existe pas, on retourne un tableau vide
    }

    $messages = $_SESSION[FLASH][$type];
    unset($_SESSION[FLASH][$type]);

    return $messages;
}

function addFlash($type, $message): void {
    $_SESSION[FLASH][$type][] = $message;
}