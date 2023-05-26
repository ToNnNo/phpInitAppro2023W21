<?php
const HOST = "localhost";
const USER = "root";
const PWD = "root";
const PORT = 8889; // 3306
const BDD = "ecole_francaise_athenes";

function connect() {
    $c = mysqli_connect(HOST, USER, PWD, null, PORT);

    if( mysqli_connect_errno() ) {
        echo mysqli_connect_error();
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