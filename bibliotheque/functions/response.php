<?php

function redirect($location) {
    header('Location: '.$location, true, 302);
    exit();
}