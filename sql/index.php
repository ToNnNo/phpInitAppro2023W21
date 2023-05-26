<?php 
require('./fonction.php');

$connexion = connect();

/**
 * livre
 * 
 * id       (int) primary key auto increment
 * titre    (varchar) not null
 * parution (date) not null
 * resume   (text) 
 */

$sql = "CREATE TABLE IF NOT EXISTS livre (
    id int PRIMARY KEY auto_increment,
    titre varchar(100) not null,
    parution date not null,
    `resume` text
) ENGINE=InnoDB";
if( !mysqli_query($connexion, $sql) ) {
    echo mysqli_error($connexion);
}