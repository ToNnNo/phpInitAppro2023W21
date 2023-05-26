<?php
function query($key, $default = null) {
    return array_key_exists($key, $_GET) ? 
        filter_var($_GET[$key], FILTER_SANITIZE_FULL_SPECIAL_CHARS) : $default;
}