<?php
session_start();

require_once dirname(__DIR__).'/functions/response.php';

if( !isset($_SESSION['user']) || empty($_SESSION['user']) ) {
    redirect('authentication.php');
}