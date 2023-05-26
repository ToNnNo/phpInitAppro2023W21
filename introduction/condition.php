<?php

// if / switch

if ( true ) {
    // executé uniquement si la condition est vrai
    echo "Vrai ! <br />";
}

$age = 17;

if( $age < 18 ) {
    echo "Accès non autorisé <br />";
} else {
    echo "Vous pouvez entrer <br />";
}

$temperature = 20;
$etat = null;

if($temperature <= 0) {
    $etat = "solide";
} elseif ($temperature >= 100) {
    $etat = "gazeux";
} else {
    $etat = "liquide";
}

echo sprintf("A %s°C, l'eau est %s<br />", $temperature, $etat);

// opérateurs logique: && (et) || (ou) XOR (ou exclusif)

if( $temperature < 0 ) {
    echo "il fait très froid";
} elseif( $temperature >= 0 && $temperature < 15 ) {
    echo "il fait froid";
} elseif ($temperature >= 15 && $temperature < 25) {
    echo "il fait chaud";
} else {
    echo "il fait très chaud";
}
echo "<br />";

// condition ternaire
// ( conditions ) ? si vrai : si faux;

$age = 21;
echo ($age < 18) ? "Accès non autorisé" : "Vous pouvez entrer";
echo "<br />";

// switch 

$weekday = date('N');
echo "Nous sommes ";
switch($weekday) {
    case 1:
        echo "lundi";
        break;
    case 2: 
        echo "mardi";
        break;
    case 3: 
        echo "mercredi";
        break;
    case 4: 
        echo "jeudi";
        break;
    case 5: 
        echo "vendredi";
        break;
    case 6:
    case 7:
        echo "en week-end";
        break;
    default: 
        echo "sur un cas impossible";
}
echo "<br />";