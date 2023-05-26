<?php
session_start();

require dirname(__DIR__) . '/functions/response.php';

session_unset();

redirect('./authentication.php');