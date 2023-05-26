<?php
require('./fonction.php');

$c = connect();

$livre = [
    'titre' => "Harry Potter à l'école des sorciers",
    'parution' => date_create('26-06-1997'),
    'resume' => "Harry Potter est un garçon ordinaire. Mais, le jour de ses onze ans, son existence bascule : un géant vient le chercher pour l'emmener dans une école de sorciers. Voler à cheval sur des balais, jeter des sorts, combattre les Trolls : Harry Potter se révèle être un sorcier vraiment doué."
];

// version 1 
$parution = date_format($livre['parution'], 'Y-m-d');

$sql = "INSERT INTO livre (titre, parution, `resume`) VALUE (?, ?, ?)";
$stmt = mysqli_prepare($c, $sql);
mysqli_stmt_bind_param($stmt, "sss", $livre['titre'], $parution, $livre['resume']);
mysqli_stmt_execute($stmt); // 2 paramètres depuis la version 8.1

printf("%d ligne insérée(s)", mysqli_stmt_affected_rows($stmt));

if(mysqli_errno($c)) {
    echo mysqli_error($c);
}

// value = \" or 1 = 1 -- \"
// SELECT * FROM user where username = "value"

// SELECT * FROM user where username = "\" or 1 = 1 -- \" "