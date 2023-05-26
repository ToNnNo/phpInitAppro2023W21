<?php
require_once dirname(__DIR__) . "/functions/logger.php";

const HOST = "localhost";
const USER = "root";
const PWD = "root";
const PORT = 8889; // 3306
const BDD = "ecole_francaise_athenes";

function connect() {
    info('Connexion à la base de données');
    $c = mysqli_connect(HOST, USER, PWD, null, PORT);

    if( mysqli_connect_errno() ) {
        echo mysqli_connect_error();
        error(mysqli_connect_error(), [HOST, USER, "******", PORT]);
        exit();
    }

    mysqli_set_charset($c, 'utf8mb4');

    select_database($c);

    return $c;
}

function select_database($c) {
    if( !mysqli_select_db($c, BDD) ) {
        $sql = "CREATE DATABASE IF NOT EXISTS ".BDD;
        if( !mysqli_query($c, $sql) ) {
            echo mysqli_error($c);
            exit();
        }
        mysqli_select_db($c, BDD);
    }
}

function findAll(string $sql, array $params = []) {
    $c = connect();
    $stmt = mysqli_prepare($c, $sql);

    if(!empty($params)) {
        $type = str_repeat("s", count($params));
        mysqli_stmt_bind_param($stmt, $type, ...$params);
    }
    mysqli_stmt_execute($stmt);
    info($sql, $params);

    $result = mysqli_stmt_get_result($stmt);
    
    return mysqli_fetch_all($result, MYSQLI_ASSOC);
}

function find(string $sql, array $params = []) {
    $c = connect();
    $stmt = mysqli_prepare($c, $sql);

    if(!empty($params)) {
        $type = str_repeat("s", count($params));
        mysqli_stmt_bind_param($stmt, $type, ...$params);
    }
    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);
    
    return mysqli_fetch_assoc($result);
}

function execute($sql, array $params) {
    $c = connect();
    $stmt = mysqli_prepare($c, $sql);
    
    $type = str_repeat("s", count($params));
    mysqli_stmt_bind_param($stmt, $type, ...$params);
    
    mysqli_stmt_execute($stmt);
}