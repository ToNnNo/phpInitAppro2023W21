<?php 
date_default_timezone_set('Europe/Paris');

echo "Hello World";
echo "<br />";

// commentaire en 1 ligne
/* 
    commentaire 
    multiligne
*/

// type de variable primitif: string, integer, float, boolean (true/false)

$string; // déclaration
$string = "..."; // affectation

$string = "Chaine de caractère ( \u{1F604} )"; // initialisation
echo "string: " . $string . "<br />"; 

$integer = 1;
echo "integer: " . $integer . "<br />";

$float = 2.5;
echo "float: " . $float . "<br />";

$boolean = true; // false
echo "boolean: " . $boolean . "<br />";

// type de variable référence: array, object

// tableau indexé
$array = [$string, $integer, $float, $boolean, false, "Stéphane"];
echo "array: ";
// var_dump($array); // var_dump (debug)
print_r($array);
echo "<br />";

echo "Hello " . $array[5] . "<br />";

$array[5] = "John Doe";
echo "Hello " . $array[5] . "<br />";

$array[10] = null;
$array[] = date(DATE_RSS);

var_dump($array);

// tableau associatif

$person = [
    'firstname' => "John",
    'lastname' => "Doe",
    'address' => null
];

echo "Bonjour " . $person['firstname'] . " " . $person['lastname'] . "<br />";

// sprintf retourne une chaine de caractère formatée
// printf affiche une chaine de caractère formatée
$chaine = sprintf("Bonjour %s %s <br />", $person['firstname'], $person['lastname']);
echo $chaine;

// opérateurs Mathématique (+ - * / %) << >>

echo "16 / 4 = " . (16 / 4);
echo "<br />";

echo "16 % 4 = " . (16 % 4);
echo "<br />";

echo "16 % 3 = " . (16 % 3);
echo "<br />";

// opérateurs comparatifs (< > <= >= != == === !==) ! veut dire non

$bool = false;
$bool = !$bool; // $bool = true;

$int = 1;

// == compare uniquement les valeurs
echo $int . " == " . $bool . " ";
echo ($int == $bool) ? "true" : "false";
echo "<br />";

// === compare les valeurs et le type
echo $int . " === " . $bool . " ";
echo ($int === $bool) ? "true" : "false";
echo "<br />";